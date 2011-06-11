<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(7)" >');
	
	$panelcuentas = new Panel("../html/a_general_paseos.html");
	$panelcuentas->add("crear",'<a href="../php/a_crear_paseo.php">Crear Paseo</a>');
	
	
	$mensaje = $_REQUEST['mensaje'];
	if($mensaje==3)
	{
								$panelcuentas->add("error",'Ya existe ese pasep');
	}
	$result= mysql_query("SELECT p.pas_id,p.pas_nombre,p.pas_descripcion,p.pas_costo FROM paseo p ORDER BY pas_id");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	
	while($row = mysql_fetch_array($result))
	{
	
	$tabla='
    <tr align="center">
      <td width="81" height="21">'.$row["pas_id"].'</td>
	  <td width="306"><div align="center">'.$row["pas_nombre"].'</td>
	  <td width="181"><div align="center">'.$row["pas_descripcion"].'</td>
      <td width="210"><div align="center">'.$row["pas_costo"].'</td>
	  <td width="200"><a href="../php/a_editar_paseo.php?cue_numero='.$row['pas_nombre'].'&id='.$row['pas_id'].'&banco='.$row['pas_descripcion'].'&fecha='.$row['pas_costo'].'">Modificar</a> <a href="../php/a_eliminar_paseo.php?cue_id='.$row["pas_id"].'" onclick="return confirmar()">Eliminar</a></td>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>