<?php
	include("conexion.php");
	//Consultamos los nombres de los rubros y los guardamos en unn arreglo
	$i = 0;//inicializamos la variable $i en cero que nos ayudara a almacenar los rubros en un arreglo;
	$tabla = "";//esta sera la tabla de inicio con los datos iniciales del reporte como nombre, fecha y otros
	$consulta_rubros = "SELECT * FROM rubros;";
	$ejecutar_consulta_rubros = $conexion->query($consulta_rubros);
	while ($rubros = $ejecutar_consulta_rubros->fetch_assoc()) {
		$registro_ids_rubros[$i] = $rubros["id_rubro"];
		$registro_nombres_rubros[$registro_ids_rubros[$i]] = $rubros["rubro"];
		$i++;
	}
	$id_reporte = $_REQUEST["id_reporte"];
	$consulta = "SELECT R.id_reporte, R.tienda, R.personal, R.fechaInicio, R.fechaTermino, B.id_rubro, R.tienda, B.descripcion, B.comentarios, B.status, B.calificacion, B.entregado_a_tiempo FROM reportes AS R
				LEFT JOIN bitacora AS B 
				ON R.id_reporte = B.id_reporte WHERE R.id_reporte=$id_reporte ORDER BY B.id_rubro ASC";
	$ejecutar_consulta = $conexion->query($consulta);
	if($ejecutar_consulta){
		$filas = $ejecutar_consulta->fetch_assoc();
		//print "Éxito";
		$tabla .= "<table class='table table-bordered table-condensed'>";
			$tabla .= "<thead class='cabecera'>";
				$tabla .= "<tr>";
					$tabla .= "<td>";
						$tabla .= "descripci&oacute;n";
					$tabla .= "</td>";
					$tabla .= "<td>";
						$tabla .= "Tienda";
					$tabla .= "</td>";
					$tabla .= "<td>";
						$tabla .= "Personal";
					$tabla .= "</td>";
					$tabla .= "<td>";
						$tabla .= "Periodo";
					$tabla .= "</td>";
				$tabla .= "</tr>";
			$tabla .= "</thead>";
			$tabla .= "<tbody class='centrar'>";
				$tabla .= "<tr>";
					$tabla .= "<td>";
						$tabla .= $filas["descripcion"];
					$tabla .= "</td>";
					$tabla .= "<td>";
						$tabla .= $filas["tienda"];
					$tabla .= "</td>";
					$tabla .= "<td>";
						$tabla .= $filas["personal"];
					$tabla .= "</td>";
					$tabla .= "<td>";
						//Poner la fecha correctamente-
						$vector_fecha_inicio = explode("-", $filas["fechaInicio"]);
						$vector_fecha_final = explode("-", $filas["fechaTermino"]);
						$tabla .= $vector_fecha_inicio[2]."-".$vector_fecha_inicio[1]."-".$vector_fecha_inicio[0]."&nbsp;<strong>al</strong>&nbsp;".$vector_fecha_final[2]."-".$vector_fecha_final[1]."-".$vector_fecha_final[0];
					$tabla .= "</td>";
				$tabla .= "</tr>";
			$tabla .= "</tbody>";
		$tabla .= "</table>";
		print "<div class='modal-header'>";
			print "<button class='close' data-dismiss='modal' aria-label='close'>";
				print "<span aria-hidden='true'>";
					print "&times;";
				print "</span>";
			print "</button>";
			print "<center>";
				print "<h4>";
					print "Tienda: ".$filas["tienda"].",&nbsp;No&nbsp;reporte:&nbsp;".$filas["id_reporte"];
				print "</h4>";
			print "</center>";
		print "</div>";
		print "<div class='modal-body'>";
			$ejecutar_consulta = $conexion->query($consulta);
			$i = 1;
			$aux="";
			$concatenar2 = "";
			$concatena1 = "";
			$concatena_total = "";
			print $tabla;
			print "<br />";
			print "<table class='table table-bordered table-hover' id='tareas-reporte'>";
				print "<thead>";
					print "<tr class='cabecera'>";
						print "<td>";
							print "Rubro";
						print "</td>";
						print "<td>";
							print "Descripci&oacute;n";
						print "</td>";
						print "<td>";
							print "Comentarios";
						print "</td>";
						print "<td>";
							print "Status";
						print "</td>";
						print "<td>";
							print "Calificaci&oacute;n";
						print "</td>";
						print "<td>";
							print "En&nbsp;tiempo";
						print "</td>";
					print "</tr>";
				print "</thead>";
				print "<tbody class='centrar'>";
					$contador = 0;
					$numero_filas_totales = $ejecutar_consulta->num_rows;
					while ($filas = $ejecutar_consulta->fetch_assoc()) {
						if($i == 1){
							$concatenar2 .= "<tr><td>".$filas["descripcion"]."</td><td>$filas[comentarios]</td><td>$filas[status]</td><td>$filas[calificacion]</td><td>$filas[entregado_a_tiempo]</td></tr>";
							$i++;
						}else{
							if($aux == $filas["id_rubro"]){
								$concatenar2 .= "<tr><td>".$filas["descripcion"]."</td><td>$filas[comentarios]</td><td>$filas[status]</td><td>$filas[calificacion]</td><td>$filas[entregado_a_tiempo]</td></tr>";
								$i++;	
							}else{
								$concatena1 .= "<tr ><td rowspan='$i'>$registro_nombres_rubros[$aux]</td></tr>";
								$concatena_total .= $concatena1.$concatenar2;
								$i = 1;
								$concatena1 = "";
								$concatenar2 = "";
								//print "<>".$i."<>";
								$concatenar2 .= "<tr><td>".$filas["descripcion"]."</td><td>$filas[comentarios]</td><td>$filas[status]</td><td>$filas[calificacion]</td><td>$filas[entregado_a_tiempo]</td></tr>";
								$i++;
							}
						}
						$contador++;
						$aux=$filas["id_rubro"];
						if($contador == $numero_filas_totales){
							$concatena1 .= "<tr ><td rowspan='$i'>$registro_nombres_rubros[$aux]</td></tr>";
							$concatena_total .= $concatena1.$concatenar2;
							$i = 1;
						}
					}
					//print "<h1>".$contador. "vs".$numero_filas_totales."</h1>";
					//print $consulta;
					print $concatena_total;
				print "</tbody>";
			print "</table>";
			print "<br />";
			//Insertar validación si todavia hay tareas pendientes o programadas
			$consulta_si_hay_tareas_pendientes_en_reporte = "";
			$consulta_si_hay_tareas_pendientes_en_reporte = "SELECT * FROM bitacora where id_reporte=$id_reporte AND (status='Pendiente' || status='Programado')";
			//print $consulta_si_hay_tareas_pendientes_en_reporte;
			$ejecutar_consulta_si_hay_tareas_pendientes_en_reporte = $conexion->query($consulta_si_hay_tareas_pendientes_en_reporte);
			if($ejecutar_consulta_si_hay_tareas_pendientes_en_reporte){
				if($ejecutar_consulta_si_hay_tareas_pendientes_en_reporte->num_rows > 0){
					print "<center>";
						print "<button class='btn btn-info' data-toggle='collapse' data-target='#agregar-tarea' aria-expanded='false' aria-controls='agregar-tarea'>";
							print "A&ntilde;adir nueva tarea";
						print "</button>";
					print "</center>";
					print "<br />";
					print "<div class='panel panel-default collapse' id='agregar-tarea'>";
						print "<div class='panel-heading '>";
							print "A&ntilde;adir nueva tarea";
						print "</div>";
						print "<div class='panel-body'>";
							print "<label>";
								print "Selecciona un rubro:";
							print "</label>";
							print "<select id='rubro_slc' class='input form-control' title='Selecciona un rubro' >";
								print "<option style='color:#F1F1F1;' value=''>";
									print "Selecciona un opci&oacute;n";
								print "</option>";
								include("select-rubros.php");
							print "</select>";
							print "<br />";
							print "<label>";
								print "Descripci&oacute;n de la tarea:";
							print "</label>";
							print "<input type='text' class='form-control' name='descripcion' placeholder='Escribe tu descripci&oacute;n' id='descripcion_txt' title='descripci&oacute;n de la tarea'>";
							print "<br />";
							print "<center>";
								print "<button class='btn btn-primary btn-agregar-tarea' id='$id_reporte'>";
									print "Agregar";
								print "</button>";
							print "</center>";
						print "</div>";
					print "</div>";
				}
			}
			print "<center>";
				print "<div id='mensaje' class='alert alert-info fade'>";
				print "</div>";
			print "<center>";
		print "</div>";
		print "<div class='modal-footer'>";
			print "<button type='button' class='btn btn-default' data-dismiss='modal'>";
				print "Cerrar";
			print "</button>";
		print "</div>";
	}else{
		print "Notifique al administrador de este error->".$consulta;
	}
?>