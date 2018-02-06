var tablaClientes;
var tablaClientes2;
var tablaClientes3;


function actualizarTabla3(){
  $.ajax({
    url: 'php/obtenerClientesNo.php',
    type: 'GET'
  }).done(function(data){
    tablaClientes3.rows().remove().draw();

    $.each(JSON.parse(data), function(idx , obj){
      var prueba = "<div class='controlesClientes'><button type='button' name='button' class='btnMensaje' id='"+ obj.celular_cliente +"'><i class='comment icon'></i></button><!--<button type='button' name='button' class='btnEditar' id='"+obj.id_cliente+"' diabled><i class='write icon'></i></button>--></div>";
      $('#tablaClientes3').dataTable().fnAddData([
        obj.nombre_cliente,
        obj.celular_cliente,
        obj.correo_cliente,
        obj.domicilio_cliente,
        prueba
      ]);
    });
  });
}

function actualizarTabla2(){
  $.ajax({
    url: 'php/obtenerClientesNoLocal.php',
    type: 'GET'
  }).done(function(data){
    tablaClientes2.rows().remove().draw();

    $.each(JSON.parse(data), function(idx , obj){
      var prueba = "<div class='controlesClientes'><button type='button' name='button' class='btnMensaje' id='"+ obj.celular_cliente +"'><i class='comment icon'></i></button><!--<button type='button' name='button' class='btnEditar' id='"+obj.id_cliente+"' diabled><i class='write icon'></i></button>--></div>";
      $('#tablaClientes2').dataTable().fnAddData([
        obj.nombre_cliente,
        obj.celular_cliente,
        obj.correo_cliente,
        obj.domicilio_cliente,
        prueba
      ]);
    });
  });
}

function actualizarTabla(){
  $.ajax({
    url: 'php/obtenerClientes.php',
    type: 'GET'
  }).done(function(data){
    tablaClientes.rows().remove().draw();

    $.each(JSON.parse(data), function(idx , obj){
      var prueba = "<div class='controlesClientes'><button type='button' name='button' class='btnMensaje' id='"+ obj.celular_cliente +"'><i class='comment icon'></i></button><!--<button type='button' name='button' class='btnEditar' id='"+obj.id_cliente+"' diabled><i class='write icon'></i></button>--></div>";
      $('#tablaClientes').dataTable().fnAddData([
        obj.nombre_cliente,
        obj.celular_cliente,
        obj.correo_cliente,
        obj.domicilio_cliente,
        prueba
      ]);
    });
  });
}


$(document).ready(function(){
  tablaClientes = $('#tablaClientes').DataTable({
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
  tablaClientes2 = $('#tablaClientes2').DataTable({
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
  tablaClientes3 = $('#tablaClientes3').DataTable({
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

  actualizarTabla2();
  actualizarTabla3();

  $('#btnClientes').on('click',function(){
    actualizarTabla();
  });



  $('#tablaClientes').on('click','.btnMensaje',function(){
    console.log("mensaje");
    console.log($(this).attr('id'));
    console.log("mensaje");
    $('#numero').attr('value',$(this).attr('id'));
    $('#numeroDestino').html($(this).attr('id'));
    $('#modalMensaje').modal('show');
  });
  $('#tablaClientes2').on('click','.btnMensaje',function(){
    console.log("mensaje");
    console.log($(this).attr('id'));
    console.log("mensaje");
    $('#numero').attr('value',$(this).attr('id'));
    $('#numeroDestino').html($(this).attr('id'));
    $('#modalMensaje').modal('show');
  });
  $('#tablaClientes3').on('click','.btnMensaje',function(){
    console.log("mensaje");
    console.log($(this).attr('id'));
    console.log("mensaje");
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



  $('#tablaClientes').on('click','.btnBorrar',function(){
    console.log("eliminar");
  });
  $('#tablaClientes').on('click','.btnEditar',function(){
    console.log("editar");
  });
  $('#tablaClientes2').on('click','.btnBorrar',function(){
    console.log("eliminar");
  });
  $('#tablaClientes2').on('click','.btnEditar',function(){
    console.log("editar");
  });




});
