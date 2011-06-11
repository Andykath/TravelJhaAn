<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	 extract($_GET); 
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(8)" >');

	$panelmiperfil = new Panel("../html/a_verperfil_paquete_aerolineas.html");
	//$panelpaises->add("crear",'<a href="../php/a_crear_empleado.php">Crear Empleado</a>');
   $cedula_actual=$_SESSION['cedula'];
	
    $mensaje = $_REQUEST['mensaje'];
	if($mensaje==1)
	{
	$panelmiperfil->add("mensaje",'Se Agrego el nuevo registro');
	}
	else if($mensaje==2)
	{
	$panelmiperfil->add("mensaje",'Se Edito el registro');
	}
	else if($mensaje==4)
	{
	$panelmiperfil->add("mensaje",'Ya existe ese pais');
	}

	echo $fkvia2;
	$result= mysql_query("SELECT p.per_cedula, p.per_nombre1 ,p.per_apellido1, p.per_sexo, p.per_direccion, p.per_fecha_nac, p.per_edo_civil,p.per_nacionalidad, p.per_visa,p.per_pasaporte,p.per_apellido2,p.per_nombre2,u.usu_login,u.usu_id,u.usu_password FROM persona p LEFT JOIN usuario u ON p.per_cedula = u.fk_per_cedula WHERE p.per_cedula='$cedula_actual' ORDER BY p.per_cedula");
	//echo "$row['per_nombre1']";
    $row = mysql_fetch_array($result);
	$panelmiperfil->add("tipoviaje",$tipoviaje);
	$panelmiperfil->add("id",$id);
	$panelmiperfil->add("fechai",$fechai);
	$panelmiperfil->add("fechaf",$fechaf);
	$panelmiperfil->add("mil",$millas);
	$panelmiperfil->add("tipopaq",$tipopaq);
	$panelmiperfil->add("cantpaq",$cantpaq);
	$panelmiperfil->add("aernombre",$aernombre);
	$panelmiperfil->add("links",'<a href="../php/a_modificar_paquete_sinestadia_aerolinea.php?tipoviaje='.$tipoviaje.'&id='.$id.'&fechai='.$fechai.'&fechaf='.$fechaf.'&millas='.$millas.'&tipopaq='.$tipopaq.'&cantpaq='.$cantpaq.'&aernombre='.$aernombre.'&aerid='.$aerid.'&fkvia='.$fkvia.'&fkvia2='.$fkvia2.'">Modificar</a> <a href="../php/a_eliminar_paquete_sinestadia_aerolinea.php?id='.$id.'" onclick="return confirmar()">Eliminar</a>');
   	
	
		
		$tablaequipos="";
		$tablaequipos1="";
   
  //$panelmiperfil->add("modif",'<a href="../php/u_telefonos.php?&cedula='.$row['per_cedula'].'">Gestionar</a>');
		
   $result6=mysql_query("SELECT d.des_nombre FROM via v , destino d WHERE v.via_id='$fkvia' AND v.fk_des_id=d.des_id");
	

		
		while($row6=mysql_fetch_array($result6))
					{ 
		$tabla='  <table width="386"  align="left" border="0">
        <tr>
          <th width="386" scope="col"><div align="left">'.$row6['des_nombre'].'</div></th>
        </tr>
      </table>    '; 
	 
 							$tablaequipos= $tablaequipos.$tabla;
							$panelmiperfil->add("telefonos",$tablaequipos);
					}			

 $result7=mysql_query("SELECT d.des_nombre FROM via v , destino d WHERE v.via_id='$fkvia2' AND v.fk_des_id=d.des_id");
	

		
		while($row7=mysql_fetch_array($result7))
					{ 
		$tabla='  <table width="386"  align="left" border="0">
        <tr>
          <th width="386" scope="col"><div align="left">'.$row7['des_nombre'].'</div></th>
        </tr>
      </table>    '; 
	 
 							$tablaequipos1= $tablaequipos1.$tabla;
							$panelmiperfil->add("telefonos1",$tablaequipos1);
					}			

	
	
	mysql_free_result($result);

	
	$admin->add("contenido",$panelmiperfil);
	
	
	
				
	$admin->show();
 	include "../db/cerrar_conexion.php";
?>
