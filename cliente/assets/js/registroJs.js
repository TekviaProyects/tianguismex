$(document).ready(function(){


  $("input:file").change(function (){
       var fileName = $(this).val();
       if(fileName == ''){
         $('#labelArchivo').html('Sube tu identificación');
       }else{
         $('#labelArchivo').html(fileName);
       }
  });





  $('#btnRegistrar').on('click',function(){
    if($('#archivo').val()=='' || $('#inputNombre').val()=='' || $('#inputCorreo').val()=='' || $('#inputTelefono').val()=='' || $('#inputDomicilio').val()==''){
      swal({
        title: '¡Hey!',
        text: 'Debes completar todos los datos',
        type: 'error',
        confirmButtonColor: '#ff9068'
      });
    }else{
      if($('#inputTelefono').val().length < 10){
        swal({
          title: '¡Hey!',
          text: 'Introduce un numero valido',
          type: 'error',
          confirmButtonColor: '#ff9068'
        });
      }else{
        swal({
          title: "Creando...",
          html:
          "<div class='logo'><svg version='1.1' id='animacion' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' width='259.9px' height='170px' viewBox='0 0 250 130' enable-background='new 0 0 250 130' xml:space='preserve'><g class='superior'><path id='uno' fill='#F8C300' d='M73.4,50.2h128.2c4.6,0,8.3-3.7,8.3-8.2c0-4.5-3.7-8.2-8.3-8.2H73.4c-4.6,0-8.3,3.7-8.3,8.2C65.1,46.6,68.8,50.2,73.4,50.2z'/><path id='dos' fill='#DC0209' d='M99.4,99.4h84c4.6,0,8.3-3.7,8.3-8.2s-3.7-8.2-8.3-8.2h-84c-4.6,0-8.3,3.7-8.3,8.2S94.8,99.4,99.4,99.4z'/><path id='tres' fill='#EE9400' d='M87.4,74.1h105.3c4.6,0,8.3-3.7,8.3-8.2c0-4.5-3.7-8.2-8.3-8.2H87.4c-4.6,0-8.3,3.7-8.3,8.2C79.2,70.5,82.9,74.1,87.4,74.1z'/><path id='cuatro' fill='#FAD100' d='M72,50.1l119.7,23.8c4.5,0.8,8.8-2.2,9.6-6.7c0.8-4.5-2.3-8.7-6.8-9.5L74.8,34c-4.5-0.8-8.8,2.2-9.6,6.7C64.4,45.1,67.5,49.3,72,50.1z'/><path id='cinco' fill='#EE9400' d='M86.1,74l96.4,25.2c4.5,0.8,8.8-2.2,9.6-6.7c0.8-4.5-2.3-8.7-6.8-9.5L88.9,57.9c-4.5-0.8-8.8,2.2-9.6,6.7C78.5,69,81.6,73.2,86.1,74z'/><path id='seis' fill='#1E120D' d='M8.3,16.4H61c4.6,0,8.3-3.7,8.3-8.2C69.2,3.7,65.5,0,61,0H8.3C3.7,0,0,3.7,0,8.2C0,12.7,3.7,16.4,8.3,16.4z'/><path id='siete' fill='#1E120D' d='M55.5,13.6L65.4,25c3,3.4,8.2,3.8,11.7,0.8c3.4-3,3.8-8.2,0.8-11.6L67.9,2.8C64.9-0.6,59.7-1,56.2,2C52.8,5,52.5,10.2,55.5,13.6z'/></g><ellipse class='llanta1' fill='#1E120D' cx='119.1' cy='116.9' rx='13.2' ry='13.1'/>  <ellipse class='llanta2' fill='#1E120D' cx='165.1' cy='116.9' rx='13.2' ry='13.1'/></svg></div>",
          showConfirmButton:false
        })
        var animacion = anime.timeline({
          loop: true
        });
        var animacion2 = anime({
          targets: '#animacion .superior',
          translateY: [{value:5},{value:0}],
          easing: 'linear',
          loop: true
        });

        animacion
          .add({
            targets: '#animacion .llanta1',
            translateY: -4,
            duration: 250,
            easing: 'linear'
          })
          .add({
            targets: '#animacion .llanta2',
            translateY: -4,
            duration: 250,
            easing: 'linear'
          })
          .add({
            targets: '#animacion .llanta1',
            translateY: 0,
            duration: 250,
            easing: 'linear'
          })
          .add({
            targets: '#animacion .llanta2',
            translateY: 0,
            duration: 250,
            easing: 'linear'
          });
        var formData = new FormData(document.getElementById("formularioRegistro"));
        $.ajax({
          url: '../php/funcionesRegistro.php',
          type: 'post',
          dataType: 'html',
          data: formData,
          cache: false,
          contentType: false,
          processData: false
        }).done(function(data){

          var volver2 = anime({
            targets: '#animacion .superior',
            translateY: 0,
            easing: 'linear'
          });
          var volver1 = anime({
            targets: '#animacion .llanta1',
            translateY: 0,
            easing: 'linear'
          });
          var volver = anime({
            targets: '#animacion .llanta2',
            translateY: 0,
            easing: 'linear'
          });
          if(data == 'true'){
            swal({
              title: 'Has sido registrado',
              text: 'Solo falta que confirmes tu registro en tu correo',
              type:'success',
              allowOutsideClick:false,
              confirmButtonColor:'#ff9068'
            }).then(function(){
              window.location.href = '../login';
            });
          }else{
            switch (data) {

              case 'formato':
                swal({
                  title: '¡Hey!',
                  text: 'Introduce un correctamente tus datos',
                  type: 'error',
                  confirmButtonColor: '#ff9068'
                });
                break;
              case 'existencia':
                swal({
                  title: '¡Lo sentimos!',
                  text: 'Este correo ya esta registrado',
                  type: 'error',
                  confirmButtonColor: '#ff9068'
                });
                break;
                case 'archivo':
                  swal({
                    title: '¡Lo sentimos!',
                    text: 'El archivo debe ser una imagen',
                    type: 'error',
                    confirmButtonColor: '#ff9068'
                  });
                  break;
                  case 'exTel':
                    swal({
                      title: '¡Lo sentimos!',
                      text: 'Al parecer el telefono no existe',
                      type: 'error',
                      confirmButtonColor: '#ff9068'
                    });
                    break;

              default:
              swal({
                title: '¡Lo sentimos!',
                text: 'Hubo un error con el servidor, intenta mas tarde',
                type: 'error',
                confirmButtonColor: '#ff9068'
              });
            }
          }
        });







      }
    }
  });

});
