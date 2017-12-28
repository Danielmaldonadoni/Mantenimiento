<?php
function conectarse()
{
	$servidor="localhost";
	$usuario="micheldo_diego";
	$password="dosorio1";
	$bd="micheldo_mantenimiento_reportes";

	$conectar = new mysqli($servidor,$usuario,$password,$bd);
	return $conectar;
}

$conexion = conectarse();
$conexion->query("SET NAMES UTF8");
?>