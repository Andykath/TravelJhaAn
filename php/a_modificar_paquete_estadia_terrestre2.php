<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_GET);
	extract($_POST);
	
	      if($cue_numero)
		  {// aqui validar que los datos esten bien y hacer update
		
	
					  mysql_query("UPDATE `viaje` SET  `via_tipo` =  'Paquete', `via_tipoviaje` =  '$cue_numero', `via_fecha_ini` =  '$fecha',`via_fecha_fin` =  '$fecha1', `via_millas` =  '$millas',`via_tipo_paq` =  '$tipopaq',`via_cant_per` =  '$cantper', `fk_via_id_origen` =  '$banco', `fk_via_id_destino` =  '$banco1',`via_hotel`= $hotel WHERE  `viaje`.`via_id` = $cue_id");
					
					$hola='a_paquetes_estadia_terrestre.php?mensaje=2';
				    header("Location:$hola");
					  
					  
					  
					
				
					
				
			 	
	
		  }
	      else
		  {//aqui pinta el editor por primera vez	cyo lo acabo d hacer tb :S ya va
		              echo("entra");
					$admin= new Panel("../html/admin.html");
					$admin->add("body",'<body onLoad = "actual(9)" >');
					$panelestadios = new Panel("../html/a_modificar_paquete_estadia_terrestre.html");
					$panelestadios->add("form",'<form name="form1" method="post" action="../php/a_modificar_paquete_estadia_terrestre2.php">');
					
					$panelestadios->add("cue_numero",$tipoviaje);
					$panelestadios->add("fecha",$fechai);
					$panelestadios->add("fecha1",$fechaf);
					$panelestadios->add("banco",$banco);
					$panelestadios->add("banco1",$banco1);
					$panelestadios->add("cue_id",$id);
					$panelestadios->add("millas",$millas);
					 $panelestadios->add("tipopaq",$tipopaq);
					 $panelestadios->add("cantper",$cantper);
					
			
					$select='';
					$result= mysql_query("SELECT v.*, a.ter_nombre, d.des_nombre FROM  via v, terrestre a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_ter_id=a.ter_id AND v.fk_ter_id IS NOT NULL AND v.fk_cru_id IS NULL AND v.fk_aer_id IS NULL");
					while($row = mysql_fetch_array($result))
					{				
						
						if ($row["via_id"]==$fkvia){
						    //echo 'if';
						   $select_actual='<option selected="selected" value="'.$row["via_id"].'">'.$row["ter_nombre"]."/".$row["des_nombre"].'</option>'; }	
						else{
						    //echo "banco es $banco";
						   $select_actual='<option value="'.$row["via_id"].'">'.$row["ter_nombre"]."/".$row["des_nombre"].'</option>'; 	}	
					    $select=$select.$select_actual;
					}
					$panelestadios->add("bancos",$select);
					
					if ($selected && $formaviaje && $fechai && $fechaf && $millas && $tipopaq && $cantper && ($selected2=="k"))
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
								$panelestadios->add("bancos",$select2);
								$panelestadios->add("cue_id",$id);
								$panelestadios->add("cue_numero",$formaviaje);
								$panelestadios->add("fecha",$fechai);
								$panelestadios->add("fecha1",$fechaf);
								$panelestadios->add("millas",$millas);
								$panelestadios->add("tipopaq",$tipopaq);
								$panelestadios->add("cantper",$cantper);
								
						        $res=mysql_query("SELECT fk_ter_id FROM  via where via_id=$selected");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_ter_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];		
					    
						$result1= mysql_query("SELECT v.*, a.ter_nombre, d.des_nombre FROM  via v, terrestre a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_ter_id=a.ter_id AND v.fk_ter_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_cru_id IS NULL AND v.fk_aer_id IS NULL");
						while($row1 = mysql_fetch_array($result1))
						{
						$select_actual1='<option value="'.$row1["via_id"].'">'.$row1["ter_nombre"]."/".$row1["des_nombre"].'</option>'; 
						$select1=$select1.$select_actual1;
						}
						$panelestadios->add("bancos1",$select1);
					  
					 
			  
			  }
			  
			  
			  
			  
			  
			  if ($selected && $formaviaje && $fechai && $fechaf && $millas && $tipopaq && $cantper && ($selected2!="k"))
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
								$panelestadios->add("bancos",$select2);
								$panelestadios->add("cue_id",$id);
								
								$panelestadios->add("cue_numero",$formaviaje);
								$panelestadios->add("fecha",$fechai);
								$panelestadios->add("fecha1",$fechaf);
								$panelestadios->add("millas",$millas);
								$panelestadios->add("tipopaq",$tipopaq);
								$panelestadios->add("cantper",$cantper);
								
						        $res=mysql_query("SELECT fk_ter_id FROM  via where via_id=$selected");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_ter_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];		
					    
						$result1= mysql_query("SELECT v.*, a.ter_nombre, d.des_nombre FROM  via v, terrestre a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_ter_id=a.ter_id AND v.fk_ter_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_cru_id IS NULL AND v.fk_aer_id IS NULL");
						while($row1 = mysql_fetch_array($result1))
						{
						    
							if ($row1["via_id"]==$selected2){
								//echo 'if';
								$select_actual1='<option selected="selected" value="'.$row1["via_id"].'">'.$row1["ter_nombre"]."/".$row1["des_nombre"].'</option>'; }	
							else{
								//echo "banco es $banco";
								$select_actual1='<option value="'.$row1["via_id"].'">'.$row1["ter_nombre"]."/".$row1["des_nombre"].'</option>'; 	}	
						$select1=$select1.$select_actual1;
						}
						$panelestadios->add("bancos1",$select1);
						
				       
					    //echo($selected2);
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
						$panelestadios->add("hoteles",$select4);
						
					  
					 
			  
			  }
			
				
					 
			  
			  
					
					
					
					
					
					$panelestadios->add("tipo_boton",'Modificar');
					$admin->add("contenido",$panelestadios);
					$admin->show();
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>