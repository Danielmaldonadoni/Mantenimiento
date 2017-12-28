<?php
	error_reporting(E_ALL ^ E_NOTICE);
$op = $_GET["op"];
switch($op)
{
	case "alta":
		$contenido = "php/alta-reporte.php";
		$titulo = "Alta de reportes";
		break;

	case "alta-rubro":
		$contenido = "alta-rubro.php";
		$titulo = "Alta de rubros";
		break;
		
	case "calificaciones":
		$contenido = "calificaciones.php";
		$titulo = "Calificaciones";
		break;
		
	case "crear-personal":
		$contenido = "crear-personal.php";
		$titulo = "Alta de personal";
		break;
		
	case "reportes-calificados":
		$contenido = "php/reportes-calificados.php";
		$titulo = "Mis reportes calificados";
		break;

	default:
		$contenido = "php/listado-reportes.php";
		$titulo = "Listado de reportes";
		break;
}
?>
<?php 
	include("../sesion.php"); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="shortcut icon" type="image/png" href="img/ig_favicon.png" />
	<script src="js/jquery.min.js"></script>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="css/normalize.css" />
	<link rel="stylesheet" href="css/bootstrap.css" />
	<title>Reporteador Mantenimiento</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">	
	<script src="js/funcion-agregar-id-reporte.js"></script>
	<link rel="stylesheet" href="css/estilos.css" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
</head>
<body>
	<header class="mi_header">
		<nav class="navbar navbar-default navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-hader">
					<a href="index.php" class="logo"><img alt="Michel Domit" src="img/ig_logo.png" class="imagen-logo" width="225px" height="71px" title="Michel Domit"></a>
					<ul class="nav navbar-nav navbar-right">
						<li>
					        <a class="dropdown-toggle" data-toggle="dropdown" href="reportes.php">Alta
					        <span class="caret"></span></a>
					        <ul class="dropdown-menu">
					         	<li><a href="?op=alta">Reporte</a></li>
					          	<li><a href="?op=alta-rubro">Rubro</a></li>
					            <li><a class="header" href="?op=crear-personal">Personal</a></li>
					        </ul>
						</li>
						<li><a class="header" href="?op=cambios">Listado de reportes</a></li>
						<li><a class="header" href="?op=calificaciones">Calificaciones</a></li>
						<li><a class="header" href="../salir.php">Salir</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<center>
			<h5><span class="glyphicon glyphicon-info-sign" style="color:#56baf7; font-size: 17px"></span>La funcionalidad completa de este sitio se obtiene usando el navegador Google Chrome.</h5>
		</center>
		<center>
			<h2>Bienvenido   <?php echo $_SESSION["nombre"];?>&nbsp;&nbsp;<?php echo $_SESSION["apellido"];?></h2>
		</center>
	</header>
	<section id="contenido">
	<?php
		require_once "php/conexion.php";
		$nombreUsuario = $_SESSION["usuario"];
		$id_usuario = $_SESSION["id_usuario"];
	?>
	<input type="hidden" id="id_usuario" value="<?php print $id_usuario; ?>" />
	<?php include_once($contenido); ?>
	</section>
	<footer>
		<div>
		<hr />
		<h5>Copyright &#169; 2017 Michel Domit - HelpDesk - All rights reserved.</h5>
		</div>
	</footer>
<!--
<script src="js/validaciones.js"></script>
-->
<script src="js/bootstrap.min.js"></script>
<script src="js/funciones-mostrar-personal.js"></script>
<script src="js/funciones-mantenimiento.js"></script>
</body>
</html>