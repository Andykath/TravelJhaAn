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
					$panelpubhot = new Panel("../html/a_crear_publicidad_transporte.html");
					$panelpubhot->add("form",'<form name="form1" method="post" action="../php/a_crear_publicidad_transporte.php">');
					$panelpubhot->add("descripcion",$descripcion);
					$panelpubhot->add("logo",$logo);
					$select='';
			$result= mysql_query("SELECT * FROM aerolinea");
			while($row = mysql_fetch_array($result))
	
				{	$tipo="Aerolinea: ".$row["aer_nombre"];
					$id="a.".$row["aer_id"];
					$select_actual='<option value="'.$id.'">'.$tipo.'</option>'; 		
					
					$select=$select.$select_actual;
					
				}
			$panelpubhot->add("transporte",$select);
			$result2= mysql_query("SELECT * FROM terrestre");
			while($row2 = mysql_fetch_array($result2))
	
				{	$tipo="Terrestre: ".$row2["ter_nombre"];
					$id="t.".$row2["ter_id"];
					$select_actual='<option value="'.$id.'">'.$tipo.'</option>'; 		
					
					$select=$select.$select_actual;
					
				}
			$panelpubhot->add("transporte",$select);
			$result3= mysql_query("SELECT * FROM crucero");
			while($row3 = mysql_fetch_array($result3))
	
				{	$tipo="Crucero: ".$row3["cru_nombre"];
					$id="c.".$row3["cru_id"];
					$select_actual='<option value="'.$id.'">'.$tipo.'</option>'; 		
					
					$select=$select.$select_actual;
					
				}
			$panelpubhot->add("transporte",$select);
			
					
					$panelpubhot->add("error",'Ya existe esa publicidad');
					$panelpubhot->add("tipo_boton",'Agregar');
					$admin->add("contenido",$panelpubhot);
					$admin->show();
					  
			  
			  }
			  else
			  {
				  
				//echo "trans: ".$trans; 
				$tip=substr($hotel,0,1);
				$id=substr($hotel,2,3);
				//echo "tipo".$tip;
				//echo "id".$id;
				if ($tip =='a')
				{
					//echo "pico".$tip;
					mysql_query("INSERT INTO `viajesucab`.`publicidad` (`pub_id`, `pub_descripcion`,`pub_logo`,`fk_aer_id`, `fk_ter_id`, `fk_cru_id`, `fk_hot_id`) VALUES (NULL ,'$descripcion', '$logo',  '$id', NULL, NULL, NULL)")or die (mysql_error());
			    
				$hola='a_publicidad_transporte.php?mensaje=1';
				header("Location:$hola");
				}
				else
				{
					if ($tip =='t')
					{
						//echo "pico".$tip;
						mysql_query("INSERT INTO `viajesucab`.`publicidad` (`pub_id`, `pub_descripcion`,`pub_logo`,`fk_aer_id`, `fk_ter_id`, `fk_cru_id`, `fk_hot_id`) VALUES (NULL ,'$descripcion', '$logo', NULL, '$id', NULL, NULL)")or die (mysql_error());;
			    
						$hola='a_publicidad_transporte.php?mensaje=1';
						header("Location:$hola");
					}
					else
					{
						//echo "tipo ".$tip; echo " id ".$id;
						mysql_query("INSERT INTO `viajesucab`.`publicidad` (`pub_id`, `pub_descripcion`,`pub_logo`,`fk_aer_id`, `fk_ter_id`, `fk_cru_id`, `fk_hot_id`) VALUES (NULL ,'$descripcion', '$logo',  NULL, NULL, '$id', NULL)") or die ('error aqi'.mysql_error());
			    		$hola='a_publicidad_transporte.php?mensaje=1';
						header("Location:$hola");
					}	
				}
								
			  
			  }
		  
		  }
	      else
		  {
			
			$admin= new Panel("../html/admin.html");
			$admin->add("body",'<body onLoad = "actual(10)" >');
			$panelpubhot = new Panel("../html/a_crear_publicidad_transporte.html");
			$panelpubhot->add("form",'<form name="form1" method="post" action="../php/a_crear_publicidad_transporte.php">');
			
			$select='';
			$result= mysql_query("SELECT * FROM aerolinea");
			while($row = mysql_fetch_array($result))
	
				{	$tipo="Aerolinea: ".$row["aer_nombre"];
					$id="a.".$row["aer_id"];
					$select_actual='<option value="'.$id.'">'.$tipo.'</option>'; 		
					
					$select=$select.$select_actual;
					
				}
			$panelpubhot->add("transporte",$select);
			$result2= mysql_query("SELECT * FROM terrestre");
			while($row2 = mysql_fetch_array($result2))
	
				{	$tipo="Terrestre: ".$row2["ter_nombre"];
					$id="t.".$row2["ter_id"];
					$select_actual='<option value="'.$id.'">'.$tipo.'</option>'; 		
					
					$select=$select.$select_actual;
					
				}
			$panelpubhot->add("transporte",$select);
			$result3= mysql_query("SELECT * FROM crucero");
			while($row3 = mysql_fetch_array($result3))
	
				{	$tipo="Crucero: ".$row3["cru_nombre"];
					$id="c.".$row3["cru_id"];
					$select_actual='<option value="'.$id.'">'.$tipo.'</option>'; 		
					
					$select=$select.$select_actual;
					
				}
			$panelpubhot->add("transporte",$select);
	        $panelpubhot->add("tipo_boton",'Agregar');
	        
	        $admin->add("contenido",$panelpubhot);
	        $admin->show();
			
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>