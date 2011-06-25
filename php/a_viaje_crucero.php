<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(13)" >');
	
	$panelcuentas = new Panel("../html/a_general_viaje_crucero.html");
	//$panelcuentas->add("crear",'<a href="../php/a_crear_presupuesto_aereo.php">Crear Presupuesto</a>');
	
	
	$mensaje = $_REQUEST['mensaje'];
	
	if($mensaje==2)
	{
		$panelcuentas->add("error",'Cambios Realizados');
	}
	$viaje= mysql_query("SELECT v. *  FROM viaje v WHERE v.via_id IN (
SELECT p.via_id FROM crucero a, via v, viaje p WHERE p.fk_via_id_destino = v.via_id AND v.fk_cru_id = a.cru_id and p.via_tipo='Viaje')");
	while($row = mysql_fetch_array($viaje))
	{	
	$id=$row["via_id"];
	$origen= mysql_query("SELECT d.des_nombre as pais, o.des_nombre as ciudad FROM destino d, destino o, via v, viaje p where p.fk_via_id_origen=v.via_id and v.fk_des_id=o.des_id and o.fk_des_id=d.des_id and  p.via_id='$id'");
	$row3 = mysql_fetch_array($origen);
	$destino= mysql_query("SELECT d.des_nombre AS pais, o.des_nombre AS ciudad, a.cru_nombre, a.cru_id FROM crucero a, destino d, destino o, via v, viaje p WHERE p.fk_via_id_destino = v.via_id AND v.fk_des_id = o.des_id AND o.fk_des_id = d.des_id AND p.via_id ='$id' AND v.fk_cru_id=a.cru_id");
	$row4 = mysql_fetch_array($destino);
	
	$tabla='
    <tr align="center">
	  <td width="144"><div align="center">'.$row["via_tipoviaje"].'</td>
	  <td width="107"><div align="center">'.$row["via_fecha_ini"].'</td>
	  <td width="106"><div align="center">'.$row['via_fecha_fin'].'</td>
	  <td width="96"><div align="center">'.$row3["ciudad"].', '.$row3["pais"].'</td>
	   <td width="96"><div align="center">'.$row4["ciudad"].', '.$row4["pais"].'</td>
	   <td width="93"><div align="center">'.$row["via_millas"].'</td>
	    <td width="67"><div align="center">'.$row["via_cant_per"].'</td>
		 <td width="79"><div align="center">'.$row4["cru_nombre"].'</td>
	  <td width="200"><a href="../php/a_editar_viaje_crucero.php?id='.$row['via_id'].'&origen='.$row3['cru_id'].'&via='.$row['fk_via_id_origen'].'&destino='.$row['fk_via_id_destino'].'&fecha_ini='.$row['via_fecha_ini'].'&fecha_fin='.$row['via_fecha_fin'].'&tipo='.$row['via_tipoviaje'].'&mensaje=1'.'&cant='.$row['via_cant_per'].'">Modificar</a> <a href="../php/a_eliminar_viaje_crucero.php?cue_id='.$row["via_id"].'" onclick="return confirmar()">Eliminar</a></td>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	//}
	}
	mysql_free_result($viaje);	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>