<?php
include_once("conexion.php");
$id_rubro = $_REQUEST["id_rubro"];
$rubro = $_REQUEST["rubro"];
//print $id_rubro;
$consulta = "UPDATE rubros SET rubro = '$rubro' WHERE id_rubro=$id_rubro";
$ejecutar_consulta = $conexion->query($consulta);
if($ejecutar_consulta){
	//$num_rows = $ejecutar_consulta->num_rows;
	print "<div class='ok'>Datos actualizados correctamente</div>";
}else{
	print "<div class='ko'>Error inesperado intenta mas tarde o informa al administrador de error</div>";
}


?>