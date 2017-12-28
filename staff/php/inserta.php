<?php
ob_start();
require_once "conexion.php";
require_once "../../sesion.php";
//Datos para actividadesRealizadas        ejemplo de la funcion eplode --> $porciones = explode(" ", $pizza);
$titulo_reporte = $_POST["titulo_txt"];
$id_usuario = $_SESSION["id_usuario"];
$descripcion = $_POST["descripcion_txt"];
$tienda = $_POST["tienda_slc"];
$personal = $_POST["personal_txt"];
$fechaInicio = explode("/", $_POST["fecha_inicio_txt"]);// posicion 0 esta el dia, posicion 1 esta el mes y posicion 2 esta el año
$fechaTermino = explode('/', $_POST["fecha_termino_txt"]);
$id_reporte = $_POST["id_reporte"];
print $id_reporte;
//print $fechaInicio[0];
//print $fechaInicio[1];
//print $fechaInicio[2];
$nueva_fecha_inicio = $fechaInicio[2]."-".$fechaInicio[1]."-".$fechaInicio[0];
$nueva_fecha_termino = $fechaTermino[2]."-".$fechaTermino[1]."-".$fechaTermino[0];
if($nueva_fecha_inicio>$nueva_fecha_termino){
	$mensaje="La fecha que ingresó no es correcta inicie de nuevo el llenado del reporte anterior";
	header("Location: ../index.php?mensaje=$mensaje");
}else{
	//echo $titulo_reporte.$id_usuario.$descripcion.$tienda.$personal.$fechaInicio.$fechaTermino;

	$consulta = "INSERT INTO reportes VALUES('','$id_usuario','$titulo_reporte','$descripcion','$tienda','$personal','$nueva_fecha_inicio','$nueva_fecha_termino','','',0)";//el cero es sin contestar
	$ejecutar_consulta = $conexion->query($consulta);
	//Obtenemos el id del reporte que se acaba de agregar en la base de datos
	//$id_reporte = $conexion->insert_id;



	$consulta = "INSERT INTO ultimas_modificaciones VALUES('','$id_reporte',CURRENT_DATE());";
	$ejecutar_consulta = $conexion->query($consulta);
	//Ahora obtenemos el id de la tabla ultimas modoficaciones para saber cual es el id que corresponde a la tabala reportes debido a que necesitamos
	// el id de reporte la tabla ultimas_modificaciones y por eso primeros insertamos el registro en reportes y luego obtenemos su id y por ultimo 
	//actualizamos la tabla reporte con el id de la ultima modificación 
	$id_ultima_modificacion = $conexion->insert_id;
	/////////////////////////////////////////////////////
	$consulta = "UPDATE reportes SET id_ultima_modificacion='$id_ultima_modificacion' WHERE id_reporte='$id_reporte'";
	$ejecutar_consulta = $conexion->query($consulta);
	if($ejecutar_consulta){
		echo "Se ejecuto consulta  de actualiazación e id ultima modificación";
	}else{
		echo "No se ejecuto consulta de actualización de ultima modificación";
	}

	 $consulta_a_temporal = "SELECT * FROM temporal WHERE id_reporte=$id_reporte AND status='REALIZADO'";
	 $ejecutar_consulta_a_temporal = $conexion->query($consulta_a_temporal);
	 $numero_registros_realizados = $ejecutar_consulta_a_temporal->num_rows;
///////////////////////////////////////////////////////////Realizamos consulta de todo y insertamos en bitacora
	 $consulta = "SELECT * FROM temporal WHERE id_reporte=$id_reporte";
	 $ejecutar_consulta = $conexion->query($consulta);
	 $num_regs = $ejecutar_consulta->num_rows;
//////////////////////Comenzamos ciclo para obtener registros/////////////////////////////////////////////////7
	 while ($registro_temporal = $ejecutar_consulta->fetch_assoc()) {
	 	$id_rubro = $registro_temporal['id_rubro'];
	 	$descripcion = $registro_temporal["descripcion"];
	 	$status = $registro_temporal["status"];
		$consulta_inserta_bitacora = "INSERT INTO bitacora VALUES(NULL, $id_usuario, $id_reporte, $id_rubro, '$descripcion', '', '$status', '', '')";
		print $consulta_inserta_bitacora;
		$ejecutar_consulta_inserta_bitacora = $conexion->query($consulta_inserta_bitacora);
		if($ejecutar_consulta_inserta_bitacora){
			print "ejecutar_consulta bitacora";
		}	
	 }












///////////////////////////Actualizamos estado del reporte///////////////////////	 
	 if($numero_registros_realizados==$num_regs){
		$consulta = "UPDATE reportes SET estado='3' WHERE id_reporte=$id_reporte";
		$ejecutar_consulta = $conexion->query($consulta);
	 }else{
			$consulta = "UPDATE reportes SET estado='1' WHERE id_reporte=$id_reporte";
		$ejecutar_consulta = $conexion->query($consulta); 
	 }

	$conexion->close();
	header("Location: ../index.php");
	ob_end_flush();
}
?>