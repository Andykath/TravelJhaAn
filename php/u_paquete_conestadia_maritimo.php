<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/usuario.html");
	
	$admin->add("body",'<body onLoad = "actual(8)" >');
	
	$panelcuentas = new Panel("../html/u_paquete_conestadia_maritimo.html");
	
	$mensaje = $_REQUEST['mensaje'];

	$result= mysql_query("SELECT r. * , ru. * , d. * , f. * , o. * , c.cru_nombre, v . *,c.cru_id 
FROM ruta r, ruta ru, flota f, destino d, destino o, crucero c, viaje v
WHERE r.rut_tipo =  'Origen'
AND ru.rut_tipo =  'Destino'
AND d.des_id = ru.fk_des_id
AND o.des_id = r.fk_des_id
AND r.fk_flo_id = v.fk_flo_id
AND ru.fk_flo_id = v.fk_flo_id
AND f.fk_cru_id = c.cru_id
AND v.fk_via_id_origen =36
AND v.fk_via_id_destino =36
AND f.flo_id = r.fk_flo_id
AND f.flo_id = ru.fk_flo_id
AND f.flo_id = v.fk_flo_id
AND v.via_tipo='Paquete'
ORDER BY v.via_id");
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
		  <td width="306"><div align="center">'.$row["cru_nombre"].'</td>
		   <td width="306"><div align="center">'.$row[26].'</td>
		    <td width="306"><div align="center">'.$row[13].'</td>
		   <td width="306"><div align="center">'.$row["flo_nombre"].'</td>
		  
	  <td width="200"><a href="../php/u_comprar_paquete_conestadia_maritimo.php?tipoviaje='.$row['via_tipoviaje'].'&id='.$row['via_id'].'&millas='.$row['via_millas'].'&tipopaq='.$row['via_tipo_paq'].'&cantpaq='.$row['via_cant_per'].'&aerolinea='.$row['cru_nombre'].'&aerid='.$row['cru_id'].'&fkvia='.$row[3].'&fkvia2='.$row[9].'&hotel='.$row['flo_nombre'].'&hotid='.$row['flo_id'].'&origen='.$row[26].'&destino='.$row[13].'&cantper='.$row['via_cant_per'].'&viacosto='.$row['rut_costo'].'">Comprar</a>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>