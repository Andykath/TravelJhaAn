<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
   $cedula=$_SESSION['cedula'];
   //$cant=$_SESSION['cant'];
	extract($_POST);
	extract($_GET);
	      
		  if($nombre1)
		  {    
		//echo("entro a insertar en aco");
		//echo($nombre1);
		//echo($nombre2);
		//echo($nombre3);
		//echo($apellido1);
		//echo($apellido2);
		//cho($apellido3);
		//echo($cantper);
		//echo($viaje);
			  //echo($cantper);
			 // echo($viaje);
			  
			  $res16=mysql_query("SELECT via_cant_per FROM  viaje where via_id=$viaje");
			$ro16 = mysql_fetch_array($res16);
			$estesi=$ro16['via_cant_per'];		
			  
			    //echo($estesi);
			  
			  if($estesi==2)
			  {
				mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre1', '$apellido1','$cedula1','$viaje','$cedula')");
		    
			$res17=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula1");
			$ro17 = mysql_fetch_array($res17);
			$a=$ro17['aco_id'];		
				
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$a')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje','$cedula',NULL)");
				
				
			  }
			  
			   if($estesi==3)
			  {
				 // echo("entra a 3");
				mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre1', '$apellido1','$cedula1','$viaje','$cedula')");
				
				$res17=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula1");
			$ro17 = mysql_fetch_array($res17);
			$a=$ro17['aco_id'];		
				
				mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre2', '$apellido2','$cedula2','$viaje','$cedula')");
				
				$res18=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula2");
			$ro18 = mysql_fetch_array($res18);
			$b=$ro18['aco_id'];		
				
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$a')");
				
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje','$b')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje','$cedula',NULL)");
				
				
				
			    
			  }
			  
			   if($estesi==4)
			  {
				  //echo("entra");
				mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre1', '$apellido1','$cedula1','$viaje','$cedula')");
				
			$res17=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula1");
			$ro17 = mysql_fetch_array($res17);
			$a=$ro17['aco_id'];		
				
				mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre2', '$apellido2','$cedula2','$viaje','$cedula')");
				
				$res18=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula2");
			$ro18 = mysql_fetch_array($res18);
			$b=$ro18['aco_id'];		
				
				mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre3', '$apellido3','$cedula3','$viaje','$cedula')");
				
				$res19=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula3");
			$ro19 = mysql_fetch_array($res19);
			$c=$ro19['aco_id'];		
				
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$a')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$b')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$c')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje','$cedula',NULL)");
				
				
				
			    
			  }
			  
			  
			   if($estesi==5)
			  {
				mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre1', '$apellido1','$cedula1','$viaje','$cedula')");
				
				$res17=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula1");
			$ro17 = mysql_fetch_array($res17);
			$a=$ro17['aco_id'];		
				
				mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre2', '$apellido2','$cedula2','$viaje','$cedula')");
				
				$res18=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula2");
			$ro18 = mysql_fetch_array($res18);
			$b=$ro18['aco_id'];		
				
				mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre3', '$apellido3','$cedula3','$viaje','$cedula')");
				
				$res19=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula3");
			$ro19 = mysql_fetch_array($res19);
			$c=$ro19['aco_id'];		
				
				
				mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre4', '$apellido4','$cedula4','$viaje','$cedula')");
				
				$res20=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula4");
			$ro20 = mysql_fetch_array($res20);
			$d=$ro20['aco_id'];	
				
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$a')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$b')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$c')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$d')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje','$cedula',NULL)");
				
				
				
			    
			  }
			  
			  if($estesi==6)
			  {
				mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre1', '$apellido1','$cedula1','$viaje','$cedula')");
				
				$res17=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula1");
			$ro17 = mysql_fetch_array($res17);
			$a=$ro17['aco_id'];		
				
				mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre2', '$apellido2','$cedula2','$viaje','$cedula')");
				
				$res18=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula2");
			$ro18 = mysql_fetch_array($res18);
			$b=$ro18['aco_id'];		
				
				mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre3', '$apellido3','$cedula3','$viaje','$cedula')");
				
				$res19=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula3");
			$ro19 = mysql_fetch_array($res19);
			$c=$ro19['aco_id'];		
				
				
				mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre4', '$apellido4','$cedula4','$viaje','$cedula')");
				
				$res20=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula4");
			$ro20 = mysql_fetch_array($res20);
			$d=$ro20['aco_id'];	
			
			mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre5', '$apellido5','$cedula5','$viaje','$cedula')");
			
			$res21=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula5");
			$ro21 = mysql_fetch_array($res21);
			$e=$ro21['aco_id'];	
				
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$a')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$b')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$c')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$d')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$e')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje','$cedula',NULL)");
				
				
				
			    
			  }
			  
			  if($estesi==7)
			  {
				mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre1', '$apellido1','$cedula1','$viaje','$cedula')");
				
				$res17=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula1");
			$ro17 = mysql_fetch_array($res17);
			$a=$ro17['aco_id'];
					
				
				mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre2', '$apellido2','$cedula2','$viaje','$cedula')");
				
				$res18=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula2");
			$ro18 = mysql_fetch_array($res18);
			$b=$ro18['aco_id'];		
				
				mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre3', '$apellido3','$cedula3','$viaje','$cedula')");
				
				$res19=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula3");
			$ro19 = mysql_fetch_array($res19);
			$c=$ro19['aco_id'];		
				
				
				mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre4', '$apellido4','$cedula4','$viaje','$cedula')");
				
				$res20=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula4");
			$ro20 = mysql_fetch_array($res20);
			$d=$ro20['aco_id'];	
			
			mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre5', '$apellido5','$cedula5','$viaje','$cedula')");
			
			$res21=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula5");
			$ro21 = mysql_fetch_array($res21);
			$e=$ro21['aco_id'];	
			
			mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre6', '$apellido6','$cedula6','$viaje','$cedula')");
			
			$res22=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula6");
			$ro22 = mysql_fetch_array($res22);
			$f=$ro22['aco_id'];	
			
				
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$a')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$b')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$c')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$d')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$e')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$f')");
				
				
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje','$cedula',NULL)");
				
				
				
			    
			  }
			  if($estesi==8)
			  {
				mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre1', '$apellido1','$cedula1','$viaje','$cedula')");
				
				$res17=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula1");
			$ro17 = mysql_fetch_array($res17);
			$a=$ro17['aco_id'];		
				
				mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre2', '$apellido2','$cedula2','$viaje','$cedula')");
				
				$res18=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula2");
			$ro18 = mysql_fetch_array($res18);
			$b=$ro18['aco_id'];		
				
				mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre3', '$apellido3','$cedula3','$viaje','$cedula')");
				
				$res19=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula3");
			$ro19 = mysql_fetch_array($res19);
			$c=$ro19['aco_id'];		
				
				
				mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre4', '$apellido4','$cedula4','$viaje','$cedula')");
				
				$res20=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula4");
			$ro20 = mysql_fetch_array($res20);
			$d=$ro20['aco_id'];	
			
			mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre5', '$apellido5','$cedula5','$viaje','$cedula')");
			
			$res21=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula5");
			$ro21 = mysql_fetch_array($res21);
			$e=$ro21['aco_id'];	
			
			mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre6', '$apellido6','$cedula6','$viaje','$cedula')");
			
			$res22=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula6");
			$ro22 = mysql_fetch_array($res22);
			$f=$ro22['aco_id'];	
			
			mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre7', '$apellido7','$cedula7','$viaje','$cedula')");
			
			$res23=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula7");
			$ro23 = mysql_fetch_array($res23);
			$g=$ro23['aco_id'];	
				
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$a')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$b')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$c')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$d')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$e')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$f')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$g')");
				
				
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje','$cedula',NULL)");
				
				
				
			    
			  }
			  
			   if($estesi==9)
			  {
				mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre1', '$apellido1','$cedula1','$viaje','$cedula')");
				
				$res17=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula1");
			$ro17 = mysql_fetch_array($res17);
			$a=$ro17['aco_id'];		
				
				mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre2', '$apellido2','$cedula2','$viaje','$cedula')");
				
				$res18=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula2");
			$ro18 = mysql_fetch_array($res18);
			$b=$ro18['aco_id'];		
				
				mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre3', '$apellido3','$cedula3','$viaje','$cedula')");
				
				$res19=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula3");
			$ro19 = mysql_fetch_array($res19);
			$c=$ro19['aco_id'];		
				
				
				mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre4', '$apellido4','$cedula4','$viaje','$cedula')");
				
				$res20=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula4");
			$ro20 = mysql_fetch_array($res20);
			$d=$ro20['aco_id'];	
			
			mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre5', '$apellido5','$cedula5','$viaje','$cedula')");
			
			$res21=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula5");
			$ro21 = mysql_fetch_array($res21);
			$e=$ro21['aco_id'];	
			
			mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre6', '$apellido6','$cedula6','$viaje','$cedula')");
			
			$res22=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula6");
			$ro22 = mysql_fetch_array($res22);
			$f=$ro22['aco_id'];	
			
			mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre7', '$apellido7','$cedula7','$viaje','$cedula')");
			
			$res23=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula7");
			$ro23 = mysql_fetch_array($res23);
			$g=$ro23['aco_id'];	
			
			mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre8', '$apellido8','$cedula8','$viaje','$cedula')");
			
			$res24=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula8");
			$ro24 = mysql_fetch_array($res24);
			$h=$ro24['aco_id'];	
				
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$a')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$b')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$c')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$d')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$e')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$f')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$g')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$h')");
				
				
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje','$cedula',NULL)");
				
				
				
			    
			  }
			  
			  if($estesi==10)
			  {
				mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre1', '$apellido1','$cedula1','$viaje','$cedula')");
				
				$res17=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula1");
			$ro17 = mysql_fetch_array($res17);
			$a=$ro17['aco_id'];		
				
				mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre2', '$apellido2','$cedula2','$viaje','$cedula')");
				
				$res18=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula2");
			$ro18 = mysql_fetch_array($res18);
			$b=$ro18['aco_id'];		
				
				mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre3', '$apellido3','$cedula3','$viaje','$cedula')");
				
				$res19=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula3");
			$ro19 = mysql_fetch_array($res19);
			$c=$ro19['aco_id'];		
				
				
				mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre4', '$apellido4','$cedula4','$viaje','$cedula')");
				
				$res20=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula4");
			$ro20 = mysql_fetch_array($res20);
			$d=$ro20['aco_id'];	
			
			mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre5', '$apellido5','$cedula5','$viaje','$cedula')");
			
			$res21=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula5");
			$ro21 = mysql_fetch_array($res21);
			$e=$ro21['aco_id'];	
			
			mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre6', '$apellido6','$cedula6','$viaje','$cedula')");
			
			$res22=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula6");
			$ro22 = mysql_fetch_array($res22);
			$f=$ro22['aco_id'];	
			
			mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre7', '$apellido7','$cedula7','$viaje','$cedula')");
			
			$res23=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula7");
			$ro23 = mysql_fetch_array($res23);
			$g=$ro23['aco_id'];	
			
			mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre8', '$apellido8','$cedula8','$viaje','$cedula')");
			
			$res24=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula8");
			$ro24 = mysql_fetch_array($res24);
			$h=$ro24['aco_id'];	
			
			mysql_query("INSERT INTO `acompanante` (`aco_id`, `aco_nombre`, `aco_apellido`,`aco_cedula`,`fk_via_id`,`fk_per_cedula`) VALUES (NULL ,'$nombre9', '$apellido9','$cedula9','$viaje','$cedula')");
			
			$res25=mysql_query("SELECT aco_id FROM  acompanante where aco_cedula=$cedula9");
			$ro25 = mysql_fetch_array($res25);
			$i=$ro24['aco_id'];	
				
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$a')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$b')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$c')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$d')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$e')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$f')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$g')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$h')");
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje',NULL,'$i')");
				
				
				mysql_query("INSERT INTO `boleto` (`bol_id`, `bol_fecha_emi`, `fk_via_id`,`fk_per_cedula`,`fk_aco_id`) VALUES (NULL ,'2011-06-18','$viaje','$cedula',NULL)");
				
				
				
			    
			  }
			  
			  
				
				//falta 6 al 10 
				
				
				
				
				$hola='u_verboleto_undestino_conestadia_terrestre.php?viaje='.$viaje.'&mensaje=1';
				header("Location:$hola");
			  
			  
			  
		  
		  
		  
		  
		  
	  
		  
		  
		  }
	      else
		  {
			
			$admin= new Panel("../html/usuario.html");
			$admin->add("body",'<body onLoad = "actual(3)" >');
			$panelestadios = new Panel("../html/u_continuar_compra_undestino_conestadia_terrestre.html");
			$panelestadios->add("form",'<form name="form1" method="post" action="../php/u_continuar_compra_undestino_conestadia_terrestre.php?viaje='.$viaje.'">');
	
	      // echo($cantper);
		   //echo($viaje);
		   //echo($cedula);
			echo("continuar");
			echo($cantper);
			
			if ($cantper==2)
			{
				$panelestadios->add("nombre1",'<tr>
      <td width="203">Nombre acompanante 1:</td>
      <td width="202"><input type="text" name="nombre1" id="nombre1" value="{nombre1}"></td>
    </tr>');
	
	         $panelestadios->add("apellido1",'<tr>
      <td width="203">Apellido acompanante 1:</td>
      <td width="202"><input type="text" name="apellido1" id="apellido1" value="{apellido1}"></td>
    </tr>');
	
	$panelestadios->add("cedula1",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 1:</td>
      <td width="202"><input type="text" name="cedula1" id="cedula1" value="{cedula1}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
			}
			
			
			if ($cantper==3)
			{
				$panelestadios->add("nombre1",'<tr>
      <td width="203">Nombre acompanante 1:</td>
      <td width="202"><input type="text" name="nombre1" id="nombre1" value="{nombre1}"></td>
    </tr>');
	
	         $panelestadios->add("apellido1",'<tr>
      <td width="203">Apellido acompanante 1:</td>
      <td width="202"><input type="text" name="apellido1" id="apellido1" value="{apellido1}"></td>
    </tr>');
	
	$panelestadios->add("nombre2",'<tr>
      <td width="203">Nombre acompanante 2:</td>
      <td width="202"><input type="text" name="nombre2" id="nombre2" value="{nombre2}"></td>
    </tr>');
	
	
	
	$panelestadios->add("apellido2",'<tr>
      <td width="203">Apellido acompanante 2:</td>
      <td width="202"><input type="text" name="apellido2" id="apellido2" value="{apellido2}"></td>
    </tr>');
	
	
	
	$panelestadios->add("cedula1",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 1:</td>
      <td width="202"><input type="text" name="cedula1" id="cedula1" value="{cedula1}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula2",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 2:</td>
      <td width="202"><input type="text" name="cedula2" id="cedula2" value="{cedula2}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	
	
			}
			
			
			if ($cantper==4)
			{
				$panelestadios->add("nombre1",'<tr>
      <td width="203">Nombre acompanante 1:</td>
      <td width="202"><input type="text" name="nombre1" id="nombre1" value="{nombre1}"></td>
    </tr>');
	
	         $panelestadios->add("apellido1",'<tr>
      <td width="203">Apellido acompanante 1:</td>
      <td width="202"><input type="text" name="apellido1" id="apellido1" value="{apellido1}"></td>
    </tr>');
	
	$panelestadios->add("nombre2",'<tr>
      <td width="203">Nombre acompanante 2:</td>
      <td width="202"><input type="text" name="nombre2" id="nombre2" value="{nombre2}"></td>
    </tr>');
	
	$panelestadios->add("nombre3",'<tr>
      <td width="203">Nombre acompanante 3:</td>
      <td width="202"><input type="text" name="nombre3" id="nombre3" value="{nombre3}"></td>
    </tr>');
	
	
	
	$panelestadios->add("apellido2",'<tr>
      <td width="203">Apellido acompanante 2:</td>
      <td width="202"><input type="text" name="apellido2" id="apellido2" value="{apellido2}"></td>
    </tr>');
	
	$panelestadios->add("apellido3",'<tr>
      <td width="203">Apellido acompanante 3:</td>
      <td width="202"><input type="text" name="apellido3" id="apellido3" value="{apellido3}"></td>
    </tr>');
	
	
	
	$panelestadios->add("cedula1",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 1:</td>
      <td width="202"><input type="text" name="cedula1" id="cedula1" value="{cedula1}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula2",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 2:</td>
      <td width="202"><input type="text" name="cedula2" id="cedula2" value="{cedula2}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula3",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 3:</td>
      <td width="202"><input type="text" name="cedula3" id="cedula3" value="{cedula3}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	
	
			}
			
			
			if ($cantper==5)
			{
				$panelestadios->add("nombre1",'<tr>
      <td width="203">Nombre acompanante 1:</td>
      <td width="202"><input type="text" name="nombre1" id="nombre1" value="{nombre1}"></td>
    </tr>');
	
	         $panelestadios->add("apellido1",'<tr>
      <td width="203">Apellido acompanante 1:</td>
      <td width="202"><input type="text" name="apellido1" id="apellido1" value="{apellido1}"></td>
    </tr>');
	
	$panelestadios->add("nombre2",'<tr>
      <td width="203">Nombre acompanante 2:</td>
      <td width="202"><input type="text" name="nombre2" id="nombre2" value="{nombre2}"></td>
    </tr>');
	
	$panelestadios->add("nombre3",'<tr>
      <td width="203">Nombre acompanante 3:</td>
      <td width="202"><input type="text" name="nombre3" id="nombre3" value="{nombre3}"></td>
    </tr>');
	
	$panelestadios->add("nombre4",'<tr>
      <td width="203">Nombre acompanante 4:</td>
      <td width="202"><input type="text" name="nombre4" id="nombre4" value="{nombre4}"></td>
    </tr>');
	
	
	$panelestadios->add("apellido2",'<tr>
      <td width="203">Apellido acompanante 2:</td>
      <td width="202"><input type="text" name="apellido2" id="apellido2" value="{apellido2}"></td>
    </tr>');
	
	$panelestadios->add("apellido3",'<tr>
      <td width="203">Apellido acompanante 3:</td>
      <td width="202"><input type="text" name="apellido3" id="apellido3" value="{apellido3}"></td>
    </tr>');
	
	$panelestadios->add("apellido4",'<tr>
      <td width="203">Apellido acompanante 4:</td>
      <td width="202"><input type="text" name="apellido4" id="apellido4" value="{apellido4}"></td>
    </tr>');
	
	
	
	$panelestadios->add("cedula1",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 1:</td>
      <td width="202"><input type="text" name="cedula1" id="cedula1" value="{cedula1}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula2",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 2:</td>
      <td width="202"><input type="text" name="cedula2" id="cedula2" value="{cedula2}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula3",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 3:</td>
      <td width="202"><input type="text" name="cedula3" id="cedula3" value="{cedula3}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula4",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 4:</td>
      <td width="202"><input type="text" name="cedula4" id="cedula4" value="{cedula4}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	
	
			}
			
			if ($cantper==6)
			{
				$panelestadios->add("nombre1",'<tr>
      <td width="203">Nombre acompanante 1:</td>
      <td width="202"><input type="text" name="nombre1" id="nombre1" value="{nombre1}"></td>
    </tr>');
	
	         $panelestadios->add("apellido1",'<tr>
      <td width="203">Apellido acompanante 1:</td>
      <td width="202"><input type="text" name="apellido1" id="apellido1" value="{apellido1}"></td>
    </tr>');
	
	$panelestadios->add("nombre2",'<tr>
      <td width="203">Nombre acompanante 2:</td>
      <td width="202"><input type="text" name="nombre2" id="nombre2" value="{nombre2}"></td>
    </tr>');
	
	$panelestadios->add("nombre3",'<tr>
      <td width="203">Nombre acompanante 3:</td>
      <td width="202"><input type="text" name="nombre3" id="nombre3" value="{nombre3}"></td>
    </tr>');
	
	$panelestadios->add("nombre4",'<tr>
      <td width="203">Nombre acompanante 4:</td>
      <td width="202"><input type="text" name="nombre4" id="nombre4" value="{nombre4}"></td>
    </tr>');
	
	$panelestadios->add("nombre5",'<tr>
      <td width="203">Nombre acompanante 5:</td>
      <td width="202"><input type="text" name="nombre5" id="nombre5" value="{nombre5}"></td>
    </tr>');
	
	
	
	$panelestadios->add("apellido2",'<tr>
      <td width="203">Apellido acompanante 2:</td>
      <td width="202"><input type="text" name="apellido2" id="apellido2" value="{apellido2}"></td>
    </tr>');
	
	$panelestadios->add("apellido3",'<tr>
      <td width="203">Apellido acompanante 3:</td>
      <td width="202"><input type="text" name="apellido3" id="apellido3" value="{apellido3}"></td>
    </tr>');
	
	$panelestadios->add("apellido4",'<tr>
      <td width="203">Apellido acompanante 4:</td>
      <td width="202"><input type="text" name="apellido4" id="apellido4" value="{apellido4}"></td>
    </tr>');
	
	$panelestadios->add("apellido5",'<tr>
      <td width="203">Apellido acompanante 5:</td>
      <td width="202"><input type="text" name="apellido5" id="apellido5" value="{apellido5}"></td>
    </tr>');
	
	
	
	$panelestadios->add("cedula1",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 1:</td>
      <td width="202"><input type="text" name="cedula1" id="cedula1" value="{cedula1}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula2",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 2:</td>
      <td width="202"><input type="text" name="cedula2" id="cedula2" value="{cedula2}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula3",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 3:</td>
      <td width="202"><input type="text" name="cedula3" id="cedula3" value="{cedula3}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula4",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac.4:</td>
      <td width="202"><input type="text" name="cedula4" id="cedula4" value="{cedula4}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula5",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 5:</td>
      <td width="202"><input type="text" name="cedula5" id="cedula5" value="{cedula5}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	
	
			}
			
			if ($cantper==7)
			{
				$panelestadios->add("nombre1",'<tr>
      <td width="203">Nombre acompanante 1:</td>
      <td width="202"><input type="text" name="nombre1" id="nombre1" value="{nombre1}"></td>
    </tr>');
	
	         $panelestadios->add("apellido1",'<tr>
      <td width="203">Apellido acompanante 1:</td>
      <td width="202"><input type="text" name="apellido1" id="apellido1" value="{apellido1}"></td>
    </tr>');
	
	$panelestadios->add("nombre2",'<tr>
      <td width="203">Nombre acompanante 2:</td>
      <td width="202"><input type="text" name="nombre2" id="nombre2" value="{nombre2}"></td>
    </tr>');
	
	$panelestadios->add("nombre3",'<tr>
      <td width="203">Nombre acompanante 3:</td>
      <td width="202"><input type="text" name="nombre3" id="nombre3" value="{nombre3}"></td>
    </tr>');
	
	$panelestadios->add("nombre4",'<tr>
      <td width="203">Nombre acompanante 4:</td>
      <td width="202"><input type="text" name="nombre4" id="nombre4" value="{nombre4}"></td>
    </tr>');
	
	$panelestadios->add("nombre5",'<tr>
      <td width="203">Nombre acompanante 5:</td>
      <td width="202"><input type="text" name="nombre5" id="nombre5" value="{nombre5}"></td>
    </tr>');
	
	$panelestadios->add("nombre6",'<tr>
      <td width="203">Nombre acompanante 6:</td>
      <td width="202"><input type="text" name="nombre6" id="nombre6" value="{nombre6}"></td>
    </tr>');
	
	
	$panelestadios->add("apellido2",'<tr>
      <td width="203">Apellido acompanante 2:</td>
      <td width="202"><input type="text" name="apellido2" id="apellido2" value="{apellido2}"></td>
    </tr>');
	
	$panelestadios->add("apellido3",'<tr>
      <td width="203">Apellido acompanante 3:</td>
      <td width="202"><input type="text" name="apellido3" id="apellido3" value="{apellido3}"></td>
    </tr>');
	
	$panelestadios->add("apellido4",'<tr>
      <td width="203">Apellido acompanante 4:</td>
      <td width="202"><input type="text" name="apellido4" id="apellido4" value="{apellido4}"></td>
    </tr>');
	
	$panelestadios->add("apellido5",'<tr>
      <td width="203">Apellido acompanante 5:</td>
      <td width="202"><input type="text" name="apellido5" id="apellido5" value="{apellido5}"></td>
    </tr>');
	
	$panelestadios->add("apellido6",'<tr>
      <td width="203">Apellido acompanante 6:</td>
      <td width="202"><input type="text" name="apellido6" id="apellido6" value="{apellido6}"></td>
    </tr>');
	
	
	
	$panelestadios->add("cedula1",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac.1:</td>
      <td width="202"><input type="text" name="cedula1" id="cedula1" value="{cedula1}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula2",'<tr>
      <td width="203">*Cedula acompananteo Nro Partida de Nac. 2:</td>
      <td width="202"><input type="text" name="cedula2" id="cedula2" value="{cedula2}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula3",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 3:</td>
      <td width="202"><input type="text" name="cedula3" id="cedula3" value="{cedula3}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula4",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 4:</td>
      <td width="202"><input type="text" name="cedula4" id="cedula4" value="{cedula4}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula5",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 5:</td>
      <td width="202"><input type="text" name="cedula5" id="cedula5" value="{cedula5}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula6",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 6:</td>
      <td width="202"><input type="text" name="cedula6" id="cedula6" value="{cedula6}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	
	
			}
			
			if ($cantper==8)
			{
				$panelestadios->add("nombre1",'<tr>
      <td width="203">Nombre acompanante 1:</td>
      <td width="202"><input type="text" name="nombre1" id="nombre1" value="{nombre1}"></td>
    </tr>');
	
	         $panelestadios->add("apellido1",'<tr>
      <td width="203">Apellido acompanante 1:</td>
      <td width="202"><input type="text" name="apellido1" id="apellido1" value="{apellido1}"></td>
    </tr>');
	
	$panelestadios->add("nombre2",'<tr>
      <td width="203">Nombre acompanante 2:</td>
      <td width="202"><input type="text" name="nombre2" id="nombre2" value="{nombre2}"></td>
    </tr>');
	
	$panelestadios->add("nombre3",'<tr>
      <td width="203">Nombre acompanante 3:</td>
      <td width="202"><input type="text" name="nombre3" id="nombre3" value="{nombre3}"></td>
    </tr>');
	
	$panelestadios->add("nombre4",'<tr>
      <td width="203">Nombre acompanante 4:</td>
      <td width="202"><input type="text" name="nombre4" id="nombre4" value="{nombre4}"></td>
    </tr>');
	
	$panelestadios->add("nombre5",'<tr>
      <td width="203">Nombre acompanante 5:</td>
      <td width="202"><input type="text" name="nombre5" id="nombre5" value="{nombre5}"></td>
    </tr>');
	
	$panelestadios->add("nombre6",'<tr>
      <td width="203">Nombre acompanante 5:</td>
      <td width="202"><input type="text" name="nombre6" id="nombre6" value="{nombre6}"></td>
    </tr>');
	
	$panelestadios->add("nombre7",'<tr>
      <td width="203">Nombre acompanante 7:</td>
      <td width="202"><input type="text" name="nombre7" id="nombre7" value="{nombre7}"></td>
    </tr>');
	
	
	
	$panelestadios->add("apellido2",'<tr>
      <td width="203">Apellido acompanante 2:</td>
      <td width="202"><input type="text" name="apellido2" id="apellido2" value="{apellido2}"></td>
    </tr>');
	
	$panelestadios->add("apellido3",'<tr>
      <td width="203">Apellido acompanante 3:</td>
      <td width="202"><input type="text" name="apellido3" id="apellido3" value="{apellido3}"></td>
    </tr>');
	
	$panelestadios->add("apellido4",'<tr>
      <td width="203">Apellido acompanante 4:</td>
      <td width="202"><input type="text" name="apellido4" id="apellido4" value="{apellido4}"></td>
    </tr>');
	
	$panelestadios->add("apellido5",'<tr>
      <td width="203">Apellido acompanante 5:</td>
      <td width="202"><input type="text" name="apellido5" id="apellido5" value="{apellido5}"></td>
    </tr>');
	
	$panelestadios->add("apellido6",'<tr>
      <td width="203">Apellido acompanante 6:</td>
      <td width="202"><input type="text" name="apellido6" id="apellido6" value="{apellido6}"></td>
    </tr>');
	
	$panelestadios->add("apellido7",'<tr>
      <td width="203">Apellido acompanante 7:</td>
      <td width="202"><input type="text" name="apellido7" id="apellido7" value="{apellido7}"></td>
    </tr>');
	
	
	
	$panelestadios->add("cedula1",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 1:</td>
      <td width="202"><input type="text" name="cedula1" id="cedula1" value="{cedula1}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula2",'<tr>
      <td width="203">*Cedula acompananteo Nro Partida de Nac. 2:</td>
      <td width="202"><input type="text" name="cedula2" id="cedula2" value="{cedula2}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula3",'<tr>
      <td width="203">*Cedula acompananteo Nro Partida de Nac. 3:</td>
      <td width="202"><input type="text" name="cedula3" id="cedula3" value="{cedula3}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula4",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 4:</td>
      <td width="202"><input type="text" name="cedula4" id="cedula4" value="{cedula4}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula5",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac.5:</td>
      <td width="202"><input type="text" name="cedula5" id="cedula5" value="{cedula5}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula6",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac.6:</td>
      <td width="202"><input type="text" name="cedula6" id="cedula6" value="{cedula6}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula7",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac.7:</td>
      <td width="202"><input type="text" name="cedula7" id="cedula7" value="{cedula7}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	
	
			}
			
			
			if ($cantper==9)
			{
				$panelestadios->add("nombre1",'<tr>
      <td width="203">Nombre acompanante 1:</td>
      <td width="202"><input type="text" name="nombre1" id="nombre1" value="{nombre1}"></td>
    </tr>');
	
	         $panelestadios->add("apellido1",'<tr>
      <td width="203">Apellido acompanante 1:</td>
      <td width="202"><input type="text" name="apellido1" id="apellido1" value="{apellido1}"></td>
    </tr>');
	
	$panelestadios->add("nombre2",'<tr>
      <td width="203">Nombre acompanante 2:</td>
      <td width="202"><input type="text" name="nombre2" id="nombre2" value="{nombre2}"></td>
    </tr>');
	
	$panelestadios->add("nombre3",'<tr>
      <td width="203">Nombre acompanante 3:</td>
      <td width="202"><input type="text" name="nombre3" id="nombre3" value="{nombre3}"></td>
    </tr>');
	
	$panelestadios->add("nombre4",'<tr>
      <td width="203">Nombre acompanante 4:</td>
      <td width="202"><input type="text" name="nombre4" id="nombre4" value="{nombre4}"></td>
    </tr>');
	
	$panelestadios->add("nombre5",'<tr>
      <td width="203">Nombre acompanante 5:</td>
      <td width="202"><input type="text" name="nombre5" id="nombre5" value="{nombre5}"></td>
    </tr>');
	
	$panelestadios->add("nombre6",'<tr>
      <td width="203">Nombre acompanante 5:</td>
      <td width="202"><input type="text" name="nombre6" id="nombre6" value="{nombre6}"></td>
    </tr>');
	
	$panelestadios->add("nombre7",'<tr>
      <td width="203">Nombre acompanante 7:</td>
      <td width="202"><input type="text" name="nombre7" id="nombre7" value="{nombre7}"></td>
    </tr>');
	
	$panelestadios->add("nombre8",'<tr>
      <td width="203">Nombre acompanante 8:</td>
      <td width="202"><input type="text" name="nombre8" id="nombre8" value="{nombre8}"></td>
    </tr>');
	
	
	$panelestadios->add("apellido2",'<tr>
      <td width="203">Apellido acompanante 2:</td>
      <td width="202"><input type="text" name="apellido2" id="apellido2" value="{apellido2}"></td>
    </tr>');
	
	$panelestadios->add("apellido3",'<tr>
      <td width="203">Apellido acompanante 3:</td>
      <td width="202"><input type="text" name="apellido3" id="apellido3" value="{apellido3}"></td>
    </tr>');
	
	$panelestadios->add("apellido4",'<tr>
      <td width="203">Apellido acompanante 4:</td>
      <td width="202"><input type="text" name="apellido4" id="apellido4" value="{apellido4}"></td>
    </tr>');
	
	$panelestadios->add("apellido5",'<tr>
      <td width="203">Apellido acompanante 5:</td>
      <td width="202"><input type="text" name="apellido5" id="apellido5" value="{apellido5}"></td>
    </tr>');
	
	$panelestadios->add("apellido6",'<tr>
      <td width="203">Apellido acompanante 6:</td>
      <td width="202"><input type="text" name="apellido6" id="apellido6" value="{apellido6}"></td>
    </tr>');
	
	$panelestadios->add("apellido7",'<tr>
      <td width="203">Apellido acompanante 7:</td>
      <td width="202"><input type="text" name="apellido7" id="apellido7" value="{apellido7}"></td>
    </tr>');
	
	$panelestadios->add("apellido8",'<tr>
      <td width="203">Apellido acompanante 8:</td>
      <td width="202"><input type="text" name="apellido8" id="apellido8" value="{apellido8}"></td>
    </tr>');
	
	
	
	$panelestadios->add("cedula1",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 1:</td>
      <td width="202"><input type="text" name="cedula1" id="cedula1" value="{cedula1}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula2",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 2:</td>
      <td width="202"><input type="text" name="cedula2" id="cedula2" value="{cedula2}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula3",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 3:</td>
      <td width="202"><input type="text" name="cedula3" id="cedula3" value="{cedula3}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula4",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 4:</td>
      <td width="202"><input type="text" name="cedula4" id="cedula4" value="{cedula4}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula5",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 5:</td>
      <td width="202"><input type="text" name="cedula5" id="cedula5" value="{cedula5}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula6",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 6:</td>
      <td width="202"><input type="text" name="cedula6" id="cedula6" value="{cedula6}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula7",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 7:</td>
      <td width="202"><input type="text" name="cedula7" id="cedula7" value="{cedula7}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula8",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 8:</td>
      <td width="202"><input type="text" name="cedula8" id="cedula8" value="{cedula8}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	
	
			}
			
			if ($cantper==10)
			{
				$panelestadios->add("nombre1",'<tr>
      <td width="203">Nombre acompanante 1:</td>
      <td width="202"><input type="text" name="nombre1" id="nombre1" value="{nombre1}"></td>
    </tr>');
	
	         $panelestadios->add("apellido1",'<tr>
      <td width="203">Apellido acompanante 1:</td>
      <td width="202"><input type="text" name="apellido1" id="apellido1" value="{apellido1}"></td>
    </tr>');
	
	$panelestadios->add("nombre2",'<tr>
      <td width="203">Nombre acompanante 2:</td>
      <td width="202"><input type="text" name="nombre2" id="nombre2" value="{nombre2}"></td>
    </tr>');
	
	$panelestadios->add("nombre3",'<tr>
      <td width="203">Nombre acompanante 3:</td>
      <td width="202"><input type="text" name="nombre3" id="nombre3" value="{nombre3}"></td>
    </tr>');
	
	$panelestadios->add("nombre4",'<tr>
      <td width="203">Nombre acompanante 4:</td>
      <td width="202"><input type="text" name="nombre4" id="nombre4" value="{nombre4}"></td>
    </tr>');
	
	$panelestadios->add("nombre5",'<tr>
      <td width="203">Nombre acompanante 5:</td>
      <td width="202"><input type="text" name="nombre5" id="nombre5" value="{nombre5}"></td>
    </tr>');
	
	$panelestadios->add("nombre6",'<tr>
      <td width="203">Nombre acompanante 5:</td>
      <td width="202"><input type="text" name="nombre6" id="nombre6" value="{nombre6}"></td>
    </tr>');
	
	$panelestadios->add("nombre7",'<tr>
      <td width="203">Nombre acompanante 7:</td>
      <td width="202"><input type="text" name="nombre7" id="nombre7" value="{nombre7}"></td>
    </tr>');
	
	$panelestadios->add("nombre8",'<tr>
      <td width="203">Nombre acompanante 8:</td>
      <td width="202"><input type="text" name="nombre8" id="nombre8" value="{nombre8}"></td>
    </tr>');
	
	$panelestadios->add("nombre9",'<tr>
      <td width="203">Nombre acompanante 9:</td>
      <td width="202"><input type="text" name="nombre9" id="nombre9" value="{nombre9}"></td>
    </tr>');
	
	
	
	$panelestadios->add("apellido2",'<tr>
      <td width="203">Apellido acompanante 2:</td>
      <td width="202"><input type="text" name="apellido2" id="apellido2" value="{apellido2}"></td>
    </tr>');
	
	$panelestadios->add("apellido3",'<tr>
      <td width="203">Apellido acompanante 3:</td>
      <td width="202"><input type="text" name="apellido3" id="apellido3" value="{apellido3}"></td>
    </tr>');
	
	$panelestadios->add("apellido4",'<tr>
      <td width="203">Apellido acompanante 4:</td>
      <td width="202"><input type="text" name="apellido4" id="apellido4" value="{apellido4}"></td>
    </tr>');
	
	$panelestadios->add("apellido5",'<tr>
      <td width="203">Apellido acompanante 5:</td>
      <td width="202"><input type="text" name="apellido5" id="apellido5" value="{apellido5}"></td>
    </tr>');
	
	$panelestadios->add("apellido6",'<tr>
      <td width="203">Apellido acompanante 6:</td>
      <td width="202"><input type="text" name="apellido6" id="apellido6" value="{apellido6}"></td>
    </tr>');
	
	$panelestadios->add("apellido7",'<tr>
      <td width="203">Apellido acompanante 7:</td>
      <td width="202"><input type="text" name="apellido7" id="apellido7" value="{apellido7}"></td>
    </tr>');
	
	$panelestadios->add("apellido8",'<tr>
      <td width="203">Apellido acompanante 8:</td>
      <td width="202"><input type="text" name="apellido8" id="apellido8" value="{apellido8}"></td>
    </tr>');
	
	$panelestadios->add("apellido9",'<tr>
      <td width="203">Apellido acompanante  9:</td>
      <td width="202"><input type="text" name="apellido9" id="apellido9" value="{apellido9}"></td>
    </tr>');
	
	
	
	$panelestadios->add("cedula1",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 1:</td>
      <td width="202"><input type="text" name="cedula1" id="cedula1" value="{cedula1}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula2",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 2:</td>
      <td width="202"><input type="text" name="cedula2" id="cedula2" value="{cedula2}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula3",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 3:</td>
      <td width="202"><input type="text" name="cedula3" id="cedula3" value="{cedula3}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula4",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac.4:</td>
      <td width="202"><input type="text" name="cedula4" id="cedula4" value="{cedula4}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula5",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 5:</td>
      <td width="202"><input type="text" name="cedula5" id="cedula5" value="{cedula5}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula6",'<tr>
      <td width="203">*Cedula o Nro Partida de Nac. acompanante 6:</td>
      <td width="202"><input type="text" name="cedula6" id="cedula6" value="{cedula6}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula7",'<tr>
      <td width="203">*Cedula acompanante o Nro Partida de Nac. 7:</td>
      <td width="202"><input type="text" name="cedula7" id="cedula7" value="{cedula7}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula8",'<tr>
      <td width="203">*Cedula acompanante 8:</td>
      <td width="202"><input type="text" name="cedula8" id="cedula8" value="{cedula8}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	$panelestadios->add("cedula9",'<tr>
      <td width="203">*Cedula o Nro Partida de Nac. acompanante 9:</td>
      <td width="202"><input type="text" name="cedula9" id="cedula9" value="{cedula9}"  onKeyPress="return acceptNum(event)"></td>
    </tr>');
	
	
	
			}
			
			
			
			
			
			
			
			
			
			$panelestadios->add("tipo_boton",'Ver Boleto(s)');
			//$panelestadios->add("error",'Ya existe un estadio '.$cue_numero.' andre '.$row["ban_nombre"]);
	        $admin->add("contenido",$panelestadios);
	        $admin->show();
			
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>