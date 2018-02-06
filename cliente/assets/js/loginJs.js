$(document).ready(function(){
  //boton de login


  $('#btnVolver').on('click',function(){
    window.location.href = '../../';
  });

  $('#btnEntrar').on('click',function(){
    $('#animacionA').addClass('show');
    if($('#correo').val().length == 0 || $('#telefono').val().length == 0){
      swal({
        title: '¡Hey!',
        text: 'Debes completar todos los datos',
        type: 'error',
        confirmButtonColor: '#ff9068'
      });
    }else{



      $.ajax({
        url: '../php/funcionesLogin.php',
        type: 'POST',
        data: 'correo='+ $('#correo').val() + '&telefono=' + $('#telefono').val()
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
          window.location.href = '../rentar';
        }else{
          $('#animacionA').removeClass('show');
          switch (data) {
            case 'estado':
              swal({
                title: '¡Hey!',
                text: 'Aun no confirmas tu correo, verifica tu bandeja de correos',
                type: 'error',
                confirmButtonColor: '#ff9068'
              });
              break;
            case 'formato':
              swal({
                title: '¡Hey!',
                text: 'Introduce un correo valido',
                type: 'error',
                confirmButtonColor: '#ff9068'
              });
              break;
            case 'existencia':
              swal({
                title: '¡Lo sentimos!',
                text: 'Tu correo o tu telefono son incorrectos',
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
  });


  $('#recuperar').on('click',function(){
    swal({
      title: 'Introduce tu correo para que enviemos tus contraseña',
      input: 'email',

      showCancelButton: true,
      confirmButtonText: 'Enviar Contraseña',
      confirmButtonColor: '#ff9068',
      showLoaderOnConfirm: true,
      preConfirm: function (email) {
        return new Promise(function (resolve, reject) {
          $.ajax({
            type:"post",
            data: "correo="+email,
            url: '../php/recuperar.php'
          }).done(function(data){
            if(data == 'true'){
              resolve();
            }else{
              reject('Este correo es incorrecto o no existe');
            }
          });




        })
      },
      allowOutsideClick: false
    }).then(function (email) {
      swal({
        type: 'Revisa tu Correo',
        title: '¡El correo ha sido enviado!',
        html: 'Ha sido enviado a: ' + email,
        confirmButtonColor: '#ff9068'
      })
    })
  });







});
