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
			  
				mysql_query("INSERT INTO `promocion` (`pro_id` ,`pro_nombre` ,`pro_fechaini`, `pro_fechafin`, `pro_descuento`, `pro_durac_viaje`, `fk_hab_id`,`fk_via_id`,`fk_via_id2`) VALUES (NULL ,'$cue_numero','$fecha','$fecha1','$des','$dur', NULL,'$banco','$banco1')");
			    
				$hola='a_promociones_sinestadia_aerolineas.php?mensaje=1';
				header("Location:$hola");
			  
			  
			  
		  
		  
		  
		  
		  
	  
		  
		  
		  }
	      else
		  {
			
			$admin= new Panel("../html/admin.html");
			$admin->add("body",'<body onLoad = "actual(1)" >');
			$panelcuentas = new Panel("../html/a_crear_promocion_sinestadia_aerolinea.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/a_crear_promocion_sinestadia_aerolinea.php">');
	
	        $select='';
	        $result= mysql_query("SELECT v.*, a.aer_nombre, d.des_nombre FROM  via v, aerolinea a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_aer_id=a.aer_id AND v.fk_aer_id IS NOT NULL AND v.fk_cru_id IS NULL AND v.fk_ter_id IS NULL");
        	while($row = mysql_fetch_array($result))
        	{
			$select_actual='<option value="'.$row["via_id"].'">'.$row["aer_nombre"]."/".$row["des_nombre"].'</option>'; 		
			$select=$select.$select_actual;
			}
			$panelcuentas->add("bancos",$select);
			
			
			if ($selected && $nombre && $fechai && $fechaf && $desc && $durac && ($selected2=="k"))
					{
					
						$result2= mysql_query("SELECT v.*, a.aer_nombre, d.des_nombre FROM  via v, aerolinea a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_aer_id=a.aer_id AND v.fk_aer_id IS NOT NULL AND v.fk_cru_id IS NULL AND v.fk_ter_id IS NULL");
						while($row2 = mysql_fetch_array($result2))
						{				
							
							if ($row2["via_id"]==$selected){
								//echo 'if';
								$select_actual2='<option selected="selected" value="'.$row2["via_id"].'">'.$row2["aer_nombre"]."/".$row2["des_nombre"].'</option>'; }	
							else{
								//echo "banco es $banco";
								$select_actual2='<option value="'.$row2["via_id"].'">'.$row2["aer_nombre"]."/".$row2["des_nombre"].'</option>'; 	}	
							$select2=$select2.$select_actual2;
						}
						$panelcuentas->add("bancos",$select2);
						
				        $panelcuentas->add("cue_numero",$nombre);
						$panelcuentas->add("fecha",$fechai);
						$panelcuentas->add("fecha1",$fechaf);
						$panelcuentas->add("des",$desc);
						$panelcuentas->add("dur",$durac);

 $res=mysql_query("SELECT fk_aer_id FROM  via where via_id=$selected");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_aer_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];		


                        
						
						
						 $select='';
	        $result3= mysql_query("SELECT v.*, a.aer_nombre, d.des_nombre FROM  via v, aerolinea a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_aer_id=a.aer_id AND v.fk_aer_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_cru_id IS NULL AND v.fk_ter_id IS NULL");
        	while($row3 = mysql_fetch_array($result3))
        	{
			$select_actual3='<option value="'.$row3["via_id"].'">'.$row3["aer_nombre"]."/".$row3["des_nombre"].'</option>'; 		
			$select3=$select3.$select_actual3;
			}
			$panelcuentas->add("bancos1",$select3);
					}
			
			
			
			$panelcuentas->add("tipo_boton",'Agregar');
			//$panelcuentas->add("error",'Ya existe un estadio '.$cue_numero.' andre '.$row["ban_nombre"]);
	        $admin->add("contenido",$panelcuentas);
	        $admin->show();
			
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>