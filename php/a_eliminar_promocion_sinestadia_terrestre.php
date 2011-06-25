<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	extract($_GET);

	mysql_query("DELETE FROM promocion WHERE pro_id =$proid");

	//echo mysql_errno();
	
	$hola='a_promociones_sinestadia_terrestre.php?mensaje=2';
    header("Location:$hola");
	include "../db/cerrar_conexion.php";


?>