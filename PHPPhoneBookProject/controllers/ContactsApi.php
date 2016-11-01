<?php
// Inicia una nueva sesión o resumen una abierta
session_start ();
if (! isset ( $_SESSION ['contactsList'] )) {
	$_SESSION ['contactsList'] = array ();
}

// Decodificar los datos de la peticion
$requestData = json_decode(file_get_contents('php://input'),true);

// Se revisa cual es la peticion enviada
if (isset ( $requestData ['op'] )) {
	if ($requestData ['op'] == "append") {
		// Se adicionan los datos al arreglo de la sesion
		/* Busque como funciona array_push y adicione en el arreglo que obtiene
		 * de $_SESSION ['contactsList'] un nuevo arreglo asociativo, 
		 * que tenga un campo nom lo que viende del json de la petición en el campo 'nom'
		 * y que tenga en un campo  'phone' cuyo valor corresponde a lo que viene
		 * en el json en el campo 'phone'  
		 */
		
		array_push($_SESSION ['contactsList'], array("nom" =>$requestData['nom'], "phone"=>$requestData['phone']));
		
	}else if($requestData ['op'] == "delete"){
		$posToRemove=0;
		//Se recorre el arreglo asociativo
		foreach ($_SESSION ['contactsList'] as $contact){
			
			if ($requestData['nom']===$contact['nom']){
				unset($_SESSION['contactsList'][$posToRemove]);
				$_SESSION ['contactsList'] = array_values ( $_SESSION ['contactsList'] );
				break;
			}
			$posToRemove++;
			//Complete la lógica para que cuando se encuentre el valor
			//se retire del arreglo asociativo. 
			
			/*Este codigo es util para retirar el valor del arreglo y actualizar
			 * de nuevo el arreglo asociativo sin el valor que fue retirado
			 *
				//Se encuentra y se retira del arreglo de sesion
				unset($_SESSION['contactsList'][$posToRemove]);
				//Se actualiza de nuevo el arreglo de sesion
				$_SESSION ['contactsList'] = array_values ( $_SESSION ['contactsList'] );
				break;
			}*/
			//
		
		}
	}
}

//Se entrega el resultado codificando el arreglo como un json
echo  json_encode ( $_SESSION ['contactsList'] );
?>