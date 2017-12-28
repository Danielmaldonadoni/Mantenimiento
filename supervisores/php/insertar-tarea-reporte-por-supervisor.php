<?php
	$id_reporte = $_REQUEST["id_reporte"];
	$rubro_slc = $_REQUEST["rubro_slc"];
	$descripcion = $_REQUEST["descripcion"];
	include("conexion.php");
	$consulta = "INSERT INTO bitacora VALUES (null, 1, $id_reporte, $rubro_slc, '$descripcion', 0, 'Pendiente', '', '')";
	$ejecutar_consulta = $conexion->query($consulta);
	if($ejecutar_consulta){
		print "Tarea agregada con &eacute;xito";
	}else{
		print "Ocurrio un error favor de avisar al administrador de esto: ".$consulta;
	}

?>