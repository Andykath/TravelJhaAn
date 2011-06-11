<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	extract($_GET); 
	$admin= new Panel("../html/usuario.html");
	
	//$admin->add("body",'<body onLoad = "actual(12)" >');
	
	$panelcuentas = new Panel("../html/u_telefonos.html");
	$panelcuentas->add("crear",'<a href="../php/u_crear_telefono.php?cedula='.$cedula.'">Anadir telefono</a>');
	$tabla_completa="";
	
	$mensaje = $_REQUEST['mensaje'];
	if($mensaje==3)
	{
								$panelcuentas->add("error",'Esa numero ya existe');
	}
	$result=mysql_query("SELECT t.tel_numero,t.tel_tipo,t.tel_id FROM telefono t WHERE t.fk_per_cedula='$cedula'");
	
	while($row = mysql_fetch_array($result))
	{
	
	$tabla='
    <tr align="center">
      <td width="326" height="21">'.$row["tel_numero"].'</td>
	  <td width="330"><div align="center">'.$row["tel_tipo"].'</td>
	  <td width="200"><a href="../php/u_modificar_telefono.php?id='.$row['tel_id'].'&cedula='.$cedula.'&numero='.$row['tel_numero'].'&tipo='.$row['tel_tipo'].'">Modificar</a> <a href="../php/u_eliminartelefono.php?id='.$row["tel_id"].'&cedula='.$cedula.'" onclick="return confirmar()">Eliminar</a></td>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>