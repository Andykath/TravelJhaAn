<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_POST);
	
	      if($estadio_viejo)
		  {
		  
		     $result1= mysql_query("SELECT * FROM via v WHERE v.via_terminal ='$cue_numero'");
			
			
			
			  if (mysql_fetch_array($result1))
			  {
					$admin= new Panel("../html/admin.html");
					$admin->add("body",'<body onLoad = "actual(1)" >');
					$panelcuentas = new Panel("../html/a_crear_costo1_terrestre.html");
					$panelcuentas->add("form",'<form name="form1" method="post" action="../php/a_crear_costo_terrestre.php">');
					$panelcuentas->add("cue_numero",$cue_numero);
					$panelcuentas->add("tipo",$tipo);
					$panelcuentas->add("fecha",$cue_fecha_apertura);
					
					
			
					$select='';
					$result= mysql_query("SELECT * FROM  terrestre a");
					while($row = mysql_fetch_array($result))
					{
					//if ($row["ban_id"]==$fk_ban_id)
					//{
					//$select_actual='<option selected="selected" value="'.$row["ban_id"].'">'.$row["ban_nombre"].'</option>'; 	
					//$panelcuentas->add("error",'Ya existe un estadio '.$nombre.' en '.$row["ban_nombre"]);
					//}
					//else
					$select_actual='<option value="'.$row["ter_id"].'">'.$row["ter_nombre"].'</option>'; 		
					
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
				 // echo("$tipo,$cue_numero");
				mysql_query("INSERT INTO `costo` (`cos_id` ,`fk_via_origen` ,`fk_via_destino` ,`cos_costo`, `cos_hora`)VALUES (NULL ,'$banco', '$banco1',  '$cue_numero', '$fecha')");
			    
				$hola='a_terrestres.php?mensaje=1';
				header("Location:$hola");
			  
			  
			  }
		  
		  
		  
		  
		  
	  
		  
		  
		  }
	      else
		  {
			
			$admin= new Panel("../html/admin.html");
			$admin->add("body",'<body onLoad = "actual(1)" >');
			$panelcuentas = new Panel("../html/a_crear_costo1_terrestre.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/a_crear_costo1_terrestre.php">');
	
	       
		   
		   $select='';
	        $result= mysql_query("SELECT v.*, a.ter_nombre, d.des_nombre FROM  via v, terrestre a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_ter_id=a.ter_id AND v.fk_ter_id IS NOT NULL AND v.fk_cru_id IS NULL AND v.fk_aer_id IS NULL");
        	while($row = mysql_fetch_array($result))
        	{
			$select_actual='<option value="'.$row["via_id"].'">'.$row["ter_nombre"]."/".$row["des_nombre"].'</option>'; 		
			$select=$select.$select_actual;
			}
			$panelcuentas->add("bancos",$select);
		   
		   
		   if ($selected && $fecha && $cue_numero)
		   {
			   
			    $result2= mysql_query("SELECT v.*, a.ter_nombre, d.des_nombre FROM  via v, terrestre a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_ter_id=a.ter_id AND v.fk_ter_id IS NOT NULL AND v.fk_cru_id IS NULL AND v.fk_aer_id IS NULL");
								while($row2 = mysql_fetch_array($result2))
								{				
									
									if ($row2["via_id"]==$selected){
										//echo 'if';
										$select_actual2='<option selected="selected" value="'.$row2["via_id"].'">'.$row2["ter_nombre"]."/".$row2["des_nombre"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual2='<option value="'.$row2["via_id"].'">'.$row2["ter_nombre"]."/".$row2["des_nombre"].'</option>'; 	}	
									$select2=$select2.$select_actual2;
								}
								$panelcuentas->add("bancos",$select2);
								$panelcuentas->add("fecha",$fecha);
								$panelcuentas->add("cue_numero",$cue_numero);
			   
			   $res=mysql_query("SELECT fk_ter_id FROM  via where via_id=$selected");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_ter_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];		
			   
			   
			    $select3='';
	        $result3= mysql_query("SELECT v.*, a.ter_nombre, d.des_nombre FROM  via v, terrestre a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_ter_id=a.ter_id and v.fk_ter_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_cru_id IS NULL AND v.fk_aer_id IS NULL");
        	while($row3 = mysql_fetch_array($result3))
        	{
			$select_actual3='<option value="'.$row3["via_id"].'">'.$row3["ter_nombre"]."/".$row3["des_nombre"].'</option>'; 		
			$select3=$select3.$select_actual3;
			}
		$panelcuentas->add("bancos1",' <tr><td>Tipo:</td><td><select name="banco1" id="banco1">'.$select3.'</select></td></tr>');
			   
			   
			   }
		   
				
				
				
				
				
		   $panelcuentas->add("tipo_boton",'Agregar');
	        $admin->add("contenido",$panelcuentas);
	        $admin->show();
			
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>