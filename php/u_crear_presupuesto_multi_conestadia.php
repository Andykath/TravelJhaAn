<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
		
	
	
	$cedula=$_SESSION['cedula'];
	
	// echo($global);
	extract($_POST);
	extract($_GET);
   // print_r($_POST);
	      
		  if($combotra)
		  {
			   $aqui=$_GET['mivariable'];
			  
			  
	                          $res3=mysql_query("SELECT c.cos_costo FROM  costo c WHERE c.fk_via_origen=$combotra AND c.fk_via_destino=$combotra1");
								$ro3 = mysql_fetch_array($res3);
								$devuelve3=$ro3['cos_costo'];	
								//secho($devuelve3);	
								//echo($cant1);
								$devuelvetodo=$devuelve3*$cant1;
							 
							 
							 
							 
							  mysql_query("INSERT INTO `presupuesto` (`pre_id`, `pre_fecha`,`pre_habitacion`,`pre_servicio`,`pre_paseo`,`pre_total`,`pre_cant_per`,`fk_per_cedula`, `fk_via_id_origen`, `fk_via_id_destino`,`pre_abono`,`pre_status`) VALUES (NULL ,'$fecha',null,null,'$mivariable1', '$devuelvetodo','$cant1', '$cedula','$combotra', '$combotra1',0,'No comprado')");
	
	
	                           
							
								 
							
									 
			
				               $res3=mysql_query("SELECT via_costo FROM  via where via_id=$combotra1");
								$ro3 = mysql_fetch_array($res3);
								$devuelve3=$ro3['via_costo'];	
								//secho($devuelve3);	
								//echo($cant1);
								$devuelvetodo=$devuelve3*$cant1;
								
							
				                
				
								   
				
							
								
			    
				$hola='u_presupuesto_multi_conestadia.php?pregunta='.$pregunta.'&mensaje=1';
				header("Location:$hola");			
			
			
			
        
			 
			  
			  
		  
		  
		  
		  
		  
	  
		  
		  
		  }
	      else
		  {
			
			$admin= new Panel("../html/usuario.html");
			$admin->add("body",'<body onLoad = "actual(3)" >');
			$panelcuentas = new Panel("../html/u_crear_presupuesto_multi_conestadia.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/u_crear_presupuesto_multi_conestadia.php?&combotra='.$selected2.'&combotra1='.$selected3.'&cant1='.$selected4.'&fecha='.$fechai.'&mivariable1='.$_GET['mivariable'].'">'); //mnio variable ? pero no se ponla con get okis pero sirvio? r// no porque cuando la mande mi variable es nada:S le puse nombre1
	
	       //echo($_GET['mivariable']);
		   	   //$panelcuentas->add("nombre1",$_GET['mivariable']);     
			
      $panelcuentas->add("combo",'<tr><td>*Tipo de Transporte:</td><td><select name="combo" id="combo" onChange="populate(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.nombre1.value)"><option selected="selected">Seleccione</option><option>Aereo</option><option>Maritimo</option><option>Terrestre</option></select></td></tr>');
			
			  
			  
			  if ($selected && $fechai)
			  {
				  //echo ("entra");
				  
				  if ($selected=='Aereo')
				  {
					   $panelcuentas->add("fecha",$fechai);
						
					   
				       if ("Aereo"==$selected)
							{
									
										$select_actual2='<option selected="selected">Aereo</option><option>Maritimo</option><option>Terrestre</option>'; }	
						     
							 else if ("Maritimo"==$selected){
								 $select_actual2='<option selected="selected">Maritimo</option><option>Aereo</option><option>Terrestre</option>'; }	
								 if ("Terrestre"==$selected)
								 {
									 $select_actual2='<option selected="selected">Terrestre</option><option>Aereo</option><option>Maritimo</option>';
									 }
								 
								 
		                      $select2=$select2.$select_actual2;
						    $panelcuentas->add("combo",' <tr><td>Tipo de Transporte:</td><td><select name="combo" id="combo" onChange="populate(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.nombre1.value)"><option selected="selected">Seleccione</option>'.$select2.'</select></td></tr>');
							$panelcuentas->add("nombre1",$_GET['mivariable']);     
							
							$select='<option>Seleccione</option>';
							 
	        $result= mysql_query("SELECT v.*, a.aer_nombre, d.des_nombre FROM  via v, aerolinea a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_aer_id=a.aer_id AND v.fk_aer_id IS NOT NULL AND v.fk_cru_id IS NULL AND v.fk_ter_id IS NULL");
			
        	while($row = mysql_fetch_array($result))
        	{
			$select_actual='<option value="'.$row["via_id"].'">'.$row["aer_nombre"]."/".$row["des_nombre"].'</option>'; 		
			$select=$select.$select_actual;
			}
			
			$panelcuentas->add("combotra",' <tr><td>Aerolinea/Origen:</td><td><select name="combotra" id="combotra" onChange="populate2(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.nombre1.value)">'.$select.'</td></tr>');
			
			
				  
				  }
				  else  if ($selected=='Maritimo')
				  {
					   $panelcuentas->add("fecha",$fechai);
						
					   
				       if ("Aereo"==$selected)
							{
									
										$select_actual2='<option selected="selected">Aereo</option><option>Maritimo</option><option>Terrestre</option>'; }	
						     
							 else if ("Maritimo"==$selected){
								 $select_actual2='<option selected="selected">Maritimo</option><option>Aereo</option><option>Terrestre</option>'; }	
								 if ("Terrestre"==$selected)
								 {
									 $select_actual2='<option selected="selected">Terrestre</option><option>Aereo</option><option>Maritimo</option>';
									 }
								 
								 
		                      $select2=$select2.$select_actual2;
						    $panelcuentas->add("combo",' <tr><td>Tipo de Transporte:</td><td><select name="combo" id="combo" onChange="populate(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.nombre1.value)" ><option selected="selected">Seleccione</option>'.$select2.'</select></td></tr>');
							$panelcuentas->add("nombre1",$_GET['mivariable']); 
							
							$select='<option>Seleccione</option>';
							 
	        $result= mysql_query("SELECT v.*, a.cru_nombre, d.des_nombre FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id IS NOT NULL AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL");
			
        	while($row = mysql_fetch_array($result))
        	{
			$select_actual='<option value="'.$row["via_id"].'">'.$row["cru_nombre"]."/".$row["des_nombre"].'</option>'; 		
			$select=$select.$select_actual;
			}
			
			$panelcuentas->add("combotra",' <tr><td>Crcuero/Origen:</td><td><select name="combotra" id="combotra" onChange="populate2(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.nombre1.value)">'.$select.'</td></tr>');
			
			
				  
				  }
				  if ($selected=='Terrestre')
				  {
					   $panelcuentas->add("fecha",$fechai);
						
					   
				       if ("Aereo"==$selected)
							{
									
										$select_actual2='<option selected="selected">Aereo</option><option>Maritimo</option><option>Terrestre</option>'; }	
						     
							 else if ("Maritimo"==$selected){
								 $select_actual2='<option selected="selected">Maritimo</option><option>Aereo</option><option>Terrestre</option>'; }	
								 if ("Terrestre"==$selected)
								 {
									 $select_actual2='<option selected="selected">Terrestre</option><option>Aereo</option><option>Maritimo</option>';
									 }
								 
								 
		                      $select2=$select2.$select_actual2;
						    $panelcuentas->add("combo",' <tr><td>Tipo de Transporte:</td><td><select name="combo" id="combo" onChange="populate(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.nombre1.value)"><option selected="selected">Seleccione</option>'.$select2.'</select></td></tr>');
							$panelcuentas->add("nombre1",$_GET['mivariable']); 
							
							$select='<option>Seleccione</option>';
							 
	        $result= mysql_query("SELECT v.*, a.ter_nombre, d.des_nombre FROM  via v, terrestre a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_ter_id=a.ter_id AND v.fk_ter_id IS NOT NULL AND v.fk_aer_id IS NULL AND v.fk_cru_id IS NULL");
			
        	while($row = mysql_fetch_array($result))
        	{
			$select_actual='<option value="'.$row["via_id"].'">'.$row["ter_nombre"]."/".$row["des_nombre"].'</option>'; 		
			$select=$select.$select_actual;
			}
			
			$panelcuentas->add("combotra",' <tr><td>T. Terrestre/Origen:</td><td><select name="combotra" id="combotra" onChange="populate2(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.nombre1.value)">'.$select.'</td></tr>');
			
			
				  
				  }
				  
				  
			  }
					   
					   
					   
					   if ($selected && $fechai && $selected2 )
						{
							  if ($selected=='Aereo')
							  {
							//echo("yentra1");
							$panelcuentas->add("fecha",$fechai);
					   
				       if ("Aereo"==$selected)
							{
									
										$select_actual2='<option selected="selected">Aereo</option><option>Maritimo</option><option>Terrestre</option>'; }	
						     
							 else if ("Maritimo"==$selected){
								 $select_actual2='<option selected="selected">Maritimo</option><option>Aereo</option><option>Terrestre</option>'; }	
								 if ("Terrestre"==$selected)
								 {
									 $select_actual2='<option selected="selected">Terrestre</option><option>Aereo</option><option>Maritimo</option>';
									 }
								 
								 
		                      $select2=$select2.$select_actual2;
							   $panelcuentas->add("combo",' <tr><td>Tipo de Transporte:</td><td><select name="combo" id="combo" onChange="populate(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.nombre1.value)"><option selected="selected">Seleccione</option>'.$select2.'</select></td></tr>');
							   $panelcuentas->add("nombre1",$_GET['mivariable']); 
							 
							 
		                      $select22='<option>Seleccione</option>';
							  $result22= mysql_query("SELECT v.*, a.aer_nombre, d.des_nombre FROM  via v, aerolinea a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_aer_id=a.aer_id AND v.fk_aer_id IS NOT NULL AND v.fk_cru_id IS NULL AND v.fk_ter_id IS NULL");
								while($row22 = mysql_fetch_array($result22))
								{				
									
									if ($row22["via_id"]==$selected2){
										//echo 'if';
										$select_actual22='<option selected="selected" value="'.$row22["via_id"].'">'.$row22["aer_nombre"]."/".$row22["des_nombre"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual22='<option value="'.$row22["via_id"].'">'.$row22["aer_nombre"]."/".$row22["des_nombre"].'</option>'; 	}	
									$select22=$select22.$select_actual22;
								}
								
								$panelcuentas->add("combotra",' <tr><td>Transporte/Origen:</td><td><select name="combotra" id="combotra" onChange="populate2(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.nombre1.value)">'.$select22.'</td></tr>');
								
		$panelcuentas->add("cant1",' <tr> <td>Cant Personas (Incluyendo al presupuestante):</td><td><select name="cant1" id="cant1">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>
      </select>      </td></tr>');
								
								$res=mysql_query("SELECT fk_aer_id FROM  via where via_id=$selected2");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_aer_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected2");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];		
					    
						$select1='<option>Seleccione</option>';
						$result1= mysql_query("SELECT v.*, a.aer_nombre, d.des_nombre FROM  via v, aerolinea a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_aer_id=a.aer_id AND v.fk_aer_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_cru_id IS NULL AND v.fk_ter_id IS NULL");
						while($row1 = mysql_fetch_array($result1))
						{
						$result6= mysql_query("SELECT c.cos_costo FROM  costo c WHERE c.fk_via_origen=$selected2 AND c.fk_via_destino=".$row1["via_id"]."");
							 $row6 = mysql_fetch_array($result6);
						$select_actual1='<option value="'.$row1["via_id"].'">'.$row1["aer_nombre"]."/".$row1["des_nombre"]."/".$row6["cos_costo"].'</option>'; 
						$select1=$select1.$select_actual1;
						}
						
						
	
	  
						$panelcuentas->add("combotra1",' <tr><td>Aerolinea/Destino:</td><td><select name="combotra1" id="combotra1"onChange="populate3(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.combotra1.options[document.form1.combotra1.selectedIndex].value,document.form1.cant1.options[document.form1.cant1.selectedIndex].value,document.form1.nombre1.value)">'.$select1.'</td></tr>');
						
							 
							  }
							  else if ($selected=='Maritimo')
							  {
								  
								  //echo("yentra1");
							$panelcuentas->add("fecha",$fechai);
					   
				       if ("Aereo"==$selected)
							{
									
										$select_actual2='<option selected="selected">Aereo</option><option>Maritimo</option><option>Terrestre</option>'; }	
						     
							 else if ("Maritimo"==$selected){
								 $select_actual2='<option selected="selected">Maritimo</option><option>Aereo</option><option>Terrestre</option>'; }	
								 if ("Terrestre"==$selected)
								 {
									 $select_actual2='<option selected="selected">Terrestre</option><option>Aereo</option><option>Maritimo</option>';
									 }
								 
								 
		                      $select2=$select2.$select_actual2;
							   $panelcuentas->add("combo",' <tr><td>Tipo de Transporte:</td><td><select name="combo" id="combo" onChange="populate(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.nombre1.value)"><option selected="selected">Seleccione</option>'.$select2.'</select></td></tr>');
							    	   $panelcuentas->add("nombre1",$_GET['mivariable']);  
							 
							 
		                      $select22='<option>Seleccione</option>';
							  $result22= mysql_query("SELECT v.*, a.cru_nombre, d.des_nombre FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id IS NOT NULL AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL");
								while($row22 = mysql_fetch_array($result22))
								{				
									
									if ($row22["via_id"]==$selected2){
										//echo 'if';
										$select_actual22='<option selected="selected" value="'.$row22["via_id"].'">'.$row22["cru_nombre"]."/".$row22["des_nombre"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual22='<option value="'.$row22["via_id"].'">'.$row22["cru_nombre"]."/".$row22["des_nombre"].'</option>'; 	}	
									$select22=$select22.$select_actual22;
								}
								
								$panelcuentas->add("combotra",' <tr><td>Transporte/Origen:</td><td><select name="combotra" id="combotra" onChange="populate2(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.nombre1.value)">'.$select22.'</td></tr>');
								
		$panelcuentas->add("cant1",' <tr> <td>Cant Personas (Incluyendo al presupuestante):</td><td><select name="cant1" id="cant1">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>
      </select>      </td></tr>');
								
								$res=mysql_query("SELECT fk_cru_id FROM  via where via_id=$selected2");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_cru_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected2");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];		
					    
						$select1='<option>Seleccione</option>';
						$result1= mysql_query("SELECT v.*, a.cru_nombre, d.des_nombre FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id=$devuelve AND v.fk_des_id<>$devuelve1 AND  v.fk_cru_id IS NOT NULL AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL");
						while($row1 = mysql_fetch_array($result1))
						{
						$result6= mysql_query("SELECT c.cos_costo FROM  costo c WHERE c.fk_via_origen=$selected2 AND c.fk_via_destino=".$row1["via_id"]."");
						$row6 = mysql_fetch_array($result6);
						$select_actual1='<option value="'.$row1["via_id"].'">'.$row1["cru_nombre"]."/".$row1["des_nombre"]."/".$row6["cos_costo"].'</option>'; 
						$select1=$select1.$select_actual1;
						}
						
						
	
	  
						$panelcuentas->add("combotra1",' <tr><td>Crucero/Destino:</td><td><select name="combotra1" id="combotra1"onChange="populate3(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.combotra1.options[document.form1.combotra1.selectedIndex].value,document.form1.cant1.options[document.form1.cant1.selectedIndex].value,document.form1.nombre1.value)">'.$select1.'</td></tr>');
						
								  
								  }
								  
								   if ($selected=='Terrestre')
							  {
							//echo("yentra1");
							$panelcuentas->add("fecha",$fechai);
					   
				       if ("Aereo"==$selected)
							{
									
										$select_actual2='<option selected="selected">Aereo</option><option>Maritimo</option><option>Terrestre</option>'; }	
						     
							 else if ("Maritimo"==$selected){
								 $select_actual2='<option selected="selected">Maritimo</option><option>Aereo</option><option>Terrestre</option>'; }	
								 if ("Terrestre"==$selected)
								 {
									 $select_actual2='<option selected="selected">Terrestre</option><option>Aereo</option><option>Maritimo</option>';
									 }
								 
								 
		                      $select2=$select2.$select_actual2;
							   $panelcuentas->add("combo",' <tr><td>Tipo de Transporte:</td><td><select name="combo" id="combo" onChange="populate(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.nombre1.value)"><option selected="selected">Seleccione</option>'.$select2.'</select></td></tr>');
							   $panelcuentas->add("nombre1",$_GET['mivariable']); 
							 
							 
		                      $select22='<option>Seleccione</option>';
							  $result22= mysql_query("SELECT v.*, a.ter_nombre, d.des_nombre FROM  via v, terrestre a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_ter_id=a.ter_id AND v.fk_ter_id IS NOT NULL AND v.fk_cru_id IS NULL AND v.fk_aer_id IS NULL");
								while($row22 = mysql_fetch_array($result22))
								{				
									
									if ($row22["via_id"]==$selected2){
										//echo 'if';
										$select_actual22='<option selected="selected" value="'.$row22["via_id"].'">'.$row22["ter_nombre"]."/".$row22["des_nombre"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual22='<option value="'.$row22["via_id"].'">'.$row22["ter_nombre"]."/".$row22["des_nombre"].'</option>'; 	}	
									$select22=$select22.$select_actual22;
								}
								
								$panelcuentas->add("combotra",' <tr><td>T.terrestre/Origen:</td><td><select name="combotra" id="combotra" onChange="populate2(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.nombre1.value)">'.$select22.'</td></tr>');
								
		$panelcuentas->add("cant1",' <tr> <td>Cant Personas (Incluyendo al presupuestante):</td><td><select name="cant1" id="cant1">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>
      </select>      </td></tr>');
								
								$res=mysql_query("SELECT fk_ter_id FROM  via where via_id=$selected2");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_ter_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected2");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];		
					    
						$select1='<option>Seleccione</option>';
						$result1= mysql_query("SELECT v.*, a.ter_nombre, d.des_nombre FROM  via v, terrestre a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_ter_id=a.ter_id AND v.fk_ter_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_cru_id IS NULL AND v.fk_aer_id IS NULL");
						while($row1 = mysql_fetch_array($result1))
						{
						$result6= mysql_query("SELECT c.cos_costo FROM  costo c WHERE c.fk_via_origen=$selected2 AND c.fk_via_destino=".$row1["via_id"]."");
							 $row6 = mysql_fetch_array($result6);
						$select_actual1='<option value="'.$row1["via_id"].'">'.$row1["ter_nombre"]."/".$row1["des_nombre"]."/".$row6["cos_costo"].'</option>'; 
						$select1=$select1.$select_actual1;
						}
						
						
	
	  
						$panelcuentas->add("combotra1",' <tr><td>T.Terrestre/Destino:</td><td><select name="combotra1" id="combotra1"onChange="populate3(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.combotra1.options[document.form1.combotra1.selectedIndex].value,document.form1.cant1.options[document.form1.cant1.selectedIndex].value,document.form1.nombre1.value)">'.$select1.'</td></tr>');
						
							 
							  }
							  
							  
							  
				}
							
							  if ($selected && $fechai && $selected2 && $selected3 && $selected4 && $mivariable)
						{
							  if ($selected=='Aereo')
							  {
							//echo("yentra1");
							$panelcuentas->add("fecha",$fechai);
					   
				       if ("Aereo"==$selected)
							{
									
										$select_actual2='<option selected="selected">Aereo</option><option>Maritimo</option><option>Terrestre</option>'; }	
						     
							 else if ("Maritimo"==$selected){
								 $select_actual2='<option selected="selected">Maritimo</option><option>Aereo</option><option>Terrestre</option>'; }	
								 if ("Terrestre"==$selected)
								 {
									 $select_actual2='<option selected="selected">Terrestre</option><option>Aereo</option><option>Maritimo</option>';
									 }
								 
								 
		                      $select2=$select2.$select_actual2;
							   $panelcuentas->add("combo",' <tr><td>Tipo de Transporte:</td><td><select name="combo" id="combo" onChange="populate(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.nombre1.value)"><option selected="selected">Seleccione</option>'.$select2.'</select></td></tr>');
							    	   $panelcuentas->add("nombre1",$_GET['mivariable']);  
							 
							 
		$select22='<option>Seleccione</option>';
							  $result22= mysql_query("SELECT v.*, a.aer_nombre, d.des_nombre FROM  via v, aerolinea a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_aer_id=a.aer_id AND v.fk_aer_id IS NOT NULL AND v.fk_cru_id IS NULL AND v.fk_ter_id IS NULL");
								while($row22 = mysql_fetch_array($result22))
								{				
									
									if ($row22["via_id"]==$selected2){
										//echo 'if';
										$select_actual22='<option selected="selected" value="'.$row22["via_id"].'">'.$row22["aer_nombre"]."/".$row22["des_nombre"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual22='<option value="'.$row22["via_id"].'">'.$row22["aer_nombre"]."/".$row22["des_nombre"].'</option>'; 	}	
									$select22=$select22.$select_actual22;
								}
								
								$panelcuentas->add("combotra",' <tr><td>Aerolinea/Origen:</td><td><select name="combotra" id="combotra" onChange="populate2(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.nombre1.value)">'.$select22.'</td></tr>');
								
								$res=mysql_query("SELECT fk_aer_id FROM  via where via_id=$selected2");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_aer_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected2");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];		
					    
						$result12= mysql_query("SELECT v.*, a.aer_nombre, d.des_nombre FROM  via v, aerolinea a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_aer_id=a.aer_id AND v.fk_aer_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_cru_id IS NULL AND v.fk_ter_id IS NULL");
						while($row12 = mysql_fetch_array($result12))
								{
								$result6= mysql_query("SELECT c.cos_costo FROM  costo c WHERE c.fk_via_origen=$selected2 AND c.fk_via_destino=".$row12["via_id"]."");
							 $row6 = mysql_fetch_array($result6);				
									
									if ($row12["via_id"]==$selected3){
										//echo 'if';
										$select_actual12='<option selected="selected" value="'.$row12["via_id"].'">'.$row12["aer_nombre"]."/".$row12["des_nombre"]."/".$row6["cos_costo"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual12='<option value="'.$row12["via_id"].'">'.$row12["aer_nombre"]."/".$row12["des_nombre"]."/".$row6["cos_costo"].'</option>'; 	}	
									$select12=$select12.$select_actual12;
								}
						$panelcuentas->add("combotra1",' <tr><td>Aerolinea/Destino:</td><td><select name="combotra1" id="combotra1"onChange="populate3(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.combotra1.options[document.form1.combotra1.selectedIndex].value,document.form1.cant1.options[document.form1.cant1.selectedIndex].value,document.form1.nombre1.value)">'.$select12.'</td></tr>');
						
						$panelcuentas->add("cant1",' <tr> <td>Cant Personas (Incluyendo al presupuestante):</td><td><select name="cant1" id="cant1">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>
      </select>      </td></tr>');

						        $res3=mysql_query("SELECT c.cos_costo FROM  costo c WHERE c.fk_via_origen=$selected2 AND c.fk_via_destino=$selected3");
								$ro3 = mysql_fetch_array($res3);
								$devuelve3=$ro3['cos_costo'];	
								//secho($devuelve3);	
								//echo($cant1);
								$devuelvetodo=$devuelve3*$selected4;
							
							$panelcuentas->add("monto1",'<tr><td width="203">Total:</td><td>'.$devuelvetodo.'</td></tr>');	
								

	   
						$panelcuentas->add("pregunta",' <tr> <td>Este es su ultimo destino?</td><td><select name="pregunta" id="pregunta">
        <option>Seleccione</option>
		<option>Si</option>
        <option>No</option>
      </select>      </td></tr>');

						
							 
							  }
							  else if ($selected=='Maritimo')
							  {
							//echo("yentra1");
							$panelcuentas->add("fecha",$fechai);
					   
				       if ("Aereo"==$selected)
							{
									
										$select_actual2='<option selected="selected">Aereo</option><option>Maritimo</option><option>Terrestre</option>'; }	
						     
							 else if ("Maritimo"==$selected){
								 $select_actual2='<option selected="selected">Maritimo</option><option>Aereo</option><option>Terrestre</option>'; }	
								 if ("Terrestre"==$selected)
								 {
									 $select_actual2='<option selected="selected">Terrestre</option><option>Aereo</option><option>Maritimo</option>';
									 }
								 
								 
		                      $select2=$select2.$select_actual2;
							   $panelcuentas->add("combo",' <tr><td>Tipo de Transporte:</td><td><select name="combo" id="combo" onChange="populate(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.nombre1.value)"><option selected="selected">Seleccione</option>'.$select2.'</select></td></tr>');
							    	   $panelcuentas->add("nombre1",$_GET['mivariable']);  
							 
							 
		$select22='<option>Seleccione</option>';
							  $result22= mysql_query("SELECT v.*, a.cru_nombre, d.des_nombre FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id IS NOT NULL AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL");
								while($row22 = mysql_fetch_array($result22))
								{				
									
									if ($row22["via_id"]==$selected2){
										//echo 'if';
										$select_actual22='<option selected="selected" value="'.$row22["via_id"].'">'.$row22["cru_nombre"]."/".$row22["des_nombre"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual22='<option value="'.$row22["via_id"].'">'.$row22["cru_nombre"]."/".$row22["des_nombre"].'</option>'; 	}	
									$select22=$select22.$select_actual22;
								}
								
								$panelcuentas->add("combotra",' <tr><td>Crucero/Origen:</td><td><select name="combotra" id="combotra" onChange="populate2(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.nombre1.value)">'.$select22.'</td></tr>');
								
								$res=mysql_query("SELECT fk_cru_id FROM  via where via_id=$selected2");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_cru_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected2");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];		
					    
						$result12= mysql_query("SELECT v.*, a.cru_nombre, d.des_nombre FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_cru_id IS NOT NULL AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL");
						while($row12 = mysql_fetch_array($result12))
								{	
								$result6= mysql_query("SELECT c.cos_costo FROM  costo c WHERE c.fk_via_origen=$selected2 AND c.fk_via_destino=".$row12["via_id"]."");
							 $row6 = mysql_fetch_array($result6);			
									
									if ($row12["via_id"]==$selected3){
										//echo 'if';
										$select_actual12='<option selected="selected" value="'.$row12["via_id"].'">'.$row12["cru_nombre"]."/".$row12["des_nombre"]."/".$row6["cos_costo"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual12='<option value="'.$row12["via_id"].'">'.$row12["cru_nombre"]."/".$row12["des_nombre"]."/".$row6["cos_costo"].'</option>'; 	}	
									$select12=$select12.$select_actual12;
								}
						$panelcuentas->add("combotra1",' <tr><td>Crucero/Destino:</td><td><select name="combotra1" id="combotra1"onChange="populate3(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.combotra1.options[document.form1.combotra1.selectedIndex].value,document.form1.cant1.options[document.form1.cant1.selectedIndex].value,document.form1.nombre1.value)">'.$select12.'</td></tr>');
						
						$panelcuentas->add("cant1",' <tr> <td>Cant Personas (Incluyendo al presupuestante):</td><td><select name="cant1" id="cant1">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>
      </select>      </td></tr>');

						        $res3=mysql_query("SELECT c.cos_costo FROM  costo c WHERE c.fk_via_origen=$selected2 AND c.fk_via_destino=$selected3");
								$ro3 = mysql_fetch_array($res3);
								$devuelve3=$ro3['cos_costo'];	
								//secho($devuelve3);	
								//echo($cant1);
								$devuelvetodo=$devuelve3*$selected4;
							
							$panelcuentas->add("monto1",'<tr><td width="203">Total:</td><td>'.$devuelvetodo.'</td></tr>');	
								

	   
						$panelcuentas->add("pregunta",' <tr> <td>Este es su ultimo destino?</td><td><select name="pregunta" id="pregunta">
        <option>Seleccione</option>
		<option>Si</option>
        <option>No</option>
      </select>      </td></tr>');

						
							 
							  }
							  
							   if ($selected=='Terrestre')
							  {
							//echo("yentra1");
							$panelcuentas->add("fecha",$fechai);
					   
				       if ("Aereo"==$selected)
							{
									
										$select_actual2='<option selected="selected">Aereo</option><option>Maritimo</option><option>Terrestre</option>'; }	
						     
							 else if ("Maritimo"==$selected){
								 $select_actual2='<option selected="selected">Maritimo</option><option>Aereo</option><option>Terrestre</option>'; }	
								 if ("Terrestre"==$selected)
								 {
									 $select_actual2='<option selected="selected">Terrestre</option><option>Aereo</option><option>Maritimo</option>';
									 }
								 
								 
		                      $select2=$select2.$select_actual2;
							   $panelcuentas->add("combo",' <tr><td>Tipo de Transporte:</td><td><select name="combo" id="combo" onChange="populate(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.nombre1.value)"><option selected="selected">Seleccione</option>'.$select2.'</select></td></tr>');
							    	   $panelcuentas->add("nombre1",$_GET['mivariable']);  
							 
							 
		$select22='<option>Seleccione</option>';
							  $result22= mysql_query("SELECT v.*, a.ter_nombre, d.des_nombre FROM  via v, terrestre a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_ter_id=a.ter_id AND v.fk_ter_id IS NOT NULL AND v.fk_cru_id IS NULL AND v.fk_aer_id IS NULL");
								while($row22 = mysql_fetch_array($result22))
								{				
									
									if ($row22["via_id"]==$selected2){
										//echo 'if';
										$select_actual22='<option selected="selected" value="'.$row22["via_id"].'">'.$row22["ter_nombre"]."/".$row22["des_nombre"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual22='<option value="'.$row22["via_id"].'">'.$row22["ter_nombre"]."/".$row22["des_nombre"].'</option>'; 	}	
									$select22=$select22.$select_actual22;
								}
								
								$panelcuentas->add("combotra",' <tr><td>T.Terrestre/Origen:</td><td><select name="combotra" id="combotra" onChange="populate2(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.nombre1.value)">'.$select22.'</td></tr>');
								
								$res=mysql_query("SELECT fk_ter_id FROM  via where via_id=$selected2");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_ter_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected2");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];		
					    
						$result12= mysql_query("SELECT v.*, a.ter_nombre, d.des_nombre FROM  via v, terrestre a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_ter_id=a.ter_id AND v.fk_ter_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_cru_id IS NULL AND v.fk_aer_id IS NULL");
						while($row12 = mysql_fetch_array($result12))
								{	
								$result6= mysql_query("SELECT c.cos_costo FROM  costo c WHERE c.fk_via_origen=$selected2 AND c.fk_via_destino=".$row12["via_id"]."");
							 $row6 = mysql_fetch_array($result6);			
									
									if ($row12["via_id"]==$selected3){
										//echo 'if';
										$select_actual12='<option selected="selected" value="'.$row12["via_id"].'">'.$row12["ter_nombre"]."/".$row12["des_nombre"]."/".$row6["cos_costo"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual12='<option value="'.$row12["via_id"].'">'.$row12["ter_nombre"]."/".$row12["des_nombre"]."/".$row6["cos_costo"].'</option>'; 	}	
									$select12=$select12.$select_actual12;
								}
						$panelcuentas->add("combotra1",' <tr><td>T.Terrestre/Destino:</td><td><select name="combotra1" id="combotra1"onChange="populate3(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.combotra1.options[document.form1.combotra1.selectedIndex].value,document.form1.cant1.options[document.form1.cant1.selectedIndex].value,document.form1.nombre1.value)">'.$select12.'</td></tr>');
						
						$panelcuentas->add("cant1",' <tr> <td>Cant Personas (Incluyendo al presupuestante):</td><td><select name="cant1" id="cant1">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>
      </select>      </td></tr>');

						        $res3=mysql_query("SELECT c.cos_costo FROM  costo c WHERE c.fk_via_origen=$selected2 AND c.fk_via_destino=$selected3");
								$ro3 = mysql_fetch_array($res3);
								$devuelve3=$ro3['cos_costo'];	
								//secho($devuelve3);	
								//echo($cant1);
								$devuelvetodo=$devuelve3*$selected4;
							
							$panelcuentas->add("monto1",'<tr><td width="203">Total:</td><td>'.$devuelvetodo.'</td></tr>');	
								

	   
						$panelcuentas->add("pregunta",' <tr> <td>Este es su ultimo destino?</td><td><select name="pregunta" id="pregunta">
        <option>Seleccione</option>
		<option>Si</option>
        <option>No</option>
      </select>      </td></tr>');

						
							 
							  }
							  
							  
							  
							  
							
						
							}
				
					   
					  
					  
					  
					  
					  
					  
			
				  
				  
				  
				  
				  
			  
			 
			  
			  
			  
			
			  
			  
			  
			  
			

			
			
			
			
			
			$panelcuentas->add("tipo_boton",'Presupuestar');
			//$panelcuentas->add("error",'Ya existe un estadio '.$cue_numero.' andre '.$row["ban_nombre"]);
	        $admin->add("contenido",$panelcuentas);
	        $admin->show();
			
			
		   }
			
			
			
	include "../db/cerrar_conexion.php";
?>