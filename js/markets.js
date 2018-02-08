/*jslint plusplus: true, devel: true, nomen: true, indent: 4, maxerr: 50 */ 
/*global define, $, jQuery, swal */
/*jslint browser: true*/
var markets = {

///////////////// ******** ----							 view_new						------ ************ //////////////////
//////// Load the view to new markets
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		
	view_new : function($objet){
		"use strict";
		console.log('==========> $objet view_new', $objet);
		
		$.ajax({
			data : $objet,
			url : 'ajax.php?c=markets&f=view_new',
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
	
///////////////// ******** ----						END view_new						------ ************ //////////////////

///////////////// ******** ----						list_markets						------ ************ //////////////////
//////// Load the view to new markets
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		
	list_markets : function($objet){
		"use strict";
		console.log('==========> $objet list_markets', $objet);
		
		$.ajax({
			data : $objet,
			url : 'ajax.php?c=markets&f=list_markets',
			type : 'post',
			dataType : 'html'
		}).done(function(resp) {
			console.log('==========> done list_markets', resp);
			
			$("#"+$objet.div).html(resp);
		}).fail(function(resp) {
			console.log('==========> fail !!! list_markets', resp);
			
			swal({
				title : 'Error',
				text : 'A ocurrido un error al cargar los datos',
				timer : 5000,
				showConfirmButton : true,
				type : 'error'
			});
		});
	},
	
///////////////// ******** ----						END list_markets					------ ************ //////////////////

///////////////// ******** ----						list_cats							------ ************ //////////////////
//////// Load the categories view
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		
	list_cats : function($objet){
		"use strict";
		console.log('==========> $objet list_cats', $objet);
		
		$.ajax({
			data : $objet,
			url : 'ajax.php?c=markets&f=list_cats',
			type : 'post',
			dataType : 'html'
		}).done(function(resp) {
			console.log('==========> done list_cats', resp);
			
			$("#"+$objet.div).html(resp);
		}).fail(function(resp) {
			console.log('==========> fail !!! list_cats', resp);
			
			swal({
				title : 'Error',
				text : 'A ocurrido un error al cargar los datos',
				timer : 5000,
				showConfirmButton : true,
				type : 'error'
			});
		});
	}
	
///////////////// ******** ----						END list_cats						------ ************ //////////////////

};