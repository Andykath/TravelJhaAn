<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_GET);
	extract($_POST);
	
	      if($cue_numero)
		  {// aqui validar que los datos esten bien y hacer update
		
	
					  mysql_query("UPDATE `viaje` SET  `via_tipo` =  'Paquete', `via_tipoviaje` =  '$cue_numero', `via_fecha_ini` =  '$fecha',`via_fecha_fin` =  '$fecha1', `via_millas` =  '$millas',`via_tipo_paq` =  '$tipopaq',`via_cant_per` =  '$cantper', `fk_via_id_origen` =  '$banco', `fk_via_id_destino` =  '$banco1' WHERE  `viaje`.`via_id` = $cue_id");
					
					$hola='a_paquetes_sinestadia_terrestres.php?mensaje=2';
				    header("Location:$hola");
					  
					  
					  
					
				
					
				
			 	
	
		  }
	      else
		  {//aqui pinta el editor por primera vez	cyo lo acabo d hacer tb :S ya va
		              echo("entra");
					$admin= new Panel("../html/admin.html");
					$admin->add("body",'<body onLoad = "actual(9)" >');
					$panelcuentas = new Panel("../html/a_modificar_paquete_sinestadia_terrestre.html");
					$panelcuentas->add("form",'<form name="form1" method="post" action="../php/a_modificar_paquete_sinestadia_terrestre2.php">');
					
					
			
					$result= mysql_query("SELECT v.*, a.ter_nombre, d.des_nombre FROM  via v, terrestre a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_ter_id=a.ter_id AND v.fk_ter_id IS NOT NULL AND v.fk_cru_id IS NULL AND v.fk_aer_id IS NULL");
        	while($row = mysql_fetch_array($result))
        	{
			$select_actual='<option value="'.$row["via_id"].'">'.$row["ter_nombre"]."/".$row["des_nombre"].'</option>'; 		
			$select=$select.$select_actual;
			}
			$panelcuentas->add("bancos",$select);
					
					
					//
		
					
					
					if ($selected && $tipoviaje && $fechai && $fechaf && $millas && $tipopaq && $cantper && $id)
			  {
			  
			  echo("entra2");
						 $result2= mysql_query("SELECT v.*, a.ter_nombre, d.des_nombre FROM  via v, terrestre a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_ter_id=a.ter_id AND v.fk_ter_id IS NOT NULL AND v.fk_cru_id IS NULL AND v.fk_aer_id IS NULL");
								while($row2 = mysql_fetch_array($result2))
								{				
									
									if ($row2["via_id"]==$selected){
										//echo 'if';
										$select_actual2='<option selected="selected" value="'.$row2["via_id"].'">'.$row2["ter_nombre"]."/".$row2["des_nombre"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual2='<option value="'.$row2["via_id"].'">'.$row2["ter_nombre"]."/".$row2["des_nombre"].'</option>'; 	}	
									$select2=$select2.$select_actual2;
								}
								$panelcuentas->add("bancos",$select2);
								
								$panelcuentas->add("cue_numero",$tipoviaje);
								$panelcuentas->add("fecha",$fechai);
								$panelcuentas->add("fecha1",$fechaf);
								$panelcuentas->add("millas",$millas);
								$panelcuentas->add("tipopaq",$tipopaq);
								$panelcuentas->add("cantper",$cantper);
								$panelcuentas->add("cue_id",$id);
								
						        $res=mysql_query("SELECT fk_ter_id FROM  via where via_id=$selected");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_ter_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];		
					    
						$result1= mysql_query("SELECT v.*, a.ter_nombre, d.des_nombre FROM  via v, terrestre a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_ter_id=a.ter_id AND v.fk_ter_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_cru_id IS NULL AND v.fk_aer_id IS NULL");
						while($row1 = mysql_fetch_array($result1))
						{
						$select_actual1='<option value="'.$row1["via_id"].'">'.$row1["ter_nombre"]."/".$row1["des_nombre"].'</option>'; 
						$select1=$select1.$select_actual1;
						}
						$panelcuentas->add("bancos1",$select1);
					  
					 
			  
			  }
					
					
					
					
					
					$panelcuentas->add("tipo_boton",'Modificar');
					$admin->add("contenido",$panelcuentas);
					$admin->show();
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>