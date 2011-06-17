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
	      
		  if($total && !(isset($sipo)))
		  {
			   $aqui=$_GET['mivariable'];
			  
	                          $res3=mysql_query("SELECT c.cos_costo FROM  costo c WHERE c.fk_via_origen=".$_POST['combotra1']." AND c.fk_via_destino=".$_POST['combotra1']."");
								$ro3 = mysql_fetch_array($res3);
								$devuelve3=$ro3['cos_costo'];	
								//secho($devuelve3);	
								//echo($cant1);
								$devuelvetodo=$devuelve3*$cant1;
			  
			  
			
							 
							 
						if($_POST['servicio']=="z"){
							  mysql_query("INSERT INTO `presupuesto` (`pre_id`, `pre_fecha`,`pre_habitacion`,`pre_servicio`,`pre_paseo`,`pre_total`,`pre_cant_per`,`fk_per_cedula`, `fk_via_id_origen`, `fk_via_id_destino`,`pre_abono`,`pre_status`) VALUES (NULL ,'".$_POST['fecha']."','".$_POST['habitacion']."',NULL,'$mivariable1', '".$_POST['total']."','".$_POST['cant1']."', '$cedula','".$_POST['combotra']."', '".$_POST['combotra1']."',0,'No comprado')");
}
else
{
 mysql_query("INSERT INTO `presupuesto` (`pre_id`, `pre_fecha`,`pre_habitacion`,`pre_servicio`,`pre_paseo`,`pre_total`,`pre_cant_per`,`fk_per_cedula`, `fk_via_id_origen`, `fk_via_id_destino`,`pre_abono`,`pre_status`) VALUES (NULL ,'".$_POST['fecha']."','".$_POST['habitacion']."','".$_POST['servicio']."','$mivariable1', '".$_POST['total']."','".$_POST['cant1']."', '$cedula','".$_POST['combotra']."', '".$_POST['combotra1']."',0,'No comprado')");
}	
	$last = mysql_query("SELECT max(pre_id) as max FROM presupuesto"); 
				$last2 = mysql_fetch_array($last);
				$este=$last2["max"];
				
				if($pas1){
				mysql_query("INSERT INTO `pre_pas` (`pre_id`, `fk_pre_id`,`fk_pas_id`) VALUES (NULL ,'$este','$pas1')");}
				if($pas2){
				mysql_query("INSERT INTO `pre_pas` (`pre_id`, `fk_pre_id`,`fk_pas_id`) VALUES (NULL ,'$este','$pas2')");}
				if($pas3){
				mysql_query("INSERT INTO `pre_pas` (`pre_id`, `fk_pre_id`,`fk_pas_id`) VALUES (NULL ,'$este','$pas3')");}
				if($pas4){
				mysql_query("INSERT INTO `pre_pas` (`pre_id`, `fk_pre_id`,`fk_pas_id`) VALUES (NULL ,'$este','$pas4')");}
				if($pas5){
				mysql_query("INSERT INTO `pre_pas` (`pre_id`, `fk_pre_id`,`fk_pas_id`) VALUES (NULL ,'$este','$pas5')");}
				if($pas6){
				mysql_query("INSERT INTO `pre_pas` (`pre_id`, `fk_pre_id`,`fk_pas_id`) VALUES (NULL ,'$este','$pas6')");}
				if($pas7){
				mysql_query("INSERT INTO `pre_pas` (`pre_id`, `fk_pre_id`,`fk_pas_id`) VALUES (NULL ,'$este','$pas7')");}
				if($pas8){
				mysql_query("INSERT INTO `pre_pas` (`pre_id`, `fk_pre_id`,`fk_pas_id`) VALUES (NULL ,'$este','$pas8')");}
	                           
							
								 
							
									 

								
							
				                
				
								   
				
							
								
			    
				$hola='u_presupuesto_multi_sinestadia.php?pregunta='.$pregunta.'&mensaje=1';
				header("Location:$hola");			
			
			
			
        
			 
			  
			  
		  
		  
		  
		  
		  
	  
		  
		  
		  }
	      else
		  {
			
			$admin= new Panel("../html/usuario.html");
			$admin->add("body",'<body onLoad = "actual(3)" >');
			$panelcuentas = new Panel("../html/u_crear_presupuesto_multi_sinestadia.html");
			$panelcuentas->add("form",'<form name="form1" method="post" action="../php/u_crear_presupuesto_multi_sinestadia.php?&combotra='.$selected2.'&combotra1='.$selected3.'&cant1='.$selected4.'&fecha='.$fechai.'&mivariable1='.$_GET['mivariable'].'">'); //mnio variable ? pero no se ponla con get okis pero sirvio? r// no porque cuando la mande mi variable es nada:S le puse mivariable
	
	       //echo($_GET['mivariable']);
		   	   $panelcuentas->add("mivariable",$_GET['mivariable']);     
			
      $panelcuentas->add("combo",'<tr><td>*Tipo de Transporte:</td><td><select name="combo" id="combo" onChange="populate(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.mivariable.value)"><option selected="selected">Seleccione</option><option>Aereo</option><option>Maritimo</option><option>Terrestre</option></select></td></tr>');
			
			  
			  
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
						    $panelcuentas->add("combo",' <tr><td>Tipo de Transporte:</td><td><select name="combo" id="combo" onChange="populate(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.mivariable.value)"><option selected="selected">Seleccione</option>'.$select2.'</select></td></tr>');
							$panelcuentas->add("mivariable",$_GET['mivariable']);     
							
							$select='<option>Seleccione</option>';
							 
	        $result= mysql_query("SELECT v.*, a.aer_nombre, d.des_nombre FROM  via v, aerolinea a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_aer_id=a.aer_id AND v.fk_aer_id IS NOT NULL AND v.fk_cru_id IS NULL AND v.fk_ter_id IS NULL");
			
        	while($row = mysql_fetch_array($result))
        	{
			$select_actual='<option value="'.$row["via_id"].'">'.$row["aer_nombre"]."/".$row["des_nombre"].'</option>'; 		
			$select=$select.$select_actual;
			}
			
			$panelcuentas->add("combotra",' <tr><td>Aerolinea/Origen:</td><td><select name="combotra" id="combotra" onChange="populate2(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.mivariable.value)">'.$select.'</td></tr>');
			
			
				  
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
						    $panelcuentas->add("combo",' <tr><td>Tipo de Transporte:</td><td><select name="combo" id="combo" onChange="populate(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.mivariable.value)" ><option selected="selected">Seleccione</option>'.$select2.'</select></td></tr>');
							$panelcuentas->add("mivariable",$_GET['mivariable']); 
							
							$select='<option>Seleccione</option>';
							 
	        $result= mysql_query("SELECT v.*, a.cru_nombre, d.des_nombre FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id IS NOT NULL AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL");
			
        	while($row = mysql_fetch_array($result))
        	{
			$select_actual='<option value="'.$row["via_id"].'">'.$row["cru_nombre"]."/".$row["des_nombre"].'</option>'; 		
			$select=$select.$select_actual;
			}
			
			$panelcuentas->add("combotra",' <tr><td>Crcuero/Origen:</td><td><select name="combotra" id="combotra" onChange="populate2(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.mivariable.value)">'.$select.'</td></tr>');
			
			
				  
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
						    $panelcuentas->add("combo",' <tr><td>Tipo de Transporte:</td><td><select name="combo" id="combo" onChange="populate(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.mivariable.value)"><option selected="selected">Seleccione</option>'.$select2.'</select></td></tr>');
							$panelcuentas->add("mivariable",$_GET['mivariable']); 
							
							$select='<option>Seleccione</option>';
							 
	        $result= mysql_query("SELECT v.*, a.ter_nombre, d.des_nombre FROM  via v, terrestre a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_ter_id=a.ter_id AND v.fk_ter_id IS NOT NULL AND v.fk_aer_id IS NULL AND v.fk_cru_id IS NULL");
			
        	while($row = mysql_fetch_array($result))
        	{
			$select_actual='<option value="'.$row["via_id"].'">'.$row["ter_nombre"]."/".$row["des_nombre"].'</option>'; 		
			$select=$select.$select_actual;
			}
			
			$panelcuentas->add("combotra",' <tr><td>T. Terrestre/Origen:</td><td><select name="combotra" id="combotra" onChange="populate2(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.mivariable.value)">'.$select.'</td></tr>');
			
			
				  
				  }
				  
				  
			  }
					   
					   
					   
					   if ($selected && $fechai && $selected2 && !(isset($sipo)) )
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
							   $panelcuentas->add("combo",' <tr><td>Tipo de Transporte:</td><td><select name="combo" id="combo" onChange="populate(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.mivariable.value)"><option selected="selected">Seleccione</option>'.$select2.'</select></td></tr>');
							   $panelcuentas->add("mivariable",$_GET['mivariable']); 
							 
							 
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
								
								$panelcuentas->add("combotra",' <tr><td>Transporte/Origen:</td><td><select name="combotra" id="combotra" onChange="populate2(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.mivariable.value)">'.$select22.'</td></tr>');
								
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
						
						
	
	  
						$panelcuentas->add("combotra1",' <tr><td>Aerolinea/Destino:</td><td><select name="combotra1" id="combotra1"onChange="populate3(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.combotra1.options[document.form1.combotra1.selectedIndex].value,document.form1.cant1.options[document.form1.cant1.selectedIndex].value,document.form1.mivariable.value)">'.$select1.'</td></tr>');
						
							 
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
							   $panelcuentas->add("combo",' <tr><td>Tipo de Transporte:</td><td><select name="combo" id="combo" onChange="populate(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.mivariable.value)"><option selected="selected">Seleccione</option>'.$select2.'</select></td></tr>');
							    	   $panelcuentas->add("mivariable",$_GET['mivariable']);  
							 
							 
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
								
								$panelcuentas->add("combotra",' <tr><td>Transporte/Origen:</td><td><select name="combotra" id="combotra" onChange="populate2(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.mivariable.value)">'.$select22.'</td></tr>');
								
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
						
						
	
	  
						$panelcuentas->add("combotra1",' <tr><td>Crucero/Destino:</td><td><select name="combotra1" id="combotra1"onChange="populate3(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.combotra1.options[document.form1.combotra1.selectedIndex].value,document.form1.cant1.options[document.form1.cant1.selectedIndex].value,document.form1.mivariable.value)">'.$select1.'</td></tr>');
						
								  
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
							   $panelcuentas->add("combo",' <tr><td>Tipo de Transporte:</td><td><select name="combo" id="combo" onChange="populate(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.mivariable.value)"><option selected="selected">Seleccione</option>'.$select2.'</select></td></tr>');
							   $panelcuentas->add("mivariable",$_GET['mivariable']); 
							 
							 
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
								
								$panelcuentas->add("combotra",' <tr><td>T.terrestre/Origen:</td><td><select name="combotra" id="combotra" onChange="populate2(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.mivariable.value)">'.$select22.'</td></tr>');
								
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
						
						
	
	  
						$panelcuentas->add("combotra1",' <tr><td>T.Terrestre/Destino:</td><td><select name="combotra1" id="combotra1"onChange="populate3(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.combotra1.options[document.form1.combotra1.selectedIndex].value,document.form1.cant1.options[document.form1.cant1.selectedIndex].value,document.form1.mivariable.value)">'.$select1.'</td></tr>');
						
							 
							  }
							  
							  
							  
				}
							//echo "hotel $hotel";
							  if ($selected && $fechai && $selected2 && $selected3 && $selected4 && $mivariable && (!(isset($hotel))))
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
							   $panelcuentas->add("combo",' <tr><td>Tipo de Transporte:</td><td><select name="combo" id="combo" onChange="populate(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.mivariable.value)"><option selected="selected">Seleccione</option>'.$select2.'</select></td></tr>');
							    	   $panelcuentas->add("mivariable",$_GET['mivariable']);  
							 
							 
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
								
								$panelcuentas->add("combotra",' <tr><td>Aerolinea/Origen:</td><td><select name="combotra" id="combotra" onChange="populate2(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.mivariable.value)">'.$select22.'</td></tr>');
								
								$res=mysql_query("SELECT fk_aer_id FROM  via where via_id=$selected2");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_aer_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected2");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];		
					    
						$result12= mysql_query("SELECT v.*, a.aer_nombre, d.des_nombre FROM  via v, aerolinea a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_aer_id=a.aer_id AND v.fk_aer_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_cru_id IS NULL AND v.fk_ter_id IS NULL");
						while($row12 = mysql_fetch_array($result12))
								{	
								$result6= mysql_query("SELECT c.cos_costo FROM  costo c WHERE c.fk_via_origen=$selected2 AND c.fk_via_destino=".$row1["via_id"]."");
							 $row6 = mysql_fetch_array($result6);				
									
									if ($row12["via_id"]==$selected3){
										//echo 'if';
										$select_actual12='<option selected="selected" value="'.$row12["via_id"].'">'.$row12["aer_nombre"]."/".$row12["des_nombre"]."/".$row6["cos_costo"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual12='<option value="'.$row12["via_id"].'">'.$row12["aer_nombre"]."/".$row12["des_nombre"]."/".$row6["cos_costo"].'</option>'; 	}	
									$select12=$select12.$select_actual12;
								}
						$panelcuentas->add("combotra1",' <tr><td>Aerolinea/Destino:</td><td><select name="combotra1" id="combotra1"onChange="populate3(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.combotra1.options[document.form1.combotra1.selectedIndex].value,document.form1.cant1.options[document.form1.cant1.selectedIndex].value,document.form1.mivariable.value)">'.$select12.'</td></tr>');
						
						$res3=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected3");
						$ro3 = mysql_fetch_array($res3);
						$devuelve3=$ro3['fk_des_id'];	
						//echo "$devuelve3 dev";
						
						
						
						$select4='';	
						$result4= mysql_query("SELECT ho.hot_nombre, ho.hot_id FROM  hotel ho WHERE ho.fk_des_id=$devuelve3");
						while($row4 = mysql_fetch_array($result4))
						{
						$select_actual4='<option value="'.$row4["hot_id"].'">'.$row4["hot_nombre"].'</option>'; 
						$select4=$select4.$select_actual4;
						}
						$panelcuentas->add("hoteles",' <tr><td>Hotel:</td><td><select name="hotel" id="hotel" onChange="populate4(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.combotra1.options[document.form1.combotra1.selectedIndex].value,document.form1.cant1.options[document.form1.cant1.selectedIndex].value,document.form1.mivariable.value,document.form1.hotel.options[document.form1.hotel.selectedIndex].value)"><option>Seleccione</option>'.$select4.'</td></tr>');
						
						
	
						
						
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
							   $panelcuentas->add("combo",' <tr><td>Tipo de Transporte:</td><td><select name="combo" id="combo" onChange="populate(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.mivariable.value)"><option selected="selected">Seleccione</option>'.$select2.'</select></td></tr>');
							    	   $panelcuentas->add("mivariable",$_GET['mivariable']);  
							 
							 
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
								
								$panelcuentas->add("combotra",' <tr><td>Crucero/Origen:</td><td><select name="combotra" id="combotra" onChange="populate2(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.mivariable.value)">'.$select22.'</td></tr>');
								
								$res=mysql_query("SELECT fk_cru_id FROM  via where via_id=$selected2");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_cru_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected2");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];		
					    
						$result12= mysql_query("SELECT v.*, a.cru_nombre, d.des_nombre FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_cru_id IS NOT NULL AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL");
						while($row12 = mysql_fetch_array($result12))
								{
								$result6= mysql_query("SELECT c.cos_costo FROM  costo c WHERE c.fk_via_origen=$selected2 AND c.fk_via_destino=".$row1["via_id"]."");
							 $row6 = mysql_fetch_array($result6);					
									
									if ($row12["via_id"]==$selected3){
										//echo 'if';
										$select_actual12='<option selected="selected" value="'.$row12["via_id"].'">'.$row12["cru_nombre"]."/".$row12["des_nombre"]."/".$row6["cos_costo"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual12='<option value="'.$row12["via_id"].'">'.$row12["cru_nombre"]."/".$row12["des_nombre"]."/".$row6["cos_costo"].'</option>'; 	}	
									$select12=$select12.$select_actual12;
								}
						$panelcuentas->add("combotra1",' <tr><td>Crucero/Destino:</td><td><select name="combotra1" id="combotra1"onChange="populate3(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.combotra1.options[document.form1.combotra1.selectedIndex].value,document.form1.cant1.options[document.form1.cant1.selectedIndex].value,document.form1.mivariable.value)">'.$select12.'</td></tr>');
						
						$res3=mysql_query("SELECT fk_cru_id FROM  via where via_id=$selected3");
						$ro3 = mysql_fetch_array($res3);
						$devuelve3=$ro3['fk_cru_id'];	
						//echo "$devuelve3 dev";
						
						
						
						$select4='';	
						$result4= mysql_query("SELECT ho.flo_nombre, ho.flo_id FROM  flota ho WHERE ho.fk_cru_id=$devuelve3");
						while($row4 = mysql_fetch_array($result4))
						{
						$select_actual4='<option value="'.$row4["flo_id"].'">'.$row4["flo_nombre"].'</option>'; 
						$select4=$select4.$select_actual4;
						}
						$panelcuentas->add("hoteles",' <tr><td>Barco:</td><td><select name="hotel" id="hotel" onChange="populate4(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.combotra1.options[document.form1.combotra1.selectedIndex].value,document.form1.cant1.options[document.form1.cant1.selectedIndex].value,document.form1.mivariable.value,document.form1.hotel.options[document.form1.hotel.selectedIndex].value)"><option>Seleccione</option>'.$select4.'</td></tr>');
						
						
						
						
						
						
						
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
							   $panelcuentas->add("combo",' <tr><td>Tipo de Transporte:</td><td><select name="combo" id="combo" onChange="populate(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.mivariable.value)"><option selected="selected">Seleccione</option>'.$select2.'</select></td></tr>');
							    	   $panelcuentas->add("mivariable",$_GET['mivariable']);  
							 
							 
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
								
								$panelcuentas->add("combotra",' <tr><td>T.Terrestre/Origen:</td><td><select name="combotra" id="combotra" onChange="populate2(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.mivariable.value)">'.$select22.'</td></tr>');
								
								$res=mysql_query("SELECT fk_ter_id FROM  via where via_id=$selected2");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_ter_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected2");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];		
					    
						$result12= mysql_query("SELECT v.*, a.ter_nombre, d.des_nombre FROM  via v, terrestre a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_ter_id=a.ter_id AND v.fk_ter_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_cru_id IS NULL AND v.fk_aer_id IS NULL");
						while($row12 = mysql_fetch_array($result12))
								{	
								$result6= mysql_query("SELECT c.cos_costo FROM  costo c WHERE c.fk_via_origen=$selected2 AND c.fk_via_destino=".$row1["via_id"]."");
							 $row6 = mysql_fetch_array($result6);				
									
									if ($row12["via_id"]==$selected3){
										//echo 'if';
										$select_actual12='<option selected="selected" value="'.$row12["via_id"].'">'.$row12["ter_nombre"]."/".$row12["des_nombre"]."/".$row6["cos_costo"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual12='<option value="'.$row12["via_id"].'">'.$row12["ter_nombre"]."/".$row12["des_nombre"]."/".$row6["cos_costo"].'</option>'; 	}	
									$select12=$select12.$select_actual12;
								}
						$panelcuentas->add("combotra1",' <tr><td>T.Terrestre/Destino:</td><td><select name="combotra1" id="combotra1"onChange="populate3(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.combotra1.options[document.form1.combotra1.selectedIndex].value,document.form1.cant1.options[document.form1.cant1.selectedIndex].value,document.form1.mivariable.value)">'.$select12.'</td></tr>');
						
						$res3=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected3");
						$ro3 = mysql_fetch_array($res3);
						$devuelve3=$ro3['fk_des_id'];	
						//echo "$devuelve3 dev";
						
						
						
						$select4='';	
						$result4= mysql_query("SELECT ho.hot_nombre, ho.hot_id FROM  hotel ho WHERE ho.fk_des_id=$devuelve3");
						while($row4 = mysql_fetch_array($result4))
						{
						$select_actual4='<option value="'.$row4["hot_id"].'">'.$row4["hot_nombre"].'</option>'; 
						$select4=$select4.$select_actual4;
						}
						$panelcuentas->add("hoteles",' <tr><td>Hotel:</td><td><select name="hotel" id="hotel" onChange="populate4(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.combotra1.options[document.form1.combotra1.selectedIndex].value,document.form1.cant1.options[document.form1.cant1.selectedIndex].value,document.form1.mivariable.value,document.form1.hotel.options[document.form1.hotel.selectedIndex].value)"><option>Seleccione</option>'.$select4.'</td></tr>');
						
						
						
						
						
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

						        

						
							 
							  }
							  
							  
							  
							  
							
						
							}
				
		//AQUIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIII			   
					  
					  	
							  if ($selected && $fechai && $selected2 && $selected3 && $selected4 && $mivariable && $hotel)
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
							   $panelcuentas->add("combo",' <tr><td>Tipo de Transporte:</td><td><select name="combo" id="combo" onChange="populate(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.mivariable.value)"><option selected="selected">Seleccione</option>'.$select2.'</select></td></tr>');
							    	   $panelcuentas->add("mivariable",$_GET['mivariable']);  
							 
							 
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
								
								$panelcuentas->add("combotra",' <tr><td>Aerolinea/Origen:</td><td><select name="combotra" id="combotra" onChange="populate2(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.mivariable.value)">'.$select22.'</td></tr>');
								
								$res=mysql_query("SELECT fk_aer_id FROM  via where via_id=$selected2");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_aer_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected2");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];		
					    
						$result12= mysql_query("SELECT v.*, a.aer_nombre, d.des_nombre FROM  via v, aerolinea a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_aer_id=a.aer_id AND v.fk_aer_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_cru_id IS NULL AND v.fk_ter_id IS NULL");
						while($row12 = mysql_fetch_array($result12))
								{	
								$result6= mysql_query("SELECT c.cos_costo FROM  costo c WHERE c.fk_via_origen=$selected2 AND c.fk_via_destino=".$row1["via_id"]."");
							 $row6 = mysql_fetch_array($result6);				
									
									if ($row12["via_id"]==$selected3){
										//echo 'if';
										$select_actual12='<option selected="selected" value="'.$row12["via_id"].'">'.$row12["aer_nombre"]."/".$row12["des_nombre"]."/".$row6["cos_costo"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual12='<option value="'.$row12["via_id"].'">'.$row12["aer_nombre"]."/".$row12["des_nombre"]."/".$row6["cos_costo"].'</option>'; 	}	
									$select12=$select12.$select_actual12;
								}
						$panelcuentas->add("combotra1",' <tr><td>Aerolinea/Destino:</td><td><select name="combotra1" id="combotra1"onChange="populate3(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.combotra1.options[document.form1.combotra1.selectedIndex].value,document.form1.cant1.options[document.form1.cant1.selectedIndex].value,document.form1.mivariable.value)">'.$select12.'</td></tr>');
						
						$res3=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected3");
						$ro3 = mysql_fetch_array($res3);
						$devuelve3=$ro3['fk_des_id'];	
						//echo "$devuelve3 dev";
						
						
						
						$select4='';	
						$result4= mysql_query("SELECT ho.hot_nombre, ho.hot_id FROM  hotel ho WHERE ho.fk_des_id=$devuelve3");
						while($row4 = mysql_fetch_array($result4))
								{				
									
									if ($row4["hot_id"]==$hotel){
										//echo 'if';
										$select_actual4='<option selected="selected" value="'.$row4["hot_id"].'">'.$row4["hot_nombre"].'</option>';}	
									else{
										//echo "banco es $banco";
										$select_actual4='<option value="'.$row4["hot_id"].'">'.$row4["hot_nombre"].'</option>'; }
						$select4=$select4.$select_actual4;
								}
						
						
						$panelcuentas->add("hoteles",' <tr><td>Hotel:</td><td><select name="hotel" id="hotel" onChange="populate4(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.combotra1.options[document.form1.combotra1.selectedIndex].value,document.form1.cant1.options[document.form1.cant1.selectedIndex].value,document.form1.mivariable.value,document.form1.hotel.options[document.form1.hotel.selectedIndex].value)"><option>Seleccione</option>'.$select4.'</td></tr>');
						
						$select5='<tr>
      <td>Habitacion:</td>
      <td><select name="habitacion" id="habitacion"><option value="z">Seleccione</option>';
						$result5= mysql_query("SELECT h.hab_id, h.hab_costo, h.hab_categoria FROM  habitacion h  WHERE h.fk_hot_id=$hotel AND h.hab_status='No ocupada'");
						while($row5 = mysql_fetch_array($result5))
						{
						$select_actual5='<option value="'.$row5["hab_id"].'">'.$row5["hab_id"].' Costo:'.$row5["hab_costo"].' Cat:'.$row5["hab_categoria"].'</option>'; 
						$select5=$select5.$select_actual5;
						}
						$panelcuentas->add("habitaciones",$select5.'</td></tr>');
						
						
						$select7='<tr>
      <td>*Servicios:</td>
      <td><select name="servicio" id="servicio"><option value="z">No deseo Servicios</option>';
						$result7= mysql_query("SELECT s.ser_nombre, s.ser_descripcion,s.ser_id,s.ser_costo FROM  servicio s, hot_ser hs WHERE hs.fk_hot_id=$hotel AND hs.fk_ser_id=s.ser_id");
						while($row7 = mysql_fetch_array($result7))
						{
						$select_actual7='<option value="'.$row7["ser_id"].'">'.$row7["ser_nombre"].'/'.$row7["ser_descripcion"].'/'.$row7["ser_costo"].'</option>'; 
						$select7=$select7.$select_actual7;
						}
						$panelcuentas->add("servicios",$select7.'</td></tr>');
						
						
						$select8='<tr>
      <td>*Paseos:</td>
      <td><input type="checkbox" name="pas0" id="pas0" value="a" />Ningun paseo<br />';
						$result8= mysql_query("SELECT p.pas_nombre, p.pas_descripcion,p.pas_id,p.pas_costo FROM  paseo p, hot_pas hp WHERE hp.fk_hot_id=$hotel AND hp.fk_pas_id=p.pas_id");
						$cont=0;
						while($row8 = mysql_fetch_array($result8))
						{
						$select_actual8='<input type="checkbox" name="pas'.($cont+1).'" id="pas'.($cont+1).'" value="'.$row8["pas_id"].'" />'.$row8["pas_nombre"].'/'.$row8["pas_descripcion"].'/'.$row8["pas_costo"].'<br />';
						$select8=$select8.$select_actual8;
						
			
						$cont=$cont+1;
						}
						$panelcuentas->add("paseos",$select8.'</td></tr>');
						
						
						$panelcuentas->add("tipov",'<tr>
      <td>Tipo de viaje:</td>
      <td><select name="tipoviaje" id="tipoviaje" onChange= "populate6(document.form1.mivariable.value)">
         <option>Seleccione</option>
        <option>Solamente Ida</option>
        <option>Ida y vuelta</option>
      </select>      </td>
    </tr>');
						
						
						
						
						
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
							   $panelcuentas->add("combo",' <tr><td>Tipo de Transporte:</td><td><select name="combo" id="combo" onChange="populate(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.mivariable.value)"><option selected="selected">Seleccione</option>'.$select2.'</select></td></tr>');
							    	   $panelcuentas->add("mivariable",$_GET['mivariable']);  
							 
							 
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
								
								$panelcuentas->add("combotra",' <tr><td>Crucero/Origen:</td><td><select name="combotra" id="combotra" onChange="populate2(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.mivariable.value)">'.$select22.'</td></tr>');
								
								$res=mysql_query("SELECT fk_cru_id FROM  via where via_id=$selected2");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_cru_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected2");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];		
					    
						$result12= mysql_query("SELECT v.*, a.cru_nombre, d.des_nombre FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_cru_id IS NOT NULL AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL");
						while($row12 = mysql_fetch_array($result12))
								{	
								$result6= mysql_query("SELECT c.cos_costo FROM  costo c WHERE c.fk_via_origen=$selected2 AND c.fk_via_destino=".$row1["via_id"]."");
							 $row6 = mysql_fetch_array($result6);			
									
									if ($row12["via_id"]==$selected3){
										//echo 'if';
										$select_actual12='<option selected="selected" value="'.$row12["via_id"].'">'.$row12["cru_nombre"]."/".$row12["des_nombre"]."/".$row6["cos_costo"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual12='<option value="'.$row12["via_id"].'">'.$row12["cru_nombre"]."/".$row12["des_nombre"]."/".$row6["cos_costo"].'</option>'; 	}	
									$select12=$select12.$select_actual12;
								}
						$panelcuentas->add("combotra1",' <tr><td>Crucero/Destino:</td><td><select name="combotra1" id="combotra1"onChange="populate3(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.combotra1.options[document.form1.combotra1.selectedIndex].value,document.form1.cant1.options[document.form1.cant1.selectedIndex].value,document.form1.mivariable.value)">'.$select12.'</td></tr>');
						
						$res3=mysql_query("SELECT fk_cru_id FROM  via where via_id=$selected3");
						$ro3 = mysql_fetch_array($res3);
						$devuelve3=$ro3['fk_cru_id'];	
						//echo "$devuelve3 dev";
						
						
						
						$select4='';	
						$result4= mysql_query("SELECT ho.flo_nombre, ho.flo_id FROM  flota ho WHERE ho.fk_cru_id=$devuelve3");
						while($row4 = mysql_fetch_array($result4))
								{				
									
									if ($row4["flo_id"]==$hotel){
										//echo 'if';
										$select_actual4='<option selected="selected" value="'.$row4["flo_id"].'">'.$row4["flo_nombre"].'</option>';}	
									else{
										//echo "banco es $banco";
										$select_actual4='<option value="'.$row4["flo_id"].'">'.$row4["flo_nombre"].'</option>'; }
						$select4=$select4.$select_actual4;
								}
						
						
						$panelcuentas->add("hoteles",' <tr><td>Barco:</td><td><select name="hotel" id="hotel" onChange="populate4(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.combotra1.options[document.form1.combotra1.selectedIndex].value,document.form1.cant1.options[document.form1.cant1.selectedIndex].value,document.form1.mivariable.value,document.form1.hotel.options[document.form1.hotel.selectedIndex].value)"><option>Seleccione</option>'.$select4.'</td></tr>');
						
						$select5='<tr>
      <td>Habitacion:</td>
      <td><select name="habitacion" id="habitacion"><option value="z">Seleccione</option>';
						$result5= mysql_query("SELECT h.hab_id, h.hab_costo,  h.hab_categoria FROM  habitacion h  WHERE h.fk_hot_id=$hotel AND h.hab_status='No ocupada'");
						while($row5 = mysql_fetch_array($result5))
						{
						$select_actual5='<option value="'.$row5["hab_id"].'">'.$row5["hab_id"].' Costo:'.$row5["hab_costo"].' Cat:'.$row5["hab_categoria"].'</option>'; 
						$select5=$select5.$select_actual5;
						}
						$panelcuentas->add("habitaciones",$select5.'</td></tr>');
						
						
						$select7='<tr>
      <td>*Servicios:</td>
      <td><select name="servicio" id="servicio"><option value="z">No deseo Servicios</option>';
						$result7= mysql_query("SELECT s.ser_nombre, s.ser_descripcion,s.ser_id,s.ser_costo FROM  servicio s, hot_ser hs WHERE hs.fk_hot_id=$hotel AND hs.fk_ser_id=s.ser_id");
						while($row7 = mysql_fetch_array($result7))
						{
						$select_actual7='<option value="'.$row7["ser_id"].'">'.$row7["ser_nombre"].'/'.$row7["ser_descripcion"].'/'.$row7["ser_costo"].'</option>'; 
						$select7=$select7.$select_actual7;
						}
						$panelcuentas->add("servicios",$select7.'</td></tr>');
						
						
						
						
						
						$panelcuentas->add("tipov",'<tr>
      <td>Tipo de viaje:</td>
      <td><select name="tipoviaje" id="tipoviaje" onChange= "populate6(document.form1.mivariable.value)">
         <option>Seleccione</option>
        <option>Solamente Ida</option>
        <option>Ida y vuelta</option>
      </select>      </td>
    </tr>');
						
						
						
						
						
						
						
						
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
							   $panelcuentas->add("combo",' <tr><td>Tipo de Transporte:</td><td><select name="combo" id="combo" onChange="populate(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.mivariable.value)"><option selected="selected">Seleccione</option>'.$select2.'</select></td></tr>');
							    	   $panelcuentas->add("mivariable",$_GET['mivariable']);  
							 
							 
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
								
								$panelcuentas->add("combotra",' <tr><td>T.Terrestre/Origen:</td><td><select name="combotra" id="combotra" onChange="populate2(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.mivariable.value)">'.$select22.'</td></tr>');
								
								$res=mysql_query("SELECT fk_ter_id FROM  via where via_id=$selected2");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_ter_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected2");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];		
					    
						$result12= mysql_query("SELECT v.*, a.ter_nombre, d.des_nombre FROM  via v, terrestre a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_ter_id=a.ter_id AND v.fk_ter_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_cru_id IS NULL AND v.fk_aer_id IS NULL");
						while($row12 = mysql_fetch_array($result12))
								{	
								$result6= mysql_query("SELECT c.cos_costo FROM  costo c WHERE c.fk_via_origen=$selected2 AND c.fk_via_destino=".$row1["via_id"]."");
							 $row6 = mysql_fetch_array($result6);				
									
									if ($row12["via_id"]==$selected3){
										//echo 'if';
										$select_actual12='<option selected="selected" value="'.$row12["via_id"].'">'.$row12["ter_nombre"]."/".$row12["des_nombre"]."/".$row6["cos_costo"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual12='<option value="'.$row12["via_id"].'">'.$row12["ter_nombre"]."/".$row12["des_nombre"]."/".$row6["cos_costo"].'</option>'; 	}	
									$select12=$select12.$select_actual12;
								}
						$panelcuentas->add("combotra1",' <tr><td>T.Terrestre/Destino:</td><td><select name="combotra1" id="combotra1"onChange="populate3(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.combotra1.options[document.form1.combotra1.selectedIndex].value,document.form1.cant1.options[document.form1.cant1.selectedIndex].value,document.form1.mivariable.value)">'.$select12.'</td></tr>');
						
						
						$res3=mysql_query("SELECT fk_des_id FROM  via where via_id=$selected3");
						$ro3 = mysql_fetch_array($res3);
						$devuelve3=$ro3['fk_des_id'];	
						//echo "$devuelve3 dev";
						
						
						
						$select4='';	
						$result4= mysql_query("SELECT ho.hot_nombre, ho.hot_id FROM  hotel ho WHERE ho.fk_des_id=$devuelve3");
						while($row4 = mysql_fetch_array($result4))
								{				
									
									if ($row4["hot_id"]==$hotel){
										//echo 'if';
										$select_actual4='<option selected="selected" value="'.$row4["hot_id"].'">'.$row4["hot_nombre"].'</option>';}	
									else{
										//echo "banco es $banco";
										$select_actual4='<option value="'.$row4["hot_id"].'">'.$row4["hot_nombre"].'</option>'; }
						$select4=$select4.$select_actual4;
								}
						
						
						$panelcuentas->add("hoteles",' <tr><td>Hotel:</td><td><select name="hotel" id="hotel" onChange="populate4(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.combotra1.options[document.form1.combotra1.selectedIndex].value,document.form1.cant1.options[document.form1.cant1.selectedIndex].value,document.form1.mivariable.value,document.form1.hotel.options[document.form1.hotel.selectedIndex].value)"><option>Seleccione</option>'.$select4.'</td></tr>');
						
						$select5='<tr>
      <td>Habitacion:</td>
      <td><select name="habitacion" id="habitacion"><option value="z">Seleccione</option>';
						$result5= mysql_query("SELECT h.hab_id, h.hab_costo, h.hab_categoria FROM  habitacion h  WHERE h.fk_hot_id=$hotel AND h.hab_status='No ocupada'");
						while($row5 = mysql_fetch_array($result5))
						{
						$select_actual5='<option value="'.$row5["hab_id"].'">'.$row5["hab_id"].' Costo:'.$row5["hab_costo"].' Cat:'.$row5["hab_categoria"].'</option>'; 
						$select5=$select5.$select_actual5;
						}
						$panelcuentas->add("habitaciones",$select5.'</td></tr>');
						
						
						$select7='<tr>
      <td>*Servicios:</td>
      <td><select name="servicio" id="servicio"><option value="z">No deseo Servicios</option>';
						$result7= mysql_query("SELECT s.ser_nombre, s.ser_descripcion,s.ser_id,s.ser_costo FROM  servicio s, hot_ser hs WHERE hs.fk_hot_id=$hotel AND hs.fk_ser_id=s.ser_id");
						while($row7 = mysql_fetch_array($result7))
						{
						$select_actual7='<option value="'.$row7["ser_id"].'">'.$row7["ser_nombre"].'/'.$row7["ser_descripcion"].'/'.$row7["ser_costo"].'</option>'; 
						$select7=$select7.$select_actual7;
						}
						$panelcuentas->add("servicios",$select7.'</td></tr>');
						
						
						$select8='<tr>
      <td>*Paseos:</td>
      <td><input type="checkbox" name="pas0" id="pas0" value="a" />Ningun paseo<br />';
						$result8= mysql_query("SELECT p.pas_nombre, p.pas_descripcion,p.pas_id,p.pas_costo FROM  paseo p, hot_pas hp WHERE hp.fk_hot_id=$hotel AND hp.fk_pas_id=p.pas_id");
						$cont=0;
						while($row8 = mysql_fetch_array($result8))
						{
						$select_actual8='<input type="checkbox" name="pas'.($cont+1).'" id="pas'.($cont+1).'" value="'.$row8["pas_id"].'" />'.$row8["pas_nombre"].'/'.$row8["pas_descripcion"].'/'.$row8["pas_costo"].'<br />';
						$select8=$select8.$select_actual8;
						
			
						$cont=$cont+1;
						}
						$panelcuentas->add("paseos",$select8.'</td></tr>');
						
						
						$panelcuentas->add("tipov",'<tr>
      <td>Tipo de viaje:</td>
      <td><select name="tipoviaje" id="tipoviaje" onChange= "populate6(document.form1.mivariable.value)">
         <option>Seleccione</option>
        <option>Solamente Ida</option>
        <option>Ida y vuelta</option>
      </select>      </td>
    </tr>');
						
						
						
						
						
						
						
						
						
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

						      

						
							 
							  }
							  
							  
							  
							  
							
						
							}
					  
		//AQUIIIIII 2222			  
					  
			
			  if ($mivariable && $fecha && $combo && $combotra && $cant1 && $combotra1 && $hotel && $servicio && $tipoviaje && ($pas0 || $pas1 || $pas2 || $pas3 || $pas4 || $pas5 || $pas6))
						{
					
							  if ($combo=='Aereo')
							  {
							//echo("yentra1");
							$panelcuentas->add("fecha",$fecha);
					   
				       if ("Aereo"==$combo)
							{
									
										$select_actual2='<option selected="selected">Aereo</option><option>Maritimo</option><option>Terrestre</option>'; }	
						     
							 else if ("Maritimo"==$combo){
								 $select_actual2='<option selected="selected">Maritimo</option><option>Aereo</option><option>Terrestre</option>'; }	
								 if ("Terrestre"==$combo)
								 {
									 $select_actual2='<option selected="selected">Terrestre</option><option>Aereo</option><option>Maritimo</option>';
									 }
								 
								 
		                      $select2=$select2.$select_actual2;
							   $panelcuentas->add("combo",' <tr><td>Tipo de Transporte:</td><td><select name="combo" id="combo" onChange="populate(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.mivariable.value)"><option selected="selected">Seleccione</option>'.$select2.'</select></td></tr>');
							    	   $panelcuentas->add("mivariable",$mivariable);  
							 
							 
		$select22='<option>Seleccione</option>';
							  $result22= mysql_query("SELECT v.*, a.aer_nombre, d.des_nombre FROM  via v, aerolinea a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_aer_id=a.aer_id AND v.fk_aer_id IS NOT NULL AND v.fk_cru_id IS NULL AND v.fk_ter_id IS NULL");
								while($row22 = mysql_fetch_array($result22))
								{				
									
									if ($row22["via_id"]==$combotra){
										//echo 'if';
										$select_actual22='<option selected="selected" value="'.$row22["via_id"].'">'.$row22["aer_nombre"]."/".$row22["des_nombre"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual22='<option value="'.$row22["via_id"].'">'.$row22["aer_nombre"]."/".$row22["des_nombre"].'</option>'; 	}	
									$select22=$select22.$select_actual22;
								}
								
								$panelcuentas->add("combotra",' <tr><td>Aerolinea/Origen:</td><td><select name="combotra" id="combotra" onChange="populate2(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.mivariable.value)">'.$select22.'</td></tr>');
								
								$res=mysql_query("SELECT fk_aer_id FROM  via where via_id=$combotra");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_aer_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$combotra");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];		
					    
						$result12= mysql_query("SELECT v.*, a.aer_nombre, d.des_nombre FROM  via v, aerolinea a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_aer_id=a.aer_id AND v.fk_aer_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_cru_id IS NULL AND v.fk_ter_id IS NULL");
						while($row12 = mysql_fetch_array($result12))
								{		
								$result6= mysql_query("SELECT c.cos_costo FROM  costo c WHERE c.fk_via_origen=$combotra AND c.fk_via_destino=".$row1["via_id"]."");
							 $row6 = mysql_fetch_array($result6);			
									
									if ($row12["via_id"]==$combotra1){
										//echo 'if';
										$select_actual12='<option selected="selected" value="'.$row12["via_id"].'">'.$row12["aer_nombre"]."/".$row12["des_nombre"]."/".$row6["cos_costo"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual12='<option value="'.$row12["via_id"].'">'.$row12["aer_nombre"]."/".$row12["des_nombre"]."/".$row6["cos_costo"].'</option>'; 	}	
									$select12=$select12.$select_actual12;
								}
						$panelcuentas->add("combotra1",' <tr><td>Aerolinea/Destino:</td><td><select name="combotra1" id="combotra1"onChange="populate3(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.combotra1.options[document.form1.combotra1.selectedIndex].value,document.form1.cant1.options[document.form1.cant1.selectedIndex].value,document.form1.mivariable.value)">'.$select12.'</td></tr>');
						
						$res3=mysql_query("SELECT fk_des_id FROM  via where via_id=$combotra1");
						$ro3 = mysql_fetch_array($res3);
						$devuelve3=$ro3['fk_des_id'];	
						//echo "$devuelve3 dev";
						
						
						
						$select4='';	
						$result4= mysql_query("SELECT ho.hot_nombre, ho.hot_id FROM  hotel ho WHERE ho.fk_des_id=$devuelve3");
						while($row4 = mysql_fetch_array($result4))
								{				
									
									if ($row4["hot_id"]==$hotel){
										//echo 'if';
										$select_actual4='<option selected="selected" value="'.$row4["hot_id"].'">'.$row4["hot_nombre"].'</option>';}	
									else{
										//echo "banco es $banco";
										$select_actual4='<option value="'.$row4["hot_id"].'">'.$row4["hot_nombre"].'</option>'; }
						$select4=$select4.$select_actual4;
								}
						
						
						$panelcuentas->add("hoteles",' <tr><td>Hotel:</td><td><select name="hotel" id="hotel" onChange="populate4(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.combotra1.options[document.form1.combotra1.selectedIndex].value,document.form1.cant1.options[document.form1.cant1.selectedIndex].value,document.form1.mivariable.value,document.form1.hotel.options[document.form1.hotel.selectedIndex].value)"><option>Seleccione</option>'.$select4.'</td></tr>');
						
						$select5='<tr>
      <td>Habitacion:</td>
      <td><select name="habitacion" id="habitacion"><option value="z">Seleccione</option>';
						$result5= mysql_query("SELECT h.hab_id, h.hab_costo, h.hab_categoria FROM  habitacion h  WHERE h.fk_hot_id=$hotel AND h.hab_status='No ocupada'");
						while($row5 = mysql_fetch_array($result5))
						{
						if ($row5["hab_id"]==$habitacion){
										//echo 'if';
										$select_actual5='<option selected="selected" value="'.$row5["hab_id"].'">'.$row5["hab_id"].' Costo:'.$row5["hab_costo"].' Cat:'.$row5["hab_categoria"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual5='<option value="'.$row5["hab_id"].'">'.$row5["hab_id"].' Costo:'.$row5["hab_costo"].' Cat:'.$row5["hab_categoria"].'</option>'; 	}	
						$select5=$select5.$select_actual5;
						}
						$panelcuentas->add("habitaciones",$select5.'</td></tr>');
						
						
						$select7='<tr>
      <td>*Servicios:</td>
      <td><select name="servicio" id="servicio"><option value="z">No deseo Servicios</option>';
						$result7= mysql_query("SELECT s.ser_nombre, s.ser_descripcion,s.ser_id,s.ser_costo FROM  servicio s, hot_ser hs WHERE hs.fk_hot_id=$hotel AND hs.fk_ser_id=s.ser_id");
						while($row7 = mysql_fetch_array($result7))
						{
						if ($row7["ser_id"]==$servicio){
										//echo 'if';
										$select_actual7='<option selected="selected" value="'.$row7["ser_id"].'">'.$row7["ser_nombre"].'Descripcion:'.$row7["ser_descripcion"].'/'.$row7["ser_costo"].'</option>'; }	
					
						else{
										//echo "banco es $banco";
										$select_actual7='<option value="'.$row7["ser_id"].'">'.$row7["ser_nombre"].'Descripcion'.$row7["ser_descripcion"].'/'.$row7["ser_costo"].'</option>'; 	}	
						$select7=$select7.$select_actual7;
						}
						if ($servicio=="z"){
						$select7=$select7.'<option selected="selected" value="z">No deseo Servicios</option>';
						}
						else
						{$select7=$select7.'<option value="z">No deseo Servicios</option>';}
						$panelcuentas->add("servicios",$select7.'</td></tr>');
						
						
						$select8='<tr>
      <td>*Paseos:</td>
      <td><input type="checkbox" name="pas0" id="pas0" value="a" />Ningun paseo<br />';
						$result8= mysql_query("SELECT p.pas_nombre, p.pas_descripcion,p.pas_id,p.pas_costo FROM  paseo p, hot_pas hp WHERE hp.fk_hot_id=$hotel AND hp.fk_pas_id=p.pas_id");
						
						$cont=0;
						while($row8 = mysql_fetch_array($result8))
				{
						if ($row8["pas_id"]==$pas1){
						
						$select_actual8='<input type="checkbox" name="pas'.($cont+1).'" id="pas'.($cont+1).'" checked="yes" value="'.$row8["pas_id"].'" />'.$row8["pas_nombre"].'/'.$row8["pas_descripcion"].'/'.$row8["pas_costo"].'<br />';
						$select8=$select8.$select_actual8;
						}
						else if ($row8["pas_id"]==$pas2)
						{
						
						$select_actual8='<input type="checkbox" name="pas'.($cont+1).'" id="pas'.($cont+1).'" checked="yes" value="'.$row8["pas_id"].'" />'.$row8["pas_nombre"].'/'.$row8["pas_descripcion"].'/'.$row8["pas_costo"].'<br />';
						$select8=$select8.$select_actual8;
						}
						else if ($row8["pas_id"]==$pas3)
						{
						
						$select_actual8='<input type="checkbox" name="pas'.($cont+1).'" id="pas'.($cont+1).'" checked="yes" value="'.$row8["pas_id"].'" />'.$row8["pas_nombre"].'/'.$row8["pas_descripcion"].'/'.$row8["pas_costo"].'<br />';
						$select8=$select8.$select_actual8;
						}
						else if ($row8["pas_id"]==$pas4)
						{
						
						$select_actual8='<input type="checkbox" name="pas'.($cont+1).'" id="pas'.($cont+1).'" checked="yes" value="'.$row8["pas_id"].'" />'.$row8["pas_nombre"].'/'.$row8["pas_descripcion"].'/'.$row8["pas_costo"].'<br />';
						$select8=$select8.$select_actual8;
						}
						else if ($row8["pas_id"]==$pas5)
						{
						
						$select_actual8='<input type="checkbox" name="pas'.($cont+1).'" id="pas'.($cont+1).'" checked="yes" value="'.$row8["pas_id"].'" />'.$row8["pas_nombre"].'/'.$row8["pas_descripcion"].'/'.$row8["pas_costo"].'<br />';
						$select8=$select8.$select_actual8;
						}
						else if ($row8["pas_id"]==$pas6)
						{
						
						$select_actual8='<input type="checkbox" name="pas'.($cont+1).'" id="pas'.($cont+1).'" checked="yes" value="'.$row8["pas_id"].'" />'.$row8["pas_nombre"].'/'.$row8["pas_descripcion"].'/'.$row8["pas_costo"].'<br />';
						$select8=$select8.$select_actual8;
						}
						else if ($row8["pas_id"]==$pas7)
						{
						
						$select_actual8='<input type="checkbox" name="pas'.($cont+1).'" id="pas'.($cont+1).'" checked="yes" value="'.$row8["pas_id"].'" />'.$row8["pas_nombre"].'/'.$row8["pas_descripcion"].'/'.$row8["pas_costo"].'<br />';
						$select8=$select8.$select_actual8;
						}
						else if ($row8["pas_id"]==$pas8)
						{
						
						$select_actual8='<input type="checkbox" name="pas'.($cont+1).'" id="pas'.($cont+1).'"checked="yes"  value="'.$row8["pas_id"].'" />'.$row8["pas_nombre"].'/'.$row8["pas_descripcion"].'/'.$row8["pas_costo"].'<br />';
						$select8=$select8.$select_actual8;
						}
						else if ($pas0)
						{
						echo "a";
						$select_actual8='<input type="checkbox" name="pas0" id="pas0"  checked= "yes" value="a" />Ningun paseo<br />';
						$select8=$select_actual8;
						}
						
						
						//$select8=$select8.$select_actual8;
						
						
			
						$cont=$cont+1;
		
						
				}
						$panelcuentas->add("paseos",$select8.'</td></tr>');
						
						
						$panelcuentas->add("tipov",'<tr>
      <td>Tipo de viaje:</td>
      <td><select name="tipoviaje" id="tipoviaje" onChange= "populate6(document.form1.mivariable.value)">
         <option>Seleccione</option>
        <option>Solamente Ida</option>
        <option>Ida y vuelta</option>
      </select>      </td>
    </tr>');
						
						
						
						
						
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
	  
	  
	  $costo_total=0;
						
						$res5= mysql_query("SELECT c.cos_costo FROM  costo c WHERE c.fk_via_origen=$combotra AND c.fk_via_destino=$combotra1");
						$ro5 = mysql_fetch_array($res5);
						$costo_via=$ro5['cos_costo'];
						//echo($costo_via);
						
						$res6=mysql_query("SELECT hab_costo FROM  habitacion h  where h.fk_hot_id=$hotel AND h.hab_id=$habitacion");
						$ro6 = mysql_fetch_array($res6);
						$costo_hab=$ro6['hab_costo'];
						//echo($costo_hab);
						$costo_ser=0;
						if ($servicio!="z"){
						$res7=mysql_query("SELECT ser_costo FROM  servicio s, hot_ser hs  where hs.fk_hot_id=$hotel AND hs.fk_ser_id=s.ser_id AND s.ser_id=$servicio");
						$ro7 = mysql_fetch_array($res7);
						$costo_ser=$ro7['ser_costo'];}
						//echo($costo_ser);
						$costo_pas1=0;
						$costo_pas3=0;
						$costo_pas5=0;
						$costo_pas7=0;
						$costo_pas9=0;
						
						if ($pas1){
						$res8=mysql_query("SELECT pas_costo FROM  paseo p, hot_pas hp  where hp.fk_hot_id=$hotel AND hp.fk_pas_id=p.pas_id AND p.pas_id=$pas1");
						$ro8 = mysql_fetch_array($res8);
						$costo_pas=$ro8['pas_costo'];
						
						$costo_pas1=$costo_pas*$cant1;}
						
						if ($pas2){
						$res9=mysql_query("SELECT pas_costo FROM  paseo p, hot_pas hp  where hp.fk_hot_id=$hotel AND hp.fk_pas_id=p.pas_id AND p.pas_id=$pas2");
						$ro9 = mysql_fetch_array($res9);
						$costo_pas2=$ro9['pas_costo'];
						
						$costo_pas3=$costo_pas2*$cant1;}
		
						//echo("$costo_pas3 costo paseo2" );
						
						if ($pas3){
						$res11=mysql_query("SELECT pas_costo FROM  paseo p, hot_pas hp  where hp.fk_hot_id=$hotel AND hp.fk_pas_id=p.pas_id AND p.pas_id=$pas3");
						$ro11 = mysql_fetch_array($res11);
						$costo_pas4=$ro11['pas_costo'];
						
						$costo_pas5=$costo_pas4*$cant1;}
						
						if ($pas4){
						$res12=mysql_query("SELECT pas_costo FROM  paseo p, hot_pas hp  where hp.fk_hot_id=$hotel AND hp.fk_pas_id=p.pas_id AND p.pas_id=$pas4");
						$ro12 = mysql_fetch_array($res12);
						$costo_pas6=$ro12['pas_costo'];
						
						$costo_pas7=$costo_pas6*$cant1;}
						
						if ($pas5){
						$res13=mysql_query("SELECT pas_costo FROM  paseo p, hot_pas hp  where hp.fk_hot_id=$hotel AND hp.fk_pas_id=p.pas_id AND p.pas_id=$pas5");
						$ro13 = mysql_fetch_array($res13);
						$costo_pas8=$ro13['pas_costo'];
						
						$costo_pas9=$costo_pas8*$cant1;}
						
						
						if($tipoviaje=="Ida y vuelta")
						{
						$costo_total=($costo_total+$costo_via+$costo_hab+$costo_ser+$costo_pas1+$costo_pas3+$costo_pas5+$costo_pas7+$costo_pas9)*$cant1*2;}
						else{
						$costo_total=($costo_total+$costo_via+$costo_hab+$costo_ser+$costo_pas1+$costo_pas3+$costo_pas5+$costo_pas7+$costo_pas9)*$cant1; }
						
						
						//echo($costo_total);
						//$panelcuentas->add("totaltodo",$costo_total);
							
							$panelcuentas->add("monto1",'<tr>
      <td width="203">Total Presupuesto(BsF):</td>
      <td width="202"><input type="text" name="total" id="total" value="'.$costo_total.'" readonly></td>
    </tr>');	
								

	   
						$panelcuentas->add("pregunta",' <tr> <td>Este es su ultimo destino?</td><td><select name="pregunta" id="pregunta">
        <option>Seleccione</option>
		<option>Si</option>
        <option>No</option>
      </select>      </td></tr>');

	  
	  

						       
						
							 
							  }
							  
							  
							   if ($combo=='Terrestre')
							  {
							//echo("yentra1");
							$panelcuentas->add("fecha",$fecha);
					   
				       if ("Aereo"==$combo)
							{
									
										$select_actual2='<option selected="selected">Aereo</option><option>Maritimo</option><option>Terrestre</option>'; }	
						     
							 else if ("Maritimo"==$combo){
								 $select_actual2='<option selected="selected">Maritimo</option><option>Aereo</option><option>Terrestre</option>'; }	
								 if ("Terrestre"==$combo)
								 {
									 $select_actual2='<option selected="selected">Terrestre</option><option>Aereo</option><option>Maritimo</option>';
									 }
								 
								 
		                      $select2=$select2.$select_actual2;
							   $panelcuentas->add("combo",' <tr><td>Tipo de Transporte:</td><td><select name="combo" id="combo" onChange="populate(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.mivariable.value)"><option selected="selected">Seleccione</option>'.$select2.'</select></td></tr>');
							    	   $panelcuentas->add("mivariable",$_GET['mivariable']);  
							 
							 
		$select22='<option>Seleccione</option>';
							  $result22= mysql_query("SELECT v.*, a.ter_nombre, d.des_nombre FROM  via v, terrestre a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_ter_id=a.ter_id AND v.fk_ter_id IS NOT NULL AND v.fk_cru_id IS NULL AND v.fk_aer_id IS NULL");
								while($row22 = mysql_fetch_array($result22))
								{				
									
									if ($row22["via_id"]==$combotra){
										//echo 'if';
										$select_actual22='<option selected="selected" value="'.$row22["via_id"].'">'.$row22["ter_nombre"]."/".$row22["des_nombre"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual22='<option value="'.$row22["via_id"].'">'.$row22["ter_nombre"]."/".$row22["des_nombre"].'</option>'; 	}	
									$select22=$select22.$select_actual22;
								}
								
								$panelcuentas->add("combotra",' <tr><td>T.Terrestre/Origen:</td><td><select name="combotra" id="combotra" onChange="populate2(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.mivariable.value)">'.$select22.'</td></tr>');
								
								$res=mysql_query("SELECT fk_ter_id FROM  via where via_id=$combotra");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_ter_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$combotra");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];		
					    
						$result12= mysql_query("SELECT v.*, a.ter_nombre, d.des_nombre FROM  via v, terrestre a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_ter_id=a.ter_id AND v.fk_ter_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_cru_id IS NULL AND v.fk_aer_id IS NULL");
						while($row12 = mysql_fetch_array($result12))
								{	
								$result6= mysql_query("SELECT c.cos_costo FROM  costo c WHERE c.fk_via_origen=$combotra AND c.fk_via_destino=".$row1["via_id"]."");
							 $row6 = mysql_fetch_array($result6);				
									
									if ($row12["via_id"]==$combotra1){
										//echo 'if';
										$select_actual12='<option selected="selected" value="'.$row12["via_id"].'">'.$row12["ter_nombre"]."/".$row12["des_nombre"]."/".$row6["cos_costo"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual12='<option value="'.$row12["via_id"].'">'.$row12["ter_nombre"]."/".$row12["des_nombre"]."/".$row6["cos_costo"].'</option>'; 	}	
									$select12=$select12.$select_actual12;
								}
						$panelcuentas->add("combotra1",' <tr><td>T.Terrestre/Destino:</td><td><select name="combotra1" id="combotra1"onChange="populate3(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.combotra1.options[document.form1.combotra1.selectedIndex].value,document.form1.cant1.options[document.form1.cant1.selectedIndex].value,document.form1.mivariable.value)">'.$select12.'</td></tr>');
						$res3=mysql_query("SELECT fk_des_id FROM  via where via_id=$combotra1");
						$ro3 = mysql_fetch_array($res3);
						$devuelve3=$ro3['fk_des_id'];	
						//echo "$devuelve3 dev";
						
						
						
						$select4='';	
						$result4= mysql_query("SELECT ho.hot_nombre, ho.hot_id FROM  hotel ho WHERE ho.fk_des_id=$devuelve3");
						while($row4 = mysql_fetch_array($result4))
								{				
									
									if ($row4["hot_id"]==$hotel){
										//echo 'if';
										$select_actual4='<option selected="selected" value="'.$row4["hot_id"].'">'.$row4["hot_nombre"].'</option>';}	
									else{
										//echo "banco es $banco";
										$select_actual4='<option value="'.$row4["hot_id"].'">'.$row4["hot_nombre"].'</option>'; }
						$select4=$select4.$select_actual4;
								}
						
						
						$panelcuentas->add("hoteles",' <tr><td>Hotel:</td><td><select name="hotel" id="hotel" onChange="populate4(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.combotra1.options[document.form1.combotra1.selectedIndex].value,document.form1.cant1.options[document.form1.cant1.selectedIndex].value,document.form1.mivariable.value,document.form1.hotel.options[document.form1.hotel.selectedIndex].value)"><option>Seleccione</option>'.$select4.'</td></tr>');
						
						$select5='<tr>
      <td>Habitacion:</td>
      <td><select name="habitacion" id="habitacion"><option value="z">Seleccione</option>';
						$result5= mysql_query("SELECT h.hab_id, h.hab_costo, h.hab_categoria FROM  habitacion h  WHERE h.fk_hot_id=$hotel AND h.hab_status='No ocupada'");
						while($row5 = mysql_fetch_array($result5))
						{
						if ($row5["hab_id"]==$habitacion){
										//echo 'if';
										$select_actual5='<option selected="selected" value="'.$row5["hab_id"].'">'.$row5["hab_id"].' Costo:'.$row5["hab_costo"].' Cat:'.$row5["hab_categoria"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual5='<option value="'.$row5["hab_id"].'">'.$row5["hab_id"].' Costo:'.$row5["hab_costo"].' Cat:'.$row5["hab_categoria"].'</option>'; 	}	
						$select5=$select5.$select_actual5;
						}
						$panelcuentas->add("habitaciones",$select5.'</td></tr>');
						
						
						$select7='<tr>
      <td>*Servicios:</td>
      <td><select name="servicio" id="servicio"><option value="z">No deseo Servicios</option>';
						$result7= mysql_query("SELECT s.ser_nombre, s.ser_descripcion,s.ser_id,s.ser_costo FROM  servicio s, hot_ser hs WHERE hs.fk_hot_id=$hotel AND hs.fk_ser_id=s.ser_id");
						while($row7 = mysql_fetch_array($result7))
						{
						if ($row7["ser_id"]==$servicio){
										//echo 'if';
										$select_actual7='<option selected="selected" value="'.$row7["ser_id"].'">'.$row7["ser_nombre"].'Descripcion:'.$row7["ser_descripcion"].'/'.$row7["ser_costo"].'</option>'; }	
					
						else{
										//echo "banco es $banco";
										$select_actual7='<option value="'.$row7["ser_id"].'">'.$row7["ser_nombre"].'Descripcion'.$row7["ser_descripcion"].'/'.$row7["ser_costo"].'</option>'; 	}	
						$select7=$select7.$select_actual7;
						}
						if ($servicio=="z"){
						$select7=$select7.'<option selected="selected" value="z">No deseo Servicios</option>';
						}
						else
						{$select7=$select7.'<option value="z">No deseo Servicios</option>';}
						$panelcuentas->add("servicios",$select7.'</td></tr>');
						
						
						$select8='<tr>
      <td>*Paseos:</td>
      <td><input type="checkbox" name="pas0" id="pas0" value="a" />Ningun paseo<br />';
						$result8= mysql_query("SELECT p.pas_nombre, p.pas_descripcion,p.pas_id,p.pas_costo FROM  paseo p, hot_pas hp WHERE hp.fk_hot_id=$hotel AND hp.fk_pas_id=p.pas_id");
						
						$cont=0;
						while($row8 = mysql_fetch_array($result8))
				{
						if ($row8["pas_id"]==$pas1){
						
						$select_actual8='<input type="checkbox" name="pas'.($cont+1).'" id="pas'.($cont+1).'" checked="yes" value="'.$row8["pas_id"].'" />'.$row8["pas_nombre"].'/'.$row8["pas_descripcion"].'/'.$row8["pas_costo"].'<br />';
						$select8=$select8.$select_actual8;
						}
						else if ($row8["pas_id"]==$pas2)
						{
						
						$select_actual8='<input type="checkbox" name="pas'.($cont+1).'" id="pas'.($cont+1).'" checked="yes" value="'.$row8["pas_id"].'" />'.$row8["pas_nombre"].'/'.$row8["pas_descripcion"].'/'.$row8["pas_costo"].'<br />';
						$select8=$select8.$select_actual8;
						}
						else if ($row8["pas_id"]==$pas3)
						{
						
						$select_actual8='<input type="checkbox" name="pas'.($cont+1).'" id="pas'.($cont+1).'" checked="yes" value="'.$row8["pas_id"].'" />'.$row8["pas_nombre"].'/'.$row8["pas_descripcion"].'/'.$row8["pas_costo"].'<br />';
						$select8=$select8.$select_actual8;
						}
						else if ($row8["pas_id"]==$pas4)
						{
						
						$select_actual8='<input type="checkbox" name="pas'.($cont+1).'" id="pas'.($cont+1).'" checked="yes" value="'.$row8["pas_id"].'" />'.$row8["pas_nombre"].'/'.$row8["pas_descripcion"].'/'.$row8["pas_costo"].'<br />';
						$select8=$select8.$select_actual8;
						}
						else if ($row8["pas_id"]==$pas5)
						{
						
						$select_actual8='<input type="checkbox" name="pas'.($cont+1).'" id="pas'.($cont+1).'" checked="yes" value="'.$row8["pas_id"].'" />'.$row8["pas_nombre"].'/'.$row8["pas_descripcion"].'/'.$row8["pas_costo"].'<br />';
						$select8=$select8.$select_actual8;
						}
						else if ($row8["pas_id"]==$pas6)
						{
						
						$select_actual8='<input type="checkbox" name="pas'.($cont+1).'" id="pas'.($cont+1).'" checked="yes" value="'.$row8["pas_id"].'" />'.$row8["pas_nombre"].'/'.$row8["pas_descripcion"].'/'.$row8["pas_costo"].'<br />';
						$select8=$select8.$select_actual8;
						}
						else if ($row8["pas_id"]==$pas7)
						{
						
						$select_actual8='<input type="checkbox" name="pas'.($cont+1).'" id="pas'.($cont+1).'" checked="yes" value="'.$row8["pas_id"].'" />'.$row8["pas_nombre"].'/'.$row8["pas_descripcion"].'/'.$row8["pas_costo"].'<br />';
						$select8=$select8.$select_actual8;
						}
						else if ($row8["pas_id"]==$pas8)
						{
						
						$select_actual8='<input type="checkbox" name="pas'.($cont+1).'" id="pas'.($cont+1).'"checked="yes"  value="'.$row8["pas_id"].'" />'.$row8["pas_nombre"].'/'.$row8["pas_descripcion"].'/'.$row8["pas_costo"].'<br />';
						$select8=$select8.$select_actual8;
						}
						else if ($pas0)
						{
						echo "a";
						$select_actual8='<input type="checkbox" name="pas0" id="pas0"  checked= "yes" value="a" />Ningun paseo<br />';
						$select8=$select_actual8;
						}
						
						
						//$select8=$select8.$select_actual8;
						
						
			
						$cont=$cont+1;
		
						
				}
						$panelcuentas->add("paseos",$select8.'</td></tr>');
						
						
						$panelcuentas->add("tipov",'<tr>
      <td>Tipo de viaje:</td>
      <td><select name="tipoviaje" id="tipoviaje" onChange= "populate6(document.form1.mivariable.value)">
         <option>Seleccione</option>
        <option>Solamente Ida</option>
        <option>Ida y vuelta</option>
      </select>      </td>
    </tr>');
						
						
						
						
						
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
	  
	  
	  $costo_total=0;
						
						$res5= mysql_query("SELECT c.cos_costo FROM  costo c WHERE c.fk_via_origen=$combotra AND c.fk_via_destino=$combotra1");
						$ro5 = mysql_fetch_array($res5);
						$costo_via=$ro5['cos_costo'];
						//echo($costo_via);
						
						$res6=mysql_query("SELECT hab_costo FROM  habitacion h  where h.fk_hot_id=$hotel AND h.hab_id=$habitacion");
						$ro6 = mysql_fetch_array($res6);
						$costo_hab=$ro6['hab_costo'];
						//echo($costo_hab);
						$costo_ser=0;
						if ($servicio!="z"){
						$res7=mysql_query("SELECT ser_costo FROM  servicio s, hot_ser hs  where hs.fk_hot_id=$hotel AND hs.fk_ser_id=s.ser_id AND s.ser_id=$servicio");
						$ro7 = mysql_fetch_array($res7);
						$costo_ser=$ro7['ser_costo'];}
						//echo($costo_ser);
						$costo_pas1=0;
						$costo_pas3=0;
						$costo_pas5=0;
						$costo_pas7=0;
						$costo_pas9=0;
						
						if ($pas1){
						$res8=mysql_query("SELECT pas_costo FROM  paseo p, hot_pas hp  where hp.fk_hot_id=$hotel AND hp.fk_pas_id=p.pas_id AND p.pas_id=$pas1");
						$ro8 = mysql_fetch_array($res8);
						$costo_pas=$ro8['pas_costo'];
						
						$costo_pas1=$costo_pas*$cant1;}
						
						if ($pas2){
						$res9=mysql_query("SELECT pas_costo FROM  paseo p, hot_pas hp  where hp.fk_hot_id=$hotel AND hp.fk_pas_id=p.pas_id AND p.pas_id=$pas2");
						$ro9 = mysql_fetch_array($res9);
						$costo_pas2=$ro9['pas_costo'];
						
						$costo_pas3=$costo_pas2*$cant1;}
		
						//echo("$costo_pas3 costo paseo2" );
						
						if ($pas3){
						$res11=mysql_query("SELECT pas_costo FROM  paseo p, hot_pas hp  where hp.fk_hot_id=$hotel AND hp.fk_pas_id=p.pas_id AND p.pas_id=$pas3");
						$ro11 = mysql_fetch_array($res11);
						$costo_pas4=$ro11['pas_costo'];
						
						$costo_pas5=$costo_pas4*$cant1;}
						
						if ($pas4){
						$res12=mysql_query("SELECT pas_costo FROM  paseo p, hot_pas hp  where hp.fk_hot_id=$hotel AND hp.fk_pas_id=p.pas_id AND p.pas_id=$pas4");
						$ro12 = mysql_fetch_array($res12);
						$costo_pas6=$ro12['pas_costo'];
						
						$costo_pas7=$costo_pas6*$cant1;}
						
						if ($pas5){
						$res13=mysql_query("SELECT pas_costo FROM  paseo p, hot_pas hp  where hp.fk_hot_id=$hotel AND hp.fk_pas_id=p.pas_id AND p.pas_id=$pas5");
						$ro13 = mysql_fetch_array($res13);
						$costo_pas8=$ro13['pas_costo'];
						
						$costo_pas9=$costo_pas8*$cant1;}
						
						
						if($tipoviaje=="Ida y vuelta")
						{
						$costo_total=($costo_total+$costo_via+$costo_hab+$costo_ser+$costo_pas1+$costo_pas3+$costo_pas5+$costo_pas7+$costo_pas9)*$cant1*2;}
						else{
						$costo_total=($costo_total+$costo_via+$costo_hab+$costo_ser+$costo_pas1+$costo_pas3+$costo_pas5+$costo_pas7+$costo_pas9)*$cant1; }
						
						
						//echo($costo_total);
						//$panelcuentas->add("totaltodo",$costo_total);
							
							$panelcuentas->add("monto1",'<tr>
      <td width="203">Total Presupuesto(BsF):</td>
      <td width="202"><input type="text" name="total" id="total" value="'.$costo_total.'" readonly></td>
    </tr>');	
								

	   
						$panelcuentas->add("pregunta",' <tr> <td>Este es su ultimo destino?</td><td><select name="pregunta" id="pregunta">
        <option>Seleccione</option>
		<option>Si</option>
        <option>No</option>
      </select>      </td></tr>');

	  
	  

						       
						
							 
							  }
							  
							  
							  
							  
							
						
							}		  
			
				  
				  
				  
				 if ($mivariable && $fecha && ($combo=='Maritimo') && $combotra && $cant1 && $combotra1 && $hotel && $servicio && $tipoviaje )
						{
					
							  if ($combo=='Maritimo')
							  {
							//echo("yentra1");
							$panelcuentas->add("fecha",$fecha);
					   
				       if ("Aereo"==$combo)
							{
									
										$select_actual2='<option selected="selected">Aereo</option><option>Maritimo</option><option>Terrestre</option>'; }	
						     
							 else if ("Maritimo"==$combo){
								 $select_actual2='<option selected="selected">Maritimo</option><option>Aereo</option><option>Terrestre</option>'; }	
								 if ("Terrestre"==$combo)
								 {
									 $select_actual2='<option selected="selected">Terrestre</option><option>Aereo</option><option>Maritimo</option>';
									 }
								 
								 
		                      $select2=$select2.$select_actual2;
							   $panelcuentas->add("combo",' <tr><td>Tipo de Transporte:</td><td><select name="combo" id="combo" onChange="populate(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.mivariable.value)"><option selected="selected">Seleccione</option>'.$select2.'</select></td></tr>');
							    	   $panelcuentas->add("mivariable",$mivariable);  
							 
							 
		$select22='<option>Seleccione</option>';
							  $result22= mysql_query("SELECT v.*, a.cru_nombre, d.des_nombre FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id IS NOT NULL AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL");
								while($row22 = mysql_fetch_array($result22))
								{				
									
									if ($row22["via_id"]==$combotra){
										//echo 'if';
										$select_actual22='<option selected="selected" value="'.$row22["via_id"].'">'.$row22["cru_nombre"]."/".$row22["des_nombre"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual22='<option value="'.$row22["via_id"].'">'.$row22["cru_nombre"]."/".$row22["des_nombre"].'</option>'; 	}	
									$select22=$select22.$select_actual22;
								}
								
								$panelcuentas->add("combotra",' <tr><td>Crucero/Origen:</td><td><select name="combotra" id="combotra" onChange="populate2(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.mivariable.value)">'.$select22.'</td></tr>');
								
								$res=mysql_query("SELECT fk_cru_id FROM  via where via_id=$combotra");
								$ro = mysql_fetch_array($res);
								$devuelve=$ro['fk_cru_id'];	
								
								
								$res1=mysql_query("SELECT fk_des_id FROM  via where via_id=$combotra");
								$ro1 = mysql_fetch_array($res1);
								$devuelve1=$ro1['fk_des_id'];		
					    
						$result12= mysql_query("SELECT v.*, a.cru_nombre, d.des_nombre FROM  via v, crucero a, destino d WHERE v.fk_des_id=d.des_id AND v.fk_cru_id=a.cru_id AND v.fk_cru_id=$devuelve AND v.fk_des_id<>$devuelve1 AND v.fk_cru_id IS NOT NULL AND v.fk_aer_id IS NULL AND v.fk_ter_id IS NULL");
						while($row12 = mysql_fetch_array($result12))
								{	
								$result6= mysql_query("SELECT c.cos_costo FROM  costo c WHERE c.fk_via_origen=$combotra AND c.fk_via_destino=".$row1["via_id"]."");
							 $row6 = mysql_fetch_array($result6);					
									
									if ($row12["via_id"]==$combotra1){
										//echo 'if';
										$select_actual12='<option selected="selected" value="'.$row12["via_id"].'">'.$row12["cru_nombre"]."/".$row12["des_nombre"]."/".$row6["cos_costo"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual12='<option value="'.$row12["via_id"].'">'.$row12["cru_nombre"]."/".$row12["des_nombre"]."/".$row6["cos_costo"].'</option>'; 	}	
									$select12=$select12.$select_actual12;
								}
						$panelcuentas->add("combotra1",' <tr><td>Crucero/Destino:</td><td><select name="combotra1" id="combotra1"onChange="populate3(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.combotra1.options[document.form1.combotra1.selectedIndex].value,document.form1.cant1.options[document.form1.cant1.selectedIndex].value,document.form1.mivariable.value)">'.$select12.'</td></tr>');
						
						$res3=mysql_query("SELECT fk_cru_id FROM  via where via_id=$combotra1");
						$ro3 = mysql_fetch_array($res3);
						$devuelve3=$ro3['fk_cru_id'];	
						//echo "$devuelve3 dev";
						
						
						
						$select4='';	
						$result4= mysql_query("SELECT ho.flo_nombre, ho.flo_id FROM  flota ho WHERE ho.fk_cru_id=$devuelve3");
						while($row4 = mysql_fetch_array($result4))
								{				
									
									if ($row4["flo_id"]==$hotel){
										//echo 'if';
										$select_actual4='<option selected="selected" value="'.$row4["flo_id"].'">'.$row4["flo_nombre"].'</option>';}	
									else{
										//echo "banco es $banco";
										$select_actual4='<option value="'.$row4["flo_id"].'">'.$row4["flo_nombre"].'</option>'; }
						$select4=$select4.$select_actual4;
								}
						
						
						$panelcuentas->add("hoteles",' <tr><td>Barco:</td><td><select name="hotel" id="hotel" onChange="populate4(document.form1,document.form1.fecha.value,document.form1.combo.options[document.form1.combo.selectedIndex].value,document.form1.combotra.options[document.form1.combotra.selectedIndex].value,document.form1.combotra1.options[document.form1.combotra1.selectedIndex].value,document.form1.cant1.options[document.form1.cant1.selectedIndex].value,document.form1.mivariable.value,document.form1.hotel.options[document.form1.hotel.selectedIndex].value)"><option>Seleccione</option>'.$select4.'</td></tr>');
						
						$select5='<tr>
      <td>Habitacion:</td>
      <td><select name="habitacion" id="habitacion"><option value="z">Seleccione</option>';
						$result5= mysql_query("SELECT h.hab_id, h.hab_costo, h.hab_categoria FROM  habitacion h  WHERE h.fk_hot_id=$hotel AND h.hab_status='No ocupada'");
						while($row5 = mysql_fetch_array($result5))
						{
						if ($row5["hab_id"]==$habitacion){
										//echo 'if';
										$select_actual5='<option selected="selected" value="'.$row5["hab_id"].'">'.$row5["hab_id"].' Costo:'.$row5["hab_costo"].' Cat:'.$row5["hab_categoria"].'</option>'; }	
									else{
										//echo "banco es $banco";
										$select_actual5='<option value="'.$row5["hab_id"].'">'.$row5["hab_id"].' Costo:'.$row5["hab_costo"].' Cat:'.$row5["hab_categoria"].'</option>'; 	}	
						$select5=$select5.$select_actual5;
						}
						$panelcuentas->add("habitaciones",$select5.'</td></tr>');
						
						
						$select7='<tr>
      <td>*Servicios:</td>
      <td><select name="servicio" id="servicio"><option value="z">No deseo Servicios</option>';
						$result7= mysql_query("SELECT s.ser_nombre, s.ser_descripcion,s.ser_id,s.ser_costo FROM  servicio s, hot_ser hs WHERE hs.fk_hot_id=$hotel AND hs.fk_ser_id=s.ser_id");
						while($row7 = mysql_fetch_array($result7))
						{
						if ($row7["ser_id"]==$servicio){
										//echo 'if';
										$select_actual7='<option selected="selected" value="'.$row7["ser_id"].'">'.$row7["ser_nombre"].'Descripcion:'.$row7["ser_descripcion"].'/'.$row7["ser_costo"].'</option>'; }	
					
						else{
										//echo "banco es $banco";
										$select_actual7='<option value="'.$row7["ser_id"].'">'.$row7["ser_nombre"].'Descripcion'.$row7["ser_descripcion"].'/'.$row7["ser_costo"].'</option>'; 	}	
						$select7=$select7.$select_actual7;
						}
						if ($servicio=="z"){
						$select7=$select7.'<option selected="selected" value="z">No deseo Servicios</option>';
						}
						else
						{$select7=$select7.'<option value="z">No deseo Servicios</option>';}
						$panelcuentas->add("servicios",$select7.'</td></tr>');
						
						
						
						
						
						$panelcuentas->add("tipov",'<tr>
      <td>Tipo de viaje:</td>
      <td><select name="tipoviaje" id="tipoviaje" onChange= "populate6(document.form1.mivariable.value)">
         <option>Seleccione</option>
        <option>Solamente Ida</option>
        <option>Ida y vuelta</option>
      </select>      </td>
    </tr>');
						
						
						
						
						
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
	  
	  
	  $costo_total=0;
						
						$res5= mysql_query("SELECT c.cos_costo FROM  costo c WHERE c.fk_via_origen=$combotra AND c.fk_via_destino=$combotra1");
						$ro5 = mysql_fetch_array($res5);
						$costo_via=$ro5['cos_costo'];
						//echo($costo_via);
						
						$res6=mysql_query("SELECT hab_costo FROM  habitacion h  where h.fk_hot_id=$hotel AND h.hab_id=$habitacion");
						$ro6 = mysql_fetch_array($res6);
						$costo_hab=$ro6['hab_costo'];
						//echo($costo_hab);
						$costo_ser=0;
						if ($servicio!="z"){
						$res7=mysql_query("SELECT ser_costo FROM  servicio s, hot_ser hs  where hs.fk_hot_id=$hotel AND hs.fk_ser_id=s.ser_id AND s.ser_id=$servicio");
						$ro7 = mysql_fetch_array($res7);
						$costo_ser=$ro7['ser_costo'];}
						//echo($costo_ser);
						$costo_pas1=0;
						$costo_pas3=0;
						$costo_pas5=0;
						$costo_pas7=0;
						$costo_pas9=0;
						
						
						
						
						if($tipoviaje=="Ida y vuelta")
						{
						$costo_total=($costo_total+$costo_via+$costo_hab+$costo_ser+$costo_pas1+$costo_pas3+$costo_pas5+$costo_pas7+$costo_pas9)*$cant1*2;}
						else{
						$costo_total=($costo_total+$costo_via+$costo_hab+$costo_ser+$costo_pas1+$costo_pas3+$costo_pas5+$costo_pas7+$costo_pas9)*$cant1; }
						
						
						//echo($costo_total);
						//$panelcuentas->add("totaltodo",$costo_total);
							
							$panelcuentas->add("monto1",'<tr>
      <td width="203">Total Presupuesto(BsF):</td>
      <td width="202"><input type="text" name="total" id="total" value="'.$costo_total.'" readonly></td>
    </tr>');	
								

	   
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