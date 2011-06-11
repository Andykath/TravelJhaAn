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
				
			    
				$hola='a_promociones_estadia_terrestre.php?mensaje=1';
				header("Location:$hola");

		  
		  
		  }
	      else // aqui cargo por primera vez 
		  {
			
			$admin= new Panel("../html/admin.html");
			$admin->add("body",'<body onLoad = "actual(9)" >');
			$panelcuentas = new Panel("../html/a_modificar_promocion_estadia_terrestre.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/a_modificar_promocion_estadia_terrestre2.php">');
	        // aqui cargo el primer combo, despues necesito cargar el de hoteles con la tabla hotel de acuerdo a la habitacion que tenga que se llama habi en el html
	        $select='';
	        $result= mysql_query("SELECT v.*, t.ter_nombre, d.des_nombre FROM  via v, terrestre t, destino d WHERE v.fk_des_id=d.des_id AND v.fk_ter_id=t.ter_id AND v.fk_ter_id IS NOT NULL AND v.fk_cru_id IS NULL AND v.fk_aer_id IS NULL");
        	while($row = mysql_fetch_array($result))
        	{
			$select_actual='<option value="'.$row["via_id"].'">'.$row["ter_nombre"]."/".$row["des_nombre"].'</option>'; 		
			$select=$select.$select_actual;
			}
			$panelcuentas->add("bancos",$select);
			
			//echo "$selected, $nombre, $fechai, $fechaf, $desc, $durac";
			if ($selected && $nombre && $fechai && $fechaf && $desc && $durac && ($hotel=="k") && $id)
					{
					
						$result2= mysql_query("SELECT v.*, t.ter_nombre, d.des_nombre FROM  via v, terrestre t, destino d WHERE v.fk_des_id=d.des_id AND v.fk_ter_id=t.ter_id AND v.fk_ter_id IS NOT NULL AND v.fk_cru_id IS NULL AND v.fk_aer_id IS NULL");
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
						
				        $panelcuentas->add("cue_numero",$nombre);
						$panelcuentas->add("fecha",$fechai);
						$panelcuentas->add("fecha1",$fechaf);
						$panelcuentas->add("des",$desc);
						$panelcuentas->add("dur",$durac);
                         $panelcuentas->add("cue_id",$id);

                        $res=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected");
						$ro = mysql_fetch_array($res);
						$devuelve=$ro['fk_des_id'];
						
						$result1= mysql_query("SELECT * FROM  hotel where fk_des_id=$devuelve");
						while($row1 = mysql_fetch_array($result1))
						{
						$select_actual1='<option value="'.$row1["hot_id"].'">'.$row1["hot_nombre"].'</option>'; 
						$select1=$select1.$select_actual1;
						}
						$panelcuentas->add("hoteles",$select1);
						
					}
					
					
					
			  
			
			
			
			
			
			
			
			
			
			$panelcuentas->add("tipo_boton",'Modificar');
	        $admin->add("contenido",$panelcuentas);
	        $admin->show();
			
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>