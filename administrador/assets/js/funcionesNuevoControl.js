function peticion (id_control,puerta,callback){
  $.ajax({
    url:'php/activadorPuerta.php',
    type: 'get',
    data: 'id_control='+id_control+"&puerta="+puerta,
    success: function(data, textStatus, xhr){
      return callback(data);
    },
    error: function(){

    }
  });
}
$.ajax({
  url:'php/obtenerEstadoPuertas.php',
  type:'get'
}).done(function(data){
  $.each(JSON.parse(data),function(i,item){
    if(item.estado_puerta == '0'){
      $('#circulo'+item.numero_puerta+item.id_control).addClass('cerradoC');
    }else{
      $('#circulo'+item.numero_puerta+item.id_control).addClass('abiertoC');
    }
  });
});
$('.boton').on('click','.btn1',function(){
  var id_control = $(this).parent().attr('id');
  var puerta = 1;
  var boton = $(this);
  $(this).prop('disabled',true);
  $(this).css('opacity','.4');
  peticion(id_control,puerta,function(data){
    if(data == '1'){
      $('#circulo1'+id_control).toggleClass("cerradoC");
      $('#circulo1'+id_control).toggleClass("abiertoC");
    }else if(data == '0'){
      $('#circulo1'+id_control).toggleClass("cerradoC");
      $('#circulo1'+id_control).toggleClass("abiertoC");
    }
    boton.prop('disabled',false);
    boton.css('opacity','1');
  })

});

$('.boton').on('click','.btn2',function(){
  var id_control = $(this).parent().attr('id');
  var puerta = 2;
  var boton = $(this);
  $(this).prop('disabled',true);
  $(this).css('opacity','.4');
  peticion(id_control,puerta,function(data){
    if(data == '1'){
      $('#circulo2'+id_control).toggleClass("cerradoC");
      $('#circulo2'+id_control).toggleClass("abiertoC");
    }else if(data == '0'){
      $('#circulo2'+id_control).toggleClass("cerradoC");
      $('#circulo2'+id_control).toggleClass("abiertoC");
    }
    boton.prop('disabled',false);
    boton.css('opacity','1');
  })

});
