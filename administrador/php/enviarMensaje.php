<?php
include('conexionTextoV3.php');
$mensajero = new conexionTextoV3();
$telefono = $_GET['telefono'];
$mensaje = $_GET['texto'];

try{
  $mensaje = quitarAcentos($mensaje);
  $mensajero->enviarMensaje($telefono,$mensaje);
  echo 'true';
}catch(Exception $e){
  echo 'false';
}
function quitarAcentos($text)
        {
                $text = htmlentities($text, ENT_QUOTES, 'UTF-8');
                $text = strtolower($text);
                $patron = array (



                        // Vocales
                        '/&agrave;/' => 'a',
                        '/&egrave;/' => 'e',
                        '/&igrave;/' => 'i',
                        '/&ograve;/' => 'o',
                        '/&ugrave;/' => 'u',

                        '/&aacute;/' => 'a',
                        '/&eacute;/' => 'e',
                        '/&iacute;/' => 'i',
                        '/&oacute;/' => 'o',
                        '/&uacute;/' => 'u',

                        '/&acirc;/' => 'a',
                        '/&ecirc;/' => 'e',
                        '/&icirc;/' => 'i',
                        '/&ocirc;/' => 'o',
                        '/&ucirc;/' => 'u',

                        '/&atilde;/' => 'a',
                        '/&etilde;/' => 'e',
                        '/&itilde;/' => 'i',
                        '/&otilde;/' => 'o',
                        '/&utilde;/' => 'u',

                        '/&auml;/' => 'a',
                        '/&euml;/' => 'e',
                        '/&iuml;/' => 'i',
                        '/&ouml;/' => 'o',
                        '/&uuml;/' => 'u',

                        '/&auml;/' => 'a',
                        '/&euml;/' => 'e',
                        '/&iuml;/' => 'i',
                        '/&ouml;/' => 'o',
                        '/&uuml;/' => 'u',

                        // Otras letras y caracteres especiales
                        '/&aring;/' => 'a',
                        '/&ntilde;/' => 'n',

                        // Agregar aqui mas caracteres si es necesario

                );

                $text = preg_replace(array_keys($patron),array_values($patron),$text);
                return $text;}
?>
