<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	extract($_GET);

	mysql_query("DELETE FROM telefono WHERE tel_id =$id");

	//echo mysql_errno();
	
	$hola='u_telefonos.php?cedula='.$cedula.'';
    header("Location:$hola");
	include "../db/cerrar_conexion.php";


?>