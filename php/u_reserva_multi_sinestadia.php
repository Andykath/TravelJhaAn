<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
		
	$cedula=$_SESSION['cedula'];
	$cedulaaux=$_SESSION['cedulaaux'];
	$res5=mysql_query("SELECT MAX(pre_paseo) AS max  FROM  presupuesto");
								$ro5 = mysql_fetch_array($res5);
		          				$devuelve5=$ro5['max'];
								
								//echo($devuelve5);	
								 
    global $mivariable;
	$mivariable=$devuelve5;
	if(!(isset($_GET['pregunta'])))
	{
	$mivariable=$mivariable+1;
	}
	if($_GET['pregunta']=='Si')
	{
	$mivariable=$mivariable+1;
	}
	
	$admin= new Panel("../html/usuario.html");
	
	$admin->add("body",'<body onLoad = "actual(3)" >');
	
	$panelcuentas = new Panel("../html/u_reserva_multi_conestadia.html");
	
	
	$result= mysql_query("SELECT v.via_id,v.via_fecha_ini,p.pre_abono,p.pre_habitacion,p.pre_cant_per,p.pre_paseo,p.pre_total,p.fk_via_id_origen,p.fk_via_id_destino,p.pre_id FROM  presupuesto p,viaje v WHERE  p.fk_per_cedula='$cedula' AND p.pre_status='No comprado' and p.pre_paseo IS NOT NULL and p.pre_habitacion IS NULL and v.fk_pre_id=p.pre_id and v.via_tipo='Reserva' ORDER BY v.via_id");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	
	while($row = mysql_fetch_array($result))
	{
	
	$tabla='
    <tr align="center">
      <td width="81" height="21">'.$row["pre_paseo"].'</td>
	   <td width="181"><div align="center">'.$row[0].'</td>
	  <td width="306"><div align="center">'.$row[0].'</td>
				<td width="210"><div align="center">'.$row["fk_via_id_origen"].'</td>
                <td width="210"><div align="center">'.$row["fk_via_id_destino"].'</td>
					    <td width="210"><div align="center">'.$row["pre_cant_per"].'</td>			
				<td width="210"><div align="center">'.$row["pre_abono"].'</td>
				<td width="210"><div align="center">'.$row["pre_total"].'</td>	
	  <td width="300"><a href="../php/u_comprarR_multi_conestadia.php?id='.$row['pre_id'].'&fecha='.$row['pre_fecha'].'&hotel='.$row['hot_nombre'].'&habitacion='.$row['pre_habitacion'].'&servicio='.$row['ser_nombre'].'&origen='.$row['fk_via_id_origen'].'&destino='.$row['fk_via_id_destino'].'&paseo='.$row['pre_paseo'].'&total='.$row['pre_total'].'&cantper='.$row['pre_cant_per'].'&id2='.$row['via_id'].'">Comprar</a> 
    </tr>';
	    
		$tabla_completa= $tabla_completa.$tabla;
		//$_SESSION['cant']=$row['pre_cant_per'];
	
	}
	
	
	mysql_free_result($result);
	//echo($cant);
	
	
	

	


	
	$panelcuentas->add("informacion",$tabla_completa);
	$admin->add("contenido",$panelcuentas);
	
	
	
				
	$admin->show();
include "../db/cerrar_conexion.php";
?>