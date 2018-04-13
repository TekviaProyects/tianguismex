/*jslint plusplus: true, devel: true, nomen: true, indent: 4, maxerr: 50 */ 
/*global define, $, jQuery, swal, local */
/*jslint browser: true*/
var markets = {
// Initialize vars
	total_selected: 0,
	selects : {},
	joins : {},

///////////////// ******** ----							 view_new						------ ************ //////////////////
//////// Load the view to new markets
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		
	view_new : function($objet){
		"use strict";
		console.log('==========> $objet view_new', $objet);
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
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
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
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
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
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
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
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
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
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
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
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
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
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
	},
	
///////////////// ******** ----						END view_commissions				------ ************ //////////////////

///////////////// ******** ----						modify_order						------ ************ //////////////////
//////// Load the view to modify order
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		// order_id -> Order ID
		
	modify_order : function($objet){
		"use strict";
		console.log('==========> $objet modify_order', $objet);
		
	// Hide menu on mobile and modal details
		$("#wrapper").removeClass("toggled");
		
		$.ajax({
			data : $objet,
			url : 'ajax.php?c=markets&f=modify_order',
			type : 'post',
			dataType : 'html'
		}).done(function(resp) {
			console.log('==========> done modify_order', resp);
			
			local.total_selected = 0;
			local.selects = {};
			local.total = 0;
			
			$("#"+$objet.div).html(resp);
		}).fail(function(resp) {
			console.log('==========> fail !!! modify_order', resp);
			
			swal({
				title : 'Error',
				text : 'A ocurrido un error al cargar los datos',
				timer : 5000,
				showConfirmButton : true,
				type : 'error'
			});
		});
	},
	
///////////////// ******** ----						END modify_order					------ ************ //////////////////

///////////////// ******** ----							 view_login						------ ************ //////////////////
//////// Load the login view.
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		
	view_login : function($objet){
		"use strict";
		console.log('==========> $objet view_login', $objet);
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
		$.ajax({
			data : $objet,
			url : 'ajax.php?c=markets&f=view_login',
			type : 'post',
			dataType : 'html'
		}).done(function(resp) {
			console.log('==========> done view_login', resp);
			
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
	
///////////////// ******** ----						END view_login						------ ************ //////////////////

///////////////// ******** ----						logout								------ ************ //////////////////
//////// Log out session
	// The parameters that can receive are:
		
	logout : function($objet){
		"use strict";
		console.log('==========> $objet logout', $objet);
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
		$.ajax({
			data : $objet,
			url : 'ajax.php?c=markets&f=logout',
			type : 'post',
			dataType : 'json',
			async : false
		}).done(function(resp) {
			console.log('==========> done logout', resp);
			
			location.reload();
		}).fail(function(resp) {
			console.log('==========> fail !!! logout', resp);
			
			swal({
				title : 'Error',
				text : 'A ocurrido un error al cerrar la sesión',
				timer : 5000,
				showConfirmButton : true,
				type : 'error'
			});
		});
	},
	
///////////////// ******** ----						END logout							------ ************ //////////////////

///////////////// ******** ----						view_profile						------ ************ //////////////////
//////// Load the profile view.
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		
	view_profile : function($objet){
		"use strict";
		console.log('==========> $objet view_profile', $objet);
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		$("#collapseExample").removeClass("show");
		
		$.ajax({
			data : $objet,
			url : 'ajax.php?c=markets&f=view_profile',
			type : 'post',
			dataType : 'html'
		}).done(function(resp) {
			console.log('==========> done view_login', resp);
			
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
	
///////////////// ******** ----						END view_login						------ ************ //////////////////

///////////////// ******** ----							 view_sketch					------ ************ //////////////////
//////// Load the view to sketch
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		// tianguis_id -> Tianguis ID
		
	view_sketch : function($objet){
		"use strict";
		console.log('==========> $objet view_sketch', $objet);
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
		$.ajax({
			data : $objet,
			url : 'ajax.php?c=markets&f=view_sketch',
			type : 'post',
			dataType : 'html'
		}).done(function(resp) {
			console.log('==========> done view_sketch', resp);
			
			markets.selects = {};
			markets.joins = {};
			markets.total_selected = 0;
			$("#"+$objet.div).html(resp);
		}).fail(function(resp) {
			console.log('==========> fail !!! view_sketch', resp);
			
			swal({
				title : 'Error',
				text : 'A ocurrido un error al cargar los datos',
				timer : 5000,
				showConfirmButton : true,
				type : 'error'
			});
		});
	},
	
///////////////// ******** ----						END view_sketch						------ ************ //////////////////

///////////////// ******** ----						draw_sketch							------ ************ //////////////////
//////// Draw a sketch pre view.
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		// cat_id -> Category ID
		// x -> Num of columns
		// y -> Num of rows
		
	draw_sketch : function($objet){
		"use strict";
		console.log('==========> $objet draw_sketch', $objet);
		
	// Clean vars
		markets.selects = {};
		markets.joins = {};
		markets.total_selected = 0;
		
		var html = '<table id="table_sketch"><tr>',
			x = parseInt($objet.x, 10) || 0,
			y = parseInt($objet.y, 10) || 0,
			num_rows = x * y,
			column = 1,
			row = 1,
			i = 1;
		
		if(x <= 0 || y <= 0){
			swal({
				title : 'Numero no valido',
				text : 'El numero de filas o columnas no es valido',
				timer : 7000,
				showConfirmButton : true,
				type : 'warning'
			});
			
			return;
		}
		
		$("#btn_save_croquis").show();
		$("#btn_update_croquis").hide();
		
		for (i = 1; i <= num_rows; i++) {
			if(column > x){
				column = 1;
				row ++;
				html += '</tr>';
				html += '<tr id="tr_'+row+'">';
			} 
			
			html += '<td '+
						'colspan="1" '+
						'style="border: 1px solid; border-color: white" '+
						'cat_id="'+$objet.cat_id+'" '+
						'local_id="'+i+'" '+
						'align="center" '+
						'id="td_'+i+'"  '+
						'x="'+column+'" '+
						'y="'+row+'">'+
						'<button '+
							'local_id="'+i+'" '+
							'cat_id="'+$objet.cat_id+'" '+
							'id="btn_'+i+'" '+
							'x="'+column+'" '+
							'y="'+row+'"'+
							'show="1" '+
							'onclick="markets.select_local({ '+
								'id: '+i+', '+
								'y: '+row+', '+
								'x: '+column+', '+
								'text: $(this).html(), '+
								'cat_id: \''+$objet.cat_id+'\''+
							'})" '+
							'class="btn btn-block btn-default btn-sm local">'+
							i+
						'</button> '+
						'<button '+
							'id="btn_edit_'+i+'" '+
							'data-toggle="modal" '+
							'data-target="#modal_edit" '+
							'onclick="'+
								'$(\'#btn_edit\').attr(\'local_id\', '+i+'); '+
								'$(\'#select_cat_id\').val($(\'#btn_'+i+'\').attr(\'cat_id\')); '+
								'$(\'#edit_text\').val($(\'#btn_'+i+'\').html()); '+
							'"'+
							'class="btn btn-block btn-primary btn-sm btn_edit">'+
							'<i class="fa fa-pencil"></i> '+
						'</button> '+
					'</td>';
			
			column++;
		}
	
	// Write HTML
		html += '</tr></table>';
		$("#"+$objet.div).html(html);
		$('.btn_edit').hide();
	},
	
///////////////// ******** ----						END draw_sketch						------ ************ //////////////////

///////////////// ******** ----						edit_local							------ ************ //////////////////
//////// Edit the text button local.
	// The parameters that can receive are:
		// id -> Local ID
		// text -> Text to change
		// cat_id -> Category ID
		
	edit_local : function($objet){
		"use strict";
		console.log('==========> $objet edit_local', $objet);
		
		$("#btn_"+$objet.id).show();
		$("#btn_"+$objet.id).attr("show", 1);
		$("#btn_"+$objet.id).html($objet.text);
		$("#btn_"+$objet.id).attr('cat_id', $objet.cat_id);
		
		$("#modal_edit").modal('hide');
		$("#edit_text").val('');
		
		if(markets.selects[$objet.id]){
			markets.selects[$objet.id].text = $objet.text;
			console.log('==========> selects', markets.selects[$objet.id]);
		}
		
		if(markets.joins[$objet.id]){
			$.each(markets.joins[$objet.id], function(index, value){
				markets.joins[$objet.id][index].text = $objet.text;
				$("#btn_"+value.id).html($objet.text);
			});
		}
	},
	
///////////////// ******** ----						END edit_local						------ ************ //////////////////

///////////////// ******** ----						select_local						------ ************ //////////////////
//////// Add or remove item from locals
	// The parameters that can receive are:
		// id -> Local ID
		// text -> Text button local
		// x -> Column
		// y -> Row
								
	select_local : function($objet){
		"use strict";
		console.log('==========> $objet select_local', $objet);
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
		if(markets.selects[$objet.id]){
			delete markets.selects[$objet.id];
			markets.total_selected --;
			
			$("#btn_"+$objet.id).removeClass("btn-info").addClass("btn-default");
		}else{
			markets.selects[$objet.id] = $objet;
			markets.total_selected ++;
			
			$("#btn_"+$objet.id).removeClass("btn-default").addClass("btn-info");
		}
		
		console.log('==========> total_selected', markets.total_selected);
		console.log('==========> selects', markets.selects);
	},
	
///////////////// ******** ----						END select_local					------ ************ //////////////////

///////////////// ******** ----						free_spaces							------ ************ //////////////////
//////// Hide the local and delete from array
	// The parameters that can receive are:
		
	free_spaces : function($objet){
		"use strict";
		console.log('==========> $objet free_spaces', $objet);
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
		if(jQuery.isEmptyObject(markets.selects)){
			swal({
				title : 'Locales no validos',
				text : 'Aun no has seleccionado ningun local',
				timer : 5000,
				showConfirmButton : true,
				type : 'warning'
			});
			
			return;
		}
	
	// Hide buttons
		$.each(markets.selects, function(index, value) {
			if(markets.joins[value.id]){
				$.each(markets.joins[value.id], function(i, v){
					console.log(v);
					
					$("#btn_"+v.id).attr("show", 1);
					$("#btn_"+v.id).html(v.original_text);
					$("#btn_"+v.id).prop("disabled", false);	
					$("#btn_edit_"+v.id).prop("disabled", false);
				});
				
				delete markets.joins[value.id];
			}
			
			$("#btn_"+value.id).hide();
			$("#btn_edit_"+value.id).prop("disabled", true);
			$("#btn_"+value.id).attr("show", 0);
			$("#td_"+value.id).css('min-width', '25px');
		});
	
	// Clean array
		markets.selects = {};
	},
	
///////////////// ******** ----						END free_spaces						------ ************ //////////////////

///////////////// ******** ----						join_local							------ ************ //////////////////
//////// Add or remove item from locals
	// The parameters that can receive are:
	
	join_local : function($objet){
		"use strict";
		console.log('==========> $objet join_local', $objet);
		
		var sort_array = {},
			local = {},
			text = '',
			init = 1;
		
	// Hide menu on mobile
		$("#wrapper").removeClass("toggled");
		
		if(jQuery.isEmptyObject(markets.selects)){
			swal({
				title : 'Locales no validos',
				text : 'Aun no has seleccionado ningun local',
				timer : 5000,
				showConfirmButton : true,
				type : 'warning'
			});
			
			return;
		}
		
	// Sort array
		sort_array = {
			"items": [markets.selects]
		};
		sort_array = sort_array.items.sort(function(a, b) {return a.id - b.id;});
		sort_array = sort_array[0];
		
		$.each(sort_array, function(index, value) {
			if(init === 1){
				init = 0;
				local = value;
				if(!markets.joins[value.id]){
					markets.joins[value.id] = {};
				}
				$("#btn_"+value.id).removeClass("btn-info").addClass("btn-default");
			}else{
				value.original_text = value.text;
				markets.joins[local.id][value.id] = value;
				
				$("#btn_"+value.id).html(local.text);
				$("#btn_"+value.id).prop("disabled", true);	
				$("#btn_edit_"+value.id).prop("disabled", true);
				$("#btn_"+value.id).removeClass("btn-info").addClass("btn-default");
			}
		});
	
	// Validate that no have only one local
		if(jQuery.isEmptyObject(markets.joins[local.id])){
			delete markets.joins[local.id];
		}
		
		console.log("===========>", markets.joins);
		
	// Clean array
		markets.selects = {};
	},
	
///////////////// ******** ----						END join_local						------ ************ //////////////////

///////////////// ******** ----						save_sketch							------ ************ //////////////////
//////// Save the locals on the DB
	// The parameters that can receive are:
								
	save_sketch : function($objet){
		"use strict";
		console.log('==========> $objet save_sketch', $objet);
		var data = $objet || {},
			sort_array = {},
			local = {},
			local = {},
			error = 0;
		
		$('#'+$objet.btn).prop('disabled', true);
		$('#'+$objet.btn).html('Guardando...');
		
		setTimeout(function(){
			$.ajax({
				data : $objet,
				url : 'ajax.php?c=markets&f=update_local',
				type : 'post',
				dataType : 'json',
				async: false
			}).done(function(resp) {
				console.log('==========> done delete', resp);
				
				$(".local").each(function(index, value){
					var data = {};
					data.x = $(this).attr("x");
					data.y = $(this).attr("y");
					data.text = $(this).html();
					data.show = $(this).attr("show");
					data.id = $(this).attr("local_id");
					data.cat_id = $(this).attr("cat_id");
					data.disabled = $(this).prop("disabled");
					data.disabled = (data.disabled) ? 1 : 0;
					
					if(!jQuery.isEmptyObject(markets.joins[data.id])){
						data.joins = markets.joins[data.id];
					}
					
					local[data.id] = data;
				});
				
			// Sort array
				sort_array = {
					"items": [local]
				};
				sort_array = sort_array.items.sort(function(a, b) {return a.y - b.y;});
				sort_array = sort_array[0];
				
				$.each(sort_array, function(index, value) {
					$.ajax({
						data : value,
						url : 'ajax.php?c=markets&f=save_sketch',
						type : 'post',
						dataType : 'json',
						async: false
					}).done(function(resp) {
						console.log('==========> done save_sketch', resp);
						
						
					}).fail(function(resp) {
						console.log('==========> fail !!! save_sketch', resp);
						
						error = 1;
					});
				});
				
				if(error === 0){
					swal({
						title : 'Croquis creado',
						text : 'El croquis de tu tianguis ha sido creado con exito',
						timer : 5000,
						showConfirmButton : true,
						type : 'success'
					});
				}else{
					swal({
						title : 'Error',
						text : 'A ocurrido un error al guardar el croquis',
						timer : 5000,
						showConfirmButton : true,
						type : 'error'
					});
				}
				
				$('#'+$objet.btn).prop('disabled', false);
				$('#'+$objet.btn).html('Guardar');
			}).fail(function(resp) {
				console.log('==========> fail !!! save_sketch', resp);
				
				error = 1;
			});
		}, 500);
	},
	
///////////////// ******** ----						END save_sketch						------ ************ //////////////////

///////////////// ******** ----						save_category						------ ************ //////////////////
//////// Save a tianguis category
	// The parameters that can receive are:
		// name -> Name of the category
		// cost -> Cost of the category
		// description -> Description of the category
			
	save_category  : function($objet){
		"use strict";
		console.log('==========> $objet save_category ', $objet);
		
		if($objet.name === ""){
			swal({
				title : 'Nombre no valido',
				text : 'El nombre de la caategoria no debe estar vacio',
				timer : 5000,
				showConfirmButton : true,
				type : 'warning'
			});
			
			return;
		}
		
		if(parseFloat($objet.cost) <= 0){
			swal({
				title : 'Costo no valido',
				text : 'El costo de la caategoria debe ser mayor a cero',
				timer : 5000,
				showConfirmButton : true,
				type : 'warning'
			});
			
			return;
		}
		
		$.ajax({
			data : $objet,
			url : 'ajax.php?c=markets&f=save_category',
			type : 'post',
			dataType : 'json'
		}).done(function(resp) {
			console.log('==========> done save_category', resp);
			
			$("#modal_add_cat").modal('hide');
			$("#select_cat_id").append('<option value="'+resp.id+'">'+$objet.name+'</option>');
			
			swal({
				title : 'Categoria creada',
				text : 'La categoria ha sido creada con exito',
				timer : 5000,
				showConfirmButton : true,
				type : 'success'
			});
		}).fail(function(resp) {
			console.log('==========> fail !!! save_category', resp);
			
			swal({
				title : 'Error',
				text : 'A ocurrido un error al guardar la categoria',
				timer : 5000,
				showConfirmButton : true,
				type : 'error'
			});
		});
	},
	
///////////////// ******** ----						END save_category					------ ************ //////////////////

///////////////// ******** ----						update_sketch						------ ************ //////////////////
//////// Update the locals on the DB
	// The parameters that can receive are:
	
	update_sketch : function($objet){
		"use strict";
		console.log('==========> $objet save_sketch', $objet);
		var local = {},
			data = $objet || {},
			error = 0;
		
		$('#'+$objet.btn).prop('disabled', true);
		$('#'+$objet.btn).html('Actualizando...');
		
		setTimeout(function(){
			$(".local").each(function(index, value){
				data = {};
				data.x = $(this).attr("x");
				data.y = $(this).attr("y");
				data.text = $(this).html();
				data.new = $(this).attr("new");
				data.show = $(this).attr("show");
				data.id = $(this).attr("local_id");
				data.cat_id = $(this).attr("cat_id");
				data.disabled = $(this).prop("disabled");
				data.disabled = (data.disabled) ? 1 : 0;
				
				if(!jQuery.isEmptyObject(markets.joins[data.id])){
					data.joins = markets.joins[data.id];
				}
				
				$.ajax({
					data : data,
					url : 'ajax.php?c=markets&f=update_sketch',
					type : 'post',
					dataType : 'json',
					async: false
				}).done(function(resp) {
					console.log('==========> done save_sketch', resp);
					
				}).fail(function(resp) {
					console.log('==========> fail !!! save_sketch', resp);
					
					error = 1;
				});
			});
			
			if(error === 0){
				swal({
					title : 'Croquis actualizado',
					text : 'El croquis de tu tianguis ha sido actualizado con exito',
					timer : 5000,
					showConfirmButton : true,
					type : 'success'
				});
			}else{
				swal({
					title : 'Error',
					text : 'A ocurrido un error al actualizar el croquis',
					timer : 5000,
					showConfirmButton : true,
					type : 'error'
				});
			}
			
			$('#'+$objet.btn).prop('disabled', false);
			$('#'+$objet.btn).html('Actualizar');
		}, 500);
	},
	
///////////////// ******** ----						END update_sketch					------ ************ //////////////////

///////////////// ******** ----						add_rows							------ ************ //////////////////
//////// Add rows to the table
	// The parameters that can receive are:
		// num -> Num the rows to add
		
	add_rows : function($objet){
		"use strict";
		console.log('==========> $objet add_rows', $objet);
	
	// Calculate the max ID
		var count = 0,
			id = 0;
		$(".local").each(function(indes, value){
			id = parseInt($(this).attr('local_id'), 10);
			
			if(id > count){
				count = id;
			}
		});
		
		var x = parseInt($("#btn_"+count).attr('x'), 10),
			y = parseInt($("#btn_"+count).attr('y'), 10),
			num_rows = parseInt($objet.num, 10) || 0,
			cat_id = $('#select_cat_id').val(),
			html = '',
			row = 1;
		
		console.log("=======> Vars ", count, id, x, y, num_rows, cat_id, row);
		
		if(num_rows <= 0){
			swal({
				title : 'Numero de filas no valido',
				text : 'El numero de filas debe ser mayor a 0',
				timer : 5000,
				showConfirmButton : true,
				type : 'warning'
			});
			
			return;
		}
		
		count ++;
		y ++;
		for (var i = 0; i < num_rows; i++) {
			html += '<tr>';
			for (var j=1; j <= x; j++) {
				html += '<td '+
							'colspan="1" '+
							'style="border: 1px solid; border-color: white" '+
							'align="center" '+
							'id="td_'+count+'"  '+
							'x="'+j+'" '+
							'y="'+y+'">'+
							'<button '+
								'local_id="'+count+'" '+
								'cat_id="'+cat_id+'" '+
								'id="btn_'+count+'" '+
								'x="'+j+'" '+
								'y="'+y+'" '+
								'show="1" '+
								'new="1" '+
								'onclick="markets.select_local({ '+
									'id: '+count+', '+
									'y: '+y+', '+
									'x: '+j+', '+
									'text: $(this).html(), '+
									'cat_id: \''+cat_id+'\''+
								'})" '+
								'class="btn btn-block btn-default btn-sm local">'+
								count+
							'</button> '+
							'<button '+
								'id="btn_edit_'+count+'" '+
								'data-toggle="modal" '+
								'data-target="#modal_edit" '+
								'onclick="'+
									'$(\'#btn_edit\').attr(\'local_id\', '+count+'); '+
									'$(\'#select_cat_id\').val($(\'#btn_'+count+'\').attr(\'cat_id\')); '+
									'$(\'#edit_text\').val($(\'#btn_'+count+'\').html()); '+
								'"'+
								'class="btn btn-block btn-primary btn-sm btn_edit">'+
								'<i class="fa fa-pencil"></i> '+
							'</button> '+
						'</td>';
				count ++;
			};
			
			html += '</tr>';
			
			row++;
			y ++;
		};
		
		$("#"+$objet.table).append(html);
		$('.btn_edit').hide();
	},
	
///////////////// ******** ----						END add_rows						------ ************ //////////////////

///////////////// ******** ----						add_columns							------ ************ //////////////////
//////// Add columns to the table
	// The parameters that can receive are:
		// num -> Num the rows to add
		
	add_columns : function($objet){
		"use strict";
		console.log('==========> $objet add_columns', $objet);
	
	// Calculate the max ID
		var count = 0,
			id = 0;
		$(".local").each(function(indes, value){
			id = parseInt($(this).attr('local_id'), 10);
			
			if(id > count){
				count = id;
			}
		});
		
		count ++;
		
		var y = parseInt($("#btn_"+count).attr('y'), 10),
			num_rows = parseInt($objet.num, 10) || 0,
			cat_id = $('#select_cat_id').val(),
			html = '',
			row = 1;
		
		if(num_rows <= 0){
			swal({
				title : 'Numero de columnas no valido',
				text : 'El numero de columnas debe ser mayor a 0',
				timer : 5000,
				showConfirmButton : true,
				type : 'warning'
			});
			
			return;
		}
		
		$("#"+$objet.table).find('tr').each(function() {
			var last = $(this).find('.local').last(),
				x = parseInt(last.attr('x'), 10) + 1,
				y = parseInt(last.attr('y'), 10);
				
			html = '<td '+
						'colspan="1" '+
						'style="border: 1px solid; border-color: white" '+
						'align="center" '+
						'id="td_'+count+'"  '+
						'x="'+x+'" '+
						'y="'+y+'">'+
						'<button '+
							'local_id="'+count+'" '+
							'cat_id="'+cat_id+'" '+
							'id="btn_'+count+'" '+
							'x="'+x+'" '+
							'y="'+y+'" '+
							'show="1" '+
							'new="1" '+
							'onclick="markets.select_local({ '+
								'id: '+count+', '+
								'y: '+y+', '+
								'x: '+x+', '+
								'text: $(this).html(), '+
								'cat_id: \''+cat_id+'\''+
							'})" '+
							'class="btn btn-block btn-default btn-sm local">'+
							count+
						'</button> '+
						'<button '+
							'id="btn_edit_'+count+'" '+
							'data-toggle="modal" '+
							'data-target="#modal_edit" '+
							'onclick="'+
								'$(\'#btn_edit\').attr(\'local_id\', '+count+'); '+
								'$(\'#select_cat_id\').val($(\'#btn_'+count+'\').attr(\'cat_id\')); '+
								'$(\'#edit_text\').val($(\'#btn_'+count+'\').html()); '+
							'"'+
							'class="btn btn-block btn-primary btn-sm btn_edit">'+
							'<i class="fa fa-pencil"></i> '+
						'</button> '+
					'</td>';
			$(this).find('td').last().after(html);
			
			count ++;
		}); 
		
		$('.btn_edit').hide();
	}
	
///////////////// ******** ----						END add_columns						------ ************ //////////////////

};