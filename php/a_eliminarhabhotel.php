<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	extract($_GET);

	mysql_query("DELETE FROM habitacion WHERE hab_id =$cue_id");

	//echo mysql_errno();
	
	$hola='a_habitacioneshotel.php?cue_id='.$hot_id.'';
    header("Location:$hola");
	include "../db/cerrar_conexion.php";


?>