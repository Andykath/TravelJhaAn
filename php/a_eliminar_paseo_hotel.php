<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	extract($_GET);

	mysql_query("DELETE FROM hot_pas WHERE hot_id =$cue_id");

	//echo mysql_errno();
	
	$hola='a_hoteles.php?mensaje=2';
    header("Location:$hola");
	include "../db/cerrar_conexion.php";


?>