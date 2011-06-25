<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(10)" >');
	
	$panelcuentas = new Panel("../html/a_boleto_aereo.html");
	$panelcuentas->add("crear",'<a href="../php/a_crear_boleto_maritimo.php?mensaje=1">Crear Boleto</a>');
	
	
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
		$panelcuentas->add("error",'Este viaje ya tiene sus boletos');
	}
	$result= mysql_query("SELECT b. * , v.via_id, v.fk_via_id_origen, v.fk_via_id_destino, e.cru_nombre FROM viaje v, boleto b, via a, crucero e WHERE b.fk_via_id = v.via_id AND a.fk_cru_id = e.cru_id AND v.fk_via_id_origen = a.via_id");
		
	while($row = mysql_fetch_array($result))
	{
	$o=$row["fk_via_id_origen"];
	$id=$row["via_id"];
	$origen=mysql_query("SELECT c.des_id, c.des_nombre as ciudad, p.des_id, p.des_nombre as pais FROM destino c, destino p, via v WHERE v.via_id ='$o' AND v.fk_des_id = c.des_id AND c.fk_des_id = p.des_id");
	$row2 = mysql_fetch_array($origen);
	$d=$row["fk_via_id_destino"];
	$destino=mysql_query("SELECT c.des_id, c.des_nombre as ciudad, p.des_id, p.des_nombre as pais FROM destino c, destino p, via v WHERE v.via_id ='$d' AND v.fk_des_id = c.des_id AND c.fk_des_id = p.des_id");
	$row5 = mysql_fetch_array($destino);
	$bol=$row["bol_id"];
	$cedula=$row["fk_per_cedula"];
	$nombre=mysql_query("SELECT per_nombre1, per_apellido1 from persona where per_cedula='$cedula'");

	
	if ($row["fk_per_cedula"]==NULL )
	{
		//echo "entre2";
		//echo $id;
		$query= mysql_query("SELECT a.*, b.bol_id FROM acompanante a,viaje v, boleto b WHERE a.fk_via_id ='$id' AND a.fk_via_id = v.via_id and b.bol_id='$bol' AND b.fk_via_id = v.via_id and b.fk_aco_id=a.aco_id");
		$row6 = mysql_fetch_array($query);
		$cliente=$row6["aco_cedula"]."-".$row6["aco_nombre"].", ".$row6["aco_apellido"];
	}
	else
	{
		//echo "entre";
		$row4 = mysql_fetch_array($nombre);
		$cliente=$cedula."-".$row4["per_nombre1"].", ".$row4["per_apellido1"];
	}
	$tabla='
    <tr align="center">
      <td width="49" height="21">'.$row["bol_id"].'</td>
	  <td width="123"><div align="center">'.$row["bol_fecha_emi"].'</td>
	  <td width="104"><div align="center">'.$row["via_id"].'</td>
	  <td width="242"><div align="center">'.$cliente.'</td>
	   <td width="136"><div align="center">'.$row["cru_nombre"].'</td>
	   <td width="136"><div align="center">'.$row2["ciudad"].", ".$row2["pais"].'</td>
	   <td width="136"><div align="center">'.$row5["ciudad"].", ".$row5["pais"].'</td>
	  <td width="200"><a href="../php/a_editar_boleto_maritimo.php?id='.$row['bol_id'].'&cliente='.$row['fk_per_cedula'].'&aco='.$row['fk_aco_id'].'&via='.$id.'&mensaje=1">Modificar</a> <a href="../php/a_eliminar_boleto_maritimo.php?cue_id='.$row["bol_id"].'" onclick="return confirmar()">Eliminar</a></td>
    </tr>';
	
	
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	
	
	mysql_free_result($result);	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>