<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
   $cedula=$_SESSION['cedula'];
   
    //$total=$_SESSION[$total];
	extract($_POST);
	extract($_GET);
	//print_r($_POST); 
		  if($total && !(isset($sipo)))
		  {
		  
		  
		    
			
			
			//print_r($_POST);
		
			//echo("entra");
			//echo($total);
			$total2= (float) $total;
			//echo("entra  $total $total");
				if($servicio=="z"){
				mysql_query("INSERT INTO `presupuesto` (`pre_id`, `pre_fecha`,`pre_habitacion`,`pre_servicio`,`pre_paseo`,`pre_total`,`pre_cant_per`,`fk_per_cedula`, `fk_via_id_origen`, `fk_via_id_destino`,`pre_abono`,`pre_status`) VALUES (NULL ,'$fecha','$habitacion',NULL,NULL, '$total2','$cantper', '$cedula','$banco', '$banco1',0,'No comprado')");}
				else
				{
				mysql_query("INSERT INTO `presupuesto` (`pre_id`, `pre_fecha`,`pre_habitacion`,`pre_servicio`,`pre_paseo`,`pre_total`,`pre_cant_per`,`fk_per_cedula`, `fk_via_id_origen`, `fk_via_id_destino`,`pre_abono`,`pre_status`) VALUES (NULL ,'$fecha','$habitacion','$servicio',NULL, '$total2','$cantper', '$cedula','$banco', '$banco1',0,'No comprado')");
				}
			    $last = mysql_query("SELECT max(pre_id) as max FROM presupuesto"); 
				$last2 = mysql_fetch_array($last);
				$este=$last2["max"];
				
				if($pas1){
				mysql_query("INSERT INTO `pre_pas` (`pre_id`, `fk_pre_id`,`fk_pas_id`) VALUES (NULL ,'$este','$pas1')");}
				if($pas2){
				mysql_query("INSERT INTO `pre_pas` (`pre_id`, `fk_pre_id`,`fk_pas_id`) VALUES (NULL ,'$este','$pas2')");}
				if($pas3){
				mysql_query("INSERT INTO `pre_pas` (`pre_id`, `fk_pre_id`,`fk_pas_id`) VALUES (NULL ,'$este','$pas3')");}
				if($pas4){
				mysql_query("INSERT INTO `pre_pas` (`pre_id`, `fk_pre_id`,`fk_pas_id`) VALUES (NULL ,'$este','$pas4')");}
				if($pas5){
				mysql_query("INSERT INTO `pre_pas` (`pre_id`, `fk_pre_id`,`fk_pas_id`) VALUES (NULL ,'$este','$pas5')");}
				if($pas6){
				mysql_query("INSERT INTO `pre_pas` (`pre_id`, `fk_pre_id`,`fk_pas_id`) VALUES (NULL ,'$este','$pas6')");}
				if($pas7){
				mysql_query("INSERT INTO `pre_pas` (`pre_id`, `fk_pre_id`,`fk_pas_id`) VALUES (NULL ,'$este','$pas7')");}
				if($pas8){
				mysql_query("INSERT INTO `pre_pas` (`pre_id`, `fk_pre_id`,`fk_pas_id`) VALUES (NULL ,'$este','$pas8')");}
				
				
				
				
				
				
				$hola='u_presupuesto_undestino_conestadia_aereo.php?mensaje=1';
				header("Location:$hola");
			  
			  
			  
		  
		  
		  
		  
		  
	  
		  
		  
		  }
	      else
		  {
			
			$admin= new Panel("../html/usuario.html");
			$admin->add("body",'<body onLoad = "actual(3)" >');
			$panelcuentas = new Panel("../html/u_crear_presupuesto_undestino_conestadia_aereo.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/u_crear_presupuesto_undestino_conestadia_aereo.php?">');
	
	        $select='';
	        $result= mysql_query("SELECT v.*, a.aer_nombre, d.des_nombre FROM  via v, aerolinea a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_aer_id=a.aer_id AND v.fk_aer_id IS NOT NULL AND v.fk_cru_id IS NULL AND v.fk_ter_id IS NULL");
        	while($row = mysql_fetch_array($result))
        	{
			$select_actual='<option value="'.$row["via_id"].'">'.$row["aer_nombre"]."/".$row["des_nombre"].'</option>'; 		
			$select=$select.$select_actual;
			}
			$panelcuentas->add("bancos",$select);
			
			
			
			
			
			if ($selected && $fechai && ($selected2=="k") && ($selected3=="a"))//aqui no va a entrar porq el 2 no es k es ke no tiene ke entrar ahi sino en el otro 
			  {
			   //echo('entra1');
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
								
								
								$panelcuentas->add("fecha",$fechai);
								
						        $res=mysql_query("SELECT fk_aer_id FROM  via where via_id=$selected");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_aer_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];		
					    
						$result1= mysql_query("SELECT v.*, a.aer_nombre, d.des_nombre FROM  via v, aerolinea a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_aer_id=a.aer_id AND v.fk_aer_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_cru_id IS NULL AND v.fk_ter_id IS NULL");
						while($row1 = mysql_fetch_array($result1))
						{
						
						$result6= mysql_query("SELECT c.cos_costo FROM  costo c WHERE c.fk_via_origen=$selected AND c.fk_via_destino=".$row1["via_id"]."");
							 $row6 = mysql_fetch_array($result6);
							 //echo $row6["cos_costo"];
							 
						$select_actual1='<option value="'.$row1["via_id"].'">'.$row1["aer_nombre"]."/".$row1["des_nombre"]."/".$row6["cos_costo"].'</option>'; 
						$select1=$select1.$select_actual1;
						}
						$panelcuentas->add("bancos1",$select1);//hasta ahi lo hi  es q no entra en ninguno chama tienes q hacer uno como el d abajo pero sin cantper ni tipoviaje ah? porke???:S:S pa  kpoerq ahi le estas mandando selected2 diferente de k y selected 3 es a pero no le mnadndas cantper ni tipociaje yab=va
						
						
					  
					 
			  
			  }
			  
			 
			  
			  
			  
			  
			  if ($selected && $fechai && ($selected2!="k") && ($selected3=="a"))
			  {
			   //echo('entra2');
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
								
						
								$panelcuentas->add("fecha",$fechai);
							
								
						        $res=mysql_query("SELECT fk_aer_id FROM  via where via_id=$selected");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_aer_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];		
					    
						$result1= mysql_query("SELECT v.*, a.aer_nombre, d.des_nombre FROM  via v, aerolinea a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_aer_id=a.aer_id AND v.fk_aer_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_cru_id IS NULL AND v.fk_ter_id IS NULL");
						while($row1 = mysql_fetch_array($result1))
						{
						     $result6= mysql_query("SELECT c.cos_costo FROM  costo c WHERE c.fk_via_origen=$selected AND c.fk_via_destino=".$row1["via_id"]."");
							 $row6 = mysql_fetch_array($result6);
							 //echo $row6["cos_costo"];
						
						    
							if ($row1["via_id"]==$selected2){
								//echo 'if';
								$select_actual1='<option selected="selected" value="'.$row1["via_id"].'">'.$row1["aer_nombre"]."/".$row1["des_nombre"]."/".$row6["cos_costo"].'</option>'; }	
							else{
								//echo "banco es $banco";
								$select_actual1='<option value="'.$row1["via_id"].'">'.$row1["aer_nombre"]."/".$row1["des_nombre"]."/".$row6["cos_costo"].'</option>'; 	}	
						$select1=$select1.$select_actual1;
						}
						$panelcuentas->add("bancos1",$select1);
						
							
				       
					  // echo($selected2);
					   $res3=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected2");
						$ro3 = mysql_fetch_array($res3);
						$devuelve3=$ro3['fk_des_id'];	
						//echo "$devuelve3 dev";
							
						$result4= mysql_query("SELECT ho.hot_nombre, ho.hot_id FROM  hotel ho WHERE ho.fk_des_id=$devuelve3");
						while($row4 = mysql_fetch_array($result4))
						{
						$select_actual4='<option value="'.$row4["hot_id"].'">'.$row4["hot_nombre"].'</option>'; 
						$select4=$select4.$select_actual4;
						}
						$panelcuentas->add("hoteles",$select4);
						
						
					  
					 
			  
			  }
			  
			  if ($selected && $fechai && ($selected2!="k") && ($selected3!="a") )
			  {
			   //echo('entra3');
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
								
						
								$panelcuentas->add("fecha",$fechai);
							
								
						        $res=mysql_query("SELECT fk_aer_id FROM  via where via_id=$selected");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_aer_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];	
							
					    
						$result1= mysql_query("SELECT v.*, a.aer_nombre, d.des_nombre FROM  via v, aerolinea a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_aer_id=a.aer_id AND v.fk_aer_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_cru_id IS NULL AND v.fk_ter_id IS NULL");
						while($row1 = mysql_fetch_array($result1))
						{
						    $result6= mysql_query("SELECT c.cos_costo FROM  costo c WHERE c.fk_via_origen=$selected AND c.fk_via_destino=".$row1["via_id"]."");
							$row6 = mysql_fetch_array($result6);
							if ($row1["via_id"]==$selected2){
								//echo 'if';
								$select_actual1='<option selected="selected" value="'.$row1["via_id"].'">'.$row1["aer_nombre"]."/".$row1["des_nombre"]."/".$row6["cos_costo"].'</option>'; }	
							else{
								//echo "banco es $banco";
								$select_actual1='<option value="'.$row1["via_id"].'">'.$row1["aer_nombre"]."/".$row1["des_nombre"]."/".$row6["cos_costo"].'</option>'; 	}	
						$select1=$select1.$select_actual1;
						}
						$panelcuentas->add("bancos1",$select1);
						
				       
					  // echo($selected2);
					    $res3=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected2");
						$ro3 = mysql_fetch_array($res3);
						$devuelve3=$ro3['fk_des_id'];	
						//echo "$devuelve3 dev";
						
							
						$result4= mysql_query("SELECT ho.hot_nombre, ho.hot_id FROM  hotel ho WHERE ho.fk_des_id=$devuelve3");
						while($row4 = mysql_fetch_array($result4))
						{
						if ($row4["hot_id"]==$selected3){
										//echo 'if';
										$select_actual4='<option selected="selected" value="'.$row4["hot_id"].'">'.$row4["hot_nombre"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual4='<option value="'.$row4["hot_id"].'">'.$row4["hot_nombre"].'</option>'; 	}	
						$select4=$select4.$select_actual4;
						}
						$panelcuentas->add("hoteles",$select4);
						

					
					
	
					
					echo($selected3);
						$result5= mysql_query("SELECT h.hab_id, h.hab_costo, h.hab_categoria FROM  habitacion h  WHERE h.fk_hot_id=$selected3 AND h.hab_status='No ocupada'");
						while($row5 = mysql_fetch_array($result5))
						{
						$select_actual5='<option value="'.$row5["hab_id"].'">'.$row5["hab_id"].' Costo:'.$row5["hab_costo"].' Cat:'.$row5["hab_categoria"].'</option>'; 
						$select5=$select5.$select_actual5;
						}
						$panelcuentas->add("habitaciones",$select5);
						
						
						$select7='<option value="z">No deseo Servicios</option>';
						$result7= mysql_query("SELECT s.ser_nombre, s.ser_descripcion,s.ser_id,s.ser_costo FROM  servicio s, hot_ser hs WHERE hs.fk_hot_id=$selected3 AND hs.fk_ser_id=s.ser_id");
						while($row7 = mysql_fetch_array($result7))
						{
						$select_actual7='<option value="'.$row7["ser_id"].'">'.$row7["ser_nombre"].'/'.$row7["ser_descripcion"].'/'.$row7["ser_costo"].'</option>'; 
						$select7=$select7.$select_actual7;
						}
						$panelcuentas->add("servicios",$select7);
						
						
						$select8='<input type="checkbox" name="pas0" id="pas0" value="a" />Ningun paseo<br />';
						$result8= mysql_query("SELECT p.pas_nombre, p.pas_descripcion,p.pas_id,p.pas_costo FROM  paseo p, hot_pas hp WHERE hp.fk_hot_id=$selected3 AND hp.fk_pas_id=p.pas_id");
						$cont=0;
						while($row8 = mysql_fetch_array($result8))
						{
						$select_actual8='<input type="checkbox" name="pas'.($cont+1).'" id="pas'.($cont+1).'" value="'.$row8["pas_id"].'" />'.$row8["pas_nombre"].'/'.$row8["pas_descripcion"].'/'.$row8["pas_costo"].'<br />';
						$select8=$select8.$select_actual8;
						
			
						$cont=$cont+1;
						}
						$panelcuentas->add("paseos",$select8);
	
						
					   
					   
					    
						
						
						
						
						
						
						
						
						
							
						//echo "$devuelve3 dev";
						
			  
			  
			  
			  
			  }
			  
			  
			  
			  
			  
			   if ($banco && $fecha && $banco1 && $hotel && $habitacion  && $servicio  && ($pas0 || $pas1 || $pas2 || $pas3 || $pas4 || $pas5 || $pas6)&& $cantper && $tipoviaje)
			  {
			             //echo('entra6');
			  
						 $result2= mysql_query("SELECT v.*, a.aer_nombre, d.des_nombre FROM  via v, aerolinea a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_aer_id=a.aer_id AND v.fk_aer_id IS NOT NULL AND v.fk_cru_id IS NULL AND v.fk_ter_id IS NULL");
								while($row2 = mysql_fetch_array($result2))
								{				
									
									if ($row2["via_id"]==$banco){
										//echo 'if';
										$select_actual2='<option selected="selected" value="'.$row2["via_id"].'">'.$row2["aer_nombre"]."/".$row2["des_nombre"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual2='<option value="'.$row2["via_id"].'">'.$row2["aer_nombre"]."/".$row2["des_nombre"].'</option>'; 	}	
									$select2=$select2.$select_actual2;
								}
								$panelcuentas->add("bancos",$select2);
								
						
								$panelcuentas->add("fecha",$fecha);
							
								
						        $res=mysql_query("SELECT fk_aer_id FROM  via where via_id=$banco");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_aer_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$banco");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];	
							
					    
						$result1= mysql_query("SELECT v.*, a.aer_nombre, d.des_nombre FROM  via v, aerolinea a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_aer_id=a.aer_id AND v.fk_aer_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_cru_id IS NULL AND v.fk_ter_id IS NULL");
						while($row1 = mysql_fetch_array($result1))
						{
						$result6= mysql_query("SELECT c.cos_costo FROM  costo c WHERE c.fk_via_origen=$banco AND c.fk_via_destino=".$row1["via_id"]."");
							$row6 = mysql_fetch_array($result6);
						    
							if ($row1["via_id"]==$banco1){
								//echo 'if';
								$select_actual1='<option selected="selected" value="'.$row1["via_id"].'">'.$row1["aer_nombre"]."/".$row1["des_nombre"]."/".$row6["cos_costo"].'</option>'; }	
							else{
								//echo "banco es $banco";
								$select_actual1='<option value="'.$row1["via_id"].'">'.$row1["aer_nombre"]."/".$row1["des_nombre"]."/".$row6["cos_costo"].'</option>'; 	}	
						$select1=$select1.$select_actual1;
						}
						$panelcuentas->add("bancos1",$select1);
						
				       
					  // echo($selected2);
					    $res3=mysql_query("SELECT fk_des_id FROM  via where via_id=$banco1");
						$ro3 = mysql_fetch_array($res3);
						$devuelve3=$ro3['fk_des_id'];	
						//echo "$devuelve3 dev";
						
							
						$result4= mysql_query("SELECT ho.hot_nombre, ho.hot_id FROM  hotel ho WHERE ho.fk_des_id=$devuelve3");
						while($row4 = mysql_fetch_array($result4))
						{
						if ($row4["hot_id"]==$hotel){
										//echo 'if';
										$select_actual4='<option selected="selected" value="'.$row4["hot_id"].'">'.$row4["hot_nombre"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual4='<option value="'.$row4["via_id"].'">'.$row4["hot_nombre"].'</option>'; 	}	
						$select4=$select4.$select_actual4;
						}
						$panelcuentas->add("hoteles",$select4);
						
						
						//echo($selected3);
						
						$result5= mysql_query("SELECT h.hab_id, h.hab_costo, h.hab_categoria FROM  habitacion h  WHERE h.fk_hot_id=$hotel AND h.hab_status='No ocupada'");
						while($row5 = mysql_fetch_array($result5))
						{
						if ($row5["hab_id"]==$habitacion){
										//echo 'if';
										$select_actual5='<option selected="selected" value="'.$row5["hab_id"].'">'.$row5["hab_id"].' Costo:'.$row5["hab_costo"].' Cat:'.$row5["hab_categoria"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual5='<option value="'.$row5["hab_id"].'">'.$row5["hab_id"].' Costo:'.$row5["hab_costo"].' Cat:'.$row5["hab_categoria"].'</option>'; 	}	
						$select5=$select5.$select_actual5;
						}
						$panelcuentas->add("habitaciones",$select5);
						
					   
					   
					    $result7= mysql_query("SELECT s.ser_nombre, s.ser_descripcion,s.ser_id,s.ser_costo FROM  servicio s, hot_ser hs WHERE hs.fk_hot_id=$hotel AND hs.fk_ser_id=s.ser_id");
						while($row7 = mysql_fetch_array($result7))
						{
						if ($row7["ser_id"]==$servicio){
										//echo 'if';
										$select_actual7='<option selected="selected" value="'.$row7["ser_id"].'">'.$row7["ser_nombre"].'Descripcion:'.$row7["ser_descripcion"].'/'.$row7["ser_costo"].'</option>'; }	
					
						else{
										//echo "banco es $banco";
										$select_actual7='<option value="'.$row7["ser_id"].'">'.$row7["ser_nombre"].'Descripcion'.$row7["ser_descripcion"].'/'.$row7["ser_costo"].'</option>'; 	}	
						$select7=$select7.$select_actual7;
						}
						if ($servicio=="z"){
						$select7=$select7.'<option selected="selected" value="z">No deseo Servicios</option>';
						}
						else
						{$select7=$select7.'<option value="z">No deseo Servicios</option>';}
						$panelcuentas->add("servicios",$select7);
						
						
						$result8= mysql_query("SELECT p.pas_nombre, p.pas_descripcion,p.pas_id,p.pas_costo FROM  paseo p, hot_pas hp WHERE hp.fk_hot_id=$hotel AND hp.fk_pas_id=p.pas_id");
						
						$cont=0;
						while($row8 = mysql_fetch_array($result8))
				{
						if ($row8["pas_id"]==$pas1){
						echo "1";
						$select_actual8='<input type="checkbox" name="pas'.($cont+1).'" id="pas'.($cont+1).'" checked="yes" value="'.$row8["pas_id"].'" />'.$row8["pas_nombre"].'/'.$row8["pas_descripcion"].'/'.$row8["pas_costo"].'<br />';
						$select8=$select8.$select_actual8;
						}
						else if ($row8["pas_id"]==$pas2)
						{
						echo "2";
						$select_actual8='<input type="checkbox" name="pas'.($cont+1).'" id="pas'.($cont+1).'" checked="yes" value="'.$row8["pas_id"].'" />'.$row8["pas_nombre"].'/'.$row8["pas_descripcion"].'/'.$row8["pas_costo"].'<br />';
						$select8=$select8.$select_actual8;
						}
						else if ($row8["pas_id"]==$pas3)
						{
						echo "3";
						$select_actual8='<input type="checkbox" name="pas'.($cont+1).'" id="pas'.($cont+1).'" checked="yes" value="'.$row8["pas_id"].'" />'.$row8["pas_nombre"].'/'.$row8["pas_descripcion"].'/'.$row8["pas_costo"].'<br />';
						$select8=$select8.$select_actual8;
						}
						else if ($row8["pas_id"]==$pas4)
						{
						echo "4";
						$select_actual8='<input type="checkbox" name="pas'.($cont+1).'" id="pas'.($cont+1).'" checked="yes" value="'.$row8["pas_id"].'" />'.$row8["pas_nombre"].'/'.$row8["pas_descripcion"].'/'.$row8["pas_costo"].'<br />';
						$select8=$select8.$select_actual8;
						}
						else if ($row8["pas_id"]==$pas5)
						{
						echo "5";
						$select_actual8='<input type="checkbox" name="pas'.($cont+1).'" id="pas'.($cont+1).'" checked="yes" value="'.$row8["pas_id"].'" />'.$row8["pas_nombre"].'/'.$row8["pas_descripcion"].'/'.$row8["pas_costo"].'<br />';
						$select8=$select8.$select_actual8;
						}
						else if ($row8["pas_id"]==$pas6)
						{
						echo "6";
						$select_actual8='<input type="checkbox" name="pas'.($cont+1).'" id="pas'.($cont+1).'" checked="yes" value="'.$row8["pas_id"].'" />'.$row8["pas_nombre"].'/'.$row8["pas_descripcion"].'/'.$row8["pas_costo"].'<br />';
						$select8=$select8.$select_actual8;
						}
						else if ($row8["pas_id"]==$pas7)
						{
						echo "7";
						$select_actual8='<input type="checkbox" name="pas'.($cont+1).'" id="pas'.($cont+1).'" checked="yes" value="'.$row8["pas_id"].'" />'.$row8["pas_nombre"].'/'.$row8["pas_descripcion"].'/'.$row8["pas_costo"].'<br />';
						$select8=$select8.$select_actual8;
						}
						else if ($row8["pas_id"]==$pas8)
						{
						echo "9";
						$select_actual8='<input type="checkbox" name="pas'.($cont+1).'" id="pas'.($cont+1).'"checked="yes"  value="'.$row8["pas_id"].'" />'.$row8["pas_nombre"].'/'.$row8["pas_descripcion"].'/'.$row8["pas_costo"].'<br />';
						$select8=$select8.$select_actual8;
						}
						else if ($pas0)
						{
						echo "a";
						$select_actual8='<input type="checkbox" name="pas0" id="pas0"  checked= "yes" value="a" />Ningun paseo<br />';
						$select8=$select_actual8;
						}
						
						
						//$select8=$select8.$select_actual8;
						
						
			
						$cont=$cont+1;
		
						
				}
						$panelcuentas->add("paseos",$select8);
						
						
						
						
						//// Hallando el costo total del presupuesto
						
						$costo_total=0;
						
						$res5= mysql_query("SELECT c.cos_costo FROM  costo c WHERE c.fk_via_origen=$banco AND c.fk_via_destino=$banco1");
						$ro5 = mysql_fetch_array($res5);
						$costo_via=$ro5['cos_costo'];
						
						
						$res6=mysql_query("SELECT hab_costo FROM  habitacion h  where h.fk_hot_id=$hotel AND h.hab_id=$habitacion");
						$ro6 = mysql_fetch_array($res6);
						$costo_hab=$ro6['hab_costo'];
						//echo($costo_hab);
						$costo_ser=0;
						if ($servicio!="z"){
						$res7=mysql_query("SELECT ser_costo FROM  servicio s, hot_ser hs  where hs.fk_hot_id=$hotel AND hs.fk_ser_id=s.ser_id AND s.ser_id=$servicio");
						$ro7 = mysql_fetch_array($res7);
						$costo_ser=$ro7['ser_costo'];}
						//echo($costo_ser);
						$costo_pas1=0;
						$costo_pas3=0;
						$costo_pas5=0;
						$costo_pas7=0;
						$costo_pas9=0;
						
						if ($pas1){
						$res8=mysql_query("SELECT pas_costo FROM  paseo p, hot_pas hp  where hp.fk_hot_id=$hotel AND hp.fk_pas_id=p.pas_id AND p.pas_id=$pas1");
						$ro8 = mysql_fetch_array($res8);
						$costo_pas=$ro8['pas_costo'];
						
						$costo_pas1=$costo_pas*$cantper;}
						
						if ($pas2){
						$res9=mysql_query("SELECT pas_costo FROM  paseo p, hot_pas hp  where hp.fk_hot_id=$hotel AND hp.fk_pas_id=p.pas_id AND p.pas_id=$pas2");
						$ro9 = mysql_fetch_array($res9);
						$costo_pas2=$ro9['pas_costo'];
						
						$costo_pas3=$costo_pas2*$cantper;}
		
						//echo("$costo_pas3 costo paseo2" );
						
						if ($pas3){
						$res11=mysql_query("SELECT pas_costo FROM  paseo p, hot_pas hp  where hp.fk_hot_id=$hotel AND hp.fk_pas_id=p.pas_id AND p.pas_id=$pas3");
						$ro11 = mysql_fetch_array($res11);
						$costo_pas4=$ro11['pas_costo'];
						
						$costo_pas5=$costo_pas4*$cantper;}
						
						if ($pas4){
						$res12=mysql_query("SELECT pas_costo FROM  paseo p, hot_pas hp  where hp.fk_hot_id=$hotel AND hp.fk_pas_id=p.pas_id AND p.pas_id=$pas4");
						$ro12 = mysql_fetch_array($res12);
						$costo_pas6=$ro12['pas_costo'];
						
						$costo_pas7=$costo_pas6*$cantper;}
						
						if ($pas5){
						$res13=mysql_query("SELECT pas_costo FROM  paseo p, hot_pas hp  where hp.fk_hot_id=$hotel AND hp.fk_pas_id=p.pas_id AND p.pas_id=$pas5");
						$ro13 = mysql_fetch_array($res13);
						$costo_pas8=$ro13['pas_costo'];
						
						$costo_pas9=$costo_pas8*$cantper;}
						
						
						if($tipoviaje=="Ida y vuelta")
						{
						$costo_total=($costo_total+$costo_via+$costo_hab+$costo_ser+$costo_pas1+$costo_pas3+$costo_pas5+$costo_pas7+$costo_pas9)*$cantper*2;}
						else{
						$costo_total=($costo_total+$costo_via+$costo_hab+$costo_ser+$costo_pas1+$costo_pas3+$costo_pas5+$costo_pas7+$costo_pas9)*$cantper; }
						
						
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