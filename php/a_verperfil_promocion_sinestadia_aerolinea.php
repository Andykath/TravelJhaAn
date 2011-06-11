<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	 extract($_GET); 
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(9)" >');

	$panelmiperfil = new Panel("../html/a_verperfil_promocion_sinestadia_aerolineas.html");
	//$panelpaises->add("crear",'<a href="../php/a_crear_empleado.php">Crear Empleado</a>');
   $cedula_actual=$_SESSION['cedula'];
	
    $mensaje = $_REQUEST['mensaje'];
	if($mensaje==1)
	{
	$panelmiperfil->add("mensaje",'Se Agrego el nuevo registro');
	}
	else if($mensaje==2)
	{
	$panelmiperfil->add("mensaje",'Se Edito el registro');
	}
	else if($mensaje==4)
	{
	$panelmiperfil->add("mensaje",'Ya existe ese pais');
	}

	echo $fkvia2;
	$result= mysql_query("SELECT p.per_cedula, p.per_nombre1 ,p.per_apellido1, p.per_sexo, p.per_direccion, p.per_fecha_nac, p.per_edo_civil,p.per_nacionalidad, p.per_visa,p.per_pasaporte,p.per_apellido2,p.per_nombre2,u.usu_login,u.usu_id,u.usu_password FROM persona p LEFT JOIN usuario u ON p.per_cedula = u.fk_per_cedula WHERE p.per_cedula='$cedula_actual' ORDER BY p.per_cedula");
	//echo "$row['per_nombre1']";
    $row = mysql_fetch_array($result);

	$panelmiperfil->add("fechai",$fechai);
	$panelmiperfil->add("fechaf",$fechaf);
	
	$panelmiperfil->add("aernombre",$aernombre);
	$panelmiperfil->add("nombrepro",$nombrepro);
	$panelmiperfil->add("descuento",$descuento);
	$panelmiperfil->add("duracion",$duracion);
	$panelmiperfil->add("fkvia",$fkvia);
   $panelmiperfil->add("destino",$destino);
	$panelmiperfil->add("links",'<a href="../php/a_modificar_promocion_sinestadia_aerolinea.php?nombrepro='.$nombrepro.'&id='.$id.'&fechai='.$fechai.'&fechaf='.$fechaf.'&descuento='.$descuento.'&duracion='.$duracion.'&fkvia='.$fkvia.'&aernombre='.$aernombre.'&aerid='.$aerid.'&destino='.$destino.'">Modificar</a> <a href="../php/a_eliminar_promocion_sinestadia_aerolinea.php?proid='.$id.'" onclick="return confirmar()">Eliminar</a>');
   
   

	
	
	mysql_free_result($result);

	
	$admin->add("contenido",$panelmiperfil);
	
	
	
				
	$admin->show();
 	include "../db/cerrar_conexion.php";
?>
