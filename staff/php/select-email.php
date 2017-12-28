<?php
//Incluyo el archivo de la conexión a la BD
include("conexion.php");
//Constryo el query para traer los registros en el select del HTML
$consulta = "SELECT id_reporte FROM reportes ORDER BY id_reporte";
//Ejecuto el query
$ejecutar_consulta = $conexion->query($consulta);
//Con un while recorro todos los registros generados de la consulta anterior
//Construyo las opciones del select de forma dinámica con los registros de la consulta
while($registro = $ejecutar_consulta->fetch_assoc())
{
	echo "<option value='".utf8_encode($registro["id_reporte"])."'";
	if($_GET["reporte_slc"]==$registro["id_reporte"])
	{
		echo " selected";	
	}
	echo ">".utf8_encode($registro["id_reporte"])."</option>";
}
//$conexion->close();
?>