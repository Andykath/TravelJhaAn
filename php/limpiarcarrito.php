<?php
	session_start();
	
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$usu_actual= $_SESSION['email'];
	
	
	
	
	
			
		
	
		
		header ("Location:logout.php");
	

	
	include "../db/cerrar_conexion.php";
?>
