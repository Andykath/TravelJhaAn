<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/usuario.html");
	$admin->add("body",'<body onLoad = "actual(3)" >');
	$paneldetallefactura = new Panel("../html/u_verboleto_undestino_sinestadia_aereo.html");
	$cedula=$_SESSION['cedula'];
	extract ($_REQUEST);
	
	$tabla_completa = "";
	$tabla_completa1 = "";


	//echo("hola");
	
	$result3= mysql_query("SELECT p.per_cedula,p.per_nombre1,p.per_apellido1,b.bol_id,b.bol_fecha_emi FROM persona p, boleto b WHERE  p.per_cedula='$cedula' AND b.fk_per_cedula='$cedula' and b.fk_via_id='$viaje' ORDER BY p.per_cedula");
	
	$row3 = mysql_fetch_array($result3);
	$cedula1 = $row3["per_cedula"];
	$nombre1 = $row3["per_nombre1"];
	$acoapellido1 = $row3["per_apellido1"];
	$idboleto1 = $row3["bol_id"];
	$bolfecha1 = $row3["bol_fecha_emi"];
	
	
	
	$result2= mysql_query("SELECT v.via_id,v.fk_flo_id, v.via_fecha_ini, v.via_fecha_fin, v.via_hora_ini, v.via_hora_fin, d.des_nombre, vi.via_terminal, a.aer_nombre FROM viaje v, via vi, destino d, aerolinea a
WHERE v.via_id = '$viaje' AND v.fk_via_id_destino = vi.via_id AND vi.fk_des_id = d.des_id
AND vi.fk_aer_id=a.aer_id ORDER BY v.via_id");

$row2 = mysql_fetch_array($result2);
	
	$flota = $row2["fk_flo_id"];
	$fechasalida = $row2["via_fecha_ini"];
	$fechallegada = $row2["via_fecha_fin"];
	$horasalida = $row2["via_hora_ini"];
	$horallegada = $row2["via_hora_fin"];
	$destino = $row2["des_nombre"];
	$aeropuerto = $row2["via_terminal"];
    $aerolinea = $row2["aer_nombre"];
	
	

	$paneldetallefactura->add("emisor",'<table width="500" style="border:2px solid #0033CC"; cellpadding="0" cellspacing="0">
   <tr>
      <td colspan="10"><p><p><img src="../imagenes/logo.gif" width="200" height="113" align="right" /></p>
        <strong>© Copyright Viajes Ucab | Producciones SzcoPa.</strong></p>
		 
          <p><strong>Nro.boleto:</strong>'.$idboleto1.'</p>
          <p><strong>Nombre:</strong>'.$nombre1.'</p>
          <p><strong>Apellido:</strong>'.$acoapellido1.'</p>
           <p><strong>Cedula:</strong>'.$cedula1.'</p>
          <p><strong>Fecha Emision Boleto:</strong> '.$bolfecha1.'</p>
		  <p><strong>Aerolinea:</strong>'.$aerolinea.'</p>
		  <p><strong>Flota:</strong>'.$flota.'</p>
		  <p><strong>Lugar destino:</strong>'.$destino.'</p>
		  <p><strong>Aeropuerto:</strong>'.$aeropuerto.'</p>
          <p><strong>Fecha Salida:</strong>'.$fechasalida.'</p>
		  <p><strong>Hora Salida:</strong>'.$horasalida.'</p>
          <p><strong>fecha Llegada:</strong>'.$fechallegada.'</p>
		    <p><strong>Hora Llegada:</strong>'.$horallegada.'</p>
			 <em>Informacion:<br />
           <table width="900" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="34" align="center"><strong>Nro. Puerta: </strong>A-52</td>
        <td width="126" align="center"><strong>Nro. Pasillo: </strong>B</td>
      </tr>
	  </tr>
    <td width="800" height="46" align="center"><strong>"Somos calidad, somos lo mejor a la hora viajar"..Viajes UCAB SzcoPa</strong></td>
 
  </tr>
    </table>
  </table>');
	
	
	
	
	
	
	$result= mysql_query("SELECT b.bol_id,b.bol_fecha_emi,a.aco_nombre,a.aco_apellido,a.aco_cedula FROM acompanante a,boleto b WHERE  a.fk_via_id='$viaje'  AND a.fk_per_cedula='$cedula' AND b.fk_aco_id=a.aco_id  ORDER BY b.bol_id");
   while($row = mysql_fetch_array($result))
	{
	
	
	$idboleto = $row["bol_id"];
	$bolfecha = $row["bol_fecha_emi"];
	$aconombre = $row["aco_nombre"];
	$acoapellido = $row["aco_apellido"];
	$acocedula = $row["aco_cedula"];

	
	$tabla='
	<table width="500" style="border:2px solid #0033CC"; cellpadding="0" cellspacing="0">
   <tr>
      <td colspan="10"><p><p><img src="../imagenes/logo.gif" width="200" height="113" align="right" /></p>
        <strong>© Copyright Viajes Ucab | Producciones SzcoPa.</strong></p>
		 
          <p><strong>Nro.boleto:</strong>'.$idboleto.'</p>
          <p><strong>Nombre:</strong>'.$aconombre.'</p>
          <p><strong>Apellido:</strong>'.$acoapellido.'</p>
           <p><strong>Cedula:</strong>'.$acocedula.'</p>
          <p><strong>Fecha Emision Boleto:</strong> '.$bolfecha.'</p>
		  <p><strong>Aerolinea:</strong>'.$aerolinea.'</p>
		  <p><strong>Flota:</strong>'.$flota.'</p>
		  <p><strong>Lugar destino:</strong>'.$destino.'</p>
		  <p><strong>Aeropuerto:</strong>'.$aeropuerto.'</p>
          <p><strong>Fecha Salida:</strong>'.$fechasalida.'</p>
		  <p><strong>Hora Salida:</strong>'.$horasalida.'</p>
          <p><strong>fecha Llegada:</strong>'.$fechallegada.'</p>
		    <p><strong>Hora Llegada:</strong>'.$horallegada.'</p>
			 <em>Informacion:<br />
           <table width="900" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="34" align="center"><strong>Nro. Puerta: </strong>A-52</td>
        <td width="126" align="center"><strong>Nro. Pasillo: </strong>B</td>
      </tr>
	  </tr>
    <td width="800" height="46" align="center"><strong>"Somos calidad, somos lo mejor a la hora viajar"..Viajes UCAB SzcoPa</strong></td>
 
  </tr>
    </table>
  </table>
       
';
	
	
		$tabla_completa= $tabla_completa.$tabla;
	
	}
	
	mysql_free_result($result);
	
	
	$paneldetallefactura->add("inff",$tabla_completa);
	
	

	
	
	$paneldetallefactura->add("puerta",'4');	
	$paneldetallefactura->add("pasillo",'A-2');	

	
	/* $result2 = mysql_query("SELECT per_cedula,per_nombre1,per_apellido1 FROM persona WHERE per_cedula='$cedula'");
	
	while($row2 = mysql_fetch_array($result2))
	{
	
	$nombre = $row2["per_cedula"];
	$apellido = $row2["per_nombre1"];
	$cedula = $row2["per_apellido1"];
	}
	$paneldetallefactura->add("id",$idboleto);
	$paneldetallefactura->add("bolfecha",$bolfecha);
	$paneldetallefactura->add("nombre",$nombre);
	$paneldetallefactura->add("apellido",$apellido);
	$paneldetallefactura->add("telefono",$telefono);
	$paneldetallefactura->add("fechita",$fecha);
	$paneldetallefactura->add("totaltotal",' '.$total.' $');*/
	
		
		

	//mysql_free_result($result);
    mysql_free_result($result2);

	


	

	$admin->add("contenido",$paneldetallefactura);			
	$admin->show();
    include "../db/cerrar_conexion.php";
?>
