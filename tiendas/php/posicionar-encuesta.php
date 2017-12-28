<?php
	include("conexion.php");
	$control = 0;
	$id_reporte = $_REQUEST["id_reporte"];
	$consulta = "SELECT ((SELECT COUNT(bitacora.id_bitacora) FROM bitacora WHERE bitacora.id_reporte=$id_reporte AND bitacora.calificacion <> '0')/(SELECT COUNT(bitacora.id_bitacora) FROM bitacora WHERE bitacora.id_reporte=$id_reporte)) AS total";
	$ejecutar_consulta = $conexion->query($consulta);
	if($ejecutar_consulta){
		if($ejecutar_consulta->num_rows>0){
			$registro = $ejecutar_consulta->fetch_assoc();
			//print $consulta;
			//print round($registro["total"],1);
			$control = round($registro["total"],1);
			if($control==1){
				//Realizamos ahora la consulta de la tabla reportes para saber si ya esta califcado o no la encuesta
				$consulta_califcado_reporte = "SELECT calificado FROM reportes WHERE id_reporte = $id_reporte";
				$ejecutar_consulta_calificado_reporte = $conexion->query($consulta_califcado_reporte);
				if($ejecutar_consulta_calificado_reporte && $ejecutar_consulta_calificado_reporte->num_rows>0){
					$registro = $ejecutar_consulta_calificado_reporte->fetch_assoc();
					if($registro["calificado"]==0){
						include("calificacion-servicio.php");
					}
				}
			}
		}else{
			print $consulta;
		}
	}else{
		print $consulta;
	}

?>