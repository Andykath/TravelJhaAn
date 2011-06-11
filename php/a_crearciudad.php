<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_POST);
	
	      if($nombre)
		  {
		  
		     $result1= mysql_query("SELECT * FROM destino d WHERE d.des_nombre ='$nombre'");
			
			
			
			  if (mysql_fetch_array($result1))
			  {
					$admin= new Panel("../html/admin.html");
					$admin->add("body",'<body onLoad = "actual(3)" >');
					$panelciudades = new Panel("../html/a_crear_ciudad.html");
					$panelciudades->add("form",'<form name="form1" method="post" action="../php/a_crearciudad.php">');
					$panelciudades->add("nombre",$nombre);			
					$select='';
					$result= mysql_query("SELECT * FROM  destino d WHERE d.des_descripcion='Pais'");
				    while($row = mysql_fetch_array($result))
					{
					$select_actual='<option value="'.$row["des_id"].'">'.$row["des_nombre"].'</option>'; 		
					$select=$select.$select_actual;
					}
					$panelciudades->add("paises",$select);
					$panelciudades->add("error",'Ya existe esa ciudad');
					$panelciudades->add("tipo_boton",'Agregar');
					$admin->add("contenido",$panelciudades);
					$admin->show();
					  
			  
			  }
			  else
			  {
				mysql_query("INSERT INTO `destino` (`des_id` ,`des_nombre` ,`des_descripcion` ,`fk_des_id` ,`fk_mon_id`)VALUES (NULL ,'$nombre',  'Ciudad',  '$pais',  NULL)");
			    
				$hola='a_ciudades.php?mensaje=1';
				header("Location:$hola");
			  
			  
			  }
	  
		  
		  }
	      else
		  {
			
			$admin= new Panel("../html/admin.html");
			$admin->add("body",'<body onLoad = "actual(3)" >');
			$panelcuentas = new Panel("../html/a_crear_ciudad.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/a_crearciudad.php">');
	
	        $select='';
	        $result= mysql_query("SELECT * FROM  destino d WHERE d.des_descripcion='Pais'");
        	while($row = mysql_fetch_array($result))
        	{
			$select_actual='<option value="'.$row["des_id"].'">'.$row["des_nombre"].'</option>'; 		
			$select=$select.$select_actual;
			}
			$panelcuentas->add("paises",$select);
			$panelcuentas->add("tipo_boton",'Agregar');
			//$panelcuentas->add("error",'Ya existe un estadio '.$cue_numero.' andre '.$row["ban_nombre"]);
	        $admin->add("contenido",$panelcuentas);
	        $admin->show();
			
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>