<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
   $cedula=$_SESSION['cedula'];
   $cedulaaux=$_SESSION['cedulaaux'];
    //$total=$_SESSION[$total];
	$locura1=$_SESSION['cedulaaux'];
	//print_r($_POST);
	//echo($cedula);
	extract($_POST);
	extract($_GET);
	      
		  if($fecha)
		  {
		  
		  
		    
			
			
			
		
			//echo("entra");
			//echo(" aqui,$cantper,$fecha,$habitacion,$servicio,$total,$cedula,$banco,$banco1");
			
			$total2= (float) $total;
			//echo("entra  $total $total");
				mysql_query("INSERT INTO `presupuesto` (`pre_id`, `pre_fecha`,`pre_habitacion`,`pre_servicio`,`pre_paseo`,`pre_total`,`pre_cant_per`,`fk_per_cedula`, `fk_via_id_origen`, `fk_via_id_destino`,`pre_abono`,`pre_status`) VALUES (NULL ,'$fecha','$habitacion','$servicio',null, '$total2','$cantper', '$cedula','$banco', '$banco1',0,'No comprado')");
			    
				$hola='u_presupuesto_undestino_conestadia_maritimo.php?mensaje=1';
				header("Location:$hola");
			  
			  
			  
		  
		  
		  
		  
		  
	  
		  
		  
		  }
	      else
		  {
			
			$admin= new Panel("../html/usuario.html");
			$admin->add("body",'<body onLoad = "actual(3)" >');
			$panelcuentas = new Panel("../html/u_crear_presupuesto_undestino_conestadia_maritimo.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/u_crear_presupuesto_undestino_conestadia_maritimo.php?">');
	
	        ($peraux);
	
	        $select='';
	        $result= mysql_query("SELECT v.*, a.cru_nombre, d.des_nombre FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id IS NOT NULL AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL");
        	while($row = mysql_fetch_array($result))
        	{
			$select_actual='<option value="'.$row["via_id"].'">'.$row["cru_nombre"]."/".$row["des_nombre"].'</option>'; 		
			$select=$select.$select_actual;
			}
			$panelcuentas->add("bancos",$select);
			
			
			
			
			
			if ($selected && $fechai && ($selected2=="k") && ($selected3=="a"))//aqui no va a entrar porq el 2 no es k es ke no tiene ke entrar ahi sino en el otro 
			  {
			   echo('entra1');
						 $result2= mysql_query("SELECT v.*, a.cru_nombre, d.des_nombre FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id IS NOT NULL AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL");
								while($row2 = mysql_fetch_array($result2))
								{				
									
									if ($row2["via_id"]==$selected){
										//echo 'if';
										$select_actual2='<option selected="selected" value="'.$row2["via_id"].'">'.$row2["cru_nombre"]."/".$row2["des_nombre"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual2='<option value="'.$row2["via_id"].'">'.$row2["cru_nombre"]."/".$row2["des_nombre"].'</option>'; 	}	
									$select2=$select2.$select_actual2;
								}
								$panelcuentas->add("bancos",$select2);
								
								
								$panelcuentas->add("fecha",$fechai);
								
						        $res=mysql_query("SELECT fk_cru_id FROM  via where via_id=$selected");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_cru_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];	
								
								echo($devuelve);
								echo($devuelve1);	
					    
						$result1= mysql_query("SELECT v.*, a.cru_nombre, d.des_nombre FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL");
						while($row1 = mysql_fetch_array($result1))
						{
						$select_actual1='<option value="'.$row1["via_id"].'">'.$row1["cru_nombre"]."/".$row1["des_nombre"].'</option>'; 
						$select1=$select1.$select_actual1;
						}
						$panelcuentas->add("bancos1",$select1);//hasta ahi lo hi  es q no entra en ninguno chama tienes q hacer uno como el d abajo pero sin cantper ni tipoviaje ah? porke???:S:S pa  kpoerq ahi le estas mandando selected2 diferente de k y selected 3 es a pero no le mnadndas cantper ni tipociaje yab=va
						
						
					  
					 
			  
			  }
			  
			 
			  
			  
			  
			  
			  if ($selected && $fechai && ($selected2!="k") && ($selected3=="a"))
			  {
			   //echo('entra2');
						 $result2= mysql_query("SELECT v.*, a.cru_nombre, d.des_nombre FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id IS NOT NULL AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL");
								while($row2 = mysql_fetch_array($result2))
								{				
									
									if ($row2["via_id"]==$selected){
										//echo 'if';
										$select_actual2='<option selected="selected" value="'.$row2["via_id"].'">'.$row2["cru_nombre"]."/".$row2["des_nombre"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual2='<option value="'.$row2["via_id"].'">'.$row2["cru_nombre"]."/".$row2["des_nombre"].'</option>'; 	}	
									$select2=$select2.$select_actual2;
								}
								$panelcuentas->add("bancos",$select2);
								
						
								$panelcuentas->add("fecha",$fechai);
							
								
						        $res=mysql_query("SELECT fk_cru_id FROM  via where via_id=$selected");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_cru_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];		
					    
						$result1= mysql_query("SELECT v.*, a.cru_nombre, d.des_nombre FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL");
						while($row1 = mysql_fetch_array($result1))
						{
						    
							if ($row1["via_id"]==$selected2){
								//echo 'if';
								$select_actual1='<option selected="selected" value="'.$row1["via_id"].'">'.$row1["cru_nombre"]."/".$row1["des_nombre"].'</option>'; }	
							else{
								//echo "banco es $banco";
								$select_actual1='<option value="'.$row1["via_id"].'">'.$row1["cru_nombre"]."/".$row1["des_nombre"].'</option>'; 	}	
						$select1=$select1.$select_actual1;
						}
						$panelcuentas->add("bancos1",$select1);
						
							
				       
					  // echo($selected2);
					   $res3=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected2");
						$ro3 = mysql_fetch_array($res3);
						$devuelve3=$ro3['fk_des_id'];	
						//echo "$devuelve3 dev";
							
						$result4= mysql_query("SELECT ho.flo_nombre, ho.flo_id FROM  flota ho ");
						while($row4 = mysql_fetch_array($result4))
						{
						$select_actual4='<option value="'.$row4["flo_id"].'">'.$row4["flo_nombre"].'</option>'; 
						$select4=$select4.$select_actual4;
						}
						$panelcuentas->add("hoteles",$select4);
						
						
					  
					 
			  
			  }
			  
			  if ($selected && $fechai && ($selected2!="k") && ($selected3!="a") )
			  {
			   //echo('entra3');
						 $result2= mysql_query("SELECT v.*, a.cru_nombre, d.des_nombre FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id IS NOT NULL AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL");
								while($row2 = mysql_fetch_array($result2))
								{				
									
									if ($row2["via_id"]==$selected){
										//echo 'if';
										$select_actual2='<option selected="selected" value="'.$row2["via_id"].'">'.$row2["cru_nombre"]."/".$row2["des_nombre"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual2='<option value="'.$row2["via_id"].'">'.$row2["cru_nombre"]."/".$row2["des_nombre"].'</option>'; 	}	
									$select2=$select2.$select_actual2;
								}
								$panelcuentas->add("bancos",$select2);
								
						
								$panelcuentas->add("fecha",$fechai);
							
								
						        $res=mysql_query("SELECT fk_cru_id FROM  via where via_id=$selected");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_cru_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];	
							
					    
						$result1= mysql_query("SELECT v.*, a.cru_nombre, d.des_nombre FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL");
						while($row1 = mysql_fetch_array($result1))
						{
						    
							if ($row1["via_id"]==$selected2){
								//echo 'if';
								$select_actual1='<option selected="selected" value="'.$row1["via_id"].'">'.$row1["cru_nombre"]."/".$row1["des_nombre"].'</option>'; }	
							else{
								//echo "banco es $banco";
								$select_actual1='<option value="'.$row1["via_id"].'">'.$row1["aer_nombre"]."/".$row1["cru_nombre"].'</option>'; 	}	
						$select1=$select1.$select_actual1;
						}
						$panelcuentas->add("bancos1",$select1);
						
				       
					  // echo($selected2);
					    $res3=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected2");
						$ro3 = mysql_fetch_array($res3);
						$devuelve3=$ro3['fk_des_id'];	
						//echo "$devuelve3 dev";
						
							
						$result4= mysql_query("SELECT ho.flo_nombre, ho.flo_id FROM  flota ho");
						while($row4 = mysql_fetch_array($result4))
						{
						if ($row4["flo_id"]==$selected3){
										//echo 'if';
										$select_actual4='<option selected="selected" value="'.$row4["flo_id"].'">'.$row4["flo_nombre"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual4='<option value="'.$row4["flo_id"].'">'.$row4["flo_nombre"].'</option>'; 	}	
						$select4=$select4.$select_actual4;
						}
						$panelcuentas->add("hoteles",$select4);
						

					
					
	
					
					//echo($selected3);
						$result5= mysql_query("SELECT h.hab_id, h.hab_costo FROM  habitacion h  WHERE h.fk_cru_id=$selected3 AND h.hab_status='No ocupada'");
						while($row5 = mysql_fetch_array($result5))
						{
						$select_actual5='<option value="'.$row5["hab_id"].'">'.$row5["hab_id"].' Costo:'.$row5["hab_costo"].'</option>'; 
						$select5=$select5.$select_actual5;
						}
						$panelcuentas->add("habitaciones",$select5);
						
						
						
						$result7= mysql_query("SELECT s.ser_nombre, s.ser_descripcion,s.ser_id,s.ser_costo FROM  servicio s, cru_ser hs WHERE hs.fk_flo_id=$selected3 AND hs.fk_ser_id=s.ser_id");
						while($row7 = mysql_fetch_array($result7))
						{
						$select_actual7='<option value="'.$row7["ser_id"].'">'.$row7["ser_nombre"].'/'.$row7["ser_descripcion"].'/'.$row7["ser_costo"].'</option>'; 
						$select7=$select7.$select_actual7;
						}
						$panelcuentas->add("servicios",$select7);
						
						
						
						
						
					   
					   
					    
						
						
						
						
						
						
						
						
						
							
						//echo "$devuelve3 dev";
						
			  
			  
			  
			  
			  }
			  
			  
			  
			  
			  
			   if ($selected && $fechai && ($selected2!="k") && ($selected3!="a") && $selected4  && $selected5  &&$cantper && $tipoviaje)
			  {
			             echo('entra6');
			  
						 $result2= mysql_query("SELECT v.*, a.cru_nombre, d.des_nombre FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id IS NOT NULL AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL");
								while($row2 = mysql_fetch_array($result2))
								{				
									
									if ($row2["via_id"]==$selected){
										//echo 'if';
										$select_actual2='<option selected="selected" value="'.$row2["via_id"].'">'.$row2["cru_nombre"]."/".$row2["des_nombre"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual2='<option value="'.$row2["via_id"].'">'.$row2["cru_nombre"]."/".$row2["des_nombre"].'</option>'; 	}	
									$select2=$select2.$select_actual2;
								}
								$panelcuentas->add("bancos",$select2);
								
						
								$panelcuentas->add("fecha",$fechai);
							
								
						        $res=mysql_query("SELECT fk_cru_id FROM  via where via_id=$selected");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_cru_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];	
							
					    
						$result1= mysql_query("SELECT v.*, a.cru_nombre, d.des_nombre FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL");
						while($row1 = mysql_fetch_array($result1))
						{
						    
							if ($row1["via_id"]==$selected2){
								//echo 'if';
								$select_actual1='<option selected="selected" value="'.$row1["via_id"].'">'.$row1["cru_nombre"]."/".$row1["des_nombre"].'</option>'; }	
							else{
								//echo "banco es $banco";
								$select_actual1='<option value="'.$row1["via_id"].'">'.$row1["cru_nombre"]."/".$row1["des_nombre"].'</option>'; 	}	
						$select1=$select1.$select_actual1;
						}
						$panelcuentas->add("bancos1",$select1);
						
				       
					  // echo($selected2);
					    $res3=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected2");
						$ro3 = mysql_fetch_array($res3);
						$devuelve3=$ro3['fk_des_id'];	
						//echo "$devuelve3 dev";
						
							
						$result4= mysql_query("SELECT ho.flo_nombre, ho.flo_id FROM  flota ho");
						while($row4 = mysql_fetch_array($result4))
						{
						if ($row4["flo_id"]==$selected3){
										//echo 'if';
										$select_actual4='<option selected="selected" value="'.$row4["flo_id"].'">'.$row4["flo_nombre"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual4='<option value="'.$row4["flo_id"].'">'.$row4["flo_nombre"].'</option>'; 	}	
						$select4=$select4.$select_actual4;
						}
						$panelcuentas->add("hoteles",$select4);
						
						
						//echo($selected3);
						
						$result5= mysql_query("SELECT h.hab_id, h.hab_costo FROM  habitacion h  WHERE h.fk_cru_id=$selected3 AND h.hab_status='No ocupada'");
						while($row5 = mysql_fetch_array($result5))
						{
						if ($row5["hab_id"]==$selected4){
										//echo 'if';
										$select_actual5='<option selected="selected" value="'.$row5["hab_id"].'">'.$row5["hab_id"].' Costo:'.$row5["hab_costo"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual5='<option value="'.$row5["hab_id"].'">'.$row5["hab_id"].' Costo:'.$row5["hab_costo"].'</option>'; 	}	
						$select5=$select5.$select_actual5;
						}
						$panelcuentas->add("habitaciones",$select5);
						
					   
					   
					    $result7= mysql_query("SELECT s.ser_nombre, s.ser_descripcion,s.ser_id,s.ser_costo FROM  servicio s, cru_ser hs WHERE hs.fk_flo_id=$selected3 AND hs.fk_ser_id=s.ser_id");
						while($row7 = mysql_fetch_array($result7))
						{
						if ($row7["ser_id"]==$selected5){
										//echo 'if';
										$select_actual7='<option selected="selected" value="'.$row7["ser_id"].'">'.$row7["ser_nombre"].'Descripcion:'.$row7["ser_descripcion"].'/'.$row7["ser_costo"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual7='<option value="'.$row7["ser_id"].'">'.$row7["ser_nombre"].'Descripcion'.$row7["ser_descripcion"].'/'.$row7["ser_costo"].'</option>'; 	}	
						$select7=$select7.$select_actual7;
						}
						$panelcuentas->add("servicios",$select7);
						
						
				
						
						
						
						
						//// Hallando el costo total del presupuesto
						
						$costo_total=0;
						
						$res5=mysql_query("SELECT via_costo FROM  via where via_id=$selected2");
						$ro5 = mysql_fetch_array($res5);
						$costo_via=$ro5['via_costo'];
						//echo($costo_via);
						
						$res6=mysql_query("SELECT hab_costo FROM  habitacion h  where h.fk_cru_id=$selected3 AND h.hab_id=$selected4");
						$ro6 = mysql_fetch_array($res6);
						$costo_hab=$ro6['hab_costo'];
						//echo($costo_hab);
						echo($selected3);
						echo($selected5);
						
						$res7=mysql_query("SELECT ser_costo FROM  servicio s, cru_ser cs  where cs.fk_flo_id=$selected3 AND cs.fk_ser_id=s.ser_id AND s.ser_id=$selected5");
						$ro7 = mysql_fetch_array($res7);
						$costo_ser=$ro7['ser_costo'];
						//echo($costo_ser);
						
						
						//echo($costo_via);
						//echo($costo_hab);
						//echo($costo_ser);
						//echo($costo_pas1);
						if($tipoviaje=="Ida y vuelta")
						{
						$costo_total=($costo_total+$costo_via+$costo_hab+$costo_ser)*$cantper*2;}
						else{
						$costo_total=($costo_total+$costo_via+$costo_hab+$costo_ser)*$cantper; }
						
						
						//echo($costo_total);
						$panelcuentas->add("totaltodo",$costo_total);
						
						
						
						
			  }
			  
			  
			  
			  
			

			
			
			
			
			
			$panelcuentas->add("tipo_boton",'Presupuestar');
			//$panelcuentas->add("error",'Ya existe un estadio '.$cue_numero.' andre '.$row["ban_nombre"]);
	        $admin->add("contenido",$panelcuentas);
	        $admin->show();
			
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>