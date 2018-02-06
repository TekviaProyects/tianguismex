function number_format(amount, decimals) {

    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

    decimals = decimals || 0; // por si la variable no fue fue pasada

    // si no es un numero o es igual a cero retorno el mismo cero
    if (isNaN(amount) || amount === 0)
        return parseFloat(0).toFixed(decimals);

    // si es mayor o menor que cero retorno el valor formateado como numero
    amount = '' + amount.toFixed(decimals);

    var amount_parts = amount.split('.'),
        regexp = /(\d+)(\d{3})/;

    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

    return amount_parts.join('.');
}
var chart = c3.generate({
  bindto: '#chart',
  data: {
    x: 'x',
    columns: [
      ['x', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre','Octubre','Noviembre', 'Diciembre'],
      ['Ingresos', 0, 0, 0, 0, 0, 0, 0, 0, 0,0,0,0]
    ],
    type: 'bar'
  },
  axis: {
    x: {
      categories: ['One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine' , 'ten' , 'eleven' , 'twelve'],
      type: 'categorized'
    }
  }
});
var chart2 = c3.generate({
  bindto: '#chart2',
  data: {
    x: 'x',
    columns: [
      ['x', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre','Octubre','Noviembre', 'Diciembre'],
      ['Ingresos', 0, 0, 0, 0, 0, 0, 0, 0, 0,0,0,0]
    ],
    type: 'bar'
  },
  axis: {
    x: {
      categories: ['One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine' , 'ten' , 'eleven' , 'twelve'],
      type: 'categorized'
    }
  }
});


$.ajax({
  url: 'php/obtenerIngresos.php',
  type: 'GET'
}).done(function(data){
  var o = JSON.parse(data);
  setTimeout(function () {
      chart.load({
          columns: [
            ['x', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre','Octubre','Noviembre', 'Diciembre'],
            ['Ingresos', o[1], o[2], o[3], o[4], o[5], o[6], o[7], o[8], o[9],o[10],o[11],o[12]]
          ],
      });
  }, 1000);

});
$.ajax({
  url: 'php/obtenerIngresosMensual.php',
  type: 'GET'
}).done(function(data){
  var o = JSON.parse(data);
  setTimeout(function () {
      chart2.load({
          columns: [
            ['x', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre','Octubre','Noviembre', 'Diciembre'],
            ['Ingresos', o[1], o[2], o[3], o[4], o[5], o[6], o[7], o[8], o[9],o[10],o[11],o[12]]
          ],
      });
  }, 1000);

});


$('#example8').calendar({
  type: 'year',
  onChange: function(a, t){
    console.log(t);
    $('#anioActual').html(t);
    $.ajax({
      url: 'php/obtenerIngresos.php',
      type: 'GET',
      data: 'fecha='+t
    }).done(function(data){
      var o = JSON.parse(data);
      setTimeout(function () {
          chart.load({
              columns: [
                ['x', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre','Octubre','Noviembre', 'Diciembre'],
                ['Ingresos', o[1], o[2], o[3], o[4], o[5], o[6], o[7], o[8], o[9],o[10],o[11],o[12]]
              ],
          });
      }, 1000);

    });
  }
});
$('#selectAnio').calendar({
  type: 'year',
  onChange: function(a, t){
    console.log(t);
    $('#anioActual2').html(t);
    $.ajax({
      url: 'php/obtenerIngresosMensual.php',
      type: 'GET',
      data: 'fecha='+t
    }).done(function(data){
      var o = JSON.parse(data);
      setTimeout(function () {
          chart2.load({
              columns: [
                ['x', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre','Octubre','Noviembre', 'Diciembre'],
                ['Ingresos', o[1], o[2], o[3], o[4], o[5], o[6], o[7], o[8], o[9],o[10],o[11],o[12]]
              ],
          });
      }, 1000);

    });
  }
});






var cambioCal = 0;
$('#rangestart').calendar({
  type: 'date',
  endCalendar: $('#rangeend'),
  disableMinute: false,
  text: {
    days: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
    months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
  },
  formatter: {
    date: function (date, settings) {
      if (!date) return '';
      var day = date.getDate();
      var month = date.getMonth() + 1;
      var year = date.getFullYear();
      return year + '-' + month + '-' + day;
    }
  }
});
$('#rangeend').calendar({
  type: 'date',
  startCalendar: $('#rangestart'),
  disableMinute: false,
  text: {
    days: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
    months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
  },
  onChange: function(a, t) {
    if(!$('#rangeend').calendar('get startDate') == ''){
      $.ajax({
            url: "php/obtenerCargos.php",
            type: "POST",
            data: "fechaInicio=" + $('#fechaInicial').val() + "&fechaFinal=" + t
      }).done(function(data){
        $('#total').html("$"+ number_format(data,2));
      });

    }
  },
  formatter: {
    date: function (date, settings) {
      if (!date) return '';
      var day = date.getDate();
      var month = date.getMonth() + 1;
      var year = date.getFullYear();
      return year + '-' + month + '-' + day;
    }
  }
});
