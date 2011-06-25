<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	extract($_POST);
	extract($_GET);
	$admin= new Panel("../html/usuario.html");
	
	$admin->add("body",'<body onLoad = "actual(5)" >');
	
	$panelcuentas = new Panel("../html/a_paseo_hotel.html");
	
	$tabla_completa="";
	
	$mensaje = $_REQUEST['mensaje'];
	if($mensaje==3)
	{
								$panelcuentas->add("error",'');
	}
	
	$result= mysql_query("SELECT p.pas_id, p.pas_nombre, p.pas_descripcion, p.pas_costo, h.hot_id FROM paseo p, hot_pas h WHERE h.fk_hot_id=$cue_id AND h.fk_pas_id=p.pas_id ORDER BY p.pas_id");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	
	while($row = mysql_fetch_array($result))
	{
	
	$tabla='
    <tr align="center">
      <td width="120" height="21">'.$row["pas_id"].'</td>
	  <td width="163"><div align="center">'.$row["pas_nombre"].'</td>
	  <td width="211"><div align="center">'.$row["pas_descripcion"].'</td>
	  <td width="175"><div align="center">'.$row["pas_costo"].'</td>
	 
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>