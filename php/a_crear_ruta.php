<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	extract($_GET);
	extract($_POST);
	
	      if($origen && $destino)
		  {
		  
		     
				mysql_query("INSERT INTO `ruta` (`rut_id` ,`rut_tipo` ,`fk_des_id` ,`fk_flo_id` ,`rut_costo`)VALUES (NULL ,  'Origen',  '$origen',  '$barco',  '$costo')");
				mysql_query("INSERT INTO `ruta` (`rut_id` ,`rut_tipo` ,`fk_des_id` ,`fk_flo_id` ,`rut_costo`)VALUES (NULL ,  'Destino',  '$destino',  '$barco',  '$costo')");
			    
				$hola='a_cruceros.php?mensaje=1';
				header("Location:$hola");
				  
		  
		  }
	      else
		  {
			
			$admin= new Panel("../html/admin.html");
			$admin->add("body",'<body onLoad = "actual(12)" >');
			$panelcuentas = new Panel("../html/a_crear_ruta.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/a_crear_ruta.php">');
	
	        $select='';
	        $result= mysql_query("SELECT * FROM  flota f where f.fk_cru_id=$cru_id and f.flo_id NOT IN (select fk_flo_id from ruta)");
        	while($row = mysql_fetch_array($result))
        	{
			$select_actual='<option value="'.$row["flo_id"].'">'.$row["flo_nombre"].'</option>'; 		
			$select=$select.$select_actual;
			}
			$panelcuentas->add("barcos",$select);
			
			$select1='';
	        $result1= mysql_query("SELECT * FROM  destino d where d.des_descripcion='Ciudad'");
        	while($row1 = mysql_fetch_array($result1))
        	{
			$select_actual1='<option value="'.$row1["des_id"].'">'.$row1["des_nombre"].'</option>'; 		
			$select1=$select1.$select_actual1;
			}
			$panelcuentas->add("origenes",$select1);
			
			$select2='';
	        $result2= mysql_query("SELECT * FROM  destino d where d.des_descripcion='Ciudad'");
        	while($row2 = mysql_fetch_array($result2))
        	{
			$select_actual2='<option value="'.$row2["des_id"].'">'.$row2["des_nombre"].'</option>'; 		
			$select2=$select2.$select_actual2;
			}
			$panelcuentas->add("destinos",$select2);
			
			
			$panelcuentas->add("tipo_boton",'Agregar');
			//$panelcuentas->add("error",'Ya existe un estadio '.$cue_numero.' andre '.$row["ban_nombre"]);
	        $admin->add("contenido",$panelcuentas);
	        $admin->show();
			
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>