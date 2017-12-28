<?php  
	$fecha_inicio = array();
	$fecha_termino = array();
	if($tipo_trabajo=="" || $tipo_trabajo=="Todo"){
		$queryreporte = "SELECT * from reportes WHERE id_usuario=$id_usuario limit $limit, $num_divisiones";
		$ejecutar_consulta = $conexion->query($queryreporte);
		$num_resultados = $ejecutar_consulta->num_rows;
	}else if($tipo_trabajo=="Programados"){
		$queryreporte = "SELECT * from reportes WHERE id_usuario=$id_usuario AND estado='1' limit $limit, $num_divisiones";
		$ejecutar_consulta = $conexion->query($queryreporte);
		$num_resultados = $ejecutar_consulta->num_rows;
	}else if($tipo_trabajo=="Pendientes"){
		$queryreporte = "SELECT * from reportes WHERE id_usuario=$id_usuario AND estado='2' limit $limit, $num_divisiones";
		$ejecutar_consulta = $conexion->query($queryreporte);
		$num_resultados = $ejecutar_consulta->num_rows;
	}else if($tipo_trabajo=="Realizados"){
		$queryreporte = "SELECT * from reportes WHERE id_usuario=$id_usuario AND estado='3' limit $limit, $num_divisiones";
		$ejecutar_consulta = $conexion->query($queryreporte);
		$num_resultados = $ejecutar_consulta->num_rows;
	}
	$table = "";
	$tabla .= "<table class='table table-hover table-responsive table-bordered'>";
		$tabla .= "<caption>";
		$tabla .= "Listado de reportes";
		$tabla .= "</caption>";
		$tabla .= "<thead>";
			$tabla .= "<tr class='cabecera'>";
				$tabla .= "<td align='middle'>";
					$tabla .= "No reporte";
				$tabla .= "</td>";
				$tabla .= "<td align='middle'>";
					$tabla .= "Descripci&oacute;n";
				$tabla .= "</td>";
				$tabla .= "<td align='middle'>";
					$tabla .= "Responsables";
				$tabla .= "</td>";
				$tabla .= "<td align='middle'>";
					$tabla .= "Periodo";
				$tabla .= "</td>";
				$tabla .= "<td align='middle'>";
					$tabla .= "Tienda";
				$tabla .= "</td>";
				$tabla .= "<td align='middle'>";
					$tabla .= "Estado";
				$tabla .= "</td>";
			$tabla .= "</tr>";
		$tabla .= "</thead>";
$estado="";
	while ($filas = $ejecutar_consulta->fetch_assoc()) {
						$verificaestado = $filas['estado'];

						if ($verificaestado == 1) 
						{
							$estado = "Programado";
						}
						else if ($verificaestado == 2) 
						{
							$estado = "Pendiente";
						}
						else if ($verificaestado == 3) 
						{
							$estado = "Realizado";
						}
		$tabla .= "<tr>";
			$tabla .= "<td data-label='id reporte' id='".$filas['id_reporte']."' align='middle'>";
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
			$tabla .= "<td align='middle'>";
				///////////////////////////////////////////Aqui partiremos la fecha para ponerla de forma correcta////////
				$fecha_inicio = explode("-", $filas["fechaInicio"]);
				$fecha_termino = explode("-", $filas["fechaTermino"]);

				$tabla .= $fecha_inicio[2]."-".$fecha_inicio[1]."-".$fecha_inicio[0]."&nbsp;-&nbsp;".$fecha_termino[2]."-".$fecha_termino[1]."-".$fecha_termino[0];
			$tabla .= "</td>";
			$tabla .= "<td align='middle'>";
				$tabla .= $filas["tienda"];
			$tabla .= "</td>";
			$tabla .= "<td align='middle'>";
				$tabla .= $estado;
			$tabla .= "</td>";
		$tabla .= "</tr>";
	}
	$tabla .= "</table>";
	print $tabla; 
?>