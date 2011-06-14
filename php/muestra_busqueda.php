<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$panel = new Panel("../html/muestra_busqueda.html");
	
					$panel->add("transporte",$transporte);
					$panel->add("pais",$pais);
					$panel->add("ciudad",$ciudad);
					//$panel->add("otro",$otro);
					//$panel->add("retriro",$retiro);
					echo "otro".$otro;
					echo "retiro".$retiro;
					
					echo "ciudad".$ciudad;
					echo "pais".$pais;
					echo "trans".$transporte;
	$id=substr($transporte,0,1);
	$tip=substr($transporte,1,2);
	//echo "tipo".$tip;
	//echo "id".$id;
	if ($tip=='t')
	{
	$result= mysql_query("SELECT v.via_costo, v.via_terminal, a.ter_nombre, d.des_nombre as ciudad, o.des_nombre as pais  from via v, destino d, terrestre a, destino o where d.fk_des_id=o.des_id and a.ter_id='$id' and d.des_id='$ciudad' and v.fk_des_id=d.des_id and v.fk_ter_id=a.ter_id",$conexion) or die (mysql_error());
	$cant=mysql_num_rows($result);
	if ($cant==0)
	{
		$panel->add("error","En esta momento no esta disponible ese viaje");
	} 
	else
	{
	while($row = mysql_fetch_array($result))
	{
	$tabla='
    <tr align="center">
      <td width="110">'."Caracas, Venezuela".'</td>
	  <td width="119"><div align="center">'.$row["ciudad"].", ".$row["pais"].'</td>
	  <td width="117"><div align="center">'.$row["ter_nombre"].'</td>
      <td width="74"><div align="center">'.$row["via_costo"].'</td>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	$panel->add("informacion",$tabla_completa);
	}
	}
	else if ($tip=='c')
	{
	$result= mysql_query("SELECT v.via_costo, v.via_terminal, a.cru_nombre, d.des_nombre as ciudad, o.des_nombre as pais  from via v, destino d, crucero a, destino o where d.fk_des_id=o.des_id and a.cru_id='$id' and d.des_id='$ciudad' and v.fk_des_id=d.des_id and v.fk_cru_id=a.cru_id",$conexion) or die (mysql_error());
	$cant=mysql_num_rows($result);
	if ($cant==0)
	{
		$panel->add("error","En esta momento no esta disponible ese viaje");
	} 
	else
	{
	while($row = mysql_fetch_array($result))
	{
	
	$tabla='
    <tr align="center">
      <td width="110">'."Caracas, Venezuela".'</td>
	  <td width="119"><div align="center">'.$row["ciudad"].", ".$row["pais"].'</td>
	  <td width="117"><div align="center">'.$row["cru_nombre"].'</td>
      <td width="74"><div align="center">'.$row["via_costo"].'</td>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	$panel->add("informacion",$tabla_completa);
	}
	}
	else 
	{
	$result= mysql_query("SELECT v.via_costo, v.via_terminal, a.aer_nombre, d.des_nombre as ciudad, o.des_nombre as pais  from via v, destino d, aerolinea a, destino o where d.fk_des_id=o.des_id and a.aer_id='$id' and d.des_id='$ciudad' and v.fk_des_id=d.des_id and v.fk_aer_id=a.aer_id",$conexion) or die (mysql_error());
	$cant=mysql_num_rows($result);
	if ($cant==0)
	{
		$panel->add("error","En esta momento no esta disponible ese viaje");
	} 
	else
	{
	while($row=mysql_fetch_array($result))
	
	$tabla='
    <tr align="center">
      <td width="110">'."Caracas, Venezuela".'</td>
	  <td width="119"><div align="center">'.$row["ciudad"].", ".$row["pais"].'</td>
	  <td width="117"><div align="center">'.$row["aer_nombre"].'</td>
      <td width="74"><div align="center">'.$row["via_costo"].'</td>
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	mysql_free_result($result);
	$panel->add("informacion",$tabla_completa);
	}
	}
	$panel->show();
include "../db/cerrar_conexion.php";
?>