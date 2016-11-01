<?php

require_once 'controllers/RestApi.php';
require_once 'Modelo/Cucha.php';
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
	
	private function allEspect() {
		if ($this->get_request_method () != "GET") {
			$this->response ( '', 406 );
		}
		$cucha=new Cucha();
		$result=$cucha->todos_espectaculos();
		if($result->num_rows>0){
			$array=$result->fetch_all(MYSQLI_ASSOC);
			$jsonVar= $this->json($array);
			$this->response($jsonVar, 200);
		}else{
			$this->response('',204);
		}
	}

	private function allReserva() {
		if ($this->get_request_method () != "GET") {
			$this->response ( '', 406 );
		}
		$cucha=new Cucha();
		$result=$cucha->todos_reservas();
		if($result->num_rows>0){
			$array=$result->fetch_all(MYSQLI_ASSOC);
			$jsonVar= $this->json($array);
			$this->response($jsonVar, 200);
		}else{
			$this->response('',204);
		}
	}


	private function allRango() {
		if ($this->get_request_method () != "POST") {
			$this->response ( '', 406 );
		}
		$data=json_decode(file_get_contents('php://input'),true);
		$cucha=new Cucha();
		$result=$cucha->todos_rango($data);
		if($result->num_rows>0){
			$array=$result->fetch_all(MYSQLI_ASSOC);
			$jsonVar= $this->json($array);
			$this->response($jsonVar, 200);
		}else{
			$this->response('',204);
		}
	}

	private function allUsuario() {
		if ($this->get_request_method () != "GET") {
			$this->response ( '', 406 );
		}
		$cucha=new Cucha();
		$result=$cucha->todos_usuarios();
		if($result->num_rows>0){
			$array=$result->fetch_all(MYSQLI_ASSOC);
			$jsonVar= $this->json($array);
			$this->response($jsonVar, 200);
		}else{
			$this->response('',204);
		}
	}

	private function addUsuario() {
		if ($this->get_request_method () != "POST") {
			$this->response ( '', 406 );
		}
		$data=json_decode(file_get_contents('php://input'),true);
		$cucha = new Cucha();
		$cucha->agregar_usuario($data);
		$this->response ('', 200);
	}

	private function valLogin() {
		if ($this->get_request_method () != "POST") {
			$this->response ( '', 406 );
		}
		$data=json_decode(file_get_contents('php://input'),true);
		$cucha = new Cucha();
		$result=$cucha->validar_login($data);
		if($result->num_rows>0){

			$contact=$result->fetch_array(MYSQLI_ASSOC);
			$_SESSION['cc']=$contact['Cedula'];
			$_SESSION['tipo']=$contact['Tipo'];
			$jsonVar= $this->json($contact);
			$this->response($jsonVar, 200);
		}
		else{
			$this->response ('', 406);
		}
	}

	private function logout()
	{
		unset($_SESSION['cc']);
		unset($_SESSION['tipo']);
	}

	private function addEspectaculo() {
		if ($this->get_request_method () != "POST") {
			$this->response ( '', 406 );
		}
		$data=json_decode(file_get_contents('php://input'),true);
		$cucha = new Cucha();
		$cucha->agregar_espectaculo($data);
		$this->response ('', 200);
	}

	private function addMesa() {
		if ($this->get_request_method () != "POST") {
			$this->response ( '', 406 );
		}
		$data=json_decode(file_get_contents('php://input'),true);
		$cucha = new Cucha();
		$cucha->agregar_mesa($data);
		$this->response ('', 200);
	}

	private function addUser() {
		if ($this->get_request_method () != "POST") {
			$this->response ( '', 406 );
		}
		$data=json_decode(file_get_contents('php://input'),true);
		$cucha = new Cucha();
		$cucha->agregar_usuario2($data);
		$this->response ('', 200);
	}

	private function edit_espect(){
		if ($this->get_request_method () != "POST") {
			$this->response ( '', 406 );
		}
		$data=json_decode(file_get_contents('php://input'),true);
		
		$cucha = new Cucha();
		$cucha->update_espectaculo($data);
		$this->response ('', 200);
	}

	private function reserve_espect(){
		if ($this->get_request_method () != "POST") {
			$this->response ( '', 406 );
		}
		$data=json_decode(file_get_contents('php://input'),true);
		
		$cucha = new Cucha();
		$cucha->reserve_espectaculo($data,$_SESSION);
		$this->response ('', 200);
	}

	private function reserve_espect2(){
		if ($this->get_request_method () != "POST") {
			$this->response ( '', 406 );
		}
		$data=json_decode(file_get_contents('php://input'),true);
		
		$cucha = new Cucha();
		$cucha->reserve_espectaculoSinMesa($data,$_SESSION);
		$this->response ('', 200);
	}

	private function save_espect(){
		if ($this->get_request_method () != "POST") {
			$this->response ( '', 406 );
		}
		$data=json_decode(file_get_contents('php://input'),true);
		
		$cucha = new Cucha();
		$cucha->update_espectaculo($data);
		$this->response ('', 200);
	}	

	private function deleteEspectaculo() {
		if ($this->get_request_method () != "POST") {
			$this->response ( '', 406 );
		}
		$data=json_decode(file_get_contents('php://input'),true);
		$cucha = new Cucha();
		$cucha->delete_espectaculo($data['Codigo']);
		$this->response ('', 200);
	}

	private function deleteReserva() {
		if ($this->get_request_method () != "POST") {
			$this->response ( '', 406 );
		}
		$data=json_decode(file_get_contents('php://input'),true);
		$cucha = new Cucha();
		$cucha->delete_reserva($data['Codigo']);
		$this->response ('', 200);
	}

	private function deleteMesa() {
		if ($this->get_request_method () != "POST") {
			$this->response ( '', 406 );
		}
		$data=json_decode(file_get_contents('php://input'),true);
		$cucha = new Cucha();
		$cucha->delete_mesa($data['Codigo']);
		$this->response ('', 200);
	}

	private function deleteUsuario() {
		if ($this->get_request_method () != "POST") {
			$this->response ( '', 406 );
		}
		$data=json_decode(file_get_contents('php://input'),true);
		$cucha = new Cucha();
		$cucha->delete_user($data['Cedula']);
		$this->response ('', 200);
	}
	
	private function json($data) {
		if (is_array ( $data )) {
			return json_encode ( $data );
		}
	}

	private function edit_mesa(){
		if ($this->get_request_method () != "POST") {
			$this->response ( '', 406 );
		}
		$data=json_decode(file_get_contents('php://input'),true);
		
		$cucha = new Cucha();
		$cucha->update_mesa($data);
		$this->response ('', 200);
	}

	private function edit_usuario(){
		if ($this->get_request_method () != "POST") {
			$this->response ( '', 406 );
		}
		$data=json_decode(file_get_contents('php://input'),true);
		$cucha = new Cucha();
		$cucha->update_usuario($data);
		$this->response ('', 200);
	}

	private function reserva_mesa(){
		if ($this->get_request_method () != "POST") {
			$this->response ( '', 406 );
		}
		$data=json_decode(file_get_contents('php://input'),true);
		
		$cucha = new Cucha();
		$cucha->reserve_mesa($data,$_SESSION);
		$this->response ('', 200);
	}

	private function getocupacion(){
		if ($this->get_request_method () != "POST") {
			$this->response ( '', 406 );
		}
		$data=json_decode(file_get_contents('php://input'),true);
		
		$cucha = new Cucha();
		$result=$cucha->getocupacion($data);
		echo $result;
		if($result->num_rows>0){
			$array=$result->fetch_all(MYSQLI_ASSOC);
			$jsonVar= $this->json($array);
			$this->response($jsonVar, 200);
		}else{
			$this->response('',204);
		}
	}

	private function allMesa() {
		if ($this->get_request_method () != "GET") {
			$this->response ( '', 406 );
		}
		$cucha=new Cucha();
		$result=$cucha->todos_mesas();
		if($result->num_rows>0){
			$array=$result->fetch_all(MYSQLI_ASSOC);
			$jsonVar= $this->json($array);
			$this->response($jsonVar, 200);
		}else{
			$this->response('',204);
		}
	}

	private function disponibleMesa() {
		if ($this->get_request_method () != "POST") {
			$this->response ( '', 406 );
		}
		$data=json_decode(file_get_contents('php://input'),true);
		$cucha=new Cucha();
		$result=$cucha->dispo_mesas($data);
		if($result->num_rows>0){
			$array=$result->fetch_all(MYSQLI_ASSOC);
			//echo $data['Cosa'];
			$jsonVar= $this->json($array);
			//array_push($jsonVar, $data['Cosa']);
			$this->response($jsonVar, 200);
		}else{
			$this->response('',204);
		}
	}
}
session_start ();
$api = new API ();
$api->processApi ();
?>