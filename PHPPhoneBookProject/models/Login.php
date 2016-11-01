<?php
require_once 'db/db.php';
class Login extends DB {

	const LOGIN = "select * from usuarios where user=? and pass=?;";
	

	public function validarLogin($data) {

		$this->open_connection ();
		$statement = $this->conn->prepare ( self::LOGIN );
		if ($statement) {
			$statement -> bind_param("ss", $data['user'], $data['pass']);
			$statement->execute();
			$result=$statement->get_result();
		}		
		else{
			echo "Algo malio sal LOGIN";
		}
		$statement->close();
		$this->close_connection();

		if ($result != false ) {
			return $result;
		} else {
			die ( "Algo malio sal en Login".$data['user'].$data['pass'] );
		}
	}

}

?>