$.ajax({
    method: "GET",
    url: "../php/obtenerLocalesDis.php"
}).done(function( dato ) {
      $.each(JSON.parse(dato),function(i,item){
          if(item.fecha_pago != null){
            $('#'+item.nombre_local).attr('fill','orange');
            $('#'+item.nombre_local + ' text').attr('fill','white');
          }

      });
});


function prueba(a) {
    var t = a.id;

    if($('#'+t).attr('fill') == 'orange'){
      $.ajax({
          method: "GET",
          url: "../php/obtenerCliente.php",
          data: "variable="+t
      }).done(function( dato ) {
            $.each(JSON.parse(dato),function(i,item){
              $('#localito').html('LOCAL '+item.nombre_local);
              $('#nombrecito').html(item.nombre_cliente);
              $('#celularcito').html(item.celular_cliente);
              $('#correoito').html(item.correo_cliente);
              $('#direccioncita').html(item.domicilio_cliente);
              $('#imagencita').html('<img class=\"ife\" id=\"ifecita\" src=\"../php/archivos/'+item.identificacion_cliente+'\">');

            });
            $('#modalito')
            .modal('show');
      });
    }
}
