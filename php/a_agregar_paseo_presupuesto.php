<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_POST);
	
	      if($paseo)
		  {
		  
		  		//echo "entra;";
		   
			  
			  //}
			  //else
			 // {
				mysql_query("INSERT INTO `pre_pas` VALUES (NULL ,  '$id',  '$paseo')") or die (mysql_error());
			    
				$hola='a_ver_paseos.php?id='.$id.'';
				header("Location:$hola");
			  
			  
			 // }
		  
		  }
	      else
		  {
			
			$admin= new Panel("../html/admin.html");
			$admin->add("body",'<body onLoad = "actual(12)" >');
			$panelcuentas = new Panel("../html/a_agregar_paseo_presupuesto.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/a_agregar_paseo_presupuesto.php">');
			$panelcuentas->add("id",$id);
	        
        	//echo "aja";
	
			
			if ($mensaje==1)
			 {
				 //7echo "entra;";
				 $select='';
	        	 $result= mysql_query("SELECT * FROM  paseo");
				 while($row = mysql_fetch_array($result))
        		{
					$select_actual='<option value="'.$row["pas_id"].'">'.$row["pas_nombre"].'</option>'; 		
					$select=$select.$select_actual;
				}
				$panelcuentas->add("paseos",$select);
			}
			else{
				//echo "entra2";
			if ($selected && $id)
				{
					//echo "si".$selected;
					//echo "id".$id;
					 $result= mysql_query("SELECT * FROM  paseo");
					while($row = mysql_fetch_array($result))
					{
					if ($row["pas_id"]==$selected)
					{
						$select_actual='<option selected="selected" value="'.$row["pas_id"].'">'.$row["pas_nombre"].'</option>'; 
						$cos=$row["pas_costo"];
					}	
					else
					{
					$select_actual='<option value="'.$row["pas_id"].'">'.$row["pas_nombre"].'</option>'; 		
					
					}
					$select=$select.$select_actual;
					}
					$panelcuentas->add("paseos",$select);
					
					$panelcuentas->add("costo",$cos);
				}
			}
			$panelcuentas->add("tipo_boton",'Agregar');
	        $admin->add("contenido",$panelcuentas);
	        $admin->show();
		  }
			
			
			
	include "../db/cerrar_conexion.php";
?>