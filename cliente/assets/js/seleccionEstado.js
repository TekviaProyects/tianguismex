
function siguiente(){

  window.location.href =  "" + $('#id_tianguis').val();
}
function seleccion(id_tianguis){
  $('#id_tianguis').val(id_tianguis);
  siguiente();
}
$(document).ready(function(){
  $('#estadoSelec').dropdown({

  });
  $('#btnAnterior').on('click',function(){
    $('#seleccionTianguis').transition({
      animation: 'fade right',
      onComplete: function(){
        $('#contenido').transition('fade right');
        $('#btnSelec').transition('fade');
        $('#btnAnterior').transition('fade');
        $('#seleccionTianguis').html('');
      }
    });


  });
  $('#btnSelec').on('click',function(){
    if($('#estadoSelec').val() != ''){
      $('#contenido').transition({
        animation: 'fade right',
        onComplete: function(){
          $('#btnSelec').transition('fade');
          $('#btnAnterior').transition('fade');
          $.ajax({
            url: '../php/obtenerTianguisEstado.php',
            type: 'GET',
            data: 'estado='+$('#estadoSelec').val()
          }).done(function(data){

            var conteo = 0;
            var obj = JSON.parse(data);
            $.each(obj,function(i,item){





              $('#seleccionTianguis').append("<div id='tarjeta' onclick='seleccion("+ item.id_tianguis +")'>"+
                  "<img src='"+ item.directorio_tianguis +"' alt=''>"+
                "<div class='contenido'>"+
                  "<span class='titulo'>"+ item.nombre_tianguis +"</span>"+
                  "<span class='horario'>"+ item.horario_apertura + " a " + item.horario_cierre + "</span>"+
                  "<span class='descripcion'>" + item.descripcion_tianguis + "</span>"+
                "</div>"+
              "</div>");
              conteo++;
            });

            $('#seleccionTianguis').transition('fade right');
            if(conteo == 0){
              $('#seleccionTianguis').append("<h2 class='ui center aligned icon header'><i class='frown icon'></i>No hay tianguis en este estado</h2>");
            }
          });









        }
      });


    }else{
      swal({
        title: 'Hey',
        type: 'warning',
        text: 'Selecciona un estado',
        confirmButtonColor: '#FF851B'
      });
    }
  });













});
