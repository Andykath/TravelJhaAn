<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(10)" >');
	
	$panelcuentas = new Panel("../html/a_general_milla.html");
	$panelcuentas->add("crear",'<a href="../php/a_crear_milla.php">Crear Milla</a>');
	
	
	$mensaje = $_REQUEST['mensaje'];
	
	if($mensaje==2)
	{
		$panelcuentas->add("error",'Cambios Realizados');
	}
	$result= mysql_query("SELECT t. *, p.per_cedula, p.per_nombre1, p.per_apellido1 FROM persona p,  milla t WHERE t.fk_per_cedula = p.per_cedula");
		
	while($row = mysql_fetch_array($result))
	{

	$tabla='
    <tr align="center">
      <td width="49" height="21">'.$row["mil_id"].'</td>
	  <td width="136"><div align="center">'.$row["per_cedula"]." - ".$row["per_apellido1"].", ".$row["per_nombre1"].'</td>
	  <td width="200"><a href="../php/a_editar_milla.php?cedula='.$row['per_cedula'].'&id='.$row['mil_id'].'">Modificar</a> <a href="../php/a_eliminar_milla.php?cue_id='.$row["mil_id"].'" onclick="return confirmar()">Eliminar</a></td>
    </tr>';
	
	
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	
	
	mysql_free_result($result);	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>