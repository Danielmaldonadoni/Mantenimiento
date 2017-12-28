<?php
//include("conexion.php");

$consulta="SELECT * FROM tiendas ORDER BY id_tienda";
$ejecutar_consulta = $conexion->query($consulta);

while($registro = $ejecutar_consulta->fetch_assoc())
{
	$nombre_tienda = utf8_encode($registro["tienda"]);
	echo "<option value='$nombre_tienda'";
	/*if($nombre_pais==utf8_decode($registro_contacto["pais"]))
	{
		echo " selected";
	}*/
	echo ">$nombre_tienda</option>";
}
?>