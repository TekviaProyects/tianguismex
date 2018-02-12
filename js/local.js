/*jslint plusplus: true, devel: true, nomen: true, indent: 4, maxerr: 50 */ 
/*global define, $, jQuery, swal, result */
/*jslint browser: true*/
var local = {
// Initialize vars
	selects : {},

///////////////// ******** ----							 view_new							------ ************ //////////////////
//////// Load the view to new local
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		
	view_new : function($objet){
		"use strict";
		console.log('==========> $objet view_new', $objet);
		
		$.ajax({
			data : $objet,
			url : 'ajax.php?c=local&f=view_new',
			type : 'post',
			dataType : 'html'
		}).done(function(resp) {
			console.log('==========> done view_new', resp);
			
			$("#"+$objet.div).html(resp);
		}).fail(function(resp) {
			console.log('==========> fail !!! view_new', resp);
			
			swal({
				title : 'Error',
				text : 'A ocurrido un error al cargar los datos',
				timer : 5000,
				showConfirmButton : true,
				type : 'error'
			});
		});
	},
	
///////////////// ******** ----						END view_new							------ ************ //////////////////

///////////////// ******** ----						select_local							------ ************ //////////////////
//////// Add or remove item from locals
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		
	select_local : function($objet){
		"use strict";
		console.log('==========> $objet select_local', $objet);
		
		if(local.selects[$objet.id]){
			delete local.selects[$objet.id];
			
			$("#btn_"+$objet.id).removeClass("btn-success").addClass("btn-info");
		}else{
			local.selects[$objet.id] = $objet;
			
			$("#btn_"+$objet.id).removeClass("btn-info").addClass("btn-success");
		}
		
		console.log('==========> selects', local.selects);
	},
	
///////////////// ******** ----						END select_local						------ ************ //////////////////

///////////////// ******** ----						rent_local								------ ************ //////////////////
//////// Rent a local
	// The parameters that can receive are:
		
	rent_local : function($objet){
		"use strict";
		console.log('==========> $objet rent_local', $objet);
				
		if(jQuery.isEmptyObject(local.selects)){
			swal({
				title : 'Local no valido',
				text : 'Debes seleccionar un local para continuar',
				timer : 5000,
				showConfirmButton : true,
				type : 'warning'
			});
			
			return;
		}
		
		var text = '',
			total = 0;
		
		$.each(local.selects, function(index, value) {
			text += '<br> Local '+value.description+' por $'+value.cost;
			total += parseFloat(value.cost);
		});
		
		text += '<br><br> Total $'+total;
		
		swal({
			title: 'Resumen',
			html: text,
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Continuar',
			cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					data : local.selects,
					url : 'ajax.php?c=local&f=rent_local',
					type : 'post',
					dataType : 'json'
				}).done(function(resp) {
					console.log('==========> done rent_local', resp);
					
					
				}).fail(function(resp) {
					console.log('==========> fail !!! rent_local', resp);
					
					swal({
						title : 'Error',
						text : 'A ocurrido un error al rentar los locales',
						timer : 5000,
						showConfirmButton : true,
						type : 'error'
					});
				});
			}
		});
	}
	
///////////////// ******** ----						END rent_local							------ ************ //////////////////

};