<?php                
include ("conexion.php");
		if (isset($_POST['lelele'])) 
		{
			$id = $_POST['el_id'];
			//print "".$id;
			$VAR1 = $_POST['servicio_rdo'];
			$VAR2 = $_POST['calidad_rdo'];
			$VAR3 = $_POST['velocidad_rdo'];
			$PROMEDIO = (($VAR1+$VAR2+$VAR3) / 3);

			$Comentarios = $_POST['text_comentarios'];
			if ($Comentarios == '') 
			{
				$respuesta = "Sin comentarios";
			}
			else
			{
				$respuesta = $_POST['text_comentarios'];
			}

			//inserta en la tabla ccalificacion_cerrados
			$queryinsertar = "INSERT INTO calificacion_cerrados VALUES (NULL,$id,$VAR1,$VAR2,$VAR3,$PROMEDIO,'$respuesta')";
			if ($conexion->query($queryinsertar) === TRUE) 
			{
				$queryupdatereportes = "UPDATE reportes SET calificado = 1 where id_reporte = $id ";
				if ($conexion->query($queryupdatereportes) === TRUE) 
				{
					header("Location: ../index.php?op=cambios");
					//echo $queryinsertar;
				}

				
			}
			else
			{
				echo $conexion->error;
			}			
		}
		
		?>