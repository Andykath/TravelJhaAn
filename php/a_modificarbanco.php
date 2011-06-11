<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	extract($_POST);
	extract($_GET);

	
	     if($ban_nombre)
		 {
	       
	        
			$result= mysql_query("SELECT * FROM banco WHERE ban_nombre = '$ban_nombre'");
			$row = mysql_fetch_array($result);
			
			if ($row)
			{
			
			$admin = new Panel("../html/admin.html");
	        $admin->add("body",'<body onLoad = "actual(11)">');
	        $pantallamodifbanco = new Panel("../html/a_modificar_banco.html");
			$pantallamodifbanco->add("form",'<form id="form1" name="form1" method="post" action="../php/a_modificarbanco.php?ban_id='.$ban_id.'&nombre='.$nombre.'">');
			$pantallamodifbanco->add("tipo_boton",'Modificar');
			$pantallamodifbanco->add("ban_nombre",$nombre);
			$pantallamodifbanco->add("error",'Ya hay un banco registrado como '.$row["ban_nombre"].'!');
		    $admin->add("contenido",$pantallamodifbanco);			
	        $admin->show();

			}
			else
			{

			mysql_query("UPDATE banco SET ban_nombre='$ban_nombre' WHERE ban_id = $ban_id");

			$hola='a_bancos.php?mensaje=1';
			header("Location:$hola");
			
			
			}
	
		}
		else
		{
		
		$admin = new Panel("../html/admin.html");
	    $admin->add("body",'<body onLoad = "actual(11)" >');
	    $pantallamodifbanco = new Panel("../html/a_modificar_banco.html");
	    $pantallamodifbanco->add("form",'<form id="form1" name="form1" method="post" action="../php/a_modificarbanco.php?ban_id='.$ban_id.'&nombre='.$nombre.'">');
     	$pantallamodifbanco->add("tipo_boton",'Modificar');
		$pantallamodifbanco->add("ban_nombre",$nombre);
		//print $ban_id;
		$admin->add("contenido",$pantallamodifbanco);
	    $admin->show();
		
		}
	

			
	
    include "../db/cerrar_conexion.php";
?>