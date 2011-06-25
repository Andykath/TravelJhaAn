<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/admin.html");
	$cedula=$_SESSION['cedula'];
	
	$admin->add("body",'<body onLoad = "actual(16)" >');
	
	$panelobjetos = new Panel("../html/a_presupuesto_undestino_conestadia.html");
	
	
	$admin->add("contenido",$panelobjetos);
				
	$admin->show();
	include "../db/cerrar_conexion.php";
?>