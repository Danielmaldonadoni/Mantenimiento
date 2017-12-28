<?php
include_once("conexion.php");
$rubro = $_REQUEST["rubro"];
//print $rubro;
$consulta = "INSERT INTO rubros VALUES (null, '$rubro')";
$ejecutar_consulta = $conexion->query($consulta);
if($ejecutar_consulta){
	print "Se agrego corectamente el rubro $rubro";
}else{
	print "Ocurrio un error comuniquese con el administrador";
}
?>