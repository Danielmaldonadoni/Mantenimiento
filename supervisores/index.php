<?php
	error_reporting(E_ALL ^ E_NOTICE);
	include("../sesion.php");
	$op = $_GET["op"];
	switch ($op) {
		case 'grafica-reporte':
			include("php/grafica-reporte.php");	
		break;
		
		default:
			# code...
			break;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>M&oacute;dulo de supervisores</title>
	<link rel="shortcut icon" type="image/png" href="img/ig_favicon.png">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/estilos.css" />
	<script src="js/funciones-supervisores.js"></script>
</head>
<body>
	<nav class="navbar navbar-default navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-hader">
				<a href="index.php" class="logo"><img alt="Michel Domit" src="img/ig_logo.png" class="imagen-logo" width="225px" height="71px" title="Michel Domit"></a>
				<ul class="nav navbar-nav navbar-inverse navbar-right" style="font-size: 22px;">
					<li><a class="header" href="?op=cambios">Listado de reportes</a></li>
					<li><a class="header" href="../salir.php">Salir</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<center>
		<h5><span class="glyphicon glyphicon-info-sign" style="color:#56baf7; font-size: 17px"></span>La funcionalidad completa de este sitio se obtiene usando el navegador Google Chrome.</h5>
	</center>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php
					//print $_SESSION["id_supervisor"];
					print "<input type='hidden' id='id_supervisor' value='".$_SESSION["id_supervisor"]."' />"
				?>
				<h2>Listado de reportes</h2>
				<div id="listado-reportes"></div>
			</div>
			<div class="col-md-12">
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
					<div class="modal-dialog" role="document">
						<div class="modal-content" id="contenido-ventana-emergente">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<footer>
		<hr />
		<div style="background: #FFF;" >
			<h5>Copyright &#169; 2017 Michel Domit - HelpDesk - All rights reserved.</h5>
		</div>
	</footer>
</body>
</html>