<?php
header("Content-Type: application/vnd.ms-excel charset=UTF-8");

//establecemos el timezone para obtener la hora local
//Inicio de exportación en Excel
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Reporte.csv"); //Indica el nombre del archivo resultante
header("Pragma: no-cache");
header("Expires: 0");



$cadena = utf8_decode($_POST['areatextexportar']);

echo $cadena;


?>
