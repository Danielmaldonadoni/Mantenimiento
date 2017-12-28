<?php
include ("php/conexion.php");

if (isset($_POST['reg'])) 
{
	$queryeliminar = "DELETE from personal where id_personal = '$_POST[el_id]' ";
	$ejecutaelimina = $conexion->query($queryeliminar);
	//echo  "<meta http-equiv=\'refresh\' content=\'0;URL=crear-usuarios.php\'>";
	header("Location: index.php?op=crear-personal");
}


if (isset($_POST['lala'])) 
{
	$queryinsertar = "INSERT INTO 
						personal VALUES 
						(null,'$_POST[nombre]','$_POST[apellido]')";
	if ($conexion->query($queryinsertar)) 
	{
		//echo "Registrado con exito";
		header("Location: index.php?op=crear-personal");
		//echo  "<meta http-equiv=\'refresh\' content=\'0;URL=crear-usuarios.php\'>";
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

		header("Location: index.php?op=crear-personal");
}


?>