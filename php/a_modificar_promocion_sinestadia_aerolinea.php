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
           
					 
					  mysql_query("UPDATE `promocion` SET  `pro_nombre` =  '$cue_numero', `pro_fechaini` =  '$fecha',`pro_fechafin` =  '$fecha1', `pro_descuento` =  '$des',`pro_durac_viaje` =  '$dur',`fk_via_id` =  '$banco' WHERE  `promocion`.`pro_id` = $cue_id");
					
					$hola='a_promociones_sinestadia_aerolineas.php?mensaje=2';
				    header("Location:$hola");
					  
					  
					  
					
				
					
				
			 	
	
		  }
	      else
		  {//aqui pinta el editor por primera vez	
		              
					$admin= new Panel("../html/admin.html");
					$admin->add("body",'<body onLoad = "actual(9)" >');
					$panelestadios = new Panel("../html/a_modificar_promocion_sinestadia_aerolinea.html");
					$panelestadios->add("form",'<form name="form1" method="post" action="../php/a_modificar_promocion_sinestadia_aerolinea.php?cue_id='.$id.'&cue_numero='.$nombrepro.'&fechai='.$fechai.'&fechaf='.$fechaf.'&des'.$descuento.'&dur='.$duracion.'&fkvia='.$banco.'">');
					
					$panelestadios->add("cue_numero",$nombre);
					$panelestadios->add("fecha",$fechai);
					$panelestadios->add("fecha1",$fechaf);
					$panelestadios->add("banco",$banco);
					$panelestadios->add("cue_id",$id);
					$panelestadios->add("des",$descuento);
					 $panelestadios->add("dur",$duracion);
					
			
					$select='';
					$result= mysql_query("SELECT v.*, a.aer_nombre, d.des_nombre FROM  via v, aerolinea a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_aer_id=a.aer_id AND v.fk_aer_id IS NOT NULL AND v.fk_cru_id IS NULL AND v.fk_ter_id IS NULL");
					while($row = mysql_fetch_array($result))
					{				
						
						if ($row["via_id"]==$fkviaid){
						    //echo 'if';
						   $select_actual='<option selected="selected" value="'.$row["via_id"].'">'.$row["aer_nombre"]."/".$row["des_nombre"].'</option>'; }	
						else{
						    //echo "banco es $banco";
						   $select_actual='<option value="'.$row["via_id"].'">'.$row["aer_nombre"]."/".$row["des_nombre"].'</option>'; 	}	
					    $select=$select.$select_actual;
					}
					$panelestadios->add("bancos",$select);
					
					$select1='';
					echo($fkviaid2);
					$result1= mysql_query("SELECT v.*, a.aer_nombre, d.des_nombre FROM  via v, aerolinea a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_aer_id=a.aer_id AND v.fk_aer_id IS NOT NULL AND v.fk_cru_id IS NULL AND v.fk_ter_id IS NULL");
					while($row1 = mysql_fetch_array($result1))
					{				
						
						if ($row1["via_id"]==$fkviaid2){
						    //echo 'if';
						   $select_actual1='<option selected="selected" value="'.$row1["via_id"].'">'.$row1["aer_nombre"]."/".$row1["des_nombre"].'</option>'; }	
						else{
						    //echo "banco es $banco";
						   $select_actual1='<option value="'.$row1["via_id"].'">'.$row1["aer_nombre"]."/".$row1["des_nombre"].'</option>'; 	}	
					    $select1=$select1.$select_actual1;
					}
					$panelestadios->add("bancos1",$select1);
					
					
					
					
					
					
					$panelestadios->add("tipo_boton",'Modificar');
					$admin->add("contenido",$panelestadios);
					$admin->show();
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>