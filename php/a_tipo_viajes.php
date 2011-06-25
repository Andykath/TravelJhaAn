<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(10)" >');
	
	$panelobjetos = new Panel("../html/a_tipo_viajes.html");
	
	
	$admin->add("contenido",$panelobjetos);
				
	$admin->show();
	include "../db/cerrar_conexion.php";
?>