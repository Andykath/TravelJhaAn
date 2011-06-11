<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_GET);
	extract($_POST);
	
	      if($estadio_viejo)
		  {// aqui validar que los datos esten bien y hacer update
		
		
               if (($estadio_viejo== $numero)&&($ciudad_vieja==$tipo))    
				{	
				    $hola='a_telefonos.php?cedula='.$cedula.'';
				    header("Location:$hola");	 
				}
				else 
				{
				    
				    if ((strtoupper($estadio_viejo)== strtoupper($numero))&&($ciudad_vieja==$tipo))
					{
					
					
					mysql_query("UPDATE `telefono` SET  `tel_numero` =  '$numero', `tel_tipo` =  '$tipo' WHERE  `telefono`.`tel_id` = $cod");
					
					$hola='a_telefonos.php?cedula='.$cedula.'';
				    header("Location:$hola");	
					
					}
					else 
					{//1
					   
					   
					  $result1= mysql_query("SELECT * FROM telefono t WHERE t.tel_numero ='$numero'");
					  if (mysql_fetch_array($result1))
					  {
					  		$hola='a_telefonos.php?cedula='.$cedula.'&mensaje=3';
				            header("Location:$hola");		
							
					  }
					  else
					  {
					// echo "$numero $tipo $cod";
					 mysql_query("UPDATE `telefono` SET  `tel_numero` =  '$numero', `tel_tipo` =  '$tipo' WHERE `telefono`.`tel_id` = $cod");

					
					$hola='a_telefonos.php?cedula='.$cedula.'';
				    header("Location:$hola");
					  
					  
					  }
					
				
				}	
				
			 }		
	
		  }
	      else
		  {//aqui pinta el editor por primera vez	
		            //echo "$id , $tipo"; 
					$admin= new Panel("../html/admin.html");
					//$admin->add("body",'<body onLoad = "actual(12)" >');
					$panelestadios = new Panel("../html/a_crear_telefono.html");
					$panelestadios->add("form",'<form name="form1" method="post" action="../php/a_modificar_telefono.php?cod='.$id.'&cedula='.$cedula.'&numero='.$numero.'">');
					$panelestadios->add("numero",$numero);
					$panelestadios->add("tipo",$tipo);
					$panelestadios->add("id_viejo",$id);

					$panelestadios->add("id",'<tr><td>Id:</td><td>'.$id.'</td></tr>');

		
					$panelestadios->add("tipo_boton",'Modificar');
					$admin->add("contenido",$panelestadios);
					$admin->show();
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>