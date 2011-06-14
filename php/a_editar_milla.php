<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_GET);
	extract($_POST);
	
	      if($cliente_viejo)
		  {
			 
				if (($cliente_viejo==$cliente))    
				{	
				    $hola='a_milla.php';
				    header("Location:$hola");	 
				}
				else 
				{
				    
					
					mysql_query("UPDATE `milla` SET fk_per_cedula='$cliente' WHERE  mil_id = $cue_id") or die ('Error en el numero'.mysql_error());;
					
					$hola='a_milla.php?mensaje=2';
				    header("Location:$hola");	
				}
		  }
	      else
		  {//aqui pinta el editor por primera vez	
		   
					$admin= new Panel("../html/admin.html");
					$admin->add("body",'<body onLoad = "actual(10)" >');
					$paneleditar = new Panel("../html/a_crear_milla.html");
					$paneleditar->add("form",'<form name="form1" method="post" action="../php/a_editar_milla.php?cue_id='.$id.'">');
					$paneleditar->add("cliente",$cedula);
					$paneleditar->add("id",'<tr><td>Id:</td><td>'.$id.'</td></tr>');
			
					$select2='';
					$result2= mysql_query("SELECT * FROM persona");
					while($row2 = mysql_fetch_array($result2))
					{
						if ($row2["per_cedula"]==$cedula)
						{
						    $select_actual2='<option selected="selected" value="'.$row2["per_cedula"].'">'.$row2["per_apellido1"].', '.$row2["per_nombre1"].'</option>'; 
						 }	
					   else
					   {
					$select_actual2='<option value="'.$row2["per_cedula"].'">'.$row2["per_apellido1"].', '.$row2["per_nombre1"].'</option>'; 		
					   }
					$select2=$select2.$select_actual2;
					
					}
					$paneleditar->add("clientes",$select2);
					
					$paneleditar->add("tipo_boton",'Modificar');
					$admin->add("contenido",$paneleditar);
					$admin->show();
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>