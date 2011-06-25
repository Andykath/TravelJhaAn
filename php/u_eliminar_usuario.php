<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	extract($_GET);
	
	mysql_query("DELETE FROM usuario  WHERE fk_per_cedula =$cedula ");
	mysql_query("DELETE FROM telefono  WHERE fk_per_cedula =$cedula ");
	mysql_query("DELETE FROM persona  WHERE per_cedula =$cedula ");
	
    

	//echo mysql_errno();
	
	$hola='login.php';
    header("Location:$hola");
	include "../db/cerrar_conexion.php";


?>