
var nUso = 0;
var ultimoId;
var ultimoColor;
var id = 0;
var paso = 1;
var fecha = "";
$(window).ready(function(){
  $('main').css('height','auto');
  $('.botonComprar').hide();
  $('.botonVolver').hide();
  $('.botonComprar #ultimo').hide();
  $('.botonComprar #spanUltimo').hide();
  $('#seleccionLocal').transition({
    animation  : 'scale',
    duration   : '.1s',
  });
  $('#calendarioLocal').transition({
    animation  : 'scale',
    duration   : '.1s',
  });

  /*var panZoomTiger = svgPanZoom('#svgCroquis',{
    maxZoom:8,
    controlIconsEnabled: true,
    fit:true
  });*/

  var menuEstado = 0;
  $('#botonMenu').on('click',function(){
    if(menuEstado==0){
      $('aside').css('top','0');
      menuEstado++;
      $('.linea1').addClass('linea1Abierta');
      $('.linea2').addClass('linea2Abierta');
      $('.linea3').addClass('linea3Abierta');
    }else{
      $('aside').css('top','-1000px');
      menuEstado--;
      $('.linea1').removeClass('linea1Abierta');
      $('.linea2').removeClass('linea2Abierta');
      $('.linea3').removeClass('linea3Abierta');
    }
  });

  $('#tarjetaNormal').on('click',function(){
    if(!$(this).hasClass('desactivado')){
      var cambio = 0;

      $('#tipoLocalInput').attr('value','normal');
      $('#tarjetaNormal').addClass('orange');
      $('#tarjetaUltra').removeClass('orange');
      $('#tarjetaClass').removeClass('orange');
      $('#tarjetaSuper').removeClass('orange');
      $('#tarjetaPromo').removeClass('orange');
      $('#tarjetaMaster').removeClass('orange');
      if(!($('#tipoLocalInput').attr('value')=='none')){
        var today = new Date();
        $('#fechaLocal').calendar({
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
              return day + "-" + month + "-" + year;
            }
          },
          onChange: function (date, text) {

            fecha = "";

            if($('#tipoLocalInput').attr('value')=='normal' || $('#tipoLocalInput').attr('value')=='class'){
              if(date.getDay()<4 && date.getDay()!=0){

                swal(
                  'Hey!',
                  'En este tipo de local solo puedes seleccionar un dia entre jueves y domingo',
                  'warning'
                );
                $('#mycalendar').calendar('refresh');
              }else{
                fecha = text;
              }
            }else{
              fecha = text;
            }
          }
        });
        $('#tiposLocal').transition({
          animation:'fly right',
          onComplete:function(){
            $('#seleccionLocal').transition('fly down');
            $('.botonVolver').transition('scale');
            $('.botonComprar').transition('scale');
            $('main').css('height','100%');
          }
        });
        cambio++;
        paso++;

      }else{
        swal(
          'Oops...',
          'Selecciona un tipo de local',
          'error'
        );
      }
    }

  });
  $('#tarjetaClass').on('click',function(){
    if(!$(this).hasClass('desactivado')){
      var cambio = 0;
      $('#tipoLocalInput').attr('value','class');
      $('#tarjetaClass').addClass('orange');
      $('#tarjetaNormal').removeClass('orange');
      $('#tarjetaUltra').removeClass('orange');
      $('#tarjetaPromo').removeClass('orange');
      $('#tarjetaSuper').removeClass('orange');
      $('#tarjetaMaster').removeClass('orange');
      if(!($('#tipoLocalInput').attr('value')=='none')){

        var today = new Date();
        $('#fechaLocal').calendar({
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
              return day + "-" + month + "-" + year;
            }
          },
          onChange: function (date, text) {
            fecha = "";

            if($('#tipoLocalInput').attr('value')=='normal' || $('#tipoLocalInput').attr('value')=='class'){
              if(date.getDay()<4 && date.getDay()!=0){

                swal(
                  'Hey!',
                  'En este tipo de local solo puedes seleccionar un dia entre jueves y domingo',
                  'warning'
                );
                $('#mycalendar').calendar('refresh');
              }else{
                fecha = text;
              }
            }else{
              fecha = text;
            }
          }
        });
        $('#tiposLocal').transition({
          animation:'fly right',
          onComplete:function(){
            $('#seleccionLocal').transition('fly down');
            $('.botonVolver').transition('scale');
            $('.botonComprar').transition('scale');
            $('main').css('height','100%');
          }
        });
        cambio++;
        paso++;

      }else{
        swal(
          'Oops...',
          'Selecciona un tipo de local',
          'error'
        );
      }
    }

  });
  $('#tarjetaUltra').on('click',function(){
    if(!$(this).hasClass('desactivado')){
      var cambio = 0;
      $('#tipoLocalInput').attr('value','ultra');
      $('#tarjetaUltra').addClass('orange');
      $('#tarjetaNormal').removeClass('orange');
      $('#tarjetaClass').removeClass('orange');
      $('#tarjetaSuper').removeClass('orange');
      $('#tarjetaPromo').removeClass('orange');
      $('#tarjetaMaster').removeClass('orange');
      if(!($('#tipoLocalInput').attr('value')=='none') ){
        var today = new Date();
        $('#fechaLocal').calendar({
          type: 'month',
          minDate: new Date(2017, today.getMonth(), 01),
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
              return day + "-" + month + "-" + year;
            }
          },
          onChange: function (date, text) {
            fecha = "";

            if($('#tipoLocalInput').attr('value')=='normal' || $('#tipoLocalInput').attr('value')=='class'){
              if(date.getDay()<4 && date.getDay()!=0){

                swal(
                  'Hey!',
                  'En este tipo de local solo puedes seleccionar un dia entre jueves y domingo',
                  'warning'
                );
                $('#mycalendar').calendar('refresh');
              }else{
                fecha = text;
              }
            }else{
              fecha = text;
            }
          }
        });
        $('#tiposLocal').transition({
          animation:'fly right',
          onComplete:function(){
            $('#seleccionLocal').transition('fly down');
            $('.botonVolver').transition('scale');
            $('.botonComprar').transition('scale');
            $('main').css('height','100%');
          }
        });
        cambio++;
        paso++;

      }else{
        swal(
          'Oops...',
          'Selecciona un tipo de local',
          'error'
        );
      }
    }


  });
  $('#tarjetaSuper').on('click',function(){
    if(!$(this).hasClass('desactivado')){
      var cambio = 0;
      $('#tipoLocalInput').attr('value','super');
      $('#tarjetaSuper').addClass('orange');
      $('#tarjetaNormal').removeClass('orange');
      $('#tarjetaPromo').removeClass('orange');
      $('#tarjetaClass').removeClass('orange');
      $('#tarjetaUltra').removeClass('orange');
      $('#tarjetaMaster').removeClass('orange');
      if(!($('#tipoLocalInput').attr('value')=='none') ){
        var today = new Date();
        $('#fechaLocal').calendar({
          type: 'month',
          minDate: new Date(2017, today.getMonth(), 01),
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
              return day + "-" + month + "-" + year;
            }
          },
          onChange: function (date, text) {
            fecha = "";

            if($('#tipoLocalInput').attr('value')=='normal' || $('#tipoLocalInput').attr('value')=='class'){
              if(date.getDay()<4 && date.getDay()!=0){

                swal(
                  'Hey!',
                  'En este tipo de local solo puedes seleccionar un dia entre jueves y domingo',
                  'warning'
                );
                $('#mycalendar').calendar('refresh');
              }else{
                fecha = text;
              }
            }else{
              fecha = text;
            }
          }
        });
        $('#tiposLocal').transition({
          animation:'fly right',
          onComplete:function(){
            $('#seleccionLocal').transition('fly down');
            $('.botonVolver').transition('scale');
            $('.botonComprar').transition('scale');
            $('main').css('height','100%');
          }
        });
        cambio++;
        paso++;

      }else{
        swal(
          'Oops...',
          'Selecciona un tipo de local',
          'error'
        );
      }
    }


  });
  $('#tarjetaMaster').on('click',function(){
    if(!$(this).hasClass('desactivado')){
      var cambio = 0;
      $('#tipoLocalInput').attr('value','master');
      $('#tarjetaMaster').addClass('orange');
      $('#tarjetaNormal').removeClass('orange');
      $('#tarjetaClass').removeClass('orange');
      $('#tarjetaUltra').removeClass('orange');
      $('#tarjetaPromo').removeClass('orange');
      $('#tarjetaSuper').removeClass('orange');
      if(!($('#tipoLocalInput').attr('value')=='none') ){

        var today = new Date();
        $('#fechaLocal').calendar({
          type: 'month',
          minDate: new Date(2017, today.getMonth(), 01),
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
              return day + "-" + month + "-" + year;
            }
          },
          onChange: function (date, text) {
            $('main').css('height','100%');
            fecha = "";

            if($('#tipoLocalInput').attr('value')=='normal' || $('#tipoLocalInput').attr('value')=='class'){
              if(date.getDay()<4 && date.getDay()!=0){

                swal(
                  'Hey!',
                  'En este tipo de local solo puedes seleccionar un dia entre jueves y domingo',
                  'warning'
                );
                $('#mycalendar').calendar('refresh');
              }else{
                fecha = text;
              }
            }else{
              fecha = text;
            }
          }
        });
        $('#tiposLocal').transition({
          animation:'fly right',
          onComplete:function(){
            $('#seleccionLocal').transition('fly down');
            $('.botonVolver').transition('scale');
            $('.botonComprar').transition('scale');
            $('main').css('height','100%');
          }
        });
        cambio++;
        paso++;

      }else{
        swal(
          'Oops...',
          'Selecciona un tipo de local',
          'error'
        );
      }
    }


  });
  $('#tarjetaPromo').on('click',function(){
    if(!$(this).hasClass('desactivado')){
      var cambio = 0;
      $('#tipoLocalInput').attr('value','promo');
      $('#tarjetaMaster').removeClass('orange');
      $('#tarjetaNormal').removeClass('orange');
      $('#tarjetaClass').removeClass('orange');
      $('#tarjetaUltra').removeClass('orange');
      $('#tarjetaPromo').addClass('orange');
      $('#tarjetaSuper').removeClass('orange');
      if(!($('#tipoLocalInput').attr('value')=='none') ){

        var today = new Date();
        $('#fechaLocal').calendar({
          type: 'month',
          minDate: new Date(2017, today.getMonth(), 01),
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
              return day + "-" + month + "-" + year;
            }
          },
          onChange: function (date, text) {
            $('main').css('height','100%');
            fecha = "";

            if($('#tipoLocalInput').attr('value')=='normal' || $('#tipoLocalInput').attr('value')=='class'){
              if(date.getDay()<4 && date.getDay()!=0){

                swal(
                  'Hey!',
                  'En este tipo de local solo puedes seleccionar un dia entre jueves y domingo',
                  'warning'
                );
                $('#mycalendar').calendar('refresh');
              }else{
                fecha = text;
              }
            }else{
              fecha = text;
            }
          }
        });
        $('#tiposLocal').transition({
          animation:'fly right',
          onComplete:function(){
            $('#seleccionLocal').transition('fly down');
            $('.botonVolver').transition('scale');
            $('.botonComprar').transition('scale');
            $('main').css('height','100%');
          }
        });
        cambio++;
        paso++;

      }else{
        swal(
          'Oops...',
          'Selecciona un tipo de local',
          'error'
        );
      }
    }


  });
  $('.botonComprar').on('click',function(){
    var cambio = 0;
      if(paso==1){
        if(!($('#tipoLocalInput').attr('value')=='none')){
          $('#tiposLocal').transition({
            animation:'fly right',
            onComplete:function(){
              $('#seleccionLocal').transition('fly down');
              $('.botonVolver').transition('scale');

            }
          });
          cambio++;
        }else{
          swal(
            'Oops...',
            'Selecciona un tipo de local',
            'error'
          );
        }
      }
      if(paso==2){
        if(fecha!=""){

          $.ajax({
              url : '../../php/obtenerLocales.php',
              type : 'GET',
              data : 'tipo='+$('#tipoLocalInput').attr('value')+'&fechaActual='+fecha
            }).done(function(data){

              $.each(JSON.parse(data),function(i,item){
                  $('#'+item.nombre_local).attr('fill','#f00');
                  $('#'+item.nombre_local + ' text').attr('fill','#E0E0E0');
              });
              $('#seleccionLocal').transition({
                animation:'fly right',
                onComplete:function(){
                  $('#calendarioLocal').transition('fly down');
                  $('.botonComprar #normal').transition({
                    animation: 'fade left',
                    onComplete:function(){
                      $('#spanNormal').transition({
                        animation: 'scale',
                        onComplete:function(){
                          $('.botonComprar #spanUltimo').transition('scale');
                          $('.botonComprar #ultimo').transition('scale');
                        }
                      });

                    }
                  });

                }
              });
          });
          cambio++;
        }else{
          swal(
            'Oops...',
            'Selecciona una fecha',
            'error'
          );
        }
      }
      if(paso==3){
        if(jQuery.isEmptyObject(map)){
          swal(
            'Oops...',
            'Selecciona al menos un local',
            'error'
          );
        }else{
          var texto = "La renta que realizas sera por:<br>";


          var counter = 0;
          var x = 0;
          var y = 0;
          if($('#tipoLocalInput').attr('value')=='normal'){
            x=50;
          }else if ($('#tipoLocalInput').attr('value')=='class') {
            x=100;
          }else if ($('#tipoLocalInput').attr('value')=='ultra'){
            x=900;
          }else if ($('#tipoLocalInput').attr('value')=='master'){
            x=1800;
          }else if ($('#tipoLocalInput').attr('value')=='super'){
            x=1000;
          }
          else if ($('#tipoLocalInput').attr('value')=='promo'){
            x=500;
          }
          for (i in map) {


            texto += "Local " + i +" - $"+ x+"<br>" ;
            counter++;
            y += x;
          }
          texto += "Por un total de $" + y + "<br>";

          var link = "";
          swal({
            title: '¿Estas seguro de realizar la compra?',
            html: texto,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            showLoaderOnConfirm: true,
            confirmButtonText: 'Rentar!',
            preConfirm: function(){
              return new Promise(function(resolve, reject){
              	
              	
              	console.log("================> map", map);
              	
              	
              	
                $.ajax({
                  url : '../../php/guardarRentaNuevo.php',
                  type : 'GET',
                  data: 'tipo='+$('#tipoLocalInput').attr('value')+'&fechaActual='+fecha+"&json="+JSON.stringify(map)
                }).done(function(data){

                  if(data.substr(0,4) == "http"){

                    link = data;
                    resolve();
                  }else{

                    reject("Fallo la renta: "+ data);
                  }
                });
              });
            },
            allowOutsideClick: false
          }).then(function () {
            swal({
              title: "¡Rentado!",
              text: "El local ha sido rentado, los formatos de pago fueron enviados a tu correo y como sms a tu celular",
              type: "success",
              allowOutsideClick: false}
            ).then(function(){
              var contenido = "<iframe id='formato' src="+ link +"></iframe>";
              $('#modal').html(contenido);
              $('#modal').modal({
                onHidden:function(){
                  $('#loader').removeClass('disabled');
                  $('#loader').addClass('active');
                  window.location.href = "../../rentar"
                }
              }).modal('show');
            });
          });
        }

      }
      if(cambio>0){
        paso++;
        cambio = 0;
      }
  });
  $('.botonVolver').on('click',function(){
    if(paso==2){
      $('#seleccionLocal').transition({
        animation:'fly down',
        onComplete:function(){
          $('#tiposLocal').transition('fly right');
          $('.botonComprar').transition('scale');
          $('.botonVolver').transition('scale');
          fecha = "";
          $('#fecha').val("");
          $('main').css('height','auto');
        }
      });
    }
    if(paso==3){
      map = new Object();
      $('#svgCroquis g').each(function(index){
        $(this).attr('fill','white');
        if(!(typeof $(this).attr('id') === "undefined")){
          $('#'+$(this).attr('id')+" text").attr('fill','black');
        }
      });
      $('#calendarioLocal').transition({
        animation:'fly down',
        onComplete:function(){
          $('#seleccionLocal').transition('fly right');
          $('.botonComprar #ultimo').transition({
            animation: 'fade left',
            onComplete:function(){
              $('#spanUltimo').transition({
                animation: 'scale',
                onComplete:function(){
                  $('.botonComprar #spanNormal').transition('scale');
                  $('.botonComprar #normal').transition('scale');
                }
              });

            }
          });
        }
      });
    }
    paso--;
  });












});
var map = new Object();
function prueba(elmnt){
  var id = elmnt.id;
  var target = '#'+id;
  var local = $(target)
  if(local.attr('fill')=='white'){
    local.attr('fill','#2196F3');
    map[id] = id;
  }else{
    if(local.attr('fill')=='#2196F3'){
      local.attr('fill','white');
      delete map[id];
    }
  }


}
function fix()
{
    var el = this;
    var par = el.parentNode;
    var next = el.nextSibling;
    par.removeChild(el);
    setTimeout(function() {par.insertBefore(el, next);}, 0)
}
