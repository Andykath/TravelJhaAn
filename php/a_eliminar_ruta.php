<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	extract($_GET);
	
	mysql_query("DELETE FROM ruta  WHERE fk_flo_id =$flo_id ");


	//echo mysql_errno();
	
	$hola='a_rutas.php?cru_id='.$cru_id.'';
    header("Location:$hola");
	include "../db/cerrar_conexion.php";


?>