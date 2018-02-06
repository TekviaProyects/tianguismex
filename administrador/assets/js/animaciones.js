var estado = 0;
$('.botonMovil').on('click',function(){
  $('aside').css('width','100%');
  $('.n1').toggleClass('change');
  $('.n2').toggleClass('change');
  $('.n3').toggleClass('change');

  $('.menuLateral').toggleClass('abierto');
  $('.menuLateral').toggleClass('cerrado');$('.animacion').css('width','100%');
  if(estado){
    estado--;
    $('.movil ul').toggleClass('irse');
    setTimeout(function(){
      $('aside').css('width','0%');
      $('.movil ul').toggleClass('irseBien');
    }, 1000);
  }else{
    $('.movil ul').toggleClass('irseBien');
    setTimeout(function(){
      $('.movil ul').toggleClass('irse');
    }, 1000);
    estado++;
  }
});
