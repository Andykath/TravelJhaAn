<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(10)" >');
	
	$panelcuentas = new Panel("../html/a_general_publicidad.html");
	$panelcuentas->add("crear",'<a href="../php/a_crear_publicidad_hotel.php">Crear Publicidad</a>');
	
	
	$mensaje = $_REQUEST['mensaje'];
	if($mensaje==3)
	{
								$panelcuentas->add("error",'Ya existe esa Publicidad');
	}
	else if($mensaje==2)
	{
								$panelcuentas->add("error",'Cambios Realizados');
	}
	$result= mysql_query("SELECT p.*, h.hot_nombre, h.hot_id FROM publicidad p, hotel h where p.fk_hot_id=h.hot_id and fk_hot_id IS NOT NULL ORDER BY pub_id");
		
	while($row = mysql_fetch_array($result))
	{
	
	$tabla='
    <tr align="center">
      <td width="162" height="21">'.$row["pub_id"].'</td>
	  <td width="295"><div align="center">'.$row["pub_descripcion"].'</td>
      <td width="260"><div align="center">'.'<img src="../imagenes/'.$row["pub_logo"].'" width="120" height="80" />'.'</td>
	  <td width="234"><div align="center">'.$row["hot_nombre"].'</td>
	  <td width="200"><a href="../php/a_editar_publicidad_hotel.php?descripcion='.$row['pub_descripcion'].'&id='.$row['pub_id'].'&logo='.$row['pub_logo'].'&hot='.$row['hot_id'].'">Modificar</a> <a href="../php/a_eliminar_publicidad_hotel.php?cue_id='.$row["pub_id"].'" onclick="return confirmar()">Eliminar</a></td>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>