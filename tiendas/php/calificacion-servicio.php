	<hr />
	<div class="panel" style="background: #afaaaa;">
		<div class="panel-heading">
			<center><h4>Encuesta de satisfacci&oacute;n</h4></center>
		</div>
		<div class="panel body">
			<form onsubmit="return noHacerNada()">
				<!-- <h2 align="center" >CALIFICACI&Oacute;N DEL SERVICIO</h2> -->
				<table width='90%' style="margin: 10px auto; text-align: center;">
					<caption><h4>Por favor sirvace a llenar la siguiente encuesta.</h4></caption>
					<thead class="cabecera">
						<tr>
							<th></th>
							<th>Excelente</th>
							<th>Bueno</th>
							<th>Regular</th>
							<th>Malo</th>
							<th>Muy malo</th>	
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><label>El servicio prestado</label></td>
							<td DATA-LABEL="EXCELENTE"><input type="radio" name="servicio_rdo<?php print $id_reporte; ?>"  class="servicio_rdo<?php print $id_reporte; ?>" value="10" title="selecciona Excelente" required=""  /></td>
							<td DATA-LABEL="BUENO"><input type="radio" name="servicio_rdo<?php print $id_reporte; ?>"  class="servicio_rdo<?php print $id_reporte; ?>" value="8" title="selecciona Bueno"  /></td>
							<td DATA-LABEL="REGULAR"><input type="radio" name="servicio_rdo<?php print $id_reporte; ?>"  class="servicio_rdo<?php print $id_reporte; ?>" value="6" title="selecciona Regular" /></td>
							<td DATA-LABEL="MALO"><input type="radio" name="servicio_rdo<?php print $id_reporte; ?>"  class="servicio_rdo<?php print $id_reporte; ?>" value="4" title="selecciona Malo" /></td>
							<td DATA-LABEL="MUY MALO"><input type="radio" name="servicio_rdo<?php print $id_reporte; ?>"  class="servicio_rdo<?php print $id_reporte; ?>" value="2" title="selecciona No aplica" /></td>
						</tr>
						<tr>
							<td><label>La calidad de los trabajos</label></td>
							<td DATA-LABEL="EXCELENTE"><input type="radio" name="calidad_rdo<?php print $id_reporte; ?>" class="calidad_rdo<?php print $id_reporte; ?>" value="10" title="selecciona Excelente" required="" /></td>
							<td DATA-LABEL="BUENO"><input type="radio" name="calidad_rdo<?php print $id_reporte; ?>" class="calidad_rdo<?php print $id_reporte; ?>" value="8" title="selecciona Bueno" /></td>
							<td DATA-LABEL="REGULAR"><input type="radio" name="calidad_rdo<?php print $id_reporte; ?>" class="calidad_rdo<?php print $id_reporte; ?>" value="6" title="selecciona Regular" /></td>
							<td DATA-LABEL="MALO"><input type="radio" name="calidad_rdo<?php print $id_reporte; ?>" class="calidad_rdo<?php print $id_reporte; ?>" value="4" title="selecciona Malo" /></td>
							<td DATA-LABEL="MUY MALO"><input type="radio" name="calidad_rdo<?php print $id_reporte; ?>" class="calidad_rdo<?php print $id_reporte; ?>" value="2" title="selecciona No aplica" /></td>	
						</tr>
						<tr>
							<td><label>La velocidad de respuesta</label></td>
							<td DATA-LABEL="EXCELENTE"><input type="radio" name="velocidad_rdo<?php print $id_reporte; ?>" class="velocidad_rdo<?php print $id_reporte; ?>" value="10" title="selecciona Excelente" required="" /></td>
							<td DATA-LABEL="BUENO"><input type="radio" name="velocidad_rdo<?php print $id_reporte; ?>" class="velocidad_rdo<?php print $id_reporte; ?>" value="8" title="selecciona Bueno" /></td>
							<td DATA-LABEL="REGULAR"><input type="radio" name="velocidad_rdo<?php print $id_reporte; ?>" class="velocidad_rdo<?php print $id_reporte; ?>" value="6" title="selecciona Regular" /></td>
							<td DATA-LABEL="MALO"><input type="radio" name="velocidad_rdo<?php print $id_reporte; ?>" class="velocidad_rdo<?php print $id_reporte; ?>" value="4" title="selecciona Malo" /></td>
							<td DATA-LABEL="MUY MALO"><input type="radio" name="velocidad_rdo<?php print $id_reporte; ?>" class="velocidad_rdo<?php print $id_reporte; ?>" value="2" title="selecciona No aplica" /></td>                
						</tr>
					</tbody>
				</table>
				<textarea name="text_comentarios" hidden='' placeholder="Comentarios" ></textarea>
				<br>
				<center>
		        	<button class="btn btn-success insertar-calificacion-servicio" id="<?php print $id_reporte; ?>">Confirmar</button>
				</center>
		    </form>
		</div>
	</div>