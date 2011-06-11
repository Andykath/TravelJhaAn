<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(15)" >');
	
	$panelcuentas = new Panel("../html/a_general_cruceros.html");
	$panelcuentas->add("crear",'<a href="../php/a_crear_crucero.php">Crear Crucero</a>');
	$panelcuentas->add("crear2",'<a href="../php/a_flotas_cruceros.php">Gestionar Flotas</a>');
	$panelcuentas->add("crear4",'<a href="../php/a_costos_cruceros.php">Gestionar Costos</a>');
	$tabla_completa="";
	
	$mensaje = $_REQUEST['mensaje'];
	if($mensaje==3)
	{
								$panelcuentas->add("error",'Ese crucero ya existe con ese pais');
	}
	$result= mysql_query("SELECT c.cru_id,c.cru_nombre,c.cru_fecha_inicio,c.fk_des_id, d.des_nombre, d.des_id FROM crucero c LEFT OUTER JOIN destino d ON c.fk_des_id = d.des_id ORDER BY cru_id");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	
	while($row = mysql_fetch_array($result))
	{
	
	$tabla='
    <tr align="center">
      <td width="81" height="21">'.$row["cru_id"].'</td>
	  <td width="306"><div align="center">'.$row["cru_nombre"].'</td>
	  <td width="181"><div align="center">'.$row["cru_fecha_inicio"].'</td>
      <td width="210"><div align="center">'.$row["des_nombre"].'</td>
	  <td width="200"><a href="../php/a_editar_crucero.php?cue_numero='.$row['cru_nombre'].'&id='.$row['cru_id'].'&banco='.$row['fk_des_id'].'&fecha='.$row['cru_fecha_inicio'].'">Modificar</a> <a href="../php/a_eliminar_crucero.php?cue_id='.$row["cru_id"].'" onclick="return confirmar()">Eliminar</a></td>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>