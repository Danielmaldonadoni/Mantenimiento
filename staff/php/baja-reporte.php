<form id="baja-contacto" name="baja_frm" action="php/eliminar-reporte.php" method="post" enctype="application/x-www-form-urlencoded">
	<fieldset>
		<legend>Baja de Reportes</legend>
		<div>
			<label for="reporte">Reeportes: </label>
			<select id="reporte" class="cambio" name="reporte_slc" required>
				<option value="">- - -</option>
				<?php include("select-reporte.php"); ?>
			</select>
		</div>
		<div>
			<input type="submit" id="enviar-baja" class="cambio" name="enviar_btn" value="eliminar" />
		</div>
		<?php //include("php/mensajes.php"); ?>
	</fieldset>
</form>