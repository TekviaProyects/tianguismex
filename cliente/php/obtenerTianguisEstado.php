<?php
  include('dbmysqli.php');

  function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
}






  $arreglo = array();
  try{
    $conexionDb = new dbmysqli();
    if($estado == 0){
      $resultado = $conexionDb->buscar('tianguis',"");
    }else{
      $resultado = $conexionDb->buscar('tianguis','WHERE estado_tianguis = '.$estado);
    }

    while($fila = mysqli_fetch_assoc($resultado)){
      array_push($arreglo,$fila);
    }

    echo json_encode(utf8ize($arreglo));


  }catch(Exception $e){
    var_dump($e);
  }




?>
