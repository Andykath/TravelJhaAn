<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_GET);
	extract($_POST);
	
	      if($estadio_viejo)
		  {// aqui validar que los datos esten bien y hacer update
		
		
               if (($estadio_viejo== $cue_numero)&&($aforo_viejo==$tipo)&&($ciudad_vieja==$banco) && ($fecha_vieja == $fecha))    
				{	
				    $hola='a_terrestre.php';
				    header("Location:$hola");	 
				}
				else 
				{
				    
				    if ((strtoupper($estadio_viejo)== strtoupper($cue_numero))&&($ciudad_vieja==$banco))
					{
					
					
					mysql_query("UPDATE `terrestre` SET  `ter_nombre` =  '$cue_numero',  `ter_fecha_inicio` =  '$fecha',`fk_des_id` =  '$banco' WHERE  `terrestre`.`ter_id` = $cue_id");
					
					$hola='a_terrestre.php?mensaje=2';
				    header("Location:$hola");	
					
					}
					else 
					{//1
					   
					   
					   $result1= mysql_query("SELECT * FROM terrestre t WHERE t.ter_id ='$cue_numero' AND t.fk_des_id = '$banco'");
					  if (mysql_fetch_array($result1))
					  {
					  		$hola='a_terrestre.php?mensaje=3';
				            header("Location:$hola");		
							/*$admin= new Panel("../html/admin.html");
							$admin->add("body",'<body onLoad = "actual(12)" >');
							$panelestadios = new Panel("../html/a_cuentas_bancarias.html");
							$panelestadios->add("error",'Ya existe esa cuenta en ese banco');
							$panelestadios->add("form",'<form name="form1" method="post" action="../php/a_modificar_cuenta.php">');
							$panelestadios->add("cue_numero",$estadio_viejo);
							$panelestadios->add("tipo",$aforo_viejo);
							$panelestadios->add("id_viejo",$id);
							$panelestadios->add("banco",$ciudad_vieja);
							$panelestadios->add("id",'<tr><td>Id:</td><td>'.$id.'</td></tr>');
							$panelestadios->add("error",'Ya existe una cuenta '.$cue_numero.' en '.$banco);
							$panelestadios->add("fecha",$fecha);
							$select='';
							$result= mysql_query("SELECT * FROM  banco b");
							while($row = mysql_fetch_array($result))
							{
							    if ($row["ban_id"]==$banco) 
								$panelestadios->add("error",'Ya existe un estadio '.$cue_numero.' en '.$row["ban_nombre"]);
								 
								if ($row["ban_id"]==$ciudad_vieja)
									$select_actual='<option selected="selected" value="'.$row["ban_id"].'">'.$row["ban_nombre"].'</option>'; 	  
								else
									$select_actual='<option value="'.$row["ban_id"].'">'.$row["ban_nombre"].'</option>'; 		
								$select=$select.$select_actual;
							}
							$panelestadios->add("bancos",$select);
							$panelestadios->add("tipo_boton",'Modificar'); 
							$admin->add("contenido",$panelestadios);
							$admin->show();*/
									   
					
					
					  }
					  else
					  {
					  //echo ", $cue_id";
					  mysql_query("UPDATE `terrestre` SET  `ter_nombre` =  '$cue_numero', `ter_fecha_inicio` =  '$fecha',`fk_des_id` =  '$banco' WHERE  `terrestre`.`ter_id` = $cue_id");
					
					$hola='a_terrestre.php?mensaje=2';
				    header("Location:$hola");
					  
					  
					  }
					
				
				}	
				
			 }		
	
		  }
	      else
		  {//aqui pinta el editor por primera vez	
		            //echo "$cue_numero , $tipo";  
					$admin= new Panel("../html/admin.html");
					$admin->add("body",'<body onLoad = "actual(3)" >');
					$panelestadios = new Panel("../html/a_crear_terrestre.html");
					$panelestadios->add("form",'<form name="form1" method="post" action="../php/a_editar_terrestre.php?cue_id='.$id.'">');
					$panelestadios->add("cue_numero",$cue_numero);
					$panelestadios->add("tipo",$tipo);
					$panelestadios->add("id_viejo",$id);
					$panelestadios->add("banco",$banco);
					$panelestadios->add("id",'<tr><td>Id:</td><td>'.$id.'</td></tr>');
					$panelestadios->add("cue_fecha_apertura",$fecha);
					 
					
			
					$select='';
					$result= mysql_query("SELECT * FROM  destino where des_descripcion='pais' ");
					while($row = mysql_fetch_array($result))
					{				
						
						if ($row["des_id"]==$banco){
						    //echo 'if';
						    $select_actual='<option selected="selected" value="'.$row["des_id"].'">'.$row["des_nombre"].'</option>'; }	
						else{
						    //echo "banco es $banco";
						    $select_actual='<option value="'.$row["des_id"].'">'.$row["des_nombre"].'</option>'; 	}	
					    $select=$select.$select_actual;
					}
					$panelestadios->add("bancos",$select);
					$panelestadios->add("tipo_boton",'Modificar');
					$admin->add("contenido",$panelestadios);
					$admin->show();
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>