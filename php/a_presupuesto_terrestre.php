<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(13)" >');
	
	$panelcuentas = new Panel("../html/a_general_presupuesto_terrestre.html");
	//$panelcuentas->add("crear",'<a href="../php/a_crear_presupuesto.php">Crear Presupuesto</a>');
	
	
	$mensaje = $_REQUEST['mensaje'];
	
	if($mensaje==2)
	{
		$panelcuentas->add("error",'Cambios Realizados');
	}
	$presu= mysql_query("SELECT p. *  FROM presupuesto p WHERE p.pre_id IN (SELECT p.pre_id FROM servicio s, via v, terrestre e WHERE p.fk_via_id_origen = v.via_id AND p.pre_servicio = s.ser_id AND v.fk_ter_id = e.ter_id ORDER BY pre_id) OR p.pre_id IN (SELECT p.pre_id
FROM via v, terrestre e WHERE p.fk_via_id_origen = v.via_id AND p.pre_servicio IS NULL AND v.fk_ter_id = e.ter_id ORDER BY pre_id)");
		
	while($row = mysql_fetch_array($presu))
	{
	$id=$row['pre_id'];
	
	if ($row['pre_habitacion']==NULL){
	$hot="No tiene";
	//echo "hab".$row['pre_habitacion'];
	}
	else
	{
		$hab=$row['pre_habitacion'];
		//echo $hab;
		$hotel= mysql_query("SELECT h.hot_nombre, h.hot_id, a.hab_id, a.hab_costo FROM hotel h, habitacion a, presupuesto p where a.fk_hot_id=h.hot_id and  a.hab_id='$hab' and p.pre_id='$id'");
		$row2 = mysql_fetch_array($hotel);
		$hot=$row2["hot_nombre"].', #Habitacion: '.$row2["hab_id"];
	}
	
	$origen= mysql_query("SELECT d.des_nombre as pais, o.des_nombre as ciudad FROM destino d, destino o, via v, presupuesto p where p.fk_via_id_origen=v.via_id and v.fk_des_id=o.des_id and o.fk_des_id=d.des_id and  p.pre_id='$id'");
	$row3 = mysql_fetch_array($origen);
	$destino= mysql_query("SELECT d.des_nombre as pais, o.des_nombre as ciudad, a.ter_nombre FROM terrestre a, destino d, destino o, via v, presupuesto p where p.fk_via_id_destino=v.via_id and v.fk_des_id=o.des_id and o.fk_des_id=d.des_id and   p.pre_id='$id'");
	$row4 = mysql_fetch_array($destino);
	if ($row["pre_servicio"]==NULL){
	$servicio="No tiene";}
	else{
		$ser=mysql_query("SELECT s.ser_nombre, s.ser_id FROM servicio s, presupuesto p WHERE p.pre_servicio = s.ser_id AND p.pre_id ='$id'");
	$row5 = mysql_fetch_array($ser);
	$servicio=$row5["ser_nombre"];
	$ser_id=$row5["ser_id"];
	//echo $servicio;
	}
	$tabla='
    <tr align="center">
	  <td width="144"><div align="center">'.$row["pre_fecha"].'</td>
	  <td width="107"><div align="center">'.$servicio.'</td>
	  <td width="106"><div align="center"><a href="../php/a_ver_paseos.php?id='.$row['pre_id'].'">Ver</a></td>
	  <td width="119"><div align="center">'.$hot.'</td>
	  <td width="96"><div align="center">'.$row3["ciudad"].', '.$row3["pais"].'</td>
	   <td width="96"><div align="center">'.$row4["ciudad"].', '.$row4["pais"].'</td>
	   <td width="93"><div align="center">'.$row["pre_status"].'</td>
	    <td width="67"><div align="center">'.$row["pre_cant_per"].'</td>
		 <td width="79"><div align="center">'.$row["pre_total"].'</td>
	  <td width="200"><a href="../php/a_editar_presupuesto_terrestre.php?descripcion='.$row['pre_fecha'].'&id='.$row['pre_id'].'&servicio='.$ser_id.'&hotel='.$row2['hot_id'].'&habitacion='.$row2["hab_id"].'&origen='.$row3['ter_nombre'].'&via='.$row['fk_via_id_origen'].'&destino='.$row['fk_via_id_destino'].'&total='.$row['pre_total'].'&mensaje=1'.'">Modificar</a> <a href="../php/a_eliminar_presupuesto_terrestre.php?cue_id='.$row["pre_id"].'" onclick="return confirmar()">Eliminar</a></td>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	//}
	}
	
	mysql_free_result($presu);	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>