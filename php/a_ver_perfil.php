<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	 extract($_GET); 
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(4)" >');

	$panelmiperfil = new Panel("../html/a_ver_perfil.html");
	//$panelpaises->add("crear",'<a href="../php/a_crear_empleado.php">Crear Empleado</a>');

	
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

	//echo "$ced saad";
	$result= mysql_query("SELECT p.per_cedula, p.per_nombre1 ,p.per_apellido1, p.per_cant_millas, p.per_sexo, p.per_direccion, p.per_fecha_nac, p.per_edo_civil,p.per_nacionalidad, p.per_visa,p.per_pasaporte,p.per_apellido2,p.per_nombre2,u.usu_login,u.usu_id,u.usu_password FROM persona p LEFT JOIN usuario u ON p.per_cedula = u.fk_per_cedula WHERE p.per_tipo='Empleado' AND p.per_cedula='$ced' ORDER BY p.per_cedula");
	//echo "$row['per_nombre1']";
    $row = mysql_fetch_array($result);
	$panelmiperfil->add("nombre1",$row['per_nombre1']);
	$panelmiperfil->add("nombre2",$row['per_nombre2']);
	$panelmiperfil->add("apellido1",$row['per_apellido1']);
	$panelmiperfil->add("apellido2",$row['per_apellido2']);
	$panelmiperfil->add("cedula",$row['per_cedula']);
	$panelmiperfil->add("direccion",$row['per_direccion']);
	$panelmiperfil->add("fechanac",$row['per_fecha_nac']);
	$panelmiperfil->add("nacionalidad",$row['per_nacionalidad']);
	$panelmiperfil->add("edocivil",$row['per_edo_civil']);
	$panelmiperfil->add("sexo",$row['per_sexo']);
	$panelmiperfil->add("pasaporte",$row['per_pasaporte']);
	$panelmiperfil->add("visa",$row['per_visa']);
	$panelmiperfil->add("login",$row['usu_login']);
	$panelmiperfil->add("password",$row['usu_password']);
	$panelmiperfil->add("millas",$row['per_cant_millas']);
	$panelmiperfil->add("links",'<a href="../php/a_modificar_empleado.php?nombre1='.$row['per_nombre1'].'&nombre2='.$row['per_nombre2'].'&apellido1='.$row['per_apellido1'].'&apellido2='.$row['per_apellido2'].'&cedula='.$row['per_cedula'].'&direccion='.$row['per_direccion'].'&fechanac='.$row['per_fecha_nac'].'&sexo='.$row['per_sexo'].'&edocivil='.$row['per_aedo_civil'].'&pasaporte='.$row['per_pasaporte'].'&visa='.$row['per_visa'].'&login='.$row['usu_login'].'&password='.$row['usu_password'].'&nacionalidad='.$row['per_nacionalidad'].'&millas='.$row['per_cant_millas'].'">Modificar</a> <a href="../php/a_eliminar_empleado.php?cedula='.$row["per_cedula"].'" onclick="return confirmar()">Eliminar</a>');
   
   
   $panelmiperfil->add("modif",'<a href="../php/a_telefonos.php?&cedula='.$row['per_cedula'].'">Gestionar</a>');
		
   $result6=mysql_query("SELECT t.tel_numero,t.tel_tipo,t.tel_id FROM telefono t WHERE t.fk_per_cedula='$ced'");
	
	if (mysql_num_rows($result6)==0) $panelmiperfil->add("telefonos",'No tiene telefonos');
	else{
		
		$tablaequipos="";
		
		while($row6=mysql_fetch_array($result6))
					{ 
		$tabla='  <table width="386"  align="left" border="0">
        <tr>
          <th width="386" scope="col"><div align="left">'.$row6['tel_numero'].' '.$row6['tel_tipo'].'</div></th>
        </tr>
      </table>    '; 
	 
 							$tablaequipos= $tablaequipos.$tabla;
							$panelmiperfil->add("telefonos",$tablaequipos);
					}			

	}
	
	mysql_free_result($result);

	
	$admin->add("contenido",$panelmiperfil);
	
	
	
				
	$admin->show();
 	include "../db/cerrar_conexion.php";
?>
