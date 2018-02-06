function cerrarMenu(){
  $('aside').css('width','100%');
  $('.n1').toggleClass('change');
  $('.n2').toggleClass('change');
  $('.n3').toggleClass('change');

  $('.menuLateral').toggleClass('abierto');
  $('.menuLateral').toggleClass('cerrado');$('.animacion').css('width','100%');
  estado--;
  $('.movil ul').toggleClass('irse');
  setTimeout(function(){
    $('aside').css('width','0%');
    $('.movil ul').toggleClass('irseBien');
  }, 1000);
}
function animacionMovil(id){
  switch (id) {

    case 'opcLocales':
    case 'opcLocalesM':
      direccion = "php/locales.php";
      break;
    case 'opcUsuarios':
    case 'opcUsuariosM':
      direccion = "php/usuarios.php";
      break;
    case 'opcCroquis':
    case 'opcCroquisM':
      direccion = "php/croquis.php";
      break;
    case 'opcReporte':
    case 'opcReporteM':
      direccion = "php/reporte.php";
      break;
    case 'opcConfiguracion':
    case 'opcConfiguracionM':
      direccion = "php/configuracion.php";
      break;
    case 'opcControl':
    case 'opcControlM':
      direccion = "php/control.php";
      break;
  }
  $('.wrapper').load(direccion,function(){
    cerrarMenu();
  });

}
function animacion(id){
  $('.cargador').css('width','100%');
  var direccion;
  $('.capa1').addClass('animacion');
  $('.capa2').addClass('animacion');

  switch (id) {

    case 'opcLocales':
    case 'opcLocalesM':
      direccion = "php/locales.php";
      break;
    case 'opcUsuarios':
    case 'opcUsuariosM':
      direccion = "php/usuarios.php";
      break;
    case 'opcCroquis':
    case 'opcCroquisM':
      direccion = "php/croquis.php";
      break;
    case 'opcReporte':
    case 'opcReporteM':
      direccion = "php/reporte.php";
      break;
    case 'opcConfiguracion':
    case 'opcConfiguracionM':
      direccion = "php/configuracion.php";
      break;
    case 'opcControl':
    case 'opcControlM':
      direccion = "php/control.php";
      break;
  }






  setTimeout(function(){
    $('.capa1').removeClass('animacion');
    $('.capa2').removeClass('animacion');

    $('.cargador').css('width','0');
  }, 4000);
  setTimeout(function(){
    $('.wrapper').load(direccion);
    $('.wrapper').css('opacity','1');
  },2000);
}

$(document).ready(function(){
  $('.wrapper').load("php/locales.php");
  $('#opcLocales').on('click',function(){
    animacion($(this).attr('id'));
    $('.seleccionado').removeClass('seleccionado');
    $('#opcLocales').addClass('seleccionado');
    $('#opcLocalesM').addClass('seleccionado');
  });

  $('#opcUsuarios').on('click',function(){
    animacion($(this).attr('id'));
    $('.seleccionado').removeClass('seleccionado');
    $('#opcUsuarios').addClass('seleccionado');
    $('#opcUsuariosM').addClass('seleccionado');
  });


  $('#opcCroquis').on('click',function(){
    animacion($(this).attr('id'));
    $('.seleccionado').removeClass('seleccionado');
    $('#opcCroquis').addClass('seleccionado');
    $('#opcCroquisM').addClass('seleccionado');
  });


  $('#opcReporte').on('click',function(){
    animacion($(this).attr('id'));
    $('.seleccionado').removeClass('seleccionado');
    $('#opcReporte').addClass('seleccionado');
    $('#opcReporteM').addClass('seleccionado');
  });

  $('#opcConfiguracion').on('click',function(){
    animacion($(this).attr('id'));
    $('.seleccionado').removeClass('seleccionado');
    $('#opcConfiguracion').addClass('seleccionado');
    $('#opcConfiguracionM').addClass('seleccionado');
  });
  $('#opcControl').on('click',function(){
    animacion($(this).attr('id'));
    $('.seleccionado').removeClass('seleccionado');
    $('#opcControl').addClass('seleccionado');
    $('#opcControlM').addClass('seleccionado');
  });


  $('#opcLocalesM').on('click',function(){
    animacionMovil($(this).attr('id'));
    $('.seleccionado').removeClass('seleccionado');
    $('#opcLocalesM').addClass('seleccionado');
    $('#opcLocales').addClass('seleccionado');
  });

  $('#opcUsuariosM').on('click',function(){
    animacionMovil($(this).attr('id'));
    $('.seleccionado').removeClass('seleccionado');
    $('#opcUsuariosM').addClass('seleccionado');
    $('#opcUsuarios').addClass('seleccionado');
  });


  $('#opcCroquisM').on('click',function(){
    animacionMovil($(this).attr('id'));
    $('.seleccionado').removeClass('seleccionado');
    $('#opcCroquisM').addClass('seleccionado');
    $('#opcCroquis').addClass('seleccionado');

  });


  $('#opcReporteM').on('click',function(){
    animacionMovil($(this).attr('id'));
    $('.seleccionado').removeClass('seleccionado');
    $('#opcReporteM').addClass('seleccionado');
    $('#opcReporte').addClass('seleccionado');

  });

  $('#opcConfiguracionM').on('click',function(){
    animacionMovil($(this).attr('id'));
    $('.seleccionado').removeClass('seleccionado');
    $('#opcConfiguracionM').addClass('seleccionado');
    $('#opcConfiguracion').addClass('seleccionado');

  });
  $('#opcControlM').on('click',function(){
    animacionMovil($(this).attr('id'));
    $('.seleccionado').removeClass('seleccionado');
    $('#opcControlM').addClass('seleccionado');
    $('#opcControl').addClass('seleccionado');
  });















});
