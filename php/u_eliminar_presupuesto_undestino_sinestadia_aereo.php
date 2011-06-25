<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	extract($_GET);

	mysql_query("DELETE FROM presupuesto WHERE pre_id =$id");

	//echo mysql_errno();
	
	$hola='u_presupuesto_undestino_sinestadia_aereo.php?mensaje=2';
    header("Location:$hola");
	include "../db/cerrar_conexion.php";


?>