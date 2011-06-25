<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_POST);
	extract($_GET);
	
	      if($cue_numero)
		  {
		      

				 mysql_query("UPDATE `promocion` SET  `pro_nombre` =  '$cue_numero', `pro_fechaini` =  '$fecha',`pro_fechafin` =  '$fecha1', `pro_descuento` =  '$des',`pro_durac_viaje` =  '$dur',`fk_via_id` =  '$banco', `fk_hab_id`=$hotel WHERE  `promocion`.`pro_id` = $id");
				
			    
				$hola='a_promociones_estadia_cruceros.php?mensaje=1';
				header("Location:$hola");

		  
		  
		  }
	      else // aqui cargo por primera vez 
		  {
			
			$admin= new Panel("../html/admin.html");
			$admin->add("body",'<body onLoad = "actual(9)" >');
			$panelcuentas = new Panel("../html/a_modificar_promocion_estadia_crucero.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/a_modificar_promocion_estadia_crucero2.php">');
	        // aqui cargo el primer combo, despues necesito cargar el de hoteles con la tabla hotel de acuerdo a la habitacion que tenga que se llama habi en el html
	        $result2= mysql_query("SELECT v.*, c.cru_nombre, d.des_nombre FROM  via v, crucero c, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=c.cru_id AND v.fk_cru_id IS NOT NULL AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL");
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
			
			//echo "$selected, $nombre, $fechai, $fechaf, $desc, $durac";
			if ($selected && $nombre && $fechai && $fechaf && $desc && $durac && $id)
					{
					
						$result3= mysql_query("SELECT v.*, c.cru_nombre, d.des_nombre FROM  via v, crucero c, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=c.cru_id AND v.fk_cru_id IS NOT NULL AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL");
						while($row3 = mysql_fetch_array($result3))
						{				
							
							if ($row3["via_id"]==$selected){
								//echo 'if';
								$select_actual3='<option selected="selected" value="'.$row3["via_id"].'">'.$row3["cru_nombre"]."/".$row3["des_nombre"].'</option>'; }	
							else{
								//echo "banco es $banco";
								$select_actual3='<option value="'.$row3["via_id"].'">'.$row3["cru_nombre"]."/".$row3["des_nombre"].'</option>'; 	}	
							$select3=$select3.$select_actual3;
						}
						$panelcuentas->add("bancos",$select3);
						
				        $panelcuentas->add("cue_numero",$nombre);
						$panelcuentas->add("fecha",$fechai);
						$panelcuentas->add("fecha1",$fechaf);
						$panelcuentas->add("des",$desc);
						$panelcuentas->add("dur",$durac);
                         $panelcuentas->add("cue_id",$id);

                       $res=mysql_query("SELECT fk_cru_id FROM  via where via_id=$selected");
						$ro = mysql_fetch_array($res);
						$devuelve=$ro['fk_cru_id'];
						//echo($devuelve);
						
						
					  
					  $result4= mysql_query("SELECT * FROM  flota where fk_cru_id=$devuelve");
								while($row4 = mysql_fetch_array($result4))
								{
								$select_actual4='<option value="'.$row4["flo_id"].'">'.$row4["flo_nombre"].'</option>'; 
								$select4=$select4.$select_actual4;
								}
								$panelcuentas->add("hoteles",$select4);
						
					}
					
					
					
			 
			
			
			
			
			
			
			$panelcuentas->add("tipo_boton",'Modificar');
	        $admin->add("contenido",$panelcuentas);
	        $admin->show();
			
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>