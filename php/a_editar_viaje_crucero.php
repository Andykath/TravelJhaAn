<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
   $cedula=$_SESSION['cedula'];
   
    //$total=$_SESSION[$total];
	extract($_POST);
	extract($_GET);
	      
		  if($fecha)
		  {
		  	//echo "id".$id;
	        //echo "pre_fecha".$fecha; echo "pre_cant_per".$cantper."fk_via_id_origen".$banco."fk_via_id_destino".$banco1."t-".$tipoviaje;
			$total2= (float) $total;
			 $res=mysql_query("SELECT fk_cru_id FROM  via where via_id=$banco");
			 $ro = mysql_fetch_array($res);
			 $devuelve=$ro['fk_cru_id'];		
			$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$banco");
			$ro1 = mysql_fetch_array($res1);
			$devuelve1=$ro1['fk_des_id'];	
			$result1= mysql_query("SELECT a.cru_nombre, a.cru_id FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL");
			$row=mysql_fetch_array($result1);
			$cru=$row["cru_id"];
			//echo "cru".$cru;
			$result2= mysql_query("SELECT flo_id from flota where fk_cru_id='$cru'");
			$row2=mysql_fetch_array($result2);
			$flota=$row2["flo_id"];
			mysql_query("UPDATE `viaje` SET  `via_fecha_ini`= '$fecha', `via_fecha_fin`= '$fecha2', `via_cant_per`='$cantper', `fk_via_id_origen`='$banco', `fk_via_id_destino`='$banco1', via_tipoviaje='$tipoviaje', fk_flo_id='$flota'  where via_id='$id'") or die (mysql_error());
				$hola='a_viaje_crucero.php?mensaje=2';
				header("Location:$hola");
		  }
	      else
		  {
			
			$admin= new Panel("../html/admin.html");
			$admin->add("body",'<body onLoad = "actual(13)" >');
			$panelcuentas = new Panel("../html/a_editar_viaje_crucero.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/a_editar_viaje_crucero.php?">');
			 $panelcuentas->add("Aqui",'<a href="../php/a_viaje_crucero.php">Volver<<</a>');
			$panelcuentas->add("fecha",$fecha_ini);
			$panelcuentas->add("id",$id);
			$panelcuentas->add("fecha2",$fecha_fin);
			
			 if ($mensaje==1)
			 {
			echo "mensaje1";
	        $select='';
	        $result= mysql_query("SELECT v.*, a.cru_nombre, d.des_nombre FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id IS NOT NULL AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL");
        	while($row = mysql_fetch_array($result))
        	{
				if ($row["via_id"]==$via)
				{
					$select_actual='<option selected="selected" value="'.$row["via_id"].'">'.$row["cru_nombre"]."/".$row["des_nombre"].'</option>'; 	
				}
				else
				{
					$select_actual='<option value="'.$row["via_id"].'">'.$row["cru_nombre"]."/".$row["des_nombre"].'</option>'; 
				}		
			$select=$select.$select_actual;
			}
			$panelcuentas->add("bancos",$select);
			
			$res=mysql_query("SELECT fk_cru_id FROM  via where via_id=$via");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_cru_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$via");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];		
					    
			$result1= mysql_query("SELECT v.*, a.cru_nombre, d.des_nombre FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL") or die (mysql_error());
						while($row1 = mysql_fetch_array($result1))
						{
							if ($row1["via_id"]==$destino)
							{
							$select_actual1='<option selected="selected" value="'.$row1["via_id"].'">'.$row1["cru_nombre"]."/".$row1["des_nombre"].'</option>'; 
							}
							else
							{
								
							$select_actual1='<option value="'.$row1["via_id"].'">'.$row1["cru_nombre"]."/".$row1["des_nombre"].'</option>'; 	
							}
						$select1=$select1.$select_actual1;
						}
						$panelcuentas->add("bancos1",$select1);
						
						$select0='';
				 	for($i = 1; $i <= 10; $i++)
				 	{
					 if ($i==$cant)
					 {
						 $select_actual0='<option selected="selected" value="'.$i.'">'.$i.'</option>';
					 }
					 else
					 {
						 $select_actual0='<option value="'.$i.'">'.$i.'</option>';
					 }
					 	$select0=$select0.$select_actual0;
				  }
				  $panelcuentas->add("personas",$select0);
						
						
			 }
			 else
			 {
			
			if ($fechai && $fecha2 && ($selected=="a") && ($selected2=="k") && $id)
			{
				$panelcuentas->add("id",$id);
				$panelcuentas->add("fecha",$fechai);
				$panelcuentas->add("fecha2",$fecha2);
				echo "id".$id;
				echo "entra aqui";
				$result2= mysql_query("SELECT v.*, a.cru_nombre, d.des_nombre FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id IS NOT NULL AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL");
				while($row2 = mysql_fetch_array($result2))
				{				
					$select_actual2='<option value="'.$row2["via_id"].'">'.$row2["cru_nombre"]."/".$row2["des_nombre"].'</option>'; 																	                 }
				$select2=$select2.$select_actual2;
				$panelcuentas->add("bancos",$select2);
				
			  }
	
			  if ($selected && $fechai && $fecha2 && ($selected2!="k") && $id)
			  {
			   echo 'entra2' ;
			   $panelcuentas->add("id",$id);
			   $panelcuentas->add("fecha",$fechai);
				$panelcuentas->add("fecha2",$fecha2);
			   echo "id".$id;

			$select='';
	        $result= mysql_query("SELECT v.*, a.cru_nombre, d.des_nombre FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id IS NOT NULL AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL");
        	while($row = mysql_fetch_array($result))
        	{
				if ($row["via_id"]==$selected)
				{
					$select_actual='<option selected="selected" value="'.$row["via_id"].'">'.$row["cru_nombre"]."/".$row["des_nombre"].'</option>'; 	
				}
				else
				{
					$select_actual='<option value="'.$row["via_id"].'">'.$row["cru_nombre"]."/".$row["des_nombre"].'</option>'; 
				}		
			$select=$select.$select_actual;
			}
			$panelcuentas->add("bancos",$select);
			
			$res=mysql_query("SELECT fk_cru_id FROM  via where via_id=$selected");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_cru_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];		
					    
			$result1= mysql_query("SELECT v.*, a.cru_nombre, d.des_nombre FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL") or die (mysql_error());
						while($row1 = mysql_fetch_array($result1))
						{
							if ($row1["via_id"]==$selected2)
							{
							$select_actual1='<option selected="selected" value="'.$row1["via_id"].'">'.$row1["cru_nombre"]."/".$row1["des_nombre"].'</option>'; 
							}
							else
							{
								
							$select_actual1='<option value="'.$row1["via_id"].'">'.$row1["cru_nombre"]."/".$row1["des_nombre"].'</option>'; 	
							}
						$select1=$select1.$select_actual1;
						}
						$panelcuentas->add("bancos1",$select1);
						
						$select0='';
				 	for($i = 1; $i <= 10; $i++)
				 	{
					 if ($i==$cantper)
					 {
						 $select_actual0='<option selected="selected" value="'.$i.'">'.$i.'</option>';
					 }
					 else
					 {
						 $select_actual0='<option value="'.$i.'">'.$i.'</option>';
					 }
					 	$select0=$select0.$select_actual0;
				  }
				  $panelcuentas->add("personas",$select0);
			  
			  }
	
	// 	selected=2&fechai=2011-12-19&fecha22011-12-21&selected2=k&id=4
			  if ($selected && $fechai && $fecha2 && ($selected2=="k") && $id )
			  {
			   echo('entra3');
			   $panelcuentas->add("id",$id);
			   $panelcuentas->add("fecha",$fechai);
				$panelcuentas->add("fecha2",$fecha2);
			  // echo "id".$id;
				echo "fecha".$fechai;
				$select='';
	        $result= mysql_query("SELECT v.*, a.cru_nombre, d.des_nombre FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id IS NOT NULL AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL");
        	while($row = mysql_fetch_array($result))
        	{
				if ($row["via_id"]==$selected)
				{
					$select_actual='<option selected="selected" value="'.$row["via_id"].'">'.$row["cru_nombre"]."/".$row["des_nombre"].'</option>'; 	
				}
				else
				{
					$select_actual='<option value="'.$row["via_id"].'">'.$row["cru_nombre"]."/".$row["des_nombre"].'</option>'; 
				}		
			$select=$select.$select_actual;
			}
			$panelcuentas->add("bancos",$select);
			
			$res=mysql_query("SELECT fk_cru_id FROM  via where via_id=$selected");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_cru_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];		
					    
			$result1= mysql_query("SELECT v.*, a.cru_nombre, d.des_nombre FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL") or die (mysql_error());
						while($row1 = mysql_fetch_array($result1))
						{
							if ($row1["via_id"]==$selected2)
							{
							$select_actual1='<option selected="selected" value="'.$row1["via_id"].'">'.$row1["cru_nombre"]."/".$row1["des_nombre"].'</option>'; 
							}
							else
							{
								
							$select_actual1='<option value="'.$row1["via_id"].'">'.$row1["cru_nombre"]."/".$row1["des_nombre"].'</option>'; 	
							}
						$select1=$select1.$select_actual1;
						}
						$panelcuentas->add("bancos1",$select1);
						
						$select0='';
				 	for($i = 1; $i <= 10; $i++)
				 	{
					 if ($i==$cantper)
					 {
						 $select_actual0='<option selected="selected" value="'.$i.'">'.$i.'</option>';
					 }
					 else
					 {
						 $select_actual0='<option value="'.$i.'">'.$i.'</option>';
					 }
					 	$select0=$select0.$select_actual0;
				  }
				  $panelcuentas->add("personas",$select0);
			  
			  }
			  //selected=18&fechai=2011-06-20&selected2=1&fecha2=2011-06-22&id=8
			 // echo $selected.$fechai.$selected2.$selected3.$selected4.$selected5.$cantper."tipo de viaje: ".$tipoviaje." ".$id;
			   if ($selected && $fechai && $fecha2 && ($selected2!="k") && $cantper && $tipoviaje && $id)
			  {
			          echo('entra6');
			  			$panelcuentas->add("id",$id);
						 $panelcuentas->add("fecha",$fechai);
						$panelcuentas->add("fecha2",$fecha2);
			   			//echo "id".$id;
$select='';
	        $result= mysql_query("SELECT v.*, a.cru_nombre, d.des_nombre FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id IS NOT NULL AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL");
        	while($row = mysql_fetch_array($result))
        	{
				if ($row["via_id"]==$selected)
				{
					$select_actual='<option selected="selected" value="'.$row["via_id"].'">'.$row["cru_nombre"]."/".$row["des_nombre"].'</option>'; 	
				}
				else
				{
					$select_actual='<option value="'.$row["via_id"].'">'.$row["cru_nombre"]."/".$row["des_nombre"].'</option>'; 
				}		
			$select=$select.$select_actual;
			}
			$panelcuentas->add("bancos",$select);
			
			$res=mysql_query("SELECT fk_cru_id FROM  via where via_id=$selected");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_cru_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];		
					    
			$result1= mysql_query("SELECT v.*, a.cru_nombre, d.des_nombre FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL") or die (mysql_error());
						while($row1 = mysql_fetch_array($result1))
						{
							if ($row1["via_id"]==$selected2)
							{
							$select_actual1='<option selected="selected" value="'.$row1["via_id"].'">'.$row1["cru_nombre"]."/".$row1["des_nombre"].'</option>'; 
							}
							else
							{
								
							$select_actual1='<option value="'.$row1["via_id"].'">'.$row1["cru_nombre"]."/".$row1["des_nombre"].'</option>'; 	
							}
						$select1=$select1.$select_actual1;
						}
						$panelcuentas->add("bancos1",$select1);
						
						$select0='';
				 	for($i = 1; $i <= 10; $i++)
				 	{
					 if ($i==$cantper)
					 {
						 $select_actual0='<option selected="selected" value="'.$i.'">'.$i.'</option>';
					 }
					 else
					 {
						 $select_actual0='<option value="'.$i.'">'.$i.'</option>';
					 }
					 	$select0=$select0.$select_actual0;
				  }
				  $panelcuentas->add("personas",$select0);
						
						
			  }
	  
			  
			 }
			  
			$panelcuentas->add("tipo_boton",'Aceptar');
	        $admin->add("contenido",$panelcuentas);
	        $admin->show();
			
			
		   }
			
		  
	include "../db/cerrar_conexion.php";
?>