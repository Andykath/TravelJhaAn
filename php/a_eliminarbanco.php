<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	extract($_GET);
	
	
	//mysql_query("delete from detalle_factura where id_fact = $id_factura");
	mysql_query("DELETE FROM banco WHERE ban_id =$ban_id");

	//echo mysql_errno();
	
	$hola='a_bancos.php?mensaje=3';
    header("Location:$hola");
	include "../db/cerrar_conexion.php";


?>