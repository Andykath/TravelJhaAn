<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	extract($_POST);
	extract($_GET);
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(15)" >');
	
	$panelcuentas = new Panel("../html/a_camarotes.html");
	$panelcuentas->add("crear",'<a href="../php/a_crear_camarote.php?hot_id='.$cue_id.'">Crear Camarote</a>');
	$tabla_completa="";
	
	$mensaje = $_REQUEST['mensaje'];
	if($mensaje==3)
	{
								$panelcuentas->add("error",'');
	}
	
	$result= mysql_query("SELECT h.hab_id,h.hab_piso,h.hab_capacidad,h.hab_costo,h.fk_hot_id, f.flo_nombre, f.flo_id FROM habitacion h LEFT OUTER JOIN flota f ON h.fk_cru_id = f.flo_id WHERE h.hab_tipo='Crucero' AND h.fk_cru_id= $cue_id ORDER BY h.hab_id");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	
	while($row = mysql_fetch_array($result))
	{
	
	$tabla='
    <tr align="center">
      <td width="120" height="21">'.$row["hab_id"].'</td>
	  <td width="163"><div align="center">'.$row["hab_piso"].'</td>
	  <td width="211"><div align="center">'.$row["hab_capacidad"].'</td>
	  <td width="175"><div align="center">'.$row["hab_costo"].'</td>
	  <td width="216"><div align="center">'.$row["flo_nombre"].'</td>
	  <td width="200"><a href="../php/a_modificar_camarote.php?cue_numero='.$row['hab_piso'].'&id='.$row['hab_id'].'&banco='.$row['hab_costo'].'&hotel='.$cue_id.'&fecha='.$row['hab_capacidad'].'">Modificar</a> <a href="../php/a_eliminarcamarote.php?cue_id='.$row["hab_id"].'&hot_id='.$cue_id.'" onclick="return confirmar()">Eliminar</a></td>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>