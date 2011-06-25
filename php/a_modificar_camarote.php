<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_GET);
	extract($_POST);
	
	      if($estadio_viejo)
		  {// aqui validar que los datos esten bien y hacer update

               
					  mysql_query("UPDATE `habitacion` SET  `hab_piso` =  '$cue_numero', `hab_capacidad` =  '$fecha', `hab_costo` =  '$banco', `hab_categoria` =  '$categoria' WHERE  `habitacion`.`hab_id` = $cue_id");
					
					$hola='a_camarotes.php?cue_id='.$hot_id.'';
				    header("Location:$hola");
	
	
		  }
	      else
		  {//aqui pinta el editor por primera vez	
		            //echo "$cue_numero , $tipo";  
					$admin= new Panel("../html/admin.html");
					$admin->add("body",'<body onLoad = "actual(1)" >');
					$panelestadios = new Panel("../html/a_crear_camarote.html");
					$panelestadios->add("form",'<form name="form1" method="post" action="../php/a_modificar_camarote.php?cue_id='.$id.'&hot_id='.$hotel.'">');
					$panelestadios->add("cue_numero",$cue_numero);
					$panelestadios->add("id_viejo",$id);
					$panelestadios->add("banco",$banco);
					$panelestadios->add("id",'<tr><td>Id:</td><td>'.$id.'</td></tr>');
					$panelestadios->add("cue_fecha_apertura",$fecha);
					$panelestadios->add("tipo_boton",'Modificar');
					$admin->add("contenido",$panelestadios);
					$admin->show();
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>