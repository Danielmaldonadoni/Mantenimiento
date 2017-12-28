<?php
if(isset($_REQUEST["id_reporte"])){
	$id_reporte = $_REQUEST["id_reporte"];
	//print "Hey";
}
$tabla = "";
$cont = 0;
$contador = 0;
$aux_rubro = "";
$contador = 0;
$tabla .= "<table id='tabla-tareas-modal' class='table table-condensed table-bordered' style='    table-layout: fixed;'>";
	$tabla .= "<thead class='cabecera'>";
		$tabla .= "<td align='middle'  width='10%'>";
			$tabla .= "Rubro";
		$tabla .= "</td>";
		$tabla .= "<td align='middle'  width='20%'>";
			$tabla .= "Descripción";
		$tabla .= "</td>";
		$tabla .= "<td align='middle'  width='15%'>";
			$tabla .= "Comentarios";
		$tabla .= "</td>";
		$tabla .= "<td align='middle'  width='10%'>";
			$tabla .= "Status";
		$tabla .= "</td>";
		$tabla .= "<td align='middle'  width='10%'>";
			$tabla .= "Calificaci&oacute;n";
		$tabla .= "</td>";
		$tabla .= "<td align='middle'  width='15%'>";
			$tabla .= "En&nbsp;tiempo";
		$tabla .= "</td>";
		$tabla .= "<td align='middle'  width='15%'>";
			$tabla .= "Actualizar";
		$tabla .= "</td>";
	$tabla .= "</thead>";
	$tabla .= "<tbody>";
	$consulta = "SELECT RU.id_rubro, RU.rubro FROM bitacora as B LEFT JOIN rubros as RU ON RU.id_rubro=B.id_rubro WHERE id_reporte=$id_reporte GROUP BY RU.rubro ORDER BY RU.rubro";
	//print $consulta;
	$ejecutar_consulta = $conexion->query($consulta);
	if($ejecutar_consulta){
		$num_filas = $ejecutar_consulta->num_rows;
		if($num_filas>0){
			while($rubros = $ejecutar_consulta->fetch_assoc()){	
				//REalizar nueva consulta y obtener los colspan para poner el rubro invadiendo filas
				$consulta = "SELECT RU.id_rubro, RU.rubro, B.descripcion, B.comentarios, B.status, B.calificacion, B.entregado_a_tiempo, B.id_bitacora FROM bitacora as B LEFT JOIN rubros as RU ON RU.id_rubro=B.id_rubro WHERE id_reporte=$id_reporte AND RU.rubro= '$rubros[rubro]' ORDER BY RU.rubro";
				$ejecutar_consulta_bitacora_reporte = $conexion->query($consulta);
				if($ejecutar_consulta_bitacora_reporte){
					if($ejecutar_consulta_bitacora_reporte->num_rows>0){
						$num_filas = $ejecutar_consulta_bitacora_reporte->num_rows;
						$num_filas +=1;
						$tabla .= "<tr>";
							$tabla .= "<td rowspan='$num_filas' align='middle' data-label='Rubro'>";
							$tabla .= $rubros["rubro"];
							$tabla .= "</td>";
						$tabla .= "</tr>";
						while ($filas = $ejecutar_consulta_bitacora_reporte->fetch_assoc()) {
							$tabla .= "<tr>";
								$tabla .= "<td align='middle' data-label='descripci&oacute;n'>";
									$tabla .= $filas["descripcion"];
								$tabla .= "</td>";
								/////////////Validar status de cada tarea del reporte
								if($filas["status"] == "Pendiente" || $filas["status"] == "Programado"){
									$tabla .= "<td align='middle' data-label='Comentarios'>";
										$tabla .= $filas["comentarios"];
									$tabla .= "</td>";
									$tabla .= "<td align='middle' data-label='Status'>";
										$tabla .= $filas["status"];
									$tabla .= "</td>";
									$tabla .= "<td align='middle' data-label='calificaci&oacute;n'>";
										$tabla .= $filas["calificacion"];
									$tabla .= "</td>";
									$tabla .= "<td align='middle' data-label='En tiempo'>";
										///Vamos a agregar span para poner los radio button
										$tabla .= $filas["entregado_a_tiempo"];
									$tabla .= "</td>";
									$tabla .= "<td align='middle' data-label='Acciones'>";
										$tabla .= "No habilitado";
									$tabla .= "</td>";
								}else{//Si no está pendiente o programado está realizado y podemos habilitar acciones
									if($filas["comentarios"]=="" && ($filas["calificacion"]=='' || $filas["calificacion"]=='0')){
										$tabla .= "<td align='middle' data-label='Comentarios' id='comentarios".$filas["id_bitacora"]."' class='rojo' contenteditable>";
											$tabla .= $filas["comentarios"];
										$tabla .= "</td>";
									}else{
										$tabla .= "<td align='middle' data-label='Comentarios' id='comentarios".$filas["id_bitacora"]."'>";
											$tabla .= $filas["comentarios"];
										$tabla .= "</td>";
									}
									$tabla .= "<td align='middle' data-label='Status'>";
										$tabla .= $filas["status"];
									$tabla .= "</td>";
									if($filas["calificacion"]=='' || $filas["calificacion"]=="0"){
										$tabla .= "<td align='middle' data-label='calificaci&oacute;n' id='calificacion".$filas["id_bitacora"]."' class='rojo calificacion' contenteditable>";
											$tabla .= $filas["calificacion"];
										$tabla .= "</td>";
										$tabla .= "<td align='middle' data-label='En tiempo'>";
											///Vamos a agregar span para poner los radio button
											$tabla .= "<strong>";
												$tabla .= "Si";
											$tabla .= "</strong>";
											$tabla .= "<input type='radio' class='radios".$filas["id_bitacora"]."' name='radios".$filas["id_bitacora"]."'  id='radios".$filas["id_bitacora"]."' value='Si'/>";
											$tabla .= "<strong>";
												$tabla .= "&nbsp;";
												$tabla .= "&nbsp;";
												$tabla .= "No";
											$tabla .= "</strong>";
											$tabla .= "<input type='radio' class='radios".$filas["id_bitacora"]."' name='radios".$filas["id_bitacora"]."' id='radios".$filas["id_bitacora"]."' value='No' />";
										$tabla .= "</td>";
										$tabla .= "<td align='middle' data-label='Acciones'>";
											$tabla .= "<button class='btn btn-primary actualizar-tarea' id='".$filas["id_bitacora"]."'>";
												$tabla .= "<span class='glyphicon glyphicon-refresh'>";
												$tabla .= "</span>";
											$tabla .= "</button>";
										$tabla .= "</td>";
									}else{
										$tabla .= "<td align='middle' data-label='calificaci&oacute;n' >";
											$tabla .= $filas["calificacion"];
										$tabla .= "</td>";
										$tabla .= "<td align='middle' data-label='a tiempo'>";
											$tabla .= $filas["entregado_a_tiempo"];
										$tabla .= "</td>";
										$tabla .= "<td align='middle' data-label='acciones'>";
											$tabla .= "Actualizado";
										$tabla .= "</td>";
									}
								}
							$tabla .= "</tr>";			
						}
					}
				}
			}
			$tabla .= "</tbody></table>";
		}
	}
	print $tabla;
?>