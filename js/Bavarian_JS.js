
function procesoPago(){
	$('pago').update("Cargando Formulario...");
	var pago = $F('forma_pago');
     new Ajax.Request('procesoPago.php',{
      method: 'post',
      parameters: {forma_pago : pago},
	  asynchronous: true,
      onSuccess: function(nuevoProcesoPago){
         $('pago').update(nuevoProcesoPago.responseText);
      }
      }
   );
}

function Pago_tarjeta(){
	$('numero').update("Cargando Formulario...");
	var pago = $F('pago2');
     new Ajax.Request('procesoPago2.php',{
      method: 'post',
      parameters: {pago2 : pago},
	  asynchronous: true,
      onSuccess: function(nuevoPago){
         $('numero').update(nuevoPago.responseText);
      }
      }
   );
}