<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(8)" >');
	
	$panelcuentas = new Panel("../html/a_general_promociones_estadia_cruceros.html");
	$panelcuentas->add("crear",'<a href="../php/a_crear_promocion_estadia_crucero.php">Crear Promocion </a>');
	//$panelcuentas->add("crear2",'<a href="../php/a_flotas_aerolineas.php">Gestionar Flotas</a>');
	//$panelcuentas->add("crear4",'<a href="../php/a_costos_aerolineas.php">Gestionar Costos</a>');
	$tabla_completa="";
	
	$mensaje = $_REQUEST['mensaje'];

	$result= mysql_query("SELECT p.pro_nombre, p.pro_id, p.fk_hab_id, p.pro_descuento, p.pro_fechaini, p.pro_fechafin, p.fk_via_id, p.pro_durac_viaje, d.des_nombre, a.cru_nombre, a.cru_id, v.via_id
FROM promocion p, via v, destino d, crucero a
WHERE p.fk_via_id = v.via_id
AND v.fk_des_id = d.des_id
AND v.fk_cru_id = a.cru_id
AND v.fk_aer_id IS NULL 
AND v.fk_ter_id IS NULL 
AND p.fk_hab_id IS NOT NULL 
ORDER BY p.pro_id");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	
	while($row = mysql_fetch_array($result))
	{
	//echo("entra");
	$tabla='
    <tr align="center">
      <td width="81" height="21">'.$row["pro_id"].'</td>
	   <td width="306"><div align="center">'.$row["pro_nombre"].'</td>
	  <td width="200"><a href="../php/a_verperfil_promocion_estadia_crucero.php?nombrepro='.$row['pro_nombre'].'&id='.$row['pro_id'].'&fechai='.$row['pro_fechaini'].'&fechaf='.$row['pro_fechafin'].'&descuento='.$row['pro_descuento'].'&duracion='.$row['pro_durac_viaje'].'&aernombre='.$row['flo_nombre'].'&aerid='.$row['flo_id'].'&fkvia='.$row['des_nombre'].'&fkhab='.$row['fk_hab_id'].'&fkviaid='.$row['via_id'].'&aernombre1='.$row['cru_nombre'].'&aerid1='.$row['cru_id'].'">Ver mas</a>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>