<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(3)" >');
	
	
	
	$panelpaises = new Panel("../html/a_paises.html");
	$panelpaises->add("crear",'<a href="../php/a_crearpais.php">Crear Pais</a>');

	
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
	$panelpaises->add("mensaje",'Ya existe ese pais');
	}
	
	
	$tabla_completa='';
	$result= mysql_query("SELECT d.des_id, d.des_nombre ,d.des_descripcion, d.fk_mon_id ,m.mon_id, m.mon_nombre FROM destino d LEFT OUTER JOIN moneda m ON d.fk_mon_id = m.mon_id WHERE d.des_descripcion='Pais' ORDER BY des_id");

	
	while($row = mysql_fetch_array($result)){
	
	
	$tabla=
  
  '<tr align="center">
      <td width="99" height="21">'.$row["des_id"].'</td>
      <td width="263"><div align="center">'.$row["des_nombre"].'</td>
	  <td width="243"><div align="center">'.$row["mon_nombre"].'</td>
	  <td width="279"><a href="../php/a_modificar_pais.php?nombre='.$row['des_nombre'].'&id='.$row['des_id'].'&moneda='.$row['fk_mon_id'].'">Modificar</a> <a href="../php/a_eliminarpais.php?id='.$row['des_id'].'"onclick="return confirmar()">Eliminar</a></td>
    </tr>';
  
  
  
   $tabla_completa = $tabla_completa.$tabla;
  
   }
	
	mysql_free_result($result);
	
	
	$panelpaises->add("informacion",$tabla_completa);
	
	$admin->add("contenido",$panelpaises);
	
	
	
				
	$admin->show();
 	include "../db/cerrar_conexion.php";
?>
