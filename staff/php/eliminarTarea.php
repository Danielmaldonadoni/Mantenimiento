<?php
include_once("conexion.php");
$id_temporal = $_REQUEST["id_temporal"];
$consulta = "DELETE FROM temporal WHERE id_temporal=$id_temporal";	
$ejecutar_consulta = $conexion->query($consulta);
if($ejecutar_consulta){
	print "Se ejecuto consulta";
}else{
	print "Ocurrio un error favor de consultar al administrador";
}
?>