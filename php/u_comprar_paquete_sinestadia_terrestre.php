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


	
	      
		  if($fechapago || $fechapago1 || $fechapago2 || $monto4)
		  {// aqui validar que los datos esten bien y hacer update
		  $reschaot=mysql_query("SELECT ter_id FROM  terrestre where ter_nombre='$aerolinea'");
							$rochaot = mysql_fetch_array($reschaot);
							$aerid10=$rochaot['ter_id'];	
							$resholat=mysql_query("SELECT flo_actual FROM  flota f  where  f.fk_ter_id='$aerid10' and (flo_actual>0)");
							$roholat = mysql_fetch_array($resholat);
							$flota10=$roholat[0];
	$confirma=mysql_query("SELECT SUM(f.flo_actual) as s FROM flota f where f.fk_aer_id='$aerid10'");
							$rochaot1 = mysql_fetch_array($confirma);
							$sumando=$rochaot1['s'];	
							//echo($sumando);
	
			if (($flota10>0) && ($sumando>=$cantper))

		{
		  
		  $habi3=mysql_query("SELECT via_tipo_paq FROM viaje  where via_id='$id'");
					$rohabi3 = mysql_fetch_array($habi3);
				    $jotel=$rohabi3['via_tipo_paq'];
						
		
                   
		if ($jotel=='Turistico')
		{
                    
					
					
					 $montoaux4=$_POST['monto4'];
    
			// echo("entra");
			 //echo($jotel);
             
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
						$reschao=mysql_query("SELECT ter_id FROM terrestre where ter_nombre='$aerolinea'");
						$rochao = mysql_fetch_array($reschao);
						$aerid1=$rochao['ter_id'];	
						
						
						$reshola=mysql_query("SELECT flo_id FROM  flota f , viaje v where  f.fk_ter_id='$aerid1' and (f.flo_actual>0)");
						$rohola = mysql_fetch_array($reshola);
						$flota1=$rohola['flo_id'];	
			          //echo($flota1);
					  
					  mysql_query("UPDATE `flota` SET  `flo_actual` =(flo_actual-$cantper)  WHERE  `flota`.`flo_id` = $flota1");
					  
					  if($cantper==1)
			  {
				  $hola="Solo";}
				 if($cantper==2)
			  {
				  $hola="En pareja";}
				  
				   if($cantper>2)
			  {
				    $hola="En familia";}
					//echo("")
$result6= mysql_query("SELECT c.cos_hora FROM  costo c WHERE c.fk_via_origen=$viaorigen AND c.fk_via_destino=$viadestino");
$row6 = mysql_fetch_array($result6);
$horita=$row6['cos_hora'];								
mysql_query("INSERT INTO `viaje` (`via_id`,`via_tipo`,`via_tipoviaje`,`via_fecha_ini`,`via_fecha_fin`,`via_hora_ini`,`via_hora_fin`,`via_millas`,`via_tipo_paq`,`via_cant_per`,`fk_pre_id`,`fk_via_id_origen`,`fk_via_id_destino`,`fk_flo_id`,`via_hotel`) VALUES(NULL,'Viaje','$hola','$fecha','$fecha1','$horita','10:00:00',NULL,NULL,'$cantper',null,'$viaorigen','$viadestino','$flota1',null)");
					
$resc3=mysql_query("SELECT MAX(via_id) AS max  FROM viaje");
			$roc3 = mysql_fetch_array($resc3);
		    $viaje=$roc3['max'];
//echo($viaje);

//$Fecha= date('d-m-Y');

 $millas=mysql_query("SELECT via_millas FROM  via v where  via_id='$viadestino'");
						$romillas = mysql_fetch_array($millas);
						$millitas=$romillas['via_millas'];
						//echo($millitas);
						
					$millas2=mysql_query("SELECT per_cant_millas FROM  persona  where  per_cedula='$cedula'");
						$romillas2 = mysql_fetch_array($millas2);
						$actualmi=$romillas2['per_cant_millas'];	
					//echo($actualmi);
						
				 mysql_query("UPDATE `persona` SET  `per_cant_millas` = ($actualmi+$millitas) WHERE  `persona`.`per_cedula` = '$cedula'");	


//echo($viaje);
			mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$total','2011-06-18',$viaje)");
			//echo($viaje);
			
			
			$resa=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$roa = mysql_fetch_array($resa);
		    $pago=$roa['max'];
			
			
			
			
			
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
					
					if($tipo=="Millas")
					{
						//echo("entramil");
					
						mysql_query("INSERT INTO `milla` (`mil_id`,`fk_per_cedula`,`mil_cant`) VALUES(NULL,'$cedula','$montoaux4')");	
						
						
			$resa1=mysql_query("SELECT MAX(mil_id) AS max  FROM  milla");
			$roa1 = mysql_fetch_array($resa1);
		    $milla45=$roa1['max'];
			
					   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago',NULL,NULL,NULL,'$milla45')");
						
					}
					
					//$admin= new Panel("../html/usuario.html");
					//$admin->add("body",'<body onLoad = "actual(3)" >');
					//$panelestadios = new Panel("../html/u_presupuesto_comprar_undestino_conestadia_aereo.html");
					//$panelestadios->add("continuar",'<a href="../php/u_continuar_compra_undestino_conestadia_aereo.php?viaje='.$viaje.'&cedula='.$cedula.'&cantper='.$cantper.'">Continuar</a>');
					
					 mysql_query("UPDATE `persona` SET  `per_cant_millas` = ($actualmi-$montoaux4) WHERE  `persona`.`per_cedula` = '$cedula'");	
					  mysql_query("UPDATE `presupuesto` SET  `pre_status` ='Comprado' WHERE  `presupuesto`.`fk_per_cedula` = '$cedula' and  `presupuesto`.`pre_paq` = '$id'");	
					 
					 		  
				 $hola1='u_continuar_compra_undestino_conestadia_terrestre.php?viaje='.$viaje.'&cantper='.$cantper.'&cedula='.$cedula.'&mensaje=2&preg='.$preg.'';
				 header("Location:$hola1");// esta bien 
					
					
					
					//echo($cantper);
					
				
		}
		else
		{
			
			if ($formapago=='Pago en cuotas' || $formapago=='Pago en Cuotas')
			$t=$habitacion-$montoaux4;
			$falta=$t*3;
			
		$verifica=$_POST['monto']+$_POST['monto1']+$_POST['monto2'];
	// echo("entra");
	  //echo $_POST['monto'];
	  // echo "post";
	   //echo $_GET['monto'];
	  // echo "get";
	   
	  //echo($verifica);
	   //echo($total);
	   
	   $resg1=mysql_query("SELECT `pre_abono` FROM  presupuesto where pre_paq='$id' and fk_per_cedula='$cedula'");
                       $rog1 = mysql_fetch_array($resg1);
                       $abono1=$rog1['pre_abono'];
					   $suma=$abono1+$verifica;
					   //echo($suma);
					   		
	    if($verifica==$total)
	      {
		  $inserto=1;
		  }
		  else
		    {
			$inserto=0;
			}
	//echo("entra a cuotas");
		//echo($inserto);
		
		$montoaux=$_POST['monto'];
					     $montoaux1=$_POST['monto1'];
						   $montoaux2=$_POST['monto2'];
						   $montoaux3=$_POST['monto3'];
						   $montoaux4=$_POST['monto4'];
						   
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

			
			if($comboaux1 && $comboaux2 && $comboaux && $fechapagoaux && $fechapagoaux1 && $fechapagoaux2 && $numeroaux1 && $numeroaux2 && $numeroaux && $nombreaux && $nombreaux1 && $cvv2aux && $cvv2aux1 && $cvv2aux2 && $montoaux && $montoaux1 && $montoaux2 ) {
				// echo("if");
                
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
						$reschao=mysql_query("SELECT ter_id FROM terrestre where ter_nombre='$aerolinea'");
						$rochao = mysql_fetch_array($reschao);
						$aerid1=$rochao['ter_id'];	
						
						
						$reshola=mysql_query("SELECT flo_id FROM  flota f , viaje v where  f.fk_ter_id='$aerid1' and (f.flo_actual>0)");
						$rohola = mysql_fetch_array($reshola);
						$flota1=$rohola['flo_id'];	
			          //echo($flota1);
					  
					  mysql_query("UPDATE `flota` SET  `flo_actual` =(flo_actual-$cantper)  WHERE  `flota`.`flo_id` = $flota1");
				   if($cantper==1)
			  {
				  $hola="Solo";}
				 if($cantper==2)
			  {
				  $hola="En pareja";}
				  
				   if($cantper>2)
			  {
				    $hola="En familia";}
				  
$result6= mysql_query("SELECT c.cos_hora FROM  costo c WHERE c.fk_via_origen=$viaorigen AND c.fk_via_destino=$viadestino");
$row6 = mysql_fetch_array($result6);
$horita=$row6['cos_hora'];								
				 
				mysql_query("INSERT INTO `viaje` (`via_id`,`via_tipo`,`via_tipoviaje`,`via_fecha_ini`,`via_fecha_fin`,`via_hora_ini`,`via_hora_fin`,`via_millas`,`via_tipo_paq`,`via_cant_per`,`fk_pre_id`,`fk_via_id_origen`,`fk_via_id_destino`,`fk_flo_id`,`via_hotel`) VALUES(NULL,'Viaje','$hola','$fecha','$fecha1','$horita','10:00:00',NULL,NULL,'$cantper',null,'$viaorigen','$viadestino','$flota1',null)");
					
$resc3=mysql_query("SELECT MAX(via_id) AS max  FROM viaje");
			$roc3 = mysql_fetch_array($resc3);
		    $viaje=$roc3['max'];
//echo($viaje);

//$Fecha= date('d-m-Y');

 $millas=mysql_query("SELECT via_millas FROM  via v where  via_id='$viadestino'");
						$romillas = mysql_fetch_array($millas);
						$millitas=$romillas['via_millas'];
						//echo($millitas);
						
					$millas2=mysql_query("SELECT per_cant_millas FROM  persona  where  per_cedula='$cedula'");
						$romillas2 = mysql_fetch_array($millas2);
						$actualmi=$romillas2['per_cant_millas'];	
					//echo($actualmi);
						
				 mysql_query("UPDATE `persona` SET  `per_cant_millas` = ($actualmi+$millitas) WHERE  `persona`.`per_cedula` = '$cedula'");	


//echo($viaje);
			mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto','2011-06-18',$viaje)");
			//echo($viaje);
		
			
			$resa=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$roa = mysql_fetch_array($resa);
		    $pago=$roa['max'];
			
			//echo($pago);
			//echo("pago");
			 mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto1','2011-06-18',$viaje)");
			 
				$resb=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$rob = mysql_fetch_array($resb);
		    $pago1=$rob['max'];
			
			
			//echo($pago1);
			//echo("pago1");
			   mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto2','2011-06-18',$viaje)");
			
				$resc=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$roc = mysql_fetch_array($resc);
		    $pago2=$roc['max'];
			
			 
		//	echo($pago2);
			//echo("pago2");
			
			  
			
					   
					   mysql_query("INSERT INTO `tarjeta` (`tar_id`,`tar_num`,`tar_cvv2`,`tar_nombre`,`tar_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero','$cvv2','$nombre','$fechapago','$cedula','$combo')");
					
					 $resf=mysql_query("SELECT tar_id FROM  tarjeta where tar_num='$numero' AND fk_per_cedula='$cedula'");
                       $rof = mysql_fetch_array($resf);
                       $tarjeta=$rof['tar_id'];		
			          //echo($tarjeta);
					   
					   mysql_query("INSERT INTO `cheque` (`che_id`,`che_num`,`che_cuenta`,`che_nombre`,`che_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero1','$cvv21','$nombre1','$fechapago1','$cedula','$combo1')");
						
						$resg=mysql_query("SELECT che_id FROM  cheque where che_num='$numero1'");
                       $rog = mysql_fetch_array($resg);
                       $cheque=$rog['che_id'];		
			           //echo($cheque);	
					   //echo($cheque);
					   
					   mysql_query("INSERT INTO `deposito` (`dep_id`,`dep_numero`,`dep_cuenta`,`dep_fecha`,`fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero2','$cvv22','$fechapago2','$cedula','$combo2')");	
						
						$resh=mysql_query("SELECT dep_id FROM  deposito where dep_numero='$numero2'");
                       $roh = mysql_fetch_array($resh);
                       $deposito=$roh['dep_id'];		
			           //echo($deposito);
					   //echo($deposito);
					   
					 
			
					   
					   
					   
					   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago','$tarjeta',NULL,NULL,NULL)");
					   
					    mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago1',NULL,'$cheque',NULL,NULL)");	
					   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago2',NULL,NULL,'$deposito',NULL)");
					   
					    
								
				 mysql_query("UPDATE `presupuesto` SET  `pre_status` ='Comprado' WHERE  `presupuesto`.`fk_per_cedula` = '$cedula' and `presupuesto`.`pre_paq` = '$id' ");	
					
						
					   
					   $hola1='u_continuar_compra_undestino_sinestadia_terrestre.php?viaje='.$viaje.'&cantper='.$cantper.'&cedula='.$cedula.'&mensaje=2&preg='.$preg.'';
				 header("Location:$hola1");// esta bien 
				 
				
					   
			}// if si estan tar cheque deposito
			

			
			
			
			
			
			else
			{
				
					if($comboaux1  && $comboaux && $fechapagoaux && $fechapagoaux1  && $numeroaux1 && $numeroaux && $nombreaux && $nombreaux1 && $cvv2aux && $cvv2aux1  && $montoaux && $montoaux1 ) {
				// echo("if el segundo");
                 
						
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
						$reschao=mysql_query("SELECT ter_id FROM terrestre where ter_nombre='$aerolinea'");
						$rochao = mysql_fetch_array($reschao);
						$aerid1=$rochao['ter_id'];	
						
						
						$reshola=mysql_query("SELECT flo_id FROM  flota f , viaje v where  f.fk_ter_id='$aerid1' and (f.flo_actual>0)");
						$rohola = mysql_fetch_array($reshola);
						$flota1=$rohola['flo_id'];	
			          //echo($flota1);
					  
					  mysql_query("UPDATE `flota` SET  `flo_actual` =(flo_actual-$cantper)  WHERE  `flota`.`flo_id` = $flota1");
				   if($cantper==1)
			  {
				  $hola="Solo";}
				 if($cantper==2)
			  {
				  $hola="En pareja";}
				  
				   if($cantper>2)
			  {
				    $hola="En familia";}
				  
$result6= mysql_query("SELECT c.cos_hora FROM  costo c WHERE c.fk_via_origen=$viaorigen AND c.fk_via_destino=$viadestino");
$row6 = mysql_fetch_array($result6);
$horita=$row6['cos_hora'];								
		mysql_query("INSERT INTO `viaje` (`via_id`,`via_tipo`,`via_tipoviaje`,`via_fecha_ini`,`via_fecha_fin`,`via_hora_ini`,`via_hora_fin`,`via_millas`,`via_tipo_paq`,`via_cant_per`,`fk_pre_id`,`fk_via_id_origen`,`fk_via_id_destino`,`fk_flo_id`,`via_hotel`) VALUES(NULL,'Viaje','$hola','$fecha','$fecha1','$horita','10:00:00',NULL,NULL,'$cantper',null,'$viaorigen','$viadestino','$flota1',null)");
					
$resc3=mysql_query("SELECT MAX(via_id) AS max  FROM viaje");
			$roc3 = mysql_fetch_array($resc3);
		    $viaje=$roc3['max'];
//echo($viaje);

//$Fecha= date('d-m-Y');

 $millas=mysql_query("SELECT via_millas FROM  via v where  via_id='$viadestino'");
						$romillas = mysql_fetch_array($millas);
						$millitas=$romillas['via_millas'];
						//echo($millitas);
						
					$millas2=mysql_query("SELECT per_cant_millas FROM  persona  where  per_cedula='$cedula'");
						$romillas2 = mysql_fetch_array($millas2);
						$actualmi=$romillas2['per_cant_millas'];	
					//echo($actualmi);
						
				 mysql_query("UPDATE `persona` SET  `per_cant_millas` = ($actualmi+$millitas) WHERE  `persona`.`per_cedula` = '$cedula'");	


//echo($viaje);
			mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto','2011-06-18',$viaje)");
			//echo($viaje);
			
			
			
			$resa=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$roa = mysql_fetch_array($resa);
		    $pago=$roa['max'];
			
			
			//echo($pago);
			//echo("pago");
			  mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto1','2011-06-18',$viaje)");
				$resb=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$rob = mysql_fetch_array($resb);
		    $pago1=$rob['max'];
			
			
			//echo($pago1);
			//echo("pago1");
			
			
			 			   mysql_query("INSERT INTO `tarjeta` (`tar_id`,`tar_num`,`tar_cvv2`,`tar_nombre`,`tar_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero','$cvv2','$nombre','$fechapago','$cedula','$combo')");
					
					 $resf=mysql_query("SELECT tar_id FROM  tarjeta where tar_num='$numero' AND fk_per_cedula='$cedula'");
                       $rof = mysql_fetch_array($resf);
                       $tarjeta=$rof['tar_id'];		
			          //echo($tarjeta);
					  
					  mysql_query("INSERT INTO `cheque` (`che_id`,`che_num`,`che_cuenta`,`che_nombre`,`che_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero1','$cvv21','$nombre1','$fechapago1','$cedula','$combo1')");
						
						$resg=mysql_query("SELECT che_id FROM  cheque where che_num='$numero1'");
                       $rog = mysql_fetch_array($resg);
                       $cheque=$rog['che_id'];		
			           //echo($cheque);	
					   //echo($cheque);
					   
					
					   				   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago','$tarjeta',NULL,NULL,NULL)");
					   
					    mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago1',NULL,'$cheque',NULL,NULL)");	
					   

					    
						 mysql_query("UPDATE `presupuesto` SET  `pre_status` ='Comprado' WHERE  `presupuesto`.`fk_per_cedula` = '$cedula' and  `presupuesto`.`pre_paq` = '$id'");	
					 
					
					   
					   $hola1='u_continuar_compra_undestino_conestadia_terrestre.php?viaje='.$viaje.'&cantper='.$cantper.'&cedula='.$cedula.'&mensaje=2&preg='.$preg.'';
				 header("Location:$hola1");
				 
				
					   
			}// if solo esta lleno tarjeta y cheque
				// tarjeta y deposito
				if($comboaux2  && $comboaux && $fechapagoaux && $fechapagoaux2  && $numeroaux2 && $numeroaux && $nombreaux  && $cvv2aux && $cvv2aux2  && $montoaux && $montoaux2 ) {
				// echo("if el segundo");
                 
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
						$reschao=mysql_query("SELECT ter_id FROM terrestre where ter_nombre='$aerolinea'");
						$rochao = mysql_fetch_array($reschao);
						$aerid1=$rochao['ter_id'];	
						
						
						$reshola=mysql_query("SELECT flo_id FROM  flota f , viaje v where  f.fk_ter_id='$aerid1' and (f.flo_actual>0)");
						$rohola = mysql_fetch_array($reshola);
						$flota1=$rohola['flo_id'];	
			          //echo($flota1);
					  
					  mysql_query("UPDATE `flota` SET  `flo_actual` =(flo_actual-$cantper)  WHERE  `flota`.`flo_id` = $flota1");
				   if($cantper==1)
			  {
				  $hola="Solo";}
				 if($cantper==2)
			  {
				  $hola="En pareja";}
				  
				   if($cantper>2)
			  {
				    $hola="En familia";}
				  
	$result6= mysql_query("SELECT c.cos_hora FROM  costo c WHERE c.fk_via_origen=$viaorigen AND c.fk_via_destino=$viadestino");
$row6 = mysql_fetch_array($result6);
$horita=$row6['cos_hora'];							
			mysql_query("INSERT INTO `viaje` (`via_id`,`via_tipo`,`via_tipoviaje`,`via_fecha_ini`,`via_fecha_fin`,`via_hora_ini`,`via_hora_fin`,`via_millas`,`via_tipo_paq`,`via_cant_per`,`fk_pre_id`,`fk_via_id_origen`,`fk_via_id_destino`,`fk_flo_id`,`via_hotel`) VALUES(NULL,'Viaje','$hola','$fecha','$fecha1','$horita','10:00:00',NULL,NULL,'$cantper',null,'$viaorigen','$viadestino','$flota1',null)");
					
$resc3=mysql_query("SELECT MAX(via_id) AS max  FROM viaje");
			$roc3 = mysql_fetch_array($resc3);
		    $viaje=$roc3['max'];
//echo($viaje);

//$Fecha= date('d-m-Y');

 $millas=mysql_query("SELECT via_millas FROM  via v where  via_id='$viadestino'");
						$romillas = mysql_fetch_array($millas);
						$millitas=$romillas['via_millas'];
						//echo($millitas);
						
					$millas2=mysql_query("SELECT per_cant_millas FROM  persona  where  per_cedula='$cedula'");
						$romillas2 = mysql_fetch_array($millas2);
						$actualmi=$romillas2['per_cant_millas'];	
					//echo($actualmi);
						
				 mysql_query("UPDATE `persona` SET  `per_cant_millas` = ($actualmi+$millitas) WHERE  `persona`.`per_cedula` = '$cedula'");	


//echo($viaje);
			mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto','2011-06-18',$viaje)");
			//echo($viaje);
			
			
			
			$resa=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$roa = mysql_fetch_array($resa);
		    $pago=$roa['max'];
			
			  mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto2','2011-06-18',$viaje)");
			
				$resc=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$roc = mysql_fetch_array($resc);
		    $pago2=$roc['max'];
			
			 			   mysql_query("INSERT INTO `tarjeta` (`tar_id`,`tar_num`,`tar_cvv2`,`tar_nombre`,`tar_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero','$cvv2','$nombre','$fechapago','$cedula','$combo')");
					
					 $resf=mysql_query("SELECT tar_id FROM  tarjeta where tar_num='$numero' AND fk_per_cedula='$cedula'");
                       $rof = mysql_fetch_array($resf);
                       $tarjeta=$rof['tar_id'];		
			          //echo($tarjeta);
					   
					   
					   
					     mysql_query("INSERT INTO `deposito` (`dep_id`,`dep_numero`,`dep_cuenta`,`dep_fecha`,`fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero2','$cvv22','$fechapago2','$cedula','$combo2')");	
						
						$resh=mysql_query("SELECT dep_id FROM  deposito where dep_numero='$numero2'");
                       $roh = mysql_fetch_array($resh);
                       $deposito=$roh['dep_id'];		
			           //echo($deposito);
					   //echo($deposito);
					   
					   
					   				   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago','$tarjeta',NULL,NULL,NULL)");
					   
					    mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago2',NULL,null,'$deposito',NULL)");	
					   

					  
						 mysql_query("UPDATE `presupuesto` SET  `pre_status` ='Comprado' WHERE  `presupuesto`.`fk_per_cedula` = '$cedula' and `presupuesto`.`pre_paq` = '$id' ");	
					
					   
					   $hola1='u_continuar_compra_undestino_conestadia_terrestre.php?viaje='.$viaje.'&cantper='.$cantper.'&cedula='.$cedula.'&mensaje=2&preg='.$preg.'';
				 header("Location:$hola1");
				 
				
					   
			}// if solo esta lleno tarjeta y deposito
			
		
			
			
			
			// cheque y deposito
			if($comboaux2  && $comboaux1 && $fechapagoaux1 && $fechapagoaux2  && $numeroaux2 && $numeroaux1 && $nombreaux1  && $cvv2aux1 && $cvv2aux2  && $montoaux1 && $montoaux2 ) {
				 //echo("if el chequedep");
                 
						
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
						$reschao=mysql_query("SELECT ter_id FROM terrestre where ter_nombre='$aerolinea'");
						$rochao = mysql_fetch_array($reschao);
						$aerid1=$rochao['ter_id'];	
						
						
						$reshola=mysql_query("SELECT flo_id FROM  flota f , viaje v where  f.fk_ter_id='$aerid1' and (f.flo_actual>0)");
						$rohola = mysql_fetch_array($reshola);
						$flota1=$rohola['flo_id'];	
			          //echo($flota1);
					  
					  mysql_query("UPDATE `flota` SET  `flo_actual` =(flo_actual-$cantper)  WHERE  `flota`.`flo_id` = $flota1");
				   if($cantper==1)
			  {
				  $hola="Solo";}
				 if($cantper==2)
			  {
				  $hola="En pareja";}
				  
				   if($cantper>2)
			  {
				    $hola="En familia";}
				  
$result6= mysql_query("SELECT c.cos_hora FROM  costo c WHERE c.fk_via_origen=$viaorigen AND c.fk_via_destino=$viadestino");
$row6 = mysql_fetch_array($result6);
$horita=$row6['cos_hora'];								
		mysql_query("INSERT INTO `viaje` (`via_id`,`via_tipo`,`via_tipoviaje`,`via_fecha_ini`,`via_fecha_fin`,`via_hora_ini`,`via_hora_fin`,`via_millas`,`via_tipo_paq`,`via_cant_per`,`fk_pre_id`,`fk_via_id_origen`,`fk_via_id_destino`,`fk_flo_id`,`via_hotel`) VALUES(NULL,'Viaje','$hola','$fecha','$fecha1','$horita','10:00:00',NULL,NULL,'$cantper',null,'$viaorigen','$viadestino','$flota1',null)");
					
$resc3=mysql_query("SELECT MAX(via_id) AS max  FROM viaje");
			$roc3 = mysql_fetch_array($resc3);
		    $viaje=$roc3['max'];
//echo($viaje);

//$Fecha= date('d-m-Y');

 $millas=mysql_query("SELECT via_millas FROM  via v where  via_id='$viadestino'");
						$romillas = mysql_fetch_array($millas);
						$millitas=$romillas['via_millas'];
						//echo($millitas);
						
					$millas2=mysql_query("SELECT per_cant_millas FROM  persona  where  per_cedula='$cedula'");
						$romillas2 = mysql_fetch_array($millas2);
						$actualmi=$romillas2['per_cant_millas'];	
					//echo($actualmi);
						
				 mysql_query("UPDATE `persona` SET  `per_cant_millas` = ($actualmi+$millitas) WHERE  `persona`.`per_cedula` = '$cedula'");	


//echo($viaje);
			
			//echo($viaje);
			
			
			
		

				 
					 mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto1','2011-06-18',$viaje)");
					
					  
				//echo($montoaux);
				//echo($montoaux1);
				//echo($montoaux2);	   
					   
			$resb=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$rob = mysql_fetch_array($resb);
		    $pago1=$rob['max'];
			
			  mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto2','2011-06-18',$viaje)");

			
			$resc=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$roc = mysql_fetch_array($resc);
		    $pago2=$roc['max'];
			//echo($pago1);
			//echo("pago1");
			
			            
					  mysql_query("INSERT INTO `cheque` (`che_id`,`che_num`,`che_cuenta`,`che_nombre`,`che_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero1','$cvv21','$nombre1','$fechapago1','$cedula','$combo1')");
						
						$resg=mysql_query("SELECT che_id FROM  cheque where che_num='$numero1'");
                       $rog = mysql_fetch_array($resg);
                       $cheque=$rog['che_id'];		
			           //echo($cheque);	
					   //echo($cheque);
			 			  
					   
					   
					   
					     mysql_query("INSERT INTO `deposito` (`dep_id`,`dep_numero`,`dep_cuenta`,`dep_fecha`,`fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero2','$cvv22','$fechapago2','$cedula','$combo2')");	
						
						$resh=mysql_query("SELECT dep_id FROM  deposito where dep_numero='$numero2'");
                       $roh = mysql_fetch_array($resh);
                       $deposito=$roh['dep_id'];		
			           //echo($deposito);
					   //echo($deposito);
					   
					   
					   				   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago1',null,'$cheque',NULL,NULL)");
					   
					    mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago2',NULL,null,'$deposito',NULL)");	
					   

					   
 
 mysql_query("UPDATE `presupuesto` SET  `pre_status` ='Comprado' WHERE  `presupuesto`.`fk_per_cedula` = '$cedula' and `presupuesto`.`pre_paq` = '$id' ");	
					   
					   $hola1='u_continuar_compra_undestino_conestadia_terrestre.php?viaje='.$viaje.'&cantper='.$cantper.'&cedula='.$cedula.'&mensaje=2&preg='.$preg.'';
				 header("Location:$hola1");
				 	}// if solo esta lleno cheque y y deposito
				 
				
				
				
				}
			
			
					 
					 
					 
					 
			
					 
					 
				
				 }//del if inserto
				 
				 else// si no llego a la totalidad dell monto
				 {
					 if ($suma<($total+$abono1))
					 {
					
					 if($montoaux && $montoaux1 && $montoaux2)
					 {
					 echo("aca");
						mysql_query("INSERT INTO `tarjeta` (`tar_id`,`tar_num`,`tar_cvv2`,`tar_nombre`,`tar_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero','$cvv2','$nombre','$fechapago','$cedula','$combo')");
						
					  $resf=mysql_query("SELECT tar_id FROM  tarjeta where tar_num='$numero' AND fk_per_cedula='$cedula'");
                       $rof = mysql_fetch_array($resf);
                       $tarjeta=$rof['tar_id'];		
			           //echo($tarjeta);
					   
					   	mysql_query("INSERT INTO `cheque` (`che_id`,`che_num`,`che_cuenta`,`che_nombre`,`che_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero1','$cvv21','$nombre1','$fechapago1','$cedula','$combo1')");
						
						$resg=mysql_query("SELECT che_id FROM  cheque where che_num='$numero'");
                       $rog = mysql_fetch_array($resg);
                       $cheque=$rog['che_id'];		
			           //echo($cheque);	
					   
					   mysql_query("INSERT INTO `deposito` (`dep_id`,`dep_numero`,`dep_cuenta`,`dep_fecha`,`fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero2','$cvv22','$fechapago2','$cedula','$combo2')");	
						
						$resh=mysql_query("SELECT dep_id FROM  deposito where dep_numero='$numero'");
                       $roh = mysql_fetch_array($resh);
                       $deposito=$roh['dep_id'];		
			           //echo($deposito);
					   
					   	
					 mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto','2011-06-18',$viaje)");
					 
					 $resa=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$roa = mysql_fetch_array($resa);
		    $pago=$roa['max'];
					 
					  mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto1','2011-06-18',$viaje)");
					  
					   $resb=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$rob = mysql_fetch_array($resb);
		    $pago1=$rob['max'];
					 
					  
					   mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto2','2011-06-18',$viaje)");
					   
					   
					    $resc=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$roc = mysql_fetch_array($resc);
		    $pago2=$roc['max'];
					   
					   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago','$tarjeta',NULL,NULL,NULL)");		
						
					
			
					   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago1',NULL,'$cheque',NULL,NULL)");		
						
					
					
				
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago2',NULL,NULL,'$deposito',NULL)");
					//si esta el presu 	
					 $dime=mysql_query("SELECT `pre_id` FROM  presupuesto p  where p.pre_paq='$id' and p.fk_per_cedula='$cedula' and p.pre_status='No comprado'");
							$rodime = mysql_fetch_array($dime);
						    $dimeya=$rodime['pre_id'];	
						 
						$antes=mysql_query("SELECT `pre_abono` FROM  presupuesto p WHERE p.pre_paq='$id' and p.fk_per_cedula='$cedula'");
			             $antesb = mysql_fetch_array($antes);
		                 $antes1=$antesb['pre_abono'];
						
						
						echo("dimeya");
						 echo($dimeya);
					 
					 if ($dimeya== NULL )
					 {
					
							 
							 
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
						$reschao=mysql_query("SELECT ter_id FROM terrestre where ter_nombre='$aerolinea'");
						$rochao = mysql_fetch_array($reschao);
						$aerid1=$rochao['ter_id'];	
						
						
						$reshola=mysql_query("SELECT flo_id FROM  flota f , viaje v where  f.fk_ter_id='$aerid1' and (f.flo_actual>0)");
						$rohola = mysql_fetch_array($reshola);
						$flota1=$rohola['flo_id'];	
			          //echo($flota1);
						//$quedate1=$_POST['$quedate'];	
						
							 
							 //echo("$quedate1,$total,$cantper,$cedula,$viaorigen,$viadestino,($montoaux+$montoaux1+$montoaux2),$id");
								$mierda=$monto+$monto1+$monto2;
								//echo($mierda);
								//echo("entro aqui");
							 mysql_query("INSERT INTO `presupuesto` (`pre_id`, `pre_fecha`,`pre_habitacion`,`pre_servicio`,`pre_paseo`,`pre_total`,`pre_cant_per`,`fk_per_cedula`,`fk_via_id_origen`, `fk_via_id_destino`,`pre_abono`,`pre_status`,`pre_paq`,`pre_pro`) VALUES (NULL ,'2011-06-18',null,NULL,NULL, '$total','$cantper', '$cedula','$viaorigen', '$viadestino',$mierda,'No comprado','$id',null)");
					 }
					 else
					 {
						 
						 
						 
						 mysql_query("UPDATE `presupuesto` SET  `pre_abono` = ($antes1+$monto+$monto1+$monto2) WHERE  `presupuesto`.`pre_paq` = $id and `presupuesto`.`fk_per_cedula` = '$cedula'");
					 }
						 
						  $hola1='u_paquete_sinestadia_terrestre1.php?mensaje=2';
				           header("Location:$hola1");
						 
						 }
						 //echo("$montoaux,$montoaux1,$montoaux2");
						  // echo("hola"); 
						   
						   if ($monto && $monto1 && ($monto2==NULL) )
						 {
							 // echo("sii");
							 mysql_query("INSERT INTO `tarjeta` (`tar_id`,`tar_num`,`tar_cvv2`,`tar_nombre`,`tar_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero','$cvv2','$nombre','$fechapago','$cedula','$combo')");
						
					  $resf=mysql_query("SELECT tar_id FROM  tarjeta where tar_num='$numero' AND fk_per_cedula='$cedula'");
                       $rof = mysql_fetch_array($resf);
                       $tarjeta=$rof['tar_id'];		
			           //echo($tarjeta);
					   
					   	mysql_query("INSERT INTO `cheque` (`che_id`,`che_num`,`che_cuenta`,`che_nombre`,`che_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero1','$cvv21','$nombre1','$fechapago1','$cedula','$combo1')");
						
						$resg=mysql_query("SELECT che_id FROM  cheque where che_num='$numero'");
                       $rog = mysql_fetch_array($resg);
                       $cheque=$rog['che_id'];		
			           //echo($cheque);	
					   
							   mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto','2011-06-18',$viaje)");
					 
					 $resa=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$roa = mysql_fetch_array($resa);
		    $pago=$roa['max'];
					 
					  mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto1','2011-06-18',$viaje)");
					  
					   $resb=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$rob = mysql_fetch_array($resb);
		    $pago1=$rob['max'];
					   	
					
							   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago','$tarjeta',NULL,NULL,NULL)");		
						
					
			
					   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago1',NULL,'$cheque',NULL,NULL)");		
						
							
							 $dime=mysql_query("SELECT `pre_id` FROM  presupuesto p  where p.pre_paq='$id' and p.fk_per_cedula='$cedula' and p.pre_status='No comprado'");
							$rodime = mysql_fetch_array($dime);
						    $dimeya=$rodime['pre_id'];	
						 
						 $antes=mysql_query("SELECT `pre_abono` FROM  presupuesto p WHERE p.pre_paq='$id' and p.fk_per_cedula='$cedula'");
			             $antesb = mysql_fetch_array($antes);
		                 $antes1=$antesb['pre_abono'];
					 
					 if ($dimeya== NULL )
					 {
					
							 
						
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
						$reschao=mysql_query("SELECT ter_id FROM terrestre where ter_nombre='$aerolinea'");
						$rochao = mysql_fetch_array($reschao);
						$aerid1=$rochao['ter_id'];	
						
						
						$reshola=mysql_query("SELECT flo_id FROM  flota f , viaje v where  f.fk_ter_id='$aerid1' and (f.flo_actual>0)");
						$rohola = mysql_fetch_array($reshola);
						$flota1=$rohola['flo_id'];	
			          //echo($flota1);
							 
							 
							mysql_query("INSERT INTO `presupuesto` (`pre_id`, `pre_fecha`,`pre_habitacion`,`pre_servicio`,`pre_paseo`,`pre_total`,`pre_cant_per`,`fk_per_cedula`, `fk_via_id_origen`, `fk_via_id_destino`,`pre_abono`,`pre_status`,`pre_paq`,`pre_pro`) VALUES (NULL ,'2011-06-18',null,NULL,NULL, '$total','$cantper', '$cedula','$viaorigen', '$viadestino',$monto+$monto1,'No comprado','$id',null)");
					 }
					 else
					 {
						 
						 
						 //echo("en el else de tar y che ");
						 mysql_query("UPDATE `presupuesto` SET  `pre_abono` = ($antes1+$monto+$monto1) WHERE  `presupuesto`.`pre_paq` = $id and `presupuesto`.`fk_per_cedula` = '$cedula'");
					 }
						 
							
							
							  
							  
							   $hola1='u_paquete_sinestadia_terrestre1.php?mensaje=2';
				           header("Location:$hola1");
						 
						 
							 }
							 
							 
							 
							 
							 
							   if ($montoaux && $montoaux2 && ($montoaux1==NULL))
						 {
							 
							// echo("tarjeta y deposito") ;
							 mysql_query("INSERT INTO `tarjeta` (`tar_id`,`tar_num`,`tar_cvv2`,`tar_nombre`,`tar_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero','$cvv2','$nombre','$fechapago','$cedula','$combo')");
						
					  $resf=mysql_query("SELECT tar_id FROM  tarjeta where tar_num='$numero' AND fk_per_cedula='$cedula'");
                       $rof = mysql_fetch_array($resf);
                       $tarjeta=$rof['tar_id'];
					   
					     
					   mysql_query("INSERT INTO `deposito` (`dep_id`,`dep_numero`,`dep_cuenta`,`dep_fecha`,`fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero2','$cvv22','$fechapago2','$cedula','$combo2')");	
						
						$resh=mysql_query("SELECT dep_id FROM  deposito where dep_numero='$numero'");
                       $roh = mysql_fetch_array($resh);
                       $deposito=$roh['dep_id'];		
			           //echo($deposito);
					   
					   	
					 mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto','2011-06-18',$viaje)");
					 
					 $resa=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$roa = mysql_fetch_array($resa);
		    $pago=$roa['max'];
			
			
					   mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto2','2011-06-18',$viaje)");
					   
					   
					    $resc=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$roc = mysql_fetch_array($resc);
		    $pago2=$roc['max'];
					   
					   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago','$tarjeta',NULL,NULL,NULL)");		
						
					
				
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago2',NULL,NULL,'$deposito',NULL)");
								
							 $dime=mysql_query("SELECT `pre_id` FROM  presupuesto p  where p.pre_paq='$id' and p.fk_per_cedula='$cedula' and p.pre_status='No comprado'");
							$rodime = mysql_fetch_array($dime);
						$dimeya=$rodime['pre_id'];	
						 
						 $antes=mysql_query("SELECT `pre_abono` FROM  presupuesto p WHERE p.pre_paq='$id' and p.fk_per_cedula='$cedula'");
			             $antesb = mysql_fetch_array($antes);
		                 $antes1=$antesb['pre_abono'];
					 
					 if ($dimeya== NULL )
					 {
					
							 
							 
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
						$reschao=mysql_query("SELECT ter_id FROM terrestre where ter_nombre='$aerolinea'");
						$rochao = mysql_fetch_array($reschao);
						$aerid1=$rochao['ter_id'];	
						
						
						$reshola=mysql_query("SELECT flo_id FROM  flota f , viaje v where  f.fk_ter_id='$aerid1' and (f.flo_actual>0)");
						$rohola = mysql_fetch_array($reshola);
						$flota1=$rohola['flo_id'];	
			          //echo($flota1);
							 
							mysql_query("INSERT INTO `presupuesto` (`pre_id`, `pre_fecha`,`pre_habitacion`,`pre_servicio`,`pre_paseo`,`pre_total`,`pre_cant_per`,`fk_per_cedula`, `fk_via_id_origen`, `fk_via_id_destino`,`pre_abono`,`pre_status`,`pre_paq`,`pre_pro`) VALUES (NULL ,'2011-06-18',NULL,NULL, '$total','$cantper', '$cedula','$viaorigen', '$viadestino',($monto+$monto2),'No comprado','$id',null)");
					 }
					 else
					 {
						 
						 
						 
						 mysql_query("UPDATE `presupuesto` SET  `pre_abono` = ($antes1+$monto+$monto2) WHERE  `presupuesto`.`pre_paq` = $id and `presupuesto`.`fk_per_cedula` = '$cedula'");
					 }
						 
							
							
							  
							   $hola1='u_paquete_sinestadia_terrestre1.php?mensaje=2';
				           header("Location:$hola1");
						 
						 
							 }
							 
							 
							 
							 
							   if ($montoaux1 && $montoaux2 && ($montoaux==NULL))
						 {
						  echo("en el de cheque y deposito");
							  	mysql_query("INSERT INTO `cheque` (`che_id`,`che_num`,`che_cuenta`,`che_nombre`,`che_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero1','$cvv21','$nombre1','$fechapago1','$cedula','$combo1')");
						
						$resg=mysql_query("SELECT che_id FROM  cheque where che_num='$numero'");
                       $rog = mysql_fetch_array($resg);
                       $cheque=$rog['che_id'];		
			           //echo($cheque);	
					   
					   mysql_query("INSERT INTO `deposito` (`dep_id`,`dep_numero`,`dep_cuenta`,`dep_fecha`,`fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero2','$cvv22','$fechapago2','$cedula','$combo2')");	
						
						$resh=mysql_query("SELECT dep_id FROM  deposito where dep_numero='$numero'");
                       $roh = mysql_fetch_array($resh);
                       $deposito=$roh['dep_id'];		
			           //echo($deposito);
					   
					   	
					
					 
					  mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto1','2011-06-18',$viaje)");
					  
					   $resb=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$rob = mysql_fetch_array($resb);
		    $pago1=$rob['max'];
					 
					  
					   mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto2','2011-06-18',$viaje)");
					   
					   
					    $resc=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$roc = mysql_fetch_array($resc);
		    $pago2=$roc['max'];
					   
					   
				
					   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago1',NULL,'$cheque',NULL,NULL)");		
						
					
					
				
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago2',NULL,NULL,'$deposito',NULL)");
						
						$dime=mysql_query("SELECT `pre_id` FROM  presupuesto p  where p.pre_paq='$id' and p.fk_per_cedula='$cedula' and p.pre_status='No comprado'");
						$rodime = mysql_fetch_array($dime);
						$dimeya=$rodime['pre_id'];	
						 
						 $antes=mysql_query("SELECT `pre_abono` FROM  presupuesto p WHERE p.pre_paq='$id' and p.fk_per_cedula='$cedula'");
			             $antesb = mysql_fetch_array($antes);
		                 $antes1=$antesb['pre_abono'];
					 
					 if ($dimeya== NULL )
					 {
					
							
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
						$reschao=mysql_query("SELECT ter_id FROM terrestre where ter_nombre='$aerolinea'");
						$rochao = mysql_fetch_array($reschao);
						$aerid1=$rochao['ter_id'];	
						
						
						$reshola=mysql_query("SELECT flo_id FROM  flota f , viaje v where  f.fk_ter_id='$aerid1' and (f.flo_actual>0)");
						$rohola = mysql_fetch_array($reshola);
						$flota1=$rohola['flo_id'];	
			          //echo($flota1);
							 
							 mysql_query("INSERT INTO `presupuesto` (`pre_id`, `pre_fecha`,`pre_habitacion`,`pre_servicio`,`pre_paseo`,`pre_total`,`pre_cant_per`,`fk_per_cedula`, `fk_via_id_origen`, `fk_via_id_destino`,`pre_abono`,`pre_status`,`pre_paq`,`pre_pro`) VALUES (NULL ,'2011-06-18',null,NULL,NULL, '$total','$cantper', '$cedula','$viaorigen', '$viadestino',($monto1+$monto2),'No comprado','$id',null)");
					 }
					 else
					 {
						 
						 
						 
						 mysql_query("UPDATE `presupuesto` SET  `pre_abono` = ($antes1+$monto1+$monto2) WHERE  `presupuesto`.`pre_paq` = $id and `presupuesto`.`fk_per_cedula` = '$cedula'");
					 }
						 
							  
							   $hola1='u_paquete_sinestadia_terrestre1.php?mensaje=2';
				           header("Location:$hola1");
						 
						 
							 }
							 
							  if ($montoaux && ($montoaux1==NULL) && ($montoaux2==NULL))
						 {
							 
							  mysql_query("INSERT INTO `tarjeta` (`tar_id`,`tar_num`,`tar_cvv2`,`tar_nombre`,`tar_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero','$cvv2','$nombre','$fechapago','$cedula','$combo')");
						
					  $resf=mysql_query("SELECT tar_id FROM  tarjeta where tar_num='$numero' AND fk_per_cedula='$cedula'");
                       $rof = mysql_fetch_array($resf);
                       $tarjeta=$rof['tar_id'];
					   
					     
					  
					   
					   	
					 mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto','2011-06-18',$viaje)");
					 
					 $resa=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$roa = mysql_fetch_array($resa);
		    $pago=$roa['max'];
			
			
					   
					   
					   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago','$tarjeta',NULL,NULL,NULL)");		
			
			$dime=mysql_query("SELECT `pre_id` FROM  presupuesto p  where p.pre_paq='$id' and p.fk_per_cedula='$cedula' and p.pre_status='No comprado'");
			$rodime = mysql_fetch_array($dime);
						$dimeya=$rodime['pre_id'];	
						 
						$antes=mysql_query("SELECT `pre_abono` FROM  presupuesto p WHERE p.pre_paq='$id' and p.fk_per_cedula='$cedula'");
			             $antesb = mysql_fetch_array($antes);
		                 $antes1=$antesb['pre_abono'];
					 
					 if ($dimeya== NULL )
					 {
					
							 
							
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
						$reschao=mysql_query("SELECT ter_id FROM terrestre where ter_nombre='$aerolinea'");
						$rochao = mysql_fetch_array($reschao);
						$aerid1=$rochao['ter_id'];	
						
						
						$reshola=mysql_query("SELECT flo_id FROM  flota f , viaje v where  f.fk_ter_id='$aerid1' and (f.flo_actual>0)");
						$rohola = mysql_fetch_array($reshola);
						$flota1=$rohola['flo_id'];	
			          //echo($flota1);
							 
							 
							mysql_query("INSERT INTO `presupuesto` (`pre_id`, `pre_fecha`,`pre_habitacion`,`pre_servicio`,`pre_paseo`,`pre_total`,`pre_cant_per`,`fk_per_cedula`, `fk_via_id_origen`, `fk_via_id_destino`,`pre_abono`,`pre_status`,`pre_paq`,`pre_pro`) VALUES (NULL ,'2011-06-18',null,NULL,NULL, '$total','$cantper', '$cedula','$viaorigen', '$viadestino',($monto),'No comprado','$id',null)");
					 }
					 else
					 {
						 
						 
						 
						 mysql_query("UPDATE `presupuesto` SET  `pre_abono` = ($antes1+$monto) WHERE  `presupuesto`.`pre_paq` = $id and `presupuesto`.`fk_per_cedula` = '$cedula'");
					 }
						 
			
			
							  
							   $hola1='u_paquete_sinestadia_terrestre1.php?mensaje=2';
				           header("Location:$hola1");
						 
						 
							 }
							 
							  if ($montoaux1 && ($montoaux==NULL) && ($montoaux2==NULL))
						 {
							 
							 
							  	mysql_query("INSERT INTO `cheque` (`che_id`,`che_num`,`che_cuenta`,`che_nombre`,`che_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero1','$cvv21','$nombre1','$fechapago1','$cedula','$combo1')");
						
						$resg=mysql_query("SELECT che_id FROM  cheque where che_num='$numero'");
                       $rog = mysql_fetch_array($resg);
                       $cheque=$rog['che_id'];		
			           //echo($cheque);	
					   
					  
					   	
					
					 
					  mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto1','2011-06-18',$viaje)");
					  
					   $resb=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$rob = mysql_fetch_array($resb);
		    $pago1=$rob['max'];
					 
					 
					   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago1',NULL,'$cheque',NULL,NULL)");	
					   	
			 $dime=mysql_query("SELECT `pre_id` FROM  presupuesto p  where p.pre_paq='$id' and p.fk_per_cedula='$cedula' and p.pre_status='No comprado'");
			$rodime = mysql_fetch_array($dime);
						$dimeya=$rodime['pre_id'];	
						 
						$antes=mysql_query("SELECT `pre_abono` FROM  presupuesto p WHERE p.pre_paq='$id' and p.fk_per_cedula='$cedula'");
			             $antesb = mysql_fetch_array($antes);
		                 $antes1=$antesb['pre_abono'];
					 
					 if ($dimeya== NULL )
					 {
					
							 
							
						
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
						$reschao=mysql_query("SELECT ter_id FROM terrestre where ter_nombre='$aerolinea'");
						$rochao = mysql_fetch_array($reschao);
						$aerid1=$rochao['ter_id'];	
						
						
						$reshola=mysql_query("SELECT flo_id FROM  flota f , viaje v where  f.fk_ter_id='$aerid1' and (f.flo_actual>0)");
						$rohola = mysql_fetch_array($reshola);
						$flota1=$rohola['flo_id'];	
			          //echo($flota1);
							 
							 
							 mysql_query("INSERT INTO `presupuesto` (`pre_id`, `pre_fecha`,`pre_habitacion`,`pre_servicio`,`pre_paseo`,`pre_total`,`pre_cant_per`,`fk_per_cedula`, `fk_via_id_origen`, `fk_via_id_destino`,`pre_abono`,`pre_status`,`pre_paq`,`pre_pro`) VALUES (NULL ,'2011-06-18',null,NULL,NULL, '$total','$cantper', '$cedula','$viaorigen', '$viadestino',($monto1),'No comprado','$id',null)");
					 }
					 else
					 {
						 
						 
						 
						 mysql_query("UPDATE `presupuesto` SET  `pre_abono` = ($antes1+$monto1) WHERE  `presupuesto`.`pre_paq` = $id and `presupuesto`.`fk_per_cedula` = '$cedula'");
					 }
						 
			
			
							  
							   $hola1='u_paquete_sinestadia_terrestre1.php?mensaje=2';
				           header("Location:$hola1");
						 
						 
							 }
							 
							  if ($montoaux2 && ($montoaux1==NULL) && ($montoaux==NULL))
						 {
							 
							 
							  	
					   
					   mysql_query("INSERT INTO `deposito` (`dep_id`,`dep_numero`,`dep_cuenta`,`dep_fecha`,`fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero2','$cvv22','$fechapago2','$cedula','$combo2')");	
						
						$resh=mysql_query("SELECT dep_id FROM  deposito where dep_numero='$numero'");
                       $roh = mysql_fetch_array($resh);
                       $deposito=$roh['dep_id'];		
			           //echo($deposito);
					   
					 
					  
					   mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto2','2011-06-18',$viaje)");
					   
					   
					    $resc=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$roc = mysql_fetch_array($resc);
		    $pago2=$roc['max'];
					   
					   
				
	
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago2',NULL,NULL,'$deposito',NULL)");
	
	 $dime=mysql_query("SELECT `pre_id` FROM  presupuesto p  where p.pre_paq='$id' and p.fk_per_cedula='$cedula' and p.pre_status='No comprado'");					
	$rodime = mysql_fetch_array($dime);
						$dimeya=$rodime['pre_id'];	
						 
						$antes=mysql_query("SELECT `pre_abono` FROM  presupuesto p WHERE p.pre_paq='$id' and p.fk_per_cedula='$cedula'");
			             $antesb = mysql_fetch_array($antes);
		                 $antes1=$antesb['pre_abono'];
					 
					 if ($dimeya== NULL )
					 {
					
							 
							
						
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
						$reschao=mysql_query("SELECT ter_id FROM terrestre where ter_nombre='$aerolinea'");
						$rochao = mysql_fetch_array($reschao);
						$aerid1=$rochao['ter_id'];	
						
						
						$reshola=mysql_query("SELECT flo_id FROM  flota f , viaje v where  f.fk_ter_id='$aerid1' and (f.flo_actual>0)");
						$rohola = mysql_fetch_array($reshola);
						$flota1=$rohola['flo_id'];	
			          //echo($flota1);
							 
					// echo("$quedate,$total,$cantper,$cedula,$viaorigen,$viadestino,($montoaux+$montoaux1+$montoaux2),$id");
							mysql_query("INSERT INTO `presupuesto` (`pre_id`, `pre_fecha`,`pre_habitacion`,`pre_servicio`,`pre_paseo`,`pre_total`,`pre_cant_per`,`fk_per_cedula`, `fk_via_id_origen`, `fk_via_id_destino`,`pre_abono`,`pre_status`,`pre_paq`,`pre_pro`) VALUES (NULL ,'2011-06-18',null,NULL,NULL, '$total','$cantper', '$cedula','$viaorigen', '$viadestino',($monto2),'No comprado','$id',null)");
					 }
					 else
					 {
						 
						 
						 
						 mysql_query("UPDATE `presupuesto` SET  `pre_abono` = ($antes1+$monto2) WHERE  `presupuesto`.`pre_paq` = $id and `presupuesto`.`fk_per_cedula` = '$cedula'");
					 }
						 
							  
							   $hola1='u_paquete_sinestadia_terrestre1.php?mensaje=2';
				           header("Location:$hola1");
						 
						 
							 }
					 
					 
					 }
					 else// esto es cuando es mayor que el total 
					 {
						 $hola1='u_monto_error_terrestre1.php?mensaje=2';
				           header("Location:$hola1");
						 
						 } 
			
				 
				 }
			
					 
		
			
			
			}//fin del else de pago cuotas
			
		}// que es turistico
		
		
		
		
		
		
		
		
		
		
		
		
		else // es especial
		{
			
                    
					
					 $montoaux4=$_POST['monto4'];
    
			// echo("entra");
			 //echo($jotel);
             
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
						$reschao=mysql_query("SELECT ter_id FROM terrestre where ter_nombre='$aerolinea'");
						$rochao = mysql_fetch_array($reschao);
						$aerid1=$rochao['ter_id'];	
						
						
						$reshola=mysql_query("SELECT flo_id FROM  flota f , viaje v where  f.fk_ter_id='$aerid1' and (f.flo_actual>0)");
						$rohola = mysql_fetch_array($reshola);
						$flota1=$rohola['flo_id'];	
			          //echo($flota1);
					  
					  mysql_query("UPDATE `flota` SET  `flo_actual` =(flo_actual-$cantper)  WHERE  `flota`.`flo_id` = $flota1");
					  
					  if($cantper==1)
			  {
				  $hola="Solo";}
				 if($cantper==2)
			  {
				  $hola="En pareja";}
				  
				   if($cantper>2)
			  {
				    $hola="En familia";}
					//echo("")
$result6= mysql_query("SELECT c.cos_hora FROM  costo c WHERE c.fk_via_origen=$viaorigen AND c.fk_via_destino=$viadestino");
$row6 = mysql_fetch_array($result6);
$horita=$row6['cos_hora'];								
mysql_query("INSERT INTO `viaje` (`via_id`,`via_tipo`,`via_tipoviaje`,`via_fecha_ini`,`via_fecha_fin`,`via_hora_ini`,`via_hora_fin`,`via_millas`,`via_tipo_paq`,`via_cant_per`,`fk_pre_id`,`fk_via_id_origen`,`fk_via_id_destino`,`fk_flo_id`,`via_hotel`) VALUES(NULL,'Viaje','$hola','$fecha','$fecha1','$horita','10:00:00',NULL,NULL,'$cantper',null,'$viaorigen','$viadestino','$flota1',null)");
					
$resc3=mysql_query("SELECT MAX(via_id) AS max  FROM viaje");
			$roc3 = mysql_fetch_array($resc3);
		    $viaje=$roc3['max'];
//echo($viaje);

//$Fecha= date('d-m-Y');

 $millas=mysql_query("SELECT via_millas FROM  via v where  via_id='$viadestino'");
						$romillas = mysql_fetch_array($millas);
						$millitas=$romillas['via_millas'];
						//echo($millitas);
						
					$millas2=mysql_query("SELECT per_cant_millas FROM  persona  where  per_cedula='$cedula'");
						$romillas2 = mysql_fetch_array($millas2);
						$actualmi=$romillas2['per_cant_millas'];	
					//echo($actualmi);
						
				 mysql_query("UPDATE `persona` SET  `per_cant_millas` = ($actualmi+$millitas) WHERE  `persona`.`per_cedula` = '$cedula'");	


//echo($viaje);
			mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$total','2011-06-18',$viaje)");
			//echo($viaje);
		
			
			
			$resa=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$roa = mysql_fetch_array($resa);
		    $pago=$roa['max'];
			
			
			
			
			
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
					
					 mysql_query("UPDATE `persona` SET  `per_cant_millas` = ($actualmi-$montoaux4) WHERE  `persona`.`per_cedula` = '$cedula'");	
					 
					 
					 		  
				 $hola1='u_continuar_compra_undestino_conestadia_terrestre.php?viaje='.$viaje.'&cantper='.$cantper.'&cedula='.$cedula.'&mensaje=2&preg='.$preg.'';
				 header("Location:$hola1");// esta bien 
					
					
					
					//echo($cantper);
					
			
		}
		
		
		else
		{
			
			if ($formapago=='Pago en cuotas' || $formapago=='Pago en Cuotas')
			$t=$habitacion-$montoaux4;
			$falta=$t*3;
			
		$verifica=$_POST['monto']+$_POST['monto1']+$_POST['monto2'];
	// echo("entra");
	  //echo $_POST['monto'];
	  // echo "post";
	   //echo $_GET['monto'];
	  // echo "get";
	   
	  //echo($verifica);
	   //echo($total);
	   
	   $resg1=mysql_query("SELECT `pre_abono` FROM  presupuesto where pre_paq='$id' and fk_per_cedula='$cedula'");
                       $rog1 = mysql_fetch_array($resg1);
                       $abono1=$rog1['pre_abono'];
					   $suma=$abono1+$verifica;
					   //echo($suma);
					   		
	    if($verifica==$total)
	      {
		  $inserto=1;
		  }
		  else
		    {
			$inserto=0;
			}
	//echo("entra a cuotas");
		//echo($inserto);
		
		$montoaux=$_POST['monto'];
					     $montoaux1=$_POST['monto1'];
						   $montoaux2=$_POST['monto2'];
						   $montoaux3=$_POST['monto3'];
						   $montoaux4=$_POST['monto4'];
						   
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

			
			if($comboaux1 && $comboaux2 && $comboaux && $fechapagoaux && $fechapagoaux1 && $fechapagoaux2 && $numeroaux1 && $numeroaux2 && $numeroaux && $nombreaux && $nombreaux1 && $cvv2aux && $cvv2aux1 && $cvv2aux2 && $montoaux && $montoaux1 && $montoaux2 ) {
				// echo("if");
                 
						
						$$res4=mysql_query("SELECT ter_id FROM  terrestre where ter_nombre='$aerolinea'");
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
						$reschao=mysql_query("SELECT ter_id FROM terrestre where ter_nombre='$aerolinea'");
						$rochao = mysql_fetch_array($reschao);
						$aerid1=$rochao['ter_id'];	
						
						
						$reshola=mysql_query("SELECT flo_id FROM  flota f , viaje v where  f.fk_ter_id='$aerid1' and (f.flo_actual>0)");
						$rohola = mysql_fetch_array($reshola);
						$flota1=$rohola['flo_id'];	
			          //echo($flota1);
					  
					  mysql_query("UPDATE `flota` SET  `flo_actual` =(flo_actual-$cantper)  WHERE  `flota`.`flo_id` = $flota1");
				   if($cantper==1)
			  {
				  $hola="Solo";}
				 if($cantper==2)
			  {
				  $hola="En pareja";}
				  
				   if($cantper>2)
			  {
				    $hola="En familia";}
				  
								
	$result6= mysql_query("SELECT c.cos_hora FROM  costo c WHERE c.fk_via_origen=$viaorigen AND c.fk_via_destino=$viadestino");
$row6 = mysql_fetch_array($result6);
$horita=$row6['cos_hora'];			 
				mysql_query("INSERT INTO `viaje` (`via_id`,`via_tipo`,`via_tipoviaje`,`via_fecha_ini`,`via_fecha_fin`,`via_hora_ini`,`via_hora_fin`,`via_millas`,`via_tipo_paq`,`via_cant_per`,`fk_pre_id`,`fk_via_id_origen`,`fk_via_id_destino`,`fk_flo_id`,`via_hotel`) VALUES(NULL,'Viaje','$hola','$fecha','$fecha1','$horita','10:00:00',NULL,NULL,'$cantper',null,'$viaorigen','$viadestino','$flota1',null)");
					
$resc3=mysql_query("SELECT MAX(via_id) AS max  FROM viaje");
			$roc3 = mysql_fetch_array($resc3);
		    $viaje=$roc3['max'];
//echo($viaje);

//$Fecha= date('d-m-Y');

 $millas=mysql_query("SELECT via_millas FROM  via v where  via_id='$viadestino'");
						$romillas = mysql_fetch_array($millas);
						$millitas=$romillas['via_millas'];
						//echo($millitas);
						
					$millas2=mysql_query("SELECT per_cant_millas FROM  persona  where  per_cedula='$cedula'");
						$romillas2 = mysql_fetch_array($millas2);
						$actualmi=$romillas2['per_cant_millas'];	
					//echo($actualmi);
						
				 mysql_query("UPDATE `persona` SET  `per_cant_millas` = ($actualmi+$millitas) WHERE  `persona`.`per_cedula` = '$cedula'");	


//echo($viaje);
			mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto','2011-06-18',$viaje)");
			//echo($viaje);
			
			
			$resa=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$roa = mysql_fetch_array($resa);
		    $pago=$roa['max'];
			
			//echo($pago);
			//echo("pago");
			 mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto1','2011-06-18',$viaje)");
			 
				$resb=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$rob = mysql_fetch_array($resb);
		    $pago1=$rob['max'];
			
			
			//echo($pago1);
			//echo("pago1");
			   mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto2','2011-06-18',$viaje)");
			
				$resc=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$roc = mysql_fetch_array($resc);
		    $pago2=$roc['max'];
			
			 
		//	echo($pago2);
			//echo("pago2");
			
			  
			
					   
					   mysql_query("INSERT INTO `tarjeta` (`tar_id`,`tar_num`,`tar_cvv2`,`tar_nombre`,`tar_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero','$cvv2','$nombre','$fechapago','$cedula','$combo')");
					
					 $resf=mysql_query("SELECT tar_id FROM  tarjeta where tar_num='$numero' AND fk_per_cedula='$cedula'");
                       $rof = mysql_fetch_array($resf);
                       $tarjeta=$rof['tar_id'];		
			          //echo($tarjeta);
					   
					   mysql_query("INSERT INTO `cheque` (`che_id`,`che_num`,`che_cuenta`,`che_nombre`,`che_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero1','$cvv21','$nombre1','$fechapago1','$cedula','$combo1')");
						
						$resg=mysql_query("SELECT che_id FROM  cheque where che_num='$numero1'");
                       $rog = mysql_fetch_array($resg);
                       $cheque=$rog['che_id'];		
			           //echo($cheque);	
					   //echo($cheque);
					   
					   mysql_query("INSERT INTO `deposito` (`dep_id`,`dep_numero`,`dep_cuenta`,`dep_fecha`,`fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero2','$cvv22','$fechapago2','$cedula','$combo2')");	
						
						$resh=mysql_query("SELECT dep_id FROM  deposito where dep_numero='$numero2'");
                       $roh = mysql_fetch_array($resh);
                       $deposito=$roh['dep_id'];		
			           //echo($deposito);
					   //echo($deposito);
					   
					 
			
					   
					   
					   
					   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago','$tarjeta',NULL,NULL,NULL)");
					   
					    mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago1',NULL,'$cheque',NULL,NULL)");	
					   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago2',NULL,NULL,'$deposito',NULL)");
					   
					
						
					   
					   $hola1='u_continuar_compra_undestino_conestadia_terrestre.php?viaje='.$viaje.'&cantper='.$cantper.'&cedula='.$cedula.'&mensaje=2&preg='.$preg.'';
				 header("Location:$hola1");// esta bien 
				 
				
					   
			}// if si estan tar cheque deposito
			

			
			
			
			
			
			else
			{
				
					if($comboaux1  && $comboaux && $fechapagoaux && $fechapagoaux1  && $numeroaux1 && $numeroaux && $nombreaux && $nombreaux1 && $cvv2aux && $cvv2aux1  && $montoaux && $montoaux1 ) {
				// echo("if el segundo");
                
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
						$reschao=mysql_query("SELECT ter_id FROM terrestre where ter_nombre='$aerolinea'");
						$rochao = mysql_fetch_array($reschao);
						$aerid1=$rochao['ter_id'];	
						
						
						$reshola=mysql_query("SELECT flo_id FROM  flota f , viaje v where  f.fk_ter_id='$aerid1' and (f.flo_actual>0)");
						$rohola = mysql_fetch_array($reshola);
						$flota1=$rohola['flo_id'];	
			          //echo($flota1);
					  
					  mysql_query("UPDATE `flota` SET  `flo_actual` =(flo_actual-$cantper)  WHERE  `flota`.`flo_id` = $flota1");
				   if($cantper==1)
			  {
				  $hola="Solo";}
				 if($cantper==2)
			  {
				  $hola="En pareja";}
				  
				   if($cantper>2)
			  {
				    $hola="En familia";}
				  
	$result6= mysql_query("SELECT c.cos_hora FROM  costo c WHERE c.fk_via_origen=$viaorigen AND c.fk_via_destino=$viadestino");
$row6 = mysql_fetch_array($result6);
$horita=$row6['cos_hora'];							
		mysql_query("INSERT INTO `viaje` (`via_id`,`via_tipo`,`via_tipoviaje`,`via_fecha_ini`,`via_fecha_fin`,`via_hora_ini`,`via_hora_fin`,`via_millas`,`via_tipo_paq`,`via_cant_per`,`fk_pre_id`,`fk_via_id_origen`,`fk_via_id_destino`,`fk_flo_id`,`via_hotel`) VALUES(NULL,'Viaje','$hola','$fecha','$fecha1','$horita','10:00:00',NULL,NULL,'$cantper',null,'$viaorigen','$viadestino','$flota1',null)");
					
$resc3=mysql_query("SELECT MAX(via_id) AS max  FROM viaje");
			$roc3 = mysql_fetch_array($resc3);
		    $viaje=$roc3['max'];
//echo($viaje);

//$Fecha= date('d-m-Y');

 $millas=mysql_query("SELECT via_millas FROM  via v where  via_id='$viadestino'");
						$romillas = mysql_fetch_array($millas);
						$millitas=$romillas['via_millas'];
						//echo($millitas);
						
					$millas2=mysql_query("SELECT per_cant_millas FROM  persona  where  per_cedula='$cedula'");
						$romillas2 = mysql_fetch_array($millas2);
						$actualmi=$romillas2['per_cant_millas'];	
					//echo($actualmi);
						
				 mysql_query("UPDATE `persona` SET  `per_cant_millas` = ($actualmi+$millitas) WHERE  `persona`.`per_cedula` = '$cedula'");	


//echo($viaje);
			mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto','2011-06-18',$viaje)");
			//echo($viaje);
			
			
			$resa=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$roa = mysql_fetch_array($resa);
		    $pago=$roa['max'];
			
			
			//echo($pago);
			//echo("pago");
			  mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto1','2011-06-18',$viaje)");
				$resb=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$rob = mysql_fetch_array($resb);
		    $pago1=$rob['max'];
			
			
			//echo($pago1);
			//echo("pago1");
			
			
			 			   mysql_query("INSERT INTO `tarjeta` (`tar_id`,`tar_num`,`tar_cvv2`,`tar_nombre`,`tar_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero','$cvv2','$nombre','$fechapago','$cedula','$combo')");
					
					 $resf=mysql_query("SELECT tar_id FROM  tarjeta where tar_num='$numero' AND fk_per_cedula='$cedula'");
                       $rof = mysql_fetch_array($resf);
                       $tarjeta=$rof['tar_id'];		
			          //echo($tarjeta);
					  
					  mysql_query("INSERT INTO `cheque` (`che_id`,`che_num`,`che_cuenta`,`che_nombre`,`che_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero1','$cvv21','$nombre1','$fechapago1','$cedula','$combo1')");
						
						$resg=mysql_query("SELECT che_id FROM  cheque where che_num='$numero1'");
                       $rog = mysql_fetch_array($resg);
                       $cheque=$rog['che_id'];		
			           //echo($cheque);	
					   //echo($cheque);
					   
					
					   				   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago','$tarjeta',NULL,NULL,NULL)");
					   
					    mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago1',NULL,'$cheque',NULL,NULL)");	
					   

					  
					
					   
					   $hola1='u_continuar_compra_undestino_conestadia_terrestre.php?viaje='.$viaje.'&cantper='.$cantper.'&cedula='.$cedula.'&mensaje=2&preg='.$preg.'';
				 header("Location:$hola1");
				 
				
					   
			}// if solo esta lleno tarjeta y cheque
				// tarjeta y deposito
				if($comboaux2  && $comboaux && $fechapagoaux && $fechapagoaux2  && $numeroaux2 && $numeroaux && $nombreaux  && $cvv2aux && $cvv2aux2  && $montoaux && $montoaux2 ) {
				// echo("if el segundo");
               
						
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
						$reschao=mysql_query("SELECT ter_id FROM terrestre where ter_nombre='$aerolinea'");
						$rochao = mysql_fetch_array($reschao);
						$aerid1=$rochao['ter_id'];	
						
						
						$reshola=mysql_query("SELECT flo_id FROM  flota f , viaje v where  f.fk_ter_id='$aerid1' and (f.flo_actual>0)");
						$rohola = mysql_fetch_array($reshola);
						$flota1=$rohola['flo_id'];	
			          //echo($flota1);
					  
					  mysql_query("UPDATE `flota` SET  `flo_actual` =(flo_actual-$cantper)  WHERE  `flota`.`flo_id` = $flota1");
				   if($cantper==1)
			  {
				  $hola="Solo";}
				 if($cantper==2)
			  {
				  $hola="En pareja";}
				  
				   if($cantper>2)
			  {
				    $hola="En familia";}
				  
		$result6= mysql_query("SELECT c.cos_hora FROM  costo c WHERE c.fk_via_origen=$viaorigen AND c.fk_via_destino=$viadestino");
$row6 = mysql_fetch_array($result6);
$horita=$row6['cos_hora'];						
			mysql_query("INSERT INTO `viaje` (`via_id`,`via_tipo`,`via_tipoviaje`,`via_fecha_ini`,`via_fecha_fin`,`via_hora_ini`,`via_hora_fin`,`via_millas`,`via_tipo_paq`,`via_cant_per`,`fk_pre_id`,`fk_via_id_origen`,`fk_via_id_destino`,`fk_flo_id`,`via_hotel`) VALUES(NULL,'Viaje','$hola','$fecha','$fecha1','$horita','10:00:00',NULL,NULL,'$cantper',null,'$viaorigen','$viadestino','$flota1',null)");
					
$resc3=mysql_query("SELECT MAX(via_id) AS max  FROM viaje");
			$roc3 = mysql_fetch_array($resc3);
		    $viaje=$roc3['max'];
//echo($viaje);

//$Fecha= date('d-m-Y');

 $millas=mysql_query("SELECT via_millas FROM  via v where  via_id='$viadestino'");
						$romillas = mysql_fetch_array($millas);
						$millitas=$romillas['via_millas'];
						//echo($millitas);
						
					$millas2=mysql_query("SELECT per_cant_millas FROM  persona  where  per_cedula='$cedula'");
						$romillas2 = mysql_fetch_array($millas2);
						$actualmi=$romillas2['per_cant_millas'];	
					//echo($actualmi);
						
				 mysql_query("UPDATE `persona` SET  `per_cant_millas` = ($actualmi+$millitas) WHERE  `persona`.`per_cedula` = '$cedula'");	


//echo($viaje);
			mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto','2011-06-18',$viaje)");
			//echo($viaje);
		
			
			
			$resa=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$roa = mysql_fetch_array($resa);
		    $pago=$roa['max'];
			
			  mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto2','2011-06-18',$viaje)");
			
				$resc=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$roc = mysql_fetch_array($resc);
		    $pago2=$roc['max'];
			
			 			   mysql_query("INSERT INTO `tarjeta` (`tar_id`,`tar_num`,`tar_cvv2`,`tar_nombre`,`tar_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero','$cvv2','$nombre','$fechapago','$cedula','$combo')");
					
					 $resf=mysql_query("SELECT tar_id FROM  tarjeta where tar_num='$numero' AND fk_per_cedula='$cedula'");
                       $rof = mysql_fetch_array($resf);
                       $tarjeta=$rof['tar_id'];		
			          //echo($tarjeta);
					   
					   
					   
					     mysql_query("INSERT INTO `deposito` (`dep_id`,`dep_numero`,`dep_cuenta`,`dep_fecha`,`fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero2','$cvv22','$fechapago2','$cedula','$combo2')");	
						
						$resh=mysql_query("SELECT dep_id FROM  deposito where dep_numero='$numero2'");
                       $roh = mysql_fetch_array($resh);
                       $deposito=$roh['dep_id'];		
			           //echo($deposito);
					   //echo($deposito);
					   
					   
					   				   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago','$tarjeta',NULL,NULL,NULL)");
					   
					    mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago2',NULL,null,'$deposito',NULL)");	
					   

					  
					   
					   $hola1='u_continuar_compra_undestino_conestadia_terrestre.php?viaje='.$viaje.'&cantper='.$cantper.'&cedula='.$cedula.'&mensaje=2&preg='.$preg.'';
				 header("Location:$hola1");
				 
				
					   
			}// if solo esta lleno tarjeta y deposito
			
		
			
			
			
			// cheque y deposito
			if($comboaux2  && $comboaux1 && $fechapagoaux1 && $fechapagoaux2  && $numeroaux2 && $numeroaux1 && $nombreaux1  && $cvv2aux1 && $cvv2aux2  && $montoaux1 && $montoaux2 ) {
				 //echo("if el chequedep");
                 
						
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
						$reschao=mysql_query("SELECT ter_id FROM terrestre where ter_nombre='$aerolinea'");
						$rochao = mysql_fetch_array($reschao);
						$aerid1=$rochao['ter_id'];	
						
						
						$reshola=mysql_query("SELECT flo_id FROM  flota f , viaje v where  f.fk_ter_id='$aerid1' and (f.flo_actual>0)");
						$rohola = mysql_fetch_array($reshola);
						$flota1=$rohola['flo_id'];	
			          //echo($flota1);
					  
					  mysql_query("UPDATE `flota` SET  `flo_actual` =(flo_actual-$cantper)  WHERE  `flota`.`flo_id` = $flota1");
				   if($cantper==1)
			  {
				  $hola="Solo";}
				 if($cantper==2)
			  {
				  $hola="En pareja";}
				  
				   if($cantper>2)
			  {
				    $hola="En familia";}
				  
	$result6= mysql_query("SELECT c.cos_hora FROM  costo c WHERE c.fk_via_origen=$viaorigen AND c.fk_via_destino=$viadestino");
$row6 = mysql_fetch_array($result6);
$horita=$row6['cos_hora'];							
		mysql_query("INSERT INTO `viaje` (`via_id`,`via_tipo`,`via_tipoviaje`,`via_fecha_ini`,`via_fecha_fin`,`via_hora_ini`,`via_hora_fin`,`via_millas`,`via_tipo_paq`,`via_cant_per`,`fk_pre_id`,`fk_via_id_origen`,`fk_via_id_destino`,`fk_flo_id`,`via_hotel`) VALUES(NULL,'Viaje','$hola','$fecha','$fecha1','$horita','10:00:00',NULL,NULL,'$cantper',null,'$viaorigen','$viadestino','$flota1',null)");
					
$resc3=mysql_query("SELECT MAX(via_id) AS max  FROM viaje");
			$roc3 = mysql_fetch_array($resc3);
		    $viaje=$roc3['max'];
//echo($viaje);

//$Fecha= date('d-m-Y');

 $millas=mysql_query("SELECT via_millas FROM  via v where  via_id='$viadestino'");
						$romillas = mysql_fetch_array($millas);
						$millitas=$romillas['via_millas'];
						//echo($millitas);
						
					$millas2=mysql_query("SELECT per_cant_millas FROM  persona  where  per_cedula='$cedula'");
						$romillas2 = mysql_fetch_array($millas2);
						$actualmi=$romillas2['per_cant_millas'];	
					//echo($actualmi);
						
				 mysql_query("UPDATE `persona` SET  `per_cant_millas` = ($actualmi+$millitas) WHERE  `persona`.`per_cedula` = '$cedula'");	


//echo($viaje);
			
			//echo($viaje);
			
			
		

				 
					 mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto1','2011-06-18',$viaje)");
					
					  
				//echo($montoaux);
				//echo($montoaux1);
				//echo($montoaux2);	   
					   
			$resb=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$rob = mysql_fetch_array($resb);
		    $pago1=$rob['max'];
			
			  mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto2','2011-06-18',$viaje)");

			
			$resc=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$roc = mysql_fetch_array($resc);
		    $pago2=$roc['max'];
			//echo($pago1);
			//echo("pago1");
			
			            
					  mysql_query("INSERT INTO `cheque` (`che_id`,`che_num`,`che_cuenta`,`che_nombre`,`che_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero1','$cvv21','$nombre1','$fechapago1','$cedula','$combo1')");
						
						$resg=mysql_query("SELECT che_id FROM  cheque where che_num='$numero1'");
                       $rog = mysql_fetch_array($resg);
                       $cheque=$rog['che_id'];		
			           //echo($cheque);	
					   //echo($cheque);
			 			  
					   
					   
					   
					     mysql_query("INSERT INTO `deposito` (`dep_id`,`dep_numero`,`dep_cuenta`,`dep_fecha`,`fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero2','$cvv22','$fechapago2','$cedula','$combo2')");	
						
						$resh=mysql_query("SELECT dep_id FROM  deposito where dep_numero='$numero2'");
                       $roh = mysql_fetch_array($resh);
                       $deposito=$roh['dep_id'];		
			           //echo($deposito);
					   //echo($deposito);
					   
					   
					   				   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago1',null,'$cheque',NULL,NULL)");
					   
					    mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago2',NULL,null,'$deposito',NULL)");	
					   

					  
					mysql_query("UPDATE `presupuesto` SET  `pre_status` = 'Comprado' WHERE  `presupuesto`.`pre_id` = $id");
					   
					   $hola1='u_continuar_compra_undestino_conestadia_terrestre.php?viaje='.$viaje.'&cantper='.$cantper.'&cedula='.$cedula.'&mensaje=2&preg='.$preg.'';
				 header("Location:$hola1");
				 	}// if solo esta lleno cheque y y deposito
				 
				
				
				
				}
			
			
					 
					 
					 
					 
			
					 
					 
				
				 }//del if inserto
				 
				 else// si no llego a la totalidad dell monto cuando es especial
				 {
					 if ($suma<($total+$abono1))
					 {
					
					 if($montoaux && $montoaux1 && $montoaux2)
					 {
					 echo("aca");
						mysql_query("INSERT INTO `tarjeta` (`tar_id`,`tar_num`,`tar_cvv2`,`tar_nombre`,`tar_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero','$cvv2','$nombre','$fechapago','$cedula','$combo')");
						
					  $resf=mysql_query("SELECT tar_id FROM  tarjeta where tar_num='$numero' AND fk_per_cedula='$cedula'");
                       $rof = mysql_fetch_array($resf);
                       $tarjeta=$rof['tar_id'];		
			           //echo($tarjeta);
					   
					   	mysql_query("INSERT INTO `cheque` (`che_id`,`che_num`,`che_cuenta`,`che_nombre`,`che_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero1','$cvv21','$nombre1','$fechapago1','$cedula','$combo1')");
						
						$resg=mysql_query("SELECT che_id FROM  cheque where che_num='$numero'");
                       $rog = mysql_fetch_array($resg);
                       $cheque=$rog['che_id'];		
			           //echo($cheque);	
					   
					   mysql_query("INSERT INTO `deposito` (`dep_id`,`dep_numero`,`dep_cuenta`,`dep_fecha`,`fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero2','$cvv22','$fechapago2','$cedula','$combo2')");	
						
						$resh=mysql_query("SELECT dep_id FROM  deposito where dep_numero='$numero'");
                       $roh = mysql_fetch_array($resh);
                       $deposito=$roh['dep_id'];		
			           //echo($deposito);
					   
					   	
					 mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto','2011-06-18',$viaje)");
					 
					 $resa=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$roa = mysql_fetch_array($resa);
		    $pago=$roa['max'];
					 
					  mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto1','2011-06-18',$viaje)");
					  
					   $resb=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$rob = mysql_fetch_array($resb);
		    $pago1=$rob['max'];
					 
					  
					   mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto2','2011-06-18',$viaje)");
					   
					   
					    $resc=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$roc = mysql_fetch_array($resc);
		    $pago2=$roc['max'];
					   
					   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago','$tarjeta',NULL,NULL,NULL)");		
						
					
			
					   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago1',NULL,'$cheque',NULL,NULL)");		
						
					
					
				
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago2',NULL,NULL,'$deposito',NULL)");
					//si esta el presu 	
					 $dime=mysql_query("SELECT `pre_id` FROM  presupuesto p  where p.pre_paq='$id' and p.fk_per_cedula='$cedula' and p.pre_status='No comprado'");
							$rodime = mysql_fetch_array($dime);
						    $dimeya=$rodime['pre_id'];	
						 
						$antes=mysql_query("SELECT `pre_abono` FROM  presupuesto p WHERE p.pre_paq='$id' and p.fk_per_cedula='$cedula'");
			             $antesb = mysql_fetch_array($antes);
		                 $antes1=$antesb['pre_abono'];
						
						
						echo("dimeya");
						 echo($dimeya);
					 
					 if ($dimeya== NULL )
					 {
					
						
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
						$reschao=mysql_query("SELECT ter_id FROM terrestre where ter_nombre='$aerolinea'");
						$rochao = mysql_fetch_array($reschao);
						$aerid1=$rochao['ter_id'];	
						
						
						$reshola=mysql_query("SELECT flo_id FROM  flota f , viaje v where  f.fk_ter_id='$aerid1' and (f.flo_actual>0)");
						$rohola = mysql_fetch_array($reshola);
						$flota1=$rohola['flo_id'];	
			          //echo($flota1);
						//$quedate1=$_POST['$quedate'];	
						
							 
							 //echo("$quedate1,$total,$cantper,$cedula,$viaorigen,$viadestino,($montoaux+$montoaux1+$montoaux2),$id");
								$mierda=$monto+$monto1+$monto2;
								//echo($mierda);
								//echo("entro aqui");
							 mysql_query("INSERT INTO `presupuesto` (`pre_id`, `pre_fecha`,`pre_habitacion`,`pre_servicio`,`pre_paseo`,`pre_total`,`pre_cant_per`,`fk_per_cedula`,`fk_via_id_origen`, `fk_via_id_destino`,`pre_abono`,`pre_status`,`pre_paq`,`pre_pro`) VALUES (NULL ,'2011-06-18',null,NULL,NULL, '$total','$cantper', '$cedula','$viaorigen', '$viadestino',$mierda,'No comprado','$id',null)");
					 }
					 else
					 {
						 
						 
						 
						 mysql_query("UPDATE `presupuesto` SET  `pre_abono` = ($antes1+$monto+$monto1+$monto2) WHERE  `presupuesto`.`pre_paq` = $id and `presupuesto`.`fk_per_cedula` = '$cedula'");

					 }
						 
						  $hola1='u_paquete_sinestadia_terrestre1.php?mensaje=2';
				           header("Location:$hola1");
						 
						 }
						 //echo("$montoaux,$montoaux1,$montoaux2");
						  // echo("hola"); 
						   
						   if ($monto && $monto1 && ($monto2==NULL) )
						 {
							  echo("sii");
							 mysql_query("INSERT INTO `tarjeta` (`tar_id`,`tar_num`,`tar_cvv2`,`tar_nombre`,`tar_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero','$cvv2','$nombre','$fechapago','$cedula','$combo')");
						
					  $resf=mysql_query("SELECT tar_id FROM  tarjeta where tar_num='$numero' AND fk_per_cedula='$cedula'");
                       $rof = mysql_fetch_array($resf);
                       $tarjeta=$rof['tar_id'];		
			           //echo($tarjeta);
					   
					   	mysql_query("INSERT INTO `cheque` (`che_id`,`che_num`,`che_cuenta`,`che_nombre`,`che_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero1','$cvv21','$nombre1','$fechapago1','$cedula','$combo1')");
						
						$resg=mysql_query("SELECT che_id FROM  cheque where che_num='$numero'");
                       $rog = mysql_fetch_array($resg);
                       $cheque=$rog['che_id'];		
			           //echo($cheque);	
					   
							   mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto','2011-06-18',$viaje)");
					 
					 $resa=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$roa = mysql_fetch_array($resa);
		    $pago=$roa['max'];
					 
					  mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto1','2011-06-18',$viaje)");
					  
					   $resb=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$rob = mysql_fetch_array($resb);
		    $pago1=$rob['max'];
					   	
					
							   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago','$tarjeta',NULL,NULL,NULL)");		
						
					
			
					   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago1',NULL,'$cheque',NULL,NULL)");		
						
							
							 $dime=mysql_query("SELECT `pre_id` FROM  presupuesto p  where p.pre_paq='$id' and p.fk_per_cedula='$cedula' and p.pre_status='No comprado'");
							$rodime = mysql_fetch_array($dime);
						    $dimeya=$rodime['pre_id'];	
						 
						 $antes=mysql_query("SELECT `pre_abono` FROM  presupuesto p WHERE p.pre_paq='$id' and p.fk_per_cedula='$cedula'");
			             $antesb = mysql_fetch_array($antes);
		                 $antes1=$antesb['pre_abono'];
					 
					 if ($dimeya== NULL )
					 {
					
							
						
						$$res4=mysql_query("SELECT ter_id FROM  terrestre where ter_nombre='$aerolinea'");
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
						$reschao=mysql_query("SELECT ter_id FROM terrestre where ter_nombre='$aerolinea'");
						$rochao = mysql_fetch_array($reschao);
						$aerid1=$rochao['ter_id'];	
						
						
						$reshola=mysql_query("SELECT flo_id FROM  flota f , viaje v where  f.fk_ter_id='$aerid1' and (f.flo_actual>0)");
						$rohola = mysql_fetch_array($reshola);
						$flota1=$rohola['flo_id'];	
			          //echo($flota1);
							 
							mysql_query("INSERT INTO `presupuesto` (`pre_id`, `pre_fecha`,`pre_habitacion`,`pre_servicio`,`pre_paseo`,`pre_total`,`pre_cant_per`,`fk_per_cedula`, `fk_via_id_origen`, `fk_via_id_destino`,`pre_abono`,`pre_status`,`pre_paq`,`pre_pro`) VALUES (NULL ,'2011-06-18',null,NULL,NULL, '$total','$cantper', '$cedula','$viaorigen', '$viadestino',$monto+$monto1,'No comprado','$id',null)");
					 }
					 else
					 {
						 
						 
						 echo("en el else de tar y che ");
						 mysql_query("UPDATE `presupuesto` SET  `pre_abono` = ($antes1+$monto+$monto1) WHERE  `presupuesto`.`pre_paq` = $id and `presupuesto`.`fk_per_cedula` = '$cedula'");
					 }
						 
							
							
							  
							  
							   $hola1='u_paquete_sinestadia_terrestre1.php?mensaje=2';
				           header("Location:$hola1");
						 
						 
							 }
							 
							 
							 
							 
							 
							   if ($montoaux && $montoaux2 && ($montoaux1==NULL))
						 {
							 
							 echo("tarjeta y deposito") ;
							 mysql_query("INSERT INTO `tarjeta` (`tar_id`,`tar_num`,`tar_cvv2`,`tar_nombre`,`tar_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero','$cvv2','$nombre','$fechapago','$cedula','$combo')");
						
					  $resf=mysql_query("SELECT tar_id FROM  tarjeta where tar_num='$numero' AND fk_per_cedula='$cedula'");
                       $rof = mysql_fetch_array($resf);
                       $tarjeta=$rof['tar_id'];
					   
					     
					   mysql_query("INSERT INTO `deposito` (`dep_id`,`dep_numero`,`dep_cuenta`,`dep_fecha`,`fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero2','$cvv22','$fechapago2','$cedula','$combo2')");	
						
						$resh=mysql_query("SELECT dep_id FROM  deposito where dep_numero='$numero'");
                       $roh = mysql_fetch_array($resh);
                       $deposito=$roh['dep_id'];		
			           //echo($deposito);
					   
					   	
					 mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto','2011-06-18',$viaje)");
					 
					 $resa=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$roa = mysql_fetch_array($resa);
		    $pago=$roa['max'];
			
			
					   mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto2','2011-06-18',$viaje)");
					   
					   
					    $resc=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$roc = mysql_fetch_array($resc);
		    $pago2=$roc['max'];
					   
					   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago','$tarjeta',NULL,NULL,NULL)");		
						
					
				
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago2',NULL,NULL,'$deposito',NULL)");
								
							 $dime=mysql_query("SELECT `pre_id` FROM  presupuesto p  where p.pre_paq='$id' and p.fk_per_cedula='$cedula' and p.pre_status='No comprado'");
							$rodime = mysql_fetch_array($dime);
						$dimeya=$rodime['pre_id'];	
						 
						 $antes=mysql_query("SELECT `pre_abono` FROM  presupuesto p WHERE p.pre_paq='$id' and p.fk_per_cedula='$cedula'");
			             $antesb = mysql_fetch_array($antes);
		                 $antes1=$antesb['pre_abono'];
					 
					 if ($dimeya== NULL )
					 {
					
							 
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
						$reschao=mysql_query("SELECT ter_id FROM terrestre where ter_nombre='$aerolinea'");
						$rochao = mysql_fetch_array($reschao);
						$aerid1=$rochao['ter_id'];	
						
						
						$reshola=mysql_query("SELECT flo_id FROM  flota f , viaje v where  f.fk_ter_id='$aerid1' and (f.flo_actual>0)");
						$rohola = mysql_fetch_array($reshola);
						$flota1=$rohola['flo_id'];	
			          //echo($flota1);
							 
							mysql_query("INSERT INTO `presupuesto` (`pre_id`, `pre_fecha`,`pre_habitacion`,`pre_servicio`,`pre_paseo`,`pre_total`,`pre_cant_per`,`fk_per_cedula`, `fk_via_id_origen`, `fk_via_id_destino`,`pre_abono`,`pre_status`,`pre_paq`,`pre_pro`) VALUES (NULL ,'2011-06-18',NULL,NULL, '$total','$cantper', '$cedula','$viaorigen', '$viadestino',($monto+$monto2),'No comprado','$id',null)");
					 }
					 else
					 {
						 
						 
						 
						 mysql_query("UPDATE `presupuesto` SET  `pre_abono` = ($antes1+$monto+$monto2) WHERE  `presupuesto`.`pre_paq` = $id and `presupuesto`.`fk_per_cedula` = '$cedula'");
					 }
						 
							
							
							  
							   $hola1='u_paquete_sinestadia_terrestre1.php?mensaje=2';
				           header("Location:$hola1");
						 
						 
							 }
							 
							 
							 
							 
							   if ($montoaux1 && $montoaux2 && ($montoaux==NULL))
						 {
						  echo("en el de cheque y deposito");
							  	mysql_query("INSERT INTO `cheque` (`che_id`,`che_num`,`che_cuenta`,`che_nombre`,`che_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero1','$cvv21','$nombre1','$fechapago1','$cedula','$combo1')");
						
						$resg=mysql_query("SELECT che_id FROM  cheque where che_num='$numero'");
                       $rog = mysql_fetch_array($resg);
                       $cheque=$rog['che_id'];		
			           //echo($cheque);	
					   
					   mysql_query("INSERT INTO `deposito` (`dep_id`,`dep_numero`,`dep_cuenta`,`dep_fecha`,`fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero2','$cvv22','$fechapago2','$cedula','$combo2')");	
						
						$resh=mysql_query("SELECT dep_id FROM  deposito where dep_numero='$numero'");
                       $roh = mysql_fetch_array($resh);
                       $deposito=$roh['dep_id'];		
			           //echo($deposito);
					   
					   	
					
					 
					  mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto1','2011-06-18',$viaje)");
					  
					   $resb=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$rob = mysql_fetch_array($resb);
		    $pago1=$rob['max'];
					 
					  
					   mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto2','2011-06-18',$viaje)");
					   
					   
					    $resc=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$roc = mysql_fetch_array($resc);
		    $pago2=$roc['max'];
					   
					   
				
					   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago1',NULL,'$cheque',NULL,NULL)");		
						
					
					
				
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago2',NULL,NULL,'$deposito',NULL)");
						
						$dime=mysql_query("SELECT `pre_id` FROM  presupuesto p  where p.pre_paq='$id' and p.fk_per_cedula='$cedula' and p.pre_status='No comprado'");
						$rodime = mysql_fetch_array($dime);
						$dimeya=$rodime['pre_id'];	
						 
						 $antes=mysql_query("SELECT `pre_abono` FROM  presupuesto p WHERE p.pre_paq='$id' and p.fk_per_cedula='$cedula'");
			             $antesb = mysql_fetch_array($antes);
		                 $antes1=$antesb['pre_abono'];
					 
					 if ($dimeya== NULL )
					 {
					
							 
							
						
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
						$reschao=mysql_query("SELECT ter_id FROM terrestre where ter_nombre='$aerolinea'");
						$rochao = mysql_fetch_array($reschao);
						$aerid1=$rochao['ter_id'];	
						
						
						$reshola=mysql_query("SELECT flo_id FROM  flota f , viaje v where  f.fk_ter_id='$aerid1' and (f.flo_actual>0)");
						$rohola = mysql_fetch_array($reshola);
						$flota1=$rohola['flo_id'];	
			          //echo($flota1);
							 
							 mysql_query("INSERT INTO `presupuesto` (`pre_id`, `pre_fecha`,`pre_habitacion`,`pre_servicio`,`pre_paseo`,`pre_total`,`pre_cant_per`,`fk_per_cedula`, `fk_via_id_origen`, `fk_via_id_destino`,`pre_abono`,`pre_status`,`pre_paq`,`pre_pro`) VALUES (NULL ,'2011-06-18',null,NULL,NULL, '$total','$cantper', '$cedula','$viaorigen', '$viadestino',($monto1+$monto2),'No comprado','$id',null)");
					 }
					 else
					 {
						 
						 
						 
						 mysql_query("UPDATE `presupuesto` SET  `pre_abono` = ($antes1+$monto1+$monto2) WHERE  `presupuesto`.`pre_paq` = $id and `presupuesto`.`fk_per_cedula` = '$cedula'");
					 }
						 
							  
							   $hola1='u_paquete_sinestadia_terrestre1.php?mensaje=2';
				           header("Location:$hola1");
						 
						 
							 }
							 
							  if ($montoaux && ($montoaux1==NULL) && ($montoaux2==NULL))
						 {
							 
							  mysql_query("INSERT INTO `tarjeta` (`tar_id`,`tar_num`,`tar_cvv2`,`tar_nombre`,`tar_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero','$cvv2','$nombre','$fechapago','$cedula','$combo')");
						
					  $resf=mysql_query("SELECT tar_id FROM  tarjeta where tar_num='$numero' AND fk_per_cedula='$cedula'");
                       $rof = mysql_fetch_array($resf);
                       $tarjeta=$rof['tar_id'];
					   
					     
					  
					   
					   	
					 mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto','2011-06-18',$viaje)");
					 
					 $resa=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$roa = mysql_fetch_array($resa);
		    $pago=$roa['max'];
			
			
					   
					   
					   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago','$tarjeta',NULL,NULL,NULL)");		
			
			$dime=mysql_query("SELECT `pre_id` FROM  presupuesto p  where p.pre_paq='$id' and p.fk_per_cedula='$cedula' and p.pre_status='No comprado'");
			$rodime = mysql_fetch_array($dime);
						$dimeya=$rodime['pre_id'];	
						 
						$antes=mysql_query("SELECT `pre_abono` FROM  presupuesto p WHERE p.pre_paq='$id' and p.fk_per_cedula='$cedula'");
			             $antesb = mysql_fetch_array($antes);
		                 $antes1=$antesb['pre_abono'];
					 
					 if ($dimeya== NULL )
					 {
					
							 
						
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
						$reschao=mysql_query("SELECT ter_id FROM terrestre where ter_nombre='$aerolinea'");
						$rochao = mysql_fetch_array($reschao);
						$aerid1=$rochao['ter_id'];	
						
						
						$reshola=mysql_query("SELECT flo_id FROM  flota f , viaje v where  f.fk_ter_id='$aerid1' and (f.flo_actual>0)");
						$rohola = mysql_fetch_array($reshola);
						$flota1=$rohola['flo_id'];	
			          //echo($flota1);
							 
							mysql_query("INSERT INTO `presupuesto` (`pre_id`, `pre_fecha`,`pre_habitacion`,`pre_servicio`,`pre_paseo`,`pre_total`,`pre_cant_per`,`fk_per_cedula`, `fk_via_id_origen`, `fk_via_id_destino`,`pre_abono`,`pre_status`,`pre_paq`,`pre_pro`) VALUES (NULL ,'2011-06-18',null,NULL,NULL, '$total','$cantper', '$cedula','$viaorigen', '$viadestino',($monto),'No comprado','$id',null)");
					 }
					 else
					 {
						 
						 
						 
						 mysql_query("UPDATE `presupuesto` SET  `pre_abono` = ($antes1+$monto) WHERE  `presupuesto`.`pre_paq` = $id and `presupuesto`.`fk_per_cedula` = '$cedula'");
					 }
						 
			
			
							  
							   $hola1='u_paquete_sinestadia_terrestre1.php?mensaje=2';
				           header("Location:$hola1");
						 
						 
							 }
							 
							  if ($montoaux1 && ($montoaux==NULL) && ($montoaux2==NULL))
						 {
							 
							 
							  	mysql_query("INSERT INTO `cheque` (`che_id`,`che_num`,`che_cuenta`,`che_nombre`,`che_fechaven`, `fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero1','$cvv21','$nombre1','$fechapago1','$cedula','$combo1')");
						
						$resg=mysql_query("SELECT che_id FROM  cheque where che_num='$numero'");
                       $rog = mysql_fetch_array($resg);
                       $cheque=$rog['che_id'];		
			           //echo($cheque);	
					   
					  
					   	
					
					 
					  mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto1','2011-06-18',$viaje)");
					  
					   $resb=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$rob = mysql_fetch_array($resb);
		    $pago1=$rob['max'];
					 
					 
					   
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago1',NULL,'$cheque',NULL,NULL)");	
					   	
			 $dime=mysql_query("SELECT `pre_id` FROM  presupuesto p  where p.pre_paq='$id' and p.fk_per_cedula='$cedula' and p.pre_status='No comprado'");
			$rodime = mysql_fetch_array($dime);
						$dimeya=$rodime['pre_id'];	
						 
						$antes=mysql_query("SELECT `pre_abono` FROM  presupuesto p WHERE p.pre_paq='$id' and p.fk_per_cedula='$cedula'");
			             $antesb = mysql_fetch_array($antes);
		                 $antes1=$antesb['pre_abono'];

					 
					 if ($dimeya== NULL )
					 {
					
							 
						
						
						$$res4=mysql_query("SELECT ter_id FROM  terrestre where ter_nombre='$aerolinea'");
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
						$reschao=mysql_query("SELECT ter_id FROM terrestre where ter_nombre='$aerolinea'");
						$rochao = mysql_fetch_array($reschao);
						$aerid1=$rochao['ter_id'];	
						
						
						$reshola=mysql_query("SELECT flo_id FROM  flota f , viaje v where  f.fk_ter_id='$aerid1' and (f.flo_actual>0)");
						$rohola = mysql_fetch_array($reshola);
						$flota1=$rohola['flo_id'];	
			          //echo($flota1);
							 
							 
							 mysql_query("INSERT INTO `presupuesto` (`pre_id`, `pre_fecha`,`pre_habitacion`,`pre_servicio`,`pre_paseo`,`pre_total`,`pre_cant_per`,`fk_per_cedula`, `fk_via_id_origen`, `fk_via_id_destino`,`pre_abono`,`pre_status`,`pre_paq`,`pre_pro`) VALUES (NULL ,'2011-06-18',null,NULL,NULL, '$total','$cantper', '$cedula','$viaorigen', '$viadestino',($monto1),'No comprado','$id',null)");
					 }
					 else
					 {
						 
						 
						 
						 mysql_query("UPDATE `presupuesto` SET  `pre_abono` = ($antes1+$monto1) WHERE  `presupuesto`.`pre_paq` = $id and `presupuesto`.`fk_per_cedula` = '$cedula'");
					 }
						 
			
			
							  
							   $hola1='u_paquete_sinestadia_terrestre1.php?mensaje=2';
				           header("Location:$hola1");
						 
						 
							 }
							 
							  if ($montoaux2 && ($montoaux1==NULL) && ($montoaux==NULL))
						 {
							 
							 
							  	
					   
					   mysql_query("INSERT INTO `deposito` (`dep_id`,`dep_numero`,`dep_cuenta`,`dep_fecha`,`fk_per_cedula`,`fk_ban_id`) VALUES(NULL,'$numero2','$cvv22','$fechapago2','$cedula','$combo2')");	
						
						$resh=mysql_query("SELECT dep_id FROM  deposito where dep_numero='$numero'");
                       $roh = mysql_fetch_array($resh);
                       $deposito=$roh['dep_id'];		
			           //echo($deposito);
					   
					 
					  
					   mysql_query("INSERT INTO `pago` (`pag_id`,`pag_monto`,`pag_fecha`,`fk_via_id`) VALUES(NULL,'$monto2','2011-06-18',$viaje)");
					   
					   
					    $resc=mysql_query("SELECT MAX(pag_id) AS max  FROM  pago");
			$roc = mysql_fetch_array($resc);
		    $pago2=$roc['max'];
					   
					   
				
	
					   mysql_query("INSERT INTO `tip_pag` (`tip_id`,`fk_pag_id`,`fk_tar_id`,`fk_che_id`,`fk_dep_id`,`fk_mil_id`) VALUES(NULL,'$pago2',NULL,NULL,'$deposito',NULL)");
	
	 $dime=mysql_query("SELECT `pre_id` FROM  presupuesto p  where p.pre_paq='$id' and p.fk_per_cedula='$cedula' and p.pre_status='No comprado'");					
	$rodime = mysql_fetch_array($dime);
						$dimeya=$rodime['pre_id'];	
						 
						$antes=mysql_query("SELECT `pre_abono` FROM  presupuesto p WHERE p.pre_paq='$id' and p.fk_per_cedula='$cedula'");
			             $antesb = mysql_fetch_array($antes);
		                 $antes1=$antesb['pre_abono'];
					 
					 if ($dimeya== NULL )
					 {
					
							 
							
						
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
						$reschao=mysql_query("SELECT ter_id FROM terrestre where ter_nombre='$aerolinea'");
						$rochao = mysql_fetch_array($reschao);
						$aerid1=$rochao['ter_id'];	
						
						
						$reshola=mysql_query("SELECT flo_id FROM  flota f , viaje v where  f.fk_ter_id='$aerid1' and (f.flo_actual>0)");
						$rohola = mysql_fetch_array($reshola);
						$flota1=$rohola['flo_id'];	
			          //echo($flota1);
							 
					 echo("$quedate,$total,$cantper,$cedula,$viaorigen,$viadestino,($montoaux+$montoaux1+$montoaux2),$id");
							mysql_query("INSERT INTO `presupuesto` (`pre_id`, `pre_fecha`,`pre_habitacion`,`pre_servicio`,`pre_paseo`,`pre_total`,`pre_cant_per`,`fk_per_cedula`, `fk_via_id_origen`, `fk_via_id_destino`,`pre_abono`,`pre_status`,`pre_paq`,`pre_pro`) VALUES (NULL ,'2011-06-18',NULL,NULL, '$total','$cantper', '$cedula','$viaorigen', '$viadestino',($monto2),'No comprado','$id',null)");
					 }
					 else
					 {
						 
						 
						 
						 mysql_query("UPDATE `presupuesto` SET  `pre_abono` = ($antes1+$monto2) WHERE  `presupuesto`.`pre_paq` = $id and `presupuesto`.`fk_per_cedula` = '$cedula'");
					 }
						 
							  
							   $hola1='u_paquete_sinestadia_terrestre1.php?mensaje=2';
				           header("Location:$hola1");
						 
						 
							 }
					 
					 
					 }
					 else // el monto es mayor al total 
					 {
						 $hola1='u_monto_error_terrestre1.php?mensaje=2';
				           header("Location:$hola1");
						 
						 } 
			
				 
				 }
			
					 
		
			
			
			}//fin del else de pago cuotas
			
		
			
			
			}// del else especial 
			 }
	else

		{

			$hola1='u_flota_errorP_sinestadia_terrestre.php?mensaje=2';

						header("Location:$hola1");

		}	 				
			 	
	
		  }// primer if
	     
		  else
		  {//aqui pinta el editor por primera vez	
		              
					$admin= new Panel("../html/usuario.html");
					$admin->add("body",'<body onLoad = "actual(3)" >');
					$panelestadios = new Panel("../html/u_comprar_paquete_sinestadia_terrestre.html");
					$panelestadios->add("form",'<form name="form1" method="post" action="../php/u_comprar_paquete_sinestadia_terrestre.php?id='.$id.'&aerolinea='.$aerolinea.'&origen='.$origen.'&destino='.$destino.'&hotel='.$hotel.'&habitacion='.$habitacion.'&servicio='.$servicio.'&paseo='.$paseo.'&total='.$total.'&cantper='.$cantper.'&tipo='.$tipo.'&fechapago='.$fechapago.'&numero='.$numero.'&combo='.$combo.'&nombre='.$nombre.'&cvv2='.$cvv2.'&monto='.$monto.'&monto1='.$monto1.'&monto2='.$monto2.'&fecha='.$fechai.'&fecha='.$fechaf.'&monto3='.$monto3.'&monto4='.$monto4.'&tipoviaje='.$servicio.'&quedate='.$quedate.'">');
					
		//echo($tipopaq);			 
    if ($tipopaq=="Turistico")
	{					 
					 
					 $ok=mysql_query("SELECT `pre_abono` FROM  presupuesto WHERE fk_per_cedula='$cedula' and pre_paq='$id'");
			         $rowok = mysql_fetch_array($ok);
		              $mete=$rowok['pre_abono'];
							 
					
							 
				$costo=mysql_query("SELECT c.cos_costo FROM  costo c WHERE c.fk_via_origen='$fkvia' AND c.fk_via_destino='$fkvia2'");
				$rocosto = mysql_fetch_array($costo);
			     $valor=$rocosto['cos_costo'];
					
			            if ($mete!= NULL)
						{
							$total2=($valor*$cantper)-$mete	;
						 $panelestadios->add("total",$total1);
						
						}
						else
					         $total2=($valor*$cantper);
						 $panelestadios->add("total",$total1);
		
						//echo($total1);
					//$aa=2;
					//$bb=3;
					//echo($cantper);
					//$panelestadios->add("cue_numero",$tipoviaje);
					//$panelestadios->add("fecha",$bb);
					//$panelestadios->add("fecha1",$aa);
					
					$panelestadios->add("aerolinea",$aerolinea);
					$panelestadios->add("origen",$origen);
					$panelestadios->add("destino",$destino);
					
					$panelestadios->add("habitacion",$millas);
					 $panelestadios->add("servicio",$tipoviaje);
					 $panelestadios->add("tipopaq",$tipopaq);
					  $panelestadios->add("total",$total2);
					  $panelestadios->add("cantper",$cantper);
					   $panelestadios->add("id",$id);
					  $panelestadios->add("forma",'<option>Pago Unico</option><option>Pago en cuotas</option>');
					  
					  
					 
					 	
					 
					 
						
						 $ok1=mysql_query("SELECT `pre_abono` FROM  presupuesto WHERE fk_per_cedula='$cedula' and pre_paq='$id' AND pre_status='No comprado'");
			         $rowok = mysql_fetch_array($ok1);
		              $mete1=$rowok['pre_abono'];
						
						if ($mete1!= NULL)
						$total2=$total-$mete1;
						else
						$total2=$total;
							
					
					if ($selected && $fechai && $fechaf)
					{
				//	echo("1");
					//$panelestadios->add("cue_numero",$tipoviaje);
					
						//echo("$total, $total2,$costico");
					
					$panelestadios->add("aerolinea",$aerolinea);
					$panelestadios->add("origen",$origen);
					$panelestadios->add("destino",$destino);
			
						$panelestadios->add("habitacion",$millas);
				 $panelestadios->add("servicio",$servicio);
					 $panelestadios->add("tipopaq",$tipopaq);
					  $panelestadios->add("total",$total2);
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
							
							
			
			if(($selected=="Pago Unico") && $aerolinea && $fechaf && $fechai && $habitacion && $origen && $destino  && $servicio &&  $total )
				{
					
					 
					
				$panelestadios->add("cue_numero",$tipoviaje);
					
					$panelestadios->add("aerolinea",$aerolinea);
					$panelestadios->add("origen",$origen);
					$panelestadios->add("destino",$destino);
					
				$panelestadios->add("habitacion",$habitacion);
					 $panelestadios->add("servicio",$servicio);
				 $panelestadios->add("tipopaq",$tipopaq);
					  $panelestadios->add("total",$total2);
					 $panelestadios->add("cantper",$cantper);
					$panelestadios->add("fecha",$fechai);
					$panelestadios->add("fecha1",$fechaf);
					 $panelestadios->add("id",$id);

					/*$select_actual2='<option selected="selected">Pago Unico</option><option>Pago en cuotas</option>'; 	
					$select2=$select2.$select_actual2;
					 $panelestadios->add("forma",$select2);	*/
					
							
							
					
				$panelestadios->add("pago",' <tr><td>Tipo:</td><td><select name="tipo" id="tipo"  onChange="populate2(document.form1,document.form1.formapago.options[document.form1.formapago.selectedIndex].value,document.form1.fecha.value,document.form1.fecha1.value,document.getElementById(\'aerolinea\').innerHTML,document.getElementById(\'origen\').innerHTML,document.getElementById(\'destino\').innerHTML,document.getElementById(\'habitacion\').innerHTML,document.getElementById(\'servicio\').innerHTML,document.getElementById(\'total\').innerHTML,document.getElementById(\'cantper\').innerHTML,document.form1.tipo.options[document.form1.tipo.selectedIndex].value,document.getElementById(\'id\').innerHTML,document.getElementById(\'tipopaq\').innerHTML)"><option selected="selected">Seleccione</option><option>Tarjeta</option><option>Cheque</option><option>Efectivo</option><option>Millas</option></select></td></tr>
    ');
				
				
				
				}
				
				
				
				else if(($selected=="Pago en cuotas") && $aerolinea && $fechaf && $fechai  && $habitacion && $origen && $destino && $servicio && $total )
					{
						//echo("aja");
						
					$panelestadios->add("cue_numero",$tipoviaje);
					 $panelestadios->add("tipopaq",$tipopaq);
					$panelestadios->add("aerolinea",$aerolinea);
					$panelestadios->add("origen",$origen);
					$panelestadios->add("destino",$destino);
					$panelestadios->add("hotel",$hotel);
					$panelestadios->add("habitacion",$habitacion);
					 $panelestadios->add("servicio",$servicio);
					  $panelestadios->add("total",$total2);
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
					if(($selected=="Pago Unico") && $aerolinea && $fechaf && $fechai && $habitacion && $origen && $destino && $servicio && $total && $tipo )
				{
					
					  
				    $panelestadios->add("cue_numero",$tipoviaje);
					 $panelestadios->add("tipopaq",$tipopaq);
					$panelestadios->add("aerolinea",$aerolinea);
					$panelestadios->add("origen",$origen);
					$panelestadios->add("hotel",$hotel);
					$panelestadios->add("destino",$destino);
					$panelestadios->add("habitacion",$habitacion);
					 $panelestadios->add("servicio",$servicio);
					 
					  $panelestadios->add("total",$total);
					 $panelestadios->add("cantper",$cantper);
					$panelestadios->add("fecha",$fechai);
					$panelestadios->add("fecha1",$fechaf);
					 $panelestadios->add("id",$id);
					 
					  

					
				//aqui van los if
				if ($tipo=="Tarjeta"){
				$panelestadios->add("pago",' <tr><td>Tipo:</td><td><select name="tipo" id="tipo"  onChange="populate2(document.form1,document.form1.formapago.options[document.form1.formapago.selectedIndex].value,document.form1.fecha.value,document.form1.fecha1.value,document.getElementById(\'aerolinea\').innerHTML,document.getElementById(\'origen\').innerHTML,document.getElementById(\'destino\').innerHTML,document.getElementById(\'habitacion\').innerHTML,document.getElementById(\'servicio\').innerHTML,document.getElementById(\'total\').innerHTML,document.getElementById(\'cantper\').innerHTML,document.form1.tipo.options[document.form1.tipo.selectedIndex].value,document.getElementById(\'id\').innerHTML,document.getElementById(\'tipopaq\').innerHTML)"><option>Seleccione</option><option  selected="selected">Tarjeta</option><option>Cheque</option><option>Efectivo</option><option>Millas</option></select></td></tr>
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
				$panelestadios->add("pago",' <tr><td>Tipo:</td><td><select name="tipo" id="tipo"  onChange="populate2(document.form1,document.form1.formapago.options[document.form1.formapago.selectedIndex].value,document.form1.fecha.value,document.form1.fecha1.value,document.getElementById(\'aerolinea\').innerHTML,document.getElementById(\'origen\').innerHTML,document.getElementById(\'destino\').innerHTML,document.getElementById(\'habitacion\').innerHTML,document.getElementById(\'servicio\').innerHTML,document.getElementById(\'total\').innerHTML,document.getElementById(\'cantper\').innerHTML,document.form1.tipo.options[document.form1.tipo.selectedIndex].value,document.getElementById(\'id\').innerHTML,document.getElementById(\'tipopaq\').innerHTML)"><option>Seleccione</option><option>Tarjeta</option><option selected="selected">Cheque</option><option>Efectivo</option><option>Millas</option></select></td></tr>
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
				$panelestadios->add("pago",' <tr><td>Tipo:</td><td><select name="tipo" id="tipo"  onChange="populate2(document.form1,document.form1.formapago.options[document.form1.formapago.selectedIndex].value,document.form1.fecha.value,document.form1.fecha1.value,document.getElementById(\'aerolinea\').innerHTML,document.getElementById(\'origen\').innerHTML,document.getElementById(\'destino\').innerHTML,document.getElementById(\'habitacion\').innerHTML,document.getElementById(\'servicio\').innerHTML,document.getElementById(\'total\').innerHTML,document.getElementById(\'cantper\').innerHTML,document.form1.tipo.options[document.form1.tipo.selectedIndex].value,document.getElementById(\'id\').innerHTML,document.getElementById(\'tipopaq\').innerHTML)"><option>Seleccione</option><option>Tarjeta</option><option>Cheque</option><option selected="selected">Efectivo</option><option>Millas</option></select></td></tr>
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
				
				if ($tipo=="Millas"){
				$panelestadios->add("pago",' <tr><td>Tipo:</td><td><select name="tipo" id="tipo"  onChange="populate2(document.form1,document.form1.formapago.options[document.form1.formapago.selectedIndex].value,document.form1.fecha.value,document.form1.fecha1.value,document.getElementById(\'aerolinea\').innerHTML,document.getElementById(\'origen\').innerHTML,document.getElementById(\'destino\').innerHTML,document.getElementById(\'habitacion\').innerHTML,document.getElementById(\'servicio\').innerHTML,document.getElementById(\'total\').innerHTML,document.getElementById(\'cantper\').innerHTML,document.form1.tipo.options[document.form1.tipo.selectedIndex].value,document.getElementById(\'id\').innerHTML,document.getElementById(\'tipopaq\').innerHTML)"><option>Seleccione</option><option>Tarjeta</option><option>Cheque</option><option selected="selected">Efectivo</option><option selected="selected">Millas</option></select></td></tr>
    ');
	
		
			
					 $millas4=mysql_query("SELECT per_cant_millas FROM  persona where per_cedula=$cedula");
						$rocosto1 = mysql_fetch_array($millas4);
						$millasac=$rocosto1['per_cant_millas'];
					
					
					
         $panelestadios->add("monto3",'<tr><td width="203">Millas Actuales:</td><td>'.$millasac.'</td></tr>');	
			
			
			$panelestadios->add("monto4",'<tr>
      <td width="203">Cantidad de millas a utilizar:</td>
      <td width="202"><input type="text" name="monto4" id="monto4" value="{monto4}" onKeyPress="return acceptNum(event)"></td>
    </tr>');			
		
		
				
	
	
				}
	
	  
	
	
	
	
			}
				
					
		  }
		  
		  // porque es especial
		  else
		  {
			   $ok=mysql_query("SELECT `pre_abono` FROM  presupuesto WHERE fk_per_cedula='$cedula' and pre_paq='$id'");
			                 $rowok = mysql_fetch_array($ok);
		                     $mete=$rowok['pre_abono'];
							 
					
							 
						$costo=mysql_query("SELECT c.cos_costo FROM  costo c WHERE c.fk_via_origen='$fkvia' AND c.fk_via_destino='$fkvia2'");
				$rocosto = mysql_fetch_array($costo);
			     $valor=$rocosto['cos_costo'];
					
						
						
						$total1=($valor*$cantper)-$mete	;
						
						//echo($total1);
					//$aa=2;
					//$bb=3;
					//echo($cantper);
					//$panelestadios->add("cue_numero",$tipoviaje);
					//$panelestadios->add("fecha",$bb);
					//$panelestadios->add("fecha1",$aa);
					$panelestadios->add("aerolinea",$aerolinea);
					$panelestadios->add("origen",$origen);
					$panelestadios->add("destino",$destino);
				
				
					 $panelestadios->add("servicio",$tipoviaje);
					 	 $panelestadios->add("tipopaq",$tipopaq);
					  $panelestadios->add("total",$total1);
					  $panelestadios->add("cantper",$cantper);
					   $panelestadios->add("id",$id);
					  $panelestadios->add("forma",'<option>Pago Unico</option><option>Pago en cuotas</option>');
					  
					
					 
					 	
			
					 
					
						
						 $ok1=mysql_query("SELECT `pre_abono` FROM  presupuesto WHERE fk_per_cedula='$cedula' and pre_paq='$id' AND pre_status='No comprado'");
			         $rowok = mysql_fetch_array($ok1);
		              $mete1=$rowok['pre_abono'];
						
						if ($mete1!= NULL)
						$total2=$total+$mete1;
						else
						$total2=$total;
					
					if ($selected && $fechai && $fechaf)
					{
					
					//$panelestadios->add("cue_numero",$tipoviaje);
					
					
					$panelestadios->add("aerolinea",$aerolinea);
					$panelestadios->add("origen",$origen);
					$panelestadios->add("destino",$destino);
					
						
				 $panelestadios->add("servicio",$servicio);
					 $panelestadios->add("tipopaq",$tipopaq);
					  $panelestadios->add("total",$total2);
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
							
							
			
			if(($selected=="Pago Unico") && $aerolinea && $fechaf && $fechai  && $origen && $destino  && $servicio &&  $total )
				{
					
				$panelestadios->add("cue_numero",$tipoviaje);
					
					$panelestadios->add("aerolinea",$aerolinea);
					$panelestadios->add("origen",$origen);
					$panelestadios->add("destino",$destino);
					$panelestadios->add("hotel",$hotel);
			
					 $panelestadios->add("servicio",$servicio);
				 $panelestadios->add("tipopaq",$tipopaq);
					  $panelestadios->add("total",$total2);
					 $panelestadios->add("cantper",$cantper);
					$panelestadios->add("fecha",$fechai);
					$panelestadios->add("fecha1",$fechaf);
					 $panelestadios->add("id",$id);
					 
					 

					/*$select_actual2='<option selected="selected">Pago Unico</option><option>Pago en cuotas</option>'; 	
					$select2=$select2.$select_actual2;
					 $panelestadios->add("forma",$select2);	*/
					
					
				$panelestadios->add("pago",' <tr><td>Tipo:</td><td><select name="tipo" id="tipo"  onChange="populate4(document.form1,document.form1.formapago.options[document.form1.formapago.selectedIndex].value,document.form1.fecha.value,document.form1.fecha1.value,document.getElementById(\'aerolinea\').innerHTML,document.getElementById(\'origen\').innerHTML,document.getElementById(\'destino\').innerHTML,document.getElementById(\'servicio\').innerHTML,document.getElementById(\'total\').innerHTML,document.getElementById(\'cantper\').innerHTML,document.form1.tipo.options[document.form1.tipo.selectedIndex].value,document.getElementById(\'id\').innerHTML,document.getElementById(\'tipopaq\').innerHTML)"><option selected="selected">Seleccione</option><option>Tarjeta</option><option>Cheque</option><option>Efectivo</option></select></td></tr>
    ');
				
				
				
				}
				
				
				
				else if(($selected=="Pago en cuotas") && $aerolinea && $fechaf && $fechai && $origen && $destino && $servicio && $total )
					{
						//echo("aja");
						
					$panelestadios->add("cue_numero",$tipoviaje);
					$panelestadios->add("aerolinea",$aerolinea);
					$panelestadios->add("origen",$origen);
					$panelestadios->add("destino",$destino);
					$panelestadios->add("hotel",$hotel);
				
					 $panelestadios->add("servicio",$servicio);
					  $panelestadios->add("total",$total);
					 $panelestadios->add("cantper",$cantper);
					$panelestadios->add("fecha",$fechai);
					$panelestadios->add("fecha1",$fechaf);
					 $panelestadios->add("id",$id);
					  $panelestadios->add("tipopaq",$tipopaq);
					
					
					
					
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
					if(($selected=="Pago Unico") && $aerolinea && $fechaf && $fechai  && $origen && $destino && $servicio && $total && $tipo )
				{
					
				    $panelestadios->add("cue_numero",$tipoviaje);
					
					$panelestadios->add("aerolinea",$aerolinea);
					$panelestadios->add("origen",$origen);
					$panelestadios->add("hotel",$hotel);
					$panelestadios->add("destino",$destino);
				
					 $panelestadios->add("servicio",$servicio);
					  $panelestadios->add("tipopaq",$tipopaq);
					  $panelestadios->add("total",$total2);
					 $panelestadios->add("cantper",$cantper);
					$panelestadios->add("fecha",$fechai);
					$panelestadios->add("fecha1",$fechaf);
					 $panelestadios->add("id",$id);
					 
					 

					
				//aqui van los if
				if ($tipo=="Tarjeta"){
				$panelestadios->add("pago",' <tr><td>Tipo:</td><td><select name="tipo" id="tipo"  onChange="populate4(document.form1,document.form1.formapago.options[document.form1.formapago.selectedIndex].value,document.form1.fecha.value,document.form1.fecha1.value,document.getElementById(\'aerolinea\').innerHTML,document.getElementById(\'origen\').innerHTML,document.getElementById(\'destino\').innerHTML,document.getElementById(\'servicio\').innerHTML,document.getElementById(\'total\').innerHTML,document.getElementById(\'cantper\').innerHTML,document.form1.tipo.options[document.form1.tipo.selectedIndex].value,document.getElementById(\'id\').innerHTML,document.getElementById(\'tipopaq\').innerHTML)"><option>Seleccione</option><option  selected="selected">Tarjeta</option><option>Cheque</option><option>Efectivo</option></select></td></tr>
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
				$panelestadios->add("pago",' <tr><td>Tipo:</td><td><select name="tipo" id="tipo"  onChange="populate4(document.form1,document.form1.formapago.options[document.form1.formapago.selectedIndex].value,document.form1.fecha.value,document.form1.fecha1.value,document.getElementById(\'aerolinea\').innerHTML,document.getElementById(\'origen\').innerHTML,document.getElementById(\'destino\').innerHTML,document.getElementById(\'servicio\').innerHTML,document.getElementById(\'total\').innerHTML,document.getElementById(\'cantper\').innerHTML,document.form1.tipo.options[document.form1.tipo.selectedIndex].value,document.getElementById(\'id\').innerHTML,document.getElementById(\'tipopaq\').innerHTML)"><option>Seleccione</option><option>Tarjeta</option><option selected="selected">Cheque</option><option>Efectivo</option></select></td></tr>
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
				$panelestadios->add("pago",' <tr><td>Tipo:</td><td><select name="tipo" id="tipo"  onChange="populate4(document.form1,document.form1.formapago.options[document.form1.formapago.selectedIndex].value,document.form1.fecha.value,document.form1.fecha1.value,document.getElementById(\'aerolinea\').innerHTML,document.getElementById(\'origen\').innerHTML,document.getElementById(\'destino\').innerHTML,document.getElementById(\'servicio\').innerHTML,document.getElementById(\'total\').innerHTML,document.getElementById(\'cantper\').innerHTML,document.form1.tipo.options[document.form1.tipo.selectedIndex].value,document.getElementById(\'id\').innerHTML,document.getElementById(\'tipopaq\').innerHTML)"><option>Seleccione</option><option>Tarjeta</option><option>Cheque</option><option selected="selected">Efectivo</option></select></td></tr>
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
				
			  
			  }
					
					//echo($tipo);
					$panelestadios->add("tipo_boton",'Procesar');
					$admin->add("contenido",$panelestadios);
					$admin->show();
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>