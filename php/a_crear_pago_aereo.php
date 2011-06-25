<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_POST);
	
	      if($cue_numero)
		  {
		  
		    
		
				mysql_query("INSERT INTO `pago` (`pag_id` ,`pag_monto` ,`pag_fecha` ,`fk_via_id`)VALUES (NULL ,'$cue_numero', '$fecha',  '$banco')");
			    
				$hola='a_pagos.php?mensaje=1';
				header("Location:$hola");
			  

		  
		  
		  
		  
		  
	  
		  
		  
		  }
	      else
		  {
			
			$admin= new Panel("../html/admin.html");
			$admin->add("body",'<body onLoad = "actual(1)" >');
			$panelcuentas = new Panel("../html/a_crear_pago_aereo.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/a_crear_pago_aereo.php">');
	
	        $select='';
	        $result= mysql_query("SELECT via_id FROM  viaje");
        	while($row = mysql_fetch_array($result))
        	{
			$select_actual='<option value="'.$row["via_id"].'">'.$row["via_id"].'</option>'; 		
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