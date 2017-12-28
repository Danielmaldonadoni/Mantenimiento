<?php
	include_once("conexion.php"); 
	$tabla = "";
	include_once("paginacion-reportes.php");
	$consulta = "SELECT R.id_reporte, R.descripcion, R.personal, R.fechaInicio, R.fechaTermino, ENC.servicio, ENC.calidad, ENC.velocidad, ENC.promedio FROM reportes as R LEFT JOIN encuesta_calificacion_servicio AS ENC on ENC.id_reporte=R.id_reporte WHERE R.tienda='$tienda' LIMIT $limit, $num_divisiones";
	$ejecutar_consulta = $conexion->query($consulta);
	if($ejecutar_consulta){
		$num_filas = $ejecutar_consulta->num_rows;
		//print "<h1>".$num_filas."</h1>";
		if($num_filas>0){
			$tabla .= "<table class='table table-hover table-bordered table-condensed'>";
				$tabla .= "<thead>";
					$tabla .= "<tr class='cabecera'>";
						$tabla .= "<td align='middle'>";
							$tabla .= "No&nbsp;reporte";
						$tabla .= "</td>";
						$tabla .= "<td align='middle'>";
							$tabla .= "Descripci&oacute;n";
						$tabla .= "</td>";
						$tabla .= "<td align='middle'>";
							$tabla .= "Responsable";
						$tabla .= "</td>";
						$tabla .= "<td align='middle'>";
							$tabla .= "&nbsp;Periodo&nbsp;";
						$tabla .= "</td>";
						$tabla .= "<td align='middle'>";
							$tabla .= "Servicio";
						$tabla .= "</td>";
						$tabla .= "<td align='middle'>";
							$tabla .= "Calidad";
						$tabla .= "</td>";
						$tabla .= "<td align='middle'>";
							$tabla .= "Velocidad";
						$tabla .= "</td>";
						$tabla .= "<td align='middle'>";
							$tabla .= "Promedio";
						$tabla .= "</td>";
					$tabla .= "</tr>";
				$tabla .= "</thead>";
				$tabla .= "<tbody>";
				//////Poner ciclo while
				while($filas = $ejecutar_consulta->fetch_assoc()){
					$tabla .= "<tr>";
						$tabla .= "<td align='middle'>";
							$tabla .= "<a href='#ventana1' class='presionar' data-toggle='modal' id='".$filas['id_reporte']."'>";
								$tabla .= $filas["id_reporte"];
							$tabla .= "</a>";
						$tabla .= "</td>";
						$tabla .= "<td align='middle'>";
							$tabla .= $filas["descripcion"];
						$tabla .= "</td>";
						$tabla .= "<td align='middle'>";
							$tabla .= $filas["personal"];
						$tabla .= "</td>";
						$tabla .= "<td align='middle' class='ancho-fecha'>";
							///////////modificando las fechas para poner las en el orden correcto
							$fecha_inicio = explode("-", $filas["fechaInicio"]);//Fecha de inicio
							$fecha_termino = explode("-", $filas["fechaTermino"]);
							$tabla .= $fecha_inicio[2]."-".$fecha_inicio[1]."-".$fecha_inicio[0];
							$tabla .= "&nbsp;<strong>al</strong>&nbsp;";
							$tabla .= $fecha_termino[2]."-".$fecha_termino[1]."-".$fecha_termino[0];
						$tabla .= "</td>";
						if($filas["servicio"]=='' && $filas["calidad"]=='' && $filas["velocidad"]==''){
							$tabla .= "<td style='text-align:center;' colspan='4'>";
								$tabla .= "Sin contestar";
							$tabla .= "</td>";
						}else{
							$tabla .= "<td align='middle'> <span data-toggle='popover' data-trigger='hover' data-placement='left' data-content='El servicio prestado es' title='Pregunta 1'>";
								$tabla .= $filas["servicio"];
							$tabla .= "</span></td>";
							$tabla .= "<td align='middle'> <span data-toggle='popover' data-trigger='hover' data-placement='left' data-content='La calidad de los trabajos es' title='Pregunta 2'>";
								$tabla .= $filas["calidad"];
							$tabla .= "</span></td>";
							$tabla .= "<td align='middle'> <span data-toggle='popover' data-trigger='hover' data-placement='left' data-content='La velocidad de respuesta es' title='Pregunta 3'>";
								$tabla .= $filas["velocidad"];
							$tabla .= "</span></td>";		
							$tabla .= "<td align='middle'>";
								$tabla .= round($filas["promedio"], 2);
							$tabla .= "</td>";		
						}
					$tabla .= "</tr>";
				}
				////Fin ciclo while
				$tabla .= "</tbody>";
			$tabla .= "</table>";
		}
	}else{
		print $consulta;
	}


	print $tabla;
	print "<center><ul class=pagination>".$lista."</ul></center>";
?>