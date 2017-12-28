<?php  
	include_once("conexion.php");
	$id_reporte = $_REQUEST["id_reporte"];
	$consulta = "SELECT (((SELECT COUNT(bitacora.id_bitacora) FROM bitacora WHERE bitacora.id_reporte=$id_reporte AND bitacora.status='Realizado')*100)/(SELECT COUNT(bitacora.id_bitacora) FROM bitacora WHERE bitacora.id_reporte=$id_reporte)) AS porcentaje";
	$ejecutar_consulta = $conexion->query($consulta);
	if($ejecutar_consulta){
		$registro = $ejecutar_consulta->fetch_assoc();
		if(!$registro["porcentaje"]){
			print "0%";
		}else{
			$porcentaje = round($registro["porcentaje"], 0); 
			print $porcentaje."%";
			if($porcentaje==100){
				$consulta_actualizar_estado_reporte = "UPDATE reportes SET estado = 3 WHERE id_reporte = $id_reporte";
				$ejecutar_consulta_actualizar_estado_reporte = $conexion->query($consulta_actualizar_estado_reporte);
			}

		}
	}

?>