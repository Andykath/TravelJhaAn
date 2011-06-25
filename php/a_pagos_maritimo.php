<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(10)" >');
	
	$panelcuentas = new Panel("../html/a_pagos_maritimo.html");
	$panelcuentas->add("crear",'<a href="../php/a_crear_pago_maritimo.php?mensaje=1">Crear Pago</a>');
	
	
	$mensaje = $_REQUEST['mensaje'];
	if($mensaje==3)
	{
				$panelcuentas->add("error",'Ya existe esa publicidad');
	}
	else if($mensaje==2)
	{
				$panelcuentas->add("error",'Cambios Realizados');
	}
	else if($mensaje==4)
	{
		$panelcuentas->add("error",'El numero de deposito no es valido');
	}
	else if($mensaje==5)
	{
		$panelcuentas->add("error",'El numero de tarjeta no es valido');
	}
	else if($mensaje==6)
	{
		$panelcuentas->add("error",'El numero de cheque no es valido');
	}
	$result= mysql_query("SELECT p. * , v.via_id, v.via_id,   v.fk_via_id_origen, v.fk_via_id_destino, e.cru_nombre FROM viaje v, pago p, via a, crucero e WHERE p.fk_via_id = v.via_id AND a.fk_cru_id = e.cru_id AND v.fk_via_id_origen = a.via_id ");
		
	while($row = mysql_fetch_array($result))
	{
	$o=$row["fk_via_id_origen"];
	$id=$row["via_id"];
	$origen=mysql_query("SELECT c.des_id, c.des_nombre as ciudad, p.des_id, p.des_nombre as pais FROM destino c, destino p, via v WHERE v.via_id ='$o' AND v.fk_des_id = c.des_id AND c.fk_des_id = p.des_id");
	$row2 = mysql_fetch_array($origen);
	$d=$row["fk_via_id_destino"];
	$destino=mysql_query("SELECT c.des_id, c.des_nombre as ciudad, p.des_id, p.des_nombre as pais FROM destino c, destino p, via v WHERE v.via_id ='$d' AND v.fk_des_id = c.des_id AND c.fk_des_id = p.des_id");
	$row5 = mysql_fetch_array($destino);
	
	$nombre=mysql_query("SELECT p.per_nombre1, p.per_apellido1, p.per_cedula FROM persona p, viaje v, pago o, presupuesto e WHERE v.via_id = o.fk_via_id AND v.fk_pre_id = e.pre_id AND e.fk_per_cedula = p.per_cedula AND v.via_id='$id'");
	$row4=mysql_fetch_array($nombre);
		$cliente=$row4["per_cedula"]."-".$row4["per_nombre1"].", ".$row4["per_apellido1"];
	$tabla='
    <tr align="center">
      <td width="49" height="21">'.$row["pag_id"].'</td>
	  <td width="123"><div align="center">'.$row["pag_fecha"].'</td>
	  <td width="104"><div align="center">'.$row["pag_monto"].'</td>
	  <td width="242"><div align="center">'.$cliente.'</td>
	   <td width="136"><div align="center">'.$row["cru_nombre"].'</td>
	   <td width="136"><div align="center">'.$row2["ciudad"].", ".$row2["pais"].'</td>
	   <td width="136"><div align="center">'.$row5["ciudad"].", ".$row5["pais"].'</td>
	  <td width="200"><a href="../php/a_editar_pago_maritimo.php?id='.$row['bol_id'].'&cliente='.$row['fk_per_cedula'].'&aco='.$row['fk_aco_id'].'&via='.$id.'&mensaje=1">Modificar</a> <a href="../php/a_eliminar_pago_maritimo.php?cue_id='.$row["bol_id"].'" onclick="return confirmar()">Eliminar</a></td>
    </tr>';
	
	
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	
	
	mysql_free_result($result);	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>