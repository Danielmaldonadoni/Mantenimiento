<?php
$id_reporte = $_REQUEST["id_reporte"];
//print $idrubros
$tabla = "";
$cont = 0;
$tabla .= "<table class='table table-hover table-responsive table-bordered' id='tabla-rubros' style='width:100%'>";
	$tabla .= "<thead class='cabecera'>";
		$tabla .= "<td width='20%'>";
			$tabla .= "Rubro";
		$tabla .= "</td>";
		$tabla .= "<td width='30%'>";
			$tabla .= "Descripción";
		$tabla .= "</td>";
		$tabla .= "<td width='20%'>";
			$tabla .= "Calificación";
		$tabla .= "</td>";
		$tabla .= "<td width='20%'>";
			$tabla .= "Status";
		$tabla .= "</td>";
		$tabla .= "<td width='10%'>";
			$tabla .= "Acciones";
		$tabla .= "</td>";
	$tabla .= "</thead>";
	$tabla .= "<tbody>";


include("conexion.php");
function mostrarTablaDatosRubros($id_reporte, $id_rubro, $conexion){
	$tabla = "";
	$tabla .= "<table class='table-bordered qw' width='100%' style='text-align:center;table-layout: fixed;' border=1>";
	$tabla .= "<thead>";
	$tabla .= "</thead>";
	$tabla .= "<tbody>";
	$cont = 0;
	$option = "<select class='form-control' id='status-".$id_reporte."-".$id_rubro."' >";
		$option .= "<option style='color:#F1F1F1;'>Status</option>";
           	$option .= "<option>Pendiente</option>";
           	$option .= "<option>Programado</option>";
           	$option .= "<option>Realizado</option>";
	$option .= "</select>";
	//print "Este es el id recibido: ".$id_rubro;
	$consulta = "SELECT * FROM temporal where id_rubro = $id_rubro AND id_reporte = $id_reporte";
	$ejecutar_consulta=$conexion->query($consulta);
	if($ejecutar_consulta){
		$numero_filas = $ejecutar_consulta->num_rows;
		if($numero_filas==0){
			$tabla .= '<tr>';
				$tabla .= '<td width="30%" data-label="Descripci&oacute;n" id="descripcion-'.$id_reporte.'-'.$id_rubro.'" contenteditable>';
				$tabla .= '</td>';    
	        	$tabla .= '<td width="20%" data-label="Calificaci&oacute;n" id="calificacion-'.$id_reporte.'-'.$id_rubro.'">';
	        	$tabla .= '</td>';  
	        	$tabla .= '<td width="20%" data-id="Status" data-label="status">';
	        		$tabla .= $option;
	        	$tabla .= '</td>';
	       		$tabla .= '<td width="10%">';
	        		$tabla .= '<button type="button" onclick="agregarTarea('.$id_reporte.','.$id_rubro.')" class="btn btn-xs btn-success">';
	        			$tabla .= '<span class="glyphicon glyphicon-saved">';
	        			$tabla .= "</span>";
	        		$tabla .= '</button>';
	        	$tabla .= '</td>';
	        $tabla .= '</tr>';
		}else{
			while ($filas = $ejecutar_consulta->fetch_assoc()) {
		        $tabla .= '<tr>';
		        	$tabla .= '<td width="30%" data-label="Descripci&oacute;n" id="descripcion_delete1">';
		        		$tabla .= $filas["descripcion"];
		        	$tabla .= '</td>';
		        	$tabla .= '<td width="20%" data-label="calificaci&oacute;n" id="calificacion_delete1" >';
		        		$tabla .= $filas["calificacion"];
		        	$tabla .= '</td>';
		        if($filas["status"]== "Pendiente" || $filas["status"]== "Programado"){
					$tabla .= '<td width="20%" style="background: #e8384f;" class="editable" id="'.$filas["id_temporal"].'"  data-campo="status">';
						$tabla .= '<span class="status" id="'.$filas["id_temporal"].'">';
							$tabla .= $filas["status"];
						$tabla .= '</span>';
					$tabla .= '</td>';
					$tabla .= '<td  width="10%" data-label="Eliminar">';
						$tabla .= '<button type="button" name="delete_btn" id="btn_delete1" onclick="eliminarTarea('.$filas["id_temporal"].')" class="btn btn-xs btn-danger btn_delete">';
							$tabla .= '<span class="glyphicon glyphicon-remove"></span>';
						$tabla .= '</button>';
					$tabla .= '</td>';					
				}else{
					$tabla .= '<td width="20%" data-label="Status" data-id="Status" id="status_delete1" >';
						$tabla .= $filas["status"];
					$tabla .= '</td>';
					$tabla .= '<td width="10%" data-label="Eliminar">';
						$tabla .= '<button type="button" name="delete_btn" id="btn_delete1" onclick="eliminarTarea('.$filas["id_temporal"].')" class="btn btn-xs btn-danger btn_delete">';
							$tabla .= '<span class="glyphicon glyphicon-remove"></span>';
						$tabla .= '</button>';
					$tabla .= '</td>';
				}
				$cont++;
				$tabla .= "</tr>";
			}
			$tabla .= '<tr>';
				$tabla .= '<td width="30%" data-label="Descripci&oacute;n" id="descripcion-'.$id_reporte.'-'.$id_rubro.'" contenteditable>';
				$tabla .= '</td>';    
	        	$tabla .= '<td width="20%" data-label="Calificaci&oacute;n" id="calificacion-'.$id_reporte.'-'.$id_rubro.'">';
	        	$tabla .= '</td>';  
	        	$tabla .= '<td width="20%" data-id="Status" data-label="status">';
	        		$tabla .= $option;
	        	$tabla .= '</td>';
	       		$tabla .= '<td width="10%">';
	        		$tabla .= '<button type="button" onclick="agregarTarea('.$id_reporte.','.$id_rubro.')" class="btn btn-xs btn-success">';
	        			$tabla .= '<span class="glyphicon glyphicon-saved">';
	        			$tabla .= "</span>";
	        		$tabla .= '</button>';
	        	$tabla .= '</td>';
	        $tabla .= '</tr>';
		}
		$tabla .= "</tbody>";
		$tabla .= "</table>";
		return $tabla;
	}
}

	$consulta = "SELECT * FROM rubros";
	$ejecutar_consulta = $conexion->query($consulta);
	if($ejecutar_consulta){
		while ($filas = $ejecutar_consulta->fetch_assoc()) {
			$tabla .= "<tr>";
				$tabla .= "<td>";
					$tabla .= $filas["rubro"];
				$tabla .= "</td>";
			    $tabla .= "<td colspan='4'>";
					$tabla .= mostrarTablaDatosRubros($id_reporte, $filas["id_rubro"], $conexion);
				$tabla .= "</td>";
			$tabla .= "</tr>";
		}
		print $tabla;
	}
?>