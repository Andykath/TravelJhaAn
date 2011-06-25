<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_POST);
	
	      if($descripcion)
		  {
		    
		     $result1= mysql_query("SELECT * FROM publicidad WHERE pub_descripcion ='$descripcion'");
			
			
			
			  if (mysql_fetch_array($result1))
			  {
					$admin= new Panel("../html/admin.html");
					$admin->add("body",'<body onLoad = "actual(10)" >');
					$panelpubhot = new Panel("../html/a_crear_publicidad_hotel.html");
					$panelpubhot->add("form",'<form name="form1" method="post" action="../php/a_crear_publicidad_hotel.php">');
					$panelpubhot->add("descripcion",$descripcion);
					$panelpubhot->add("logo",$logo);
					
			
					$select='';
					$result= mysql_query("SELECT * FROM  publicidad");
					while($row = mysql_fetch_array($result))
					{
					
						$select_actual='<option value="'.$row["pub_id"].'">'.$row["pub_descripcion"].'</option>'; 		
						$select=$select.$select_actual;
					}
					$panelpubhot->add("error",'Ya existe esa publicidad');
					$panelpubhot->add("tipo_boton",'Agregar');
					$admin->add("contenido",$panelpubhot);
					$admin->show();
					  
			  
			  }
			  else
			  {
				  
				mysql_query("INSERT INTO `viajesucab`.`publicidad` (`pub_id`, `pub_descripcion`,`pub_logo`,`fk_aer_id`, `fk_ter_id`, `fk_cru_id`, `fk_hot_id`) VALUES (NULL ,'$descripcion', '$logo',  NULL, NULL, NULL, '$hotel')");
			    
				$hola='a_publicidad_hotel.php?mensaje=1';
				header("Location:$hola");
			  
			  
			  }
		  
		  }
	      else
		  {
			
			$admin= new Panel("../html/admin.html");
			$admin->add("body",'<body onLoad = "actual(10)" >');
			$panelpubhot = new Panel("../html/a_crear_publicidad_hotel.html");
			$panelpubhot->add("form",'<form name="form1" method="post" action="../php/a_crear_publicidad_hotel.php">');
			
			$select='';
			$result= mysql_query("SELECT * FROM hotel");
			while($row = mysql_fetch_array($result))
	
				{
					$select_actual='<option value="'.$row["hot_id"].'">'.$row["hot_nombre"].'</option>'; 		
					
					$select=$select.$select_actual;
					
				}
			$panelpubhot->add("hoteles",$select);
	        $panelpubhot->add("tipo_boton",'Agregar');
	        
	        $admin->add("contenido",$panelpubhot);
	        $admin->show();
			
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>