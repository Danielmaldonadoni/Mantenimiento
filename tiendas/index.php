<?php
	error_reporting(E_ALL ^ E_NOTICE);
	$op = $_GET["op"];
	switch($op)
	{
		case "listado-reportes":
			$contenido = "php/listado-reportes.php";
			$titulo = "Listado de reportes";
			break;		
		case "graficos":
			$contenido = "php/grficos.php";
			$titulo = "Graficos tiendas";
			break;
		default:
			$contenido = "php/listado-reportes.php";
			$titulo = "Listado de reportes";
			break;
	}
	include("../sesion.php"); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8" />
	<link rel="shortcut icon" type="image/png" href="img/ig_favicon.png" />
	<script src="js/modernizr.js"></script>
	<link rel="stylesheet" href="css/normalize.css" />
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.css" />
	<title>Reporteador mantenimiento</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/estilos.css" />
</head>
<body>
	<header class="mi_header">
		<nav class="navbar navbar-default navbar-inverse">
			<div class="container">	
				<div class="navbar-hader">
					<a href="index.php" class="logo"><img alt="Michel Domit" src="img/ig_logo.png" width="225px" height="71px" title="Michel Domit" class="imagen-logo"></a>
					<ul class="nav navbar-nav navbar-right">
						<li><a class="header" href="grafica.php">Gr&aacute;fica</a></li>						
						<li><a class="header" href="?op=listado-reportes">Listado de reportes</a></li>					
						<li><a class="header" href="../salir.php">Salir</a></li>
					</ul>
				</div>
			</div>			
		</nav>
		<center>
			<h5><span class="glyphicon glyphicon-info-sign" style="color:#56baf7; font-size: 17px"></span>La funcionalidad completa de este sitio se obtiene usando el navegador Google Chrome.</h5>
		</center>
		<div align="center">
			<h2>Bienvenido   <?php echo $_SESSION["nombre"];?> &nbsp;&nbsp;&nbsp; <?php echo $_SESSION["tienda"];?></h2>
		</div>
	</header>
	<section id="contenido">
		<?php
			require_once "php/conexion.php";
			$tienda = $_SESSION["tienda"];
			echo "<input type='hidden' name='tienda' id='tienda' value='$tienda' />";
			include_once($contenido); 
		?>
	</section>
	<br />
	<footer>
		<div>
		<hr />
		<h5>Copyright &#169; 2017 Michel Domit - HelpDesk - All rights reserved.</h5>
		</div>
	</footer>
	<script src="js/funciones-tiendas.js"></script>
</body>
</html>