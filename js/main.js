/*jslint plusplus: true, devel: true, nomen: true, indent: 4, maxerr: 50 */ 
/*global define, $, jQuery, swal */
/*jslint browser: true*/
var main = {
///////////////// ******** ----							 load_terms					------ ************ //////////////////
//////// Loaded the view profile
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		
	load_terms : function($objet){
		"use strict";
		console.log('==========> $objet load_terms', $objet);
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
		$.ajax({
			data : $objet,
			url : 'terminos.html',
			type : 'get',
			dataType : 'html'
		}).done(function(resp) {
			$("#"+$objet.div).html(resp);
		}).fail(function(resp) {
			console.log('==========> fail !!! load_privacy', resp);
			
			swal({
				title : 'Error',
				text : 'No se puede cargar la vista',
				timer : 5000,
				showConfirmButton : true,
				type : 'error'
			});
		});
	},

///////////////// ******** ----						END load_terms						------ ************ //////////////////

///////////////// ******** ----						load_privacy						------ ************ //////////////////
//////// Loaded the view profile
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		
	load_privacy : function($objet){
		"use strict";
		console.log('==========> $objet load_privacy', $objet);
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
		$.ajax({
			data : $objet,
			url : 'aviso.html',
			type : 'get',
			dataType : 'html'
		}).done(function(resp) {
			$("#"+$objet.div).html(resp);
		}).fail(function(resp) {
			console.log('==========> fail !!! load_privacy', resp);
			
			swal({
				title : 'Error',
				text : 'No se puede cargar la vista',
				timer : 5000,
				showConfirmButton : true,
				type : 'error'
			});
		});
	}

///////////////// ******** ----						END load_privacy					------ ************ //////////////////

};