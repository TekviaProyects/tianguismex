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
		
		text += '<br><br><b>Total $'+total+'</b><br><br><br>';
		
		data.total = total;
		data.local = local.selects;
		
		console.log('==========> data', data);
		
		$("#modal_pay").modal("show");
		$("#div_resumen").html(text);
		
		$("#btn_pay_store").click(function() {
			$("#modal_pay").modal("hide");
		
			$.ajax({
				data : data,
				url : 'ajax.php?c=local&f=rent_local',
				type : 'post',
				dataType : 'json'
			}).done(function(resp) {
				console.log('==========> done rent_local', resp);
				
				if(resp.status !== 1){
					swal({
						title : 'Error',
						text : resp.message,
						timer : 7000,
						showConfirmButton : true,
						type : 'warning'
					});
					
					return;
				}
				
				local.selects = {};
				
				var link = document.createElement('a');
				link.href = resp.url;
				link.download = 'ficha.pdf';
				link.dispatchEvent(new MouseEvent('click'));
				
				$.each(data.local, function(index, value) {
					$("#btn_"+value.id).removeClass("btn-success available").addClass("btn-secondary"); 
					$("#btn_"+value.id).attr("disabled", "disabled");
					
					$("#tr_"+value.id).removeClass("info available").addClass("secondary"); 
				});
				
				setTimeout(function(){
					swal({
						title : 'Ficha de pago creada',
						text : 'Tu ficha de pago ha sido creada con exito',
						timer : 7000,
						showConfirmButton : true,
						type : 'success'
					});
				}, 500);
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
		});
	},
	
///////////////// ******** ----						END rent_local						------ ************ //////////////////

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
	},
	
///////////////// ******** ----						END list_orders						------ ************ //////////////////

///////////////// ******** ----					new_card_pay							------ ************ //////////////////
//////// Generate a new pay
	// The parameters that can receive are:
	
	new_card_pay : function($objet){
		"use strict";
		console.log('==========> $objet new_card_pay', $objet);
		
		var data = {},
			total = 0;
		
		data.token_id = $objet.token_id;
		data.deviceIdHiddenFieldName = $objet.deviceIdHiddenFieldName;
		
		$.each(local.selects, function(index, value) {
			total += parseFloat(value.cost);
			data.date = value.date;
			data.tianguis_id = value.tianguis_id;
			data.cat_id = value.cat_id;
		});
		
		data.total = total;
		data.local = local.selects;
		
		console.log('==========> data', data);
		
		$.ajax({
			data : data,
			url : 'ajax.php?c=local&f=new_card_pay',
			type : 'post',
			dataType : 'json'
		}).done(function(resp) {
			console.log('==========> Done new_card_pay', resp);
			
			$("#pay-button").prop("disabled", false);
			$("#pay-button").html("Pagar");
			
			$("#modal_pay").modal('hide');
			
			if(resp.status !== 1){
				swal({
					title : 'Error',
					text : resp.message,
					timer : 7000,
					showConfirmButton : true,
					type : 'warning'
				});
				
				return;
			}
			
			local.selects = {};
			
			$.each(data.local, function(index, value) {
				$("#btn_"+value.id).removeClass("btn-success available").addClass("btn-secondary"); 
				$("#btn_"+value.id).attr("disabled", "disabled");
				
				$("#tr_"+value.id).removeClass("info available").addClass("secondary"); 
			});
			
			setTimeout(function(){
				swal({
					title : 'Locales rentados',
					text : 'Tus locales han sido rentados con exito',
					timer : 7000,
					showConfirmButton : true,
					type : 'success'
				});
			}, 500);
		}).fail(function(resp) {
			console.log('==========> fail !!! new_card_pay', resp);
			
			$("#pay-button").prop("disabled", false);
			$("#pay-button").html("Pagar");
		
			swal({
				title : 'Error',
				text : 'Error al generar el pago',
				timer : 5000,
				showConfirmButton : true,
				type : 'error'
			});
		});
	},

///////////////// ******** ----					END new_card_pay						------ ************ //////////////////

///////////////// ******** ----					download_pay							------ ************ //////////////////
//////// Check the orders and load a view
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		// client_id -> Client ID 
		
	download_pay : function($objet){
		"use strict";
		console.log('==========> $objet download_pay', $objet);
		
		var type = ($objet.json === 1) ? 'json' : 'html';
		
		$.ajax({
			data : $objet,
			url : 'ajax.php?c=local&f=list_orders',
			type : 'post',
			dataType : type
		}).done(function(resp) {
			console.log('==========> done download_pay', resp);
			
			var link = document.createElement('a');
			link.href = resp[0].url;
			link.download = 'ficha.pdf';
			link.dispatchEvent(new MouseEvent('click'));
			
			swal({
				title : 'Ficha de pago creada',
				text : 'Tu ficha de pago ha sido creada con exito',
				timer : 7000,
				showConfirmButton : true,
				type : 'success'
			});
		}).fail(function(resp) {
			console.log('==========> fail !!! download_pay', resp);
			
			swal({
				title : 'Error',
				text : 'A ocurrido un error al descargar la ficha',
				timer : 5000,
				showConfirmButton : true,
				type : 'error'
			});
		});
	},
	
///////////////// ******** ----						END list_orders						------ ************ //////////////////

///////////////// ******** ----						view_details						------ ************ //////////////////
//////// Load a details view
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		// id -> Order ID
		
	view_details : function($objet){
		"use strict";
		console.log('==========> $objet view_details', $objet);
		
		$("#"+$objet.div).html('');
		
		$.ajax({
			data : $objet,
			url : 'ajax.php?c=local&f=view_details',
			type : 'post',
			dataType : 'html'
		}).done(function(resp) {
			console.log('==========> done view_details', resp);
			
			$("#"+$objet.div).html(resp);
		}).fail(function(resp) {
			console.log('==========> fail !!! view_details', resp);
			
			swal({
				title : 'Error',
				text : 'A ocurrido un error al cargar los datos',
				timer : 5000,
				showConfirmButton : true,
				type : 'error'
			});
		});
	},
	
///////////////// ******** ----						END view_details					------ ************ //////////////////

///////////////// ******** ----						view_voucher						------ ************ //////////////////
//////// Load a voucher view
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		// id -> Order ID
		
	view_voucher : function($objet){
		"use strict";
		console.log('==========> $objet view_voucher', $objet);
		
		$("#"+$objet.div).html('');
		
		$.ajax({
			data : $objet,
			url : 'ajax.php?c=local&f=view_voucher',
			type : 'post',
			dataType : 'html'
		}).done(function(resp) {
			console.log('==========> done view_voucher', resp);
			
			$("#"+$objet.div).html(resp);
		}).fail(function(resp) {
			console.log('==========> fail !!! view_voucher', resp);
			
			swal({
				title : 'Error',
				text : 'A ocurrido un error al cargar los datos',
				timer : 5000,
				showConfirmButton : true,
				type : 'error'
			});
		});
	}
	
///////////////// ******** ----						END view_voucher					------ ************ //////////////////

};