<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	extract($_GET);
	$admin= new Panel("../html/usuario.html");
	
	$admin->add("body",'<body onLoad = "actual(3)" >');
	
	$panelcuentas = new Panel("../html/u_ver_hoteles.html");
	
	$tabla_completa="";
	
	
	$result= mysql_query("SELECT h.hot_id,h.hot_nombre,h.hot_estrellas,h.hot_telefono,h.fk_des_id, d.des_nombre, d.des_id FROM hotel h, destino d where h.fk_des_id = d.des_id and h.fk_des_id IN (select des_id from destino where fk_des_id=$des_id) ORDER BY hot_id");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	
	while($row = mysql_fetch_array($result))
	{
	
	$tabla='
    <tr align="center">
      <td width="81" height="21">'.$row["hot_id"].'</td>
	  <td width="255"><div align="center">'.$row["hot_nombre"].'</td>
	  <td width="183"><div align="center">'.$row["hot_estrellas"].'</td>
	  <td width="181"><div align="center">'.$row["hot_telefono"].'</td>
      <td width="185"><div align="center">'.$row["des_nombre"].'</td>
	  <td width="500"><a href="../php/u_habitacioneshotel.php?cue_id='.$row["hot_id"].'">Habitaciones</a>    <a href="../php/u_servicios_hoteles.php?cue_id='.$row["hot_id"].'">Servicios</a>    <a href="../php/u_paseos_hoteles.php?cue_id='.$row["hot_id"].'">Paseos</a></td>
	  
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>