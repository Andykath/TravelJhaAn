<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_GET);
	extract($_POST);
	
	      if($cue_numero)
		  {// aqui validar que los datos esten bien y hacer update
		
		  //echo($fecha);
		   //echo($fecha1);
		    //echo($des);
			 //echo($dur);
			  //echo($fkvia);
           
					 mysql_query("UPDATE `viaje` SET  `via_tipo` =  'Paquete', `via_tipoviaje` =  '$cue_numero', `via_fecha_ini` =  '$fecha',`via_fecha_fin` =  '$fecha1', `via_millas` =  '$millas',`via_tipo_paq` =  '$tipopaq',`via_cant_per` =  '$cantper', `fk_via_id_origen` =  '$banco', `fk_via_id_destino` =  '$banco1' ,`via_hotel`= $hotel WHERE  `viaje`.`via_id` = $cue_id");
					
					$hola='a_paquetes_estadia_aerolineas.php?mensaje=2';
				    header("Location:$hola");
					  
					  
					  
					
				
					
				
			 	
	
		  }
	      else
		  {//aqui pinta el editor por primera vez	
		              
					$admin= new Panel("../html/admin.html");
					$admin->add("body",'<body onLoad = "actual(9)" >');
					$panelestadios = new Panel("../html/a_modificar_paquete_estadia_aerolinea.html");
					$panelestadios->add("form",'<form name="form1" method="post" action="../php/a_modificar_paquete_estadia_aerolinea.php?cue_id='.$id.'&cue_numero='.$tipoviaje.'&fecha='.$fechai.'&fecha1='.$fechaf.'&millas'.$millas.'&tipopaq='.$tipopaq.'&cantper='.$cantper.'&banco='.$banco.'&banco1='.$banco1.'&hotel='.$hotel.'&cue_id='.$id.'">');
					
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
					$result= mysql_query("SELECT v.*, a.aer_nombre, d.des_nombre FROM  via v, aerolinea a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_aer_id=a.aer_id AND v.fk_aer_id IS NOT NULL AND v.fk_cru_id IS NULL AND v.fk_ter_id IS NULL");
					while($row = mysql_fetch_array($result))
					{				
						
						if ($row["via_id"]==$fkvia){
						    //echo 'if';
						   $select_actual='<option selected="selected" value="'.$row["via_id"].'">'.$row["aer_nombre"]."/".$row["des_nombre"].'</option>'; }	
						else{
						    //echo "banco es $banco";
						   $select_actual='<option value="'.$row["via_id"].'">'.$row["aer_nombre"]."/".$row["des_nombre"].'</option>'; 	}	
					    $select=$select.$select_actual;
					}
					$panelestadios->add("bancos",$select);
					
					
					$select1='';
					$result1= mysql_query("SELECT v.*, a.aer_nombre, d.des_nombre FROM  via v, aerolinea a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_aer_id=a.aer_id AND v.fk_aer_id IS NOT NULL AND v.fk_cru_id IS NULL AND v.fk_ter_id IS NULL");
					while($row1 = mysql_fetch_array($result1))
					{				
						
						if ($row1["via_id"]==$fkvia2){
						    //echo 'if';
						   $select_actual='<option selected="selected" value="'.$row1["via_id"].'">'.$row1["aer_nombre"]."/".$row1["des_nombre"].'</option>'; }	
						else{
						    //echo "banco es $banco";
						   $select_actual='<option value="'.$row1["via_id"].'">'.$row1["aer_nombre"]."/".$row1["des_nombre"].'</option>'; 	}	
					    $select=$select.$select_actual;
					}
					$panelestadios->add("bancos1",$select);
					
					//echo($fkvia2);
					// echo($selected2);
					   $res3=mysql_query("SELECT fk_des_id FROM  via where via_id=$fkvia2");
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
						   $select_actual4='<option value="'.$row1["hot_id"].'">'.$row4["hot_nombre"].'</option>'; 	}	
						$select4=$select4.$select_actual4;
						}
						$panelestadios->add("hoteles",$select4);
						
					
					
					
					
					
					$panelestadios->add("tipo_boton",'Modificar');
					$admin->add("contenido",$panelestadios);
					$admin->show();
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>