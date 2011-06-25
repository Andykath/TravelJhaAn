<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$user = new Panel("../html/usuario.html");
	$user->add("body",'<body onLoad = "actual(2)">');
	
	$nombre=$_SESSION['nombre'];
	$apellido=$_SESSION['apellido'];
	$user->add("nombre",$nombre);
	$user->add("apellido",$apellido);
	
	$paneleditarcuenta= new Panel("../html/u_editarcuenta.html");
	
	$usu_actual= $_SESSION['email'];
	
	
	
	
	extract($_POST);
	
	if( ($nombre)&&($apellido)&&($telefono)&&($pais)&&($profesion)&&($fecha)&&($pwd)){
	mysql_query("UPDATE  usuario SET nom_usu='$nombre',ape_usu='$apellido',telefono='$telefono',
				nacionalidad='$pais',profesion='$profesion',fecha_nac_usu='$fecha',pwd='$pwd'  WHERE email =  '$usu_actual'");
				
				$_SESSION['nombre']=$nombre;
				$_SESSION['apellido']=$apellido;													
				$_SESSION['pwd']=$pwd;
	header ("Location:u_miperfil.php");
	
	}
	
	
	
	$result=mysql_query("Select u.nom_usu,u.ape_usu,u.pwd,u.telefono,u.email,u.fecha_nac_usu,u.profesion,u.nacionalidad,p.nom_pais from usuario u,pais p where u.email='$usu_actual' and u.nacionalidad=p.id_pais");
	$row = mysql_fetch_array($result);
	
	$paneleditarcuenta->add("nombre",$row['nom_usu']);
	$paneleditarcuenta->add("apellido",$row['ape_usu']);
	$paneleditarcuenta->add("telefono",$row['telefono']);
	$paneleditarcuenta->add("email",$row['email']);
	$paneleditarcuenta->add("fecha",$row['fecha_nac_usu']);
	$paneleditarcuenta->add("pwd",$row['pwd']);

		$select='';
		$result2= mysql_query("SELECT * FROM  pais p ORDER BY nom_pais ASC");
        	while($row2 = mysql_fetch_array($result2))
        	{
			if($row2["id_pais"]== $row["nacionalidad"])
			$select_actual='<option  selected="selected" value="'.$row2["id_pais"].'">'.$row2["nom_pais"].'</option>';
			else
			$select_actual='<option value="'.$row2["id_pais"].'">'.$row2["nom_pais"].'</option>';
			$select=$select.$select_actual;
			}
			
			$paneleditarcuenta->add("pais",$select);
	
	
	
	mysql_free_result($result);
	mysql_free_result($result2);

	
	
	$user->add("contenido",$paneleditarcuenta);
	
				
	$user->show();
	include "../db/cerrar_conexion.php";
?>