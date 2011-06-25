<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	$cedula=$_SESSION['cedula'];
	$cedulaaux=$_SESSION['cedulaaux'];
	$admin= new Panel("../html/usuario.html");
	
	$admin->add("body",'<body onLoad = "actual(3)" >');
	
	$panelcuentas = new Panel("../html/u_presupuesto_undestino_sinestadia_terrestre.html");
	$panelcuentas->add("crear",'<a href="../php/u_crear_presupuesto_undestino_sinestadia_terrestre.php">Realizar un Presupuesto</a>');
	
	

	$result= mysql_query("SELECT p.pre_id,p.pre_fecha,a.ter_nombre,d.des_nombre, o.des_nombre,p.pre_total,p.pre_abono,p.pre_cant_per,i.via_id,f.via_id FROM via i, via f, destino d, destino o, terrestre a, presupuesto p WHERE p.fk_via_id_origen = i.via_id AND p.fk_via_id_destino = f.via_id AND i.fk_des_id = d.des_id AND f.fk_des_id = o.des_id and i.fk_ter_id=a.ter_id AND p.fk_per_cedula='$cedula' AND p.pre_status='No comprado' AND p.pre_habitacion IS NULL ORDER BY p.pre_id");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	
	while($row = mysql_fetch_array($result))
	{
	
	$tabla='
    <tr align="center">
      <td width="81" height="21">'.$row["pre_id"].'</td>
	  <td width="306"><div align="center">'.$row["pre_fecha"].'</td>
	  <td width="181"><div align="center">'.$row["ter_nombre"].'</td>
      <td width="210"><div align="center">'.$row[3].'</td>
	  <td width="210"><div align="center">'.$row[4].'</td>
	   <td width="210"><div align="center">'.$row["hot_nombre"].'</td>
	   <td width="210"><div align="center">'.$row["pre_habitacion"].'</td>
	      <td width="210"><div align="center">'.$row["ser_nombre"].'</td>
			    <td width="210"><div align="center">'.$row["pre_cant_per"].'</td>
				<td width="210"><div align="center">'.$row["pre_abono"].'</td>
				<td width="210"><div align="center">'.$row["pre_total"].'</td>	
	  <td width="300"><a href="../php/u_comprar_undestino_sinestadia_terrestre.php?id='.$row['pre_id'].'&fecha='.$row['pre_fecha'].'&aerolinea='.$row[2].'&origen='.$row[3].'&destino='.$row[4].'&hotel='.$row['hot_nombre'].'&habitacion='.$row['pre_habitacion'].'&servicio='.$row['ser_nombre'].'&paseo='.$row['pas_nombre'].'&total='.$row['pre_total'].'&cantper='.$row['pre_cant_per'].'&origen1='.$row[11].'&destino1='.$row[12].'&hotel1='.$row[13].'">Comprar</a> <a href="../php/u_verpaseo_undestino_sinestadia_terrestre.php?id='.$row['pre_id'].'">Ver Paseos</a><a href="../php/u_reservar_presupuesto_undestino_sinestadia_terrestre.php?id='.$row['pre_id'].'&fecha='.$row['pre_fecha'].'&aerolinea='.$row['ter_nombre'].'&origen='.$row[3].'&destino='.$row[4].'&servicio='.$row['ser_nombre'].'&habitacion='.$row['pre_habitacion'].'&cantper='.$row['pre_cant_per'].'&origen1='.$row[11].'&destino1='.$row[12].'&total='.$row['pre_total'].'&hotel='.$row['hot_nombre'].'">Reserva</a></td></tr>';
	    
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