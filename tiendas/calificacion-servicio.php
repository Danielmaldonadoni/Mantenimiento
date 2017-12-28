<!DOCTYPE hgtml>
<html lang="es">
<head>
	<meta charset="UTF-8" />
	<title>CALIFICACI$Oacute;N DEL SERVICIO</title>
	<meta name="description" content="Calificaci&oacute;n del servicio" />
	<meta name="viewport" content="width=device-width, user-scalable=no", initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0 />

	<link rel="stylesheet" href="estilos.css" />

    <link rel="stylesheet" href="css/bootstrap.min.css" />  
    <script src="js/bootstrap.min.js"></script>  
    <script src="js/jquery.min.js"></script>
    <style>
table {
    border-collapse: collapse;
    width: 80%;
}

th, td {
    text-align: center;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #4CAF50;
    color: white;
}
</style>
</head>
<body>
	<header>
		<h1></h1>
	</header>
		<form name="reporteDeTrabajosejecutados" action="php/inserta.php" method="post" enctype="multipart/form-data">
		<h2 align="center" >CALIFICACI&Oacute;N DEL SERVICIO</h2>
		<table width="80%" align="center">
			<tr>
				<th bgcolor="#AADAD8"></th>
				<th bgcolor="#AADAD8">EXCELENTE</th>
				<th bgcolor="#AADAD8">BUENO</th>
				<th bgcolor="#AADAD8">REGULAR</th>
				<th bgcolor="#AADAD8">MALO</th>
				<th bgcolor="#AADAD8">NO APLICA</th>
			</tr>
			<tr>
				<td><label>EL SERVICIO PRESTADO ES</label></td>
				<td><input type="radio" name="servicio_rdo"  value="excelente" title="selecciona Excelente" /></td>
				<td><input type="radio" name="servicio_rdo"  value="bueno" title="selecciona Bueno" /></td>
				<td><input type="radio" name="servicio_rdo"  value="regular" title="selecciona Regular" /></td>
				<td><input type="radio" name="servicio_rdo"  value="malo" title="selecciona Malo" /></td>
				<td><input type="radio" name="servicio_rdo"  value="no_aplica" title="selecciona No aplica" /></td>
			</tr>
			<tr>
				<td><label>LA CALIDAD DE LOS TRABAJOS ES</label></td>
				<td><input type="radio" name="calidad_rdo" title="selecciona Excelente" /></td>
				<td><input type="radio" name="calidad_rdo" title="selecciona Bueno" /></td>
				<td><input type="radio" name="calidad_rdo" title="selecciona Regular" /></td>
				<td><input type="radio" name="calidad_rdo" title="selecciona Malo" /></td>
				<td><input type="radio" name="calidad_rdo" title="selecciona No aplica" /></td>	
			</tr>
			<tr>
				<td><label>LA VELOCIDAD DE RESPUESTA ES</label></td>
				<td><input type="radio" name="velocidad_rdo" value="excelente" title="selecciona Excelente" /></td>
				<td><input type="radio" name="velocidad_rdo" value="bueno" title="selecciona Bueno" /></td>
				<td><input type="radio" name="velocidad_rdo" value="regular" title="selecciona Regular" /></td>
				<td><input type="radio" name="velocidad_rdo" value="malo" title="selecciona Malo" /></td>
				<td><input type="radio" name="velocidad_rdo" value="no_aplica" title="selecciona No aplica" /></td>
			</tr>
		</table>
		<br />
		<hr />
		<br />
		<h3 align="center">ELABORACI&Oacute;N DE REPORTE</h3>
		<br />
		<table width="80%" align="center">
			<tr>
				<td bgcolor="#AADAD8">NOMBRE</td>
				<td >ARQ. BRUNO CASTILLO C.</td>
			</tr>
			<tr>
				<td bgcolor="#cce6ff">CARGO</td>
				<td >COORDINADOR DE MANTENIMIENTO</td>
			</tr>
			<tr>
				<td bgcolor="#AADAD8">FECHA DE ELABORACI&Oacute;N</td>
				<td ><input type="date" name="fecha_txt" placeholder="Fecha"></td>
			</tr>



			<tr>
				<td bgcolor="#cce6ff">NOMBRE</td>
				<td align="middle"><input type="text" name="nombre_recepcion_txt" placeholder="Nombre" /></td>
			</tr>
			<tr>
				<td bgcolor="#AADAD8">CARGO</td>
				<td ><input type="text" name="cargo_txt" placeholder="Cargo" title="Cargo del recepcionista"></td>
			</tr>
			<tr>
				<td bgcolor="#cce6ff">FECHA DE ELABORACI&Oacute;N</td>
				<td ><input type="date" name="fecha_recepcion_txt" placeholder="Fecha"></td>
			</tr>
		</table>
		</form>
</body>
</html>