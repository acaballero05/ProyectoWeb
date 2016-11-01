<?php
/*
 * Adapted from http://www.angularcode.com/demo-of-a-simple-crud-restful-php-service-used-with-angularjs-and-mysql/
 */
require_once 'controllers/RestApi.php';
require_once 'models/Phonebook.php';
require_once 'models/Login.php';
class API extends REST {
	
	
	/*
	 * Dynmically call the method based on the query string
	 */
	public function processApi() {
		$func = strtolower ( trim ( str_replace ( "/", "", $_REQUEST ['x'] ) ) );
		if (( int ) method_exists ( $this, $func ) > 0)
			$this->$func ();
		else
			$this->response ( '', 404 ); // If the method not exist with in this class "Page not found".
	}
	
	/* Procesa GET all contacts */
	private function allContacts() {
		// Se espera que la petición sea de tipo GET
		if ($this->get_request_method () != "GET") {
			$this->response ( '', 406 );
		}

		$phoneBook=new Phonebook();
		$result=$phoneBook->getAllContacts($_SESSION['id']);
		
		if($result->num_rows>0){
			$array=$result->fetch_all(MYSQLI_ASSOC);
			$jsonVar= $this->json($array);
			$this->response($jsonVar, 200);
		}else{
			$this->response( '',204);
		}
		
		//Sacar todos los contactos usando el llamado al método que habíamos hecho en phonebook
		
		//Si el número de filas es mayor a cero, entonces guardar en una variable el json
		// de esa lista de contactos
		
		//Sino responder, usando un código 204 "No content" así: $this->response ( '', 204 );
		
	}
	private function addContact() {
		
		//Validar que el metodo por el que se hace la petición sea POST
		if ($this->get_request_method () != "POST") {
			$this->response ( '', 406 );
		}
		$data=json_decode(file_get_contents('php://input'),true);
		
		$phoneBook = new Phonebook();
		$phoneBook->addNewContact($data,$_SESSION['id']);
		$this->response ('', 200);
		

	}
	
	private function delContact(){
		if ($this->get_request_method () != "POST") {
			$this->response ( '', 406 );
		}
		$data=json_decode(file_get_contents('php://input'),true);
		
		$phoneBook = new Phonebook();
		$phoneBook->deleteContactById($data['id']);
		$this->response ('', 200);
	}
	
	private function valLogin(){
		if ($this->get_request_method () != "POST") {
			$this->response ( '', 406 );
		}
		$data=json_decode(file_get_contents('php://input'),true);
		$login = new Login();
		$result=$login->validarLogin($data);
		if($result->num_rows>0){
			$contact=$result->fetch_array(MYSQLI_ASSOC);
			
			
			$_SESSION['user']=$contact['user'];
			$_SESSION['id']=$contact['id'];
			$this->response ('', 200);
		}
		else{
			$this->response ('', 406);
		}
	}

	private function edit_contact(){
		if ($this->get_request_method () != "POST") {
			$this->response ( '', 406 );
		}
		$data=json_decode(file_get_contents('php://input'),true);
		
		$phonebook = new Phonebook();
		$phonebook->editcontact($data);
		$this->response ('', 200);
	}
	//TODO adicionar el código para eliminar contactos llamando a la api
	
	/*
	 * Encode array into JSON
	 */
	private function json($data) {
		if (is_array ( $data )) {
			return json_encode ( $data );
		}
	}
}

// Inicializar la clase
session_start();
$api = new API ();
$api->processApi ();

?>