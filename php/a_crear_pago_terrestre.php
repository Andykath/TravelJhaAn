<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_POST);
	
	      if($viaje)
		  {
		  if ($forma_pago==1)
			{
				//echo "1";
			if ($pago2=='deposito')
			{
				//echo "dep";
				$query=mysql_query("SELECT * from deposito where dep_numero ='$numero'");
				$numero=mysql_num_rows($query);
				if( $numero==0)
				{
					//echo " no consegu+ido";
					$hola='a_pagos_aereo.php?mensaje=4';
					header("Location:$hola");
				}
				else{
				$row=mysql_fetch_array($query);	
				$dep_id=$row["dep_id"];
				mysql_query("INSERT INTO `pago` VALUES (NULL, '$monto', CURDATE(), '$viaje');") or die (mysql_error());
				$hola='a_pagos_aereo.php?mensaje=2';
				header("Location:$hola");}
				
			}
			if ($pago2=='tarjeta')
			{
				echo "tar";
			$query=mysql_query("SELECT * from tarjeta where tar_num='$numero'");
				$numero=mysql_num_rows($query);
				if( $numero==0)
				{
					//echo " no consegu+ido";
					$hola='a_pagos_aereo.php?mensaje=4';
					header("Location:$hola");
				}
				else{
				$row=mysql_fetch_array($query);	
				$dep_id=$row["dep_id"];
				mysql_query("INSERT INTO `pago` VALUES (NULL, '$monto2', CURDATE(), '$viaje');") or die (mysql_error());
				$hola='a_pagos_aereo.php?mensaje=2';
				header("Location:$hola");}
			}
			else if ($pago2=='cheque')
			{	
				$query=mysql_query("SELECT * from cheque where che_num='$numero'");
				$numero=mysql_num_rows($query);
				if( $numero==0)
				{
					//echo " no consegu+ido";
					$hola='a_pagos_aereo.php?mensaje=4';
					header("Location:$hola");
				}
				else{
				$row=mysql_fetch_array($query);	
				$dep_id=$row["dep_id"];
				mysql_query("INSERT INTO `pago` VALUES (NULL, '$monto2', CURDATE(), '$viaje');") or die (mysql_error());
				$hola='a_pagos_aereo.php?mensaje=2';
				header("Location:$hola");}
			}
			}
			else if ($forma_pago==2)
			{
				if ($pago=='deposito')
				{
				//echo "dep";
				$query=mysql_query("SELECT * from deposito where dep_numero ='$numero'");
				$numero=mysql_num_rows($query);
				if( $numero==0)
				{
					//echo " no consegu+ido";
					$hola='a_pagos_aereo.php?mensaje=4';
					header("Location:$hola");
				}
				else{
				$row=mysql_fetch_array($query);	
				$dep_id=$row["dep_id"];
				mysql_query("INSERT INTO `pago` VALUES (NULL, '$monto', CURDATE(), '$viaje');") or die (mysql_error());
				$hola='a_pagos_aereo.php?mensaje=2';
				header("Location:$hola");}
				
				}
				if ($pago2=='tarjeta')
				{
					$query=mysql_query("SELECT * from tarjeta where tar_num='$numero'");
				$numero=mysql_num_fields($query);
				if( $numero==0)
				{
					//echo " no consegu+ido";
					$hola='a_pagos_aereo.php?mensaje=4';
					header("Location:$hola");
				}
				else{
				$row=mysql_fetch_array($query);	
				$dep_id=$row["dep_id"];
				mysql_query("INSERT INTO `pago` VALUES (NULL, '$monto2', CURDATE(), '$viaje');") or die (mysql_error());
				$hola='a_pagos_aereo.php?mensaje=2';
				header("Location:$hola");}
				}
			
			else
			{
				$query=mysql_query("SELECT * from cheque where che_num='$numero'");
				$numero=mysql_num_fields($query);
				if( $numero==0)
				{
					//echo " no consegu+ido";
					$hola='a_pagos_aereo.php?mensaje=4';
					header("Location:$hola");
				}
				else{
				$row=mysql_fetch_array($query);	
				$dep_id=$row["dep_id"];
				mysql_query("INSERT INTO `pago` VALUES (NULL, '$monto2', CURDATE(), '$viaje');") or die (mysql_error());
				$hola='a_pagos_aereo.php?mensaje=2';
				header("Location:$hola");
				}
				
			}
			}
			else
			{
				$query=mysql_query("SELECT * from deposito where dep_numero ='$numero'");
				$numero=mysql_num_rows($query);
				if( $numero==0)
				{
					//echo " no consegu+ido";
					$hola='a_pagos_aereo.php?mensaje=4';
					header("Location:$hola");
				}
				else{
				$row=mysql_fetch_array($query);	
				$dep_id=$row["dep_id"];
				mysql_query("INSERT INTO `pago` VALUES (NULL, '$monto', CURDATE(), '$viaje');") or die (mysql_error());
				}
				$query=mysql_query("SELECT * from tarjeta where tar_num='$numero'");
				$numero=mysql_num_fields($query);
				if( $numero==0)
				{
					//echo " no consegu+ido";
					$hola='a_pagos_aereo.php?mensaje=5';
					header("Location:$hola");
				}
				else{
				$row=mysql_fetch_array($query);	
				$dep_id=$row["dep_id"];
				mysql_query("INSERT INTO `pago` VALUES (NULL, '$monto2', CURDATE(), '$viaje');") or die (mysql_error());}
				
				$query=mysql_query("SELECT * from cheque where che_num='$numero'");
				$numero=mysql_num_fields($query);
				if( $numero==0)
				{
					//echo " no consegu+ido";
					$hola='a_pagos_aereo.php?mensaje=6';
					header("Location:$hola");
				}
				else{
				$row=mysql_fetch_array($query);	
				$dep_id=$row["dep_id"];
				mysql_query("INSERT INTO `pago` VALUES (NULL, '$monto3', CURDATE(), '$viaje');") or die (mysql_error());
				$hola='a_pagos_aereo.php?mensaje=2';
				header("Location:$hola");}
			}
		  }
	      else
		  {
			
			$admin= new Panel("../html/admin.html");
			$admin->add("body",'<body onLoad = "actual(12)" >');
			$panelcuentas = new Panel("../html/a_crear_boleto_terrestre.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/a_crear_boleto_terrestre.php">');
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
	        	 $result= mysql_query("SELECT v.* FROM  viaje v, via i, terrestre a, persona p, presupuesto o where v.fk_via_id_destino=i.via_id and i.fk_ter_id=a.ter_id and v.fk_pre_id=o.pre_id and o.fk_per_cedula='$dueño' AND p.per_cedula = o.fk_per_cedula
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
				$result= mysql_query("SELECT v.* FROM  viaje v, via i, terrestre a, persona p, presupuesto o where v.fk_via_id_destino=i.via_id and i.fk_ter_id=a.ter_id and v.fk_pre_id=o.pre_id and o.fk_per_cedula='$dueño' AND p.per_cedula = o.fk_per_cedula");
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
						
						$query=mysql_query("SELECT a.ter_nombre, c.des_nombre as ciudad, p.des_nombre as pais from via v, terrestre a, destino c, destino p where v.via_id='$des' and a.ter_id=v.fk_ter_id and v.fk_des_id=c.des_id and c.fk_des_id=p.des_id");
						
						$row2=mysql_fetch_array($query);
						$aer=$row2["ter_nombre"];
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