<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_POST);
	
	      if($cue_numero)
		  {
		  
		     $result1= mysql_query("SELECT * FROM hotel c WHERE c.hot_nombre ='$cue_numero' and c.fk_des_id='$banco'");
			
			
			
			  if (mysql_fetch_array($result1))
			  {
					$admin= new Panel("../html/admin.html");
					$admin->add("body",'<body onLoad = "actual(5)" >');
					$panelcuentas = new Panel("../html/a_crear_hotel.html");
					$panelcuentas->add("form",'<form name="form1" method="post" action="../php/a_crear_hotel.php">');
					$panelcuentas->add("cue_numero",$cue_numero);
					//$panelcuentas->add("tipo",$tipo);
					$panelcuentas->add("fecha",$cue_fecha_apertura);
					
			
					$select='';
					$result= mysql_query("SELECT * FROM  destino d where d.des_descripcion='Ciudad'");
					while($row = mysql_fetch_array($result))
					{
					if ($row["des_id"]==$banco)
					{
					$select_actual='<option selected="selected" value="'.$row["des_id"].'">'.$row["des_nombre"].'</option>'; 	
					$panelcuentas->add("error",'Ya existe un hotel '.$cue_numero.' en '.$row["des_nombre"]);
					}
					else
					$select_actual='<option value="'.$row["des_id"].'">'.$row["des_nombre"].'</option>'; 		
					
					$select=$select.$select_actual;
					}
					$panelcuentas->add("bancos",$select);
					//$panelcuentas->add("error",'Ya existe ese numero de cuenta');
					$panelcuentas->add("tipo_boton",'Agregar');
					$admin->add("contenido",$panelcuentas);
					$admin->show();
					  
			  
			  }
			  else
			  {
				mysql_query("INSERT INTO `hotel` (`hot_id` ,`hot_nombre` ,`hot_estrellas` ,`hot_telefono` ,`fk_des_id`)VALUES (NULL ,  '$cue_numero',  '$tipo',  '$fecha',  '$banco')");
			    
				$hola='a_hoteles.php?mensaje=1';
				header("Location:$hola");
			  
			  
			  }
		  	  
		  
		  }
	      else
		  {
			
			$admin= new Panel("../html/admin.html");
			$admin->add("body",'<body onLoad = "actual(5)" >');
			$panelcuentas = new Panel("../html/a_crear_hotel.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/a_crear_hotel.php">');
	
	        $select='';
	        $result= mysql_query("SELECT * FROM  destino d where d.des_descripcion='Ciudad'");
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