<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	extract($_GET);
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(15)" >');
	
	$panelcuentas = new Panel("../html/a_rutas.html");
	$panelcuentas->add("crear",'<a href="../php/a_crear_ruta.php?cru_id='.$cru_id.'">Crear Ruta</a>');
	$tabla_completa="";
	
	
	$result= mysql_query("SELECT r. * , ru. * , d. * , f. * , o. * 
FROM ruta r, ruta ru, flota f, destino d, destino o
WHERE r.fk_flo_id
IN (
SELECT flo_id
FROM flota
WHERE fk_cru_id =$cru_id
)
AND ru.fk_flo_id
IN (
SELECT flo_id
FROM flota
WHERE fk_cru_id =$cru_id
)
AND r.rut_tipo =  'Origen'
AND ru.rut_tipo =  'Destino'
AND d.des_id = ru.fk_des_id
AND o.des_id = r.fk_des_id
AND r.fk_flo_id = f.flo_id
AND ru.fk_flo_id = f.flo_id
");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	
	while($row = mysql_fetch_array($result))
	{
	
	$tabla='
    <tr align="center">
      <td width="329" height="21">'.$row[26].'</td>
	  <td width="295"><div align="center">'.$row[13].'</td>
	  <td width="294"><div align="center">'.$row[18].'</td>
	  <td width="200"><a href="../php/a_paradas.php?flo_id='.$row['flo_id'].'&cru_id='.$cru_id.'">Paradas</a> <a href="../php/a_eliminar_ruta.php?flo_id='.$row['flo_id'].'&cru_id='.$cru_id.'" onclick="return confirmar()">Eliminar</a> </td>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>