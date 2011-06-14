<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/usuario.html");
	
	$admin->add("body",'<body onLoad = "actual(3)" >');
	
	$panelcuentas = new Panel("../html/u_verpaseo_undestino_conestadia_terrestre.html");
	//$panelcuentas->add("crear",'<a href="../php/a_.php">Crear Cuenta</a>');
	$tabla_completa="";
	extract ($_GET);
	$mensaje = $_REQUEST['mensaje'];
	if($mensaje==3)
	{
								$panelcuentas->add("error",'Ese paseo ya existe en ese presupuesto');
	}
	$result= mysql_query("SELECT p.fk_pas_id, pa . * FROM pre_pas p, paseo pa WHERE p.fk_pre_id ='$id' AND pa.pas_id = p.fk_pas_id");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	
	while($row = mysql_fetch_array($result))
	{
	
	$tabla='
    <tr align="center">
      <td width="109" height="21">'.$row["pas_id"].'</td>
	  <td width="284"><div align="center">'.$row["pas_nombre"].'</td>
	  <td width="283"><div align="center">'.$row["pas_descripcion"].'</td>
	  <td width="238"><div align="center">'.$row["pas_costo"].'</td>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>