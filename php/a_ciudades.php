<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(3)" >');
	
	
	
	$panelpaises = new Panel("../html/a_ciudades.html");
	$panelpaises->add("crear",'<a href="../php/a_crearciudad.php">Crear Ciudad</a>');

	
    $mensaje = $_REQUEST['mensaje'];
	if($mensaje==1)
	{
	$panelpaises->add("mensaje",'Se Agrego el nuevo registro');
	}
	else if($mensaje==2)
	{
	$panelpaises->add("mensaje",'Se Edito el registro');
	}
	else if($mensaje==4)
	{
	$panelpaises->add("mensaje",'Ya existe esa ciudad en ese pais');
	}
	
	
	$tabla_completa='';
	$result= mysql_query("SELECT d.des_id, d.des_nombre ,d.des_descripcion, d.fk_des_id, e.des_id, e.des_nombre FROM destino d LEFT JOIN destino e ON d.fk_des_id = e.des_id WHERE d.des_descripcion='Ciudad' ORDER BY d.des_id");

	
	while($row = mysql_fetch_array($result)){
	
	
	$tabla=
  
  '<tr align="center">
      <td width="99" height="21">'.$row[0].'</td>
      <td width="263"><div align="center">'.$row[1].'</td>
	  <td width="243"><div align="center">'.$row[5].'</td>
	  <td width="279"><a href="../php/a_modificarciudad.php?nombre='.$row[1].'&id='.$row[0].'&idp='.$row[4].'&np='.$row[5].'">Modificar</a> <a href="../php/a_eliminarciudad.php?id='.$row[0].'"onclick="return confirmar()">Eliminar</a></td>
    </tr>';
  
  
  
   $tabla_completa = $tabla_completa.$tabla;
  
   }
	
	mysql_free_result($result);
	
	
	$panelpaises->add("informacion",$tabla_completa);
	
	$admin->add("contenido",$panelpaises);
	
	
	
				
	$admin->show();
 	include "../db/cerrar_conexion.php";
?>
