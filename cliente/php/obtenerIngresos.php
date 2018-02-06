<?php
include('conexion.php');
  $año = date('Y');
  $mes = 1;
  $arreglo = array();
  do{
    if($mes < 10){$mesInicio = "0".$mes;}else{$mesInicio = $mes;}
    if($mes < 9){
          $mesFinal = "0". $mes + 1;
    }else{
        $mesFinal = $mes + 1;
        if($mes == 12){
          $mesFinal = '01';
        }
    }
    $fechaInicio = $año."-".$mesInicio."-01";


    if($mes == 12){

      $a = (int)$año + 1;
      $fechaFinal = $a."-".$mesFinal."-01";
    }else{
      $fechaFinal = $año."-".$mesFinal."-01";
    }
    $resultado = $conexionDb->personalizada("SELECT SUM(cantidad) FROM `reporte` WHERE `fecha`>='$fechaInicio' AND fecha < '$fechaFinal'");
    $i = 0;
    while($fila = mysqli_fetch_assoc($resultado)){
      $arreglo[$mes] = $fila['SUM(cantidad)'];
      if($fila['SUM(cantidad)']==''){
        $arreglo[$mes] = '0';
      }
      $i++;
    }

    $mes++;
  }while($mes<13);
  echo json_encode($arreglo);
?>
