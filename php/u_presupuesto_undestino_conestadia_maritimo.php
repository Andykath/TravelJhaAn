<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	$cedula=$_SESSION['cedula'];
	$cedulaaux=$_SESSION['cedulaaux'];
	$admin= new Panel("../html/usuario.html");
	
	$admin->add("body",'<body onLoad = "actual(3)" >');
	
	$panelcuentas = new Panel("../html/u_presupuesto_undestino_conestadia_maritimo.html");
	$panelcuentas->add("crear",'<a href="../php/u_crear_presupuesto_undestino_conestadia_maritimo.php">Realizar un Presupuesto</a>');
	
	
	$result= mysql_query("SELECT r. * ,  ru. * , d. * , f. * , o. * , c.cru_nombre, p.*, s.ser_nombre
FROM ruta r, ruta ru, flota f, destino d, destino o, crucero c, presupuesto p, servicio s
where r.rut_tipo =  'Origen'
AND ru.rut_tipo =  'Destino'
AND d.des_id = ru.fk_des_id
AND o.des_id = r.fk_des_id
AND r.fk_flo_id = p.pre_ruta
AND ru.fk_flo_id = p.pre_ruta
and f.fk_cru_id=c.cru_id
and p.fk_per_cedula=$cedula
AND p.pre_status='No comprado'
AND p.pre_ruta IS NOT NULL
AND p.pre_servicio=s.ser_id
and p.pre_paq IS NULL
and p.pre_pro IS NULL
and p.fk_via_id_origen=36
and p.fk_via_id_destino=36
and f.flo_id=r.fk_flo_id
and f.flo_id=ru.fk_flo_id
order by p.pre_id");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	
	while($row = mysql_fetch_array($result))
	{
	
	$tabla='
    <tr align="center">
      <td width="81" height="21">'.$row["pre_id"].'</td>
	  <td width="306"><div align="center">'.$row["pre_fecha"].'</td>
	  <td width="181"><div align="center">'.$row["cru_nombre"].'</td>
      <td width="210"><div align="center">'.$row[26].'</td>
	  <td width="210"><div align="center">'.$row[13].'</td>
	   <td width="210"><div align="center">'.$row["flo_nombre"].'</td>
	   <td width="210"><div align="center">'.$row["pre_habitacion"].'</td>
	      <td width="210"><div align="center">'.$row["ser_nombre"].'</td>
			    <td width="210"><div align="center">'.$row["pre_cant_per"].'</td>
				<td width="210"><div align="center">'.$row["pre_abono"].'</td>
				<td width="210"><div align="center">'.$row["pre_total"].'</td>	
	  <td width="300"><a href="../php/u_comprar_undestino_conestadia_maritimo.php?id='.$row['pre_id'].'&fecha='.$row['pre_fecha'].'&aerolinea='.$row["cru_nombre"].'&origen='.$row[26].'&destino='.$row[13].'&hotel='.$row['flo_nombre'].'&habitacion='.$row['pre_habitacion'].'&servicio='.$row['ser_nombre'].'&paseo='.$row['pas_nombre'].'&total='.$row['pre_total'].'&cantper='.$row['pre_cant_per'].'&origen1='.$row[3].'&destino1='.$row[9].'&hotel1='.$row[13].'">Comprar</a> <a href="../php/u_reservar_presupuesto_undestino_conestadia_maritimo.php?id='.$row['pre_id'].'&fecha='.$row['pre_fecha'].'&aerolinea='.$row['cru_nombre'].'&origen='.$row[26].'&destino='.$row[13].'&servicio='.$row['ser_nombre'].'&habitacion='.$row['pre_habitacion'].'&cantper='.$row['pre_cant_per'].'&origen1='.$row[3].'&destino1='.$row[9].'&total='.$row['pre_total'].'&hotel='.$row['flo_nombre'].'">Reserva</a></td></tr>';
	    
		$tabla_completa= $tabla_completa.$tabla;
		//$_SESSION['cant']=$row['pre_cant_per'];
	
	}
	
	
	mysql_free_result($result);
	//echo($cant);
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>