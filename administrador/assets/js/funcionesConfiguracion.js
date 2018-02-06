$.ajax({
  url: 'php/obtenerLocales.php',
  type: 'get'
}).done(function(data){
  $.each(JSON.parse(data), function(idx , obj){
    var tipo = "";
    switch (obj.tipo_local) {
      case "1":
        tipo = "normal";
        break;
      case "2":
        tipo = "class";
        break;
      case "3":
        tipo = "ultra";
        break;
      case "4":
        tipo = "super-ultra";
        break;
      case "5":
        tipo = "master";
        break;
    }

    $('#tablaConfiguracion tbody').append("<tr><td>"+ obj.nombre_local +"</td><td><a href='#' id='"+ obj.id_local +"texto' class='tipo_local' data-type='select' data-pk='1' data-url='/post' data-title='Enter username'>"+tipo+"</a></td><td><button id='"+ obj.id_local +"' type='button' name='button' class='btnEditar'><i class='write icon'></i></button></td></tr>");

  });
  $('#tablaConfiguracion').DataTable({
    language:{
      search: "",
      sLengthMenu: "_MENU_",
      searchPlaceholder: "Buscar en la tabla",
      oPaginate: {
          sPrevious: "<",
          sNext: ">"
      }
    }
  });
});

$('#tablaConfiguracion').on('click','.btnEditar',function(){
  console.log("hola");
  console.log($(this).attr('id'));
  $('#id_local').attr('value',$(this).attr('id'));
  $('#modalEditar').modal('show');
});
$("#btnEditar").on('click',function(){
  var valor = $('#selectEditar').val();
  console.log(valor);
  $.ajax({
    url:'php/modificarLocal.php',
    type:'get',
    data: 'tipo_local='+valor+'&id_local='+$('#id_local').attr('value')
  }).done(function(data){
    console.log(data);
    var tipo = "";
    switch (valor) {
      case "1":
        tipo = "normal";
        break;
      case "2":
        tipo = "class";
        break;
      case "3":
        tipo = "ultra";
        break;
      case "4":
        tipo = "super-ultra";
        break;
      case "5":
        tipo = "master";
        break;
    }
    $('#'+$('#id_local').attr('value')+"texto").html(tipo);
    $('#modalEditar').modal('hide');
  });

});
