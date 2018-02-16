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
			total = 0,
			data = {};
		
		$.each(local.selects, function(index, value) {
			text += '<br> Local '+value.description+' por $'+value.cost;
			total += parseFloat(value.cost);
			data.date = value.date;
			data.tianguis_id = value.tianguis_id;
			data.cat_id = value.cat_id;
		});
		
		text += '<br><br> Total $'+total;
		
		data.total = total;
		data.local = local.selects;
		
		console.log('==========> data', data);
		
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
					data : data,
					url : 'ajax.php?c=local&f=rent_local',
					type : 'post',
					dataType : 'json'
				}).done(function(resp) {
					console.log('==========> done rent_local', resp);
					
					local.selects = {};
					
					swal({
						title : 'Locales apartados',
						text : 'Tus locales han sido apartados exitosamente, tienes 3 dias para pagarlos',
						timer : 5000,
						showConfirmButton : true,
						type : 'success'
					});
					
					$.each(data.local, function(index, value) {
						$("#btn_"+value.id).removeClass("btn-success available").addClass("btn-secondary"); 
						$("#btn_"+value.id).attr("disabled", "disabled");
						
						$("#tr_"+value.id).removeClass("info available").addClass("secondary"); 
					});
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
	},
	
///////////////// ******** ----						END rent_local							------ ************ //////////////////

///////////////// ******** ----						list_orders							------ ************ //////////////////
//////// Check the orders and load a view
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		// client_id -> Client ID 
		
	list_orders : function($objet){
		"use strict";
		console.log('==========> $objet list_orders', $objet);
		
		$.ajax({
			data : $objet,
			url : 'ajax.php?c=local&f=list_orders',
			type : 'post',
			dataType : 'html'
		}).done(function(resp) {
			console.log('==========> done list_orders', resp);
			
			$("#"+$objet.div).html(resp);
		}).fail(function(resp) {
			console.log('==========> fail !!! list_orders', resp);
			
			swal({
				title : 'Error',
				text : 'A ocurrido un error al cargar los datos',
				timer : 5000,
				showConfirmButton : true,
				type : 'error'
			});
		});
	}
	
///////////////// ******** ----						END list_orders						------ ************ //////////////////

};