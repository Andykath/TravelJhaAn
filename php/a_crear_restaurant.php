<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_POST);
	
	      if($cue_numero)
		  {
		  
		     $result1= mysql_query("SELECT * FROM restaurante r WHERE r.res_nombre ='$cue_numero' AND r.fk_des_id= '$banco'");
			
			
			
			  if (mysql_fetch_array($result1))
			  {
					$admin= new Panel("../html/admin.html");
					$admin->add("body",'<body onLoad = "actual(16)" >');
					$panelcuentas = new Panel("../html/a_crear_restaurant.html");
					$panelcuentas->add("form",'<form name="form1" method="post" action="../php/a_crear_restaurant.php">');
					$panelcuentas->add("cue_numero",$cue_numero);
					//$panelcuentas->add("tipo",$tipo);
					$panelcuentas->add("fecha",$cue_fecha_apertura);
					
			
					$select='';
					$result= mysql_query("SELECT * FROM  destino d where d.des_descripcion='Ciudad' order by d.des_nombre");
					while($row = mysql_fetch_array($result))
					{

					$select_actual='<option value="'.$row["des_id"].'">'.$row["des_nombre"].'</option>'; 		
					
					$select=$select.$select_actual;
					}
					$panelcuentas->add("bancos",$select);
					$panelcuentas->add("error",'Ya existe ese restaurant en ese destino');
					$panelcuentas->add("tipo_boton",'Agregar');
					$admin->add("contenido",$panelcuentas);
					$admin->show();
					  
			  
			  }
			  else
			  {
				mysql_query("INSERT INTO `restaurante` (`res_id` ,`res_nombre` ,`res_tipocomida` ,`res_ambiente`, `res_clase` ,`fk_des_id`)VALUES (NULL ,  '$cue_numero',  '$tipo',  '$fecha',  '$clase', '$banco')");
			    
				$hola='a_restaurantes.php?mensaje=1';
				header("Location:$hola");
			  
			  
			  }
		  
		  
		  
		  
		  
	  
		  
		  
		  }
	      else
		  {
			
			$admin= new Panel("../html/admin.html");
			$admin->add("body",'<body onLoad = "actual(16)" >');
			$panelcuentas = new Panel("../html/a_crear_restaurant.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/a_crear_restaurant.php">');
	
	        $select='';
	        $result= mysql_query("SELECT * FROM  destino d where d.des_descripcion='Ciudad' order by d.des_nombre");
        	while($row = mysql_fetch_array($result))
        	{
			$select_actual='<option value="'.$row["des_id"].'">'.$row["des_nombre"].'</option>'; 		
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