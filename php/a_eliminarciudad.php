<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	extract($_GET);
	
	mysql_query("DELETE FROM `destino` WHERE `destino`.`des_id` = $id");
	
	
	//echo mysql_errno();
	
	
	if (mysql_errno())
	{
	echo "<script type=\"text/javascript\">alert(\"No se pudo realizar la operacion. La ciudad esta asignada!\"); window.location='a_paises.php';</script>";
	}
	else
	{
	$hola='a_ciudades.php?mensaje=3';
    header("Location:$hola");
	}



	
	
	include "../db/cerrar_conexion.php";
?>