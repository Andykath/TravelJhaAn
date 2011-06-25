<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_POST);
	
	      if($cedula)
		  {
		  
		     $result1= mysql_query("SELECT * FROM persona p WHERE p.per_cedula ='$cedula'");
			
			
			
			  if (mysql_fetch_array($result1))
			  {
					$admin= new Panel("../html/u_registrarse.html");
					//$admin->add("body",'<body onLoad = "actual(4)" >');
					$panelciudades = new Panel("../html/u_registro.html");
					$panelciudades->add("form",'<form name="form1" method="post" action="../php/u_registro.php">');
					$panelciudades->add("cedula",$cedula);
					$panelciudades->add("nombre1",$nombre1);
					$panelciudades->add("nombre2",$nombre2);
					$panelciudades->add("apellido1",$apellido1);	
					$panelciudades->add("apellido2",$apellido2);
					$panelciudades->add("sexo",$sexo);
					$panelciudades->add("direccion",$direccion);
					$panelciudades->add("fecha",$fecha);	
					$panelciudades->add("edocivil",$edocivil);
					//$panelciudades->add("nacionalidad",$nacionalidad);
					$panelciudades->add("visa",$visa);
					$panelciudades->add("pasaporte",$pasaporte);										
					$select='';
					$result= mysql_query("SELECT * FROM  destino where des_descripcion='pais'");
				    while($row = mysql_fetch_array($result))
					{
					$select_actual='<option value="'.$row["des_id"].'">'.$row["des_nombre"].'</option>'; 		
					$select=$select.$select_actual;
					}
					$panelciudades->add("bancos",$select);
					$panelciudades->add("error",'Ya existe ese cliente');
					$panelciudades->add("tipo_boton",'Registarse');
					$admin->add("contenido",$panelciudades);
					$admin->show();
					  
			  
			  }
			  else
			  {
               //echo $nacionalidad;
			  $result1= mysql_query("SELECT des_nombre FROM destino WHERE des_id=$nacionalidad");
			  $row = mysql_fetch_array($result1);
			  $nacionalidad1=$row[0];
			  
			  //if (mysql_fetch_array($result1)){
			  //echo "$row[0] asd";
			  //  $nacionalidad1=$row[0];
			  //}
			  //echo "$nacionalidad1 nacio1";
			mysql_query("INSERT INTO `persona` (`per_cedula` ,`per_nombre1` ,`per_nombre2` ,`per_apellido1` ,`per_apellido2`, `per_sexo`, `per_tipo`, `per_direccion`, `per_fecha_nac`, `per_edo_civil`, `per_nacionalidad`, `per_visa`, `per_pasaporte`, `per_cant_millas`) VALUES ('$cedula' ,'$nombre1',  '$nombre2',  '$apellido1',  '$apellido2','$sexo','Cliente','$direccion','$fecha','$edocivil','$nacionalidad1','$visa','$pasaporte',NULL)");
			    
				mysql_query("INSERT INTO `usuario` (`usu_login`,`usu_password`,`fk_per_cedula`) VALUES('$login', '$password','$cedula')");
				
				
				mysql_query("INSERT INTO `telefono` (`tel_id`,`tel_numero`,`tel_tipo`, `fk_per_cedula`) VALUES(NULL, '$numero1','$tipo1','$cedula')");
				
				if ($numero2 != NULL){
				mysql_query("INSERT INTO `telefono` (`tel_id`,`tel_numero`,`tel_tipo`, `fk_per_cedula`) VALUES(NULL, '$numero2','$tipo2','$cedula')");
				}
				
				$hola='login.php?mensaje=5';
				header("Location:$hola");
			  
			  
			  }
	  
		  
		  }
	      else
		  {
			
			$admin= new Panel("../html/u_registrarse.html");
			//$admin->add("body",'<body onLoad = "actual(4)" >');
			$panelcuentas = new Panel("../html/u_registro.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/u_registro.php">');
	
	        $select='';
	        $result= mysql_query("SELECT * FROM  destino where des_descripcion='pais'");
        	while($row = mysql_fetch_array($result))
        	{
			$select_actual='<option value="'.$row["des_id"].'">'.$row["des_nombre"].'</option>'; 		
			$select=$select.$select_actual;
			}
			$panelcuentas->add("bancos",$select);
			$panelcuentas->add("tipo_boton",'Agregar');
			//$panelcuentas->add("error",'Ya existe un estadio '.$cue_numero.' andre '.$row["ban_nombre"]);
	        $admin->add("contenido",$panelcuentas);
	        $admin->show();
			
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>