<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_POST);
	extract($_GET);
	      if($cue_numero)
		  {
		  
	;
			  //echo("$cue_numero,$fecha,$fecha1,$millas,$tipopaq,$cantper,$crucero,$ruta");
 
				mysql_query("INSERT INTO `viaje` (`via_id`,`via_tipo` ,`via_tipoviaje` ,`via_fecha_ini`, `via_fecha_fin`,`via_hora_ini`,`via_hora_fin`,`via_millas`, `via_tipo_paq`, `via_cant_per`,`fk_pre_id`, `fk_via_id_origen`, `fk_via_id_destino`, `via_hotel`, `fk_flo_id`) VALUES (NULL ,'Paquete','$cue_numero','$fecha','$fecha1',NULL ,NULL,'$millas','$tipopaq','$cantper',NULL,36,36,NULL,$ruta)");
			    
				$hola='a_paquetes_estadia_crucero.php?mensaje=1';
				header("Location:$hola");

		  
		  }
	      else
		  {
			
			$admin= new Panel("../html/admin.html");
			$admin->add("body",'<body onLoad = "actual(8)" >');
			$panelcuentas = new Panel("../html/a_crear_paquete_estadia_crucero.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/a_crear_paquete_estadia_crucero.php">');
	
	        $select='';
	        $result= mysql_query("SELECT * from crucero");
        	while($row = mysql_fetch_array($result))
        	{
			$select_actual='<option value="'.$row["cru_id"].'">'.$row["cru_nombre"].'</option>'; 		
			$select=$select.$select_actual;
			}
			$panelcuentas->add("cruceros",$select);
			
			
			
			
			
			if ($crucero && $formaviaje && $fechai && $fechaf && $millas && $tipopaq && $cantper && ($ruta=="k"))
			  {
			  
						 $result2= mysql_query("select * from crucero");
								while($row2 = mysql_fetch_array($result2))
								{				
									
									if ($row2["cru_id"]==$crucero){
										//echo 'if';
										$select_actual2='<option selected="selected" value="'.$row2["cru_id"].'">'.$row2["cru_nombre"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual2='<option value="'.$row2["cru_id"].'">'.$row2["cru_nombre"].'</option>'; 	}	
									$select2=$select2.$select_actual2;
								}
								$panelcuentas->add("cruceros",$select2);
								
								$panelcuentas->add("cue_numero",$formaviaje);
								$panelcuentas->add("fecha",$fechai);
								$panelcuentas->add("fecha1",$fechaf);
								$panelcuentas->add("millas",$millas);
								$panelcuentas->add("tipopaq",$tipopaq);
								$panelcuentas->add("cantper",$cantper);
								
						       $result1= mysql_query("SELECT distinct r.fk_flo_id FROM ruta r WHERE fk_flo_id IN (SELECT flo_id FROM flota WHERE fk_cru_id =$crucero)");
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
						$select_actual1='<option value="'.$row1["fk_flo_id"].'">'.$rutax.'</option>'; 
						$select1=$select1.$select_actual1;
						}
						$panelcuentas->add("rutas",$select1);
						
					  
					 
			  
			  }
			  
			  
			  
			  
			/*  
			  if ($crucero && $formaviaje && $fechai && $fechaf && $millas && $tipopaq && $cantper && ($ruta!="k"))
			  {
			  
						  $result2= mysql_query("select * from crucero");
								while($row2 = mysql_fetch_array($result2))
								{				
									
									if ($row2["cru_id"]==$crucero){
										//echo 'if';
										$select_actual2='<option selected="selected" value="'.$row2["cru_id"].'">'.$row2["cru_nombre"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual2='<option value="'.$row2["cru_id"].'">'.$row2["cru_nombre"].'</option>'; 	}	
									$select2=$select2.$select_actual2;
								}
								$panelcuentas->add("cruceros",$select2);
								
								$panelcuentas->add("cue_numero",$formaviaje);
								$panelcuentas->add("fecha",$fechai);
								$panelcuentas->add("fecha1",$fechaf);
								$panelcuentas->add("millas",$millas);
								$panelcuentas->add("tipopaq",$tipopaq);
								$panelcuentas->add("cantper",$cantper);
								
						       $result1= mysql_query("SELECT distinct r.fk_flo_id FROM ruta r WHERE fk_flo_id IN (SELECT flo_id FROM flota WHERE fk_cru_id =$crucero)");
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
						if ($row1["fk_flo_id"]==$ruta){
						$select_actual1='<option selected="selected" value="'.$row1["fk_flo_id"].'">'.$rutax.'</option>'; 
						}
						else
						{
						 $select_actual1='<option value="'.$row1["fk_flo_id"].'">'.$rutax.'</option>'; 
						}
						$select1=$select1.$select_actual1;
						}
						$panelcuentas->add("rutas",$select1);	
						
				       
					  // echo($selected2);
					   $res3=mysql_query("SELECT fk_cru_id FROM  via where via_id=$selected2");
						$ro3 = mysql_fetch_array($res3);
						$devuelve3=$ro3['fk_cru_id'];	
						echo "$devuelve3 dev";
							
						$result4= mysql_query("SELECT ho.flo_nombre, ho.flo_id FROM  flota ho WHERE ho.fk_cru_id=$devuelve3");
						while($row4 = mysql_fetch_array($result4))
						{
						$select_actual4='<option value="'.$row4["flo_id"].'">'.$row4["flo_nombre"].'</option>'; 
						$select4=$select4.$select_actual4;
						}
						$panelcuentas->add("hoteles",$select4);
						
					  
					 
			  
			  }*/
			
			
			
			
			
			
			$panelcuentas->add("tipo_boton",'Agregar');
			//$panelcuentas->add("error",'Ya existe un estadio '.$cue_numero.' andre '.$row["ban_nombre"]);
	        $admin->add("contenido",$panelcuentas);
	        $admin->show();
			
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>