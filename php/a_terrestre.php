<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(2)" >');
	
	$panelcuentas = new Panel("../html/a_general_terrestre.html");
	$panelcuentas->add("crear",'<a href="../php/a_crear_terrestre.php">Crear Transporte Terrestre</a>');
	$panelcuentas->add("crear2",'<a href="../php/a_flotas_terrestres.php">Gestionar Flotas</a>');
	$panelcuentas->add("crear4",'<a href="../php/a_costos_terrestre.php">Gestionar Costos</a>');
	$tabla_completa="";
	
	$mensaje = $_REQUEST['mensaje'];
	if($mensaje==3)
	{
								$panelcuentas->add("error",'Ese T. terrestre ya existe en ese pais');
	}
	$result= mysql_query("SELECT t.ter_id,t.ter_nombre,t.ter_fecha_inicio,t.fk_des_id, d.des_nombre, d.des_id FROM terrestre t LEFT OUTER JOIN destino d ON t.fk_des_id = d.des_id ORDER BY ter_id");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	
	while($row = mysql_fetch_array($result))
	{
	
	$tabla='
    <tr align="center">
      <td width="81" height="21">'.$row["ter_id"].'</td>
	  <td width="306"><div align="center">'.$row["ter_nombre"].'</td>
	  <td width="181"><div align="center">'.$row["ter_fecha_inicio"].'</td>
      <td width="210"><div align="center">'.$row["des_nombre"].'</td>
	  <td width="200"><a href="../php/a_editar_terrestre.php?cue_numero='.$row['ter_nombre'].'&id='.$row['ter_id'].'&banco='.$row['fk_des_id'].'&fecha='.$row['ter_fecha_inicio'].'">Modificar</a> <a href="../php/a_eliminar_terrestre.php?cue_id='.$row["ter_id"].'" onclick="return confirmar()">Eliminar</a></td>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>