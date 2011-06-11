<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_POST);
	
	      if($cue_numero)
		  {
		  
		    
			
			
			
		
			//echo($banco);
			// echo($hot_id);
			  
				mysql_query("INSERT INTO `promocion` (`pro_id` ,`pro_nombre` ,`pro_fechaini`, `pro_fechafin`, `pro_descuento`, `pro_durac_viaje`, `fk_hab_id`,`fk_via_id`) VALUES (NULL ,'$cue_numero','$fecha','$fecha1','$des','$dur', NULL,'$banco')");
			    
				$hola='a_promociones_sinestadia_terrestre.php?mensaje=1';
				header("Location:$hola");
			  
			  
			  
		  
		  
		  
		  
		  
	  
		  
		  
		  }
	      else
		  {
			
			$admin= new Panel("../html/admin.html");
			$admin->add("body",'<body onLoad = "actual(9)" >');
			$panelcuentas = new Panel("../html/a_crear_promocion_sinestadia_terrestre.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/a_crear_promocion_sinestadia_terrestre.php">');
	
	        $select='';
	        $result= mysql_query("SELECT v.*, t.ter_nombre, d.des_nombre FROM  via v, terrestre t, destino d WHERE v.fk_des_id=d.des_id AND v.fk_ter_id=t.ter_id AND v.fk_ter_id IS NOT NULL AND v.fk_cru_id IS NULL AND v.fk_aer_id IS NULL");
        	while($row = mysql_fetch_array($result))
        	{
			$select_actual='<option value="'.$row["via_id"].'">'.$row["ter_nombre"]."/".$row["des_nombre"].'</option>'; 		
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