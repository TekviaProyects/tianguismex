/*jslint plusplus: true, devel: true, nomen: true, indent: 4, maxerr: 50 */ 
/*global define, $, jQuery, swal */
/*jslint browser: true*/
var reports = {
///////////////// ******** ----							 view_periodic					------ ************ //////////////////
//////// Load a report periodic view
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		
	view_periodic : function($objet){
		"use strict";
		console.log('==========> $objet view_periodic', $objet);
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
		$.ajax({
			data : $objet,
			url : 'ajax.php?c=reports&f=view_periodic',
			type : 'get',
			dataType : 'html'
		}).done(function(resp) {
			$("#"+$objet.div).html(resp);
		}).fail(function(resp) {
			console.log('==========> fail !!! view_periodic', resp);
			
			swal({
				title : 'Error',
				text : 'No se puede cargar la vista',
				timer : 5000,
				showConfirmButton : true,
				type : 'error'
			});
		});
	},

///////////////// ******** ----						END view_periodic					------ ************ //////////////////

///////////////// ******** ----						list_periodic						------ ************ //////////////////
//////// Check the periodic report data and load a view
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		// range -> Range of dates
		// tianguis_id -> Tianguis ID
		
	list_periodic : function($objet){
		"use strict";
		console.log('==========> $objet list_periodic', $objet);
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
		$.ajax({
			data : $objet,
			url : 'ajax.php?c=reports&f=list_periodic',
			type : 'get',
			dataType : 'html'
		}).done(function(resp) {
			$("#"+$objet.div).html(resp);
		}).fail(function(resp) {
			console.log('==========> fail !!! view_periodic', resp);
			
			swal({
				title : 'Error',
				text : 'No se puede cargar la vista',
				timer : 5000,
				showConfirmButton : true,
				type : 'error'
			});
		});
	}

///////////////// ******** ----						END list_periodic					------ ************ //////////////////

};