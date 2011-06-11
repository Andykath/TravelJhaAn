<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(5)" >');
	
	$panelcuentas = new Panel("../html/a_hoteles.html");
	$panelcuentas->add("crear",'<a href="../php/a_crear_hotel.php">Crear Hotel</a>');
	$tabla_completa="";
	
	$mensaje = $_REQUEST['mensaje'];
	if($mensaje==3)
	{
								$panelcuentas->add("error",'Ese hotel ya existe en esa ciudad');
	}
	$result= mysql_query("SELECT h.hot_id,h.hot_nombre,h.hot_estrellas,h.hot_telefono,h.fk_des_id, d.des_nombre, d.des_id FROM hotel h LEFT OUTER JOIN destino d ON h.fk_des_id = d.des_id ORDER BY hot_id");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	
	while($row = mysql_fetch_array($result))
	{
	
	$tabla='
    <tr align="center">
      <td width="81" height="21">'.$row["hot_id"].'</td>
	  <td width="255"><div align="center">'.$row["hot_nombre"].'</td>
	  <td width="183"><div align="center">'.$row["hot_estrellas"].'</td>
	  <td width="181"><div align="center">'.$row["hot_telefono"].'</td>
      <td width="185"><div align="center">'.$row["des_nombre"].'</td>
	  <td width="500"><a href="../php/a_modificar_hotel.php?cue_numero='.$row['hot_nombre'].'&id='.$row['hot_id'].'&banco='.$row['fk_des_id'].'&tipo='.$row['hot_estrellas'].'&fecha='.$row['hot_telefono'].'">Modificar</a> <a href="../php/a_eliminarhotel.php?cue_id='.$row["hot_id"].'" onclick="return confirmar()">Eliminar</a></a> <a href="../php/a_habitacioneshotel.php?cue_id='.$row["hot_id"].'">     Gestionar habitaciones</a>  <a href="../php/a_servicios_hoteles.php?cue_id='.$row["hot_id"].'">  Gestionar Servicios</a>  <a href="../php/a_paseos_hoteles.php?cue_id='.$row["hot_id"].'">  Gestionar Paseos</a></td>
	  
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>