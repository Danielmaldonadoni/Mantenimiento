<?php
	require_once "conexion.php";//Incluimos la conexion
	$conexion2=conectarse();
	$id_reporte = $_REQUEST["id_reporte"];//Obtenemos el id del reporte desde la petición de ajax
	//$idUsuario = $_REQUEST["id_usuario"];
	//Realizamos la consulta con los datos de la tabla reportes con el id seleccionado
	$consulta_reporte ="SELECT * FROM reportes WHERE id_reporte='$id_reporte'";
	$ejecutar_consulta_reporte = $conexion2->query($consulta_reporte);
	$registro_reporte = $ejecutar_consulta_reporte->fetch_assoc();
?>
<!--  Header de la ventana -->
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<?php 	
		echo "<div align=center><h2><strong>Tienda:".$registro_reporte["tienda"].",      reporte: $id_reporte</strong><h2></div><input type='hidden' id='id_reporte' name='id_reporte' value='".$id_reporte."' />";
	?>
</div>
<!--  Contenido de la ventana -->
<div class="modal-body">
	<section id="contenido-reporte">
		<div>
			<table class="table table-hover table-bordered table-condensed">
				<thead>
					<tr class="cabecera">
						<td align="middle">Descripci&oacute;n</td>
						<td align="middle">Tienda</td>
						<td align="middle">Personal</td>
						<td align="middle">Periodo</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td align="middle"><?php echo utf8_encode($registro_reporte["descripcion"]); ?>
							<input type="hidden" name="descripcion_txt" value="<?php echo $registro_reporte["descripcion"]; ?>" />
						</td>
						<td align="middle">
						<?php echo $registro_reporte["tienda"]; ?>
							<input type="hidden"  name="tienda_txt" value="<?php echo $registro_reporte["tienda"]; ?>" />
						</td>
						<td align="middle"><?php echo $registro_reporte["personal"]; ?>
							<input type="hidden"  name="personal_txt" value="<?php echo $registro_reporte["personal"]; ?>" />
						</td>
						<td align="middle" text-align="left">
							<?php 
								$fecha_inicio_partir = explode("-", $registro_reporte["fechaInicio"]);
								print $fecha_inicio_partir[2]."-".$fecha_inicio_partir[1]."-".$fecha_inicio_partir[0];
							?>
							<label> - </label>
							<?php 
								$fecha_termino_partir = explode("-", $registro_reporte["fechaTermino"]);
								print $fecha_termino_partir[2]."-".$fecha_termino_partir[1]."-".$fecha_termino_partir[0]; 
							?>
						</td>
					</tr>
				</tbody>
			</table>								
		</div>
		<!-- <hr /> -->
		<div style="width:90%; margin-left:5%;" align="center" class="mensaje"></div>
		<div>
			<div id="tabla-actualizar-bitacora">
				<?php
					include_once("tabla-reporte-ventana-emergente.php");	
				?>
			</div>
			<br />
			<div width="100%" align="center" >
				<label>Porcentaje del estado de la tienda con los trabajos realizados</label>
				<input type="text" style="border-radius:4px" name="porcentaje_txt" readonly id="porcentaje_total_txt" title="porcentaje" placeholder="%"  />
				<!--<input name="enviar_btn" type="submit" class="btn btn-primary" value="Actualizar" />-->
			</div>
		</div>
		<div id="encuesta-calificacion-satisfaccion"></div>
	</section>
</div>
	<!--  Footer de la ventana   -->
<div class="modal-footer">
	<button type="button" class="btn" data-dismiss="modal">Cerrar</button>
</div>