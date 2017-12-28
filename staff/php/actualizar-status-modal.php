<?php  
$id_bitacora = $_REQUEST["id_bitacora"];
$status = $_REQUEST["status"];
include_once("conexion.php");
$consulta = "UPDATE bitacora SET status='$status' WHERE id_bitacora = $id_bitacora";
$ejecutar_consulta = $conexion->query($consulta);
if($ejecutar_consulta){
	print "Se actualizó status satisfactoriamente.";
}else{
	print "Error inesperado favor de avisar al administrador!!!";
}
?>