<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(10)" >');
	
	$panelcuentas = new Panel("../html/a_general_tarjeta.html");
	$panelcuentas->add("crear",'<a href="../php/a_crear_tarjeta.php">Crear Tarjeta</a>');
	
	
	$mensaje = $_REQUEST['mensaje'];
	if($mensaje==3)
	{
		$panelcuentas->add("error",'Ya existe ese Numero ');
	}
	else if($mensaje==2)
	{
		$panelcuentas->add("error",'Cambios Realizados');
	}
	$result= mysql_query("SELECT t. * , b.ban_nombre, b.ban_id, p.per_nombre1, p.per_apellido1 FROM persona p, banco b, tarjeta t WHERE t.fk_per_cedula = p.per_cedula AND t.fk_ban_id = b.ban_id");
		
	while($row = mysql_fetch_array($result))
	{

	$tabla='
    <tr align="center">
      <td width="49" height="21">'.$row["tar_id"].'</td>
	  <td width="123"><div align="center">'.$row["tar_num"].'</td>
	  <td width="129"><div align="center">'.$row["tar_cvv2"].'</td>
	  <td width="160"><div align="center">'.$row["tar_nombre"].'</td>
	   <td width="136"><div align="center">'.$row["tar_fechaven"].'</td>
	   <td width="136"><div align="center">'.$row["ban_nombre"].'</td>
	   <td width="136"><div align="center">'.$row["per_apellido1"].", ".$row["per_nombre1"].'</td>
	  <td width="200"><a href="../php/a_editar_tarjeta.php?numero='.$row['tar_num'].'&id='.$row['tar_id'].'&cvv2='.$row['tar_cvv2'].'&nombrede='.$row['tar_nombre'].'&fecha='.$row['tar_fechaven'].'&cedula='.$row['fk_per_cedula'].'&ban='.$row['ban_id'].'">Modificar</a> <a href="../php/a_eliminar_tarjeta.php?cue_id='.$row["tar_id"].'" onclick="return confirmar()">Eliminar</a></td>
    </tr>';
	
	
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	
	
	mysql_free_result($result);	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>