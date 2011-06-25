<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_GET);
	extract($_POST);
	
	      if($cedula1)
		  {// aqui validar que los datos esten bien y hacer update
		       //echo 'cedula'.$cedula;
		//echo "$id1 , $id2";
               if (($nombre_1== $nombre1)&&($nombre_2==$nombre2)&&($apellido_1==$apellido1)&&($apellido_2==$apellido2)&&($sexo1==$sexo)&&($direccion1==$direccion)&&($fecha_vieja==$fecha)&&($edo_civil1==$edocivil)&&($nacionalidad1==$nacionalidad)&&($visa1==$visa)&&($pasaporte1==$pasaporte))    
				{	
				    $hola='a_usuarios.php';
				    header("Location:$hola");	 
				}
				else 
				{
				    
				    if ((strtoupper($cedula1)== strtoupper($cedula)))
					{
					 $result1= mysql_query("SELECT des_nombre FROM destino WHERE des_id=$nacionalidad");
			  $row = mysql_fetch_array($result1);
			  $nacionalidad1=$row[0];
					//echo "$nombre1, $cedula, $nacionalidad, $login   2";
					mysql_query("UPDATE `persona` SET  `per_cedula` =  '$cedula', `per_nombre1` =  '$nombre1',`per_nombre2` =  '$nombre2', `per_apellido1`='$apellido1',`per_apellido2` =  '$apellido2',`per_sexo` =  '$sexo',`per_tipo` =  'Empleado',`per_direccion` =  '$direccion',`per_fecha_nac` =  '$fecha',`per_edo_civil` =  '$edocivil',`per_nacionalidad` =  '$nacionalidad1',`per_visa` =  '$visa',`per_pasaporte` =  '$pasaporte', `per_cant_millas` =  '$millas' WHERE  `persona`.`per_cedula` = $cedula1");
					mysql_query("UPDATE `usuario` SET `usu_login`='$login', `usu_password`='$password' WHERE `fk_per_cedula`=$cedula1");
					$hola='a_usuarios.php?mensaje=2';
				    header("Location:$hola");
						
					
					
					}
					else 
					{//1
					   
					    //echo "$nombre1, $cedula, $nacionalidad, $login , $cedula1 , $password, $fechanac   3";

					  $result2= mysql_query("SELECT des_nombre FROM destino WHERE des_id=$nacionalidad");
			         $row1 = mysql_fetch_array($result2);
			        $nacionalidad2=$row1[0];
					  mysql_query("UPDATE `persona` SET  `per_cedula` =  '$cedula', `per_nombre1` =  '$nombre1',`per_nombre2` =  '$nombre2', `per_apellido1`='$apellido1',`per_apellido2` =  '$apellido2',`per_sexo` =  '$sexo',`per_tipo` =  'Empleado',`per_direccion` =  '$direccion',`per_fecha_nac` =  '$fecha',`per_edo_civil` =  '$edocivil',`per_nacionalidad` =  '$nacionalidad2',`per_visa` =  '$visa',`per_pasaporte` =  '$pasaporte', `per_cant_millas` =  '$millas' WHERE  `persona`.`per_cedula` = $cedula1");
					  
					  mysql_query("UPDATE `usuario` SET `usu_login`='$login', `usu_password`='$password' WHERE `fk_per_cedula`=$cedula");	
					
					$hola='a_usuarios.php?mensaje=2';
				    header("Location:$hola");
					  
					  
					  
					
				
				}	
				
			 }		
	
		  }
	      else
		  {//aqui pinta el editor por primera vez	
		            //echo "$cue_numero , $tipo";  
					$admin= new Panel("../html/admin.html");
					$admin->add("body",'<body onLoad = "actual(4)" >');
					$panelestadios = new Panel("../html/a_modificarempleado.html");
					$panelestadios->add("form",'<form name="form1" method="post" action="../php/a_modificar_empleado.php?nombre1='.$nombre1.'&nombre2='.$nombre2.'&apellido1='.$apellido1.'&apellido2='.$apellido2.'&cedula='.$cedula.'&direccion='.$direccion.'&fechanac='.$fechanac.'&sexo='.$sexo.'&edocivil='.$edocivil.'&pasaporte='.$pasaporte.'&visa='.$visa.'&login='.$login.'&password='.$password.'&nacionalidad='.$nacionalidad.'">');
					$panelestadios->add("cedula",$cedula);
					$panelestadios->add("nombre1",$nombre1);
					$panelestadios->add("nombre2",$nombre2);
					$panelestadios->add("apellido1",$apellido1);
					$panelestadios->add("apellido2",$apellido2);
					$panelestadios->add("sexo",$sexo);
					$panelestadios->add("direccion",$direccion);
					$panelestadios->add("cue_fecha_apertura",$fechanac);
					$panelestadios->add("edocivil",$edocivil);
					$panelestadios->add("visa",$visa);
					$panelestadios->add("pasaporte",$pasaporte);
					$panelestadios->add("login",$login);
					$panelestadios->add("password",$password);
					$panelestadios->add("millas",$millas);
					
					$panelestadios->add("id",'<tr><td>Id:</td><td>'.$id.'</td></tr>');

					$select='';
					$result= mysql_query("SELECT * FROM  destino WHERE des_descripcion='pais'");
					while($row = mysql_fetch_array($result))
					{				
						
						if ($row["des_nombre"]==$nacionalidad){
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