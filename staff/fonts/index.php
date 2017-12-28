<?php
error_reporting(E_ALL ^ E_NOTICE);
$op = $_GET["op"];
switch($op)
{
	case "alta":
		$contenido = "php/alta-reporte.php";
		$titulo = "Alta de reportes";
		break;

	case "baja":
		$contenido = "php/baja-reporte.php";
		$titulo = "Baja de reportes";
		break;

	case "cambios":
		$contenido = "php/cambios-reporte.php";
		$titulo = "Cambios de reportes";
		break;
	
	case "consultas":
		$contenido = "php/consultas-reporte.php";
		$titulo = "Consultas a reportes";
		break;
		
	case "actualiza-reportes":
		$contenido = "php/formulario-actualizacion.php";
		$titulo = "Actualización de Reporte";
		break;
		
	case "crear-personal":
		$contenido = "crear-personal.php";
		$titulo = "Alta De Personal";
		break;

	default:
		$contenido = "php/cambios-reporte.php";
		$titulo = "Listado De Reportes";
		break;
}
?>
<?php include("../sesion.php"); 

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8" />
	<script src="js/modernizr.custom.31855.js"></script>
	<link rel="stylesheet" href="css/normalize.css" />
	<link rel="stylesheet" href="estiloss.css" />
	<link rel="stylesheet" href="css/bootstrap.css" />
	<title>Reporte de trabajos ejecutados</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<SCRIPT SRC="calendar.js"></SCRIPT> 	
<script src="js/funcion-agregar-id-reporte.js"></script>
<script src="js/sumaCalificacion.js"></script>
<script src="js/sumaCalificacion2.js"></script>
<style>
		.editable span{display:block;}
		.editable span:hover {background:url(edit.png) 90% 80% no-repeat;cursor:pointer}
		
		td input{height:24px;width:200px;border:1px solid #ddd;padding:0 5px;margin:0;border-radius:6px;vertical-align:middle}
		a.enlace{display:inline-block;width:24px;height:24px;margin:0 0 0 5px;overflow:hidden;text-indent:-999em;vertical-align:middle}
			.guardar{background:url(save.png) 0 0 no-repeat}
			.cancelar{background:url(cancel.png) 0 0 no-repeat}
	.mensaje{display:block;text-align:center;margin:0 0 20px 0}
		.ok{display:block;padding:10px;text-align:center;background:green;color:#fff}
		.ko{display:block;padding:10px;text-align:center;background:red;color:#fff}
</style>
</head>
<body>
	<header class="mi_header">
		<nav class="navbar navbar-default navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-hader">
					<ul class="nav navbar-nav navbar-right">
						<li><a class="header" href="?op=alta">Alta de Reporte</a></li>
						<li><a class="header" href="?op=cambios">Listado De Reportes</a></li>
						<li><a class="header" href="?op=crear-personal">Alta De Personal</a></li>
						<li><a class="header" href="../salir.php">Salir</a></li>
					</ul>
				</div>
			</div>			
		</nav>
		<div align="center">
			<h1><strong>Bienvenido   <?php echo $_SESSION["usuario"];?></strong></h1>
		</div>
	</header>
	<section id="contenido">

		<?php include_once($contenido); ?>
	</section>
	<br />
	<footer>
		<div class="container">
		<div>
	</footer>
<script src="js/busca-reporte.js"></script>
<script src="js/validaciones.js"></script>
<script src="js/funciones-trabajos-pendientes.js"></script>
<script src="js/funciones-trabajos-pendientes2.js"></script>
<script src="js/funciones-trabajos-pendientes3.js"></script>
<script src="js/funciones-trabajos-pendientes4.js"></script>
<script src="js/funciones-trabajos-pendientes5.js"></script>
<script src="js/funciones-trabajos-pendientes6.js"></script>
<script src="js/funciones-trabajos-pendientes7.js"></script>
<script src="js/funciones-trabajos-pendientes8.js"></script>
<script src="js/funciones-trabajos-pendientes9.js"></script>
<script src="js/funciones-trabajos-pendientes10.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/funciones-mostrar-personal.js"></script> 
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script>
	$(document).ready(function() 
	{
		/* OBTENEMOS TABLA */

		
		var td,campo,valor,id;
		$(document).on("click","td.editable span",function(e)
		{
			e.preventDefault();
			$("td:not(.id)").removeClass("editable");
			td=$(this).closest("td");
			campo=$(this).closest("td").data("campo");
			valor=$(this).text();
			id=$(this).closest("td").data("id");
			td.text("").html("<select type='text' name='"+campo+"' value='"+valor+"'><option>PENDIENTE</option><option>PROGRAMADO</option><option>REALIZADO</option></select><a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>");
		});
		
		$(document).on("click",".cancelar",function(e)
		{
			e.preventDefault();
			td.html("<span>"+valor+"</span>");
			$("td:not(.id)").addClass("editable");
		});
		
		$(document).on("click",".guardar",function(e)
		{
			$(".mensaje").html("<img src='loading.gif'>");
			e.preventDefault();
			nuevovalor=$(this).closest("td").find("select").val();
			alert(campo+nuevovalor+id);
			if(nuevovalor.trim()!="")
			{
				$.ajax({
					type: "POST",
					url: "php/php/editing.php",
					data: { campo: campo, valor: nuevovalor, id:id }
				})
				.done(function( msg ) {
					$(".mensaje").html(msg);
					td.html("<span>"+nuevovalor+"</span>");
					$("td:not(.id)").addClass("editable");
					setTimeout(function() {$('.ok,.ko').fadeOut('fast');}, 3000);
					//Mandamos a llamar las funciones que tenemos para mostrar todas las partidas de los diferentes rubros
					mostrarTablaDeSubrubros();
				});
			}
			else $(".mensaje").html("<p class='ko'>Debes ingresar un valor</p>");
		});
	});
	
	</script>
</body>
</html>