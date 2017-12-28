<?php
	//include("conexion.php");
	$consulta = "SELECT * FROM rubros ORDER BY rubro ASC";
	$ejecutar_consulta = $conexion->query($consulta);
	if($ejecutar_consulta){
		while($filas = $ejecutar_consulta->fetch_assoc()){
			$nombre_rubro = $filas["rubro"];
			$id_rubro = $filas["id_rubro"];
			print "<option value='$id_rubro'>";
				print $nombre_rubro;
			print "</option>";
		}
	}

?>