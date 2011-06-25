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
				mysql_query("INSERT INTO `viaje` (`via_id`,`via_tipo`,`via_tipoviaje`,`via_fecha_ini`,`via_fecha_fin`,`via_hora_ini`,`via_hora_fin`,`via_millas`,`via_tipo_paq`,`via_cant_per`,`fk_pre_id`,`fk_via_id_origen`,`fk_via_id_destino`,`fk_flo_id`,`via_compuesto`) VALUES(NULL,'Reserva','$hola','$fecha',null,null,null,NULL,NULL,'$cantper',null,'$origen1','$destino1',null,null)");

			    
				$hola='u_presupuesto_undestino_conestadia_terrestre.php?mensaje=1';
				header("Location:$hola");
			  
			  
			  	   }
			
	
	else{
	$hola='u_abono_error_undestino_conestadia_terrestre.php?mensaje=1';
	header("Location:$hola");
	
	}
		 
		  
		  
		  
		  
	  
		  
		  
		  }
	      else
		  {
			
			$admin= new Panel("../html/usuario.html");
			$admin->add("body",'<body onLoad = "actual(4)" >');
			$panelcuentas = new Panel("../html/u_reservar_presupuesto_undestino_conestadia_terrestre.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/u_reservar_presupuesto_undestino_conestadia_terrestre.php?a=1&id='.$id.'&cantper='.$cantper.'&origen1='.$origen1.'&fecha='.$fecha.'&destino1='.$destino1.'">');
	
	                
					  $ok=mysql_query("SELECT `pre_abono` FROM  presupuesto WHERE pre_id='$id'");
			                 $rowok = mysql_fetch_array($ok);
		                     $mete=$rowok['pre_abono'];
							 
							
							
							 $total1=$total-$mete;
					//echo("$id,$fecha,");
					
					 $panelcuentas->add("id",$id);
			        $panelcuentas->add("fecha",$fecha);
					$panelcuentas->add("aerolinea",$aerolinea);
					$panelcuentas->add("origen",$origen);
					$panelcuentas->add("destino",$destino);
					$panelcuentas->add("hotel",$hotel);
					$panelcuentas->add("habitacion",$habitacion);
					 $panelcuentas->add("servicio",$servicio);
					 
					  $panelcuentas->add("total",$total1);
					  $panelcuentas->add("cantper",$cantper);
					
			$panelcuentas->add("tipo_boton",'Reservar');
	    $admin->add("contenido",$panelcuentas);
	        $admin->show();	
			
				
			
		  }
	
		
	include "../db/cerrar_conexion.php";
?>