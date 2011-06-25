<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/usuario.html");
	
	$admin->add("body",'<body onLoad = "actual(8)" >');
	
	$panelcuentas = new Panel("../html/u_paquete_sinestadia_terrestre.html");
	
	$mensaje = $_REQUEST['mensaje'];

	$result= mysql_query("SELECT v.via_id,v.via_tipoviaje,v.via_millas,v.via_cant_per,v.fk_via_id_origen,v.fk_via_id_destino,d.des_nombre, o.des_nombre, a.ter_nombre, a.ter_id, v.via_tipo_paq,f.via_costo
FROM viaje v, via i, via f, destino d, destino o, terrestre a WHERE v.fk_via_id_origen = i.via_id AND v.fk_via_id_destino = f.via_id AND i.fk_des_id = d.des_id AND f.fk_des_id = o.des_id and i.fk_ter_id=a.ter_id
and v.via_tipo='Paquete' and v.via_hotel is null ORDER BY v.via_id");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	
	while($row = mysql_fetch_array($result))
	{
		
		
	//echo("entra");
	$tabla='
    <tr align="center">
      <td width="81" height="21">'.$row["via_id"].'</td>
	  <td width="81" height="21">'.$row["via_tipo_paq"].'</td>
	   <td width="306"><div align="center">'.$row["via_tipoviaje"].'</td>
	    <td width="306"><div align="center">'.$row["via_millas"].'</td>
		 <td width="306"><div align="center">'.$row["via_cant_per"].'</td>
		  <td width="306"><div align="center">'.$row["ter_nombre"].'</td>
		   <td width="306"><div align="center">'.$row[4].'</td>
		    <td width="306"><div align="center">'.$row[5].'</td>
		
	  <td width="200"><a href="../php/u_comprar_paquete_sinestadia_terrestre.php?tipoviaje='.$row['via_tipoviaje'].'&id='.$row['via_id'].'&millas='.$row['via_millas'].'&tipopaq='.$row['via_tipo_paq'].'&cantpaq='.$row['via_cant_per'].'&aerolinea='.$row['ter_nombre'].'&aerid='.$row['ter_id'].'&fkvia='.$row['fk_via_id_origen'].'&fkvia2='.$row['fk_via_id_destino'].'&hotel='.$row['hot_nombre'].'&hotid='.$row['hot_id'].'&origen='.$row[6].'&destino='.$row[7].'&cantper='.$row['via_cant_per'].'&viacosto='.$row['via_costo'].'">Comprar</a>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>