<?php
	include_once("conexion.php");
	$id_usuario = $_REQUEST["id_usuario"];
	$pagina_actual = $_REQUEST["pagina"];
	$tipo_trabajo = $_REQUEST["opcion"];


	if($tipo_trabajo=="" || $tipo_trabajo=="Todo"){
		$consulta = "SELECT * FROM reportes WHERE id_usuario='$id_usuario'";
		$ejecutar_consulta = $conexion->query($consulta);
		$num_reportes = $ejecutar_consulta->num_rows;
	}else if($tipo_trabajo=="Programados"){
		$consulta = "SELECT * FROM reportes WHERE id_usuario='$id_usuario' AND estado='1'";
		$ejecutar_consulta = $conexion->query($consulta);
		$num_reportes = $ejecutar_consulta->num_rows;	
	}else if($tipo_trabajo=="Pendientes"){
		$consulta = "SELECT * FROM reportes WHERE id_usuario='$id_usuario' AND estado='2'";
		$ejecutar_consulta = $conexion->query($consulta);
		$num_reportes = $ejecutar_consulta->num_rows;	
	}else if($tipo_trabajo=="Realizados"){
		$consulta = "SELECT * FROM reportes WHERE id_usuario='$id_usuario' AND estado='3'";
		$ejecutar_consulta = $conexion->query($consulta);
		$num_reportes = $ejecutar_consulta->num_rows;
	}
	$num_divisiones = 10;
	$num_paginas = ceil($num_reportes/$num_divisiones);
	$lista = "";
	$tabla = "";
	//print $id_usuario."   ".$num_pagina;
	if($pagina_actual>1){
		$lista .= '<li><a href="javascript:listarReportes('.($pagina_actual-1).');">Anterior</a></li>';
	}
	for ($i=1; $i <=$num_paginas ; $i++) { 
		
		if($i==$pagina_actual){
			$lista .= '<li class="active"><a href="javascript:listarReportes('.$i.')">'.$i.'</a></li>';
		}else{
			$lista .= '<li><a href="javascript:listarReportes('.$i.')">'.$i.'</a></li>';
		}
	}
	if($pagina_actual<$num_paginas){
		$lista .= '<li><a href="javascript:listarReportes('.($pagina_actual+1).')">Siguiente</a></li>';
	}

	if($pagina_actual<=1){
		$limit = 0;
	}else{
		$limit = $num_divisiones*($pagina_actual-1);
	}
	if($num_reportes>0){
		include_once("tabla-listado-reportes.php");
		print "<center><ul class=pagination>".$lista."</ul></center>";
	}else{
		print "<div>No se encontrarón registros por favor registre primero <a href='index.php?op=alta'>Registrar reporte</a></div>";
	}
?>