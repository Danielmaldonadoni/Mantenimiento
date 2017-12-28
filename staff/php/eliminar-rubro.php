<?php
include_once("conexion.php");
$id_rubro = $_REQUEST["id_rubro"];
//print $id_rubro;
$consulta = "DELETE FROM rubros WHERE id_rubro=$id_rubro";
$ejecutar_consulta = $conexion->query($consulta);
if($ejecutar_consulta){
	//$num_rows = $ejecutar_consulta->num_rows;
	print "Rubro eliminado correctamente.";
}else{
	print "Error inesperado intenta mas tarde o informa al administrador del error.";
}


?>