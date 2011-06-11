<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_POST);
	
	      if($banco)
		  {
		  
		    
			
			//echo("entra");
			//echo($hola);
		
			//echo($banco);
			
			  
				mysql_query("INSERT INTO `hot_pas` (`hot_id` ,`fk_hot_id` ,`fk_pas_id`)VALUES (NULL ,'$hola','$banco')");
			    
				$hola='a_hoteles.php?mensaje=1';
				header("Location:$hola");
			  
			  
			  
		  
		  
		  
		  
		  
	  
		  
		  
		  }
	      else
		  {
			
			$admin= new Panel("../html/admin.html");
			$admin->add("body",'<body onLoad = "actual(5)" >');
			$panelcuentas = new Panel("../html/a_crear_paseo_hotel.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/a_crear_paseo_hotel.php?hola='.$hot_id.'">');
	
	        $select='';
	        $result= mysql_query("SELECT * FROM  paseo p");
        	while($row = mysql_fetch_array($result))
        	{
			$select_actual='<option value="'.$row["pas_id"].'">'.$row["pas_nombre"].'</option>'; 		
			$select=$select.$select_actual;
			}
			$panelcuentas->add("bancos",$select);
			$panelcuentas->add("tipo_boton",'Agregar');
			//$panelcuentas->add("error",'Ya existe un estadio '.$cue_numero.' andre '.$row["ban_nombre"]);
	        $admin->add("contenido",$panelcuentas);
	        $admin->show();
			
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>