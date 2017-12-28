<div class="container">
	<div class="row">
		<div class="col-md-11">
			<div id="mensaje" class="mensaje">
				<div id="mensaje_texto">
				</div>	
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div id="alta-rubro" style="padding: inherit;border: 2px solid #337ab7;border-radius: 12px;">
				<h3>Alta de rubro</h3>
				<hr />
				<div class="form-horizontal" >
				  <div class="input-group">
				  	<span for="inputNombreRubro" class="input-group-addon" id="sizing-addon2">Nombre:</span>
				    <input type="text" class="form-control" id="nombre_rubro" placeholder="Rubro" aria-describedby="sizing-addon2" />
				  </div>
				  <div style="margin: 5px;">
				  <center>
				    <button class="btn btn-info agregar-rubro">Agregar</button>
				  </center>
				  </div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered table-hover" style="text-align: center;width: 100%;">
				<caption>
					Tabla de rubros para los trabajos de mantenimiento.
				</caption>
				<thead>
					<tr class="cabecera">
						<td>No rubro</td>
						<td>Rubro</td>
						<td>Acciones</td>
					</tr>
				</thead>
				<tbody>
					<?php 
						//include("php/conexion.php");
						$consulta = "SELECT * FROM rubros";
						$ejecutar_consulta = $conexion->query($consulta);
						if($ejecutar_consulta){
							$num_rows = $ejecutar_consulta->num_rows;
							if($num_rows>0){
								while ($registro = $ejecutar_consulta->fetch_assoc()) {
									$tabla .= "<tr>";
									$tabla .= "<td width='30%'>";
										$tabla .= $registro["id_rubro"];
									$tabla .= "</td>";
									$tabla .= "<td width='30%' id='rubro".$registro["id_rubro"]."' contenteditable>";
										$tabla .= $registro["rubro"];
									$tabla .= "</td>";
									$tabla .= "<td width='40%'>";
										$tabla .= '<button id="'.$registro["id_rubro"].'" class="btn btn-primary actualizar" data-toggle="tooltip" title="Actualizar">';
											$tabla .= '<span class="glyphicon glyphicon-refresh">';
											$tabla .= '</span>';
										$tabla .= '</button>';
										$tabla .= '&nbsp;&nbsp;';
										$tabla .= '<button id="'.$registro["id_rubro"].'" class="btn btn-danger eliminar" data-toggle="tooltip" title="Eliminar">';
											$tabla .= '<span class="glyphicon glyphicon-remove">';
											$tabla .= '</span>';
										$tabla .= '</button>';
									$tabla .= "</td>";
									$tabla .= "</tr>";
								}
								print $tabla;
							}else{
								Print "No";
							}
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){


		$(document).on("click",".actualizar",function(){
			var id = $(this).attr("id");
			//alert("Hola"+id);
			var rubro = document.getElementById("rubro"+id);
			var lugar_mensaje = document.getElementById("mensaje_texto");
			var xhttp;
			xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function(){
				if(this.readyState == 4 && this.status== 200){
					//alert(this.responseText+"     "+rubro.textContent);
					lugar_mensaje.innerHTML = this.responseText;
					//$(".mensaje").html("<img src='loading.gif'>");
					//$(id).addClass("ok");
					$("#mensaje").fadeIn(3000);
					$("#mensaje").fadeOut(3000);
					window.location="?op=alta-rubro";
				}
			};
			xhttp.open("POST", "php/actualizar-rubro.php?id_rubro="+id+"&rubro="+rubro.textContent, true);
			xhttp.send();
		});
		$(document).on("click",".eliminar",function(){
			var rubro = document.getElementById("rubro"+id);
			var id = $(this).attr("id");
			var rubro = document.getElementById("rubro"+id);
			var lugar_mensaje = document.getElementById("mensaje_texto");
			var xhttp;
			xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function(){
				if(this.readyState == 4 && this.status == 200){
					alert(this.responseText);
					window.location="?op=alta-rubro";
				}
			}
			xhttp.open("POST", "php/eliminar-rubro.php?id_rubro="+id, true);
			xhttp.send();
		});


		$(document).on("click", ".agregar-rubro", function(){
			var rubro = document.getElementById("nombre_rubro");
			var lugar_mensaje = document.getElementById("mensaje_texto");
			//alert(rubro.value);
			var xhttp;
			xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function(){
				if(this.readyState == 4 && this.status == 200){
					lugar_mensaje.innerHTML = this.responseText;
					//$(".mensaje").html("<img src='loading.gif'>");
					//$(id).addClass("ok");
					$("#mensaje").fadeIn(3000);
					$("#mensaje").fadeOut(3000);
					window.location="?op=alta-rubro";
				}
			};
			xhttp.open("POST","php/agregar-rubro.php?rubro="+rubro.value, true);
			xhttp.send();
		});
	});
</script>