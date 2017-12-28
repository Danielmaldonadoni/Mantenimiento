<?php  
$id_temporal = $_REQUEST["id_temporal"];
$status = $_REQUEST["status"];
include_once("conexion.php");
$consulta = "UPDATE temporal SET status='$status' WHERE id_temporal = $id_temporal";
$ejecutar_consulta = $conexion->query($consulta);
if($ejecutar_consulta){
	print "Se actualizo status correctamente";
}else{
	print "Ocurrio un erro por favor contacta al administrador";
}
?>