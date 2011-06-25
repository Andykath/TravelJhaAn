<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_POST);
	
	      if($viaje)
		  {
		  
		  	//echo "aja";
				$imprimo=mysql_query("SELECT * from boleto where fk_via_id='$viaje'");
				$res=mysql_num_rows($imprimo);
				//No se si dejar esto para ver la cantidad de boletos que van a un viaje
				if ($res>0)
				{
					$hola='a_boleto_aereo.php?mensaje=4';
					header("Location:$hola");
				}
				else
				{			mysql_query("INSERT INTO `boleto` VALUES (NULL, CURDATE(), '$viaje', '$dueño', NULL);") or die (mysql_error());
			    
				
				$busca=mysql_query("Select * from acompanante where fk_via_id='$viaje' and fk_per_cedula='$dueño'");
				while ($row0=mysql_fetch_array($busca))
				{
					$aco=$row0["aco_id"];
					mysql_query("INSERT INTO `boleto` VALUES (NULL, CURDATE(), '$viaje', NULL, '$aco');") or die (mysql_error());
					
				}
				$hola='a_boleto_aereo.php';
				header("Location:$hola");
	
				}
		  }
	      else
		  {
			
			$admin= new Panel("../html/admin.html");
			$admin->add("body",'<body onLoad = "actual(12)" >');
			$panelcuentas = new Panel("../html/a_crear_boleto_aereo.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/a_crear_boleto_aereo.php">');
			$panelcuentas->add("id",$id);
	       			
			if ($mensaje==1)
			 {
				 $select2='';
	        	 $result2= mysql_query("SELECT * FROM  persona");
				 while($row2 = mysql_fetch_array($result2))
        		{
					$select_actual2='<option value="'.$row2["per_cedula"].'">'.$row2["per_apellido1"].','.$row2["per_nombre1"].'</option>'; 		
					$select2=$select2.$select_actual2;
				}
				$panelcuentas->add("dueños",$select2);
			}
			else{
				
				
			if ($dueño)
			{
				echo "entra";
				echo $dueño;
				$select2='';
	        	 	$result2= mysql_query("SELECT * FROM  persona");
				 	while($row2 = mysql_fetch_array($result2))
        			{
						if ($row2["per_cedula"]==$dueño)
						{
						$select_actual2='<option selected="selected" value="'.$row2["per_cedula"].'">'.$row2["per_apellido1"].','.$row2["per_nombre1"].'</option>';   			}
						else
						{
						$select_actual2='<option value="'.$row2["per_cedula"].'">'.$row2["per_apellido1"].','.$row2["per_nombre1"].'</option>'; 			}
						$select2=$select2.$select_actual2;
					}
					$panelcuentas->add("dueños",$select2);
					
					 $select='';
	        	 $result= mysql_query("SELECT v.* FROM  viaje v, via i, aerolinea a, persona p, presupuesto o where v.fk_via_id_destino=i.via_id and i.fk_aer_id=a.aer_id and v.fk_pre_id=o.pre_id and o.fk_per_cedula='$dueño' AND p.per_cedula = o.fk_per_cedula
");
				 while($row = mysql_fetch_array($result))
        		{
					$select_actual='<option value="'.$row["via_id"].'">'.$row["via_id"].'</option>'; 		
					$select=$select.$select_actual;
				}
				$panelcuentas->add("viajes",$select);
				
				
			}
			if ($selected && $dueño)
				{
					//echo "entra";
					//echo "si".$selected;
					//echo "dueño".$dueño;
				$result= mysql_query("SELECT v.* FROM  viaje v, via i, aerolinea a, persona p, presupuesto o where v.fk_via_id_destino=i.via_id and i.fk_aer_id=a.aer_id and v.fk_pre_id=o.pre_id and o.fk_per_cedula='$dueño' AND p.per_cedula = o.fk_per_cedula");
					while($row = mysql_fetch_array($result))
					{
					if ($row["via_id"]==$selected)
					{
						$select_actual='<option selected="selected" value="'.$row["via_id"].'">'.$row["via_id"].'</option>'; 
						$tipo=$row["via_tipoviaje"];
						$fecha=$row["via_fecha_ini"];
						$fecha2=$row["via_fecha_fin"];
						$cant=$row["via_cant_per"];
						$des=$row["fk_via_id_destino"];
						$ori=$row["fk_via_id_origen"];
						$query2=mysql_query("SELECT c.des_nombre as ciudad, p.des_nombre as pais from via v, destino c, destino p where v.via_id='$ori' and v.fk_des_id=c.des_id and c.fk_des_id=p.des_id");
						echo $ori;
						$row3=mysql_fetch_array($query2);
						$ciudad_o=$row3["ciudad"];
						$pais_o=$row3["pais"];
						
						$query=mysql_query("SELECT a.aer_nombre, c.des_nombre as ciudad, p.des_nombre as pais from via v, aerolinea a, destino c, destino p where v.via_id='$des' and a.aer_id=v.fk_aer_id and v.fk_des_id=c.des_id and c.fk_des_id=p.des_id");
						
						$row2=mysql_fetch_array($query);
						$aer=$row2["aer_nombre"];
						$ciudad=$row2["ciudad"];
						$pais=$row2["pais"];

					}	
					else
					{
					$select_actual='<option value="'.$row["via_id"].'">'.$row["via_id"].'</option>'; 		
					
					}
					$select=$select.$select_actual;
					}
					$panelcuentas->add("viajes",$select);
					$destino=$ciudad.", ".$pais;
					$origen=$ciudad_o.", ".$pais_o;
					$panelcuentas->add("tipo",$tipo);
					$panelcuentas->add("fecha",$fecha);
					$panelcuentas->add("fecha2",$fecha2);
					$panelcuentas->add("aer",$aer);
					$panelcuentas->add("destino",$destino);
					$panelcuentas->add("origen",$origen);
					$panelcuentas->add("cant",$cant);
					
					$select2='';
	        	 	$result2= mysql_query("SELECT * FROM  persona");
				 	while($row2 = mysql_fetch_array($result2))
        			{
						if ($row2["per_cedula"]==$dueño)
						{
						$select_actual2='<option selected="selected" value="'.$row2["per_cedula"].'">'.$row2["per_apellido1"].','.$row2["per_nombre1"].'</option>';   			}
						else
						{
						$select_actual2='<option value="'.$row2["per_cedula"].'">'.$row2["per_apellido1"].','.$row2["per_nombre1"].'</option>'; 			}
						$select2=$select2.$select_actual2;
					}
					$panelcuentas->add("dueños",$select2);
				}
			}
			$panelcuentas->add("tipo_boton",'Agregar');
	        $admin->add("contenido",$panelcuentas);
	        $admin->show();
		  }
			
			
			
	include "../db/cerrar_conexion.php";
?>