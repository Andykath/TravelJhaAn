<?php

switch ($_POST['pago2']) {
case "deposito":
{
	echo '<label></br></br>
      numero del deposito:
     </label>
    <input name="numero" ></input>';
}
break;

case "tarjeta":
{
	echo '<label></br></br>
      numero de tarjeta:
     </label>
    <input name="numero" ></input>';
}
break;

case "cheque":
{
	echo '<label></br></br>
      numero de cheque:
     </label>
    <input name="numero" ></input>';
}
break;

}


?>