<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	extract($_GET);

	mysql_query("DELETE FROM cuenta_bancaria WHERE cue_id =$cue_id");

	//echo mysql_errno();
	
	$hola='a_cuentasbancarias.php?mensaje=2';
    header("Location:$hola");
	include "../db/cerrar_conexion.php";


?>