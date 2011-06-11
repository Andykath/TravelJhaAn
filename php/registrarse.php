<title>..::  Viajes Ucab  ::..</title>
<style type="text/css">
.style1 {
	font-family: Helvetica;
	font-size: 36px;
}
.style3 {font-size: 18px}
</style>
<?php

include "../db/conexion.php";
//session_start();
//$usuario =$_POST["login"];
//$cedula = $_POST["cedula"];
//echo $usuario; echo $cedula; 

if ( $_POST['cedula']==NULL or $_POST['nombre']==NULL or $_POST['apellido']==NULL or $_POST['login']==NULL or $_POST['contraseña']==NULL or $_POST['telefono1']==NULL or $_POST['fecha']==NULL or $_POST['pais']==NULL or $_POST['direccion']==NULL or $_POST['sexo']==NULL or  $_POST['estcivil']==NULL or $_POST['tipo_tel']==NULL )
{
	?>
		<script>
		window.alert("Disculpe. Faltan campos por llenar") 
		location = "../html/registro.html";
	    </script>
        <?php
}
else
{
//$query = "SELECT usu_login FROM usuario WHERE usu_login = '$usuario'";
$result = mysql_query ("SELECT usu_login FROM usuario WHERE usu_login = '$usuario'", $conexion); 
//$myrow = mysql_fetch_array($result);
//echo $myrow;
if ($row = mysql_fetch_array($result)) 
{
    ?>
		<script>
		window.alert("Disculpe este Usuario ya existe!.") 
		location = "../html/registro.html";
	    </script>
        <?php
}
else
{

$date = date("Y-m-d") ;
/*echo $date;
$fecha = mysql_query("SELECT CURDATE( )");
if($date > $fecha2)
echo "mayor";*/
//$query2 = "SELECT per_cedula FROM persona WHERE per_cedula = '$cedula'";
$query2 = mysql_query ("SELECT per_cedula FROM persona WHERE per_cedula = '$cedula'",$conexion);
$myrow2= mysql_fetch_array($query2); 
//echo "cedula ".$myrow2["per_cedula"]; 
if ($myrow2!=0) {
	
    ?>
		<script>
		window.alert("Disculpe este Cliente ya esta registrado!.") 
		location = "../html/registro.html";
	    </script>
        <?php
}
else
{
$result1=mysql_query("INSERT INTO  `persona` (`per_cedula` ,`per_nombre1` ,`per_nombre2` ,`per_apellido1` ,`per_apellido2` ,`per_sexo` ,`per_tipo` ,`per_direccion` ,`per_fecha_nac` ,`per_edo_civil` ,`per_nacionalidad` ,`per_visa` ,`per_pasaporte`,`per_cant_millas`)  VALUES ('{$_POST["cedula"]}', '{$_POST["nombre"]}', '{$_POST["nombre2"]}', '{$_POST["apellido"]}', '{$_POST["apellido2"]}','{$_POST["sexo"]}', 'Cliente', '{$_POST["direccion"]}', '{$_POST["fecha"]}', '{$_POST["estcivil"]}', '{$_POST["pais"]}', NULL, NULL, '0')") or die(mysql_error());


$result2=mysql_query("INSERT INTO `telefono` (`tel_id` ,`tel_numero` ,`tel_tipo` ,`fk_per_cedula`) VALUES (NULL, '{$_POST["telefono1"]}', '{$_POST["tipo_tel"]}', '{$_POST["cedula"]}')", $conexion) or die('error en primer telefono '.mysql_error());

if ($_POST["telefono2"]!=NULL)
{
	if ($_POST["tipo_tel2"]==NULL)
	{
		?>
		<script>
		window.alert("Disculpe. Faltan campos por llenar") 
		location = "../html/registro.html";
	    </script>
        <?php
	}
	else
	{
	$result4=mysql_query("INSERT INTO  `telefono` (`tel_id` ,`tel_numero` ,`tel_tipo` ,`fk_per_cedula`) VALUES (NULL, '{$_POST["telefono2"]}', '{$_POST["tipo_tel2"]}', '{$_POST["cedula"]}')", $conexion) or die('error en el segundo telefono '.mysql_error());
	}
}
$result3=mysql_query("INSERT INTO  `usuario` (`usu_id` ,`usu_login` ,`usu_password` ,`fk_per_cedula`) VALUES (NULL ,'{$_POST["login"]}', '{$_POST["contraseña"]}', '{$_POST["cedula"]}')") or die ('error en usuario'.mysql_error());
//$row = mysql_fetch_array($result);
//$sol=$row['ultimoid'];

	//header("Location:login.php?mensaje=4&sol=$sol");

}
//mysql_free_result($result);

						
}
}
include "../db/cerrar_conexion.php";
?>

<form id="form1" name="form1" method="post" action="">
  <table width="466" height="318"  border="0" align="center"  cellpadding="0" cellspacing="0" bgcolor="#009999">
      <td colspan="2" align="center"><p><img src="../imagenes/logo.gif" width="234" height="130" /></p>
        <p><strong><span class="style1">Bienvenido</span></strong></p>
        <p>Registro Exitoso. Ya eres parte de nuestros usuarios!<br /></p>
        <a href="#"  onclick=window.close('../html/registro.html');                                return false> Regresar   </a>

        </p>
      </table>
</form>


