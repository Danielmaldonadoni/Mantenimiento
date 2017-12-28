<?php
include("php/conexion.php");
//include("header.php");
include ("../sesion.php");
?>
<html>
<head>
	<title>Gr&aacute;fica</title>
	<meta charset="UTF-8">
	<meta charset="UTF-8" />
	<link rel="shortcut icon" type="image/png" href="img/ig_favicon.png" />
	<script src="js/modernizr.js"></script>
	<link rel="stylesheet" href="css/normalize.css" />
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.css" />
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/estilos.css" />
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script type="text/javascript">
	////////////////////////////Función inicializar calendario////////////////////////////
	$.datepicker.regional['es'] = {
		closeText: 'Cerrar',
		prevText: '< Ant',
		nextText: 'Sig >',
		currentText: 'Hoy',
		monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
		dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
		dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
		weekHeader: 'Sm',
		dateFormat: 'dd/mm/yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''
	};
	$.datepicker.setDefaults($.datepicker.regional['es']);
	$(function () {
		$("#fecha_inicio").datepicker();
		$("#fecha_termino").datepicker();
	});/*
	$(document).on("keyup", "#fecha_inicio", function(){
		$("#fecha_inicio").datepicker();
	});*/
	////////////////////////////////////Termina funciones del calendario/////////////////////////////



		//Barra----------------------------------------------------------------------------------------------------------------
		
		$(function () {$('#container').highcharts({
        data: {
            table: 'datatable'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        yAxis: {
            allowDecimals: true,
            title: {
                text: '',                
            }
        },

 plotOptions: {
            series: {
                
                dataLabels: {
                    enabled: true,
                    rotation:-90,
                    y:23,
                    
                }
            }
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.point.y + ' ' + this.point.name.toLowerCase();
            }
        }
    });
});
</script>
<style>
	/*///////////////////////////////////////*/
@media screen and (max-width: 800px){
	table{
		border:0;
	}

	table tr{
		margin-bottom:10px;
		display:block;
		border-bottom:2px solid #ddd;
	}
	table td{
		display:block;
		text-align:right;
		font-size: 15px;
		border-bottom:1px dotted #ccc;
	}

	table td:last-child{
		border-bottom:0;
	}

	table td:before{
		content:attr(data-label);
		float:left;
		text-transform:uppercase;
		font-weight:600;
	}
	
	table thead{
		display:none;
	}
	.logo{
		margin: 0 33%;
	}
	.input-group-addon{
		display:block;
	}
}
@media screen and (max-width: 600px){
	table{
		border:0;
	}

	table tr{
		margin-bottom:8px;
		display:block;
		border-bottom:2px solid #ddd;
	}
	table td{
		display:block;
		text-align:right;
		font-size: 14px;
		border-bottom:1px dotted #ccc;
	}

	table td:last-child{
		border-bottom:0;
	}

	table td:before{
		content:attr(data-label);
		float:left;
		text-transform:uppercase;
		font-weight:600;
	}
	
	table thead{
		display:none;
	}
	.logo{
		margin: 0 33%;
	}
		.input-group-addon{
		display:block;
	}

}
</style>
</head>
<body>
<?php // echo $header1; ?>


<header class="mi_header">
		<nav class="navbar navbar-default navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-hader">
				<a href="index.php" class="logo"><img alt="Michel Domit" src="img/ig_logo.png" width="225px" height="71px" title="Michel Domit"></a>
					<ul class="nav navbar-nav navbar-right">
						<li><a class="header" href="?op=cambios">Gr&aacute;fica</a></li>
						<li><a class="header" href="index.php">Mis Reportes</a></li>
						
						<li><a class="header" href="../salir.php">Salir</a></li>
					</ul>
				</div>
			</div>			
		</nav>

	</header>
		<div align="center">
			<h1>Bienvenido   <?php echo $_SESSION["nombre"];?> &nbsp;&nbsp;&nbsp; <?php echo $_SESSION["tienda"];?></h1>
		</div>
	<div class="container">
		<div class="row">
			<center>
				<form class="form-inline" name="myForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<div class="form-group">
					    <div class="input-group">
						    <div class="input-group-addon">	
						    	De:
						    	<a> 
									<input type="text" name="inicial" required readonly="" id="fecha_inicio" placeholder="Fecha Inicial" title="Ingrese la fecha Inicial">
								</a>
							</div>
						    <div class="input-group-addon bajar"> 
						    	A:
						    	<a> 
									<input type="text" name="final" required readonly="" id="fecha_termino" placeholder="Fecha de Termino" title="Ingrese la fecha final">
								</a>
							</div>
					    </div>
				    </div><br>
				    <button type="submit" class="btn btn-primary" name="agrega_objetivo2" style="margin:1% auto;">Mostrar Grafica</button>
				</form>
			</center>
		</div>
	</div>
<?php	
	if (isset($_POST['agrega_objetivo2'])) 
	{
		if ($_POST['inicial'] == "" or $_POST['final'] == "" ) 
		{
			print "<div class='container'>";
				print "<div class='alert alert-danger'>";
					print "Debes ingresar primero la fecha inicial y final";
				print "</div>";
			print "</div>";
		}
		else
		{
		$VARINICIALES = $_SESSION["usuario"];
		$dividir_fecha_inicio = explode("/", $_POST['inicial']);
		$dividir_fecha_termino = explode("/", $_POST['final']);
		$VARFECHA1 = $dividir_fecha_inicio[2]."-".$dividir_fecha_inicio[1]."-".$dividir_fecha_inicio[0];
		$VARFECHA2 = $dividir_fecha_termino[2]."-".$dividir_fecha_termino[1]."-".$dividir_fecha_termino[0];
		$VARCONDICION = "";

		if ($_POST['inicial'] <> "")
		{
		$VARCONDICION = " AND R.fechaTermino BETWEEN '$VARFECHA1' and '$VARFECHA2' ";
		}
		$quer = "
		SELECT
		B.id_rubro,
		RUBRS.rubro,
		AVG(B.calificacion) as SUMA
		from bitacora as B
		left join reportes as R
		on B.id_reporte = R.id_reporte
		left join tiendas as TDAS
		on TDAS.tienda = R.tienda
		left join rubros as RUBRS
		on RUBRS.id_rubro=B.id_rubro
		WHERE TDAS.usuario = '$VARINICIALES'  $VARCONDICION
		and status ='Realizado'
		and calificacion <> 0
		GROUP by
		RUBRS.rubro,
		TDAS.iniciales
		having not SUMA=0
		";
		//print $quer;
		//---------------------------------------------------------------------------Horizontal tiendas
		$r1 = $conexion->query($quer);
		if ($r1->num_rows > 0) 
		{
		echo "<table id='datatable' border=1 hidden=''><tr><td>Tiendas</td>";
		while ($fil = $r1->fetch_assoc()) 	
		{
		echo "<td>".$fil['rubro']."</td>";
		}
		echo "</tr>";
		//------------------------------------------------------------- Horizontal promedio
		$r1 = $conexion->query($quer);
		echo "<tr><td>Promedio</td>";
		while ($fil = $r1->fetch_assoc()) 	
		{
		echo "<td>".$fil['SUMA']."</td>";
		}
		echo "</tr></table>";
		//---------------------------------------------------------------------------

		//---------------------PARA EXPORTAR EXCEL
		$quer = "
		SELECT
		B.id_reporte,
		RUBRS.rubro,
		B.calificacion,
		R.fechaTermino
		from bitacora as B
		left join reportes as R
		on B.id_reporte = R.id_reporte
		left join tiendas as TDAS
		on TDAS.tienda = R.tienda
		left join rubros as RUBRS
		on RUBRS.id_rubro = B.id_rubro
		WHERE TDAS.usuario = '$VARINICIALES'  $VARCONDICION
		and status = 'Realizado'

		GROUP by
		RUBRS.rubro,R.fechaTermino,B.calificacion
		having not B.calificacion = 0
		
		";
		$VAREXCEL="";
		$r1 = $conexion->query($quer);		
		while ($fil = $r1->fetch_assoc()) 	
		{
		$VAREXCEL .= $fil['id_reporte'].",".$fil['rubro'].",".$fil['calificacion'].",".$fil['fechaTermino']."\n";
		}		
		//----------------------------------------
		echo "		
		<div align='center'><h3>Mantenimiento realizado de $VARFECHA1 al $VARFECHA2</h3></div>
		<script src='Highcharts-4.1.5/js/modulograficas.js'></script>
		<script src='https://code.highcharts.com/modules/data.js'></script>
		<script src='https://code.highcharts.com/modules/exporting.js'></script>
		<span data-toggle='popover' title='Aviso' data-content='Para ocultar el valor de un rubro haga click sobre el nombre del rubro correspondiente'><div id='container' style='min-width: 310px; height: 350px; margin: 0 auto;'></div><span>
		<form method='POST' action='excel/exportar.php'>
			<textarea name='areatextexportar' 
			hidden=''>Mantenimiento de periodos $VARFECHA1 al $VARFECHA2"."\n\n"."Reporte,Rubro,Calificacion,Fecha \n$VAREXCEL</textarea>
			<center>
				<input type='submit' value='Exportar Excel' class ='btn btn-success btn-lg centrar'>
			</center>
		</form>

		";
		//echo $quer;
		}
		else
		{
			print "<div class='container'>";
				print "<div class='alert alert-danger'>";
					print "No se encontrar&oacute;n datos en este periodo";
				print "</div>";
			print "</div>";
		}
		}
	}
?>
	<br />
	<footer>
		<hr />
		<div style="background: #FFF;" >
		<h5>Copyright &#169; 2017 Michel Domit - HelpDesk - All rights reserved.</h5>
		</div>
	</footer>
  <script>
  	$(document).ready(function(){
  		$('[data-toggle="popover"]').popover({
  			placement:'top',
  			trigger:'hover'
  		});
  	});
  </script>
</body>
</html>