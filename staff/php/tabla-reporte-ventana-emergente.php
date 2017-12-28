<?php
if(isset($_REQUEST["id_reporte"])){
	$id_reporte = $_REQUEST["id_reporte"];
	include_once("conexion.php");
}
$tabla = "";
$cont = 0;
$aux_rubro = "";
$contador = 0;
$tabla .= "<table id='tabla-tareas-modal' class='table table-condensed table-bordered'>";
	$tabla .= "<thead class='cabecera'>";
		$tabla .= "<td align='middle'  width='20%'>";
			$tabla .= "Rubro";
		$tabla .= "</td>";
		$tabla .= "<td align='middle'  width='30%'>";
			$tabla .= "Descripción";
		$tabla .= "</td>";
		$tabla .= "<td align='middle'  width='20%'>";
			$tabla .= "Calificación";
		$tabla .= "</td>";
		$tabla .= "<td align='middle'  width='30%'>";
			$tabla .= "Status";
		$tabla .= "</td>";
	$tabla .= "</thead>";
	$tabla .= "<tbody>";
	$consulta = "SELECT B.id_bitacora, B.id_reporte, RU.id_rubro, RU.rubro, B.descripcion, B.calificacion, B.status FROM bitacora as B LEFT JOIN rubros as RU ON RU.id_rubro=B.id_rubro WHERE id_reporte=$id_reporte ORDER BY RU.rubro";
	$ejecutar_consulta = $conexion->query($consulta);
	if($ejecutar_consulta){
		$num_filas = $ejecutar_consulta->num_rows;
		if($num_filas>0){
			while($filas = $ejecutar_consulta->fetch_assoc()){
				if($contador==0){
					$tabla .= "<tr>";
						$tabla .= "<td align='middle' >";
							$tabla .= $filas["rubro"];
						$tabla .= "</td>";
						$tabla .= "<td colspan='3'>";
							$tabla .= "<table class='qw table-bordered' border=1 width='100%'>";
								$tabla .= "<thead>";
								$tabla .= "</thead>";
								$tabla .= "<tbody>";
									$tabla .= "<tr>";
											$tabla .= "<td align='middle' width='30%'>";
												$tabla .= $filas["descripcion"];
											$tabla .= "</td>";
											$tabla .= "<td align='middle' width='20%'>";
												$tabla .= $filas["calificacion"];
											$tabla .= "</td>";
											if($filas["status"]=="Pendiente" || $filas["status"]=="Programado"){
												$tabla .= "<td align='middle' width='30%' style='background: #e8384f;' class='actualizar-status-modal' id='".$filas["id_bitacora"]."'>";
													$tabla .= "<span id='".$filas["id_bitacora"]."' class='status-modal'>";
														$tabla .= $filas["status"];
													$tabla .= "</span>";
												$tabla .= "</td>";
											}else{
												$tabla .= "<td align='middle' width='30%'>";
													$tabla .= $filas["status"];
												$tabla .= "</td>";
											}
									$tabla .= "</tr>";
								$tabla .= "</tbody>";
							$tabla .= "</table>";
						$aux_rubro=$filas["rubro"];
				}else{
					if($filas["rubro"]==$aux_rubro){
						$tabla .= "<table class='qw table-bordered' border=1 width='100%'>";
							$tabla .= "<thead>";
							$tabla .= "</thead>";
							$tabla .= "<tbody>";
								$tabla .= "<tr>";
										$tabla .= "<td align='middle' width='30%'>";
											$tabla .= $filas["descripcion"];
										$tabla .= "</td>";
										$tabla .= "<td align='middle' width='20%'>";
											$tabla .= $filas["calificacion"];
										$tabla .= "</td>";
										if($filas["status"]=="Pendiente" || $filas["status"]=="Programado"){
											$tabla .= "<td align='middle' width='30%' style='background: #e8384f;' class='actualizar-status-modal' id='".$filas["id_bitacora"]."'>";
												$tabla .= "<span id='".$filas["id_bitacora"]."' class='status-modal'>";
													$tabla .= $filas["status"];
												$tabla .= "</span>";
											$tabla .= "</td>";
										}else{
											$tabla .= "<td align='middle' width='30%'>";
												$tabla .= $filas["status"];
											$tabla .= "</td>";
										}
								$tabla .= "</tr>";
							$tabla .= "</tbody>";
						$tabla .= "</table>";
						$aux_rubro=$filas["rubro"];
					}else{
					$tabla .= "</tr>";
					$tabla .= "<tr>";
						$tabla .= "<td align='middle' >";
							$tabla .= $filas["rubro"];
						$tabla .= "</td>";
						$tabla .= "<td colspan='3'>";
							$tabla .= "<table class='qw table-bordered' border=1 width='100%'>";
								$tabla .= "<thead>";
								$tabla .= "</thead>";
								$tabla .= "<tbody>";
									$tabla .= "<tr>";
											$tabla .= "<td align='middle' width='30%'>";
												$tabla .= $filas["descripcion"];
											$tabla .= "</td>";
											$tabla .= "<td align='middle' width='20%'>";
												$tabla .= $filas["calificacion"];
											$tabla .= "</td>";
											if($filas["status"]=="Pendiente" || $filas["status"]=="Programado"){
												$tabla .= "<td align='middle' width='30%' style='background: #e8384f;' class='actualizar-status-modal' id='".$filas["id_bitacora"]."'>";
													$tabla .= "<span id='".$filas["id_bitacora"]."' class='status-modal'>";
														$tabla .= $filas["status"];
													$tabla .= "</span>";
												$tabla .= "</td>";
											}else{
												$tabla .= "<td align='middle' width='30%'>";
													$tabla .= $filas["status"];
												$tabla .= "</td>";
											}
									$tabla .= "</tr>";
								$tabla .= "</tbody>";
							$tabla .= "</table>";
						$aux_rubro=$filas["rubro"];
					}
				}
				$contador++;
			}
			$tabla .= "</td></tr></tbody></table>";
		}
	}
	print $tabla;
?>