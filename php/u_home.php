<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$user= new Panel("../html/usuario.html");	
	$user->add("body",'<body onLoad = "actual(1)" >');
	
	$nombre=$_SESSION['nombre'];
	$apellido=$_SESSION['apellido'];
	$user->add("nombre",$nombre);
	$user->add("apellido",$apellido);
	
	$panelhome = new Panel("../html/u_home.html");
	
	$usu_actual= $_SESSION['email'];

	$esadmin=$_SESSION['admin'];
	
	if ($esadmin=="Empleado") { 
	$panelhome->add("admin",'<form id="form1" name="form1" method="post" action="../php/a_principal.php">
      <label>
        <input type="submit" name="button" id="button" value="Cambiar a vista de administrador" />
        </label>
    </form>');}		
				
				
	
	$user->add("contenido",$panelhome);	
	$user->show();
	include "../db/cerrar_conexion.php";
?>
	