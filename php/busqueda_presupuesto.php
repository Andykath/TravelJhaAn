<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
   $cedula=$_SESSION['cedula'];
   
    //$total=$_SESSION[$total];
	extract($_POST);
	extract($_GET);
	      
		  if($banco)
		  {
			  $panel = new Panel("../html/muestra_busqueda.html");
			//echo "pais origen ".$banco;
			//echo " ciudad origen ".$banco1;
			//echo " ciudad destino ".$habitacion;
			//echo "  Trans".$servicio;
			//echo "otro".$otro;
			if ($otro=='checkbox')
			$costo=1;
			else
			$costo=2;
			//echo "cos".$costo;
			$id=substr($servicio,0,1);
			$tip=substr($servicio,1,2);
			$result= mysql_query("Select  v.via_id, count(*), e.via_id as viaje from via v, via i, viaje e where e.fk_via_id_origen=v.via_id and e.fk_via_id_destino=i.via_id and v.fk_des_id='$banco1' and e.via_fecha_ini='$fecha' and e.via_fecha_fin='$fecha2' and i.fk_des_id='$habitacion' group by  v.via_id, e.via_id");
			$row = mysql_fetch_row($result);
			//echo "cantidad de viajes".$row[1];
			if ($row[1]==0)
			{
				if ($tip=='t')
			{
	
			$result= mysql_query("SELECT v.via_costo, v.via_terminal, a.ter_nombre, d.des_nombre as ciudad, o.des_nombre as pais  from via v, destino d, terrestre a, destino o where d.fk_des_id=o.des_id and a.ter_id='$id' and d.des_id='$habitacion' and v.fk_des_id=d.des_id and v.fk_ter_id=a.ter_id",$conexion) or die (mysql_error());
			$cant=mysql_num_rows($result);
			if ($cant==0)
			{ echo "entro aqui";
				$panel->add("error","En esta momento no esta disponible ese viaje");
			} 
			else
			{
				$res= mysql_query("SELECT d.des_nombre as ciudad, o.des_nombre as pais  from  destino d, destino o where d.fk_des_id=o.des_id and d.des_id='$banco1'",$conexion) or die (mysql_error());
			$row2=mysql_fetch_array($res);
				while($row = mysql_fetch_array($result))
				{
	$precio=$row["via_costo"]*$costo*$cantper;
	$tabla='
    <tr align="center">
      <td width="110">'.$row2["ciudad"].", ".$row2["pais"].'</td>
	  <td width="119"><div align="center">'.$row["ciudad"].", ".$row["pais"].'</td>
	  <td width="117"><div align="center">'.$row["ter_nombre"].'</td>
      <td width="74"><div align="center">'.$precio.'</td>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	$panel->add("informacion",$tabla_completa);
	}
	}
	else if ($tip=='c')
	{
	$result= mysql_query("SELECT v.via_costo, v.via_terminal, a.cru_nombre, d.des_nombre as ciudad, o.des_nombre as pais  from via v, destino d, crucero a, destino o where d.fk_des_id=o.des_id and a.cru_id='$id' and d.des_id='$habitacion' and v.fk_des_id=d.des_id and v.fk_cru_id=a.cru_id",$conexion) or die (mysql_error());
	$cant=mysql_num_rows($result);
	if ($cant==0)
	{
		$panel->add("error","En esta momento no esta disponible ese viaje");
	} 
	else
	{
		$res= mysql_query("SELECT d.des_nombre as ciudad, o.des_nombre as pais  from  destino d, destino o where d.fk_des_id=o.des_id and d.des_id='$banco1'",$conexion) or die (mysql_error());
			$row2=mysql_fetch_array($res);
	while($row = mysql_fetch_array($result))
	{
	$precio=$row["via_costo"]*$costo*$cantper;
	$tabla='
    <tr align="center">
      <td width="110">'.$row2["ciudad"].", ".$row2["pais"].'</td>
	  <td width="119"><div align="center">'.$row["ciudad"].", ".$row["pais"].'</td>
	  <td width="117"><div align="center">'.$row["cru_nombre"].'</td>
      <td width="74"><div align="center">'.$precio.'</td>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	$panel->add("informacion",$tabla_completa);
	}
	}
	else 
	{//echo "aero";
	$result= mysql_query("SELECT v.via_costo, v.via_terminal, a.aer_nombre, d.des_nombre as ciudad, o.des_nombre as pais  from via v, destino d, aerolinea a, destino o where d.fk_des_id=o.des_id and a.aer_id='$id' and d.des_id='$habitacion' and v.fk_des_id=d.des_id and v.fk_aer_id=a.aer_id",$conexion) or die (mysql_error());
	$cant=mysql_num_rows($result);
	if ($cant==0)
	{
		$panel->add("error","En esta momento no esta disponible ese viaje");
	} 
	else
	{
		/*$res= mysql_query("SELECT d.des_nombre as ciudad, o.des_nombre as pais  from  destino d, destino o where d.fk_des_id=o.des_id and d.des_id='$banco1'");
			$row2=mysql_fetch_array($res);*/
	while($row=mysql_fetch_array($result))
	{
		$precio=$row["via_costo"]*$costo*$cantper;
	$tabla='
    <tr align="center">
      <td width="110">'.$row2["ciudad"].", ".$row2["pais"].'</td>
	  <td width="119"><div align="center">'.$row["ciudad"].", ".$row["pais"].'</td>
	  <td width="117"><div align="center">'.$row["aer_nombre"].'</td>
      <td width="74"><div align="center">'.$precio.'</td>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	mysql_free_result($result);
	$panel->add("informacion",$tabla_completa);
	}
	}
	}
			}//termnina las vias
			else
			{
			//echo "encontre el viaje";	
			$result= mysql_query("Select  v.via_id, count(*), e.via_id as viaje from via v, via i, viaje e where e.fk_via_id_origen=v.via_id and e.fk_via_id_destino=i.via_id and v.fk_des_id='$banco1' and e.via_fecha_ini='$fecha' and e.via_fecha_fin='$fecha2' and i.fk_des_id='$habitacion' group by  v.via_id, e.via_id");
				while($row = mysql_fetch_array($result))
				{
				
					$id_via=$row[0];
					$viaje=$row[2];
					//echo "viaje".$viaje;
					if ($tip=='t')
					{
						
						//echo"ter";
						$trans= mysql_query("SELECT fk_ter_id from via where via_id='id_via'");
						$res=mysql_fetch_array($trans);
						//echo "res ".$res["fk_aer_id"];
						if ($res["fk_ter_id"]=$id)
						{
							//echo "viaje ".$viaje;
							
									$query2=mysql_query("Select f.flo_actual from viaje v, flota f where v.fk_flo_id=f.flo_id and v.via_id='$viaje'");
									$respuesta2=mysql_fetch_array($query2);
									{
										//echo "res ".$respuesta2["flo_actual"];
										//echo "cant ".$cantper;
										if ($respuesta2["flo_actual"]<$cantper)
										{
											$panel->add("error","No existe disponibilidad para este viaje con este medio de transporte");
										}
										else
										{
												$result= mysql_query("SELECT v.via_costo, v.via_terminal, a.ter_nombre, d.des_nombre as ciudad, o.des_nombre as pais  from via v, destino d, terrestre a, destino o where d.fk_des_id=o.des_id and a.ter_id='$id' and d.des_id='$habitacion' and v.fk_des_id=d.des_id and v.fk_ter_id=a.ter_id",$conexion) or die (mysql_error());
												$cant=mysql_num_rows($result);
												if ($cant==0)
												{
													$panel->add("error","En esta momento no esta disponible ese viaje");
												} 
												else
												{
													$res= mysql_query("SELECT d.des_nombre as ciudad, o.des_nombre as pais  from  destino d, destino o where d.fk_des_id=o.des_id and d.des_id='$banco1'",$conexion) or die (mysql_error());
												$row2=mysql_fetch_array($res);
													while($row = mysql_fetch_array($result))
													{
														$precio=$row["via_costo"]*$costo*$cantper;
										$tabla='
										<tr align="center">
										  <td width="110">'.$row2["ciudad"].", ".$row2["pais"].'</td>
										  <td width="119"><div align="center">'.$row["ciudad"].", ".$row["pais"].'</td>
										  <td width="117"><div align="center">'.$row["ter_nombre"].'</td>
										  <td width="74"><div align="center">'.$precio.'</td>
										</tr>';
											$tabla_completa= $tabla_completa.$tabla;
										
										}
										
										mysql_free_result($result);
										$panel->add("informacion",$tabla_completa);
										}
											
										}
									}
								}
								
						else
						{
										$result= mysql_query("SELECT v.via_costo, v.via_terminal, a.ter_nombre, d.des_nombre as ciudad, o.des_nombre as pais  from via v, destino d, terrestre a, destino o where d.fk_des_id=o.des_id and a.ter_id='$id' and d.des_id='$habitacion' and v.fk_des_id=d.des_id and v.fk_ter_id=a.ter_id",$conexion) or die (mysql_error());
										$cant=mysql_num_rows($result);
										if ($cant==0)
										{
											$panel->add("error","En esta momento no esta disponible ese viaje");
										} 
										else
										{
											$res= mysql_query("SELECT d.des_nombre as ciudad, o.des_nombre as pais  from  destino d, destino o where d.fk_des_id=o.des_id and d.des_id='$banco1'",$conexion) or die (mysql_error());
										$row2=mysql_fetch_array($res);
											while($row = mysql_fetch_array($result))
											{
												$precio=$row["via_costo"]*$costo*$cantper;
								$tabla='
								<tr align="center">
								  <td width="110">'.$row2["ciudad"].", ".$row2["pais"].'</td>
								  <td width="119"><div align="center">'.$row["ciudad"].", ".$row["pais"].'</td>
								  <td width="117"><div align="center">'.$row["ter_nombre"].'</td>
								  <td width="74"><div align="center">'.$precio.'</td>
								</tr>';
									$tabla_completa= $tabla_completa.$tabla;
								
								}
								
								mysql_free_result($result);
								$panel->add("informacion",$tabla_completa);
								}
						}
					
					
					}
					else if ($tip=='c')
					{
						//echo"cru";
						$trans= mysql_query("SELECT fk_cru_id from via where via_id='id_via'");
						$res=mysql_fetch_array($trans);
						//echo "res ".$res["fk_aer_id"];
						if ($res["fk_cru_id"]=$id)
						{
							//echo "vaije ".$viaje;
							
									$query2=mysql_query("Select f.flo_actual from viaje v, flota f where v.fk_flo_id=f.flo_id and v.via_id='$viaje'");
									$respuesta2=mysql_fetch_array($query2);
									{
										//echo "res ".$respuesta2["flo_actual"];
										//echo "cant ".$cantper;
										if ($respuesta2["flo_actual"]>$cantper)
										{
											$panel->add("error","No existe disponibilidad para este viaje con este medio de transporte");
										}
										else
										{
													$result= mysql_query("SELECT v.via_costo, v.via_terminal, a.cru_nombre, d.des_nombre as ciudad, o.des_nombre as pais  from via v, destino d, crucero a, destino o where d.fk_des_id=o.des_id and a.cru_id='$id' and d.des_id='$habitacion' and v.fk_des_id=d.des_id and v.fk_cru_id=a.cru_id",$conexion) or die (mysql_error());
													$cant=mysql_num_rows($result);
													if ($cant==0)
													{
														$panel->add("error","En esta momento no esta disponible ese viaje");
													} 
													else
													{
														$res= mysql_query("SELECT d.des_nombre as ciudad, o.des_nombre as pais  from  destino d, destino o where d.fk_des_id=o.des_id and d.des_id='$banco1'",$conexion) or die (mysql_error());
															$row2=mysql_fetch_array($res);
													while($row = mysql_fetch_array($result))
													{
													$precio=$row["via_costo"]*$costo*$cantper;
													$tabla='
													<tr align="center">
													  <td width="110">'.$row2["ciudad"].", ".$row2["pais"].'</td>
													  <td width="119"><div align="center">'.$row["ciudad"].", ".$row["pais"].'</td>
													  <td width="117"><div align="center">'.$row["cru_nombre"].'</td>
													  <td width="74"><div align="center">'.$precio.'</td>
													</tr>';
														$tabla_completa= $tabla_completa.$tabla;
													
													}
													
													mysql_free_result($result);
													$panel->add("informacion",$tabla_completa);
													}
											
										}
									}
								}
								else
						{
						$result= mysql_query("SELECT v.via_costo, v.via_terminal, a.cru_nombre, d.des_nombre as ciudad, o.des_nombre as pais  from via v, destino d, crucero a, destino o where d.fk_des_id=o.des_id and a.cru_id='$id' and d.des_id='$habitacion' and v.fk_des_id=d.des_id and v.fk_cru_id=a.cru_id",$conexion) or die (mysql_error());
													$cant=mysql_num_rows($result);
													if ($cant==0)
													{
														$panel->add("error","En esta momento no esta disponible ese viaje");
													} 
													else
													{
														$res= mysql_query("SELECT d.des_nombre as ciudad, o.des_nombre as pais  from  destino d, destino o where d.fk_des_id=o.des_id and d.des_id='$banco1'",$conexion) or die (mysql_error());
															$row2=mysql_fetch_array($res);
													while($row = mysql_fetch_array($result))
													{
													$precio=$row["via_costo"]*$costo*$cantper;
													$tabla='
													<tr align="center">
													  <td width="110">'.$row2["ciudad"].", ".$row2["pais"].'</td>
													  <td width="119"><div align="center">'.$row["ciudad"].", ".$row["pais"].'</td>
													  <td width="117"><div align="center">'.$row["cru_nombre"].'</td>
													  <td width="74"><div align="center">'.$precio.'</td>
													</tr>';
														$tabla_completa= $tabla_completa.$tabla;
													
													}
													
													mysql_free_result($result);
													$panel->add("informacion",$tabla_completa);
										
											}
						}
					
					}
					else  
					{
						//echo"aero";
						$trans= mysql_query("SELECT fk_aer_id from via where via_id='id_via'");
						$res=mysql_fetch_array($trans);
						//echo "res ".$res["fk_aer_id"];
						if ($res["fk_aer_id"]=$id)
						{
							//echo "vaije ".$viaje;
									$query2=mysql_query("Select f.flo_actual from viaje v, flota f where v.fk_flo_id=f.flo_id and v.via_id='$viaje'");
									$respuesta2=mysql_fetch_array($query2);
									{
										//echo "res ".$respuesta2["flo_actual"];
										//echo "cant ".$cantper;
										if ($respuesta2["flo_actual"]<$cantper)
										{
											$panel->add("error","No existe disponibilidad para este viaje con este medio de transporte");
										}
										else
										{
											$result= mysql_query("SELECT v.via_costo, v.via_terminal, a.aer_nombre, d.des_nombre as ciudad, o.des_nombre as pais  from via v, destino d, aerolinea a, destino o where d.fk_des_id=o.des_id and a.aer_id='$id' and d.des_id='$habitacion' and v.fk_des_id=d.des_id and v.fk_aer_id=a.aer_id",$conexion) or die (mysql_error());
											$cant=mysql_num_rows($result);
											if ($cant==0)
											{
												$panel->add("error","En esta momento no esta disponible ese viaje");
											} 
											else
											{
												$res= mysql_query("SELECT d.des_nombre as ciudad, o.des_nombre as pais  from  destino d, destino o where d.fk_des_id=o.des_id and d.des_id='$banco1'",$conexion) or die (mysql_error());
													$row2=mysql_fetch_array($res);
													$lugar=$row2["ciudad"].", ".$row2["pais"];
											while($row=mysql_fetch_array($result))
											{
												$precio=$row["via_costo"]*$costo*$cantper;
											$tabla='
											<tr align="center">
											  <td width="110">'.$lugar.'</td>
											  <td width="119"><div align="center">'.$row["ciudad"].", ".$row["pais"].'</td>
											  <td width="117"><div align="center">'.$row["aer_nombre"].'</td>
											  <td width="74"><div align="center">'.$precio.'</td>
											</tr>';
												$tabla_completa= $tabla_completa.$tabla;
											
											mysql_free_result($result);
											$panel->add("informacion",$tabla_completa);
											}
											}
										}
									}
								}
								else
						{
						$result= mysql_query("SELECT v.via_costo, v.via_terminal, a.aer_nombre, d.des_nombre as ciudad, o.des_nombre as pais  from via v, destino d, aerolinea a, destino o where d.fk_des_id=o.des_id and a.aer_id='$id' and d.des_id='$habitacion' and v.fk_des_id=d.des_id and v.fk_aer_id=a.aer_id",$conexion) or die (mysql_error());
											$cant=mysql_num_rows($result);
											if ($cant==0)
											{
												$panel->add("error","En esta momento no esta disponible ese viaje");
											} 
											else
											{
												$res= mysql_query("SELECT d.des_nombre as ciudad, o.des_nombre as pais  from  destino d, destino o where d.fk_des_id=o.des_id and d.des_id='$banco1'",$conexion) or die (mysql_error());
													$row2=mysql_fetch_array($res);
											while($row=mysql_fetch_array($result))
											{
												$precio=$row["via_costo"]*$costo*$cantper;
											$tabla='
											<tr align="center">
											  <td width="110">'.$row2["ciudad"].", ".$row2["pais"].'</td>
											  <td width="119"><div align="center">'.$row["ciudad"].", ".$row["pais"].'</td>
											  <td width="117"><div align="center">'.$row["aer_nombre"].'</td>
											  <td width="74"><div align="center">'.$precio.'</td>
											</tr>';
												$tabla_completa= $tabla_completa.$tabla;
											
											mysql_free_result($result);
											$panel->add("informacion",$tabla_completa);
											}
											}
						}
					}
				}
				
			
			}
			
	$panel->show();
		  }
		  else
		  {
			$panelcuentas = new Panel("../html/busqueda_presupuesto.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/busqueda_presupuesto.php?">');
	
			$result2= mysql_query("SELECT d.*  FROM destino d WHERE fk_des_id IS NULL");
								while($row2 = mysql_fetch_array($result2))
								{				
									$select_actual2='<option value="'.$row2["des_id"].'">'.$row2["des_nombre"].'</option>'; 
									$select2=$select2.$select_actual2;
								}
								$panelcuentas->add("bancos",$select2);
								
								$select6='';
						$consultar  = 'SELECT  aer_nombre, aer_id FROM aerolinea';
						$resultado1 = mysql_query($consultar) or die('La consulta fallo;: ' . mysql_error());
						while ($registro = mysql_fetch_row($resultado1)) {
			 			$compañia="Aerolinea: ".$registro[0];
						$select_actual6="<option value='".$registro[1]."a"."'>".$compañia."</option>";
		   				$select6=$select6.$select_actual6;
						}
						$consultar2  = 'SELECT  cru_nombre, cru_id FROM crucero';
						$resultado2 = mysql_query($consultar2) or die('La consulta fallo;: ' . mysql_error());
		 				while ($registro = mysql_fetch_row($resultado2)) {
		    			$compañia="Crucero: ".$registro[0];
						$select_actual6="<option value='".$registro[1]."c"."'>".$compañia."</option>";  
						$select6=$select6.$select_actual6;
						}
		 				$consultar3  = 'SELECT  ter_nombre, ter_id FROM terrestre ';
						$resultado3 = mysql_query($consultar3) or die('La consulta fallo;: ' . mysql_error());		 
						while ($registro = mysql_fetch_row($resultado3)) {
		    			$compañia="Terrestre: ".$registro[0];
						$select_actual6="<option value='".$registro[1]."t"."'>".$compañia."</option>";
						$select6=$select6.$select_actual6;
						}
						
						$panelcuentas->add("servicios",$select6);
	       
			if ($selected && ($selected2=="k") && ($selected3=="a"))
			{
				//echo "aja";
						 $result2= mysql_query("SELECT d.*  FROM destino d WHERE fk_des_id IS NULL");
								while($row2 = mysql_fetch_array($result2))
								{		
								if ($row2["des_id"]==$selected)
								{
									$select_actual2='<option selected="selected" value="'.$row2["des_id"].'">'.$row2["des_nombre"].'</option>'; }	
								else{		
									$select_actual2='<option value="'.$row2["des_id"].'">'.$row2["des_nombre"].'</option>'; 
								}
									$select2=$select2.$select_actual2;
								}
								$panelcuentas->add("bancos",$select2);
																
						        $res=mysql_query("SELECT des_id FROM  destino where des_id=$selected");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['des_id'];
								//echo "dev".$devuelve;	
								
					    
						$result1= mysql_query("SELECT c.* from destino c, destino p WHERE p.des_id=$devuelve AND c.fk_des_id=p.des_id");
						while($row1 = mysql_fetch_array($result1))
						{
							
						$select_actual1='<option value="'.$row1["des_id"].'">'.$row1["des_nombre"].'</option>'; 
						$select1=$select1.$select_actual1;
						}
						$panelcuentas->add("bancos1",$select1);	
					  
					 
			  
			  }
			  
			  if ($selected && ($selected2!="k") && ($selected3=="a"))
			  {
			   //echo('entra2');
								  $result2= mysql_query("SELECT d.*  FROM destino d WHERE fk_des_id IS NULL");
								while($row2 = mysql_fetch_array($result2))
								{		
								if ($row2["des_id"]==$selected)
								{
									$select_actual2='<option selected="selected" value="'.$row2["des_id"].'">'.$row2["des_nombre"].'</option>'; }	
								else{		
									$select_actual2='<option value="'.$row2["des_id"].'">'.$row2["des_nombre"].'</option>'; 
								}
									$select2=$select2.$select_actual2;
								}
								$panelcuentas->add("bancos",$select2);
										
					    		$res=mysql_query("SELECT des_id FROM  destino where des_id=$selected");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['des_id'];
								//echo "dev".$devuelve;	
								
					    
								$result1= mysql_query("SELECT c.* from destino c, destino p WHERE p.des_id=$devuelve AND c.fk_des_id=p.des_id");
						while($row1 = mysql_fetch_array($result1))
						{
							if ($row1["des_id"]==$selected2){
								//echo 'if';
								$select_actual1='<option selected="selected" value="'.$row1["des_id"].'">'.$row1["des_nombre"].'</option>'; 				}	
							else{
								$select_actual1='<option value="'.$row1["des_id"].'">'.$row1["des_nombre"].'</option>'; 
							}
						$select1=$select1.$select_actual1;
						}
						$panelcuentas->add("bancos1",$select1);	
								       
					  	//echo($selected2);
					   	$res3=mysql_query("SELECT des_id FROM  destino where des_id=$selected2");
						$ro3 = mysql_fetch_array($res3);
						$devuelve3=$ro3['des_id'];	
						$res2=mysql_query("SELECT des_id FROM  destino where des_id=$selected");
						$ro2= mysql_fetch_array($res2);
						$devuelve2=$ro2['des_id'];	
						//echo $devuelve2;
						$result4= mysql_query("SELECT d.*  FROM destino d WHERE fk_des_id IS NULL");
						while($row4 = mysql_fetch_array($result4))
						{
						$select_actual4='<option value="'.$row4["des_id"].'">'.$row4["des_nombre"].'</option>'; 
						$select4=$select4.$select_actual4;
						}
						$panelcuentas->add("hoteles",$select4);
						
						
					  
					 
			  
			  }
			  
			  if ($selected && ($selected2!="k") && ($selected3!="a") )
			  {
			   //echo('entra3');
						  $result2= mysql_query("SELECT d.*  FROM destino d WHERE fk_des_id IS NULL");
								while($row2 = mysql_fetch_array($result2))
								{		
								if ($row2["des_id"]==$selected)
								{
									$select_actual2='<option selected="selected" value="'.$row2["des_id"].'">'.$row2["des_nombre"].'</option>'; }	
								else{		
									$select_actual2='<option value="'.$row2["des_id"].'">'.$row2["des_nombre"].'</option>'; 
								}
									$select2=$select2.$select_actual2;
								}
								$panelcuentas->add("bancos",$select2);
										
					    		$res=mysql_query("SELECT des_id FROM  destino where des_id=$selected");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['des_id'];
								//echo "dev".$devuelve;	
								
					    
								$result1= mysql_query("SELECT c.* from destino c, destino p WHERE p.des_id=$devuelve AND c.fk_des_id=p.des_id");
						while($row1 = mysql_fetch_array($result1))
						{
							if ($row1["des_id"]==$selected2){
								//echo 'if';
								$select_actual1='<option selected="selected" value="'.$row1["des_id"].'">'.$row1["des_nombre"].'</option>'; 				}	
							else{
								$select_actual1='<option value="'.$row1["des_id"].'">'.$row1["des_nombre"].'</option>'; 
							}
						$select1=$select1.$select_actual1;
						}
						$panelcuentas->add("bancos1",$select1);	
								       
					  	//echo($selected2);
					   	$res3=mysql_query("SELECT des_id FROM  destino where des_id=$selected2");
						$ro3 = mysql_fetch_array($res3);
						$devuelve3=$ro3['des_id'];	
						$res2=mysql_query("SELECT des_id FROM  destino where des_id=$selected");
						$ro2= mysql_fetch_array($res2);
						$devuelve2=$ro2['des_id'];	
						//echo $devuelve2;
						$result4= mysql_query("SELECT d.*  FROM destino d WHERE fk_des_id IS NULL and des_id");
						while($row4 = mysql_fetch_array($result4))
						{
							if ($row4["des_id"]==$selected3)
							{
								$select_actual4='<option selected="selected" value="'.$row4["des_id"].'">'.$row4["des_nombre"].'</option>'; 				}	
							else{
						$select_actual4='<option value="'.$row4["des_id"].'">'.$row4["des_nombre"].'</option>'; 
							}
						$select4=$select4.$select_actual4;
						}
						$panelcuentas->add("hoteles",$select4);
						
						//echo($selected3);
						$res4=mysql_query("SELECT des_id FROM  destino where des_id=$selected3");
						$ro4= mysql_fetch_array($res4);
						$devuelve4=$ro4['des_id'];	
						$result5= mysql_query("SELECT c.* from destino c, destino p WHERE p.des_id=$devuelve4 and c.des_id<>$selected2 AND c.fk_des_id=p.des_id");
						while($row5 = mysql_fetch_array($result5))
						{
						$select_actual5='<option value="'.$row5["des_id"].'">'.$row5["des_nombre"].'</option>'; 
						$select5=$select5.$select_actual5;
						}
						$panelcuentas->add("habitaciones",$select5);
						
						
								  
			 }
			 
			
			$panelcuentas->add("tipo_boton",'Aceptar');
	       
	        $panelcuentas->show();
			
			
		   }
			
		  
	include "../db/cerrar_conexion.php";
?>