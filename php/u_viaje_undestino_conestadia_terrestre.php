<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	$cedula=$_SESSION['cedula'];
	$cedulaaux=$_SESSION['cedulaaux'];
	$admin= new Panel("../html/usuario.html");
	
	$admin->add("body",'<body onLoad = "actual(3)" >');
	
	$panelcuentas = new Panel("../html/u_viaje_undestino_conestadia_aereo.html");
	
	
	

	$result= mysql_query("SELECT v.via_id, v.via_tipoviaje, v.via_fecha_ini, v.via_fecha_fin, v.via_hora_ini, v.via_hora_fin, v.via_cant_per, a.ter_nombre, d.des_nombre, o.des_nombre, ho.hot_nombre, ha.hab_id, e.est_fecha_ini, e.est_fecha_fin
FROM via i, via f, destino d, destino o, terrestre a, hotel ho, viaje v, habitacion ha, presupuesto p, estadia e
WHERE v.fk_via_id_origen = i.via_id
AND v.fk_via_id_destino = f.via_id
AND i.fk_des_id = d.des_id
AND f.fk_des_id = o.des_id
AND i.fk_ter_id = a.ter_id
AND v.fk_pre_id = p.pre_id
AND p.fk_per_cedula='$cedula'
AND e.fk_via_id = v.via_id
AND e.fk_hab_id = ha.hab_id
AND ha.fk_hot_id = ho.hot_id
AND v.via_tipo='Viaje'
AND v.via_compuesto IS NULL
ORDER BY v.via_id");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	
	while($row = mysql_fetch_array($result))
	{
	
	$tabla='
    <tr align="center">
      <td width="81" height="21">'.$row["via_id"].'</td>
	  <td width="306"><div align="center">'.$row["via_tipoviaje"].'</td>
      <td width="210"><div align="center">'.$row["via_fecha_ini"].'</td>
	  <td width="210"><div align="center">'.$row["via_fecha_fin"].'</td>
	  <td width="210"><div align="center">'.$row["via_hora_ini"].'</td>
	  <td width="210"><div align="center">'.$row["via_hora_fin"].'</td>
	      <td width="210"><div align="center">'.$row["via_cant_per"].'</td>
		   <td width="181"><div align="center">'.$row["ter_nombre"].'</td>
	  <td width="210"><div align="center">'.$row[8].'</td>
	  	 <td width="210"><div align="center">'.$row[9].'</td>
	   <td width="210"><div align="center">'.$row["hot_nombre"].'</td>
	   <td width="210"><div align="center">'.$row["hab_id"].'</td>
	      <td width="210"><div align="center">'.$row["est_fecha_ini"].'</td>
			<td width="210"><div align="center">'.$row["est_fecha_fin"].'</td>
				
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