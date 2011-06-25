<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_GET);
	extract($_POST);
	
	      if($descripcion_viejo)
		  {
				if (($descripcion_viejo== $descripcion)&&($logo_viejo==$logo)&&($hotel_viejo==$hotel))    
				{	
				    $hola='a_publicidad_hotel.php';
				    header("Location:$hola");	 
				}
				else 
				{
				    
				    if ((strtoupper($descripcion_viejo)== strtoupper($descripcion))&&($hotel_viejo==$hotel))
					{
					
					//echo "logo".$logo;
					mysql_query("UPDATE `publicidad` SET  `pub_descripcion` =  '$descripcion',  `pub_logo` =  '$logo', `fk_hot_id` =  '$hotel' WHERE  pub_id = $cue_id") or die ('Error en el logo'.mysql_error());;
					
					$hola='a_publicidad_hotel.php?mensaje=2';
				    header("Location:$hola");	
					
					}
					else 
					{
					   
					   if (($logo_viejo==$logo)&&($hotel_viejo==$hotel))
					  {
					   		$result1= mysql_query("SELECT * FROM publicidad WHERE pub_descripcion = '$descripcion'");
					    	if(mysql_fetch_array($result1))
							{
					  
					  			$hola='a_publicidad_hotel.php?mensaje=3';
				            	header("Location:$hola");		
							  
							}
					  		else // modifico
					  		{
					//echo "entre";
					  mysql_query("UPDATE `publicidad` SET  `pub_descripcion` =  '$descripcion',  `pub_logo` =  '$logo',`fk_hot_id` =  '$hotel' WHERE  pub_id = $cue_id") or die ('Error en la publicidad'.mysql_error());
					
					$hola='a_publicidad_hotel.php?mensaje=5';
				    header("Location:$hola");
					  
					  
					  		}
					
				
						}
						else
						{
							if (($descripcion_viejo== $descripcion)&&($logo_viejo==$logo))
							{
								//echo "aja";
								mysql_query("UPDATE `publicidad` SET  `pub_descripcion` =  '$descripcion',  `pub_logo` =  '$logo',`fk_hot_id` =  '$hotel' WHERE  pub_id = $cue_id") or die ('Error en la publicidad'.mysql_error());
					
					$hola='a_publicidad_hotel.php?mensaje=2';
				    header("Location:$hola");
							}
							else
							{
							//echo "entre";
						mysql_query("UPDATE `publicidad` SET  `pub_descripcion` =  '$descripcion',  `pub_logo` =  '$logo',`fk_hot_id` =  '$hotel' WHERE  pub_id = $cue_id") or die ('Error en la publicidad'.mysql_error());
							}
					
					$hola='a_publicidad_hotel.php?mensaje=2';
				    header("Location:$hola");
						}	
				
					}
	
				}
		  }
	      else
		  {//aqui pinta el editor por primera vez	
		   
					$admin= new Panel("../html/admin.html");
					$admin->add("body",'<body onLoad = "actual(10)" >');
					$paneleditar = new Panel("../html/a_crear_publicidad_hotel.html");
					$paneleditar->add("form",'<form name="form1" method="post" action="../php/a_editar_publicidad_hotel.php?cue_id='.$id.'">');
					$paneleditar->add("descripcion",$descripcion);
					$paneleditar->add("id_viejo",$id);
					$paneleditar->add("logo",$logo);
					//$paneleditar->add("trans",$hot);
					$paneleditar->add("id",'<tr><td>Id:</td><td>'.$id.'</td></tr>');
					//echo $hot."aqui";
					$select1= mysql_query("SELECT h.hot_nombre, h.hot_id FROM publicidad p, hotel h WHERE p.pub_id = '$id' and p.fk_hot_id=h.hot_id") or die ('Error en tomar nombre hotel'.mysql_error());
					  $row=mysql_fetch_array($select1);
					  $hotel_actual="Hotel Actual: ".$row["hot_nombre"];
					  //echo $hotel_actual;
					  //$paneleditar->add("hotel_actual",$hotel_actual);
					//echo "hotel=".$hot;
					$select='';
					$result= mysql_query("SELECT * FROM hotel") or die;
					while($row = mysql_fetch_array($result))
					{				
						
						if ($row["hot_id"]==$hot){
						    $select_actual='<option selected="selected" value="'.$row["hot_id"].'">'.$row["hot_nombre"].'</option>'; }	
						else{
						    $select_actual='<option value="'.$row["hot_id"].'">'.$row["hot_nombre"].'</option>'; 	}	
					    $select=$select.$select_actual;
					}
					$paneleditar->add("hoteles",$select);
			
					
					$paneleditar->add("tipo_boton",'Modificar');
					$admin->add("contenido",$paneleditar);
					$admin->show();
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>