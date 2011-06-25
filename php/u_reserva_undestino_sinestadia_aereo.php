<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$cedula=$_SESSION['cedula'];
	$admin= new Panel("../html/usuario.html");
	
	$admin->add("body",'<body onLoad = "actual(3)" >');
	
	$panelcuentas = new Panel("../html/u_reserva_undestino_sinestadia_aereo.html");
	
	
	

	$result= mysql_query("SELECT v.via_id,v.via_fecha_ini,a.aer_nombre,d.des_nombre, o.des_nombre,p.pre_total,p.pre_abono,p.pre_cant_per,i.via_id,f.via_id,p.pre_id FROM via i, via f, destino d, destino o, aerolinea a, presupuesto p, viaje v  WHERE p.fk_via_id_origen = i.via_id AND p.fk_via_id_destino = f.via_id AND i.fk_des_id = d.des_id AND f.fk_des_id = o.des_id and i.fk_aer_id=a.aer_id AND p.fk_per_cedula='$cedula' AND p.pre_status='No comprado' and v.fk_pre_id=p.pre_id and v.via_tipo='Reserva' and p.pre_paseo IS NULL and p.pre_habitacion is null ORDER BY v.via_id");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	
	while($row = mysql_fetch_array($result))
	{
	
	$tabla='
    <tr align="center">
      <td width="81" height="21">'.$row[0].'</td>
	  <td width="210"><div align="center">'.$row[1].'</td>
	  <td width="210"><div align="center">'.$row["aer_nombre"].'</td>
      <td width="210"><div align="center">'.$row[3].'</td>
	  <td width="210"><div align="center">'.$row[4].'</td>
			    <td width="210"><div align="center">'.$row["pre_cant_per"].'</td>
				<td width="210"><div align="center">'.$row["pre_abono"].'</td>
				<td width="210"><div align="center">'.$row["pre_total"].'</td>	
	  <td width="200"><a href="../php/u_comprarR_undestino_sinestadia_aereo.php?id='.$row['pre_id'].'&fecha='.$row['pre_fecha'].'&aerolinea='.$row['aer_nombre'].'&origen='.$row[3].'&destino='.$row[4].'&total='.$row['pre_total'].'&cantper='.$row['pre_cant_per'].'&origen1='.$row[8].'&destino1='.$row[9].'&hotel1='.$row[13].'&id2='.$row['via_id'].'">Comprar</a> </td>
    </tr>';
	    
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