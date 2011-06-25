<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_GET);
	extract($_POST);
	
	      if($estadio_viejo)
		  {// aqui validar que los datos esten bien y hacer update
		
		
               if (($estadio_viejo== $nombre)&&($ciudad_vieja==$moneda))    
				{	
				    $hola='a_paises.php';
				    header("Location:$hola");	 
				}
				else 
				{
				    
				    if ((strtoupper($estadio_viejo)== strtoupper($nombre))&&($ciudad_vieja==$moneda))
					{
					
					
					mysql_query("UPDATE `destino` SET  `des_nombre` =  '$nombre',`fk_mon_id` =  '$moneda' WHERE  `destino`.`des_id` = $p_id");
					
					$hola='a_paises.php?mensaje=2';
				    header("Location:$hola");	
					
					}
					else 
					{//1
					   
					   
					   $result1= mysql_query("SELECT * FROM destino d WHERE d.des_nombre ='$nombre' AND d.fk_mon_id = '$moneda'");
					  if (mysql_fetch_array($result1))
					  {
					  		$hola='a_paises.php?mensaje=4';
				            header("Location:$hola");		
							
					  }
					  else
					  {
					  //echo ", $cue_id";
					  mysql_query("UPDATE `destino` SET  `des_nombre` =  '$nombre', `fk_mon_id` =  '$moneda' WHERE  `destino`.`des_id` = $p_id");
					
					$hola='a_paises.php?mensaje=2';
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
					$panelestadios = new Panel("../html/a_crear_pais.html");
					$panelestadios->add("form",'<form name="form1" method="post" action="../php/a_modificar_pais.php?p_id='.$id.'">');
					$panelestadios->add("nombre",$nombre);
					$panelestadios->add("id_viejo",$id);
					$panelestadios->add("moneda",$moneda);
					$panelestadios->add("id",'<tr><td>Id:</td><td>'.$id.'</td></tr>');

					$select='';
					$result= mysql_query("SELECT * FROM  moneda");
					while($row = mysql_fetch_array($result))
					{				
						
						if ($row["mon_id"]==$moneda){
						    //echo 'if';
						    $select_actual='<option selected="selected" value="'.$row["mon_id"].'">'.$row["mon_nombre"].'</option>'; }	
						else{
						    //echo "banco es $banco";
						    $select_actual='<option value="'.$row["mon_id"].'">'.$row["mon_nombre"].'</option>'; 	}	
					    $select=$select.$select_actual;
					}
					$panelestadios->add("monedas",$select);
					$panelestadios->add("tipo_boton",'Modificar');
					$admin->add("contenido",$panelestadios);
					$admin->show();
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>