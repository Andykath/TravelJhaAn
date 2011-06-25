<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_POST);
	
	      if($cue_numero)
		  {
		  
		     $result1= mysql_query("SELECT * FROM via v WHERE v.via_terminal ='$cue_numero'");
			
			
			
			  if (mysql_fetch_array($result1))
			  {
					$admin= new Panel("../html/admin.html");
					$admin->add("body",'<body onLoad = "actual(1)" >');
					$panelcuentas = new Panel("../html/a_crear_costo_aerolinea.html");
					$panelcuentas->add("form",'<form name="form1" method="post" action="../php/a_crear_costo_aerolinea.php">');
					$panelcuentas->add("cue_numero",$cue_numero);
					$panelcuentas->add("tipo",$tipo);
					$panelcuentas->add("fecha",$cue_fecha_apertura);
					
					
			
					$select='';
					$result= mysql_query("SELECT * FROM  aerolinea a");
					while($row = mysql_fetch_array($result))
					{
					//if ($row["ban_id"]==$fk_ban_id)
					//{
					//$select_actual='<option selected="selected" value="'.$row["ban_id"].'">'.$row["ban_nombre"].'</option>'; 	
					//$panelcuentas->add("error",'Ya existe un estadio '.$nombre.' en '.$row["ban_nombre"]);
					//}
					//else
					$select_actual='<option value="'.$row["aer_id"].'">'.$row["aer_nombre"].'</option>'; 		
					
					$select=$select.$select_actual;
					}
					$panelcuentas->add("bancos",$select);
					
					$panelcuentas->add("tipo_boton",'Agregar');
					
					$result1= mysql_query("SELECT * FROM  destino d where d.des_descripcion='ciudad'");
					while($row = mysql_fetch_array($result1))
					{
					//if ($row["ban_id"]==$fk_ban_id)
					//{
					//$select_actual='<option selected="selected" value="'.$row["ban_id"].'">'.$row["ban_nombre"].'</option>'; 	
					//$panelcuentas->add("error",'Ya existe un estadio '.$nombre.' en '.$row["ban_nombre"]);
					//}
					//else
					$select_actual1='<option value="'.$row["des_id"].'">'.$row["des_nombre"].'</option>'; 		
					
					$select1=$select1.$select_actual1;
					}
					$panelcuentas->add("destinos",$select1);
					$panelcuentas->add("tipo_boton",'Agregar');
					
					
					$panelcuentas->add("error",'Ya existe ese costo');
					$admin->add("contenido",$panelcuentas);
					$admin->show();
					  
			  
			  }
			  else
			  {
				mysql_query("INSERT INTO `via` (`via_id` ,`via_costo` ,`via_terminal` ,`via_millas`, `fk_des_id`, `fk_aer_id`)VALUES (NULL ,null, '$cue_numero',  '$fecha', '$destino', '$banco')");
			    
				$hola='a_aerolineas.php?mensaje=1';
				header("Location:$hola");
			  
			  
			  }
		  
		  
		  
		  
		  
	  
		  
		  
		  }
	      else
		  {
			
			$admin= new Panel("../html/admin.html");
			$admin->add("body",'<body onLoad = "actual(1)" >');
			$panelcuentas = new Panel("../html/a_crear_costo_aerolinea.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/a_crear_costo_aerolinea.php">');
	
	        $select='';
			$select1='';
	        $result= mysql_query("SELECT * FROM  aerolinea a");
        	while($row = mysql_fetch_array($result))
        	{
			$select_actual='<option value="'.$row["aer_id"].'">'.$row["aer_nombre"].'</option>'; 		
			$select=$select.$select_actual;
			}
			$panelcuentas->add("bancos",$select);
			$panelcuentas->add("tipo_boton",'Agregar');
			//$panelcuentas->add("error",'Ya existe un estadio '.$cue_numero.' andre '.$row["ban_nombre"]);
			
			$result1= mysql_query("SELECT * FROM  destino d where d.des_descripcion='ciudad'");
					while($row = mysql_fetch_array($result1))
					{
					//if ($row["ban_id"]==$fk_ban_id)
					//{
					//$select_actual='<option selected="selected" value="'.$row["ban_id"].'">'.$row["ban_nombre"].'</option>'; 	
					//$panelcuentas->add("error",'Ya existe un estadio '.$nombre.' en '.$row["ban_nombre"]);
					//}
					//else
					$select_actual1='<option value="'.$row["des_id"].'">'.$row["des_nombre"].'</option>'; 		
					
					$select1=$select1.$select_actual1;
					}
					$panelcuentas->add("destinos",$select1);
				
					$panelcuentas->add("tipo_boton",'Agregar');
			
			
			
	        $admin->add("contenido",$panelcuentas);
	        $admin->show();
			
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>