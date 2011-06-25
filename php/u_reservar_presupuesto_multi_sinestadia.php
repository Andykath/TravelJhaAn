<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	//echo("hola");
	
	extract($_POST);
	extract($_GET);
	

	
	      if($a==1)
		  {
		  $ok1=mysql_query("SELECT `pre_abono` FROM  presupuesto WHERE pre_id='$id'");
			                 $rowok1 = mysql_fetch_array($ok1);
		                     $mete1=$rowok1['pre_abono'];
							 //echo($mete1);
	if ($mete1>0){
		  
			
			
			if($cantper==1)
			  {
				  $hola="Solo";}
				 if($cantper==2)
			  {
				  $hola="En pareja";}
				  
				   if($cantper>2)
			  {
				    $hola="En familia";}
			 
			 //echo("$hola,$fecha,$cantper,$id,$origen1,$destino1");
				mysql_query("INSERT INTO `viaje` (`via_id`,`via_tipo`,`via_tipoviaje`,`via_fecha_ini`,`via_fecha_fin`,`via_hora_ini`,`via_hora_fin`,`via_millas`,`via_tipo_paq`,`via_cant_per`,`fk_pre_id`,`fk_via_id_origen`,`fk_via_id_destino`,`fk_flo_id`,`via_compuesto`) VALUES(NULL,'Reserva','$hola','$fecha',null,null,null,NULL,NULL,'$cantper',null,'$origen1','$destino1',null,'$paseo')");

			    
				$hola='u_presupuesto_multi_sinestadia.php?mensaje=1';
				header("Location:$hola");
			  
			  
			  	   }
			
	
	else{
	$hola='u_abono_error_multi_sinestadia.php?mensaje=1';
	header("Location:$hola");
	
	}
		 
		  
		  
		  
		  
	  
		  
		  
		  }
	      else
		  {
			
			$admin= new Panel("../html/usuario.html");
			$admin->add("body",'<body onLoad = "actual(4)" >');
			$panelestadios = new Panel("../html/u_reservar_presupuesto_multi_sinestadia.html");
			$panelestadios->add("form",'<form name="form1" method="post" action="../php/u_reservar_presupuesto_multi_sinestadia.php?a=1&id='.$id.'&cantper='.$cantper.'&origen1='.$origen1.'&fecha='.$fecha.'&destino1='.$destino1.'&paseo='.$paseo.'">');
	
	             $mivariable=$origen1;
				 // echo($mivariable);
				$via=mysql_query("SELECT fk_aer_id, fk_cru_id , fk_ter_id FROM  via where via_id='$mivariable'");
                       while($row = mysql_fetch_array($via))
	                      {
					   $aer = $row[0];
                      $cru=	$row[1];
					  $ter=$row[2];
	                         }
							 
	                 if ($aer)
					 {
						 //echo("entra");
						$via2=mysql_query("SELECT o.des_nombre,d.des_nombre,a.aer_nombre FROM  via v, aerolinea a, destino o, destino d, via f where v.via_id='$origen' AND f.via_id='$destino' and v.fk_aer_id=a.aer_id and v.fk_des_id=o.des_id and f.fk_des_id=d.des_id");
                       while($row1 = mysql_fetch_array($via2))
	                       {
					   $origenh = $row1[0];
                      $destinoh=	$row1[1];
					  $aerh=$row1[2];
	                        }
							$ok=mysql_query("SELECT `pre_abono` FROM  presupuesto WHERE pre_id='$id'");
			                 $rowok = mysql_fetch_array($ok);
		                     $mete=$rowok['pre_abono'];
							 
							 $total1=$total-$mete;
							
						 $panelestadios->add("aerolinea",$aerh);
					$panelestadios->add("origen",$origenh);
					$panelestadios->add("destino",$destinoh);
					$panelestadios->add("fecha",$fechai);
			$panelestadios->add("paseo",$paseo);
					  $panelestadios->add("total",$total1);
					  $panelestadios->add("cantper",$cantper);
					   $panelestadios->add("id",$id);
					   	$panelestadios->add("habitacion",$habitacion);
						$panelestadios->add("tipo_boton",'Reservar');
	    $admin->add("contenido",$panelestadios);
	        $admin->show();	
					  
					
						 
						 }
						 else if ($cru)
						 {
							 $via3=mysql_query("SELECT o.des_nombre,d.des_nombre,a.cru_nombre FROM  via v, crucero a, destino o, destino d, via f where v.via_id='$origen' AND f.via_id='$destino' and v.fk_cru_id=a.cru_id and v.fk_des_id=o.des_id and f.fk_des_id=d.des_id");
                       while($row2 = mysql_fetch_array($via3))
	                       {
					    $origenh = $row2[0];
                      $destinoh=	$row2[1];
					  $cruh=$row2[2];
	                        }
							
							$ok=mysql_query("SELECT `pre_abono` FROM  presupuesto WHERE pre_id='$id'");
			                 $rowok = mysql_fetch_array($ok);
		                     $mete=$rowok['pre_abono'];
							 
							 $total1=$total-$mete;
							 $panelestadios->add("aerolinea",$cruh);
					$panelestadios->add("origen",$origenh);
					$panelestadios->add("destino",$destinoh);
					$panelestadios->add("fecha",$fechai);
					$panelestadios->add("paseo",$paseo);
					  $panelestadios->add("total",$total1);
					  $panelestadios->add("cantper",$cantper);
					   $panelestadios->add("id",$id);
					   	$panelestadios->add("habitacion",$habitacion);
					   	
						$panelestadios->add("tipo_boton",'Reservar');
	    $admin->add("contenido",$panelestadios);
	        $admin->show();	
					   
					 
							 
							 }
							 if ($ter)
							 {
								 $via4=mysql_query("SELECT o.des_nombre,d.des_nombre,a.ter_nombre FROM  via v, terrestre a, destino o, destino d, via f where v.via_id='$origen' AND f.via_id='$destino' and v.fk_ter_id=a.ter_id and v.fk_des_id=o.des_id and f.fk_des_id=d.des_id");
                       while($row3= mysql_fetch_array($via4))
	                       {
					   $origenh = $row3[0];
                      $destinoh=$row3[1];
					  $terh=$row3[2];
	                        }
							
							$ok=mysql_query("SELECT `pre_abono` FROM  presupuesto WHERE pre_id='$id'");
			                 $rowok = mysql_fetch_array($ok);
		                     $mete=$rowok['pre_abono'];
							 
							 $total1=$total-$mete;
							 
							 $panelestadios->add("id",$id);
							 $panelestadios->add("aerolinea",$terh);
					$panelestadios->add("origen",$origenh);
					$panelestadios->add("destino",$destinoh);
					$panelestadios->add("fecha",$fechai);
					$panelestadios->add("paseo",$paseo);
					  $panelestadios->add("total",$total1);
					  $panelestadios->add("cantper",$cantper);
					   $panelestadios->add("id",$id);
					   	$panelestadios->add("habitacion",$habitacion);
					   
					   	$panelestadios->add("tipo_boton",'Reservar');
	    $admin->add("contenido",$panelestadios);
	        $admin->show();	
			
					 
							  
								 
								 }
	                    
			     
				
					
		  }
	
		
	include "../db/cerrar_conexion.php";
?>