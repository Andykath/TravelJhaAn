<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	extract($_POST);
	
	     if($ban_nombre)
		 {
	       
	        
			$result= mysql_query("SELECT * FROM banco WHERE ban_nombre = '$ban_nombre'");
			$row = mysql_fetch_array($result);
			
			if ($row)
			{
			
			$admin = new Panel("../html/admin.html");
	        $admin->add("body",'<body onLoad = "actual(11)">');
	        $pantallacrearbanco = new Panel("../html/a_crear_banco.html");
			$pantallacrearbanco->add("form",'<form id="form1" name="form1" method="post" action="../php/a_crearbanco.php">');
			$pantallacrearbanco->add("tipo_boton",'Agregar');
			$pantallacrearbanco->add("error",'Ya hay un banco registrado como '.$row["ban_nombre"].'!');
		    $admin->add("contenido",$pantallacrearbanco);			
	        $admin->show();

			}
			else
			{
			
			
			
			mysql_query("INSERT INTO `banco` (`ban_id` ,`ban_nombre`)VALUES (NULL ,  '$ban_nombre');");
			$hola='a_bancos.php?mensaje=1';
			header("Location:$hola");
			
			
			}
	
		}
		else
		{
		
		$admin = new Panel("../html/admin.html");
	    $admin->add("body",'<body onLoad = "actual(11)" >');
	    $pantallacrearbanco = new Panel("../html/a_crear_banco.html");
	    $pantallacrearbanco->add("form",'<form id="form1" name="form1" method="post" action="../php/a_crearbanco.php">');
     	$pantallacrearbanco->add("tipo_boton",'Agregar');
		$admin->add("contenido",$pantallacrearbanco);
	    $admin->show();
		
		}
	

			
	
    include "../db/cerrar_conexion.php";
?>