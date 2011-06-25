<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(16)" >');
	
	$panelcuentas = new Panel("../html/a_restaurantes.html");
	$panelcuentas->add("crear",'<a href="../php/a_crear_restaurant.php">Crear Restaurant</a>');
	$tabla_completa="";
	
	$mensaje = $_REQUEST['mensaje'];
	if($mensaje==3)
	{
								$panelcuentas->add("error",'');
	}
	$result= mysql_query("SELECT r.res_id,r.res_nombre,r.res_tipocomida,r.res_ambiente,r.res_clase,r.fk_des_id ,d.des_nombre , d.des_id FROM restaurante r LEFT OUTER JOIN destino d ON r.fk_des_id = d.des_id ORDER BY res_id");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	
	while($row = mysql_fetch_array($result))
	{
	
	$tabla='
    <tr align="center">
      <td width="81" height="21">'.$row["res_id"].'</td>
	  <td width="251"><div align="center">'.$row["res_nombre"].'</td>
	  <td width="187"><div align="center">'.$row["res_tipocomida"].'</td>
	  <td width="181"><div align="center">'.$row["res_ambiente"].'</td>
      <td width="181"><div align="center">'.$row["res_clase"].'</td>
	  <td width="210"><div align="center">'.$row["des_nombre"].'</td>
	  <td width="200"><a href="../php/a_modificar_restaurant.php?cue_numero='.$row['res_nombre'].'&id='.$row['res_id'].'&banco='.$row['fk_des_id'].'&tipo='.$row['res_tipocomida'].'&fecha='.$row['res_ambiente'].'">Modificar</a> <a href="../php/a_eliminarrestaurant.php?cue_id='.$row["res_id"].'" onclick="return confirmar()">Eliminar</a></td>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>