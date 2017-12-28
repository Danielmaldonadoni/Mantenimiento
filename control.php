<?php
	$usuario = $_POST["usuario_txt"];
	$password = $_POST["password_txt"];

	include("staff/php/conexion.php");
	$consulta = "SELECT * FROM usuarios WHERE usuario='$usuario' && password='$password'";
	$ejecutar_consulta = $conexion->query($consulta);
	$num_regs_usuarios = $ejecutar_consulta->num_rows;
	//Si $num_regs es igual a 0, insertamoslos datos en la tabla, sino mandamos un mensaje que diga que el usuario existe
	if($num_regs_usuarios == 1)
	{
		$registro_usuario = $ejecutar_consulta->fetch_assoc();
			//staff la sesion
			session_start();
			
			//Declaro mis variables de sesión
			$_SESSION["autentificado"] = true;
			$_SESSION["usuario"] = $_POST["usuario_txt"];
			$_SESSION["id_usuario"] = $registro_usuario["id_usuario"];
			$_SESSION["nombre"] = $registro_usuario["nombre"];
			$_SESSION["apellido"] = $registro_usuario["apellido"];
			header("Location: staff/index.php");
	}else{
		$consulta = "SELECT * FROM tiendas WHERE usuario='$usuario' && password='$password'";
		$ejecutar_consulta = $conexion->query($consulta);
		$num_regs = $ejecutar_consulta->num_rows;
		$registro_usuario = $ejecutar_consulta->fetch_assoc();
		//Si $num_regs es igual a 0, insertamoslos datos en la tabla, sino mandamos un mensaje que diga que el usuario existe
		if($num_regs == 1)
		{
				//inicio de la sesion
				session_start();		
				//Declaro mis variables de sesión
				
				$_SESSION["autentificado"] = true;
				$_SESSION["tienda"] = $registro_usuario["tienda"];		
				$_SESSION["usuario"] = $_POST["usuario_txt"];
				$_SESSION["id_tienda"] = $registro_usuario["id_tienda"];
				$_SESSION["nombre"] = $registro_usuario["nombre"];
				header("Location: tiendas/index.php");
		}else{
				//Poner código de supervisores
			$consulta_supervisores = "SELECT * FROM supervisores WHERE usuario='$usuario' && password='$password'";
			$ejecutar_consulta_supervisores = $conexion->query($consulta_supervisores);
			$num_regs_supervisores = $ejecutar_consulta_supervisores->num_rows;
			$registro_supervisor = $ejecutar_consulta_supervisores->fetch_assoc();
			//Si $num_regs es igual a 0, insertamoslos datos en la tabla, sino mandamos un mensaje que diga que el usuario existe
			if($num_regs_supervisores == 1)
			{
					//inicio de la sesion
					session_start();		
					//Declaro mis variables de sesión
					
					$_SESSION["autentificado"] = true;		
					$_SESSION["usuario"] = $_POST["usuario_txt"];
					$_SESSION["id_supervisor"] = $registro_supervisor["id_supervisor"];
					$_SESSION["supervisor"] = $registro_supervisor["nombre"];
					header("Location: supervisores/index.php");
			}else{
				header("Location: index.php?error=si");
			}
		}
	}
?>