<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_GET);
	extract($_POST);
	
	      if($numero_viejo)
		  {
			  //echo $numero."numero_viejo".$numero_viejo."-".$cvv2."cvv2_viejo".$cvv2_viejo."-".$banco."banco_viejo".$banco_viejo."-".$cliente."cliente_viejo".$cliente_viejo."-".$nombrede."nombre_viejo".$nombrede_viejo."-".$fecha."fecha_viejo".$fecha_viejo;
				if (($numero_viejo== $numero)&&($cvv2_viejo==$cvv2)&&($nombrede_viejo==$nombrede)&&($fecha_viejo==$fecha)&&($banco_viejo==$banco)&&($cliente_viejo==$cliente))    
				{	
				//echo "entra2";
				    $hola='a_tarjeta.php';
				    header("Location:$hola");	 
				}
				else 
				{
				    
				    if (($numero_viejo== $numero)&&($cvv2_viejo==$cvv2)&&($nombrede_viejo==$nombrede)&&($fecha_viejo==$fecha)&&($banco_viejo==$banco))
					{
					
					mysql_query("UPDATE `tarjeta` SET  `tar_num` =  '$numero', fk_ban_id='$banco', tar_fechaven='$fecha', fk_per_cedula='$cliente', `tar_cvv2` =  '$cvv2', `tar_nombre` =  '$nombrede' WHERE  tar_id = $cue_id") or die ('Error en el numero'.mysql_error());;
					
					$hola='a_tarjeta.php?mensaje=2';
				    header("Location:$hola");	
					
					}
					else 
					{
					   
					   if (($cvv2_viejo==$cvv2)&&($nombrede_viejo==$nombrede)&&($fecha_viejo==$fecha)&&($banco_viejo==$banco)&&($cliente_viejo==$cliente))
					  {
					   		$result1= mysql_query("SELECT * FROM tarjeta WHERE tar_num = '$numero'");
					    	if(mysql_fetch_array($result1))
							{
					  
					  			$hola='a_tarjeta.php?mensaje=3';
				            	header("Location:$hola");		
							  
							}
					  		else 
					  		{
				
								mysql_query("UPDATE `tarjeta` SET  `tar_num` =  '$numero', tar_fechaven='$fecha', fk_ban_id='$banco', fk_per_cedula='$cliente', `tar_cvv2` =  '$cvv2', `tar_nombre` =  '$nombrede' WHERE  tar_id = $cue_id") or die ('Error en el numero'.mysql_error());;
					
								$hola='a_tarjeta.php?mensaje=2';
				    			header("Location:$hola");	
					  
					  		}
					
				
						}
						else
						{
							if (($numero_viejo== $numero)&&($cvv2_viejo==$cvv2)&&($nombrede_viejo==$nombrede)&&($fecha_viejo==$fecha)&&($cliente_viejo==$cliente))
							{
								//echo "cambio"; 
								mysql_query("UPDATE `tarjeta` SET  `tar_num` =  '$numero', tar_fechaven='$fecha', fk_ban_id='$banco', fk_per_cedula='$cliente', `tar_cvv2` =  '$cvv2', `tar_nombre` =  '$nombrede' WHERE  tar_id = $cue_id") or die ('Error en el banco'.mysql_error());;
					
								$hola='a_tarjeta.php?mensaje=2';
				    			header("Location:$hola");
							}
							else
							{
							//echo "entre";
								mysql_query("UPDATE `tarjeta` SET  `tar_num` =  '$numero', fk_ban_id='$banco', tar_fechaven='$fecha', `tar_cvv2` =  '$cvv2', `tar_nombre` =  '$nombrede', fk_per_cedula='$cliente' WHERE  tar_id = $cue_id") or die ('Error cambio todo'.mysql_error());;
					
								$hola='a_tarjeta.php?mensaje=2';
				    			header("Location:$hola");
						}	}
				
					}
	
				}
		  }
	      else
		  {//aqui pinta el editor por primera vez	
		   
					$admin= new Panel("../html/admin.html");
					$admin->add("body",'<body onLoad = "actual(10)" >');
					$paneleditar = new Panel("../html/a_crear_tarjeta.html");
					$paneleditar->add("form",'<form name="form1" method="post" action="../php/a_editar_tarjeta.php?cue_id='.$id.'">');
					$paneleditar->add("numero",$numero);
					$paneleditar->add("id_viejo",$id);
					$paneleditar->add("cvv2",$cvv2);
					$paneleditar->add("nombrede",$nombrede);
					$paneleditar->add("fecha",$fecha);
					$paneleditar->add("cliente",$cedula);
					$paneleditar->add("banco",$ban);
					$paneleditar->add("id",'<tr><td>Id:</td><td>'.$id.'</td></tr>');
					$select='';
					$result= mysql_query("SELECT * FROM banco");
					while($row = mysql_fetch_array($result))
					{
						if ($row["ban_id"]==$ban){
						    //echo 'if';
						    $select_actual='<option selected="selected" value="'.$row["ban_id"].'">'.$row["ban_nombre"].'</option>'; }	
						else{
					$select_actual='<option value="'.$row["ban_id"].'">'.$row["ban_nombre"].'</option>'; 		
						}
					$select=$select.$select_actual;
					
					}
					$paneleditar->add("bancos",$select);
			
					$select2='';
					$result2= mysql_query("SELECT * FROM persona");
					while($row2 = mysql_fetch_array($result2))
					{
						if ($row2["per_cedula"]==$cedula)
						{
						    $select_actual2='<option selected="selected" value="'.$row2["per_cedula"].'">'.$row2["per_apellido1"].', '.$row2["per_nombre1"].'</option>'; 
						 }	
					   else
					   {
					$select_actual2='<option value="'.$row2["per_cedula"].'">'.$row2["per_apellido1"].', '.$row2["per_nombre1"].'</option>'; 		
					   }
					$select2=$select2.$select_actual2;
					
					}
					$paneleditar->add("clientes",$select2);
					
					$paneleditar->add("tipo_boton",'Modificar');
					$admin->add("contenido",$paneleditar);
					$admin->show();
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>