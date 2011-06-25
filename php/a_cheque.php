<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(10)" >');
	
	$panelcuentas = new Panel("../html/a_general_cheque.html");
	$panelcuentas->add("crear",'<a href="../php/a_crear_cheque.php">Crear Cheque</a>');
	
	
	$mensaje = $_REQUEST['mensaje'];
	if($mensaje==3)
	{
		$panelcuentas->add("error",'Ya existe ese Numero ');
	}
	else if($mensaje==2)
	{
		$panelcuentas->add("error",'Cambios Realizados');
	}
	$result= mysql_query("SELECT t. * , b.ban_nombre, b.ban_id, p.per_nombre1, p.per_apellido1 FROM persona p, banco b, cheque t WHERE t.fk_per_cedula = p.per_cedula AND t.fk_ban_id = b.ban_id");
		
	while($row = mysql_fetch_array($result))
	{

	$tabla='
    <tr align="center">
      <td width="49" height="21">'.$row["che_id"].'</td>
	  <td width="123"><div align="center">'.$row["che_num"].'</td>
	  <td width="129"><div align="center">'.$row["che_cuenta"].'</td>
	  <td width="160"><div align="center">'.$row["che_nombre"].'</td>
	   <td width="136"><div align="center">'.$row["che_fechaven"].'</td>
	   <td width="136"><div align="center">'.$row["ban_nombre"].'</td>
	   <td width="136"><div align="center">'.$row["per_apellido1"].", ".$row["per_nombre1"].'</td>
	  <td width="200"><a href="../php/a_editar_cheque.php?numero='.$row['che_num'].'&id='.$row['che_id'].'&cuenta='.$row['che_cuenta'].'&nombre='.$row['che_nombre'].'&fecha='.$row['che_fechaven'].'&cedula='.$row['fk_per_cedula'].'&ban='.$row['ban_id'].'">Modificar</a> <a href="../php/a_eliminar_cheque.php?cue_id='.$row["che_id"].'" onclick="return confirmar()">Eliminar</a></td>
    </tr>';
	
	
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	
	
	mysql_free_result($result);	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>