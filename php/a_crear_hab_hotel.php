<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_POST);
	extract($_GET);
	
	      if($cue_numero)
		  {
		  
			    
				mysql_query("INSERT INTO `habitacion` (`hab_id` ,`hab_piso` ,`hab_tipo` ,`hab_capacidad` ,`hab_costo`,`hab_status`,`fk_cru_id`, `fk_hot_id`,`hab_categoria`)VALUES (NULL ,  '$cue_numero',  'Hotel',  '$fecha',  '$banco','No ocupada', NULL, '$hot_id', '$categoria')");
			    
				$hola='a_hoteles.php?mensaje=1';
				header("Location:$hola");

		  
		  }
	      else
		  {
			//echo "$hot_id  cue";
			$admin= new Panel("../html/admin.html");
			$admin->add("body",'<body onLoad = "actual(5)" >');
			$panelcuentas = new Panel("../html/a_crear_hab_hotel.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/a_crear_hab_hotel.php?hot_id='.$hot_id.'">');
			$panelcuentas->add("tipo_boton",'Agregar');
			//$panelcuentas->add("error",'Ya existe un estadio '.$cue_numero.' andre '.$row["ban_nombre"]);
	        $admin->add("contenido",$panelcuentas);
	        $admin->show();
			
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>