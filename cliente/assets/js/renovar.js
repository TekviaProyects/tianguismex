function renovarClick(idLocal,tipoLocal,fechaInicio){
  $('#'+idLocal).addClass('disabled');
  console.log(idLocal);
  console.log(tipoLocal);
  console.log(fechaInicio);
  var tipo = "";
  switch (tipoLocal) {
    case 3:
      tipo = "ultra";
      break;
    case 4:
      tipo = "super";
      break;
    case 5:
      tipo = "master"
      break;
    default:

  }
  map = new Object();
  map[idLocal] = idLocal;
  $.ajax({
    url : '../php/renovar.php',
    type : 'GET',
    data: 'tipo='+tipo+'&fechaActual='+fechaInicio+"&json="+JSON.stringify(map)
  }).done(function(data){
    console.log(data);
    $('#'+idLocal).removeClass('disabled');
    var contenido = "<iframe id='formato' src="+ data +"></iframe>";
    $('#modalRenovar').html(contenido);
    $('#modalRenovar').modal({
      onHidden:function(){
        $('#loader').removeClass('disabled');
        $('#loader').addClass('active');
        window.location.href = "../panel"
      }
    }).modal('show');

  });
}

function verClick(idOrden){
  console.log(idOrden);
  $.ajax({
    url: '../php/obtenerOrden.php',
    type: 'GET',
    data: 'id_orden='+idOrden
  }).done(function(data){
    var contenido = "<iframe id='formato' src="+ data +"></iframe>";
    $('#modalRenovar').html(contenido);
    $('#modalRenovar').modal('show');
  });
}
