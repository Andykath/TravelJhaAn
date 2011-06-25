<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	extract($_GET);
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(15)" >');
	
	$panelcuentas = new Panel("../html/a_paradas.html");
	$panelcuentas->add("crear",'<a href="../php/a_crear_parada.php?flo_id='.$flo_id.'&cru_id='.$cru_id.'">Anadir Parada</a>');
	$tabla_completa="";
	
	
	$result= mysql_query("SELECT r.*, d.* from ruta r, destino d where r.fk_flo_id=$flo_id and r.rut_tipo='Parada'and r.fk_des_id=d.des_id");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	
	while($row = mysql_fetch_array($result))
	{
	
	$tabla='
    <tr align="center">
      <td width="500" height="21">'.$row[7].'</td>
    
	<td width="200"><a href="../php/a_eliminar_parada.php?flo_id='.$flo_id.'&id='.$row[3].'">Eliminar Parada</a> </td>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>