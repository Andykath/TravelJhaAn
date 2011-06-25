<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	extract($_POST);
	
	      if($viaje)
		  {
			  //echo "sale";
				if (strlen($dueño>10))
				{
					mysql_query("UPDATE`viajesucab`.`boleto`SET bol_fecha_emi=CURDATE(), fk_via_id='$viaje', fk_per_cedula='$dueño', fk_aco_id=NULL  WHERE `boleto`.`bol_id`='$id'") or die (mysql_error());
			    
				$hola='a_boleto_terrestre.php';
				header("Location:$hola");
				}
				else
		 		{
				mysql_query("UPDATE`viajesucab`.`boleto`SET bol_fecha_emi=CURDATE(), fk_via_id='$viaje', fk_per_cedula=NULL, fk_aco_id='$dueño' WHERE `boleto`.`bol_id`='$id'") or die (mysql_error());
			    
				mysql_query("UPDATE`viajesucab`.`acompanante`SET`fk_via_id`='$viaje' WHERE`acompanante`.`aco_id`='$dueño'"); 
				
				$hola='a_boleto_terrestre.php';
				header("Location:$hola");
				
				
				}
		  }
	      else
		  {			
			$admin= new Panel("../html/admin.html");
			$admin->add("body",'<body onLoad = "actual(12)" >');
			$panelcuentas = new Panel("../html/a_editar_boleto_terrestre.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/a_editar_boleto_terrestre.php">');
			$panelcuentas->add("id",$id);
			$panelcuentas->add("aqui",'<a href="../php/a_boleto_terrestre.php">Volver<<</a>');
	       		
			if ($mensaje==1)
			 {
				 //echo "entra;";
				
				 if ($cliente==''){
				 $persona=$aco;
				echo "aco".$persona;
				
				$select='';
	        	 $result= mysql_query("SELECT v. * FROM viaje v, via i, terrestre a, persona p, presupuesto o, acompanante m
WHERE v.fk_via_id_destino = i.via_id AND i.fk_ter_id = a.ter_id AND v.fk_pre_id = o.pre_id AND o.fk_per_cedula=m.fk_per_cedula AND p.per_cedula = o.fk_per_cedula AND m.fk_per_cedula = p.per_cedula");
				 while($row = mysql_fetch_array($result))
        		{
					if ($row["via_id"]==$via)
					{
					$select_actual='<option selected="selected" value="'.$row["via_id"].'">'.$row["via_id"].'</option>';
					$tipo=$row["via_tipoviaje"];
						$fecha=$row["via_fecha_ini"];
						$fecha2=$row["via_fecha_fin"];
						$cant=$row["via_cant_per"];
						$des=$row["fk_via_id_destino"];
						$ori=$row["fk_via_id_origen"];
						$query2=mysql_query("SELECT c.des_nombre as ciudad, p.des_nombre as pais from via v, destino c, destino p where v.via_id='$ori' and v.fk_des_id=c.des_id and c.fk_des_id=p.des_id");
						//echo $ori;
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
					
				 }
				 else{
				 $persona=$cliente;
				echo "cliente".$persona;
				 $select='';
	        	 $result= mysql_query("SELECT v.* FROM  viaje v, via i, terrestre a, persona p, presupuesto o where v.fk_via_id_destino=i.via_id and i.fk_ter_id=a.ter_id and v.fk_pre_id=o.pre_id and o.fk_per_cedula='$persona' AND p.per_cedula = o.fk_per_cedula");
				 while($row = mysql_fetch_array($result))
        		{
					if ($row["via_id"]==$via)
					{
					$select_actual='<option selected="selected" value="'.$row["via_id"].'">'.$row["via_id"].'</option>';
					$tipo=$row["via_tipoviaje"];
						$fecha=$row["via_fecha_ini"];
						$fecha2=$row["via_fecha_fin"];
						$cant=$row["via_cant_per"];
						$des=$row["fk_via_id_destino"];
						$ori=$row["fk_via_id_origen"];
						$query2=mysql_query("SELECT c.des_nombre as ciudad, p.des_nombre as pais from via v, destino c, destino p where v.via_id='$ori' and v.fk_des_id=c.des_id and c.fk_des_id=p.des_id");
						//echo $ori;
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
				 
				 }
				 
				 $select2='';
	        	 $result2= mysql_query("SELECT * FROM  persona");
				 while($row2 = mysql_fetch_array($result2))
        		{
					if ($row2["per_cedula"]==$persona)
					{
					$select_actual2='<option selected="selected" value="'.$row2["per_cedula"].'">'.$row2["per_apellido1"].','.$row2["per_nombre1"].'</option>'; 
					
					
					
					}
					else
					{
						$select_actual2='<option value="'.$row2["per_cedula"].'">'.$row2["per_apellido1"].','.$row2["per_nombre1"].'</option>'; 
					}
					$select2=$select2.$select_actual2;
				}
				 $result3= mysql_query("SELECT * FROM  acompanante");
				 while($row3 = mysql_fetch_array($result3))
        		{
					if ($row3["aco_id"]==$persona)
					{
					$select_actual2='<option selected="selected" value="'.$row3["aco_id"].'">'.$row3["aco_apellido"].','.$row3["aco_nombre"].'</option>'; 		
					}
					else
					{
						$select_actual2='<option value="'.$row3["aco_id"].'">'.$row3["aco_apellido"].','.$row3["aco_nombre"].'</option>'; 	
					}
					$select2=$select2.$select_actual2;
				}
				$panelcuentas->add("dueños",$select2);
				}
			
			else{
				
				if ($dueño)
			{	$panelcuentas->add("id",$id);
				echo "entra";
				echo $dueño;
				if (strlen($dueño>10))
				{
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
				
					$result3= mysql_query("SELECT * FROM  acompanante");
				 while($row3 = mysql_fetch_array($result3))
        		{
					if ($row3["aco_id"]==$dueño)
					{
					$select_actual2='<option selected="selected" value="'.$row3["aco_id"].'">'.$row3["aco_apellido"].','.$row3["aco_nombre"].'</option>'; 		
					}
					else
					{
						$select_actual2='<option value="'.$row3["aco_id"].'">'.$row3["aco_apellido"].','.$row3["aco_nombre"].'</option>'; 	
					}
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
				else
				{
					//echo "entra aui";
					$result3= mysql_query("SELECT * FROM  acompanante") or die (mysql_error());
					$select2='';
				 while($row3 = mysql_fetch_array($result3))
        		{
					if ($row3["aco_id"]==$dueño)
					{
					$select_actual2='<option selected="selected" value="'.$row3["aco_id"].'">'.$row3["aco_apellido"].','.$row3["aco_nombre"].'</option>'; 		
					}
					else
					{
						$select_actual2='<option value="'.$row3["aco_id"].'">'.$row3["aco_apellido"].','.$row3["aco_nombre"].'</option>'; 	
					}
					$select2=$select2.$select_actual2;
				}
				
				
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
	        	 $result= mysql_query("SELECT v. * FROM viaje v, via i, terrestre a, persona p, presupuesto o, acompanante m
WHERE v.fk_via_id_destino = i.via_id AND i.fk_ter_id = a.ter_id AND v.fk_pre_id = o.pre_id AND o.fk_per_cedula=m.fk_per_cedula AND p.per_cedula = o.fk_per_cedula AND m.fk_per_cedula = p.per_cedula");
					 while($row = mysql_fetch_array($result))
        		{
					$select_actual='<option value="'.$row["via_id"].'">'.$row["via_id"].'</option>'; 		
					$select=$select.$select_actual;
				}
				$panelcuentas->add("viajes",$select);
				
				}
				
			}
				
			if ($selected && $dueño && $id)
				{
					
			
				$panelcuentas->add("aqui",'<a href="../php/a_boleto_terrestre.php">Volver<<</a>');
				$panelcuentas->add("id",$id);
				echo "entra aqui";
				//echo $dueño;
				if (strlen($dueño>10))
				{
					echo "cli";
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
					//$panelcuentas->add("dueños",$select2);
				
					$result3= mysql_query("SELECT * FROM  acompanante");
				 while($row3 = mysql_fetch_array($result3))
        		{
					if ($row3["aco_id"]==$dueño)
					{
					$select_actual2='<option selected="selected" value="'.$row3["aco_id"].'">'.$row3["aco_apellido"].','.$row3["aco_nombre"].'</option>'; 		
					}
					else
					{
						$select_actual2='<option value="'.$row3["aco_id"].'">'.$row3["aco_apellido"].','.$row3["aco_nombre"].'</option>'; 	
					}
					$select2=$select2.$select_actual2;
				}
				$panelcuentas->add("dueños",$select2);
				
					 $select='';
	        	 $result= mysql_query("SELECT v.* FROM  viaje v, via i, terrestre a, persona p, presupuesto o where v.fk_via_id_destino=i.via_id and i.fk_ter_id=a.ter_id and v.fk_pre_id=o.pre_id and o.fk_per_cedula='$dueño' AND p.per_cedula = o.fk_per_cedula");
			 while($row3 = mysql_fetch_array($result)){
				if ($row3["via_id"]==$selected)
					{
						echo "via";
						$select_actual='<option selected="selected" value="'.$row3["via_id"].'">'.$row3["via_id"].'</option>'; 
						$tipo=$row3["via_tipoviaje"];
						$fecha=$row3["via_fecha_ini"];
						$fecha2=$row3["via_fecha_fin"];
						$cant=$row3["via_cant_per"];
						$des=$row3["fk_via_id_destino"];
						$ori=$row3["fk_via_id_origen"];
						$query2=mysql_query("SELECT c.des_nombre as ciudad, p.des_nombre as pais from via v, destino c, destino p where v.via_id='$ori' and v.fk_des_id=c.des_id and c.fk_des_id=p.des_id");
						//echo $ori;
						$row4=mysql_fetch_array($query2);
						$ciudad_o=$row4["ciudad"];
						$pais_o=$row4["pais"];
						
						$query=mysql_query("SELECT a.ter_nombre, c.des_nombre as ciudad, p.des_nombre as pais from via v, terrestre a, destino c, destino p where v.via_id='$des' and a.ter_id=v.fk_ter_id and v.fk_des_id=c.des_id and c.fk_des_id=p.des_id");
						
						$row2=mysql_fetch_array($query);
						$aer=$row2["ter_nombre"];
						$ciudad=$row2["ciudad"];
						$pais=$row2["pais"];
					}
				
					else
					{
					$select_actual='<option value="'.$row3["via_id"].'">'.$row3["via_id"].'</option>'; 		
					
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
				}
				else //acompañante
				{
					echo "entra aui";
					$result3= mysql_query("SELECT * FROM  acompanante") or die (mysql_error());
					$select2='';
				 while($row3 = mysql_fetch_array($result3))
        		{
					if ($row3["aco_id"]==$dueño)
					{
					$select_actual2='<option selected="selected" value="'.$row3["aco_id"].'">'.$row3["aco_apellido"].','.$row3["aco_nombre"].'</option>'; 		
					}
					else
					{
						$select_actual2='<option value="'.$row3["aco_id"].'">'.$row3["aco_apellido"].','.$row3["aco_nombre"].'</option>'; 	
					}
					$select2=$select2.$select_actual2;
				}
				
				
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
	        	 $result= mysql_query("SELECT v. * FROM viaje v, via i, terrestre a, persona p, presupuesto o, acompanante m
WHERE v.fk_via_id_destino = i.via_id AND i.fk_ter_id = a.ter_id AND v.fk_pre_id = o.pre_id AND o.fk_per_cedula=m.fk_per_cedula AND p.per_cedula = o.fk_per_cedula AND m.fk_per_cedula = p.per_cedula");
					while($row3 = mysql_fetch_array($result)){
						//echo $row["via_id"];
					if ($row3["via_id"]==$selected)
					{
						$select_actual='<option selected="selected" value="'.$row3["via_id"].'">'.$row3["via_id"].'</option>'; 
						$tipo=$row3["via_tipoviaje"];
						$fecha=$row3["via_fecha_ini"];
						$fecha2=$row3["via_fecha_fin"];
						$cant=$row3["via_cant_per"];
						$des=$row3["fk_via_id_destino"];
						$ori=$row3["fk_via_id_origen"];
						$query2=mysql_query("SELECT c.des_nombre as ciudad, p.des_nombre as pais from via v, destino c, destino p where v.via_id='$ori' and v.fk_des_id=c.des_id and c.fk_des_id=p.des_id");
						//echo $ori;
						$row4=mysql_fetch_array($query2);
						$ciudad_o=$row4["ciudad"];
						$pais_o=$row4["pais"];
						
						$query=mysql_query("SELECT a.ter_nombre, c.des_nombre as ciudad, p.des_nombre as pais from via v, terrestre a, destino c, destino p where v.via_id='$des' and a.ter_id=v.fk_ter_id and v.fk_des_id=c.des_id and c.fk_des_id=p.des_id");
						
						$row2=mysql_fetch_array($query);
						$aer=$row2["ter_nombre"];
						$ciudad=$row2["ciudad"];
						$pais=$row2["pais"];
					}

					else
					{
					$select_actual='<option value="'.$row3["via_id"].'">'.$row3["via_id"].'</option>'; 		
					
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
					//echo "entra";
					//echo "si".$selected;
					//echo "dueño".$dueño;
			
					}
				}
			}
			$panelcuentas->add("tipo_boton",'Aceptar');
	        $admin->add("contenido",$panelcuentas);
	        $admin->show();
		  
		
			
		  }
	include "../db/cerrar_conexion.php";
?>