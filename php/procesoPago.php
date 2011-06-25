<?php

switch ($_POST['forma_pago']) {
case 1:
{
	echo'  </label></br></br>
       tipo de pago:   <label>
     <select name="pago2" id="pago2" onchange="Pago_tarjeta()">
     <option value="vacio">-------</option>
	 <option value="deposito">deposito</option>
     <option value="tarjeta">tarjeta</option>
     <option value="cheque">cheque</option>
     </select>
      <div id="numero">

      </div>       
			 
     <label></br></br>
      Monto a pagar:
     </label>
    <input name="monto" ></input>
';
//<input name="Aceptar" type="button" />
}
break;

case 2:
{
	 echo '</label></br></br>
       tipo de pago:   <label>
     <select name="pago">
     <option value="deposito">deposito</option>
     </select>
	 
	 <label></br></br>
      Numero de Deposito:
     </label>
    <input name="numero" ></input>
	
	 
	 <label></br></br>
      Monto a pagar:
     </label>
    <input name="monto" ></input>
	 
	  </label></br></br>
       tipo de pago:   <label>
     <select name="pago2" id="pago2" onchange="Pago_tarjeta()">
	 <option value="vacio">-------</option>
     <option value="tarjeta">tarjeta</option>
     <option value="cheque">cheque</option>
     </select>
      
	  <div id="numero">

      </div>     

     <label></br></br>
      Monto a pagar:
     </label>
    <input name="monto2" ></input>
	
	
	
	 
	
	';
	
	
}
break;

case 3:
{
	 echo'</label></br></br>
       tipo de pago:   <label>
     <select name="pago">
     <option value="deposito">deposito</option>
     </select>
	 
	 <label></br></br>
      Numero de Deposito:
     </label>
    <input name="numero" ></input>
	 
	 <label></br></br>
      Monto a pagar:
     </label>
    <input name="monto" ></input>
	 
	  </label></br></br>
       tipo de pago:   <label>
     <select name="pago2">
     <option value="tarjeta">tarjeta</option>
     </select>
	 
	 <label></br></br>
      Numero de Tarjeta:
     </label>
    <input name="numero2" ></input>
	
	 <label></br></br>
      Monto a pagar:
     </label>
    <input name="monto2" ></input>
	 
	 </label></br></br>
       tipo de pago:   <label>
     <select name="pago3">
     <option value="cheque">cheque</option>
     </select>
	 
     <label></br></br>
      Numero de Cheque:
     </label>
    <input name="numero3" ></input>        
      	
	<label></br></br>
      Monto a pagar:
     </label>
    <input name="monto3" ></input>';
}
break;
}

?>