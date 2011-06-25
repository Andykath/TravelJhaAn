<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	extract($_POST);
	extract($_GET);
	$admin= new Panel("../html/usuario.html");
	
	$admin->add("body",'<body onLoad = "actual(3)" >');
	
	$panelcuentas = new Panel("../html/u_habitacioneshotel.html");
	
	$tabla_completa="";
	
	$mensaje = $_REQUEST['mensaje'];
	if($mensaje==3)
	{
								$panelcuentas->add("error",'');
	}
	
	$result= mysql_query("SELECT h.hab_id,h.hab_piso,h.hab_capacidad,h.hab_costo,h.fk_hot_id, g.hot_nombre, g.hot_id, g.fk_des_id FROM habitacion h LEFT OUTER JOIN hotel g ON h.fk_hot_id = g.hot_id WHERE h.hab_tipo='Hotel' AND h.fk_hot_id= $cue_id ORDER BY h.hab_id");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	
	
	
	
	while($row = mysql_fetch_array($result))
	{
	$ok2=mysql_query("SELECT m.mon_descripcion from moneda m where m.mon_id=(SELECT d.fk_mon_id
						FROM destino d, destino g
						WHERE g.fk_des_id = d.des_id
						AND g.des_id='".$row["fk_des_id"]."')");
			          $rowok2 = mysql_fetch_array($ok2);
		              $mete2=$rowok2['des_id'];
					//  echo $rowok2["mon_descripcion"];
					  
	$tabla='
    <tr align="center">
      <td width="120" height="21">'.$row["hab_id"].'</td>
	  <td width="163"><div align="center">'.$row["hab_piso"].'</td>
	  <td width="211"><div align="center">'.$row["hab_capacidad"].'</td>
	  <td width="175"><div align="center">'.$row["hab_costo"].'</td>
	  <td width="175"><div align="center">'.$row["hab_costo"]/$rowok2["mon_descripcion"].'</td>
	  <td width="216"><div align="center">'.$row["hot_nombre"].'</td>
	  
    </tr>';
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	
	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>