<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(10)" >');
	
	$panelcuentas = new Panel("../html/a_general_publicidad_trans.html");
	$panelcuentas->add("crear",'<a href="../php/a_crear_publicidad_transporte.php">Crear Publicidad</a>');
	
	
	$mensaje = $_REQUEST['mensaje'];
	if($mensaje==3)
	{
								$panelcuentas->add("error",'Ya existe esa publicidad');
	}
	else if($mensaje==2)
	{
								$panelcuentas->add("error",'Cambios Realizados');
	}
	$result= mysql_query("SELECT p.*, a.aer_nombre, a.aer_id FROM publicidad p, aerolinea a where p.fk_aer_id=a.aer_id and fk_hot_id IS NULL ORDER BY pub_id");
		
	while($row = mysql_fetch_array($result))
	{
	
	$tabla='
    <tr align="center">
      <td width="125" height="21">'.$row["pub_id"].'</td>
	  <td width="435"><div align="center">'.$row["pub_descripcion"].'</td>
      <td width="321"><div align="center">'.'<img src="../imagenes/'.$row["pub_logo"].'" width="200" height="80" />'.'</td>
	  <td width="435"><div align="center">'.$row["aer_nombre"].'</td>
	  <td width="200"><a href="../php/a_editar_publicidad_transporte.php?descripcion='.$row['pub_descripcion'].'&id='.$row['pub_id'].'&logo='.$row['pub_logo'].'&hot='.$row['aer_id'].'&tipo='."a".'&nombre='.$row['aer_nombre'].'">Modificar</a> <a href="../php/a_eliminar_publicidad_transporte.php?cue_id='.$row["pub_id"].'" onclick="return confirmar()">Eliminar</a></td>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	$result2= mysql_query("SELECT p.*, c.cru_nombre, c.cru_id FROM publicidad p, crucero c where p.fk_cru_id=c.cru_id and fk_hot_id IS NULL ORDER BY pub_id");
		
	while($row2 = mysql_fetch_array($result2))
	{
	
	$tabla='
    <tr align="center">
      <td width="125" height="21">'.$row2["pub_id"].'</td>
	  <td width="435"><div align="center">'.$row2["pub_descripcion"].'</td>
      <td width="321"><div align="center">'.'<img src="../imagenes/'.$row2["pub_logo"].'" width="200" height="80" />'.'</td>
	  <td width="435"><div align="center">'.$row2["cru_nombre"].'</td>
	  <td width="200"><a href="../php/a_editar_publicidad_transporte.php?descripcion='.$row2['pub_descripcion'].'&id='.$row2['pub_id'].'&logo='.$row2['pub_logo'].'&hot='.$row2['cru_id'].'&tipo='."c".'&nombre='.$row2['cru_nombre'].'">Modificar</a> <a href="../php/a_eliminar_publicidad_transporte.php?cue_id='.$row2["pub_id"].'" onclick="return confirmar()">Eliminar</a></td>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	$result3= mysql_query("SELECT p.*, t.ter_nombre, t.ter_id FROM publicidad p, terrestre t where p.fk_ter_id=t.ter_id and fk_hot_id IS NULL ORDER BY pub_id");
		
	while($row3 = mysql_fetch_array($result3))
	{
	
	$tabla='
    <tr align="center">
      <td width="125" height="21">'.$row3["pub_id"].'</td>
	  <td width="435"><div align="center">'.$row3["pub_descripcion"].'</td>
      <td width="321"><div align="center">'.'<img src="../imagenes/'.$row3["pub_logo"].'" width="200" height="80" />'.'</td>
	  <td width="435"><div align="center">'.$row3["ter_nombre"].'</td>
	  <td width="200"><a href="../php/a_editar_publicidad_transporte.php?descripcion='.$row3['pub_descripcion'].'&id='.$row3['pub_id'].'&logo='.$row3['pub_logo'].'&hot='.$row3['ter_id'].'&tipo='."t".'&nombre='.$row3['ter_nombre'].'">Modificar</a>  <a href="../php/a_eliminar_publicidad_transporte.php?cue_id='.$row3["pub_id"].'" onclick="return confirmar()">Eliminar</a></td>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>