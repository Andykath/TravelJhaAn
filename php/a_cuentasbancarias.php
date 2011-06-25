<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(12)" >');
	
	$panelcuentas = new Panel("../html/a_cuentas_bancarias.html");
	$panelcuentas->add("crear",'<a href="../php/a_crear_cuenta.php">Crear Cuenta</a>');
	$tabla_completa="";
	
	$mensaje = $_REQUEST['mensaje'];
	if($mensaje==3)
	{
								$panelcuentas->add("error",'Esa cuenta ya existe en ese banco');
	}
	$result= mysql_query("SELECT c.cue_id,c.cue_numero,c.cue_tipo,c.cue_fecha_apertura,c.fk_ban_id, b.ban_nombre, b.ban_id FROM cuenta_bancaria c LEFT OUTER JOIN banco b ON c.fk_ban_id = b.ban_id ORDER BY cue_id");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	
	while($row = mysql_fetch_array($result))
	{
	
	$tabla='
    <tr align="center">
      <td width="81" height="21">'.$row["cue_id"].'</td>
	  <td width="306"><div align="center">'.$row["cue_numero"].'</td>
	  <td width="132"><div align="center">'.$row["cue_tipo"].'</td>
	  <td width="181"><div align="center">'.$row["cue_fecha_apertura"].'</td>
      <td width="210"><div align="center">'.$row["ban_nombre"].'</td>
	  <td width="200"><a href="../php/a_modificar_cuenta.php?cue_numero='.$row['cue_numero'].'&id='.$row['cue_id'].'&banco='.$row['fk_ban_id'].'&tipo='.$row['cue_tipo'].'&fecha='.$row['cue_fecha_apertura'].'">Modificar</a> <a href="../php/a_eliminarcuenta.php?cue_id='.$row["cue_id"].'" onclick="return confirmar()">Eliminar</a></td>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>