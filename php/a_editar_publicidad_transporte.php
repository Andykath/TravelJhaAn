<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_GET);
	extract($_POST);
	
	     if($descripcion_viejo)
		  {
			  	$tip=substr($hotel,0,1);
				$ip=substr($hotel,2,3);
				if (($descripcion_viejo== $descripcion)&&($logo_viejo==$logo)&&($tipo_viejo==$tip)&&($hotel_viejo==$ip))    
				{	
				    $hola='a_publicidad_transporte.php';
				    header("Location:$hola");	 
				}
				else 
				{
				    if ((strtoupper($descripcion_viejo)== strtoupper($descripcion))&&($tipo_viejo==$tip)&&($hotel_viejo==$ip))
					{
						if ($tip=='a')
						{
						mysql_query("UPDATE `publicidad` SET  `pub_descripcion` =  '$descripcion',  `pub_logo` =  '$logo', `fk_aer_id` =  '$ip' WHERE  pub_id = $cue_id") or die ('Error en el logo'.mysql_error());;
					
						$hola='a_publicidad_transporte.php?mensaje=2';
				    	header("Location:$hola");
						}
						else if ($tip=='c')
						{
							mysql_query("UPDATE `publicidad` SET  `pub_descripcion` =  '$descripcion',  `pub_logo` =  '$logo', `fk_cru_id` =  '$ip' WHERE  pub_id = $cue_id") or die ('Error en el logo'.mysql_error());
					
						$hola='a_publicidad_transporte.php?mensaje=2';
				    	header("Location:$hola");
						}
						else
						{
							mysql_query("UPDATE `publicidad` SET  `pub_descripcion` =  '$descripcion',  `pub_logo` =  '$logo', `fk_ter_id` =  '$ip' WHERE  pub_id = $cue_id") or die ('Error en el logo'.mysql_error());;
					
						$hola='a_publicidad_transporte.php?mensaje=2';
				    	header("Location:$hola");
						}
					}
					else 
					{
					   
					   if (($logo_viejo==$logo)&&($tipo_viejo==$tip)&&($hotel_viejo==$ip))
					  {
					   		$result1= mysql_query("SELECT * FROM publicidad WHERE pub_descripcion = '$descripcion'");
					    	if(mysql_fetch_array($result1))
							{
					  
					  			$hola='a_publicidad_transporte.php?mensaje=3';
				            	header("Location:$hola");		
							  
							}
					  		else // modifico
					  		{
					  			if ($tip=='a')
								{
									mysql_query("UPDATE `publicidad` SET  `pub_descripcion` =  '$descripcion',  `pub_logo` =  '$logo', `fk_aer_id` =  '$ip' WHERE  pub_id = $cue_id") or die ('Error en el logo'.mysql_error());;
					
									$hola='a_publicidad_transporte.php?mensaje=2';
				    				header("Location:$hola");
								}
								else if ($tip=='c')
								{
									mysql_query("UPDATE `publicidad` SET  `pub_descripcion` =  '$descripcion',  `pub_logo` =  '$logo', `fk_cru_id` =  '$ip' WHERE  pub_id = $cue_id") or die ('Error en el logo'.mysql_error());;
					
									$hola='a_publicidad_transporte.php?mensaje=2';
				    				header("Location:$hola");
								}
								else
								{
									mysql_query("UPDATE `publicidad` SET  `pub_descripcion` =  '$descripcion',  `pub_logo` =  '$logo', `fk_ter_id` =  '$ip' WHERE  pub_id = $cue_id") or die ('Error en el logo'.mysql_error());;
					
									$hola='a_publicidad_transporte.php?mensaje=2';
				    				header("Location:$hola");
								}
					  
					  		}
				
						}
						else
						{
							if ((strtoupper($descripcion_viejo)== strtoupper($descripcion))&&($logo_viejo==$logo)&&($tipo_viejo==$tip))
					  		{
								//echo "entre";
								if ($tipo_viejo=='a')
									{
									mysql_query("UPDATE `publicidad` SET  `pub_descripcion` =  '$descripcion',  `pub_logo` =  '$logo', `fk_aer_id` =  '$ip' WHERE  pub_id = $cue_id") or die ('Error en el logo'.mysql_error());;
					
									$hola='a_publicidad_transporte.php?mensaje=2';
				    				header("Location:$hola");
									}
									else if ($tipo_viejo=='c')
									{
									mysql_query("UPDATE `publicidad` SET  `pub_descripcion` =  '$descripcion',  `pub_logo` =  '$logo', `fk_cru_id` =  '$ip' WHERE  pub_id = $cue_id") or die ('Error en el logo'.mysql_error());;
					
									$hola='a_publicidad_transporte.php?mensaje=2';
				    				header("Location:$hola");
									}
									else
									{
									mysql_query("UPDATE `publicidad` SET  `pub_descripcion` =  '$descripcion',  `pub_logo` =  '$logo', `fk_ter_id` =  '$ip' WHERE  pub_id = $cue_id") or die ('Error en el logo'.mysql_error());;
					
									$hola='a_publicidad_transporte.php?mensaje=2';
				    				header("Location:$hola");
									}
							}
							else
							{   //echo "sii";
								if ($tip=='a')
								{	//echo "tipo a";
									if ($tipo_viejo=='a')
									{
									mysql_query("UPDATE `publicidad` SET  `pub_descripcion` =  '$descripcion',  `pub_logo` =  '$logo', `fk_aer_id` =  '$ip' WHERE  pub_id = $cue_id") or die ('Error en el logo'.mysql_error());;
					
									$hola='a_publicidad_transporte.php?mensaje=2';
				    				header("Location:$hola");
									}
									else if ($tipo_viejo=='c')
									{
									mysql_query("UPDATE `publicidad` SET  `pub_descripcion` =  '$descripcion',  `pub_logo` =  '$logo', `fk_aer_id` =  '$ip', fk_cru_id=NULL WHERE  pub_id = $cue_id") or die ('Error en el logo'.mysql_error());;
					
									$hola='a_publicidad_transporte.php?mensaje=2';
				    				header("Location:$hola");
									}
									else
									{
									
									mysql_query("UPDATE `publicidad` SET  `pub_descripcion` =  '$descripcion',  `pub_logo` =  '$logo', `fk_aer_id` =  '$ip', fk_ter_id=NULL WHERE  pub_id = $cue_id") or die ('Error en el logo'.mysql_error());;
					
									$hola='a_publicidad_transporte.php?mensaje=2';
				    				header("Location:$hola");

									}
								}
								else if ($tip=='c')
								{ //echo "tipo c";
									if ($tipo_viejo=='a')
									{
									mysql_query("UPDATE `publicidad` SET  `pub_descripcion` =  '$descripcion',  `pub_logo` =  '$logo', `fk_cru_id` =  '$ip', fk_aer_id=NULL WHERE  pub_id = $cue_id") or die ('Error en el logo'.mysql_error());;
					
									$hola='a_publicidad_transporte.php?mensaje=2';
				    				header("Location:$hola");
									}
									else if ($tipo_viejo=='c')
									{
									mysql_query("UPDATE `publicidad` SET  `pub_descripcion` =  '$descripcion',  `pub_logo` =  '$logo', `fk_cru_id` =  '$ip' WHERE  pub_id = $cue_id") or die ('Error en el logo'.mysql_error());;
					
									$hola='a_publicidad_transporte.php?mensaje=2';
				    				header("Location:$hola");
									}
									else
									{
										//echo "tipo_v t";
									mysql_query("UPDATE `publicidad` SET  `pub_descripcion` =  '$descripcion',  `pub_logo` =  '$logo', `fk_cru_id` =  '$ip', fk_ter_id=NULL WHERE  pub_id = $cue_id") or die ('Error en el transporte'.mysql_error());
					
									$hola='a_publicidad_transporte.php?mensaje=2';
				    				header("Location:$hola");

									}
								}
								else
								{	//echo "tipo c";
									if ($tipo_viejo=='a')
									{
									mysql_query("UPDATE `publicidad` SET  `pub_descripcion` =  '$descripcion',  `pub_logo` =  '$logo', `fk_ter_id` =  '$ip', fk_aer_id=NULL WHERE  pub_id = $cue_id") or die ('Error en el logo'.mysql_error());;
					
									$hola='a_publicidad_transporte.php?mensaje=2';
				    				header("Location:$hola");
									}
									else if ($tipo_viejo=='c')
									{
									mysql_query("UPDATE `publicidad` SET  `pub_descripcion` =  '$descripcion',  `pub_logo` =  '$logo', `fk_ter_id` =  '$ip', fk_cru_id=NULL WHERE  pub_id = $cue_id") or die ('Error en el logo'.mysql_error());;
					
									$hola='a_publicidad_transporte.php?mensaje=2';
				    				header("Location:$hola");
									}
									else
									{
										
									mysql_query("UPDATE `publicidad` SET  `pub_descripcion` =  '$descripcion',  `pub_logo` =  '$logo', `fk_ter_id` =  '$ip'  WHERE  pub_id = $cue_id") or die ('Error en el logo'.mysql_error());;
					
									$hola='a_publicidad_transporte.php?mensaje=2';
				    				header("Location:$hola");
	
									}
								}
							}
						}
				
					}
	
				}
		  }
	      else
		  {//aqui pinta el editor por primera vez	
		   
					$admin= new Panel("../html/admin.html");
					$admin->add("body",'<body onLoad = "actual(10)" >');
					$paneleditar = new Panel("../html/a_crear_publicidad_transporte.html");
					$paneleditar->add("form",'<form name="form1" method="post" action="../php/a_editar_publicidad_transporte.php?cue_id='.$id.'">');
					$paneleditar->add("descripcion",$descripcion);
					$paneleditar->add("id_viejo",$id);
					$paneleditar->add("logo",$logo);
					//$paneleditar->add("hotel",$hot);
					//$paneleditar->add("tip",$tipo);
					$paneleditar->add("id",'<tr><td>Id:</td><td>'.$id.'</td></tr>');			//echo "tip ".$tipo;
					
					$select='';
			
			//echo "aja";
			//echo "tipo=".$tipo." ";
			$result= mysql_query("SELECT * FROM aerolinea");
			while($row = mysql_fetch_array($result))
			{	$tip="Aerolinea: ".$row["aer_nombre"];
					$id="a.".$row["aer_id"];
					if ($tipo=='a')
					{
						//echo "soy aereo";
					if ($row["aer_id"]==$hot){
						    $select_actual='<option selected="selected" value="'.$id.'">'.$tip.'</option>'; }	
					else{
						    $select_actual='<option value="'.$id.'">'.$tip.'</option>'; 
					}
					}
					else
					{
						//echo "siempre entro aqui";
						$select_actual='<option value="'.$id.'">'.$tip.'</option>'; 
					}
					$select=$select.$select_actual;
					
				}
			$paneleditar->add("transporte",$select);
			$result2= mysql_query("SELECT * FROM terrestre");
			while($row2 = mysql_fetch_array($result2))
	
				{	$tip="Terrestre: ".$row2["ter_nombre"];
					$id="t.".$row2["ter_id"];
					if ($tipo=='t'){
						//echo "soy terrestre";
					if ($row2["ter_id"]==$hot){
						    $select_actual='<option selected="selected" value="'.$id.'">'.$tip.'</option>'; }	
					else{
						    $select_actual='<option value="'.$id.'">'.$tip.'</option>'; 
					}
					}
					else
					{
						$select_actual='<option value="'.$id.'">'.$tip.'</option>'; 
					}
					$select=$select.$select_actual;
					
				}
			$paneleditar->add("transporte",$select);
			$result3= mysql_query("SELECT * FROM crucero");
			while($row3 = mysql_fetch_array($result3))
	
				{	$tip="Crucero: ".$row3["cru_nombre"];
					$id="c.".$row3["cru_id"];
					if ($tipo=='c'){
						//echo "soy crucero";
					if ($row3["cru_id"]==$hot){
						    $select_actual='<option selected="selected" value="'.$id.'">'.$tip.'</option>'; }	
					else{
						    $select_actual='<option value="'.$id.'">'.$tip.'</option>'; 
					}
					}
					else
					{
						$select_actual='<option value="'.$id.'">'.$tip.'</option>'; 
					}
					$select=$select.$select_actual;
					
				}
			$paneleditar->add("transporte",$select);
					
					$paneleditar->add("tipo_boton",'Modificar');
					$admin->add("contenido",$paneleditar);
					$admin->show();
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>