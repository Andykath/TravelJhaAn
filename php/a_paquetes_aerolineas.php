<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(8)" >');
	
	$panelcuentas = new Panel("../html/a_general_paquetes_aerolineas.html");
	$panelcuentas->add("crear",'<a href="../php/a_crear_paquete_aerolinea.php">Crear Paquete </a>');
	//$panelcuentas->add("crear2",'<a href="../php/a_flotas_aerolineas.php">Gestionar Flotas</a>');
	//$panelcuentas->add("crear4",'<a href="../php/a_costos_aerolineas.php">Gestionar Costos</a>');
	$tabla_completa="";
	
	$mensaje = $_REQUEST['mensaje'];

	$result= mysql_query("SELECT v.* ,d.des_nombre, o.des_nombre, a.aer_nombre, a.aer_id
FROM viaje v, via i, via f, destino d, destino o, aerolinea a WHERE v.fk_via_id_origen = i.via_id AND v.fk_via_id_destino = f.via_id AND i.fk_des_id = d.des_id AND f.fk_des_id = o.des_id and i.fk_aer_id=a.aer_id
and v.via_tipo='Paquete' ORDER BY v.via_id");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	
	while($row = mysql_fetch_array($result))
	{
	//echo("entra");
	$tabla='
    <tr align="center">
      <td width="81" height="21">'.$row["via_id"].'</td>
	   <td width="306"><div align="center">'.$row["via_cant_per"].'</td>
	  <td width="200"><a href="../php/a_verperfil_paquete_aerolinea.php?tipoviaje='.$row['via_tipoviaje'].'&id='.$row['via_id'].'&fechai='.$row['via_fecha_ini'].'&fechaf='.$row['via_fecha_fin'].'&millas='.$row['via_millas'].'&tipopaq='.$row['via_tipo_paq'].'&cantpaq='.$row['via_cant_per'].'&aernombre='.$row['aer_nombre'].'&aerid='.$row['aer_id'].'&fkvia='.$row['fk_via_id_origen'].'&fkvia2='.$row['fk_via_id_destino'].'">Ver mas</a>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>