<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	 extract($_GET); 
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(9)" >');

	$panelmiperfil = new Panel("../html/a_verperfil_promocion_estadia_aerolineas.html");
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

	$panelmiperfil->add("tipoviaje",$tipoviaje);
	
	$panelmiperfil->add("mil",$millas);
	$panelmiperfil->add("tipopaq",$tipopaq);
	$panelmiperfil->add("cantpaq",$cantpaq);
	$panelmiperfil->add("aernombre",$aernombre);
	
		
		$tablaequipos="";
		$tablaequipos1="";
   
  //$panelmiperfil->add("modif",'<a href="../php/u_telefonos.php?&cedula='.$row['per_cedula'].'">Gestionar</a>');
	$panelmiperfil->add("nombrepro",$nombrepro);
	$panelmiperfil->add("descuento",$descuento);
	$panelmiperfil->add("duracion",$duracion);
	$panelmiperfil->add("fkvia",$origen);
	$panelmiperfil->add("fkvia2",$destino);
	$panelmiperfil->add("fechai",$fechai);
	$panelmiperfil->add("fechaf",$fechaf);
	$panelmiperfil->add("id",$id);
   
   $result6=mysql_query("SELECT ho.hot_nombre , ho.hot_id FROM hotel ho WHERE ho.hot_id='$fkhab'");
	$row6 = mysql_fetch_array($result6);
                       $panelmiperfil->add("hotel",$row6['hot_nombre']);
		          

	
	$panelmiperfil->add("links",'<a href="../php/a_modificar_promocion_estadia_aerolinea.php?nombre='.$nombrepro.'&id='.$id.'&fechai='.$fechai.'&fechaf='.$fechaf.'&descuento='.$descuento.'&duracion='.$duracion.'&fkvia='.$origen.'&fkvia2='.$destino.'&fkviaid='.$fkviaid.'&fkviaid2='.$fkviaid2.'&hotel='.$row6['hot_id'].'&habitacion='.$row6['hab_id'].'">Modificar</a> <a href="../php/a_eliminar_promocion_estadia_aerolinea.php?idpro='.$id.'" onclick="return confirmar()">Eliminar</a>');
   	
	

	
	$admin->add("contenido",$panelmiperfil);
	
	
	
				
	$admin->show();
 	include "../db/cerrar_conexion.php";
?>
