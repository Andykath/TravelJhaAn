<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
		
	$cedula=$_SESSION['cedula'];
	$cedulaaux=$_SESSION['cedulaaux'];
	$res5=mysql_query("SELECT MAX(pre_paseo) AS max  FROM  presupuesto");
								$ro5 = mysql_fetch_array($res5);
		          				$devuelve5=$ro5['max'];
								
								//echo($devuelve5);	
								 
    global $mivariable;
	$mivariable=$devuelve5;
	if(!(isset($_GET['pregunta'])))
	{
	$mivariable=$mivariable+1;
	}
	if($_GET['pregunta']=='Si')
	{
	$mivariable=$mivariable+1;
	}
	
	$admin= new Panel("../html/usuario.html");
	
	$admin->add("body",'<body onLoad = "actual(3)" >');
	
	$panelcuentas = new Panel("../html/u_viaje_multi_conestadia.html");

	
	$result= mysql_query("SELECT v.via_id, v.via_tipoviaje, v.via_fecha_ini, v.via_fecha_fin, v.via_hora_ini, v.via_hora_fin, v.via_cant_per,v.fk_via_id_origen,v.fk_via_id_destino,v.via_compuesto,p.pre_paseo FROM  viaje v, presupuesto p  WHERE  p.fk_per_cedula='$cedula' AND v.fk_pre_id=p.pre_id  and v.via_tipo='Viaje' and p.pre_habitacion is not null and p.pre_paseo is not null ORDER BY p.pre_paseo");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	
	while($row = mysql_fetch_array($result))
	{
	
	$tabla='
    <tr align="center">
      <td width="81" height="21">'.$row[10].'</td>
	   <td width="81" height="21">'.$row["via_id"].'</td>
	  <td width="306"><div align="center">'.$row["via_tipoviaje"].'</td>
      <td width="210"><div align="center">'.$row["via_fecha_ini"].'</td>
	  <td width="210"><div align="center">'.$row["via_fecha_fin"].'</td>
	  <td width="210"><div align="center">'.$row["via_hora_ini"].'</td>
	  <td width="210"><div align="center">'.$row["via_hora_fin"].'</td>
	      <td width="210"><div align="center">'.$row["via_cant_per"].'</td>
				<td width="210"><div align="center">'.$row["fk_via_id_origen"].'</td>
                <td width="210"><div align="center">'.$row["fk_via_id_destino"].'</td>		
    </tr>';
	    
		$tabla_completa= $tabla_completa.$tabla;
		//$_SESSION['cant']=$row['pre_cant_per'];
	
	}
	
	
	mysql_free_result($result);
	//echo($cant);
	
	
	

	


	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>