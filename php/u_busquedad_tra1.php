<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	$cedula=$_SESSION['cedula'];
		extract($_POST);
	$cedulaaux=$_SESSION['cedulaaux'];
	$admin= new Panel("../html/usuario.html");
	
	$admin->add("body",'<body onLoad = "actual(4)" >');

	$panelcuentas = new Panel("../html/u_busquedad_tra1.html");
	
	
	if ($tra=='Aereo')
	{

	// echo("$tra,$combo,$combo1");
	$result= mysql_query("SELECT DISTINCT a.aer_nombre,o.des_nombre,d.des_nombre,i.via_id,f.via_id, (SELECT c.cos_costo FROM  costo c where c.fk_via_origen=i.via_id and c.fk_via_destino= f.via_id) as cos FROM aerolinea a, destino o, destino d, via i, via f, flota flo  WHERE i.fk_des_id='$combo' and f.fk_des_id='$combo1' and i.fk_aer_id=f.fk_aer_id and i.fk_aer_id=a.aer_id and o.des_id='$combo' and d.des_id='$combo1' and flo.fk_aer_id=a.aer_id and (flo.flo_actual>='$cantper') order by cos");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	
	while($row = mysql_fetch_array($result))
	{
		//echo($row[3]);
		//echo($row[4]);
		 
		  /* $res1=mysql_query("SELECT c.cos_costo FROM  costo c where c.fk_via_origen=".$row[3]." and c.fk_via_destino= ".$row[4]." ORDER BY c.cos_costo");
							
							
							$ro1 = mysql_fetch_array($res1);
							$costo=$ro1['cos_costo'];	*/
		
		
	//echo($costo);
	$tabla='
    <tr align="center">
      <td width="81" height="21">'.$row[0].'</td>
	  <td width="306"><div align="center">'.$row[1].'</td>
	  <td width="181"><div align="center">'.$row[2].'</td>
	  <td width="181"><div align="center">'.$row[5].'</td>
      <td width="181"><div align="center">'.$fecha.'</td>

    </tr>';
	    
		$tabla_completa= $tabla_completa.$tabla;
		//$_SESSION['cant']=$row['pre_cant_per'];
	
	}
	
	
	mysql_free_result($result);
	//echo($cant);
	
	$panelcuentas->add("informacion",$tabla_completa);
	}
	else if($tra=='Maritimo')
	{
	// echo("$tra,$combo,$combo1");
	$result= mysql_query("SELECT DISTINCT a.cru_nombre,o.des_nombre,d.des_nombre,i.via_id,f.via_id, (SELECT c.cos_costo FROM  costo c where c.fk_via_origen=i.via_id and c.fk_via_destino= f.via_id) as cos FROM crucero a, destino o, destino d, via i, via f, flota flo  WHERE i.fk_des_id='$combo' and f.fk_des_id='$combo1' and i.fk_cru_id=f.fk_cru_id and i.fk_cru_id=a.cru_id and o.des_id='$combo' and d.des_id='$combo1' and flo.fk_cru_id=a.cru_id and (flo.flo_actual>='$cantper') order by cos");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	
	while($row = mysql_fetch_array($result))
	{
		//echo($row[3]);
		//echo($row[4]);
		 
		  /* $res1=mysql_query("SELECT c.cos_costo FROM  costo c where c.fk_via_origen=".$row[3]." and c.fk_via_destino= ".$row[4]." ORDER BY c.cos_costo");
							
							
							$ro1 = mysql_fetch_array($res1);
							$costo=$ro1['cos_costo'];	*/
		
		
	//echo($costo);
	$tabla='
    <tr align="center">
      <td width="81" height="21">'.$row[0].'</td>
	  <td width="306"><div align="center">'.$row[1].'</td>
	  <td width="181"><div align="center">'.$row[2].'</td>
	  <td width="181"><div align="center">'.$row[5].'</td>
      <td width="181"><div align="center">'.$fecha.'</td>

    </tr>';
	    
		$tabla_completa= $tabla_completa.$tabla;
		//$_SESSION['cant']=$row['pre_cant_per'];
	
	}
	
	
	mysql_free_result($result);
	//echo($cant);
	
	$panelcuentas->add("informacion",$tabla_completa);
		
		}
		if ($tra='Terrestre')
		{
	// echo("$tra,$combo,$combo1");
	$result= mysql_query("SELECT DISTINCT a.ter_nombre,o.des_nombre,d.des_nombre,i.via_id,f.via_id, (SELECT c.cos_costo FROM  costo c where c.fk_via_origen=i.via_id and c.fk_via_destino= f.via_id) as cos FROM terrestre a, destino o, destino d, via i, via f, flota flo  WHERE i.fk_des_id='$combo' and f.fk_des_id='$combo1' and i.fk_ter_id=f.fk_ter_id and i.fk_ter_id=a.ter_id and o.des_id='$combo' and d.des_id='$combo1' and flo.fk_ter_id=a.ter_id and (flo.flo_actual>='$cantper') order by cos");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	
	while($row = mysql_fetch_array($result))
	{
		//echo($row[3]);
		//echo($row[4]);
		 
		  /* $res1=mysql_query("SELECT c.cos_costo FROM  costo c where c.fk_via_origen=".$row[3]." and c.fk_via_destino= ".$row[4]." ORDER BY c.cos_costo");
							
							
							$ro1 = mysql_fetch_array($res1);
							$costo=$ro1['cos_costo'];	*/
		
		
	//echo($costo);
	$tabla='
    <tr align="center">
      <td width="81" height="21">'.$row[0].'</td>
	  <td width="306"><div align="center">'.$row[1].'</td>
	  <td width="181"><div align="center">'.$row[2].'</td>
	  <td width="181"><div align="center">'.$row[5].'</td>
      <td width="181"><div align="center">'.$fecha.'</td>

    </tr>';
	    
		$tabla_completa= $tabla_completa.$tabla;
		//$_SESSION['cant']=$row['pre_cant_per'];
	
	}
	
	
	mysql_free_result($result);
	//echo($cant);
	
	$panelcuentas->add("informacion",$tabla_completa);
			
			
			
			}
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>