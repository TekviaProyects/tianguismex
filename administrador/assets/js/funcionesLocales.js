

function obtenerLocales( fecha , tipo , tipoLocal , callback) {
    var data;
    $.ajax({
        url: 'php/obtenerCorriente.php',
        type: 'GET',
        data: 'fecha='+fecha+'&tipoPeticion='+tipo+'&tipoLocal='+tipoLocal,
        success: function (resp) {
            data = resp;
            callback(data);
        },
        error: function () {}
    }); // ajax asynchronus request
    //the following line wouldn't work, since the function returns immediately
    //return data; // return data from the ajax request
}
var fecha = "";
var fecha1 = "";
var tipoL="";
var tipoL1="";
var tablaCorriente = $('#tablaCorriente').DataTable({
  language:{
    info:true,
    search: "",
    sLengthMenu: "_MENU_",
    searchPlaceholder: "Buscar en la tabla",
    oPaginate: {
        sPrevious: "<",
        sNext: ">"
    }
  }
});
var tablaDeudas = $('#tablaDeudas').DataTable({
  language:{
    search: "",
    sLengthMenu: "_MENU_",
    searchPlaceholder: "Buscar en la tabla",
    oPaginate: {
        sPrevious: "<",
        sNext: ">"
    }
  }
});


$('.infoLocales').popup();


var today = new Date();
$('#fechaCorriente').calendar({
  type: 'date',
  minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate()+1),
  text: {
    days: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
    months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
  },
  formatter:{
    date: function(date,settings){
      if(!date)return '';
      var day = date.getDate();
      var month = date.getMonth()+1;
      var year = date.getFullYear();
      return year + "-" + month + "-" + day;
    }
  },
  onChange: function(date , text , mode){
    fecha = text;
    $('#fechaCorriente input').css('border','1px solid rgba(34,36,38,.15)');
  }
});

$('#fechaDeuda').calendar({
  type: 'date',
  minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate()+1),
  text: {
    days: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
    months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
  },
  formatter:{
    date: function(date,settings){
      if(!date)return '';
      var day = date.getDate();
      var month = date.getMonth()+1;
      var year = date.getFullYear();
      return year + "-" + month + "-" + day;
    }
  },
  onChange: function(date , text , mode){
    fecha1 = text;
    $('#fechaDeuda input').css('border','1px solid rgba(34,36,38,.15)');
  }
});

$('#selectorCorriente').dropdown({
  onChange: function(){
    $(this).css('border','1px solid rgba(34,36,38,.15)');
    tipoL = $(this).dropdown('get value');
  }
});
$('#selectorDeuda').dropdown({
  onChange: function(){
    $(this).css('border','1px solid rgba(34,36,38,.15)');
    tipoL1 = $(this).dropdown('get value');
  }
});



$('#btnCorriente').on('click',function(){
  var control = 0;
  if(fecha == ""){
    $('#fechaCorriente input').css('border','1px solid #FF5252');
    control++;
  }
  if($('#selectorCorriente').dropdown('get value') == ''){
    $('#selectorCorriente').css('border','1px solid #FF5252');
    control++;
  }
  if(control == 0){
    obtenerLocales(fecha,1,tipoL,function(resp){
      var tipo_local = "";
      tablaCorriente.rows().remove().draw();
      $.each(JSON.parse(resp), function(idx , obj){
        if(obj.tipo_local == 1){
          tipo_local = "normal";
        }
        if(obj.tipo_local == 2){
          tipo_local = "class";
        }
        if(obj.tipo_local == 3){
          tipo_local = "ultra";
        }
        if(obj.tipo_local == 4){
          tipo_local = "super-ultra";
        }
        if(obj.tipo_local == 5){
          tipo_local = "master";
        }
        var botones = "<div class='contenedorBoton'><button type='button' name='button' class='btnMas' id='"+ obj.id_cliente +"'><i class='zoom icon'></i></button></div>";
        $('#tablaCorriente').dataTable().fnAddData([
          obj.nombre_local,
          obj.nombre_cliente,
          obj.celular_cliente,
          tipo_local,
          obj.fecha_inicio,
          botones
        ]);


      });
    });



  }

});

$('#tablaCorriente').on('click','.btnMas',function(){

  $.ajax({
    url: 'php/obtenerInfoCliente.php',
    type: 'get',
    data: 'id_cliente='+$(this).attr('id')
  }).done(function(data){
    $.each(JSON.parse(data), function(idx , obj){
      $('#nombre').html(obj.nombre_cliente);
      $('#telefono').html(obj.celular_cliente);
      $('#correo').html(obj.correo_cliente);
      $('#domicilio').html(obj.domicilio_cliente);
      $('#fotoCliente img').attr('src',"../cliente/php/archivos/"+obj.identificacion_cliente);
      $('#modalCliente').modal('show');

    });
  });
});
$('#tablaDeudas').on('click','.btnMas',function(){

  $.ajax({
    url: 'php/obtenerInfoCliente.php',
    type: 'get',
    data: 'id_cliente='+$(this).attr('id')
  }).done(function(data){
    $.each(JSON.parse(data), function(idx , obj){
      $('#nombre').html(obj.nombre_cliente);
      $('#telefono').html(obj.celular_cliente);
      $('#correo').html(obj.correo_cliente);
      $('#domicilio').html(obj.domicilio_cliente);
      $('#fotoCliente img').attr('src',"../cliente/php/archivos/"+obj.identificacion_cliente);
      $('#modalCliente').modal('show');
    });
  });
});
$('#tablaDeudas').on('click','.btnMensaje',function(){
  $('#numero').attr('value',$(this).attr('id'));
  $('#numeroDestino').html($(this).attr('id'));
  $('#modalMensaje').modal('show');

});

$('#btnCerrar').on('click',function(){
  $('#modalMensaje').modal('hide');
});
$('#btnEnviar').on('click',function(){
  if($('#textoMensaje').val()==''){
    $('#textoMensaje').css('border','1px solid #FF5252');
  }else{
    var numero = $('#numero').attr('value');
    $('#loaderMensaje').toggleClass('active');
    $.ajax({
      url:'php/enviarMensaje.php',
      type:'get',
      data:'telefono='+numero+"&texto="+$('#textoMensaje').val()
    }).done(function(data){
        if(data == "true"){
          $('#loaderMensaje').toggleClass('active');
          $('#modalMensaje').modal('hide');
          alert("Mensaje enviado");
        }else{
          $('#loaderMensaje').toggleClass('active');
          $('#modalMensaje').modal('hide');
          alert('Mensaje fallido');
        }
    });
  }
});





$('#btnDeuda').on('click',function(){
  var control = 0;
  if(fecha1 == ""){
    $('#fechaDeuda input').css('border','1px solid #FF5252');
    control++;
  }
  if($('#selectorDeuda').dropdown('get value') == ''){
    $('#selectorDeuda').css('border','1px solid #FF5252');
    control++;
  }
  if(control == 0){
    obtenerLocales(fecha1,2,tipoL1,function(resp){
      var tipo_local = "";
      tablaDeudas.rows().remove().draw();
      $.each(JSON.parse(resp), function(idx , obj){
        if(obj.tipo_local == 1){
          tipo_local = "normal";
        }
        if(obj.tipo_local == 2){
          tipo_local = "class";
        }
        if(obj.tipo_local == 3){
          tipo_local = "ultra";
        }
        if(obj.tipo_local == 4){
          tipo_local = "super-ultra";
        }
        if(obj.tipo_local == 5){
          tipo_local = "master";
        }
        var botones = "<div class='contenedorBoton'><button type='button' name='button' class='btnMas' id='"+ obj.id_cliente +"'><i class='zoom icon'></i></button><button class='btnMensaje' id='"+ obj.celular_cliente +"' type='button' name='button'><i class='comment outline icon'></i></button></div>";
        $('#tablaDeudas').dataTable().fnAddData([
          obj.nombre_local,
          obj.nombre_cliente,
          obj.celular_cliente,
          tipo_local,
          obj.fecha_inicio,
          obj.fecha_pago,
          botones
        ]);


      });
    });



  }

});
