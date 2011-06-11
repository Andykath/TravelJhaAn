<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(1)" >');
	
	$panelcuentas = new Panel("../html/a_general_costos_aerolineas.html");
	$panelcuentas->add("crear3",'<a href="../php/a_crear_costo_aerolinea.php">Crear Costos Aerolineas</a>');
	$tabla_completa="";
	
	$mensaje = $_REQUEST['mensaje'];
	if($mensaje==3)
	{
								$panelcuentas->add("error",'Ese costo ya existe con esa aerolinea con ese destino');
	}
	$result= mysql_query("SELECT v.via_id,v.via_costo,v.via_terminal,v.via_millas, v.fk_des_id, v.fk_aer_id, v.fk_ter_id, v.fk_cru_id, d.des_id, d.des_nombre, a.aer_id, a.aer_nombre FROM (via v LEFT OUTER JOIN destino d ON v.fk_des_id = d.des_id) LEFT OUTER JOIN aerolinea a ON v.fk_aer_id=a.aer_id WHERE v.fk_cru_id IS NULL AND v.fk_ter_id IS NULL ORDER BY via_id");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	//AMAME!!!!! 
	while($row = mysql_fetch_array($result))
	{
	
	$tabla='
    <tr align="center">
      <td width="81" height="21">'.$row["via_id"].'</td>
	  <td width="306"><div align="center">'.$row["via_costo"].'</td>
	  <td width="181"><div align="center">'.$row["via_terminal"].'</td>
      <td width="210"><div align="center">'.$row["via_millas"].'</td>
	  <td width="210"><div align="center">'.$row["des_nombre"].'</td>
	   <td width="210"><div align="center">'.$row["aer_nombre"].'</td>
	  <td width="200"><a href="../php/a_editar_costo_aerolinea.php?cue_numero='.$row['via_terminal'].'&id='.$row['via_id'].'&banco='.$row['fk_aer_id'].'&fecha='.$row['via_millas'].'&destino='.$row['fk_des_id'].'&tipo='.$row['via_costo'].'">Modificar</a> <a href="../php/a_eliminar_costo_aerolinea.php?cue_id='.$row["via_id"].'" onclick="return confirmar()">Eliminar</a></td>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>