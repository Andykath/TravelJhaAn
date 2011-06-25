<?php

	session_start();

	$pathFix = dirname(__FILE__);

	require_once ("../classes/Panel.php");

	$login= new Panel("../html/login.html");

	$mensaje = $_REQUEST['mensaje'];
	extract($_GET);

	if($mensaje==1)

	{

	$login->add("mensaje",'Usuario invalido');

	}

	else if($mensaje==2)

	{

	$login->add("mensaje",'Contraseña incorrecta');

	}
	else if($mensaje==10)

	{

	$login->add("mensaje",'Campos incompletos!');

	}
	else if($mensaje==5)

	{

	$login->add("mensaje",'Usuario registrado con exito');

	}

	include "../db/conexion.php";
	$consulta=mysql_query("SELECT des_id, des_nombre FROM destino where fk_des_id IS NULL order by des_id ASC");
	//desconectar();
	$select='';
	// Voy imprimiendo el primer select compuesto por los paises
	
	while($registro=mysql_fetch_row($consulta))
	{
		$select_actual="<option value='".$registro[0]."'>".$registro[1]."</option>";
		$select=$select.$select_actual;
	}

	$login->add(pais,$select);
 $login->add("Aqui",'<a href="../php/u_registro.php">AQUI</a>');
 
 $result= mysql_query("SELECT p.pro_nombre, p.pro_descuento,p.pro_fechaini,p.pro_fechafin,p.pro_durac_viaje,h.hot_nombre,a.aer_nombre,d.des_nombre,h.hot_nombre,v.via_costo FROM promocion p, hotel h, aerolinea a, destino d , via v WHERE  p.fk_via_id=v.via_id and v.fk_des_id=d.des_id and v.fk_aer_id=a.aer_id and p.fk_hab_id=h.hot_id ORDER BY v.via_costo");

	
	while($row = mysql_fetch_array($result))
	{
	$des=$row["pro_descuento"]*100;
	$des1=$row["via_costo"];
	$des2=$des1*$des;
	$tabla='
    <tr align="center">
	  <td width="306"><div align="center">'.$row["pro_nombre"].'</td>
	
      <td width="210"><div align="center">'.$row["pro_fechaini"].'</td>
	     <td width="210"><div align="center">'.$row["pro_fechafin"].'</td>
		    <td width="210"><div align="center">'.$row["pro_durac_viaje"].'</td>
			   <td width="210"><div align="center">'.$row["aer_nombre"].'</td>
			      <td width="210"><div align="center">'.$row["des_nombre"].'</td>
				     <td width="210"><div align="center">'.$row["hot_nombre"].'</td>
					   <td width="181"><div align="center">'.$des2."Bs".'</td>
	  </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	
	if($selected)
	{
		
		if($selected=='Solamente Ida')
		{
			if ("Solamente Ida"==$selected)
							{
									
										$select_actual2='<option selected="selected">Solamente Ida</option>'; }	
						     
							 else if ("Ida y vuelta"==$selected){
								 $select_actual2='<option selected="selected">Ida y vuelta</option>'; }	
								 
								 
		                    $select2=$select2.$select_actual2;
						    $login->add("forma",$select2);
					
			
			
			
	$resultk= mysql_query("SELECT des_id,des_nombre FROM  destino WHERE des_descripcion='Ciudad'");
					while($rowk = mysql_fetch_array($resultk))
					{
		
					$select_actualk='<option value="'.$rowk["des_id"].'">'.$rowk["des_nombre"].'</option>'; 		
					
					$selectk=$selectk.$select_actualk;
					}
					
					$login->add("tra",' <tr><td>Tipo de Transporte:</td><td><select name="tra" id="tra" ><option selected="selected">Seleccione</option><option>Aereo</option><option>Maritimo</option><option>Terrestre</option></select></td></tr>');
	
	$login->add("combo",' <tr><td>Origen:</td><td><select name="combo" id="combo" ><option selected="selected">Seleccione</option>'.$selectk.'</select></td></tr>');
	
	$login->add("combo1",' <tr><td>Destino:</td><td><select name="combo1" id="combo1" ><option selected="selected">Seleccione</option>'.$selectk.'</select></td></tr>');
	
	$login->add("fecha",'<tr>
      <td>Fecha de salida:</td>
      <td><input name="fecha" id="fecha" type="text" readonly="readonly" value="{fecha}" ><a href="javascript:NewCssCal(\'fecha\',\'YYYYMMDD\')"><img src="../js/cal.gif" width="16" height="16" border="0" alt="Seleccione una Fecha"></td>
    </tr>');
	$login->add("cantper",'<tr>
     <th width="27%" height="27" align="justify" >Cantidad de Personas:<td><select name="cantper" id="cantper">
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
      </select>      </td>
    </tr>');
	
		}
		else if ($selected=='Ida y vuelta')
		{
			
			if ("Ida y vuelta"==$selected)
							{
									
										$select_actual2='<option selected="selected">Ida y vuelta</option>'; }	
						     
							 else if ("Solamente Ida"==$selected){
								 $select_actual2='<option selected="selected">Solamente Ida</option>'; }	
								 
								 
		                    $select2=$select2.$select_actual2;
						    $login->add("forma",$select2);
			
			
			$resultk= mysql_query("SELECT des_id,des_nombre FROM  destino WHERE des_descripcion='Ciudad'");
					while($rowk = mysql_fetch_array($resultk))
					{
		
					$select_actualk='<option value="'.$rowk["des_id"].'">'.$rowk["des_nombre"].'</option>'; 		
					
					$selectk=$selectk.$select_actualk;
					}
					
					$login->add("tra",' <tr><td>Tipo de Transporte:</td><td><select name="tra" id="tra" ><option selected="selected">Seleccione</option><option>Aereo</option><option>Maritimo</option><option>Terrestre</option></select></td></tr>');
	
	$login->add("combo",' <tr><td>Origen:</td><td><select name="combo" id="combo" ><option selected="selected">Seleccione</option>'.$selectk.'</select></td></tr>');
	
	$login->add("combo1",' <tr><td>Destino:</td><td><select name="combo1" id="combo1" ><option selected="selected">Seleccione</option>'.$selectk.'</select></td></tr>');
	
	$login->add("fecha",'<tr>
      <td>Fecha de ida:</td>
      <td><input name="fecha" id="fecha" type="text" readonly="readonly" value="{fecha}" ><a href="javascript:NewCssCal(\'fecha\',\'YYYYMMDD\')"><img src="../js/cal.gif" width="16" height="16" border="0" alt="Seleccione una Fecha"></td>
    </tr>');
	
	$login->add("fecha1",'<tr>
      <td>Fecha de vuelta:</td>
      <td><input name="fecha1" id="fecha1" type="text" readonly="readonly" value="{fecha1}" ><a href="javascript:NewCssCal(\'fecha1\',\'YYYYMMDD\')"><img src="../js/cal.gif" width="16" height="16" border="0" alt="Seleccione una Fecha"></td>
    </tr>');
	$login->add("cantper",'<tr>
     <th width="27%" height="27" align="justify" >Cantidad de Personas:<td><select name="cantper" id="cantper">
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
      </select>      </td>
    </tr>');
			
			
			
			
			
			
			}
		
	
	}
     $login->add("tipo_boton",'Buscar');
	$login->add("informacion",$tabla_completa);
	
$login->show();
include "../db/cerrar_conexion.php";
?>

	