<?php
//include ("php/conexion.php");
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<form class="form-inline" method="POST" action="rcrear-personal.php">
			  <div class="form-group">
			    <label for="Nombre">Nombre:</label>
			    <input type="text" class="form-control" name="nombre" placeholder="Nombre" required />
			  </div>
			  <div class="form-group">
			    <label for="apellidos">Apellido(s):</label>
			    <input type="text" class="form-control" name="apellido" placeholder="Apellido(s)" required />
			  </div>
			  <button type="submit" class="btn btn-success" name="lala">Dar de alta</button>
			</form>
		</div>		
	</div>
	<br />
	<div class="row">
		<div class="col-md-12">
			<?php
			$querysele= "SELECT * from personal";
			$resultados = $conexion->query($querysele);
			if ($resultados->num_rows > 0)
			{
			echo "<table border=1 class='table table-hover'><thead class='cabecera'><tr><th>ID</th><th>Nombre</th><th>Apellido</th><th></th><td></td></tr></thead><tbody>";
			while ($filas = $resultados->fetch_assoc())
			{
				echo "<form method='POST' action='rcrear-personal.php'><tr>
							<td>".$filas['id_personal']."
								<input type='text' value='$filas[id_personal]' name='el_id' hidden=''>
							</td>
							<td><input type='text' class='form-control' value= '$filas[nombre]' name='nombre' </td>
							<td><input type='text' class='form-control' value='$filas[apellidos]' name='apellido'> </td>
							<td>					
								<input type='submit' class='btn btn-danger' value='Eliminar' name='reg'>
							</td>
							<td>
							<input type='submit' class='btn btn-info' value='Modificar' name='act'>
							</td>
						</tr>
						</form>";
			}
			echo "</tbody></table>";
			}
			?>
		</div>
	</div>
</div>