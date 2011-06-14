<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_POST);
	
	      if($cliente)
		  {
		   			  
				mysql_query("INSERT INTO `milla` VALUES (NULL, '$cliente')");
			    $hola='a_milla.php?mensaje=1';
				header("Location:$hola");
			
		  }
	      else
		  {
			
			$admin= new Panel("../html/admin.html");
			$admin->add("body",'<body onLoad = "actual(10)" >');
			$panelpubhot = new Panel("../html/a_crear_milla.html");
			$panelpubhot->add("form",'<form name="form1" method="post" action="../php/a_crear_milla.php">');
			$select2='';
			$result2= mysql_query("SELECT * FROM persona");
			while($row2 = mysql_fetch_array($result2))
	
				{
					$select_actual2='<option value="'.$row2["per_cedula"].'">'.$row2["per_apellido1"].', '.$row2["per_nombre1"].'</option>'; 		
					
					$select2=$select2.$select_actual2;
					
				}
			$panelpubhot->add("clientes",$select2);
	        $panelpubhot->add("tipo_boton",'Agregar');
	        
	        $admin->add("contenido",$panelpubhot);
	        $admin->show();
			
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>