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
	}

///////////////// ******** ----						END view_insurance_policy			------ ************ //////////////////

};