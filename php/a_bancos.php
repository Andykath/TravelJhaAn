<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(11)" >');
	
	$panelbancos = new Panel("../html/a_bancos.html");
	$panelbancos->add("crear",'<a href="../php/a_crearbanco.php">Crear Banco</a>');
	$tabla_completa="";
	
	$result=mysql_query("SELECT ban_id,ban_nombre FROM banco");
	
	while($row = mysql_fetch_array($result))
	{
	
	$tabla='
    <tr align="center">
      <td width="283" height="21">'.$row["ban_id"].'</td>
      <td width="433"><div align="center">'.$row["ban_nombre"].'</td>
	  <td width="200"><a href="../php/a_modificarbanco.php?ban_id='.$row["ban_id"].'&nombre='.$row["ban_nombre"].'">Modificar</a> <a href="../php/a_eliminarbanco.php?ban_id='.$row["ban_id"].'" onclick="return confirmar()">Eliminar</a></td>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	
	
	$panelbancos->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelbancos);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>