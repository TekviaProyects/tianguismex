$(document).ready(function(){
  var inputCuenta = $('#cuenta'),
      inputContrasenia = $('#contrasenia'),
      btnEntrar = $('#btnEntrar');

  btnEntrar.on('click',function(){
    var cuenta = inputCuenta.val();
    var contrasenia = inputContrasenia.val();
    var control = 0;
    if(cuenta == ''){
      control++;
      inputCuenta.css('border','1px solid #FF5252');
    }
    if(contrasenia == ''){
      control++;
      inputContrasenia.css('border','1px solid #FF5252');
    }
    if(control == 0){
      if(!limpiarEntrada(cuenta)){
        inputCuenta.css('border','1px solid #FF5252');
        control++;
      }
      if(!limpiarEntrada(contrasenia)){
        inputContrasenia.css('border','1px solid #FF5252');
        control++;
      }
      if(control == 0){
        validar(cuenta,contrasenia,function(resp){
          if(resp){
            window.location.href = '../';
          }else{
            inputCuenta.css('border','1px solid #FF5252');
            inputContrasenia.css('border','1px solid #FF5252');
            $('.nota').addClass('bottom');
            setTimeout(function(){
              $('.nota').removeClass('bottom');
            }, 5000);
          }
        })
      }
    }
  });

  inputCuenta.on('focus',function(){
    $(this).css('border','1px solid rgba(34,36,38,.15)');
  });
  inputContrasenia.on('focus',function(){
    $(this).css('border','1px solid rgba(34,36,38,.15)');
  });



function limpiarEntrada(entrada){
  return true;
}
function validar(user,pass,callback){
  var retorno
  $.ajax({
    url:'../php/log.php',
    type:'get',
    data: 'user='+user+"&pass="+pass,
    success: function(data){
      if(data == "true"){
        retorno = true;
      }else{
        retorno = false;
      }
      callback(retorno);
    }
  });
}


});
