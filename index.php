<?php

session_start();

//Validar si se está ingresando con sesión correctamente
if ($_SESSION){
	//print "Hola";
	$numero_registros = 0;
	if(isset($_SESSION["id_usuario"])){
		include_once "staff/php/conexion.php";
		$consulta = "SELECT * FROM usuarios WHERE id_usuario = $_SESSION[id_usuario]";
		$ejecutar_consulta = $conexion->query($consulta);
		if($ejecutar_consulta){
			$numero_registros = $ejecutar_consulta->num_rows;
			if($numero_registros>0){
				$registro = $ejecutar_consulta->fetch_assoc();
				print $registro["usuario"];
				echo '<script language = javascript>
				alert("Existe una sesión valida")
				self.location = "staff/index.php"
				</script>';
			}
		}
	}
	if(isset($_SESSION["tienda"])){
		include_once "tiendas/php/conexion.php";
		$consulta = "SELECT * FROM tiendas WHERE tienda = '$_SESSION[tienda]'";
		$ejecutar_consulta = $conexion->query($consulta);
		if($ejecutar_consulta){
			$numero_registros = $ejecutar_consulta->num_rows;
			if($numero_registros>0){
				$registro = $ejecutar_consulta->fetch_assoc();
				print $registro["usuario"];
				echo '<script language = javascript>
				alert("Existe una sesión valida")
				self.location = "tiendas/index.php"
				</script>';
			}	
		}
	}
	if(isset($_SESSION["supervisor"])){
		include_once "supervisores/php/conexion.php";
		$consulta = "SELECT * FROM supervisores WHERE nombre = '$_SESSION[supervisor]'";
		$ejecutar_consulta = $conexion->query($consulta);
		if($ejecutar_consulta){
			$numero_registros = $ejecutar_consulta->num_rows;
			if($numero_registros>0){
				$registro = $ejecutar_consulta->fetch_assoc();
				print $registro["usuario"];
				echo '<script language = javascript>
				alert("Existe una sesión valida")
				self.location = "supervisores/index.php"
				</script>';
			}	
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width, initial-scale-1, maximum-scale-1">
    <title>Michel Domit</title>
    <link rel="shortcut icon" type="image/png" href="staff/img/ig_favicon.png" />
    <link rel="stylesheet" href="staff/css/bootstrap.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/estilo.css">
    <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
	
	<script>
	//espacios en la contraseña
	function CheckUserName(ele) {
    if (/\s/.test(ele.value)) { alert("No se permiten espacios en blanco"); }
	}
    </script>

</head>



<body>

   
        <div style="text-align:center">
          <a href="http://micheldomit.com"><img  src="css/logo.png" border="0"></a> </div>
        <br>
    
    
    <section>
        
        <div>
        <h2>Mantenimiento</h2>
        </div>

        <article>
            <form name="autenticacion_frm" action="control.php" method="post" enctype="application/x-www-form-urlencoded">
		<?php
			error_reporting(E_ALL ^ E_NOTICE);
			if($_GET["error"]=="si"){
				echo "<span>Verifica tus datos</span>";
			}else{
				echo "Introduce tus datos";
			}
		?>
		<br /><br />
		<div>Usuario:</div> <input type="text" name="usuario_txt"><br /><br />
		<div>Password:</div> <input type="password" name="password_txt" /><br /><br />
		<input type="submit" name="entrar_btn" class="btn btn-primary btn-sm" value="entrar" />
	</form>
			<br>
			
                                    
            
        
      			
      </article>
        <footer><div>Siguenos:<a href='http://www.twitter.com/Michel_Domit' class='icon_tweet' title='Twitter' target='_blank'></a> <a href='http://www.facebook.com/pages/Michel-Domit-Oficial/265983106771451?fref=ts' class='icon_facebook' title='Facebook' target='_blank'></a></div></footer>      
        

    </section>

</body>
</html>