<?php 	
	if(isset($_REQUEST["id_reporte"])){
		include_once("conexion.php");
	}
	$control = 1; //El uno de verdadero
	$comentarios = $_REQUEST["comentarios"];
	$calificacion = $_REQUEST["calificacion"];
	$entregado_a_tiempo = $_REQUEST["entregado_a_tiempo"];
	$id_bitacora = $_REQUEST["id_bitacora"];
	$consulta = "UPDATE bitacora SET comentarios='$comentarios', calificacion='$calificacion', entregado_a_tiempo='$entregado_a_tiempo' WHERE id_bitacora=$id_bitacora";
	$ejecutar_consulta = $conexion->query($consulta);
	if($ejecutar_consulta){
		print "<div id='mensaje' class='alert alert-info'>Informaci&oacute;n actualizada con &eacute;xito.</div>";
	}
	//print $consulta;
	include_once("tabla-reporte-ventana-emergente.php");
?>