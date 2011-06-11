<?php

session_start();

include "../db/conexion.php";



  

$email = $_POST["usuario"];

$pw = $_POST['pw'];



if ($email=='' || $pw=='') header("Location:login.php?mensaje=10");



else{



$result= mysql_query("SELECT p.per_cedula, p.per_nombre1 ,p.per_apellido1, p.per_sexo, p.per_direccion, p.per_fecha_nac, p.per_edo_civil,p.per_nacionalidad, p.per_visa,p.per_pasaporte,p.per_apellido2,p.per_nombre2, p.per_tipo,u.usu_login,u.usu_id,u.usu_password FROM persona p LEFT JOIN usuario u ON p.per_cedula = u.fk_per_cedula WHERE u.usu_login='$email' ORDER BY p.per_cedula");

	

							

						if($row= mysql_fetch_array($result))

						{

									

											if ($row["usu_password"] == $pw)

											{

											

											/*$result2=mysql_query("SELECT * FROM  `solicitud` WHERE id_solicitud IN (SELECT MAX( id_solicitud ) FROM 				  																solicitud WHERE email_solicitante ='$email')");

											

											$row2=mysql_fetch_array($result2);

																	

											if ($row2['aprobado']==S)*/

											

											

											



																	$_SESSION['nombre']=$row['per_nombre1'];

																	$_SESSION['apellido']=$row['per_apellido1'];

																	$_SESSION['admin']=$row['per_tipo'];

																	$_SESSION['email']=$email;

																	$_SESSION['pwd']=$pw;
																	
																	$_SESSION['cedula']=$row['per_cedula'];
																	$_SESSION['cedulaaux']=$row['per_cedula'];
																	

																	

																//	echo 'login correcto '.$_SESSION['nombre'].' ';

																	

																//	$mensajito='login.php?mensaje=1';

																	header ("Location:u_home.php");

												}

												/* else if ($row2['aprobado']==E){

												header ("Location:login.php?mensaje=5");

												}

												else if ($row2['aprobado']==N){

												

												$sol=$row2['id_solicitud'];

												$result3=mysql_query("SELECT descripcion from razon where id_solicitud=$sol");

												$row3=mysql_fetch_array($result3);

												$razon=$row3['descripcion'];

												mysql_free_result ($result2);

												mysql_free_result ($result3);

												echo "<script type=\"text/javascript\">alert(\"Solicitud Rechazada. Razon:$razon\"); window.location='login.php?mensaje=6&sol=$sol';</script>";  

												//header("Location:login.php?mensaje=6&sol=$sol");

												

												}*/

											

																	

																												

											//}

											else

																header ("Location:login.php?mensaje=2");

						}

						else

						

													header ("Location:login.php?mensaje=1");

						

						mysql_free_result ($result);

						

}//else

						

						

						

include "../db/cerrar_conexion.php";



?>

