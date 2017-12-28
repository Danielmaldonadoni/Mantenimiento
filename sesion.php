<?php
session_start();

//Evaluo que la sesion continue verificando una de la variables creadas en control.php,
//cuando esta ya no coincida con su valor se redirije al archivo de salir
if(!$_SESSION["autentificado"]){
	header("Location: salir.php");
}

?>