<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(16)" >');
	
	$panelcuentas = new Panel("../html/a_pagos_aereo.html");
	$panelcuentas->add("crear",'<a href="../php/a_crear_pago_aereo.php?mensaje=1">Crear Pago</a>');
	
	
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
	$result= mysql_query("SELECT * from pago");
		
	while($row = mysql_fetch_array($result))
	{
	
	$tabla='
    <tr align="center">
      <td width="295" height="21">'.$row["pag_id"].'</td>
	  <td width="316"><div align="center">'.$row["pag_fecha"].'</td>
	  <td width="307"><div align="center">'.$row["pag_monto"].'</td>
	  
	  <td width="200"><a href="../php/a_eliminar_pago_aereo.php?cue_id='.$row["pag_id"].'" onclick="return confirmar()">Eliminar</a></td>
    </tr>';
	
	
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	
	
	mysql_free_result($result);	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>