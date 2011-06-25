<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin = new Panel("../html/admin.html");

	
	$admin->add("body",'<body onLoad = "actual(13)" >');
	$pantallaprincipal = new Panel("../html/a_principal.html");
	

	
$nombre=$_SESSION['nombre'];
$apellido=$_SESSION['apellido'];
	
	
	
	
	
	
	$pantallaprincipal->add("nombre",$nombre);
	$pantallaprincipal->add("apellido",$apellido);
	//$pantallaprincipal->add("numero",$row['total']);
	$admin->add("contenido",$pantallaprincipal);
				
	$admin->show();
    include "../db/cerrar_conexion.php";
?>
	