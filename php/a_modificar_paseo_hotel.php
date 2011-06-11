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
					  
					  mysql_query("UPDATE `hot_pas` SET  `fk_pas_id` =  '$banco', `fk_hot_id` =  '$hot_id' WHERE  `hot_pas`.`hot_id` = $actual_1");
					
					$hola='a_hoteles.php?cue_id='.$hot_id.'';
				    header("Location:$hola");
	
	
		  }
	      else
		  {//aqui pinta el editor por primera vez	
		            //echo "$cue_numero , $tipo";  
					$admin= new Panel("../html/admin.html");
					$admin->add("body",'<body onLoad = "actual(5)" >');
					$panelestadios = new Panel("../html/a_crear_paseo_hotel.html");
					$panelestadios->add("form",'<form name="form1" method="post" action="../php/a_modificar_paseo_hotel.php?hot_id='.$hotel.'&actual_1='.$actual.'">');
					
					//$panelestadios->add("cue_numero",$cue_numero);
					//$panelestadios->add("id_viejo",$id);
					
					$select='';
					$result= mysql_query("SELECT * FROM  paseo");
					while($row = mysql_fetch_array($result))
					{				
						
						if ($row["pas_id"]==$ser){
						    //echo 'if';
						    $select_actual='<option selected="selected" value="'.$row["pas_id"].'">'.$row["pas_nombre"].'</option>'; 
							}	
						else{
						    //echo "banco es $banco";
						    $select_actual='<option value="'.$row["pas_id"].'">'.$row["pas_nombre"].'</option>'; 	}	
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