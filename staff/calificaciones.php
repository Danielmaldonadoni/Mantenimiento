<?php 
//include("php/conexion.php");
$tabla = "";
$tabla .= "<div class='container'>";
$control = 0;
$consulta = "SELECT
    R.id_reporte,
    R.titulo,
    R.descripcion,
    R.tienda,
    R.personal,
    R.fechaInicio,
    R.fechaTermino,
    CAL.servicio,
    CAL.calidad,
    CAL.velocidad,
    CAL.promedio
    FROM reportes AS R
    LEFT JOIN  encuesta_calificacion_servicio as CAL
	on CAL.id_reporte=R.id_reporte";
	$ejecutar_consulta = $conexion->query($consulta);
	if($ejecutar_consulta){
		$tabla .= "<table class='table table-condensed table-striped table-bordered' style='text-align:center;'>";
			$tabla .= "<caption>Calificaciones obtenidas de la encuesta de satisfacción.</caption>";
			$tabla .= "<thead>";
				$tabla .= "<tr class='cabecera'>";
					$tabla .= "<td>";
						$tabla .= "No&nbsp;reporte";
					$tabla .= "</td>";
					$tabla .= "<td>";
						$tabla .= "Descripción";
					$tabla .= "</td>";
					$tabla .= "<td>";
						$tabla .= "Tienda&nbsp;encuestada";
					$tabla .= "</td>";
					$tabla .= "<td>";
						$tabla .= "Personal&nbsp;responsable";
					$tabla .= "</td>";
					$tabla .= "<td>";
					    $tabla .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
						$tabla .= "&nbsp;Periodo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					$tabla .= "</td>";
					$tabla .= "<td>";
						$tabla .= "Servicio";
					$tabla .= "</td>";
					$tabla .= "<td>";
						$tabla .= "Calidad";
					$tabla .= "</td>";
					$tabla .= "<td>";
						$tabla .= "Velocidad";
					$tabla .= "</td>";
					$tabla .= "<td>";
						$tabla .= "Promedio";
					$tabla .= "</td>";
				$tabla .= "</tr>";
			$tabla .= "</thead>";
			$tabla .= "<tbody>";
		while($filas = $ejecutar_consulta->fetch_assoc()){
			$tabla .= "<tr>";
				$tabla .= "<td>";
					$tabla .= $filas["id_reporte"];
				$tabla .= "</td>";
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
					/////Obtener fecha y partirla en un vector///////////
					//$tabla .= $filas["fechaInicio"];
					$fecha_inicio = explode("-", $filas["fechaInicio"]);
					$tabla .= $fecha_inicio[2]."-".$fecha_inicio[1]."-".$fecha_inicio[0];
					$fecha_termino = explode('-', $filas["fechaTermino"]);
					$tabla .= "&nbsp;-&nbsp;";
					$tabla .= $fecha_termino[2]."-".$fecha_termino[1]."-".$fecha_termino[0];
					//$tabla .= $filas["fechaTermino"];
				$tabla .= "</td>";
				if($filas["servicio"]=='' && $filas["calidad"]=='' && $filas["velocidad"]==''){
					$tabla .= "<td style='text-align:center;' colspan='4'>";
						$tabla .= "Sin contestar";
					$tabla .= "</td>";
				}else{
					$tabla .= "<td> <span data-toggle='popover' data-trigger='hover' data-placement='left' data-content='El servicio prestado es' title='Pregunta 1'>";
						$tabla .= $filas["servicio"];
					$tabla .= "</span></td>";
					$tabla .= "<td> <span data-toggle='popover' data-trigger='hover' data-placement='left' data-content='La calidad de los trabajos es' title='Pregunta 2'>";
						$tabla .= $filas["calidad"];
					$tabla .= "</span></td>";
					$tabla .= "<td> <span data-toggle='popover' data-trigger='hover' data-placement='left' data-content='La velocidad de respuesta es' title='Pregunta 3'>";
						$tabla .= $filas["velocidad"];
					$tabla .= "</span></td>";		
					$tabla .= "<td>";
						$tabla .= round($filas["promedio"], 2);
					$tabla .= "</td>";		
				}
			$tabla .= "</tr>";
		}
		$tabla .= "</tbody>";
	$tabla .= "</table>";
	$tabla .= "</div>";
	}else{
		$control = 1;
	}


	if($control==0){
		$tabla .= "<div class='container'><form method='post' action='excel/exportar.php'><input type='submit'value='Exportar tabla' class='btn btn-success btn-block'></form></div><br />";
		print $tabla;
	}else{
		print "Ocurrio un error";
	}
?>
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
</script>