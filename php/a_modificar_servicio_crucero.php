<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_GET);
	extract($_POST);
	
	      if($banco)
		  {// aqui validar que los datos esten bien y hacer update

                    // echo("entro");
					// ech/o($actual_1);
					 // echo($hot_id);
					  
					  mysql_query("UPDATE `cru_ser` SET  `fk_ser_id` =  '$banco', `fk_flo_id` =  '$hot_id' WHERE  `cru_ser`.`cru_id` = $actual_1");
					
					$hola='a_servicios_cruceros.php?cue_id='.$hot_id.'';
				    header("Location:$hola");
	
	
		  }
	      else
		  {//aqui pinta el editor por primera vez	
		            //echo "$cue_numero , $tipo";  
					$admin= new Panel("../html/admin.html");
					$admin->add("body",'<body onLoad = "actual(1)" >');
					$panelestadios = new Panel("../html/a_crear_servicio_crucero.html");
					$panelestadios->add("form",'<form name="form1" method="post" action="../php/a_modificar_servicio_crucero.php?hot_id='.$hotel.'&actual_1='.$actual.'">');
					
					//$panelestadios->add("cue_numero",$cue_numero);
					//$panelestadios->add("id_viejo",$id);
					
					$select='';
					$result= mysql_query("SELECT * FROM  servicio");
					while($row = mysql_fetch_array($result))
					{				
						
						if ($row["ser_id"]==$ser){
						    //echo 'if';
						    $select_actual='<option selected="selected" value="'.$row["ser_id"].'">'.$row["ser_nombre"].'</option>'; 
							}	
						else{
						    //echo "banco es $banco";
						    $select_actual='<option value="'.$row["ser_id"].'">'.$row["ser_nombre"].'</option>'; 	}	
					    $select=$select.$select_actual;
					}
					
					
					
					$panelestadios->add("bancos",$select);
					//$panelestadios->add("id",'<tr><td>Id:</td><td>'.$id.'</td></tr>');
					
					$panelestadios->add("tipo_boton",'Modificar');
					$admin->add("contenido",$panelestadios);
					$admin->show();
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>