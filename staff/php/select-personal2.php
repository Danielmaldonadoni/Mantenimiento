<?php
//include("conexion.php");

$consulta="SELECT * FROM personal ORDER BY id_personal";
$ejecutar_consulta = $connect->query($consulta);

while($registro = $ejecutar_consulta->fetch_assoc())
{
	$nombre_personal = utf8_encode($registro["nombre"]);
	echo "<option value='$nombre_personal'";
	/*if($nombre_pais==utf8_decode($registro_contacto["pais"]))
	{
		echo " selected";
	}*/
	echo ">$nombre_personal</option>";
}
?>