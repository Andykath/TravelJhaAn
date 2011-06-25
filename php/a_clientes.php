<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(4)" >');
	
	
	
	$panelpaises = new Panel("../html/a_clientes.html");
	//$panelpaises->add("crear",'<a href="../php/a_crear_empleado.php">Crear Empleado</a>');

	
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
	$result= mysql_query("SELECT p.per_cedula, p.per_nombre1 ,p.per_apellido1 FROM persona p WHERE p.per_tipo='Cliente' ORDER BY p.per_cedula");

	
	while($row = mysql_fetch_array($result)){
	
	$tabla=
  
  '<tr align="center">
      <td width="99" height="21">'.$row["per_cedula"].'</td>
      <td width="263"><div align="center">'.$row["per_nombre1"].'</td>
	  <td width="263"><div align="center">'.$row["per_apellido1"].'</td>
	 <td width="279"><a href="../php/a_ver_perfilcliente.php?ced='.$row['per_cedula'].'">Ver Perfil</a> </td>
    </tr>';
  
  
  
   $tabla_completa = $tabla_completa.$tabla;
  
   }
	
	mysql_free_result($result);
	
	$panelpaises->add("informacion",$tabla_completa);
	
	$admin->add("contenido",$panelpaises);
	
	
	
				
	$admin->show();
 	include "../db/cerrar_conexion.php";
?>
