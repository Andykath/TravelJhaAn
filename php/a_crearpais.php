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
					$panelciudades = new Panel("../html/a_crear_pais.html");
					$panelciudades->add("form",'<form name="form1" method="post" action="../php/a_crearpais.php">');
					$panelciudades->add("nombre",$nombre);			
					$select='';
					$result= mysql_query("SELECT * FROM  moneda");
				    while($row = mysql_fetch_array($result))
					{
					$select_actual='<option value="'.$row["mon_id"].'">'.$row["mon_nombre"].'</option>'; 		
					$select=$select.$select_actual;
					}
					$panelciudades->add("monedas",$select);
					$panelciudades->add("error",'Ya existe ese pais');
					$panelciudades->add("tipo_boton",'Agregar');
					$admin->add("contenido",$panelciudades);
					$admin->show();
					  
			  
			  }
			  else
			  {
				mysql_query("INSERT INTO `destino` (`des_id` ,`des_nombre` ,`des_descripcion` ,`fk_des_id` ,`fk_mon_id`)VALUES (NULL ,'$nombre',  'Pais',  NULL,  '$moneda')");
			    
				$hola='a_paises.php?mensaje=1';
				header("Location:$hola");
			  
			  
			  }
	  
		  
		  }
	      else
		  {
			
			$admin= new Panel("../html/admin.html");
			$admin->add("body",'<body onLoad = "actual(3)" >');
			$panelcuentas = new Panel("../html/a_crear_pais.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/a_crearpais.php">');
	
	        $select='';
	        $result= mysql_query("SELECT * FROM  moneda");
        	while($row = mysql_fetch_array($result))
        	{
			$select_actual='<option value="'.$row["mon_id"].'">'.$row["mon_nombre"].'</option>'; 		
			$select=$select.$select_actual;
			}
			$panelcuentas->add("monedas",$select);
			$panelcuentas->add("tipo_boton",'Agregar');
			//$panelcuentas->add("error",'Ya existe un estadio '.$cue_numero.' andre '.$row["ban_nombre"]);
	        $admin->add("contenido",$panelcuentas);
	        $admin->show();
			
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>