<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$cedula=$_SESSION['cedula'];
	 $cant=$_SESSION['cant'];
	extract($_GET);
	extract($_POST);
	//<!--//print_r($_POST); -->
	$locura=$_POST['formapago'];
	//echo($locura);


	
	      
		  if($fechapago || $fechapago1 || $fechapago2)
		  {// aqui validar que los datos esten bien y hacer update
		
		  //echo($fecha);
		   //echo($fecha1);
		    //echo($des);
			 //echo($dur);
			  //echo($fkvia);
	
		//echo($formapago);
		//echo($locura);
		if($formapago=="Pago Unico")
		{
			  
			  $hola='';
			  if($cantper==1)
			  {
				  $hola="Solo";}
				 if($cantper==2)
			  {
				  $hola="En pareja";}
				  
				   if($cantper>2)
			  {
				    $hola="En familia";}
				  	
					
					//echo('entro a insertar');
					//echo($hotel);
				       $res3=mysql_query("SELECT hot_id FROM  hotel where hot_nombre='$hotel'");
						$ro3 = mysql_fetch_array($res3);
						$hotel1=$ro3['hot_id'];	
						//echo "$hotel1 hotel1";
						
						$res4=mysql_query("SELECT ter_id FROM  terrestre where ter_nombre='$aerolinea'");
						$ro4 = mysql_fetch_array($res4);
						$devuelve3=$ro4['ter_id'];	
						//echo "$devuelve3 aerolinea";
						
						$res6=mysql_query("SELECT des_id FROM  destino where des_nombre='$origen'");
						$ro6 = mysql_fetch_array($res6);
						$origen1=$ro6['des_id'];	
						//echo "$origen1 origen1";
						
						$res5=mysql_query("SELECT des_id FROM  destino where des_nombre='$destino'");
						$ro5 = mysql_fetch_array($res5);
						$destino1=$ro5['des_id'];	
						//echo "$destino1 destino1";
						
						$res7=mysql_query("SELECT via_id FROM  via where fk_des_id='$origen1' AND fk_ter_id='$devuelve3'");
						$ro7 = mysql_fetch_array($res7);
						$viaorigen=$ro7['via_id'];	
						//echo "$viaorigen viao";
						
						$res8=mysql_query("SELECT via_id FROM  via where fk_des_id='$destino1' AND fk_ter_id='$devuelve3'");
						$ro8 = mysql_fetch_array($res8);
						$viadestino=$ro8['via_id'];	
						//echo "$viadestino viad";
						//echo "$id , id";
						//echo "$cantper , cantper";
						//echo($alo);
						//echo($fecha1);
						$reschao=mysql_query("SELECT ter_id FROM  terrestre where ter_nombre='$aerolinea'");
						$rochao = mysql_fetch_array($reschao);
						$aerid1=$rochao['ter_id'];	
						
						
						$reshola=mysql_query("SELECT flo_id FROM  flota f where  f.fk_ter_id='$aerid1'");
						$rohola = mysql_fetch_array($reshola);
						$flota1=$rohola['flo_id'];	
			          //echo($flota1);
					  
					  mysql_query("UPDATE `flota` SET  `flo_actual` =(flo_actual-1)  WHERE  `flota`.`flo_id` = $flota1");
					  
					  if($cantper==1)
			  {
				  $hola="Solo";}
				 if($cantper==2)
			  {
				  $hola="En pareja";}
				  
				   if($cantper>2)
			  {
				    $hola="En familia";}
					
					//echo("$fecha,$fecha1,$viaorigen,$viadestino,$flota1,$cantper,$id,$hola");
						
								
mysql_query("INSERT INTO `viaje` (`via_id`,`via_tipo`,`via_tipoviaje`,`via_fecha_ini`,`via_fecha_fin`,`via_hora_ini`,`via_hora_fin`,`via_millas`,`via_tipo_paq`,`via_cant_per`,`fk_pre_id`,`fk_via_id_origen`,`fk_via_id_destino`,`fk_flo_id`) VALUES(NULL,'Viaje','$hola','$fecha','$fecha1','20:40:00','10:00:00',NULL,NULL,'$cantper','$id','$viaorigen','$viadestino','$flota1')");
					
$res11=mysql_query("SELECT via_id FROM  viaje where fk_pre_id='$id'");
$ro11 = mysql_fetch_array($res11);
$viaje=$ro11['via_id'];	
//echo($viaje);

//$Fecha= date('d-m-Y');


//echo($viaje);
			mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$total','2011-06-18',$viaje)");
			//echo($viaje);
			mysql_query("INSERT INTO `estadia` (`est_id`,`est_fecha_ini`,`est_fecha_fin`,`fk_via_id`,`fk_hab_id`) VALUES(NULL,'$fecha','$fecha1','$viaje','$habitacion')");
			
			$resa=mysql_query("SELECT pag_id FROM  pago where fk_via_id='$viaje'");
            $roa = mysql_fetch_array($resa);
            $pago=$roa['pag_id'];		
			//echo($pago);
							//echo($cedula);		
							
					if($tipo=="Tarjeta")
					{
						mysql_query("INSERT INTO `tarjeta` (`tar_id`,`tar_num`,`tar_cvv2`,`tar_nombre`,`tar_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero','$cvv2','$nombre','$fechapago','$cedula','$combo')");
						
					  $resf=mysql_query("SELECT tar_id FROM  tarjeta where tar_num='$numero' AND fk_per_cedula='$cedula'");
                       $rof = mysql_fetch_array($resf);
                       $tarjeta=$rof['tar_id'];		
			           //echo($tarjeta);
					   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago','$tarjeta',NULL,NULL,NULL)");		
						
					}
					
							
					if($tipo=="Cheque")
					{
						mysql_query("INSERT INTO `cheque` (`che_id`,`che_num`,`che_cuenta`,`che_nombre`,`che_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero','$cvv2','$nombre','$fechapago','$cedula','$combo')");
						
						$resg=mysql_query("SELECT che_id FROM  cheque where che_num='$numero'");
                       $rog = mysql_fetch_array($resg);
                       $cheque=$rog['che_id'];		
			           //echo($cheque);	
					   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago',NULL,'$cheque',NULL,NULL)");		
						
					}
					
					if($tipo=="Efectivo")
					{
						mysql_query("INSERT INTO `deposito` (`dep_id`,`dep_numero`,`dep_cuenta`,`dep_fecha`,`fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero','$cvv2','$fechapago','$cedula','$combo')");	
						
						$resh=mysql_query("SELECT dep_id FROM  deposito where dep_numero='$numero'");
                       $roh = mysql_fetch_array($resh);
                       $deposito=$roh['dep_id'];		
			           //echo($deposito);
					   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago',NULL,NULL,'$deposito',NULL)");
						
					}
					
					//$admin= new Panel("../html/usuario.html");
					//$admin->add("body",'<body onLoad = "actual(3)" >');
					//$panelestadios = new Panel("../html/u_presupuesto_comprar_undestino_conestadia_aereo.html");
					//$panelestadios->add("continuar",'<a href="../php/u_continuar_compra_undestino_conestadia_aereo.php?viaje='.$viaje.'&cedula='.$cedula.'&cantper='.$cantper.'">Continuar</a>');
					mysql_query("UPDATE `habitacion` SET  `hab_status` = 'Ocupada' WHERE  `habitacion`.`hab_id` = $habitacion");
					mysql_query("UPDATE `presupuesto` SET  `pre_status` = 'Comprado' WHERE  `presupuesto`.`pre_id` = $id");
					
					
					
					//echo($cantper);
				
					   $hola1='u_continuar_compra_undestino_conestadia_terrestre.php?viaje='.$viaje.'&cantper='.$cantper.'&cedula='.$cedula.'&mensaje=2';
				 header("Location:$hola1");
		}
		else
		{
			
			if ($formapago=='Pago en cuotas' || $formapago=='Pago en Cuotas')
		$verifica=$_POST['monto']+$_POST['monto1']+$_POST['monto2'];
	// echo("entra");
	  //echo $_POST['monto'];
	  // echo "post";
	   //echo $_GET['monto'];
	  // echo "get";
	   
	   //echo($verifica);
	   //echo($total);
	    if($verifica==$total)
	      {
		  $inserto=1;
		  }
		  else
		    {
			$inserto=0;
			}
	
		//echo($inserto);
		
		$montoaux=$_POST['monto'];
					     $montoaux1=$_POST['monto1'];
						   $montoaux2=$_POST['monto2'];
						   
						   	    $fechapagoaux=$_POST['fechapago'];
					   $fechapagoaux1=$_POST['fechapago1'];
					   		    $fechapagoaux2=$_POST['fechapago2'];
								
								$comboaux=$_POST['combo'];
			    $comboaux1=$_POST['combo1'];
				  $comboaux2=$_POST['combo2'];
				  
				    $numeroaux=$_POST['numero'];
					 $numeroaux1=$_POST['numero1'];
					  $numeroaux2=$_POST['numero2'];
					  
					 $nombreaux=$_POST['nombre'];
					 $nombreaux1=$_POST['nombre1'];
					 // $nombreaux2=$_POST['nombre2'];
					  
				
								
										    $cvv2aux=$_POST['cvv2'];
											$cvv2aux1=$_POST['cvv21'];
											$cvv2aux2=$_POST['cvv22'];

		
		
		//echo($inserto);
		if($inserto==1){
						//echo("aqui $comboaux1, $comboaux2,   $fechapagoaux1, $fechapagoaux2, $numeroaux1,  $numeroaux2,   , $nombreaux1,  , $cvv2aux1, $cvv2aux2,  $montoaux1 , $montoaux2 ");
			// cheque y deposito
			//echo("aqui $comboaux1, $comboaux2, $comboaux, $fechapagoaux, $fechapagoaux1, $fechapagoaux2, $numeroaux1,  $numeroaux2, $numeroaux ,  $nombreaux, $nombreaux1,  $nombreaux2, $cvv2aux, $cvv2aux1, $cvv2aux2, $montoaux, $montoaux1 , $montoaux2 ");
			if($comboaux1 && $comboaux2 && $comboaux && $fechapagoaux && $fechapagoaux1 && $fechapagoaux2 && $numeroaux1 && $numeroaux2 && $numeroaux && $nombreaux && $nombreaux1 && $cvv2aux && $cvv2aux1 && $cvv2aux2 && $montoaux && $montoaux1 && $montoaux2) {
				 //echo("if");
                 $res3=mysql_query("SELECT hot_id FROM  hotel where hot_nombre='$hotel'");
						$ro3 = mysql_fetch_array($res3);
						$hotel1=$ro3['hot_id'];	
						//echo "$hotel1 hotel1";
						
						$res4=mysql_query("SELECT ter_id FROM  terrestre where ter_nombre='$aerolinea'");
						$ro4 = mysql_fetch_array($res4);
						$devuelve3=$ro4['ter_id'];	
						//echo "$devuelve3 aerolinea";
						
						$res6=mysql_query("SELECT des_id FROM  destino where des_nombre='$origen'");
						$ro6 = mysql_fetch_array($res6);
						$origen1=$ro6['des_id'];	
						//echo "$origen1 origen1";
						
						$res5=mysql_query("SELECT des_id FROM  destino where des_nombre='$destino'");
						$ro5 = mysql_fetch_array($res5);
						$destino1=$ro5['des_id'];	
						//echo "$destino1 destino1";
						
						$res7=mysql_query("SELECT via_id FROM  via where fk_des_id='$origen1' AND fk_ter_id='$devuelve3'");
						$ro7 = mysql_fetch_array($res7);
						$viaorigen=$ro7['via_id'];	
						//echo "$viaorigen viao";
						
						$res8=mysql_query("SELECT via_id FROM  via where fk_des_id='$destino1' AND fk_ter_id='$devuelve3'");
						$ro8 = mysql_fetch_array($res8);
						$viadestino=$ro8['via_id'];	
						//echo "$viadestino viad";
						//echo "$id , id";
						//echo "$cantper , cantper";
						//echo($alo);
						//echo($fecha1);
						$reschao=mysql_query("SELECT ter_id FROM  terrestre where ter_nombre='$aerolinea'");
						$rochao = mysql_fetch_array($reschao);
						$aerid1=$rochao['ter_id'];	
						
						
						$reshola=mysql_query("SELECT flo_id FROM  flota f where  f.fk_ter_id='$aerid1'");
						$rohola = mysql_fetch_array($reshola);
						$flota1=$rohola['flo_id'];	
			          //echo($flota1);
					  
					  mysql_query("UPDATE `flota` SET  `flo_actual` =(flo_actual-1)  WHERE  `flota`.`flo_id` = $flota1");
				   if($cantper==1)
			  {
				  $hola="Solo";}
				 if($cantper==2)
			  {
				  $hola="En pareja";}
				  
				   if($cantper>2)
			  {
				    $hola="En familia";}
				  
								
				 
				  mysql_query("INSERT INTO `viaje` (`via_id`,`via_tipo`,`via_tipoviaje`,`via_fecha_ini`,`via_fecha_fin`,`via_hora_ini`,`via_hora_fin`,`via_millas`,`via_tipo_paq`,`via_cant_per`,`fk_pre_id`,`fk_via_id_origen`,`fk_via_id_destino`,`fk_flo_id`) VALUES(NULL,'Viaje','$hola','$fecha','$fecha1','20:40:00','10:00:00',NULL,NULL,'$cantper','$id','$viaorigen','$viadestino','$flota1')");
					
$res11=mysql_query("SELECT via_id FROM  viaje where fk_pre_id='$id'");
$ro11 = mysql_fetch_array($res11);
$viaje=$ro11['via_id'];	
//echo($viaje);

mysql_query("INSERT INTO `estadia` (`est_id`,`est_fecha_ini`,`est_fecha_fin`,`fk_via_id`,`fk_hab_id`) VALUES(NULL,'$fecha','$fecha1','$viaje','$habitacion')");

				 
					 mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$montoaux','2011-06-18',$viaje)");
					  mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$montoaux1','2011-06-18',$viaje)");
					   mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$montoaux2','2011-06-18',$viaje)");
					  
				//echo($montoaux);
				//echo($montoaux1);
				//echo($montoaux2);	   
					   
			$resa=mysql_query("SELECT pag_id FROM  pago where fk_via_id='$viaje' AND pag_monto='$montoaux' AND pag_fecha='2011-06-18'");
            $roa = mysql_fetch_array($resa);
            $pago=$roa['pag_id'];		
			//echo($pago);
			//echo("pago");
			$resb=mysql_query("SELECT pag_id FROM  pago where fk_via_id='$viaje' AND pag_monto='$montoaux1' AND pag_fecha='2011-06-18'");
            $rob = mysql_fetch_array($resb);
            $pago1=$rob['pag_id'];		
			//echo($pago1);
			//echo("pago1");
			
			$resc=mysql_query("SELECT pag_id FROM  pago where fk_via_id='$viaje' AND pag_monto='$montoaux2' AND pag_fecha='2011-06-18'");
            $roc = mysql_fetch_array($resc);
            $pago2=$roc['pag_id'];		
			//echo($pago2);
			//echo("pago2");
			
			  
			
					   
					   mysql_query("INSERT INTO `tarjeta` (`tar_id`,`tar_num`,`tar_cvv2`,`tar_nombre`,`tar_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numeroaux','$cvv2aux','$nombreaux','$fechapagoaux','$cedula','$comboaux')");
					
					 $resf=mysql_query("SELECT tar_id FROM  tarjeta where tar_num='$numeroaux' AND fk_per_cedula='$cedula'");
                       $rof = mysql_fetch_array($resf);
                       $tarjeta=$rof['tar_id'];		
			          //echo($tarjeta);
					   
					   mysql_query("INSERT INTO `cheque` (`che_id`,`che_num`,`che_cuenta`,`che_nombre`,`che_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numeroaux1','$cvv2aux1','$nombreaux1','$fechapagoaux1','$cedula','$comboaux1')");
						
						$resg=mysql_query("SELECT che_id FROM  cheque where che_num='$numeroaux1'");
                       $rog = mysql_fetch_array($resg);
                       $cheque=$rog['che_id'];		
			           //echo($cheque);	
					   //echo($cheque);
					   
					   mysql_query("INSERT INTO `deposito` (`dep_id`,`dep_numero`,`dep_cuenta`,`dep_fecha`,`fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numeroaux2','$cvv2aux2','$fechapagoaux2','$cedula','$comboaux2')");	
						
						$resh=mysql_query("SELECT dep_id FROM  deposito where dep_numero='$numeroaux2'");
                       $roh = mysql_fetch_array($resh);
                       $deposito=$roh['dep_id'];		
			           //echo($deposito);
					   //echo($deposito);
					   
					   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago','$tarjeta',NULL,NULL,NULL)");
					   
					    mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago1',NULL,'$cheque',NULL,NULL)");	
					   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago2',NULL,NULL,'$deposito',NULL)");
					    mysql_query("UPDATE `habitacion` SET  `hab_status` = 'Ocupada' WHERE  `habitacion`.`hab_id` = $habitacion");
					mysql_query("UPDATE `presupuesto` SET  `pre_status` = 'Comprado' WHERE  `presupuesto`.`pre_id` = $id");
					   
					  
					   $hola1='u_continuar_compra_undestino_conestadia_terrestre.php?viaje='.$viaje.'&cantper='.$cantper.'&cedula='.$cedula.'&mensaje=2';
				 header("Location:$hola1");
				
					   
			}// if si todos estan llenos
			
			else
			{
				
					if($comboaux1  && $comboaux && $fechapagoaux && $fechapagoaux1  && $numeroaux1 && $numeroaux && $nombreaux && $nombreaux1 && $cvv2aux && $cvv2aux1  && $montoaux && $montoaux1 ) {
				// echo("if el segundo");
                  $res3=mysql_query("SELECT hot_id FROM  hotel where hot_nombre='$hotel'");
						$ro3 = mysql_fetch_array($res3);
						$hotel1=$ro3['hot_id'];	
						//echo "$hotel1 hotel1";
						
						$res4=mysql_query("SELECT ter_id FROM  terrestre where ter_nombre='$aerolinea'");
						$ro4 = mysql_fetch_array($res4);
						$devuelve3=$ro4['ter_id'];	
						//echo "$devuelve3 aerolinea";
						
						$res6=mysql_query("SELECT des_id FROM  destino where des_nombre='$origen'");
						$ro6 = mysql_fetch_array($res6);
						$origen1=$ro6['des_id'];	
						//echo "$origen1 origen1";
						
						$res5=mysql_query("SELECT des_id FROM  destino where des_nombre='$destino'");
						$ro5 = mysql_fetch_array($res5);
						$destino1=$ro5['des_id'];	
						//echo "$destino1 destino1";
						
						$res7=mysql_query("SELECT via_id FROM  via where fk_des_id='$origen1' AND fk_ter_id='$devuelve3'");
						$ro7 = mysql_fetch_array($res7);
						$viaorigen=$ro7['via_id'];	
						//echo "$viaorigen viao";
						
						$res8=mysql_query("SELECT via_id FROM  via where fk_des_id='$destino1' AND fk_ter_id='$devuelve3'");
						$ro8 = mysql_fetch_array($res8);
						$viadestino=$ro8['via_id'];	
						//echo "$viadestino viad";
						//echo "$id , id";
						//echo "$cantper , cantper";
						//echo($alo);
						//echo($fecha1);
						$reschao=mysql_query("SELECT ter_id FROM  terrestre where ter_nombre='$aerolinea'");
						$rochao = mysql_fetch_array($reschao);
						$aerid1=$rochao['ter_id'];	
						
						
						$reshola=mysql_query("SELECT flo_id FROM  flota f where  f.fk_ter_id='$aerid1'");
						$rohola = mysql_fetch_array($reshola);
						$flota1=$rohola['flo_id'];	
			          //echo($flota1);
					  
					  mysql_query("UPDATE `flota` SET  `flo_actual` =(flo_actual-1)  WHERE  `flota`.`flo_id` = $flota1");
				   if($cantper==1)
			  {
				  $hola="Solo";}
				 if($cantper==2)
			  {
				  $hola="En pareja";}
				  
				   if($cantper>2)
			  {
				    $hola="En familia";}
				  
								
				 
				  mysql_query("INSERT INTO `viaje` (`via_id`,`via_tipo`,`via_tipoviaje`,`via_fecha_ini`,`via_fecha_fin`,`via_hora_ini`,`via_hora_fin`,`via_millas`,`via_tipo_paq`,`via_cant_per`,`fk_pre_id`,`fk_via_id_origen`,`fk_via_id_destino`,`fk_flo_id`) VALUES(NULL,'Viaje','$hola','$fecha','$fecha1','20:40:00','10:00:00',NULL,NULL,'$cantper','$id','$viaorigen','$viadestino','$flota1')");
					
$res11=mysql_query("SELECT via_id FROM  viaje where fk_pre_id='$id'");
$ro11 = mysql_fetch_array($res11);
$viaje=$ro11['via_id'];	
//echo($viaje);

mysql_query("INSERT INTO `estadia` (`est_id`,`est_fecha_ini`,`est_fecha_fin`,`fk_via_id`,`fk_hab_id`) VALUES(NULL,'$fecha','$fecha1','$viaje','$habitacion')");

				 
					 mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$montoaux','2011-06-18',$viaje)");
					  mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$montoaux1','2011-06-18',$viaje)");

					  
				//echo($montoaux);
				//echo($montoaux1);
				//echo($montoaux2);	   
					   
			$resa=mysql_query("SELECT pag_id FROM  pago where fk_via_id='$viaje' AND pag_monto='$montoaux' AND pag_fecha='2011-06-18'");
            $roa = mysql_fetch_array($resa);
            $pago=$roa['pag_id'];		
			//echo($pago);
			//echo("pago");
			$resb=mysql_query("SELECT pag_id FROM  pago where fk_via_id='$viaje' AND pag_monto='$montoaux2' AND pag_fecha='2011-06-18'");
            $rob = mysql_fetch_array($resb);
            $pago2=$rob['pag_id'];		
			//echo($pago1);
			//echo("pago1");
			
			 			   mysql_query("INSERT INTO `tarjeta` (`tar_id`,`tar_num`,`tar_cvv2`,`tar_nombre`,`tar_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numeroaux','$cvv2aux','$nombreaux','$fechapagoaux','$cedula','$comboaux')");
					
					 $resf=mysql_query("SELECT tar_id FROM  tarjeta where tar_num='$numeroaux' AND fk_per_cedula='$cedula'");
                       $rof = mysql_fetch_array($resf);
                       $tarjeta=$rof['tar_id'];		
			          //echo($tarjeta);
					  
					  mysql_query("INSERT INTO `cheque` (`che_id`,`che_num`,`che_cuenta`,`che_nombre`,`che_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numeroaux1','$cvv2aux1','$nombreaux1','$fechapagoaux1','$cedula','$comboaux1')");
						
						$resg=mysql_query("SELECT che_id FROM  cheque where che_num='$numeroaux1'");
                       $rog = mysql_fetch_array($resg);
                       $cheque=$rog['che_id'];		
			           //echo($cheque);	
					   //echo($cheque);
					   
					
					   				   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago','$tarjeta',NULL,NULL,NULL)");
					   
					    mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago2',NULL,'$cheque',NULL,NULL)");	
					   

					    mysql_query("UPDATE `habitacion` SET  `hab_status` = 'Ocupada' WHERE  `habitacion`.`hab_id` = $habitacion");
					mysql_query("UPDATE `presupuesto` SET  `pre_status` = 'Comprado' WHERE  `presupuesto`.`pre_id` = $id");
					   
					  
					   $hola1='u_continuar_compra_undestino_conestadia_terrestre.php?viaje='.$viaje.'&cantper='.$cantper.'&cedula='.$cedula.'&mensaje=2';
				 header("Location:$hola1");
				 
				
					   
			}// if solo esta lleno tarjeta y cheque
				// tarjeta y deposito
				if($comboaux2  && $comboaux && $fechapagoaux && $fechapagoaux2  && $numeroaux2 && $numeroaux && $nombreaux  && $cvv2aux && $cvv2aux2  && $montoaux && $montoaux2 ) {
				// echo("if el segundo");
                 $res3=mysql_query("SELECT hot_id FROM  hotel where hot_nombre='$hotel'");
						$ro3 = mysql_fetch_array($res3);
						$hotel1=$ro3['hot_id'];	
						//echo "$hotel1 hotel1";
						
						$res4=mysql_query("SELECT ter_id FROM  terrestre where ter_nombre='$aerolinea'");
						$ro4 = mysql_fetch_array($res4);
						$devuelve3=$ro4['ter_id'];	
						//echo "$devuelve3 aerolinea";
						
						$res6=mysql_query("SELECT des_id FROM  destino where des_nombre='$origen'");
						$ro6 = mysql_fetch_array($res6);
						$origen1=$ro6['des_id'];	
						//echo "$origen1 origen1";
						
						$res5=mysql_query("SELECT des_id FROM  destino where des_nombre='$destino'");
						$ro5 = mysql_fetch_array($res5);
						$destino1=$ro5['des_id'];	
						//echo "$destino1 destino1";
						
						$res7=mysql_query("SELECT via_id FROM  via where fk_des_id='$origen1' AND fk_ter_id='$devuelve3'");
						$ro7 = mysql_fetch_array($res7);
						$viaorigen=$ro7['via_id'];	
						//echo "$viaorigen viao";
						
						$res8=mysql_query("SELECT via_id FROM  via where fk_des_id='$destino1' AND fk_ter_id='$devuelve3'");
						$ro8 = mysql_fetch_array($res8);
						$viadestino=$ro8['via_id'];	
						//echo "$viadestino viad";
						//echo "$id , id";
						//echo "$cantper , cantper";
						//echo($alo);
						//echo($fecha1);
						$reschao=mysql_query("SELECT ter_id FROM  terrestre where ter_nombre='$aerolinea'");
						$rochao = mysql_fetch_array($reschao);
						$aerid1=$rochao['ter_id'];	
						
						
						$reshola=mysql_query("SELECT flo_id FROM  flota f where  f.fk_ter_id='$aerid1'");
						$rohola = mysql_fetch_array($reshola);
						$flota1=$rohola['flo_id'];	
			          //echo($flota1);
					  mysql_query("UPDATE `flota` SET  `flo_actual` =(flo_actual-1)  WHERE  `flota`.`flo_id` = $flota1");
				   if($cantper==1)
			  {
				  $hola="Solo";}
				 if($cantper==2)
			  {
				  $hola="En pareja";}
				  
				   if($cantper>2)
			  {
				    $hola="En familia";}
				  
								
				 
				  mysql_query("INSERT INTO `viaje` (`via_id`,`via_tipo`,`via_tipoviaje`,`via_fecha_ini`,`via_fecha_fin`,`via_hora_ini`,`via_hora_fin`,`via_millas`,`via_tipo_paq`,`via_cant_per`,`fk_pre_id`,`fk_via_id_origen`,`fk_via_id_destino`,`fk_flo_id`) VALUES(NULL,'Viaje','$hola','$fecha','$fecha1','20:40:00','10:00:00',NULL,NULL,'$cantper','$id','$viaorigen','$viadestino','$flota1')");
					
$res11=mysql_query("SELECT via_id FROM  viaje where fk_pre_id='$id'");
$ro11 = mysql_fetch_array($res11);
$viaje=$ro11['via_id'];	
//echo($viaje);

mysql_query("INSERT INTO `estadia` (`est_id`,`est_fecha_ini`,`est_fecha_fin`,`fk_via_id`,`fk_hab_id`) VALUES(NULL,'$fecha','$fecha1','$viaje','$habitacion')");

				 
					 mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$montoaux','2011-06-18',$viaje)");
					  mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$montoaux2','2011-06-18',$viaje)");

					  
				//echo($montoaux);
				//echo($montoaux1);
				//echo($montoaux2);	   
					   
			$resa=mysql_query("SELECT pag_id FROM  pago where fk_via_id='$viaje' AND pag_monto='$montoaux' AND pag_fecha='2011-06-18'");
            $roa = mysql_fetch_array($resa);
            $pago=$roa['pag_id'];		
			//echo($pago);
			//echo("pago");
			$resb=mysql_query("SELECT pag_id FROM  pago where fk_via_id='$viaje' AND pag_monto='$montoaux2' AND pag_fecha='2011-06-18'");
            $rob = mysql_fetch_array($resb);
            $pago2=$rob['pag_id'];		
			//echo($pago1);
			//echo("pago1");
			
			 			   mysql_query("INSERT INTO `tarjeta` (`tar_id`,`tar_num`,`tar_cvv2`,`tar_nombre`,`tar_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numeroaux','$cvv2aux','$nombreaux','$fechapagoaux','$cedula','$comboaux')");
					
					 $resf=mysql_query("SELECT tar_id FROM  tarjeta where tar_num='$numeroaux' AND fk_per_cedula='$cedula'");
                       $rof = mysql_fetch_array($resf);
                       $tarjeta=$rof['tar_id'];		
			          //echo($tarjeta);
					   
					   
					   
					     mysql_query("INSERT INTO `deposito` (`dep_id`,`dep_numero`,`dep_cuenta`,`dep_fecha`,`fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numeroaux2','$cvv2aux2','$fechapagoaux2','$cedula','$comboaux2')");	
						
						$resh=mysql_query("SELECT dep_id FROM  deposito where dep_numero='$numeroaux2'");
                       $roh = mysql_fetch_array($resh);
                       $deposito=$roh['dep_id'];		
			           //echo($deposito);
					   //echo($deposito);
					   
					   
					   				   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago','$tarjeta',NULL,NULL,NULL)");
					   
					    mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago2',NULL,'$deposito',NULL,NULL)");	
					   

					    mysql_query("UPDATE `habitacion` SET  `hab_status` = 'Ocupada' WHERE  `habitacion`.`hab_id` = $habitacion");
					mysql_query("UPDATE `presupuesto` SET  `pre_status` = 'Comprado' WHERE  `presupuesto`.`pre_id` = $id");
					   
					  
					   $hola1='u_continuar_compra_undestino_conestadia_terrestre.php?viaje='.$viaje.'&cantper='.$cantper.'&cedula='.$cedula.'&mensaje=2';
				 header("Location:$hola1");
				 
				
					   
			}// if solo esta lleno tarjeta y deposito
			
			// cheque y deposito
			if($comboaux2  && $comboaux1 && $fechapagoaux1 && $fechapagoaux2  && $numeroaux2 && $numeroaux1 && $nombreaux1  && $cvv2aux1 && $cvv2aux2  && $montoaux1 && $montoaux2 ) {
				 //echo("if el chequedep");
                  $res3=mysql_query("SELECT hot_id FROM  hotel where hot_nombre='$hotel'");
						$ro3 = mysql_fetch_array($res3);
						$hotel1=$ro3['hot_id'];	
						//echo "$hotel1 hotel1";
						
						$res4=mysql_query("SELECT ter_id FROM  terrestre where ter_nombre='$aerolinea'");
						$ro4 = mysql_fetch_array($res4);
						$devuelve3=$ro4['ter_id'];	
						//echo "$devuelve3 aerolinea";
						
						$res6=mysql_query("SELECT des_id FROM  destino where des_nombre='$origen'");
						$ro6 = mysql_fetch_array($res6);
						$origen1=$ro6['des_id'];	
						//echo "$origen1 origen1";
						
						$res5=mysql_query("SELECT des_id FROM  destino where des_nombre='$destino'");
						$ro5 = mysql_fetch_array($res5);
						$destino1=$ro5['des_id'];	
						//echo "$destino1 destino1";
						
						$res7=mysql_query("SELECT via_id FROM  via where fk_des_id='$origen1' AND fk_ter_id='$devuelve3'");
						$ro7 = mysql_fetch_array($res7);
						$viaorigen=$ro7['via_id'];	
						//echo "$viaorigen viao";
						
						$res8=mysql_query("SELECT via_id FROM  via where fk_des_id='$destino1' AND fk_ter_id='$devuelve3'");
						$ro8 = mysql_fetch_array($res8);
						$viadestino=$ro8['via_id'];	
						//echo "$viadestino viad";
						//echo "$id , id";
						//echo "$cantper , cantper";
						//echo($alo);
						//echo($fecha1);
						$reschao=mysql_query("SELECT ter_id FROM  terrestre where ter_nombre='$aerolinea'");
						$rochao = mysql_fetch_array($reschao);
						$aerid1=$rochao['ter_id'];	
						
						
						$reshola=mysql_query("SELECT flo_id FROM  flota f where  f.fk_ter_id='$aerid1'");
						$rohola = mysql_fetch_array($reshola);
						$flota1=$rohola['flo_id'];	
			          //echo($flota1);
					  mysql_query("UPDATE `flota` SET  `flo_actual` =(flo_actual-1)  WHERE  `flota`.`flo_id` = $flota1");
				   if($cantper==1)
			  {
				  $hola="Solo";}
				 if($cantper==2)
			  {
				  $hola="En pareja";}
				  
				   if($cantper>2)
			  {
				    $hola="En familia";}
				  
								
				 
				  mysql_query("INSERT INTO `viaje` (`via_id`,`via_tipo`,`via_tipoviaje`,`via_fecha_ini`,`via_fecha_fin`,`via_hora_ini`,`via_hora_fin`,`via_millas`,`via_tipo_paq`,`via_cant_per`,`fk_pre_id`,`fk_via_id_origen`,`fk_via_id_destino`,`fk_flo_id`) VALUES(NULL,'Viaje','$hola','$fecha','$fecha1','20:40:00','10:00:00',NULL,NULL,'$cantper','$id','$viaorigen','$viadestino','$flota1')");
					
$res11=mysql_query("SELECT via_id FROM  viaje where fk_pre_id='$id'");
$ro11 = mysql_fetch_array($res11);
$viaje=$ro11['via_id'];	
//echo($viaje);

mysql_query("INSERT INTO `estadia` (`est_id`,`est_fecha_ini`,`est_fecha_fin`,`fk_via_id`,`fk_hab_id`) VALUES(NULL,'$fecha','$fecha1','$viaje','$habitacion')");

				 
					 mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$montoaux1','2011-06-18',$viaje)");
					  mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$montoaux2','2011-06-18',$viaje)");

					  
				//echo($montoaux);
				//echo($montoaux1);
				//echo($montoaux2);	   
					   
			$resa=mysql_query("SELECT pag_id FROM  pago where fk_via_id='$viaje' AND pag_monto='$montoaux1' AND pag_fecha='2011-06-18'");
            $roa = mysql_fetch_array($resa);
            $pago1=$roa['pag_id'];		
			//echo($pago);
			//echo("pago");
			$resb=mysql_query("SELECT pag_id FROM  pago where fk_via_id='$viaje' AND pag_monto='$montoaux2' AND pag_fecha='2011-06-18'");
            $rob = mysql_fetch_array($resb);
            $pago2=$rob['pag_id'];		
			//echo($pago1);
			//echo("pago1");
			
			            
					  mysql_query("INSERT INTO `cheque` (`che_id`,`che_num`,`che_cuenta`,`che_nombre`,`che_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numeroaux1','$cvv2aux1','$nombreaux1','$fechapagoaux1','$cedula','$comboaux1')");
						
						$resg=mysql_query("SELECT che_id FROM  cheque where che_num='$numeroaux1'");
                       $rog = mysql_fetch_array($resg);
                       $cheque=$rog['che_id'];		
			           //echo($cheque);	
					   //echo($cheque);
			 			  
					   
					   
					   
					     mysql_query("INSERT INTO `deposito` (`dep_id`,`dep_numero`,`dep_cuenta`,`dep_fecha`,`fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numeroaux2','$cvv2aux2','$fechapagoaux2','$cedula','$comboaux2')");	
						
						$resh=mysql_query("SELECT dep_id FROM  deposito where dep_numero='$numeroaux2'");
                       $roh = mysql_fetch_array($resh);
                       $deposito=$roh['dep_id'];		
			           //echo($deposito);
					   //echo($deposito);
					   
					   
					   				   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago','$cheque',NULL,NULL,NULL)");
					   
					    mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago1',NULL,'$deposito',NULL,NULL)");	
					   

					    mysql_query("UPDATE `habitacion` SET  `hab_status` = 'Ocupada' WHERE  `habitacion`.`hab_id` = $habitacion");
					mysql_query("UPDATE `presupuesto` SET  `pre_status` = 'Comprado' WHERE  `presupuesto`.`pre_id` = $id");
					   
					   $hola1='u_continuar_compra_undestino_conestadia_terrestre.php?viaje='.$viaje.'&cantper='.$cantper.'&cedula='.$cedula.'&mensaje=2';
				 header("Location:$hola1");
				 
				
					   
			}// if solo esta lleno cheque y deposito
			
		
				
				
				}
			
			
					 
					 
					 
					 
			
					 
					 
				
				 }//del if inserto
				 
				 else// si no llego a la totalidad dell monto
				 {
					 if($montoaux && $montoaux1 && $montoaux2)
					 {
						 mysql_query("UPDATE `presupuesto` SET  `pre_abono` = ($montoaux+$montoaux1+$montoaux2) WHERE  `presupuesto`.`pre_id` = $id");
						 
						 }
						 
						 if ($montoaux && $montoaux1 )
						 {
							  mysql_query("UPDATE `presupuesto` SET  `pre_abono` = ($montoaux+$montoaux1) WHERE  `presupuesto`.`pre_id` = $id");
						 
							 }
							 
							  if ($montoaux && $montoaux2 )
						 {
							  mysql_query("UPDATE `presupuesto` SET  `pre_abono` = ($montoaux+$montoaux2) WHERE  `presupuesto`.`pre_id` = $id");
						 
							 }
							 
							  if ($montoaux1 && $montoaux2 )
						 {
							  mysql_query("UPDATE `presupuesto` SET  `pre_abono` = ($montoaux1+$montoaux2) WHERE  `presupuesto`.`pre_id` = $id");
						 
							 }
							 
							 if ($montoaux )
						 {
							  mysql_query("UPDATE `presupuesto` SET  `pre_abono` = $montoaux WHERE  `presupuesto`.`pre_id` = $id");
						 
							 }
							 
							  if ($montoaux1 )
						 {
							  mysql_query("UPDATE `presupuesto` SET  `pre_abono` = $montoaux1 WHERE  `presupuesto`.`pre_id` = $id");
						 
							 }
							 
							  if ($montoaux2 )
						 {
							  mysql_query("UPDATE `presupuesto` SET  `pre_abono` = $montoaux2 WHERE  `presupuesto`.`pre_id` = $id");
						 
							 }
					 
					 
					 } 
			
		
			
			
			}//fin del else de pago cuotas
			
					  
					  
					
			 	
	
		  }
	      else
		  {//aqui pinta el editor por primera vez	
		              
					$admin= new Panel("../html/usuario.html");
					$admin->add("body",'<body onLoad = "actual(3)" >');
					$panelestadios = new Panel("../html/u_presupuesto_comprar_undestino_conestadia_terrestre.html");
					$panelestadios->add("form",'<form name="form1" method="post" action="../php/u_comprar_undestino_conestadia_terrestre.php?id='.$id.'&aerolinea='.$aerolinea.'&origen='.$origen.'&destino='.$destino.'&hotel='.$hotel.'&habitacion='.$habitacion.'&servicio='.$servicio.'&paseo='.$paseo.'&total='.$total.'&cantper='.$cantper.'&tipo='.$tipo.'&fechapago='.$fechapago.'&numero='.$numero.'&combo='.$combo.'&nombre='.$nombre.'&cvv2='.$cvv2.'&monto='.$monto.'&monto1='.$monto1.'&monto2='.$monto2.'">');
					
					//echo($cantper);
					//$panelestadios->add("cue_numero",$tipoviaje);
					$panelestadios->add("fecha",$fechai);
					$panelestadios->add("aerolinea",$aerolinea);
					$panelestadios->add("origen",$origen);
					$panelestadios->add("destino",$destino);
					$panelestadios->add("hotel",$hotel);
					$panelestadios->add("habitacion",$habitacion);
					 $panelestadios->add("servicio",$servicio);
					 $panelestadios->add("paseo",$paseo);
					  $panelestadios->add("total",$total);
					  $panelestadios->add("cantper",$cantper);
					   $panelestadios->add("id",$id);
					  $panelestadios->add("forma",'<option>Pago Unico</option><option>Pago en cuotas</option>');
					
					if ($selected && $fechai && $fechaf)
					{
					
					//$panelestadios->add("cue_numero",$tipoviaje);
					$panelestadios->add("fecha",$fechai);
					$panelestadios->add("aerolinea",$aerolinea);
					$panelestadios->add("origen",$origen);
					$panelestadios->add("destino",$destino);
					$panelestadios->add("hotel",$hotel);
					$panelestadios->add("habitacion",$habitacion);
					 $panelestadios->add("servicio",$servicio);
					 $panelestadios->add("paseo",$paseo);
					  $panelestadios->add("total",$total);
					  $panelestadios->add("cantper",$cantper);
						$panelestadios->add("fecha",$fechai);
							$panelestadios->add("fecha1",$fechaf);
							 $panelestadios->add("id",$id);
							
							
							if ("Pago Unico"==$selected)
							{
									
										$select_actual2='<option selected="selected">Pago Unico</option><option>Pago en cuotas</option>'; }	
						     
							 else if ("Pago en cuotas"==$selected){
								 $select_actual2='<option selected="selected">Pago en Cuotas</option><option>Pago Unico</option>'; }	
								 
								 
		                    $select2=$select2.$select_actual2;
						    $panelestadios->add("forma",$select2);
					}
							
							
			
			if(($selected=="Pago Unico") && $aerolinea && $fechaf && $fechai && $hotel && $habitacion && $origen && $destino && $servicio && $paseo && $total )
				{
					
				$panelestadios->add("cue_numero",$tipoviaje);
					
					$panelestadios->add("aerolinea",$aerolinea);
					$panelestadios->add("origen",$origen);
					$panelestadios->add("destino",$destino);
					$panelestadios->add("hotel",$hotel);
					$panelestadios->add("habitacion",$habitacion);
					 $panelestadios->add("servicio",$servicio);
					 $panelestadios->add("paseo",$paseo);
					  $panelestadios->add("total",$total);
					 $panelestadios->add("cantper",$cantper);
					$panelestadios->add("fecha",$fechai);
					$panelestadios->add("fecha1",$fechaf);
					 $panelestadios->add("id",$id);

					/*$select_actual2='<option selected="selected">Pago Unico</option><option>Pago en cuotas</option>'; 	
					$select2=$select2.$select_actual2;
					 $panelestadios->add("forma",$select2);	*/	
							
					
				$panelestadios->add("pago",' <tr><td>Tipo:</td><td><select name="tipo" id="tipo"  onChange="populate2(document.form1,document.form1.formapago.options[document.form1.formapago.selectedIndex].value,document.form1.fecha.value,document.form1.fecha1.value,document.getElementById(\'aerolinea\').innerHTML,document.getElementById(\'origen\').innerHTML,document.getElementById(\'destino\').innerHTML,document.getElementById(\'hotel\').innerHTML,document.getElementById(\'habitacion\').innerHTML,document.getElementById(\'servicio\').innerHTML,document.getElementById(\'paseo\').innerHTML,document.getElementById(\'total\').innerHTML,document.getElementById(\'cantper\').innerHTML,document.form1.tipo.options[document.form1.tipo.selectedIndex].value,document.getElementById(\'id\').innerHTML)"><option selected="selected">Seleccione</option><option>Tarjeta</option><option>Cheque</option><option>Efectivo</option></select></td></tr>
    ');
				
				
				
				}
				
				
				
				else if(($selected=="Pago en cuotas") && $aerolinea && $fechaf && $fechai && $hotel && $habitacion && $origen && $destino && $servicio && $paseo && $total )
					{
					$panelestadios->add("cue_numero",$tipoviaje);
					
					$panelestadios->add("aerolinea",$aerolinea);
					$panelestadios->add("origen",$origen);
					$panelestadios->add("destino",$destino);
					$panelestadios->add("hotel",$hotel);
					$panelestadios->add("habitacion",$habitacion);
					 $panelestadios->add("servicio",$servicio);
					 $panelestadios->add("paseo",$paseo);
					  $panelestadios->add("total",$total);
					 $panelestadios->add("cantper",$cantper);
					$panelestadios->add("fecha",$fechai);
					$panelestadios->add("fecha1",$fechaf);
					 $panelestadios->add("id",$id);
					 
					 $resultk= mysql_query("SELECT * FROM  banco b");
					while($rowk = mysql_fetch_array($resultk))
					{
		
					$select_actualk='<option value="'.$rowk["ban_id"].'">'.$rowk["ban_nombre"].'</option>'; 		
					
					$selectk=$selectk.$select_actualk;
					}
				//Para la tarjeta
				
				
				$panelestadios->add("inicial",'<tr>
	 <td width="203"><b><u>Informacion para pago con Tarjeta:</u></b></td>
    </tr>');
				$panelestadios->add("combo",' <tr><td>Banco:</td><td><select name="combo" id="combo" ><option selected="selected">Seleccione</option>'.$selectk.'</select></td></tr>');
				
				$panelestadios->add("numero",'<tr>
      <td width="203">Numero de tarjeta:</td>
      <td width="202"><input type="text" name="numero" id="numero" value="{numero}" onKeyPress="return acceptNum(event)"></td>
    </tr>');
	$panelestadios->add("cvv2",'<tr>
      <td width="203">CVV2 (cod seguridad):</td>
      <td width="202"><input type="text" name="cvv2" id="cvv2" value="{cvv2}" onKeyPress="return acceptNum(event)"></td>
    </tr>');
	$panelestadios->add("nombre",'<tr>
      <td width="203">Nombre titular de tarjeta:</td>
      <td width="202"><input type="text" name="nombre" id="nombre" value="{nombre}"></td>
    </tr>');
	$panelestadios->add("fechapago",'<tr>
      <td>Fecha vencimiento:</td>
      <td><input name="fechapago" id="fechapago" type="text" readonly="readonly" value="{fechapago}" ><a href="javascript:NewCssCal(\'fechapago\',\'YYYYMMDD\')"><img src="../js/cal.gif" width="16" height="16" border="0" alt="Seleccione una Fecha"></td>
    </tr>');
	$panelestadios->add("monto",'<tr>
      <td width="203">Monto para esta forma de pago:</td>
      <td width="202"><input type="text" name="monto" id="monto" value="{monto}" onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	//Para cheque
	
				$panelestadios->add("inicial2",'<tr>
	 <td width="203"><b><u>Informacion para Pago con cheque:</u></b></td>
    </tr>');
				$panelestadios->add("combo1",' <tr><td>Banco:</td><td><select name="combo1" id="combo1" ><option selected="selected">Seleccione</option>'.$selectk.'</select></td></tr>');
				
				$panelestadios->add("numero1",'<tr>
      <td width="203">Numero de cheque:</td>
      <td width="202"><input type="text" name="numero1" id="numero1" value="{numero1}" onKeyPress="return acceptNum(event)"></td>
    </tr>');
	$panelestadios->add("cvv21",'<tr>
      <td width="203">Numero de cuenta:</td>
      <td width="202"><input type="text" name="cvv21" id="cvv21" value="{cvv21}" onKeyPress="return acceptNum(event)"></td>
    </tr>');
	$panelestadios->add("nombre1",'<tr>
      <td width="203">Nombre titular del cheque:</td>
      <td width="202"><input type="text" name="nombre1" id="nombre1" value="{nombre1}"></td>
    </tr>');
	$panelestadios->add("fechapago1",'<tr>
      <td>Fecha:</td>
      <td><input name="fechapago1" id="fechapago1" type="text" readonly="readonly" value="{fechapago1}" ><a href="javascript:NewCssCal(\'fechapago1\',\'YYYYMMDD\')"><img src="../js/cal.gif" width="16" height="16" border="0" alt="Seleccione una Fecha"></td>
    </tr>');
	
	$panelestadios->add("monto1",'<tr>
      <td width="203">Monto para esta forma de pago:</td>
      <td width="202"><input type="text" name="monto1" id="monto1" value="{monto1}" onKeyPress="return acceptNum(event)"></td>
    </tr>');
						//Para deposito
						
						$panelestadios->add("inicial3",'<tr>
	  <td width="203"><b><u>Informacion para pago con Deposito:</u></b></td>
    </tr>');
						$panelestadios->add("combo2",' <tr><td>Banco:</td><td><select name="combo2" id="combo2" ><option selected="selected">Seleccione</option>'.$selectk.'</select></td></tr>');
				
	$panelestadios->add("numero2",'<tr>
      <td width="203">Numero de deposito:</td>
      <td width="202"><input type="text" name="numero2" id="numero2" value="{numero2}" onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cvv22",'<tr>
      <td width="203">Numero de cuenta:</td>
      <td width="202"><input type="text" name="cvv22" id="cvv22" value="{cvv22}" onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("fechapago2",'<tr>
      <td>Fecha:</td>
      <td><input name="fechapago2" id="fechapago2" type="text" readonly="readonly" value="{fechapago2}" ><a href="javascript:NewCssCal(\'fechapago2\',\'YYYYMMDD\')"><img src="../js/cal.gif" width="16" height="16" border="0" alt="Seleccione una Fecha"></td>
    </tr>');
	$panelestadios->add("monto2",'<tr>
      <td width="203">Monto para esta forma de pago:</td>
      <td width="202"><input type="text" name="monto2" id="monto2" value="{monto2}" onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	//echo($combo);
						
						
						
						
						
						
						
						
						
						
						}
					
					
					
					
					
					
					//Para el de tarjeta bla bla 
					if(($selected=="Pago Unico") && $aerolinea && $fechaf && $fechai && $hotel && $habitacion && $origen && $destino && $servicio && $paseo && $total && $tipo )
				{
					
				    $panelestadios->add("cue_numero",$tipoviaje);
					
					$panelestadios->add("aerolinea",$aerolinea);
					$panelestadios->add("origen",$origen);
					$panelestadios->add("hotel",$hotel);
					$panelestadios->add("destino",$destino);
					$panelestadios->add("habitacion",$habitacion);
					 $panelestadios->add("servicio",$servicio);
					 $panelestadios->add("paseo",$paseo);
					  $panelestadios->add("total",$total);
					 $panelestadios->add("cantper",$cantper);
					$panelestadios->add("fecha",$fechai);
					$panelestadios->add("fecha1",$fechaf);
					 $panelestadios->add("id",$id);

					
				//aqui van los if
				if ($tipo=="Tarjeta"){
				$panelestadios->add("pago",' <tr><td>Tipo:</td><td><select name="tipo" id="tipo"  onChange="populate2(document.form1,document.form1.formapago.options[document.form1.formapago.selectedIndex].value,document.form1.fecha.value,document.form1.fecha1.value,document.getElementById(\'aerolinea\').innerHTML,document.getElementById(\'origen\').innerHTML,document.getElementById(\'destino\').innerHTML,document.getElementById(\'hotel\').innerHTML,document.getElementById(\'habitacion\').innerHTML,document.getElementById(\'servicio\').innerHTML,document.getElementById(\'paseo\').innerHTML,document.getElementById(\'total\').innerHTML,document.getElementById(\'cantper\').innerHTML,document.form1.tipo.options[document.form1.tipo.selectedIndex].value,document.getElementById(\'id\').innerHTML)"><option>Seleccione</option><option  selected="selected">Tarjeta</option><option>Cheque</option><option>Efectivo</option></select></td></tr>
    ');
	
				$resultk= mysql_query("SELECT * FROM  banco b");
					while($rowk = mysql_fetch_array($resultk))
					{
		
					$select_actualk='<option value="'.$rowk["ban_id"].'">'.$rowk["ban_nombre"].'</option>'; 		
					
					$selectk=$selectk.$select_actualk;
					}
				
				
				$panelestadios->add("combo",' <tr><td>Banco:</td><td><select name="combo" id="combo" ><option selected="selected">Seleccione</option>'.$selectk.'</select></td></tr>');
				
				$panelestadios->add("numero",'<tr>
      <td width="203">Numero de tarjeta:</td>
      <td width="202"><input type="text" name="numero" id="numero" value="{numero}" onKeyPress="return acceptNum(event)"></td>
    </tr>');
	$panelestadios->add("cvv2",'<tr>
      <td width="203">CVV2 (cod seguridad):</td>
      <td width="202"><input type="text" name="cvv2" id="cvv2" value="{cvv2}" onKeyPress="return acceptNum(event)"></td>
    </tr>');
	$panelestadios->add("nombre",'<tr>
      <td width="203">Nombre titular de tarjeta:</td>
      <td width="202"><input type="text" name="nombre" id="nombre" value="{nombre}"></td>
    </tr>');
	$panelestadios->add("fechapago",'<tr>
      <td>Fecha vencimiento:</td>
      <td><input name="fechapago" id="fechapago" type="text" readonly="readonly" value="{fechapago}" ><a href="javascript:NewCssCal(\'fechapago\',\'YYYYMMDD\')"><img src="../js/cal.gif" width="16" height="16" border="0" alt="Seleccione una Fecha"></td>
    </tr>');
	
				}
	
	
	if ($tipo=="Cheque"){
				$panelestadios->add("pago",' <tr><td>Tipo:</td><td><select name="tipo" id="tipo"  onChange="populate2(document.form1,document.form1.formapago.options[document.form1.formapago.selectedIndex].value,document.form1.fecha.value,document.form1.fecha1.value,document.getElementById(\'aerolinea\').innerHTML,document.getElementById(\'origen\').innerHTML,document.getElementById(\'destino\').innerHTML,document.getElementById(\'hotel\').innerHTML,document.getElementById(\'habitacion\').innerHTML,document.getElementById(\'servicio\').innerHTML,document.getElementById(\'paseo\').innerHTML,document.getElementById(\'total\').innerHTML,document.getElementById(\'cantper\').innerHTML,document.form1.tipo.options[document.form1.tipo.selectedIndex].value,document.getElementById(\'id\').innerHTML)"><option>Seleccione</option><option>Tarjeta</option><option selected="selected">Cheque</option><option>Efectivo</option></select></td></tr>
    ');
	
				$resultk= mysql_query("SELECT * FROM  banco b");
					while($rowk = mysql_fetch_array($resultk))
					{
		
					$select_actualk='<option value="'.$rowk["ban_id"].'">'.$rowk["ban_nombre"].'</option>'; 		
					
					$selectk=$selectk.$select_actualk;
					}
				
				
				$panelestadios->add("combo",' <tr><td>Banco:</td><td><select name="combo" id="combo" ><option selected="selected">Seleccione</option>'.$selectk.'</select></td></tr>');
				
				$panelestadios->add("numero",'<tr>
      <td width="203">Numero de cheque:</td>
      <td width="202"><input type="text" name="numero" id="numero" value="{numero}" onKeyPress="return acceptNum(event)"></td>
    </tr>');
	$panelestadios->add("cvv2",'<tr>
      <td width="203">Numero de cuenta:</td>
      <td width="202"><input type="text" name="cvv2" id="cvv2" value="{cvv2}" onKeyPress="return acceptNum(event)"></td>
    </tr>');
	$panelestadios->add("nombre",'<tr>
      <td width="203">Nombre titular del cheque:</td>
      <td width="202"><input type="text" name="nombre" id="nombre" value="{nombre}"></td>
    </tr>');
	$panelestadios->add("fechapago",'<tr>
      <td>Fecha:</td>
      <td><input name="fechapago" id="fechapago" type="text" readonly="readonly" value="{fechapago}" ><a href="javascript:NewCssCal(\'fechapago\',\'YYYYMMDD\')"><img src="../js/cal.gif" width="16" height="16" border="0" alt="Seleccione una Fecha"></td>
    </tr>');
	
				}
	
	if ($tipo=="Efectivo"){
				$panelestadios->add("pago",' <tr><td>Tipo:</td><td><select name="tipo" id="tipo"  onChange="populate2(document.form1,document.form1.formapago.options[document.form1.formapago.selectedIndex].value,document.form1.fecha.value,document.form1.fecha1.value,document.getElementById(\'aerolinea\').innerHTML,document.getElementById(\'origen\').innerHTML,document.getElementById(\'destino\').innerHTML,document.getElementById(\'hotel\').innerHTML,document.getElementById(\'habitacion\').innerHTML,document.getElementById(\'servicio\').innerHTML,document.getElementById(\'paseo\').innerHTML,document.getElementById(\'total\').innerHTML,document.getElementById(\'cantper\').innerHTML,document.form1.tipo.options[document.form1.tipo.selectedIndex].value,document.getElementById(\'id\').innerHTML)"><option>Seleccione</option><option>Tarjeta</option><option>Cheque</option><option selected="selected">Efectivo</option></select></td></tr>
    ');
	
				$resultk= mysql_query("SELECT * FROM  banco b");
					while($rowk = mysql_fetch_array($resultk))
					{
		
					$select_actualk='<option value="'.$rowk["ban_id"].'">'.$rowk["ban_nombre"].'</option>'; 		
					
					$selectk=$selectk.$select_actualk;
					}
				
				
				$panelestadios->add("combo",' <tr><td>Banco:</td><td><select name="combo" id="combo" ><option selected="selected">Seleccione</option>'.$selectk.'</select></td></tr>');
				
	$panelestadios->add("numero",'<tr>
      <td width="203">Numero de deposito:</td>
      <td width="202"><input type="text" name="numero" id="numero" value="{numero}" onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cvv2",'<tr>
      <td width="203">Numero de cuenta:</td>
      <td width="202"><input type="text" name="cvv2" id="cvv2" value="{cvv2}" onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("fechapago",'<tr>
      <td>Fecha:</td>
      <td><input name="fechapago" id="fechapago" type="text" readonly="readonly" value="{fechapago}" ><a href="javascript:NewCssCal(\'fechapago\',\'YYYYMMDD\')"><img src="../js/cal.gif" width="16" height="16" border="0" alt="Seleccione una Fecha"></td>
    </tr>');
	
				}
	
	
	
	
			}
				
					
					
					
					//echo($tipo);
					$panelestadios->add("tipo_boton",'Procesar');
					$admin->add("contenido",$panelestadios);
					$admin->show();
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>