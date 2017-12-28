<?php 
	include("conexion.php");
	$id_reporte = $_REQUEST["id_reporte"];
	$servicio = $_REQUEST["servicio"];
	$calidad = $_REQUEST["calidad"];
	$velocidad = $_REQUEST["velocidad"];
	$promedio = ($servicio + $calidad + $velocidad)/3;
	$consulta = "INSERT INTO encuesta_calificacion_servicio VALUES(null, $id_reporte, $servicio, $calidad, $velocidad, $promedio, '')";
	$ejecutar_consulta = $conexion->query($consulta);
	$consulta_actualizar_campo_califcado_en_reporte = "UPDATE reportes SET calificado = 1 WHERE id_reporte=$id_reporte";
	$ejecutar_consulta_actualiazar_campo_calificado_en_reporte = $conexion->query($consulta_actualizar_campo_califcado_en_reporte);
	if($ejecutar_consulta && $ejecutar_consulta_actualiazar_campo_calificado_en_reporte){
		print "<div class='alert alert-success'>Datos agregados con éxito, refrescar p&aacute;gina</div>";
	}else{
		//print "Ocurrio un error $consulta";
		print "<div class='alert alert-danger'>Error inesperado por favor solicite ayuda del administrador. o intente recargar la p&aacute;gina</div>";
	}
?>