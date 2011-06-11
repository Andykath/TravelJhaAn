<?php

	session_start();

	$pathFix = dirname(__FILE__);

	require_once ("../classes/Panel.php");

	$login= new Panel("../html/login.html");

	$mensaje = $_REQUEST['mensaje'];

	if($mensaje==1)

	{

	$login->add("mensaje",'Usuario invalido');

	}

	else if($mensaje==2)

	{

	$login->add("mensaje",'Contraseña incorrecta');

	}
	else if($mensaje==10)

	{

	$login->add("mensaje",'Campos incompletos!');

	}
	else if($mensaje==5)

	{

	$login->add("mensaje",'Usuario registrado con exito');

	}

	include "../db/conexion.php";
	$consulta=mysql_query("SELECT des_id, des_nombre FROM destino where fk_des_id IS NULL order by des_id ASC");
	//desconectar();
	$select='';
	// Voy imprimiendo el primer select compuesto por los paises
	
	while($registro=mysql_fetch_row($consulta))
	{
		$select_actual="<option value='".$registro[0]."'>".$registro[1]."</option>";
		$select=$select.$select_actual;
	}

	$login->add(pais,$select);
 $login->add("Aqui",'<a href="../php/u_registro.php">AQUI</a>');
 
 $result= mysql_query("SELECT p.pro_nombre, p.pro_descuento, o.hot_nombre FROM promocion p, habitacion h, hotel o WHERE o.hot_id=fk_hot_id and p.fk_hab_id=h.hab_id ORDER BY p.pro_descuento");

	
	while($row = mysql_fetch_array($result))
	{
	$des=$row["pro_descuento"]*100;
	$tabla='
    <tr align="center">
	  <td width="306"><div align="center">'.$row["pro_nombre"].'</td>
	  <td width="181"><div align="center">'.$des."%".'</td>
      <td width="210"><div align="center">'.$row["hot_nombre"].'</td>
	  </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	
	
	$login->add("informacion",$tabla_completa);
	
$login->show();
include "../db/cerrar_conexion.php";
?>

	