<?php  
	//Codigo que concatena los datos de la tabla listado reportes
	$tabla .= "<table class='table table-bordered table-reponsive'>";
		$tabla .= "<thead class='cabecera'>";
			$tabla .= "<td align='middle' >";
				$tabla .= "No reporte";
			$tabla .= "</td>";
			$tabla .= "<td align='middle' >";
				$tabla .= "Descripci&oacute;n";
			$tabla .= "</td>";
			$tabla .= "<td align='middle' >";
				$tabla .= "Responsable";
			$tabla .= "</td>";
			$tabla .= "<td align='middle' >";
				$tabla .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Periodo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			$tabla .= "</td>";
			$tabla .= "<td align='middle' >";
				$tabla .= "Servicio";
			$tabla .= "</td>";
			$tabla .= "<td align='middle'>";
				$tabla .= "Calidad";
			$tabla .= "</td>";
			$tabla .= "<td align='middle' >";
				$tabla .= "Velocidad";
			$tabla .= "</td>";
			$tabla .= "<td align='middle' >";
				$tabla .= "Promedio";
			$tabla .= "</td>";
		$tabla .= "</thead>";
		$tabla .= "<tbody>";
			while($filas = $ejecutar_consulta->fetch_assoc()){
				$tabla .= "<tr>";
					$tabla .= "<td align='middle'>";
						$tabla .= "<a href='#myModal' data-toggle='modal' data-target='#myModal' id='".$filas["id_reporte"]."' class='presionar'>";
							$tabla .= $filas["id_reporte"];
						$tabla .= "</a>";
					$tabla .= "</td>";
					$tabla .= "<td align='middle'>";
						$tabla .= $filas["descripcion"];
					$tabla .= "</td>";
					$tabla .= "<td align='middle'>";
						$tabla .= $filas["personal"];
					$tabla .= "</td>";
					$tabla .= "<td align='middle'>";
						//Poner la fecha correctamente-
						$vector_fecha_inicio = explode("-", $filas["fechaInicio"]);
						$vector_fecha_final = explode("-", $filas["fechaTermino"]);
						$tabla .= $vector_fecha_inicio[2]."-".$vector_fecha_inicio[1]."-".$vector_fecha_inicio[0]."&nbsp;<strong>al</strong>&nbsp;".$vector_fecha_final[2]."-".$vector_fecha_final[1]."-".$vector_fecha_final[0];
					$tabla .= "</td>";
					if($filas["servicio"]=='' && $filas["calidad"]=='' && $filas["velocidad"]==''){
						$tabla .= "<td align='middle' colspan='4'>";
							$tabla .= "Sin&nbsp;calificaci&oacute;n";
						$tabla .= "</td>";
					}else{
						$tabla .= "<td align='middle'>";
							$tabla .= $filas["servicio"];
						$tabla .= "</td>";
						$tabla .= "<td align='middle'>";
							$tabla .= $filas["calidad"];
						$tabla .= "</td>";
						$tabla .= "<td align='middle'>";
							$tabla .= $filas["velocidad"];
						$tabla .= "</td>";
						$tabla .= "<td align='middle'>";
							$tabla .= round($filas["promedio"], 2);
						$tabla .= "</td>";
					}
				$tabla .= "</tr>";
			}
		$tabla .= "</tbody>";
	$tabla .= "</table>";
	print $tabla;





?>