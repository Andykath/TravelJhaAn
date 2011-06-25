<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	extract($_GET);
	extract($_POST);
	//echo "$parada";
	      if($parada)
		  {
		  
		     
				mysql_query("INSERT INTO `ruta` (`rut_id` ,`rut_tipo` ,`fk_des_id` ,`fk_flo_id` ,`rut_costo`)VALUES (NULL ,  'Parada',  '$parada',  '$flo_id',  NULL)");
				
			    
				$hola='a_rutas.php?cru_id='.$cru_id.'';
				header("Location:$hola");
				  
		  
		  }
	      else
		  {
			
			$admin= new Panel("../html/admin.html");
			$admin->add("body",'<body onLoad = "actual(12)" >');
			$panelcuentas = new Panel("../html/a_crear_parada.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/a_crear_parada.php?flo_id='.$flo_id.'&cru_id='.$cru_id.'">');
	
			$select1='';
	        $result1= mysql_query("SELECT * FROM  destino d where d.des_descripcion='Ciudad'");
        	while($row1 = mysql_fetch_array($result1))
        	{
			$select_actual1='<option value="'.$row1["des_id"].'">'.$row1["des_nombre"].'</option>'; 		
			$select1=$select1.$select_actual1;
			}
			$panelcuentas->add("paradas",$select1);
			
			
			
			$panelcuentas->add("tipo_boton",'Agregar');
			//$panelcuentas->add("error",'Ya existe un estadio '.$cue_numero.' andre '.$row["ban_nombre"]);
	        $admin->add("contenido",$panelcuentas);
	        $admin->show();
			
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>