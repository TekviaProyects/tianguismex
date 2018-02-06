function prueba(g){
  var elemento = $('#'+g.id);
  if(elemento.attr('fill') == 'white'){
  }else{
    $.ajax({
      url:'php/obtenerLocalCroquis.php',
      type:'get',
      data:'local='+g.id+"&fecha="+$('#fechaActual').attr('value')
    }).done(function(data){
      $.each(JSON.parse(data),function(i,item){
        $('#nombreLabel').html(item.nombre_cliente);
        $('#correoLabel').html(item.correo_cliente);
        $('#celularLabel').html(item.celular_cliente);
        $('#domicilioLabel').html(item.domicilio_cliente);
      });
      $('#modalCroquis').modal('show');
    });
  }
}




$('.infoLocales').popup();
var fecha = '';
$('#fechaCroquis').calendar({
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
      return year + "-" + month + "-" + day;
    }
  },
  onChange: function(date , text , mode){
    fecha = text;
    $('#fechaCroquis input').css('border','1px solid rgba(34,36,38,.15)');
  }
});
$('#selectorCroquis').dropdown({
  onChange: function(){
    $(this).css('border','1px solid rgba(34,36,38,.15)');
  }
});


$('#btnCroquis').on('click',function(){
  var control = 0;
  if($('#selectorCroquis').dropdown('get value') == ''){
    $('#selectorCroquis').css('border','1px solid #FF5252');
    control++;
  }
  if(fecha == ''){
    $('#fechaCroquis input').css('border','1px solid #FF5252');
    control++;
  }
  if(control == 0){




    $('#svgCroquis g').each(function(){
      $(this).attr('fill','white');
      $('#'+$(this).attr('id')+" text").attr('fill','black');
    });

    $.ajax({
        method: "GET",
        url: "php/obtenerLocalesDis.php",
        data:"tipo="+$('#selectorCroquis').dropdown('get value')+"&fecha="+fecha
    }).done(function( dato ) {
          $('#fechaActual').attr('value',fecha);
          $.each(JSON.parse(dato),function(i,item){
              if(item.fecha_pago != null){
                if(item.estado_pago == 0){
                  $('#'+item.nombre_local).attr('fill','#FF5252');
                }else{
                  $('#'+item.nombre_local).attr('fill','#66BB6A');
                }

                $('#'+item.nombre_local + ' text').attr('fill','white');
              }
          });
    });
  }

});
