<?php
include ("php/conexion.php");
?>
<div align="center">
<form method="POST" action="rcrear-personal.php">

<input type="text"  name="nombre" placeholder="Nombre" required />
<input type="text" required name="apellido" placeholder="Apellido(s)">
	<input type="submit" class="btn btn-success" name="lala" value="Dar de alta">

</form>
<br />
<br />
<?php
$querysele= "SELECT * from personal";
$resultados = $conexion->query($querysele);
if ($resultados->num_rows > 0)
{
echo "<table border=1 class='tabla'><thead><tr><th bgcolor='#AADAD8'>ID</th><th bgcolor='#AADAD8'>Nombre</th><th bgcolor='#AADAD8'>Apellido</th><th bgcolor='#AADAD8'></th><td bgcolor='#AADAD8'></td bgcolor='#AADAD8'></tr></thead><tbody>";
while ($filas = $resultados->fetch_assoc())
{
	echo "<form method='POST' action='rcrear-personal.php'><tr>
				<td>".$filas['id_personal']."
					<input type='text' value='$filas[id_personal]' name='el_id' hidden=''>
				</td>
				<td><input type='text' value= '$filas[nombre]' name='nombre' </td>
				<td><input type='text' value='$filas[apellidos]' name='apellido'> </td>
				<td>					
					<input type='submit' class='btn btn-danger' value='Eliminar' name='reg'>
				</td>
				<td>
				<input type='submit' class='btn btn-info' value='Modificar' name='act'>
				</td>
			</tr>
			</form>";
}
echo "</tbody></table></div>";

}
?>