<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_POST);
	extract($_GET);
	      if($cue_numero)
		  {
		  
		    
			
			
			
		
			//echo($banco);
			// echo($hot_id);
			  
				mysql_query("INSERT INTO `viaje` (`via_id`,`via_tipo` ,`via_tipoviaje` ,`via_fecha_ini`, `via_fecha_fin`,`via_hora_ini`,`via_hora_fin`,`via_millas`, `via_tipo_paq`, `via_cant_per`,`fk_pre_id`, `fk_via_id_origen`, `fk_via_id_destino`, `via_hotel`) VALUES (NULL ,'Paquete','$cue_numero','$fecha','$fecha1',NULL ,NULL,'$millas','$tipopaq','$cantper',NULL,'$banco', '$banco1', '$hotel')");
			    
				$hola='a_paquetes_estadia_aerolineas.php?mensaje=1';
				header("Location:$hola");
			  
			  
			  
		  
		  
		  
		  
		  
	  
		  
		  
		  }
	      else
		  {
			
			$admin= new Panel("../html/admin.html");
			$admin->add("body",'<body onLoad = "actual(8)" >');
			$panelcuentas = new Panel("../html/a_crear_paquete_estadia_aerolinea.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/a_crear_paquete_estadia_aerolinea.php">');
	
	        $select='';
	        $result= mysql_query("SELECT v.*, a.aer_nombre, d.des_nombre FROM  via v, aerolinea a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_aer_id=a.aer_id AND v.fk_aer_id IS NOT NULL AND v.fk_cru_id IS NULL AND v.fk_ter_id IS NULL");
        	while($row = mysql_fetch_array($result))
        	{
			$select_actual='<option value="'.$row["via_id"].'">'.$row["aer_nombre"]."/".$row["des_nombre"].'</option>'; 		
			$select=$select.$select_actual;
			}
			$panelcuentas->add("bancos",$select);
			
			
			
			
			
			if ($selected && $formaviaje && $fechai && $fechaf && $millas && $tipopaq && $cantper && ($selected2=="k"))
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
								
								$panelcuentas->add("cue_numero",$formaviaje);
								$panelcuentas->add("fecha",$fechai);
								$panelcuentas->add("fecha1",$fechaf);
								$panelcuentas->add("millas",$millas);
								$panelcuentas->add("tipopaq",$tipopaq);
								$panelcuentas->add("cantper",$cantper);
								
						        $res=mysql_query("SELECT fk_aer_id FROM  via where via_id=$selected");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_aer_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];		
					    
						$result1= mysql_query("SELECT v.*, a.aer_nombre, d.des_nombre FROM  via v, aerolinea a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_aer_id=a.aer_id AND v.fk_aer_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_cru_id IS NULL AND v.fk_ter_id IS NULL");
						while($row1 = mysql_fetch_array($result1))
						{
						$select_actual1='<option value="'.$row1["via_id"].'">'.$row1["aer_nombre"]."/".$row1["des_nombre"].'</option>'; 
						$select1=$select1.$select_actual1;
						}
						$panelcuentas->add("bancos1",$select1);
					  
					 
			  
			  }
			  
			  
			  
			  
			  
			  if ($selected && $formaviaje && $fechai && $fechaf && $millas && $tipopaq && $cantper && ($selected2!="k"))
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
								
								$panelcuentas->add("cue_numero",$formaviaje);
								$panelcuentas->add("fecha",$fechai);
								$panelcuentas->add("fecha1",$fechaf);
								$panelcuentas->add("millas",$millas);
								$panelcuentas->add("tipopaq",$tipopaq);
								$panelcuentas->add("cantper",$cantper);
								
						        $res=mysql_query("SELECT fk_aer_id FROM  via where via_id=$selected");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_aer_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];		
					    
						$result1= mysql_query("SELECT v.*, a.aer_nombre, d.des_nombre FROM  via v, aerolinea a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_aer_id=a.aer_id AND v.fk_aer_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_cru_id IS NULL AND v.fk_ter_id IS NULL");
						while($row1 = mysql_fetch_array($result1))
						{
						    
							if ($row1["via_id"]==$selected2){
								//echo 'if';
								$select_actual1='<option selected="selected" value="'.$row1["via_id"].'">'.$row1["aer_nombre"]."/".$row1["des_nombre"].'</option>'; }	
							else{
								//echo "banco es $banco";
								$select_actual1='<option value="'.$row1["via_id"].'">'.$row1["aer_nombre"]."/".$row1["des_nombre"].'</option>'; 	}	
						$select1=$select1.$select_actual1;
						}
						$panelcuentas->add("bancos1",$select1);
						
				       
					  // echo($selected2);
					   $res3=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected2");
						$ro3 = mysql_fetch_array($res3);
						$devuelve3=$ro3['fk_des_id'];	
						echo "$devuelve3 dev";
							
						$result4= mysql_query("SELECT ho.hot_nombre, ho.hot_id FROM  hotel ho WHERE ho.fk_des_id=$devuelve3");
						while($row4 = mysql_fetch_array($result4))
						{
						$select_actual4='<option value="'.$row4["hot_id"].'">'.$row4["hot_nombre"].'</option>'; 
						$select4=$select4.$select_actual4;
						}
						$panelcuentas->add("hoteles",$select4);
						
					  
					 
			  
			  }
			
			
			
			
			
			
			$panelcuentas->add("tipo_boton",'Agregar');
			//$panelcuentas->add("error",'Ya existe un estadio '.$cue_numero.' andre '.$row["ban_nombre"]);
	        $admin->add("contenido",$panelcuentas);
	        $admin->show();
			
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>