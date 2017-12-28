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
?>