<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_GET);
	extract($_POST);
	
	      if($estadio_viejo)
		  {// aqui validar que los datos esten bien y hacer update
		
		
               if (($estadio_viejo== $nombre)&&($ciudad_vieja==$pais))    
				{	
				    $hola='a_ciudades.php';
				    header("Location:$hola");	 
				}
				else 
				{
				    
				    if ((strtoupper($estadio_viejo)== strtoupper($nombre))&&($ciudad_vieja==$pais))
					{
					
					
					mysql_query("UPDATE `destino` SET  `des_nombre` =  '$nombre',`fk_des_id` =  '$pais' WHERE  `destino`.`des_id` = $ciu_id");
					
					$hola='a_ciudades.php?mensaje=2';
				    header("Location:$hola");	
					
					}
					else 
					{//1
					   
					   
					   $result1= mysql_query("SELECT * FROM destino d WHERE d.des_nombre ='$nombre' AND d.fk_des_id = '$pais'");
					  if (mysql_fetch_array($result1))
					  {
					  		$hola='a_ciudades.php?mensaje=4';
				            header("Location:$hola");		
							
					  }
					  else
					  {
					  //echo ", $cue_id";
					  mysql_query("UPDATE `destino` SET  `des_nombre` =  '$nombre', `fk_des_id` =  '$pais' WHERE  `destino`.`des_id` = $ciu_id");
					
					$hola='a_ciudades.php?mensaje=2';
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
					$panelestadios = new Panel("../html/a_crear_ciudad.html");
					$panelestadios->add("form",'<form name="form1" method="post" action="../php/a_modificarciudad.php?ciu_id='.$id.'">');
					$panelestadios->add("nombre",$nombre);
					$panelestadios->add("id_viejo",$id);
					$panelestadios->add("pais",$idp);
					$panelestadios->add("id",'<tr><td>Id:</td><td>'.$id.'</td></tr>');

					$select='';
					$result= mysql_query("SELECT * FROM  destino d WHERE d.des_descripcion='Pais'");
					while($row = mysql_fetch_array($result))
					{				
						
						if ($row["des_id"]==$idp){
						    //echo 'if';
						    $select_actual='<option selected="selected" value="'.$row["des_id"].'">'.$row["des_nombre"].'</option>'; }	
						else{
						    //echo "banco es $banco";
						    $select_actual='<option value="'.$row["des_id"].'">'.$row["des_nombre"].'</option>'; 	}	
					    $select=$select.$select_actual;
					}
					$panelestadios->add("paises",$select);
					$panelestadios->add("tipo_boton",'Modificar');
					$admin->add("contenido",$panelestadios);
					$admin->show();
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>