<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/usuario.html");
	
	$admin->add("body",'<body onLoad = "actual(8)" >');
	
	$panelcuentas = new Panel("../html/u_promocion_conestadia_aereo.html");
	
	$mensaje = $_REQUEST['mensaje'];

	$result= mysql_query("SELECT  p.pro_nombre, p.pro_id, p.fk_hab_id, p.pro_descuento, p.pro_fechaini, p.pro_fechafin, p.fk_via_id,p.fk_via_id2, p.pro_durac_viaje, d.des_nombre, o.des_nombre, a.aer_nombre, a.aer_id, v.via_id, f.via_id,ho.hot_nombre,ho.hot_id
FROM promocion p, via v, via f, destino d, destino o ,aerolinea a, hotel ho WHERE p.fk_via_id= v.via_id AND v.fk_des_id = d.des_id  and  p.fk_via_id2= f.via_id AND f.fk_des_id = o.des_id AND v.fk_aer_id=a.aer_id AND p.fk_hab_id=ho.hot_id and v.fk_cru_id IS NULL AND v.fk_ter_id IS NULL AND p.fk_hab_id IS NOT NULL ORDER BY p.pro_id");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	
	while($row = mysql_fetch_array($result))
	{
		
		
	//echo("entra");
	$tabla='
    <tr align="center">
      <td width="81" height="21">'.$row["pro_id"].'</td>
	  <td width="81" height="21">'.$row["pro_nombre"].'</td>
		<td width="306"><div align="center">'.$row["pro_descuento"].'</td>
		<td width="306"><div align="center">'.$row["pro_durac_viaje"].'</td>
		  <td width="306"><div align="center">'.$row["aer_nombre"].'</td>
		   <td width="306"><div align="center">'.$row[6].'</td>
		    <td width="306"><div align="center">'.$row[7].'</td>
		   <td width="306"><div align="center">'.$row["hot_nombre"].'</td>
		  
	  <td width="200"><a href="../php/u_comprar_promocion_conestadia_aereo.php?nombre='.$row['pro_nombre'].'&id='.$row['pro_id'].'&desc='.$row['pro_descuento'].'&dur='.$row['pro_durac_viaje'].'&aerolinea='.$row['aer_nombre'].'&aerid='.$row['aer_id'].'&fkvia='.$row[6].'&fkvia2='.$row[7].'&hotel='.$row['hot_nombre'].'&hotid='.$row['hot_id'].'&origen='.$row[9].'&destino='.$row[10].'&cantper='.$row['via_cant_per'].'&viacosto='.$row['via_costo'].'">Comprar</a>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>