<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_POST);
	
	      if($numero)
		  {
		    
		     $result1= mysql_query("SELECT * FROM deposito WHERE dep_numero ='$numero'");
			
			
			
			  if (mysql_fetch_array($result1))
			  {
					$admin= new Panel("../html/admin.html");
					$admin->add("body",'<body onLoad = "actual(10)" >');
					$panelpubhot = new Panel("../html/a_crear_deposito.html");
					$panelpubhot->add("form",'<form name="form1" method="post" action="../php/a_crear_deposito.php">');
					$panelpubhot->add("numero",$numero);
					$panelpubhot->add("cuenta",$cuenta);
					$panelpubhot->add("fecha",$fecha);
					
			$select='';
			$result= mysql_query("SELECT * FROM banco");
			while($row = mysql_fetch_array($result))
	
				{
					$select_actual='<option value="'.$row["ban_id"].'">'.$row["ban_nombre"].'</option>'; 		
					
					$select=$select.$select_actual;
					
				}
			$panelpubhot->add("bancos",$select);
			
			$select2='';
			$result2= mysql_query("SELECT * FROM persona'");
			while($row2 = mysql_fetch_array($result2))
	
				{
					$select_actual2='<option value="'.$row2["per_cedula"].'">'.$row2["per_apellido1"].', '.$row2["per_nombre1"].'</option>'; 		
					
					$select2=$select2.$select_actual2;
					
				}
					$panelpubhot->add("clientes",$select2);
					$panelpubhot->add("error",'Ya existe esa publicidad');
					$panelpubhot->add("tipo_boton",'Agregar');
					$admin->add("contenido",$panelpubhot);
					$admin->show();
					  
			  
			  }
			  else
			  {
				  
				mysql_query("INSERT INTO `deposito` VALUES (NULL, '$numero', '$cuenta', '$fecha', '$cliente', '$banco');
");
			    
				$hola='a_deposito.php?mensaje=135246';
				header("Location:$hola");
			  
			  
			  }
		  
		  }
	      else
		  {
			
			$admin= new Panel("../html/admin.html");
			$admin->add("body",'<body onLoad = "actual(10)" >');
			$panelpubhot = new Panel("../html/a_crear_deposito.html");
			$panelpubhot->add("form",'<form name="form1" method="post" action="../php/a_crear_deposito.php">');
			
			$select='';
			$result= mysql_query("SELECT * FROM banco");
			while($row = mysql_fetch_array($result))
	
				{
					$select_actual='<option value="'.$row["ban_id"].'">'.$row["ban_nombre"].'</option>'; 		
					
					$select=$select.$select_actual;
					
				}
			$panelpubhot->add("bancos",$select);
			
			$select2='';
			$result2= mysql_query("SELECT * FROM persona");
			while($row2 = mysql_fetch_array($result2))
	
				{
					$select_actual2='<option value="'.$row2["per_cedula"].'">'.$row2["per_apellido1"].', '.$row2["per_nombre1"].'</option>'; 		
					
					$select2=$select2.$select_actual2;
					
				}
			$panelpubhot->add("clientes",$select2);
	        $panelpubhot->add("tipo_boton",'Agregar');
	        
	        $admin->add("contenido",$panelpubhot);
	        $admin->show();
			
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>