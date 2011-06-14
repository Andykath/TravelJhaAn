<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(10)" >');
	
	$panelcuentas = new Panel("../html/a_general_deposito.html");
	$panelcuentas->add("crear",'<a href="../php/a_crear_deposito.php">Crear Deposito</a>');
	
	
	$mensaje = $_REQUEST['mensaje'];
	if($mensaje==3)
	{
		$panelcuentas->add("error",'Ya existe ese Numero ');
	}
	else if($mensaje==2)
	{
		$panelcuentas->add("error",'Cambios Realizados');
	}
	$result= mysql_query("SELECT d. * , b.ban_nombre, b.ban_id, p.per_nombre1, p.per_apellido1 FROM persona p, banco b, deposito d WHERE d.fk_per_cedula = p.per_cedula AND d.fk_ban_id = b.ban_id ORDER BY dep_id");
		
	while($row = mysql_fetch_array($result))
	{

	$tabla='
    <tr align="center">
      <td width="49" height="21">'.$row["dep_id"].'</td>
	  <td width="123"><div align="center">'.$row["dep_numero"].'</td>
	  <td width="129"><div align="center">'.$row["dep_cuenta"].'</td>
	   <td width="136"><div align="center">'.$row["dep_fecha"].'</td>
	   <td width="136"><div align="center">'.$row["ban_nombre"].'</td>
	   <td width="136"><div align="center">'.$row["per_apellido1"].", ".$row["per_nombre1"].'</td>
	  <td width="200"><a href="../php/a_editar_deposito.php?numero='.$row['dep_numero'].'&id='.$row['dep_id'].'&cuenta='.$row['dep_cuenta'].'&fecha='.$row['dep_fecha'].'&cedula='.$row['fk_per_cedula'].'&ban='.$row['ban_id'].'">Modificar</a> <a href="../php/a_eliminar_deposito.php?cue_id='.$row["dep_id"].'" onclick="return confirmar()">Eliminar</a></td>
    </tr>';
	
	
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	
	
	mysql_free_result($result);	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>