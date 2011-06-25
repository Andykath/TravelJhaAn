
<script language="JavaScript" src="js/Bavarian_JS.js"> </script>
<script language="JavaScript" src="js/prototype-1.6.0.3.js"> </script>
<?php 


//session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$admin= new Panel("../html/admin.html");
	
	$admin->add("body",'<body onLoad = "actual(10)" >');
	
	$admin->add("contenido",'pago.php');
	$admin->show();
include "../db/cerrar_conexion.php";
?>

<form action="" method="post" >

<div align="left"><table width="520" border="0">
  <tr>
    <td width="451">
 <div id="special-box-right" align="center">
  <h1>Proceso De Factura</h1>
    <p>BAVARIAN MOTORS online. </br> Introduzca los datos pedidos a continuacion para realizar la factura:</p></br>
     </br>
     </br>
          
         
<label>
De cuantas formas desea pagar </label> </br> </br>  
<select name="forma_pago" id="forma_pago" onchange="procesoPago()"  >
	<option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
</select>

<div id="pago">

</div>
 
       
</br>
</br>  

</br>                

 </br>
   <div align="center"> <p><input name="horario" type="submit" value="Ingresar" />
    </p></div>  
   
 
</div></td>
  </tr>
</table></div>
</form>


