<?php
		require_once "conexion.php";
		$consulta = "SELECT id_reporte FROM reportes ORDER BY id_reporte DESC LIMIT 1";
		$ejecutar_consulta = $conexion->query($consulta);
		$registro = $ejecutar_consulta->fetch_assoc();
		$id_reporte = $registro["id_reporte"]+1;
		echo "<h3><strong>Folio: $id_reporte</strong></h3><input type='hidden' id='id_reporte' name='id_reporte' value='$id_reporte' />";
		//echo $idUsuario;


?>