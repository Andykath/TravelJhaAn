<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$cedula=$_SESSION['cedula'];
	 $cant=$_SESSION['cant'];
	extract($_GET);
	extract($_POST);
	//<!--//print_r($_POST); -->
	$locura=$_POST['formapago'];
	//echo($locura);


	
	      
		  if($a)
		  {// aqui validar que los datos esten bien y hacer update

					  
				 $hola1='u_paquete_conestadia_terrestre.php?&mensaje=2';
				 header("Location:$hola1");	  
					
			 	
	
		  }
	      else
		  {//aqui pinta el editor por primera vez	
		              
					$admin= new Panel("../html/usuario.html");
					$admin->add("body",'<body onLoad = "actual(3)" >');
					$panelestadios = new Panel("../html/u_monto_error_aereo.html");
					$panelestadios->add("form",'<form name="form1" method="post" action="../php/u_monto_error_terrestre.php?a=1">');
					

					$a=1;
					
					
					//echo($tipo);
					$panelestadios->add("tipo_boton",'Aceptar');
					$admin->add("contenido",$panelestadios);
					$admin->show();
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>