<?php 
	//include_once("conexion.php");
	$tienda = $_REQUEST["tienda"];
	$pagina_actual = $_REQUEST["num_pagina"];
	//print $tienda;
	//$tipo_trabajo = $_REQUEST["opcion"];
	$consulta = "SELECT * FROM reportes WHERE tienda = '$tienda'";
	$ejecutar_consulta = $conexion->query($consulta);
	$num_reportes = $ejecutar_consulta->num_rows;

	$num_divisiones = 10;
	$num_paginas = ceil($num_reportes/$num_divisiones);
	$lista = "";
	$tabla = "";
	//print $tienda."   ".$num_pagina;
	if($pagina_actual>1){
		$lista .= '<li><a href="javascript:listarReportes('.($pagina_actual-1).');">Anterior</a></li>';
	}
	for ($i=1; $i <=$num_paginas ; $i++) { 
		# code...
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
 ?>
