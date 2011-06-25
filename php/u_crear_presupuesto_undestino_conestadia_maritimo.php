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

			
			$total2= (float) $total;
			//echo("entra  $total $total");
				if($servicio=="z"){
				mysql_query("INSERT INTO `presupuesto` (`pre_id`, `pre_fecha`,`pre_habitacion`,`pre_servicio`,`pre_paseo`,`pre_total`,`pre_cant_per`,`fk_per_cedula`, `fk_via_id_origen`, `fk_via_id_destino`,`pre_abono`,`pre_status`, `pre_ruta`) VALUES (NULL ,'$fecha','$habitacion',NULL,NULL, '$total2','$cantper', '$cedula',36, 36,0,'No comprado', $ruta)");}
				else
				{
				mysql_query("INSERT INTO `presupuesto` (`pre_id`, `pre_fecha`,`pre_habitacion`,`pre_servicio`,`pre_paseo`,`pre_total`,`pre_cant_per`,`fk_per_cedula`, `fk_via_id_origen`, `fk_via_id_destino`,`pre_abono`,`pre_status`, `pre_ruta`) VALUES (NULL ,'$fecha','$habitacion','$servicio',NULL, '$total2','$cantper', '$cedula',36, 36,0,'No comprado', $ruta)");
				}
			    
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
	        $result= mysql_query("SELECT c.* from crucero c");
        	while($row = mysql_fetch_array($result))
        	{
			$select_actual='<option value="'.$row["cru_id"].'">'.$row["cru_nombre"].
			'</option>'; 		
			$select=$select.$select_actual;
			}
			$panelcuentas->add("cruceros",$select);
			
			
			
			
			
			if ($crucero && $fechai && ($ruta=="k") && ($habitacion=="a"))
			  {
			  
						 $result2= mysql_query("select * from crucero");
								while($row2 = mysql_fetch_array($result2))
								{				
									
									if ($row2["cru_id"]==$crucero){
										//echo 'if';
										$select_actual2='<option selected="selected" value="'.$row2["cru_id"].'">'.$row2["cru_nombre"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual2='<option value="'.$row2["cru_id"].'">'.$row2["cru_nombre"].'</option>'; 	}	
									$select2=$select2.$select_actual2;
								}
								$panelcuentas->add("cruceros",$select2);
								
								
								$panelcuentas->add("fecha",$fechai);
								
						
						
						
						
						$result1= mysql_query("SELECT distinct r.fk_flo_id FROM ruta r WHERE fk_flo_id IN (SELECT flo_id FROM flota WHERE fk_cru_id =$crucero)");
						while($row1 = mysql_fetch_array($result1))
						{
						  $result5= mysql_query("SELECT flo_nombre from flota where flo_id=".$row1[fk_flo_id]."");
						  $row5 = mysql_fetch_array($result5);
						  $rutax=$row5["flo_nombre"]."/ "; 
						  $result4= mysql_query("SELECT r.*, d.des_nombre FROM ruta r, destino d WHERE fk_flo_id=".$row1[fk_flo_id]." and r.fk_des_id=d.des_id"); 
						$conr=0;    
						while($row4 = mysql_fetch_array($result4))
						{
						 $rutax=$rutax.$row4["des_nombre"]."-";
						 if ($conr==0){
						  $cost=$row4["rut_costo"];
						 }
						 $conr=$conr+1;
						}
						$rutax=$rutax.$cost;
						$select_actual1='<option value="'.$row1["fk_flo_id"].'">'.$rutax.'</option>'; 
						$select1=$select1.$select_actual1;
						}
						$panelcuentas->add("rutas",$select1);
						
						
			  
			  }
			  
			 
			  
			  
			  
			  
			  if ($crucero && $fechai && ($ruta!="k") && ($habitacion=="a"))
			  {
			   //echo('entra2');
						$result2= mysql_query("select * from crucero");
							while($row2 = mysql_fetch_array($result2))
							{				
								
								if ($row2["cru_id"]==$crucero){
									//echo 'if';
									$select_actual2='<option selected="selected" value="'.$row2["cru_id"].'">'.$row2["cru_nombre"].'</option>'; }	
								else{
									//echo "banco es $banco";
									$select_actual2='<option value="'.$row2["cru_id"].'">'.$row2["cru_nombre"].'</option>'; 	}	
								$select2=$select2.$select_actual2;
							}
							$panelcuentas->add("cruceros",$select2);
							$panelcuentas->add("fecha",$fechai);
							
							
							$result1= mysql_query("SELECT distinct r.fk_flo_id FROM ruta r WHERE fk_flo_id IN (SELECT flo_id FROM flota WHERE fk_cru_id =$crucero)");
						while($row1 = mysql_fetch_array($result1))
						{
						  $result5= mysql_query("SELECT flo_nombre from flota where flo_id=".$row1[fk_flo_id]."");
						  $row5 = mysql_fetch_array($result5);
						  $rutax=$row5["flo_nombre"]."/ "; 
						  $result4= mysql_query("SELECT r.*, d.des_nombre FROM ruta r, destino d WHERE fk_flo_id=".$row1[fk_flo_id]." and r.fk_des_id=d.des_id"); 
						$conr=0;    
						while($row4 = mysql_fetch_array($result4))
						{
						 $rutax=$rutax.$row4["des_nombre"]."-";
						 if ($conr==0){
						  $cost=$row4["rut_costo"];
						 }
						 $conr=$conr+1;
						}
						$rutax=$rutax.$cost;
						if ($row1["fk_flo_id"]==$ruta){
						$select_actual1='<option selected="selected" value="'.$row1["fk_flo_id"].'">'.$rutax.'</option>'; 
						}
						else
						{
						 $select_actual1='<option value="'.$row1["fk_flo_id"].'">'.$rutax.'</option>'; 
						}
						$select1=$select1.$select_actual1;
						}
						$panelcuentas->add("rutas",$select1);	
						       
						
						$result5= mysql_query("SELECT h.hab_id, h.hab_costo, h.hab_categoria FROM  habitacion h  WHERE h.fk_cru_id=$ruta AND h.hab_status='No ocupada'");
						while($row5 = mysql_fetch_array($result5))
						{
						$select_actual5='<option value="'.$row5["hab_id"].'">'.$row5["hab_id"].' Costo:'.$row5["hab_costo"].' Cat:'.$row5["hab_categoria"].'</option>'; 
						$select5=$select5.$select_actual5;
						}
						$panelcuentas->add("habitaciones",$select5);
						
						$select7='<option value="z">No deseo Servicios</option>';
						$result7= mysql_query("SELECT s.ser_nombre, s.ser_descripcion,s.ser_id,s.ser_costo FROM  servicio s, cru_ser hs WHERE hs.fk_flo_id=$ruta AND hs.fk_ser_id=s.ser_id");
						while($row7 = mysql_fetch_array($result7))
						{
						$select_actual7='<option value="'.$row7["ser_id"].'">'.$row7["ser_nombre"].'/'.$row7["ser_descripcion"].'/'.$row7["ser_costo"].'</option>'; 
						$select7=$select7.$select_actual7;
						}
						$panelcuentas->add("servicios",$select7);
						
						
			  
			  }
			  
			  
			  
			  
			   if ($crucero && $fechai && ($ruta!="k") && ($habitacion!="a") && $servicio &&$cantper && $tipoviaje)
			  {
			         
			  
						 $result2= mysql_query("select * from crucero");
							while($row2 = mysql_fetch_array($result2))
							{				
								
								if ($row2["cru_id"]==$crucero){
									//echo 'if';
									$select_actual2='<option selected="selected" value="'.$row2["cru_id"].'">'.$row2["cru_nombre"].'</option>'; }	
								else{
									//echo "banco es $banco";
									$select_actual2='<option value="'.$row2["cru_id"].'">'.$row2["cru_nombre"].'</option>'; 	}	
								$select2=$select2.$select_actual2;
							}
							$panelcuentas->add("cruceros",$select2);
							$panelcuentas->add("fecha",$fechai);
							
							
							$result1= mysql_query("SELECT distinct r.fk_flo_id FROM ruta r WHERE fk_flo_id IN (SELECT flo_id FROM flota WHERE fk_cru_id =$crucero)");
						while($row1 = mysql_fetch_array($result1))
						{
						  $result5= mysql_query("SELECT flo_nombre from flota where flo_id=".$row1[fk_flo_id]."");
						  $row5 = mysql_fetch_array($result5);
						  $rutax=$row5["flo_nombre"]."/ "; 
						  $result4= mysql_query("SELECT r.*, d.des_nombre FROM ruta r, destino d WHERE fk_flo_id=".$row1[fk_flo_id]." and r.fk_des_id=d.des_id"); 
						$conr=0;    
						while($row4 = mysql_fetch_array($result4))
						{
						 $rutax=$rutax.$row4["des_nombre"]."-";
						 if ($conr==0){
						  $cost=$row4["rut_costo"];
						 }
						 $conr=$conr+1;
						}
						$rutax=$rutax.$cost;
						if ($row1["fk_flo_id"]==$ruta){
						$select_actual1='<option selected="selected" value="'.$row1["fk_flo_id"].'">'.$rutax.'</option>'; 
						}
						else
						{
						 $select_actual1='<option value="'.$row1["fk_flo_id"].'">'.$rutax.'</option>'; 
						}
						$select1=$select1.$select_actual1;
						}
						$panelcuentas->add("rutas",$select1);
						
				       
	
						
						$result5= mysql_query("SELECT h.hab_id, h.hab_costo, h.hab_categoria FROM  habitacion h  WHERE h.fk_cru_id=$ruta AND h.hab_status='No ocupada'");
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
						
					   
					   
					    $result7= mysql_query("SELECT s.ser_nombre, s.ser_descripcion,s.ser_id,s.ser_costo FROM  servicio s, cru_ser hs WHERE hs.fk_flo_id=$ruta AND hs.fk_ser_id=s.ser_id");
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
						

						
						$costo_total=0;
						
						$result9= mysql_query("SELECT r.* FROM ruta r WHERE fk_flo_id=$ruta"); 
						$ro9 = mysql_fetch_array($result9);
						$costo_via=$ro9["rut_costo"];
						
						
						$res6=mysql_query("SELECT hab_costo FROM  habitacion h  where h.fk_cru_id=$ruta AND h.hab_id=$habitacion");
						$ro6 = mysql_fetch_array($res6);
						$costo_hab=$ro6['hab_costo'];
						$costo_ser=0;
						if ($servicio!="z"){
						$res7=mysql_query("SELECT ser_costo FROM  servicio s, cru_ser cs  where cs.fk_flo_id=$ruta AND cs.fk_ser_id=s.ser_id AND s.ser_id=$servicio");
						$ro7 = mysql_fetch_array($res7);
						$costo_ser=$ro7['ser_costo'];}
				
				//echo ("$costo_total, $costo_via, $costo_hab, $costo_ser");
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