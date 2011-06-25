<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(1)" >');
	
	$panelcuentas = new Panel("../html/a_general_aerolineas.html");
	$panelcuentas->add("crear",'<a href="../php/a_crear_aerolinea.php">Crear Aerolinea</a>');
	$panelcuentas->add("crear2",'<a href="../php/a_flotas_aerolineas.php">Gestionar Flotas</a>');
	$panelcuentas->add("crear4",'<a href="../php/a_costos_aerolineas.php">Gestionar Vias</a>');
	$panelcuentas->add("crear5",'<a href="../php/a_costos1_aerolineas.php">Gestionar Costos</a>');
	$tabla_completa="";
	
	$mensaje = $_REQUEST['mensaje'];
	if($mensaje==3)
	{
								$panelcuentas->add("error",'Esa aerolinea ya existe en ese pais');
	}
	$result= mysql_query("SELECT a.aer_id,a.aer_nombre,a.aer_fecha_inicio,a.fk_des_id, d.des_nombre, d.des_id FROM aerolinea a LEFT OUTER JOIN destino d ON a.fk_des_id = d.des_id ORDER BY aer_id");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	
	while($row = mysql_fetch_array($result))
	{
	
	$tabla='
    <tr align="center">
      <td width="81" height="21">'.$row["aer_id"].'</td>
	  <td width="306"><div align="center">'.$row["aer_nombre"].'</td>
	  <td width="181"><div align="center">'.$row["aer_fecha_inicio"].'</td>
      <td width="210"><div align="center">'.$row["des_nombre"].'</td>
	  <td width="200"><a href="../php/a_editar_aerolinea.php?cue_numero='.$row['aer_nombre'].'&id='.$row['aer_id'].'&banco='.$row['fk_des_id'].'&fecha='.$row['aer_fecha_inicio'].'">Modificar</a> <a href="../php/a_eliminar_aerolinea.php?cue_id='.$row["aer_id"].'" onclick="return confirmar()">Eliminar</a></td>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>