<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	extract($_GET);
	
	mysql_query("DELETE FROM ruta WHERE fk_flo_id =$flo_id and rut_tipo='Parada' and fk_des_id=$id ");


	//echo mysql_errno();
	
	$hola='a_paradas.php?flo_id='.$flo_id.'';
    header("Location:$hola");
	include "../db/cerrar_conexion.php";


?>