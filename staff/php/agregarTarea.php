<?php
require_once("conexion.php");
$id_usuario = $_REQUEST["id_usuario"];
$id_reporte = $_REQUEST["id_reporte"];
$id_rubro = $_REQUEST["id_rubro"];
$descripcion = $_REQUEST["descripcion"];
$status = $_REQUEST["status"];

$consulta ="INSERT INTO temporal VALUES (null, $id_usuario, $id_reporte, $id_rubro, '$descripcion', '', '$status', '', '')";
print $consulta;
$ejecutar_consulta = $conexion->query($consulta);
if($ejecutar_consulta){
	//print "Se ejecuto la consulta correctamente";
}else{
	//print "Ocurrio un error consulta al administrador";
}
?>