<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_POST);
	extract($_GET);
	
	      if($cue_numero)
		  {
		  
			    //echo "$hot_id, $cue_numero , $fecha, $banco";
				mysql_query("INSERT INTO `habitacion` (`hab_id` ,`hab_piso` ,`hab_tipo` ,`hab_capacidad` ,`hab_costo`,`fk_cru_id`, `fk_hot_id`,
	`hab_categoria`)VALUES (NULL ,  '$cue_numero',  'Crucero',  '$fecha',  '$banco', '$hot_id', NULL, '$categoria')");
			    
				$hola='a_camarotes.php?cue_id='.$hot_id.'';
				header("Location:$hola");

		  
		  }
	      else
		  {
			//echo "$hot_id  cue";
			$admin= new Panel("../html/admin.html");
			$admin->add("body",'<body onLoad = "actual(15)" >');
			$panelcuentas = new Panel("../html/a_crear_camarote.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/a_crear_camarote.php?hot_id='.$hot_id.'">');
			$panelcuentas->add("tipo_boton",'Agregar');
			//$panelcuentas->add("error",'Ya existe un estadio '.$cue_numero.' andre '.$row["ban_nombre"]);
	        $admin->add("contenido",$panelcuentas);
	        $admin->show();
			
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>