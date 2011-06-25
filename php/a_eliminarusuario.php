<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	extract($_GET);
	
	mysql_query("DELETE FROM  `usuario` WHERE  `usuario`.`email` =$usuario");
	
	
	//echo mysql_errno();
	
	
	if (mysql_errno())
	{
	echo "<script type=\"text/javascript\">alert(\"No se pudo realizar la operacion. El usuario esta asignado!\"); window.location='a_usuarios.php';</script>";
	}
	else
	{
	$hola='a_usuarios.php?mensaje=1';
    header("Location:$hola");
	}
	
	include "../db/cerrar_conexion.php";
?>