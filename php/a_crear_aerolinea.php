<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_POST);
	
	      if($cue_numero)
		  {
		  
		     $result1= mysql_query("SELECT * FROM aerolinea a WHERE a.aer_nombre ='$cue_numero'");
			
			
			
			  if (mysql_fetch_array($result1))
			  {
					$admin= new Panel("../html/admin.html");
					$admin->add("body",'<body onLoad = "actual(1)" >');
					$panelcuentas = new Panel("../html/a_crear_aerolinea.html");
					$panelcuentas->add("form",'<form name="form1" method="post" action="../php/a_crear_aerolinea.php">');
					$panelcuentas->add("cue_numero",$cue_numero);
					//$panelcuentas->add("tipo",$tipo);
					$panelcuentas->add("fecha",$cue_fecha_apertura);
					
			
					$select='';
					$result= mysql_query("SELECT * FROM  destino d");
					while($row = mysql_fetch_array($result))
					{
					//if ($row["ban_id"]==$fk_ban_id)
					//{
					//$select_actual='<option selected="selected" value="'.$row["ban_id"].'">'.$row["ban_nombre"].'</option>'; 	
					//$panelcuentas->add("error",'Ya existe un estadio '.$nombre.' en '.$row["ban_nombre"]);
					//}
					//else
					$select_actual='<option value="'.$row["des_id"].'">'.$row["des_nombre"].'</option>'; 		
					
					$select=$select.$select_actual;
					}
					$panelcuentas->add("bancos",$select);
					$panelcuentas->add("error",'Ya existe esa aerolinea');
					$panelcuentas->add("tipo_boton",'Agregar');
					$admin->add("contenido",$panelcuentas);
					$admin->show();
					  
			  
			  }
			  else
			  {
				mysql_query("INSERT INTO `aerolinea` (`aer_id` ,`aer_nombre` ,`aer_fecha_inicio` ,`fk_des_id`)VALUES (NULL ,'$cue_numero', '$fecha',  '$banco')");
			    
				$hola='a_aerolineas.php?mensaje=1';
				header("Location:$hola");
			  
			  
			  }
		  
		  
		  
		  
		  
	  
		  
		  
		  }
	      else
		  {
			
			$admin= new Panel("../html/admin.html");
			$admin->add("body",'<body onLoad = "actual(1)" >');
			$panelcuentas = new Panel("../html/a_crear_aerolinea.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/a_crear_aerolinea.php">');
	
	        $select='';
	        $result= mysql_query("SELECT * FROM  destino where des_descripcion='pais'");
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