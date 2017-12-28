<?php  
	include("conexion.php");
	$id_reporte = $_REQUEST["id_reporte"];
	$consulta = "SELECT ((SELECT COUNT(bitacora.id_reporte) FROM bitacora WHERE bitacora.id_reporte=$id_reporte AND bitacora.status = 'Realizado')*100/(SELECT COUNT(bitacora.id_reporte) FROM bitacora WHERE bitacora.id_reporte=$id_reporte)) AS porcentaje";
	$ejecutar_consulta = $conexion->query($consulta);
	if($ejecutar_consulta){
		$registro = $ejecutar_consulta->fetch_assoc();
		print round($registro["porcentaje"], 2)."%";
	}else{
		print "0%";
	}
?>