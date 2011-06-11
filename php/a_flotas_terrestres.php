<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(1)" >');
	
	$panelcuentas = new Panel("../html/a_general_flotas_terrestres.html");
	$panelcuentas->add("crear3",'<a href="../php/a_crear_flota_terrestre.php">Crear Flota Transporte Terrestre</a>');
	$tabla_completa="";
	
	$mensaje = $_REQUEST['mensaje'];
	if($mensaje==3)
	{
								$panelcuentas->add("error",'Esa flota ya existe en ese T. terrestre');
	}
	$result= mysql_query("SELECT f.flo_id,f.flo_nombre,f.flo_capacidad,f.flo_cantidad,f.fk_aer_id,f.fk_cru_id,f.fk_ter_id, t.ter_nombre, t.ter_id FROM flota f  LEFT OUTER JOIN terrestre t ON f.fk_ter_id = t.ter_id WHERE f.fk_cru_id IS NULL AND f.fk_aer_id IS NULL ORDER BY flo_id");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	//AMAME!!!!! 
	while($row = mysql_fetch_array($result))
	{
	
	$tabla='
    <tr align="center">
      <td width="81" height="21">'.$row["flo_id"].'</td>
	  <td width="306"><div align="center">'.$row["flo_nombre"].'</td>
	  <td width="181"><div align="center">'.$row["flo_capacidad"].'</td>
      <td width="210"><div align="center">'.$row["flo_cantidad"].'</td>
	  <td width="210"><div align="center">'.$row["ter_nombre"].'</td>
	  <td width="200"><a href="../php/a_editar_flota_terrestre.php?cue_numero='.$row['flo_nombre'].'&id='.$row['flo_id'].'&banco='.$row['fk_aer_id'].'&fecha='.$row['flo_capacidad'].'&tipo='.$row['flo_cantidad'].'">Modificar</a> <a href="../php/a_eliminar_flota_terrestre.php?cue_id='.$row["flo_id"].'" onclick="return confirmar()">Eliminar</a></td>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>