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
	$panelbuscarusuario= new Panel("../html/u_buscarusuario.html");
	
	
	extract($_REQUEST);
	
	$usu_actual= $_SESSION['email'];
	
	if($buscaramigos){
	
		$result=mysql_query("select u.nom_usu,u.ape_usu, u.email from usuario u where 'S'=(SELECT aprobado FROM  `solicitud` WHERE id_solicitud IN (SELECT MAX( id_solicitud ) FROM solicitud WHERE email_solicitante=u.email)) and (u.nom_usu LIKE '%$buscaramigos%' or u.ape_usu LIKE '%$buscaramigos%') and u.email NOT IN (select a.email_ami1 from usuario_amigo a where a.email_ami2='$usu_actual' and a.email_ami1=u.email) and u.email NOT IN (select a.email_ami2 from usuario_amigo a where a.email_ami1='$usu_actual' and a.email_ami2=u.email) and u.email<>'$usu_actual' ORDER BY u.nom_usu,u.ape_usu");
	
	
	/*$result=mysql_query("select u.nom_usu,u.ape_usu, u.email,aux.aprobado from (SELECT aprobado FROM  `solicitud` WHERE id_solicitud IN (SELECT MAX( id_solicitud ) FROM solicitud WHERE email_solicitante=u.email))aux,usuario u where (u.nom_usu LIKE '%$buscaramigos%' or u.ape_usu LIKE '%$buscaramigos%') and aux.aprobado='S' and u.email NOT IN (select a.email_ami1 from usuario_amigo a where a.email_ami2='$usu_actual' and a.email_ami1=u.email) and u.email NOT IN (select a.email_ami2 from usuario_amigo a where a.email_ami1='$usu_actual' and a.email_ami2=u.email) and u.email<>'$usu_actual' ORDER BY u.nom_usu,u.ape_usu");*/
	
	if (mysql_num_rows($result)==0)	{
	
	$panelbuscarusuario->add("informacion",'Tu busqueda no ha producido resultados!');
	}
	else{
     	$tablacompleta="";
		while($row=mysql_fetch_array($result)){
		$emailaux=$row['email'];
		$result2=mysql_query("select * from usuario_solicitaamistad where aceptado<>'S' and ((email_solicitante='$emailaux' and
							email_solicitado='$usu_actual')or(email_solicitante='$usu_actual' and email_solicitado='$emailaux'))");
		if (mysql_num_rows($result2)==0) $mensaje='<a href="../php/u_procesarsolicitud.php?tipo=3&email='.$row['email'].'">Agregar</a>';
		else
			{
				$row2=mysql_fetch_array($result2);
				if ($row2['email_solicitante']==$usu_actual) $mensaje='Solicitud enviada';
				else $mensaje='<a href="../php/u_procesarsolicitud.php?tipo=1&email='.$row['email'].'">Aceptar</a> / <a href="../php/u_procesarsolicitud.php?tipo=2&email='.$row['email'].'">Rechazar</a>';
			}
		$tabla='<table width="460" height="40" border="0">
  <tr>
    <th width="414" scope="col" align="left" >'.$row['nom_usu'].' '.$row['ape_usu'].'</th>
	    <td width="160" scope="col">'.$mensaje.'</td>
  </tr>
</table>';
	
		$tabla_completa=$tabla_completa.$tabla;
		
		mysql_free_result($result2);
		
		}
		mysql_free_result($result);
		$panelbuscarusuario->add("informacion",$tabla_completa);
	
	}
	
	}
	
	$user->add("contenido",$panelbuscarusuario);
	
				
	$user->show();
	include "../db/cerrar_conexion.php";
?>