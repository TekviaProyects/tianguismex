/*jslint plusplus: true, devel: true, nomen: true, indent: 4, maxerr: 50 */ 
/*global define, $, jQuery, swal, result */
/*jslint browser: true*/
var local = {
// Initialize vars
	total_selected: 0,
	selects : {},
	total: 0,

///////////////// ******** ----							 view_new							------ ************ //////////////////
//////// Load the view to new local
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		
	view_new : function($objet){
		"use strict";
		console.log('==========> $objet view_new', $objet);
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
		$.ajax({
			data : $objet,
			url : 'ajax.php?c=local&f=view_new',
			type : 'post',
			dataType : 'html'
		}).done(function(resp) {
			console.log('==========> done view_new', resp);
			
			local.total_selected = 0;
			local.total = 0;
			
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
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
		
		if(local.selects[$objet.id]){
			delete local.selects[$objet.id];
			local.total_selected --;
			
			$("#btn_"+$objet.id).removeClass("btn-success").addClass("btn-info");
		}else{
			if(local.total > 0 && local.total_selected >= local.total){
				swal({
					title : 'Cantidad no valida',
					text : 'Debes seleccionar maximo '+local.total+' locales.',
					timer : 5000,
					showConfirmButton : true,
					type : 'warning'
				});
			}else{
				local.selects[$objet.id] = $objet;
				local.total_selected ++;
				
				$("#btn_"+$objet.id).removeClass("btn-info").addClass("btn-success");
			}
		}
		
		console.log('==========> total_selected', local.total_selected);
		console.log('==========> selects', local.selects);
		console.log('==========> total', local.total);
	},
	
///////////////// ******** ----						END select_local						------ ************ //////////////////

///////////////// ******** ----						rent_local								------ ************ //////////////////
//////// Rent a local
	// The parameters that can receive are:
		
	rent_local : function($objet){
		"use strict";
		console.log('==========> $objet rent_local', $objet);
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
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
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
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

///////////////// ******** ----						pay_store							------ ************ //////////////////
//////// Generate a new pay
	// The parameters that can receive are:
	
	pay_store : function($objet){
		"use strict";
		console.log('==========> $objet pay_store', $objet);
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
		var data = {},
			total = 0;
			
		$.each(local.selects, function(index, value) {
			total += parseFloat(value.cost);
			data.date = value.date;
			data.tianguis_id = value.tianguis_id;
			data.cat_id = value.cat_id;
		});
		
		data.total = total;
		data.local = local.selects;
		
		console.log('==========> data', data);
		
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
				
				local.view_new({
					div: 'contenedor'
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
			
			local.list_orders({
				client_id: resp.client_id,
				div: 'contenedor'
			});
			
			local.total_selected = 0;
			local.total = 0;
		}).fail(function(resp) {
			console.log('==========> fail !!! rent_local', resp);
			
			swal({
				title : 'Error',
				text : 'A ocurrido un error al rentar los locales',
				timer : 5000,
				showConfirmButton : true,
				type : 'error'
			});
			
			local.view_new({
				div: 'contenedor'
			});
		});
	},

///////////////// ******** ----					END pay_store							------ ************ //////////////////

///////////////// ******** ----					new_card_pay							------ ************ //////////////////
//////// Generate a new pay
	// The parameters that can receive are:
	
	new_card_pay : function($objet){
		"use strict";
		console.log('==========> $objet new_card_pay', $objet);
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
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
				
				local.list_orders({
					client_id: resp.client_id,
					div: 'contenedor'
				});
			}, 500);
			
			local.total_selected = 0;
			local.total = 0;
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
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
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
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
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
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
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
	},
	
///////////////// ******** ----						END view_voucher					------ ************ //////////////////

///////////////// ******** ----						renew_store							------ ************ //////////////////
//////// Renew the order to new month
	// The parameters that can receive are:
		// order_id -> Order ID
		// end_date -> The expire date of the order
		// client_id -> Client ID
		// tianguis_id -> Tianguis ID
		
	renew_store : function($objet){
		"use strict";
		console.log('==========> $objet renew_store', $objet);
		
		$.ajax({
			data : $objet,
			url : 'ajax.php?c=local&f=renew_store',
			type : 'post',
			dataType : 'json'
		}).done(function(resp) {
			console.log('==========> done renew_store', resp);
			
			
			if(resp.status !== 1){
				swal({
					title : 'Error al renovar',
					text : resp.message,
					timer : 7000,
					showConfirmButton : true,
					type : 'warning'
				});
			
				return;
			}
			
			var link = document.createElement('a');
			link.href = resp.url;
			link.download = 'ficha.pdf';
			link.dispatchEvent(new MouseEvent('click'));
			
			$("#modal_details").modal("hide");
			$("#modal_pay").modal("hide");
			
			swal({
				title : 'Ficha de pago creada',
				text : 'Tu ficha de pago ha sido creada con exito',
				timer : 7000,
				showConfirmButton : true,
				type : 'success'
			});
			
			setTimeout(function(){
				local.list_orders({
					client_id: $objet.client_id,
					check_date: resp.check_date,
					view: 'list_renovations',
					div: 'contenedor',
					status: 1
				});
			}, 1000);
		}).fail(function(resp) {
			console.log('==========> fail !!! renew_store', resp);
			
			swal({
				title : 'Error',
				text : 'A ocurrido un error al renovar',
				timer : 5000,
				showConfirmButton : true,
				type : 'error'
			});
		});
	},
	
///////////////// ******** ----						END renew_store						------ ************ //////////////////

///////////////// ******** ----						renew_card							------ ************ //////////////////
//////// Generate a new pay
	// The parameters that can receive are:
	
	renew_card : function($objet){
		"use strict";
		console.log('==========> $objet renew_card', $objet);
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
		var data = $objet || {},
			total = 0;
		
		data.token_id = $objet.token_id;
		data.deviceIdHiddenFieldName = $objet.deviceIdHiddenFieldName;
		
		$.each(local.selects, function(index, value) {
			data.date = value.date;
			data.tianguis_id = value.tianguis_id;
			data.cat_id = value.cat_id;
		});
		
		console.log('==========> data', data);
		
		$.ajax({
			data : data,
			url : 'ajax.php?c=local&f=renew_card',
			type : 'post',
			dataType : 'json'
		}).done(function(resp) {
			console.log('==========> Done renew_card', resp);
			
			$("#pay-button").prop("disabled", false);
			$("#pay-button").html("Pagar");
			
			$("#modal_details").modal("hide");
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
			
			swal({
				title : 'Locales rentados',
				text : 'La renovación de tus locales ha sido exitosa',
				timer : 7000,
				showConfirmButton : true,
				type : 'success'
			});
			
			setTimeout(function(){
				local.list_orders({
					client_id: $objet.client_id,
					check_date: resp.check_date,
					view: 'list_renovations',
					div: 'contenedor',
					status: 1
				});
			}, 1000);
		}).fail(function(resp) {
			console.log('==========> fail !!! renew_card', resp);
			
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

///////////////// ******** ----						END renew_card						------ ************ //////////////////

///////////////// ******** ----						free								------ ************ //////////////////
//////// Free the local of the order
	// The parameters that can receive are:
		// order_id -> Order ID
		// creation_date -> Order creation date
		
	free : function($objet){
		"use strict";
		console.log('==========> $objet free', $objet);
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
		$.ajax({
			data : $objet,
			url : 'ajax.php?c=local&f=free',
			type : 'post',
			dataType : 'json'
		}).done(function(resp) {
			console.log('==========> Done free', resp);
			
			$("#modal_free").modal('hide');
			$("#modal_details").modal("hide");
			
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
			
			swal({
				title : 'Locales liberados',
				text : 'Los locales han sido  liberados exitosamente',
				timer : 7000,
				showConfirmButton : true,
				type : 'success'
			});
		}).fail(function(resp) {
			console.log('==========> fail !!! renew_card', resp);
			
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

///////////////// ******** ----						END free							------ ************ //////////////////

///////////////// ******** ----						change								------ ************ //////////////////
//////// Rent a local
	// The parameters that can receive are:
		
	change : function($objet){
		"use strict";
		console.log('==========> $objet change', $objet);
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
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
		
		if(local.total > local.total_selected){
			swal({
				title : 'Local no valido',
				text : 'Debes seleccionar el mismo numero de locales de la orden',
				timer : 5000,
				showConfirmButton : true,
				type : 'warning'
			});
			
			return;
		}
		
		var text = 'Los locales se cambiaran por:';
		
		$.each(local.selects, function(index, value) {
			text += '<br> Local '+value.description;
		});
		
		$objet.local = local.selects;
		console.log('==========> data', $objet);
		
		$.ajax({
			data : $objet,
			url : 'ajax.php?c=local&f=change',
			type : 'post',
			dataType : 'json'
		}).done(function(resp) {
			console.log('==========> Done change', resp);
			
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
		
		// Clean vars
			local.total_selected = 0;
			local.selects = {};
			local.total = 0;
			
			setTimeout(function(){
				swal({
					title : 'Locales cambiados',
					text : 'Los locales han sido cambiados con exito',
					timer : 7000,
					showConfirmButton : true,
					type : 'success'
				});
				
				local.list_orders({
					tianguis_id: resp.tianguis_id,
					div: 'contenedor',
					view: 'list_orders_admin'
				});
			}, 500);
		}).fail(function(resp) {
			console.log('==========> fail !!! renew_card', resp);
		
			swal({
				title : 'Error',
				text : 'Error al cambiar los locales',
				timer : 5000,
				showConfirmButton : true,
				type : 'error'
			});
		});
	}
	
///////////////// ******** ----						END change							------ ************ //////////////////

};