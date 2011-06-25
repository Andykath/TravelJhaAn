<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
   $cedula=$_SESSION['cedula'];
   
    //$total=$_SESSION[$total];
	extract($_POST);
	extract($_GET);
	      
		  if($fecha)
		  {
		  	//echo "id".$id;
	//echo "pre_fecha".$fecha; echo  "pre_habitacion".$habitacion."pre_servicio".$servicio."pre_total".$total."pre_cant_per".$cantper."fk_via_id_origen".$banco."fk_via_id_destino".$banco1;
			$total2= (float) $total;
			if($habitacion=='Seleccione'){
			mysql_query("UPDATE `presupuesto` SET  `pre_fecha`= '$fecha', `pre_habitacion`=NULL, `pre_servicio`='$servicio', `pre_total`= '$total',`pre_cant_per`='$cantper', `fk_via_id_origen`='$banco', `fk_via_id_destino`='$banco1',  `pre_abono`=0, `pre_status`='No comprado' where pre_id='$id'") or die (mysql_error());
			    
				$hola='a_presupuesto_crucero.php?mensaje=2';
				header("Location:$hola");
			}
			else if ($servicio=='Seleccione'){
				mysql_query("UPDATE `presupuesto` SET  `pre_fecha`= '$fecha', `pre_habitacion`='$habitacion', `pre_servicio`=NULL,  `pre_total`= '$total',`pre_cant_per`='$cantper', `fk_via_id_origen`='$banco', `fk_via_id_destino`='$banco1',  `pre_abono`=0, `pre_status`='No comprado' where pre_id='$id'") or die (mysql_error());
				$hola='a_presupuesto_crucero.php?mensaje=2';
				header("Location:$hola");
			}
			else if ($habitacion=='Seleccione' && $servicio=='Seleccione'){
				
			 	  mysql_query("UPDATE `presupuesto` SET  `pre_fecha`= '$fecha', `pre_habitacion`=NULL, `pre_servicio`=NULL, `pre_total`= '$total',`pre_cant_per`='$cantper', `fk_via_id_origen`='$banco', `fk_via_id_destino`='$banco1',  `pre_abono`=0, `pre_status`='No comprado' where pre_id='$id'") or die (mysql_error());
				$hola='a_presupuesto_crucero.php?mensaje=2';
				header("Location:$hola");
			}
			else {
				 mysql_query("UPDATE `presupuesto` SET  `pre_fecha`= '$fecha', `pre_habitacion`='$habitacion', `pre_servicio`='$servicio', `pre_total`= '$total',`pre_cant_per`='$cantper', `fk_via_id_origen`='$banco', `fk_via_id_destino`='$banco1',  `pre_abono`=0, `pre_status`='No comprado' where pre_id='$id'") or die (mysql_error());
				$hola='a_presupuesto_crucero.php?mensaje=2';
				header("Location:$hola");
				
				}
		  }
	      else
		  {
			
			$admin= new Panel("../html/admin.html");
			$admin->add("body",'<body onLoad = "actual(13)" >');
			$panelcuentas = new Panel("../html/a_editar_presupuesto_crucero.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/a_editar_presupuesto_crucero.php?">');
			 $panelcuentas->add("Aqui",'<a href="../php/a_presupuesto_crucero.php">Volver<<</a>');
			$panelcuentas->add("fecha",$descripcion);
			$panelcuentas->add("id",$id);
		
			 if ($mensaje==1)
			 {
				 echo "entra";
	        $select='';
	        $result= mysql_query("SELECT v.*, a.cru_nombre, d.des_nombre FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id IS NOT NULL AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL");
        	while($row = mysql_fetch_array($result))
        	{
				if ($row["via_id"]==$via)
				{
					$select_actual='<option selected="selected" value="'.$row["via_id"].'">'.$row["cru_nombre"]."/".$row["des_nombre"].'</option>'; 	
				}
				else
				{
					$select_actual='<option value="'.$row["via_id"].'">'.$row["cru_nombre"]."/".$row["des_nombre"].'</option>'; 
				}		
			$select=$select.$select_actual;
			}
			$panelcuentas->add("bancos",$select);
			
			 $res=mysql_query("SELECT fk_cru_id FROM  via where via_id=$via");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_cru_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$via");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];		
					    
						$result1= mysql_query("SELECT v.*, a.cru_nombre, a.cru_id, d.des_nombre FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL")or die (mysql_error());
						while($row1 = mysql_fetch_array($result1))
						{
							if ($row1["via_id"]==$destino)
							{
							$select_actual1='<option selected="selected" value="'.$row1["via_id"].".".$row1["cru_id"].'">'.$row1["cru_nombre"]."/".$row1["des_nombre"].'</option>'; 
							}
							else
							{
								
							$select_actual1='<option value="'.$row1["via_id"].".".$row1["cru_id"].'">'.$row1["cru_nombre"]."/".$row1["des_nombre"].'</option>'; 	
							}
						$select1=$select1.$select_actual1;
						}
						$panelcuentas->add("bancos1",$select1);
						
						
						$res3=mysql_query("SELECT fk_des_id FROM  via where via_id=$destino");
						$ro3 = mysql_fetch_array($res3);
						$devuelve3=$ro3['fk_des_id'];	
						echo "select".$selected;		
						
						
						//$via_id=substr($selected2,0,1);
						//$cru_id=substr($selected2,2,3);
						/*$partes = explode(".",$selected2);
						$via_id=$partes[0];
						$cru_id=$partes[1];
						echo "crucero".$cru_id;*/
						$result5='';
						$result5= mysql_query("SELECT h.hab_id, h.hab_costo FROM  habitacion h  WHERE h.fk_cru_id='$hotel' and h.hab_tipo='Crucero'") or die ('aqui'.mysql_error());
						
						while($row5 = mysql_fetch_array($result5))
						{
							if ($row5["hab_id"]==$habitacion)
							{
								$select_actual5='<option selected="selected" value="'.$row5["hab_id"].'">'.$row5["hab_id"].' Costo:'.$row5["hab_costo"].'</option>'; 
							}
							else
							{
								$select_actual5='<option value="'.$row5["hab_id"].'">'.$row5["hab_id"].' Costo:'.$row5["hab_costo"].'</option>'; 
							}
						$select5=$select5.$select_actual5;
						}
						$panelcuentas->add("habitaciones",$select5);
						$panelcuentas->add("totaltodo",$total);
						//aqui esta lo del la floa en en cru_ser Cambiar la base de datos
						$result7= mysql_query("SELECT s.ser_nombre, s.ser_descripcion,s.ser_id,s.ser_costo FROM  servicio s, cru_ser hs WHERE hs.fk_flo_id='$hotel' AND hs.fk_ser_id=s.ser_id") or die ('malo'.mysql_error());
						while($row7 = mysql_fetch_array($result7))
						{
							if ($row7["ser_id"]==$servicio)
							{
								$select_actual7='<option selected="selected" value="'.$row7["ser_id"].'">'.$row7["ser_nombre"].'/'.$row7["ser_descripcion"].'/'.$row7["ser_costo"].'</option>'; 
							}
							else
							{
								$select_actual7='<option value="'.$row7["ser_id"].'">'.$row7["ser_nombre"].'/'.$row7["ser_descripcion"].'/'.$row7["ser_costo"].'</option>'; 
							}
						$select7=$select7.$select_actual7;
						}
						$panelcuentas->add("servicios",$select7);
						
						
			 }
			 else
			 {
			
			if ($selected && $fechai && ($selected2=="k") && ($selected3=="a") && $id)
			  {
				 echo "cambio selected";
				$panelcuentas->add("id",$id);
				//echo "id".$id;
						 $result2= mysql_query("SELECT v.*, a.cru_nombre, d.des_nombre FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id IS NOT NULL AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL");
								while($row2 = mysql_fetch_array($result2))
								{				
									
									if ($row2["via_id"]==$selected){
										$select_actual2='<option selected="selected" value="'.$row2["via_id"].'">'.$row2["cru_nombre"]."/".$row2["des_nombre"].'</option>'; }	
									else{
										
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
					    
						$result1= mysql_query("SELECT v.*, a.cru_nombre, a.cru_id, d.des_nombre FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL")or die ('maloo'.mysql_error());
						while($row1 = mysql_fetch_array($result1))
						{
							
						$select_actual1='<option value="'.$row1["via_id"].".".$row1["cru_id"].'">'.$row1["cru_nombre"]."/".$row1["des_nombre"].'</option>'; 
						$select1=$select1.$select_actual1;
						}
						$panelcuentas->add("bancos1",$select1);			  
			  }
			  
			  
			  if ($selected && $fechai && ($selected2!="k") && ($selected3=="a") && $id)
			  {
			   echo('entra selected2');
			   $panelcuentas->add("id",$id);
			   //echo "id".$id;

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
					    
						$result1= mysql_query("SELECT v.*, a.cru_nombre, a.cru_id, d.des_nombre, a.cru_id FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL");
						$partes = explode(".",$selected2);
						$via_id=$partes[0];
						$cru_id=$partes[1];
						echo "cru_id".$cru_id;
						while($row1 = mysql_fetch_array($result1))
						{
						    
							if ($row1["via_id"]==$via_id){
								//echo 'if';
								$select_actual1='<option selected="selected" value="'.$row1["via_id"].".".$row1["cru_id"].'">'.$row1["cru_nombre"]."/".$row1["des_nombre"].'</option>'; }	
							else{
								//echo "banco es $banco";
								$select_actual1='<option value="'.$row1["via_id"].".".$row1["cru_id"].'">'.$row1["cru_nombre"]."/".$row1["des_nombre"].'</option>'; 	}	
						$select1=$select1.$select_actual1;
						}
						$panelcuentas->add("bancos1",$select1);
						
							
				       
					  // echo($selected2);
					   $res3=mysql_query("SELECT fk_des_id FROM  via where via_id=$via_id");
						$ro3 = mysql_fetch_array($res3);
						$devuelve3=$ro3['fk_des_id'];	
						//echo "$devuelve3 dev";
						$result5='';
						$result5= mysql_query("SELECT h.hab_id, h.hab_costo FROM  habitacion h  WHERE h.fk_cru_id='$cru_id' and h.hab_tipo='Crucero'") or die ('aqui'.mysql_error());
						
						while($row5 = mysql_fetch_array($result5))
						{
							if ($row5["hab_id"]==$habitacion)
							{
								$select_actual5='<option selected="selected" value="'.$row5["hab_id"].'">'.$row5["hab_id"].' Costo:'.$row5["hab_costo"].'</option>'; 
							}
							else
							{
								$select_actual5='<option value="'.$row5["hab_id"].'">'.$row5["hab_id"].' Costo:'.$row5["hab_costo"].'</option>'; 
							}
						$select5=$select5.$select_actual5;
						}
						$panelcuentas->add("habitaciones",$select5);
	
					
						$result7= mysql_query("SELECT s.ser_nombre, s.ser_descripcion,s.ser_id,s.ser_costo FROM  servicio s, cru_ser hs WHERE hs.fk_flo_id=$cru_id AND hs.fk_ser_id=s.ser_id") or die (mysql_error());
						while($row7 = mysql_fetch_array($result7))
						{
							//echo "selected 4".$selected4;
							if ($row7["ser_id"]==$selected5)
							{
								$select_actual7='<option selected="selected" value="'.$row7["ser_id"].'">'.$row7["ser_nombre"].'/'.$row7["ser_descripcion"].'/'.$row7["ser_costo"].'</option>'; 
							}
							else
							{
						$select_actual7='<option value="'.$row7["ser_id"].'">'.$row7["ser_nombre"].'/'.$row7["ser_descripcion"].'/'.$row7["ser_costo"].'</option>';
							}
						$select7=$select7.$select_actual7;
						}
						$panelcuentas->add("servicios",$select7);
						
			  }
			  
			  if ($selected && $fechai && ($selected2!="k") && ($selected3!="a") && $id )
			  {
			   echo('entra3');
			   $panelcuentas->add("id",$id);
			  // echo "id".$id;
				
						
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
					    
						$result1= mysql_query("SELECT v.*, a.cru_nombre, d.des_nombre, a.cru_id FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL");
						$partes = explode(".",$selected2);
						$via_id=$partes[0];
						$cru_id=$partes[1];
						echo "cru_id".$cru_id;
						while($row1 = mysql_fetch_array($result1))
						{
						    
							if ($row1["via_id"]==$via_id){
								//echo 'if';
								$select_actual1='<option selected="selected" value="'.$row1["via_id"].".".$row1["cru_id"].'">'.$row1["cru_nombre"]."/".$row1["des_nombre"].'</option>'; }	
							else{
								//echo "banco es $banco";
								$select_actual1='<option value="'.$row1["via_id"].".".$row1["cru_id"].'">'.$row1["cru_nombre"]."/".$row1["des_nombre"].'</option>'; 	}	
						$select1=$select1.$select_actual1;
						}
						$panelcuentas->add("bancos1",$select1);
						
							
				       
					  // echo($selected2);
					   $res3=mysql_query("SELECT fk_des_id FROM  via where via_id=$via_id");
						$ro3 = mysql_fetch_array($res3);
						$devuelve3=$ro3['fk_des_id'];	
						//echo "$devuelve3 dev";
						
						/*$partes = explode(".",$selected2);
						$via_id=$partes[0];
						$cru_id=$partes[1];*/
						//echo "crucero".$cru_id;
						$result5='';
						$result5= mysql_query("SELECT h.hab_id, h.hab_costo FROM  habitacion h  WHERE h.fk_cru_id='$cru_id' and h.hab_tipo='Crucero'") or die ('aqui'.mysql_error());
						
						while($row5 = mysql_fetch_array($result5))
						{
							if ($row5["hab_id"]==$habitacion)
							{
								$select_actual5='<option selected="selected" value="'.$row5["hab_id"].'">'.$row5["hab_id"].' Costo:'.$row5["hab_costo"].'</option>'; 
							}
							else
							{
								$select_actual5='<option value="'.$row5["hab_id"].'">'.$row5["hab_id"].' Costo:'.$row5["hab_costo"].'</option>'; 
							}
						$select5=$select5.$select_actual5;
						}
						$panelcuentas->add("habitaciones",$select5);
	
					echo "selected 4 ".$select4." -";
						$result7= mysql_query("SELECT s.ser_nombre, s.ser_descripcion,s.ser_id,s.ser_costo FROM  servicio s, cru_ser hs WHERE hs.fk_flo_id=$cru_id AND hs.fk_ser_id=s.ser_id");
						while($row7 = mysql_fetch_array($result7))
						{
							
							if ($row7["ser_id"]==$selected5)
							{
								$select_actual7='<option selected="selected" value="'.$row7["ser_id"].'">'.$row7["ser_nombre"].'/'.$row7["ser_descripcion"].'/'.$row7["ser_costo"].'</option>'; 
							}
							else
							{
						$select_actual7='<option value="'.$row7["ser_id"].'">'.$row7["ser_nombre"].'/'.$row7["ser_descripcion"].'/'.$row7["ser_costo"].'</option>';
							}
						$select7=$select7.$select_actual7;
						}
						$panelcuentas->add("servicios",$select7);
							
					
			  
			  }
			  echo $selected.$fechai.$selected2.$selected3."habitacion".$selected4."servicio ".$selected5.$cantper."tipo de viaje: ".$tipoviaje." ".$id;
			   if ($selected && $fechai && ($selected2!="k") && $selected4  && $selected5 && $cantper && $tipoviaje && $id)
			  {
			          echo('entra6');
			  			$panelcuentas->add("id",$id);
			   			//echo "id".$id;

						
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
					    
						$result1= mysql_query("SELECT v.*, a.cru_nombre, d.des_nombre, a.cru_id FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL");
						$partes = explode(".",$selected2);
						$via_id=$partes[0];
						$cru_id=$partes[1];
						while($row1 = mysql_fetch_array($result1))
						{
						    
							if ($row1["via_id"]==$via_id){
								//echo 'if';
								$select_actual1='<option selected="selected" value="'.$row1["via_id"].".".$row1["cru_id"].'">'.$row1["cru_nombre"]."/".$row1["des_nombre"].'</option>'; }	
							else{
								//echo "banco es $banco";
								$select_actual1='<option value="'.$row1["via_id"].".".$row1["cru_id"].'">'.$row1["cru_nombre"]."/".$row1["des_nombre"].'</option>'; 	}	
						$select1=$select1.$select_actual1;
						}
						$panelcuentas->add("bancos1",$select1);
						
							
				       
					  // echo($selected2);
					   $res3=mysql_query("SELECT fk_des_id FROM  via where via_id=$via_id");
						$ro3 = mysql_fetch_array($res3);
						$devuelve3=$ro3['fk_des_id'];	
						//echo "$devuelve3 dev";
						
						/*$partes = explode(".",$selected2);
						$via_id=$partes[0];
						$cru_id=$partes[1];*/
						echo "crucero".$cru_id;
						$result5='';
						$result5= mysql_query("SELECT h.hab_id, h.hab_costo FROM  habitacion h  WHERE h.fk_cru_id='$cru_id' and h.hab_tipo='Crucero'") or die ('aqui'.mysql_error());
						
						while($row5 = mysql_fetch_array($result5))
						{
							if ($row5["hab_id"]==$selected4)
							{
								$select_actual5='<option selected="selected" value="'.$row5["hab_id"].'">'.$row5["hab_id"].' Costo:'.$row5["hab_costo"].'</option>'; 
							}
							else
							{
								$select_actual5='<option value="'.$row5["hab_id"].'">'.$row5["hab_id"].' Costo:'.$row5["hab_costo"].'</option>'; 
							}
						$select5=$select5.$select_actual5;
						}
						$panelcuentas->add("habitaciones",$select5);
	
					
						$result7= mysql_query("SELECT s.ser_nombre, s.ser_descripcion,s.ser_id,s.ser_costo FROM  servicio s, cru_ser hs WHERE hs.fk_flo_id=$cru_id AND hs.fk_ser_id=s.ser_id");
						while($row7 = mysql_fetch_array($result7))
						{
							
							if ($row7["ser_id"]==$selected5)
							{
								$select_actual7='<option selected="selected" value="'.$row7["ser_id"].'">'.$row7["ser_nombre"].'/'.$row7["ser_descripcion"].'/'.$row7["ser_costo"].'</option>'; 
							}
							else
							{
						$select_actual7='<option value="'.$row7["ser_id"].'">'.$row7["ser_nombre"].'/'.$row7["ser_descripcion"].'/'.$row7["ser_costo"].'</option>';
							}
						$select7=$select7.$select_actual7;
						}
						$panelcuentas->add("servicios",$select7);
						//// Hallando el costo total del presupuesto
						
						$costo_total=0;
						
						$res5=mysql_query("SELECT via_costo FROM  via where via_id=$via_id");
						$ro5 = mysql_fetch_array($res5);
						$costo_via=$ro5['via_costo'];
						//echo($costo_via);
						//echo "select".$selected4;
						if ($selected4<>'Seleccione')
						{$res6=mysql_query("SELECT hab_costo FROM  habitacion h  where h.fk_cru_id=$cru_id AND h.hab_id=$selected4");
						$ro6 = mysql_fetch_array($res6);
						$costo_hab=$ro6['hab_costo'];}
						else
						$costo_hab=0;
						//echo($costo_hab);
						if ($selected5<>'Seleccione'){
						$res7=mysql_query("SELECT ser_costo FROM  servicio s, hot_ser hs  where hs.fk_hot_id=$cru_id AND hs.fk_ser_id=s.ser_id AND s.ser_id=$selected5");
						$ro7 = mysql_fetch_array($res7);
						$costo_ser=$ro7['ser_costo'];}
						else
						$costo_ser=0;
						//echo($costo_ser);
						
						
						if($tipoviaje=="Ida y vuelta")
						{
						$costo_total=($costo_total+$costo_via+$costo_hab+$costo_ser)*$cantper;
						$costo_total=$costo_total*2;
						echo "cos".$costo_total;
						}
						else{
						$costo_total=($costo_total+$costo_via+$costo_hab+$costo_ser)*$cantper; 
						echo "costo".$costo_total;
						}
						
						
						//echo($costo_total);
						$panelcuentas->add("totaltodo",$costo_total);
						
			  }
			  
			  
			 }
			  
			

			
			
			
			
			
			$panelcuentas->add("tipo_boton",'Aceptar');
	        $admin->add("contenido",$panelcuentas);
	        $admin->show();
			
			
		   }
			
		  
	include "../db/cerrar_conexion.php";
?>