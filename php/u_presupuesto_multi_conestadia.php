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
	
	$panelcuentas = new Panel("../html/u_presupuesto_multi_conestadia.html");
	$panelcuentas->add("crear",'<a href="../php/u_crear_presupuesto_multi_conestadia.php?mivariable='.$mivariable.'">Realizar un Presupuesto</a>');
	
	
	$result= mysql_query("SELECT p.pre_id,p.pre_fecha,p.pre_abono,p.pre_cant_per,p.pre_paseo,p.pre_total,p.fk_via_id_origen,p.fk_via_id_destino FROM  presupuesto p WHERE  p.fk_per_cedula='$cedula' AND p.pre_status='No comprado' and p.pre_paseo IS NOT NULL ORDER BY p.pre_id");
	//$result=mysql_query("SELECT cue_id,cue_numero,cue_tipo,cue_fecha_apertura,fk_ban_id FROM cuenta_bancaria");
	
	while($row = mysql_fetch_array($result))
	{
	
	$tabla='
    <tr align="center">
      <td width="81" height="21">'.$row["pre_paseo"].'</td>
	   <td width="181"><div align="center">'.$row["pre_id"].'</td>
	  <td width="306"><div align="center">'.$row["pre_fecha"].'</td>
				<td width="210"><div align="center">'.$row["fk_via_id_origen"].'</td>
                <td width="210"><div align="center">'.$row["fk_via_id_destino"].'</td>
					    <td width="210"><div align="center">'.$row["pre_cant_per"].'</td>			
				<td width="210"><div align="center">'.$row["pre_abono"].'</td>
				<td width="210"><div align="center">'.$row["pre_total"].'</td>	
	  <td width="300"><a href="../php/u_comprar_multi_conestadia.php?id='.$row['pre_id'].'&fecha='.$row['pre_fecha'].'&origen='.$row['fk_via_id_origen'].'&destino='.$row['fk_via_id_destino'].'&paseo='.$row['pre_paseo'].'&total='.$row['pre_total'].'&cantper='.$row['pre_cant_per'].'">Comprar</a>
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