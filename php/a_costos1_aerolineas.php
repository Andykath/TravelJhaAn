<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(1)" >');
	
	$panelcuentas = new Panel("../html/a_general_costos1_aerolineas.html");
	$panelcuentas->add("crear3",'<a href="../php/a_crear_costo1_aerolinea.php">Crear Costos Aerolineas</a>');
	$tabla_completa="";
	
	$mensaje = $_REQUEST['mensaje'];
	if($mensaje==3)
	{
								$panelcuentas->add("error",'Ese costo ya existe con esa aerolinea con ese destino');
	}
	$result= mysql_query("SELECT c.cos_id,c.fk_via_origen,c.fk_via_destino,c.cos_costo, c.cos_hora, o.des_nombre, d.des_nombre,a.aer_id, a.aer_nombre FROM costo c, via i, aerolinea a, destino d, destino o,via f  WHERE c.fk_via_origen=i.via_id and i.fk_des_id=o.des_id and c.fk_via_destino=f.via_id and f.fk_des_id=d.des_id and i.fk_aer_id=a.aer_id and i.fk_cru_id is null  and i.fk_ter_id  is null  ORDER BY c.cos_id");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	//AMAME!!!!! 
	while($row = mysql_fetch_array($result))
	{
	
	$tabla='
    <tr align="center">
      <td width="81" height="21">'.$row["cos_id"].'</td>
	  <td width="181"><div align="center">'.$row[5].'</td>
      <td width="210"><div align="center">'.$row[6].'</td>
	  <td width="210"><div align="center">'.$row["cos_costo"].'</td>
	   <td width="210"><div align="center">'.$row["cos_hora"].'</td>
	  <td width="200"><a href="../php/a_editar_costo1_aerolinea.php?cue_numero='.$row['cos_hora'].'&id='.$row['cos_id'].'&origen='.$row[1].'&fecha='.$row['via_millas'].'&destino='.$row[2].'&tipo='.$row['cos_costo'].'">Modificar</a> <a href="../php/a_eliminar_costo1_aerolinea.php?cue_id='.$row["cos_id"].'" onclick="return confirmar()">Eliminar</a></td>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>