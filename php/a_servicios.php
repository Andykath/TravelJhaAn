<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(6)" >');
	
	$panelcuentas = new Panel("../html/a_general_servicios.html");
	$panelcuentas->add("crear",'<a href="../php/a_crear_servicio.php">Crear Servicio</a>');
	
	
	$mensaje = $_REQUEST['mensaje'];
	if($mensaje==3)
	{
								$panelcuentas->add("error",'Esa aerolinea ya existe en ese pais');
	}
	$result= mysql_query("SELECT s.ser_id,s.ser_nombre,s.ser_descripcion,s.ser_costo FROM servicio s ORDER BY ser_id");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	
	while($row = mysql_fetch_array($result))
	{
	
	$tabla='
    <tr align="center">
      <td width="81" height="21">'.$row["ser_id"].'</td>
	  <td width="306"><div align="center">'.$row["ser_nombre"].'</td>
	  <td width="181"><div align="center">'.$row["ser_descripcion"].'</td>
      <td width="210"><div align="center">'.$row["ser_costo"].'</td>
	  <td width="200"><a href="../php/a_editar_servicio.php?cue_numero='.$row['ser_nombre'].'&id='.$row['ser_id'].'&banco='.$row['ser_descripcion'].'&fecha='.$row['ser_costo'].'">Modificar</a> <a href="../php/a_eliminar_servicio.php?cue_id='.$row["ser_id"].'" onclick="return confirmar()">Eliminar</a></td>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>