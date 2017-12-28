<?php 
	$id_supervisor = $_REQUEST["id_supervisor"];
	$pagina_actual = $_REQUEST["num_pagina"];
	$tabla = "";
	include("conexion.php");
	$consulta = "SELECT R.id_reporte, R.titulo, R.descripcion, R.tienda, R.personal, R.fechaInicio, R.fechaTermino, CAL.servicio, CAL.calidad, CAL.velocidad, CAL.promedio FROM reportes as R
				LEFT JOIN tiendas AS T 
				ON R.tienda = T.tienda
				LEFT JOIN supervisores AS S
				ON S.nombre = T.supervisor 
				LEFT JOIN encuesta_calificacion_servicio AS CAL 
				ON CAL.id_reporte = R.id_reporte WHERE id_supervisor=$id_supervisor";
	$ejecutar_consulta = $conexion->query($consulta);
	if($ejecutar_consulta){
		//print "Éxito";
		if($ejecutar_consulta->num_rows > 0){
			$num_reportes = $ejecutar_consulta->num_rows;
			$num_divisiones = 10;
			$num_paginas = ceil($num_reportes/$num_divisiones);
			$lista = "";
			$tabla = "";
			//print $id_usuario."   ".$num_pagina;
			if($pagina_actual>1){
				$lista .= '<li><a href="javascript:listadoReportes('.($pagina_actual-1).');">Anterior</a></li>';
			}
			for ($i=1; $i <=$num_paginas ; $i++) { 
				
				if($i==$pagina_actual){
					$lista .= '<li class="active"><a href="javascript:listadoReportes('.$i.')">'.$i.'</a></li>';
				}else{
					$lista .= '<li><a href="javascript:listadoReportes('.$i.')">'.$i.'</a></li>';
				}
			}
			if($pagina_actual<$num_paginas){
				$lista .= '<li><a href="javascript:listadoReportes('.($pagina_actual+1).')">Siguiente</a></li>';
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
		}
	}else{
		print $consulta;
	}



?>