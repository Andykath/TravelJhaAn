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
           
					 mysql_query("UPDATE `viaje` SET  `via_tipo` =  'Paquete', `via_tipoviaje` =  '$cue_numero', `via_fecha_ini` =  '$fecha',`via_fecha_fin` =  '$fecha1', `via_millas` =  '$millas',`via_tipo_paq` =  '$tipopaq',`via_cant_per` =  '$cantper', `fk_flo_id`= '$ruta' WHERE  `viaje`.`via_id` = $cue_id");
					
					$hola='a_paquetes_estadia_crucero.php?mensaje=2';
				    header("Location:$hola");
					  
					  
					  
					
				
					
				
			 	
	
		  }
	      else
		  {//aqui pinta el editor por primera vez	
		              
					$admin= new Panel("../html/admin.html");
					$admin->add("body",'<body onLoad = "actual(9)" >');
					$panelestadios = new Panel("../html/a_modificar_paquete_estadia_crucero.html");
					$panelestadios->add("form",'<form name="form1" method="post" action="../php/a_modificar_paquete_estadia_crucero.php?cue_id='.$id.'&cue_numero='.$tipoviaje.'&fecha='.$fechai.'&fecha1='.$fechaf.'&millas'.$millas.'&tipopaq='.$tipopaq.'&cantper='.$cantper.'&banco='.$banco.'&banco1='.$banco1.'&hotel='.$hotel.'&cue_id='.$id.'">');
					
					$panelestadios->add("cue_numero",$tipoviaje);
					$panelestadios->add("fecha",$fechai);
					$panelestadios->add("fecha1",$fechaf);
					$panelestadios->add("banco",$banco);
					$panelestadios->add("banco1",$banco1);
					$panelestadios->add("cue_id",$id);
					$panelestadios->add("millas",$millas);
					 $panelestadios->add("tipopaq",$tipopaq);
					 $panelestadios->add("cantper",$cantper);
					
			
					$result2= mysql_query("select * from crucero");
								while($row2 = mysql_fetch_array($result2))
								{				
									
									if ($row2["cru_id"]==$aerid){
										//echo 'if';
										$select_actual2='<option selected="selected" value="'.$row2["cru_id"].'">'.$row2["cru_nombre"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual2='<option value="'.$row2["cru_id"].'">'.$row2["cru_nombre"].'</option>'; 	}	
									$select2=$select2.$select_actual2;
								}
								$panelestadios->add("cruceros",$select2);
					
					
					$select1='';
					$result1= mysql_query("SELECT distinct r.fk_flo_id FROM ruta r WHERE fk_flo_id IN (SELECT flo_id FROM flota WHERE fk_cru_id =$aerid)");
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
						if ($row1["fk_flo_id"]==$hotel){
						$select_actual1='<option selected="selected" value="'.$row1["fk_flo_id"].'">'.$rutax.'</option>'; 
						}
						else
						{
						 $select_actual1='<option value="'.$row1["fk_flo_id"].'">'.$rutax.'</option>'; 
						}
						$select1=$select1.$select_actual1;
						}
						$panelestadios->add("rutas",$select1);	
					
					
					
					$panelestadios->add("tipo_boton",'Modificar');
					$admin->add("contenido",$panelestadios);
					$admin->show();
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>