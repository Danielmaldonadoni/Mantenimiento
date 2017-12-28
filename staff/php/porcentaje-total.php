<?php
$id_reporte = $_REQUEST["id_reporte"];
//$rubro = $_REQUEST["rubro"];
require_once "conexion.php";
$consulta = "select 
( 
 (select count(rubro) from temporal where id_reporte = $id_reporte and status = 'REALIZADO')/
    (select count(rubro) from temporal where id_reporte = $id_reporte)
)*100 AS PORCENTAJE";
$ejecutar_consulta = $conexion->query($consulta);
$registro = $ejecutar_consulta->fetch_assoc();
if($ejecutar_consulta){
	if(!$registro["PORCENTAJE"]){
		echo "0";
	}else if($registro["PORCENTAJE"]=="0"){
		echo "0";
	}else{
		echo $registro["PORCENTAJE"]."%";
	}

}else{
	echo "Error";
}








?>