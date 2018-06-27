/*jslint plusplus: true, devel: true, nomen: true, indent: 4, maxerr: 50 */ 
/*global define, $, jQuery, swal */
/*jslint browser: true*/
var users = {
///////////////// ******** ----							 view_profile					------ ************ //////////////////
//////// Loaded the view profile
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		// mail -> User mail
		
	view_profile : function($objet){
		"use strict";
		console.log('==========> $objet view_profile', $objet);
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		$("#collapseExample").removeClass("show");
		
		$.ajax({
			data : $objet,
			url : 'ajax.php?c=users&f=view_profile',
			type : 'get',
			dataType : 'html'
		}).done(function(resp) {
			$("#"+$objet.div).html(resp);
		}).fail(function(resp) {
			console.log('==========> fail !!! add', resp);
			
			swal({
				title : 'Error',
				text : 'No se puede cargar la vista',
				timer : 5000,
				showConfirmButton : true,
				type : 'error'
			});
		});
	},

///////////////// ******** ----						END view_profile					------ ************ //////////////////

///////////////// ******** ----						view_gafette						------ ************ //////////////////
//////// Loaded the view gafette
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		// mail -> User mail
		
	view_gafette : function($objet){
		"use strict";
		console.log('==========> $objet view_gafette', $objet);
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
		$.ajax({
			data : $objet,
			url : 'ajax.php?c=users&f=view_gafette',
			type : 'get',
			dataType : 'html'
		}).done(function(resp) {
			$("#"+$objet.div).html(resp);
		}).fail(function(resp) {
			console.log('==========> fail !!! add', resp);
			
			swal({
				title : 'Error',
				text : 'No se puede cargar la vista',
				timer : 5000,
				showConfirmButton : true,
				type : 'error'
			});
		});
	},

///////////////// ******** ----						END view_gafette					------ ************ //////////////////

///////////////// ******** ----						view_insurance_policy				------ ************ //////////////////
//////// Loaded the insurance policy view
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		// mail -> User mail
		
	view_insurance_policy : function($objet){
		"use strict";
		console.log('==========> $objet view_insurance_policy', $objet);
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
		$.ajax({
			data : $objet,
			url : 'ajax.php?c=users&f=view_insurance_policy',
			type : 'post',
			dataType : 'html'
		}).done(function(resp) {
			$("#"+$objet.div).html(resp);
		}).fail(function(resp) {
			console.log('==========> fail !!! add', resp);
			
			swal({
				title : 'Error',
				text : 'No se puede cargar la vista',
				timer : 5000,
				showConfirmButton : true,
				type : 'error'
			});
		});
		
		$("#"+$objet.div).html('<iframe id="the_frame" src="ajax.php?c=users&f=view_insurance_policy&mail='+$objet.mail+'" style="width: 100%; height: 100vh; margin-bottom: 50px"></iframe>');
	},

///////////////// ******** ----						END view_insurance_policy			------ ************ //////////////////

///////////////// ******** ----							 list_clients					------ ************ //////////////////
//////// Check the clients and return into a view
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		// tianguis_id -> Tianguis ID
		
	list_clients : function($objet){
		"use strict";
		console.log('==========> $objet list_clients', $objet);
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
		$.ajax({
			data : $objet,
			url : 'ajax.php?c=users&f=list_clients',
			type : 'get',
			dataType : 'html'
		}).done(function(resp) {
			$("#"+$objet.div).html(resp);
		}).fail(function(resp) {
			console.log('==========> fail !!! list_clients', resp);
			
			swal({
				title : 'Error',
				text : 'No se puede cargar la vista',
				timer : 5000,
				showConfirmButton : true,
				type : 'error'
			});
		});
	},

///////////////// ******** ----						END list_clients					------ ************ //////////////////

///////////////// ******** ----						update_x_tianguis					------ ************ //////////////////
//////// Update the client infomation
	// The parameters that can receive are:
		// client_id -> Client ID
		// status -> Status to change
		// tianguis_id -> Tianguis ID
		
	update_x_tianguis : function($objet){
		"use strict";
		console.log('==========> $objet update_x_tianguis', $objet);
		
		$.ajax({
			data : $objet,
			url : 'ajax.php?c=users&f=update_x_tianguis',
			type : 'get',
			dataType : 'json'
		}).done(function(resp) {
			
			swal({
				title : 'Cambios guardados',
				text : 'Los cambios han sido guardados con exito',
				timer : 5000,
				showConfirmButton : true,
				type : 'success'
			});
			
			users.list_clients({
				tianguis_id: $objet.tianguis_id,
				div: 'contenedor'
			});
		}).fail(function(resp) {
			console.log('==========> fail !!! update_x_tianguis', resp);
			
			swal({
				title : 'Error',
				text : 'Error al editar el cliente',
				timer : 5000,
				showConfirmButton : true,
				type : 'error'
			});
		});
	},

///////////////// ******** ----						END update_x_tianguis				------ ************ //////////////////

///////////////// ******** ----							 add							------ ************ //////////////////
//////// Loaded the view to sing up user	
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		
	add : function($objet){
		"use strict";
		console.log('==========> $objet add', $objet);
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		$("#collapseExample").removeClass("show");
		
		$.ajax({
			data : $objet,
			url : 'ajax.php?c=users&f=add',
			type : 'get',
			dataType : 'html'
		}).done(function(resp) {
			$("#"+$objet.div).html(resp);
		}).fail(function(resp) {
			console.log('==========> fail !!! add', resp);
			
			swal({
				title : 'Error',
				text : 'No se puede cargar la vista',
				timer : 5000,
				showConfirmButton : true,
				type : 'error'
			});
		});
	},

///////////////// ******** ----						END add							------ ************ //////////////////

///////////////// ******** ----							save							------ ************ //////////////////
//////// Save the salon data
	// The parameters that can receive are:
		// form -> Form ID with the data

	save : function($objet) {
		"use strict";
		console.log('==========> $objet add', $objet);
	
	// Data
		var formData = new FormData(document.getElementById($objet.form));
		
		$("#"+$objet.form).find(':input').each(function(key, value){
			var id = value.id;
			if(id){
				formData.append(id, $("#"+id).val());
			}
		});

		console.log("===========> FormData", formData);
		
		$.ajax({
			url: 'ajax.php?c=users&f=save',
			type: "post",
			cache: false,
			contentType: false,
			processData: false,
			data: formData,  
			dataType: 'json'
		}).done(function(resp) {
			console.log('==========> done save', resp);
			
			switch(resp.status){
				case 1:
					swal({
						title : 'Usuario creado',
						text : 'Tu usuario ha sifo creado con exito',
						timer : 5000,
						showConfirmButton : true,
						type : 'success'
					});
					
					location.reload();
					break;
				case 2:
					swal({
						title : 'Correo no valido',
						text : 'El correo que intentas registrar ya existe',
						timer : 5000,
						showConfirmButton : true,
						type : 'warning'
					});
					break;
				default:
					swal({
						title : 'Error',
						text : 'Ocurrio un error interno que impide el registro de tu usuario',
						timer : 5000,
						showConfirmButton : true,
						type : 'error'
					});
			}
		}).fail(function(resp) {
			console.log('==========> fail save');
			console.log(resp);
			alert("Error interno");
		});
	},
	
///////////////// ******** ----						END save							------ ************ //////////////////
	
///////////////// ******** ----							 login							------ ************ //////////////////
//////// Loaded the view to sing up user	
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		
	login : function($objet){
		"use strict";
		console.log('==========> $objet login', $objet);
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		$("#collapseExample").removeClass("show");
		
		$.ajax({
			data : $objet,
			url : 'ajax.php?c=users&f=login',
			type : 'get',
			dataType : 'html'
		}).done(function(resp) {
			console.log("============> Resp HTML ", resp);

			$("#"+$objet.div).html(resp);
		}).fail(function(resp) {
			console.log('==========> fail !!! add', resp);
			
			swal({
				title : 'Error',
				text : 'No se puede cargar la vista',
				timer : 5000,
				showConfirmButton : true,
				type : 'error'
			});
		});
	},

///////////////// ******** ----						END login						------ ************ //////////////////
	
///////////////// ******** ----						signin							------ ************ //////////////////
//////// Loaded the view to sing up user	
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		
	signin : function($objet){
		"use strict";
		console.log('==========> $objet signin', $objet);
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		$("#collapseExample").removeClass("show");
		
		var data = {};

		$("#"+$objet.form).find(':input').each(function(key, value){
			var id = value.id;
			if(id){
				data[id] =  $("#"+id).val();
			}
		});

		$.ajax({
			data : data,
			url : 'ajax.php?c=users&f=signin',
			type : 'get',
			dataType : 'json'
		}).done(function(resp) {
			console.log('==========> done signin', resp);

			if (resp.status === 1) {
				location.reload();
			} else {
				swal({
					title : 'Error',
					text : 'Datos incorrectos',
					timer : 5000,
					showConfirmButton : true,
					type : 'error'
				});
			}
		}).fail(function(resp) {
			console.log('==========> fail !!! add', resp);
			
			swal({
				title : 'Error',
				text : 'No se puede cargar la vista',
				timer : 5000,
				showConfirmButton : true,
				type : 'error'
			});
		});
	}

///////////////// ******** ----						END add							------ ************ //////////////////
	
};