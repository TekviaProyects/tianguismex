// JavaScript Validation For Registration Page

// name validation
var nameregex = /^[a-zA-Z ]+$/;

$.validator.addMethod("validname", function(value, element) {
	return this.optional(element) || nameregex.test(value);
});

// valid mail pattern
var eregex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

$.validator.addMethod("validmail", function(value, element) {
	return this.optional(element) || eregex.test(value);
});

var re = /^[\d]{10}$/;

$.validator.addMethod("validtel", function(value, element) {
	return this.optional(element) || re.test(value);
});

$("#register-form").validate({
	rules : {
		name : {
			required : true,
			validname : true,
			minlength : 4
		},
		mail : {
			required : true,
			validmail : true
		},
		tel : {
			validtel : true
		},
		last_name : {
			required : true,
			minlength : 1,
			maxlength : 30
		},
		period : {
			required : true
		},
		period2 : {
			required : true
		},
		surface : {
			required : true
		},
		schedule_ini : {
			required : true
		},
		schedule_end : {
			required : true
		}
	},
	messages : {
		name : {
			required : "Escribe el nombre",
			validname : "Debe contener solo letras, numeros o espacios",
			minlength : "Nombre demaciado corto"
		},
		mail : {
			required : "Escribe tu correo",
			validmail : "Correo no valido"
		},
		tel : {
			validtel : "Telefono no valido"
		},
		last_name : {
			required : "Apellido no valido"
		},
		period : {
			required : "Periodo no valido"
		},
		period2 : {
			required : "Periodo no valido"
		},
		surface : {
			required : "Metros no validos"
		},
		schedule_ini : {
			required : "Horario no valido"
		},
		schedule_end : {
			required : "Horario no valido"
		}
	},
	errorPlacement : function(error, element) {
		$(element).closest('.form-group').find('.help-block').html(error.html());
	},
	highlight : function(element) {
		$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
	},
	unhighlight : function(element, errorClass, validClass) {
		$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
		$(element).closest('.form-group').find('.help-block').html('');
	},

	submitHandler : function(form) {
		console.log("=========> Sumit");
		
		customers.save({form: 'register-form', edit: customers.edit});
	}
});