/*jslint plusplus: true, devel: true, nomen: true, indent: 4, maxerr: 50 */ 
/*global define, $, jQuery, swal, local */
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
	},
	
///////////////// ******** ----						END list_cats						------ ************ //////////////////

///////////////// ******** ----						list_local							------ ************ //////////////////
//////// Load the local view
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		// tianguis_id -> Tianguis ID
		// cat -> Categori ID
		
	list_local : function($objet){
		"use strict";
		console.log('==========> $objet list_local', $objet);
		
		if($objet.validate_date){
			if($objet.date === ""){
				swal({
					title : 'Fecha no valida',
					text : 'Necesitas seleccionar una fecha valida',
					timer : 5000,
					showConfirmButton : true,
					type : 'warning'
				});
				
				$('#month').focus();
				
				return;
			}
		}
		
		$.ajax({
			data : $objet,
			url : 'ajax.php?c=markets&f=list_local',
			type : 'post',
			dataType : 'html'
		}).done(function(resp) {
			console.log('==========> done list_local', resp);
			
			local.selects = {};
			
			$("#"+$objet.div).html(resp);
		}).fail(function(resp) {
			console.log('==========> fail !!! list_local', resp);
			
			swal({
				title : 'Error',
				text : 'A ocurrido un error al cargar los datos',
				timer : 5000,
				showConfirmButton : true,
				type : 'error'
			});
		});
	},
	
///////////////// ******** ----						END list_local						------ ************ //////////////////

///////////////// ******** ----						view_account_status					------ ************ //////////////////
//////// Load the account status view
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		// tianguis_id -> Tianguis ID
		
	view_account_status : function($objet){
		"use strict";
		console.log('==========> $objet view_account_status', $objet);
		
		$.ajax({
			data : $objet,
			url : 'ajax.php?c=markets&f=view_account_status',
			type : 'get',
			dataType : 'html'
		}).done(function(resp) {
			console.log('==========> done view_account_status', resp);
			
			$("#"+$objet.div).html(resp);
		}).fail(function(resp) {
			console.log('==========> fail !!! view_account_status', resp);
			
			swal({
				title : 'Error',
				text : 'A ocurrido un error al cargar los datos',
				timer : 5000,
				showConfirmButton : true,
				type : 'error'
			});
		});
	},
	
///////////////// ******** ----						END view_account_status				------ ************ //////////////////

///////////////// ******** ----						account_status						------ ************ //////////////////
//////// Load the account status
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		// tianguis_id -> Tianguis ID
		// range -> Dates range
		
	account_status : function($objet){
		"use strict";
		console.log('==========> $objet account_status', $objet);
		
		$.ajax({
			data : $objet,
			url : 'ajax.php?c=markets&f=account_status',
			type : 'get',
			dataType : 'html'
		}).done(function(resp) {
			console.log('==========> done account_status', resp);
			
			$("#"+$objet.div).html(resp);
		}).fail(function(resp) {
			console.log('==========> fail !!! account_status', resp);
			
			swal({
				title : 'Error',
				text : 'A ocurrido un error al cargar los datos',
				timer : 5000,
				showConfirmButton : true,
				type : 'error'
			});
		});
	},
	
///////////////// ******** ----						END account_status					------ ************ //////////////////

///////////////// ******** ----						view_commissions					------ ************ //////////////////
//////// Load the commisssions view
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		// tianguis_id -> Tianguis ID
		
	view_commissions : function($objet){
		"use strict";
		console.log('==========> $objet view_commissions', $objet);
		
		$.ajax({
			data : $objet,
			url : 'ajax.php?c=markets&f=view_commissions',
			type : 'get',
			dataType : 'html'
		}).done(function(resp) {
			console.log('==========> done view_commissions', resp);
			
			$("#"+$objet.div).html(resp);
		}).fail(function(resp) {
			console.log('==========> fail !!! view_commissions', resp);
			
			swal({
				title : 'Error',
				text : 'A ocurrido un error al cargar los datos',
				timer : 5000,
				showConfirmButton : true,
				type : 'error'
			});
		});
	}
	
///////////////// ******** ----						END view_commissions				------ ************ //////////////////

};