
$('#loader').hide();
$('#btnEnviar').on('click',function(){
  var control = 0;
  if($('#inputTelefono').val()==""){
    $('#inputTelefono').css('border','1px solid #FF5252');
    control++;
  }
  if($('#selectorControl').val()==""){
    $('#selectorControl').css('border','1px solid #FF5252');
    control++;
  }


  if(control == 0){
    if($('#inputTelefono').val().length == 10){
      $('#iconoNormal').hide();
      $('#loader').show();
      console.log($('#selectorControl').val());
      $.ajax({
        url:'php/activarPuertas.php',
        type: 'get',
        data: 'telefono='+$('#inputTelefono').val()+'&puerta='+$('#selectorControl').val()
      }).done(function(data){
        console.log(data);
        $('#loader').hide();
        $('#iconoNormal').show();
        $('#modalListo').modal('show');
      });
    }else{
      alert("Escribe un numero valido");
    }
  }
});
$('#btnTodos').on('click',function(){
  $.ajax({
    url:'php/activarTodo.php',
    type:'get'
  }).done(function(data){
    console.log(data);
    console.log("se abrieron todas correle alv D:");
  });
});
$('#inputTelefono').focus(function(){
  $(this).css('border','1px solid rgba(34,36,38,.15)');
});
