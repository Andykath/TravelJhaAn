<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/usuario.html");
	
	$admin->add("body",'<body onLoad = "actual(5)" >');
	
	$panelobjetos = new Panel("../html/u_paquetes_conestadia.html");
	
	
	$admin->add("contenido",$panelobjetos);
				
	$admin->show();
	include "../db/cerrar_conexion.php";
?>