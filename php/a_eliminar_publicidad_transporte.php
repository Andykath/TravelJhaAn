<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	extract($_GET);

	mysql_query("DELETE FROM publicidad WHERE pub_id ='$cue_id'") or die (mysql_error());

	
	$hola='a_publicidad_transporte.php?mensaje=2';
    header("Location:$hola");
	include "../db/cerrar_conexion.php";


?>