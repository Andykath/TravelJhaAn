<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_POST);
	extract($_GET);
	
	      if($numero)
		  {
		  
		     $result1= mysql_query("SELECT * FROM telefono t WHERE t.tel_numero ='$numero'");
			
			
			
			  if (mysql_fetch_array($result1))
			  {
					$admin= new Panel("../html/usuario.html");
					//$admin->add("body",'<body onLoad = "actual(12)" >');
					$panelcuentas = new Panel("../html/u_crear_telefono.html");
					$panelcuentas->add("form",'<form name="form1" method="post" action="../php/u_crear_telefono.php?cedula='.$cedula.'">');
					$panelcuentas->add("numero",$numero);
					//$panelcuentas->add("tipo",$tipo);
					
					$panelcuentas->add("error",'Ya existe ese numero');
					$panelcuentas->add("tipo_boton",'Agregar');
					$admin->add("contenido",$panelcuentas);
					$admin->show();
					  
			  
			  }
			  else
			  {
				mysql_query("INSERT INTO `telefono` (`tel_id` ,`tel_numero` ,`tel_tipo` ,`fk_per_cedula`)VALUES (NULL ,  '$numero',  '$tipo', '$cedula')");
			    
				$hola='u_telefonos.php?cedula='.$cedula.'';
				header("Location:$hola");
			  
			  
			  }
		  
		  
		  
		  
		  
	  
		  
		  
		  }
	      else
		  {
			//echo "$cedula";
			$admin= new Panel("../html/usuario.html");
			//$admin->add("body",'<body onLoad = "actual(12)" >');
			$panelcuentas = new Panel("../html/u_crear_telefono.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/u_crear_telefono.php?cedula='.$cedula.'">');
			$panelcuentas->add("tipo_boton",'Agregar');
			//$panelcuentas->add("error",'Ya existe un estadio '.$cue_numero.' andre '.$row["ban_nombre"]);
	        $admin->add("contenido",$panelcuentas);
	        $admin->show();
			
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>