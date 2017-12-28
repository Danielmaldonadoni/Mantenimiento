<?php
include ("conexion.php");
?>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
</form>
<?php
$querysele= "SELECT * from personal";
$resultados = $conexion->query($querysele);
if ($resultados->num_rows > 0) 
{
echo "<table class='tabla' border=1><thead><tr class='cabecera'><th>ID</th><th>Nombre</th><th>Apellido</th><th></th></tr></thead><tbody>";
while ($filas = $resultados->fetch_assoc())
{
	echo "<form method='POST' action='$_SERVER[PHP_SELF]'><tr>
				<td>".$filas['id_personal']."
					<input type='text' value='$filas[id_personal]' name='el_id' hidden=''>
				</td>
				<td><input type='text' value= '$filas[nombre]' name='nombre' </td>
				<td><input type='text' value='$filas[apellidos]' name='apellido'> </td>
				<td>					
					<input type='submit' value='Eliminar' name='reg'>
				</td>
				<td>
				<input type='submit' value='Modificar' name='act'>
				</td>
			</tr>
			</form>";
}
echo "</tbody></table>";

if (isset($_POST['reg'])) 
{
	$queryeliminar = "DELETE from personal where id_personal = '$_POST[el_id]' ";
	$ejecutaelimina = $conexion->query($queryeliminar);
	echo  "<meta http-equiv=\'refresh\' content=\'0;URL=crear-usuarios.php\'>";

}
}
else
{
	echo "sIN RESULTADOS";
}


if (isset($_POST['lala'])) 
{
	$queryinsertar = "INSERT INTO 
						personal VALUES 
						(null,'$_POST[nombre]','$_POST[apellido]')";
	if ($conexion->query($queryinsertar)) 
	{
		//header("Location: crear-usuarios.php");
		echo  "<meta http-equiv=\'refresh\' content=\'0;URL=crear-usuarios.php\'>";
		//exit;
	}
	else
	{
		echo $conexion->error;
	}
}
if (isset($_POST['act'])) 
{
	$queryactualiza= "UPDATE personal set nombre ='$_POST[nombre]', apellidos='$_POST[apellido]' where id_personal='$_POST[el_id]' ";
	$EJECUTARACTUALIZA = $conexion->query($queryactualiza);
		echo  "<meta http-equiv=\'refresh\' content=\'0;URL=crear-usuarios.php\'>";
}
?>