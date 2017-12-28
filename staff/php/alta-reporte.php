<section>
	<span style="text-align:center;" id="mostrar-id-reporte"></span>
	<div class="container">
		<form name="myForm" action="php/inserta.php" method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-12 col-xs-12">
				  <div class="input-group">
				    <span class="input-group-addon" id="sizing-addon2">T&iacute;tulo del reporte</span>
					<textarea  class="form-control" rows="1" cols="55" name="titulo_txt" data-toggle="tooltip" title="T&iacute;tulo del reporte" placeholder="T&iacute;tulo del reporte"  aria-describedby="sizing-addon2" required></textarea>
				  </div>
				</div>
			</div>
			<div id="lugar-reporte"></div>
			<br />
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<table class="table table-bordered table-condensed" border=1>
						<thead>
							<tr class="cabecera" style="text-align: center;">
								<td>Descripci&oacute;n</td>
								<td>Tienda</td>
								<td>Personal</td>
								<td colspan="2">Fecha</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<!-- Con style="borderstyle: none;" quizamos el borde de la caja -->
									<textarea  rows="3" cols="25" name="descripcion_txt" class="form-control" title="Descripci&oacute;n" placeholder="Breve Descripci&oacute;n" required ></textarea>
								</td>
								<td>
									<select id="tienda_slc" title="Tiendas" name="tienda_slc" class="form-control" required >
										<option value="" style="color:#F1F1F1">seleccione la tienda</option>
											<?php include_once("php/select-tienda.php"); ?>
									</select>
								</td>
								<td>
									<select id="personal_slc" class="cambio form-control" title="Personal" onchange="insertaPersonal(this)" name="personal_slc" >
										<option value="" style="color:#F1F1F1">seleccione personal</option>
											<?php include_once("php/select-personal.php"); ?>
									</select>	
									<hr />										
									<div id="inserta-personal"></div>
								</td>
								<td style="text-align: left;">
									<font size=3><strong>Fecha de inicio</strong></font>
									<input type="text" class="cursor form-control" name="fecha_inicio_txt"  id="fecha_inicio" placeholder="a&ntilde;o/mes/d&iacute;a" title="Fecha de inicio" required />	
								</td>
								<td>
									<font size=3><strong>Fecha de t&eacute;rmino</strong></font>
									<input type="text" class="cursor form-control" name="fecha_termino_txt"  id="fecha_termino" placeholder="a&ntilde;o/mes/d&iacute;a" title="Fecha de tremino" required />
								</td>
							</tr>
						</tbody>
					</table>
					<h2 align="center">Trabajos ejecutados derivados del reporte y la revisi&oacute;n</h2>
					<div id="rubros"></div>
					<br />
					<div width="100%" align="center" >
						<input width="80%" name="enviar_btn" type="submit" class="btn btn-primary btn-inline alta" onclick="iniciar()" value="Enviar" />
					</div>			
				</div>
			</div>
		</form>
	</div>
</section>