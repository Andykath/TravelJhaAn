<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	$cedula=$_SESSION['cedula'];
	$cedulaaux=$_SESSION['cedulaaux'];
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(16)" >');
	
	$panelcuentas = new Panel("../html/a_presupuesto_undestino_sinestadia_aereo.html");
	$panelcuentas->add("crear",'<a href="../php/a_crear_presupuesto_undestino_sinestadia_aereo.php">Realizar un Presupuesto</a>');
	
	

	$result= mysql_query("SELECT p.pre_id,p.pre_fecha,a.aer_nombre,d.des_nombre, o.des_nombre,p.pre_total,p.pre_abono,p.pre_cant_per,i.via_id,f.via_id,p.fk_per_cedula,pe.per_nombre1,pe.per_apellido1 FROM via i, via f, destino d, destino o, aerolinea a, presupuesto p, persona pe WHERE p.fk_via_id_origen = i.via_id AND p.fk_via_id_destino = f.via_id AND i.fk_des_id = d.des_id AND f.fk_des_id = o.des_id and i.fk_aer_id=a.aer_id AND p.pre_status='No comprado' AND p.pre_habitacion IS NULL  and p.fk_per_cedula=pe.per_cedula ORDER BY p.pre_id");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	
	while($row = mysql_fetch_array($result))
	{
	
	$tabla='
    <tr align="center">
      <td width="81" height="21">'.$row["pre_id"].'</td>
	  <td width="306"><div align="center">'.$row["pre_fecha"].'</td>
	  <td width="306"><div align="center">'.$row["fk_per_cedula"].'</td>
	  <td width="306"><div align="center">'.$row["per_nombre1"].'</td>
	  <td width="306"><div align="center">'.$row["per_apellido1"].'</td>
	  <td width="181"><div align="center">'.$row["aer_nombre"].'</td>
      <td width="210"><div align="center">'.$row[3].'</td>
	  <td width="210"><div align="center">'.$row[4].'</td>
			    <td width="210"><div align="center">'.$row["pre_cant_per"].'</td>
				<td width="210"><div align="center">'.$row["pre_abono"].'</td>
				<td width="210"><div align="center">'.$row["pre_total"].'</td>	
	  <td width="300"><a href="../php/a_comprar_undestino_sinestadia_aereo.php?id='.$row['pre_id'].'&fecha='.$row['pre_fecha'].'&aerolinea='.$row[2].'&origen='.$row[3].'&destino='.$row[4].'&hotel='.$row['hot_nombre'].'&habitacion='.$row['pre_habitacion'].'&servicio='.$row['ser_nombre'].'&paseo='.$row['pas_nombre'].'&total='.$row['pre_total'].'&cantper='.$row['pre_cant_per'].'&origen1='.$row[11].'&destino1='.$row[12].'&hotel1='.$row[13].'&cedula='.$row['fk_per_cedula'].'">Comprar</a><a href="../php/a_eliminar_presupuesto_undestino_sinestadia_aereo.php?id='.$row["pre_id"].'" onclick="return confirmar()">  Eliminar</a></td></tr>';
	    
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