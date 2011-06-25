<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_GET);
	extract($_POST);
	
	      if($estadio_viejo1)
		  {// aqui validar que los datos esten bien y hacer update
		
		
               if (($estadio_viejo== $cue_numero)&&($aforo_viejo==$tipo)&&($ciudad_vieja==$banco) && ($fecha_vieja == $fecha)&& ($destino_viejo==$destino))    
				{	
				    $hola='a_aerolineas.php';
				    header("Location:$hola");	 
				}
				else 
				{
				    
				    if ((strtoupper($estadio_viejo)== strtoupper($cue_numero))&&($ciudad_vieja==$banco))
					{
					
					
					mysql_query("UPDATE  `costo` SET  `cos_costo` =  '$cue_numero', `cos_hora` =  '$fecha', `fk_via_origen` =  '$banco', `fk_via_destino` =  '$banco1' WHERE  `costo`.`cos_id` = $cue_id");
					
					$hola='a_aerolineas.php?mensaje=2';
				    header("Location:$hola");	
					
					}
					else 
					{//1
					   
					   
					   $result1= mysql_query("SELECT * FROM via v WHERE v.via_id ='$cue_numero' AND v.fk_aer_id = '$banco' AND v.fk_des_id = '$destino'");
					  if (mysql_fetch_array($result1))
					  {
					  		$hola='a_aerolineas.php?mensaje=3';
				            header("Location:$hola");		
							
					
					
					  }
					  else
					  {
					  //echo ", $cue_id";
					
					mysql_query("UPDATE  `costo` SET  `cos_costo` =  '$cue_numero', `cos_hora` =  '$fecha', `fk_via_origen` =  '$banco', `fk_via_destino` =  '$banco1' WHERE  `costo`.`cos_id` = $cue_id");
					
					//$hola='a_aerolineas.php?mensaje=2';
				   // header("Location:$hola");	
					  
					  
					  }
					
				
				}	
				
			 }		
	
		  }
	      else
		  {//aqui pinta el editor por primera vez	
		            //echo "$cue_numero , $tipo";  
					$admin= new Panel("../html/admin.html");
					$admin->add("body",'<body onLoad = "actual(1)" >');
					$panelestadios = new Panel("../html/a_editar_costo1_aerolinea.html");
					$panelestadios->add("form",'<form name="form1" method="post" action="../php/a_editar_costo2_aerolinea.php?id='.$id.'">');
					
					$panelestadios->add("cue_numero",$cue_numero);
					
					$panelestadios->add("id",$id);
					$panelestadios->add("banco",$selected);
					$panelestadios->add("banco1",$destino);
					
					$panelestadios->add("fecha",$fecha);
					 

					
			
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
								$panelestadios->add("bancos",$select2);
								
								$result21= mysql_query("SELECT v.*, a.aer_nombre, d.des_nombre FROM  via v, aerolinea a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_aer_id=a.aer_id AND v.fk_aer_id IS NOT NULL AND v.fk_cru_id IS NULL AND v.fk_ter_id IS NULL");
								while($row21 = mysql_fetch_array($result21))
								{				
									
									if ($row21["via_id"]==$selected2){
										//echo 'if';
										$select_actual21='<option selected="selected" value="'.$row21["via_id"].'">'.$row21["aer_nombre"]."/".$row21["des_nombre"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual21='<option value="'.$row21["via_id"].'">'.$row21["aer_nombre"]."/".$row21["des_nombre"].'</option>'; 	}	
									$select21=$select21.$select_actual21;
								}
								$panelestadios->add("bancos1",$select21);
			
				$panelestadios->add("tipo_boton",'Modificar');
					$admin->add("contenido",$panelestadios);
					$admin->show();
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>