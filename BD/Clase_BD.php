<?php
abstract class BD {
	
	private static $db_host = 'localhost';
	private static $db_user = 'root';
	private static $db_pass = '';
	private static $db_name = 'cuchabd';
	protected $conn;
	
	function __construct() {

	}

	//Abrir conexión
	public function open_connection() {
		$this->conn = new mysqli(self::$db_host, self::$db_user, self::$db_pass, self::$db_name);
		if ($this->conn->connect_error) {;  
			die("Lo sentimos ha ocurrido un error estableciendo la conexion");
		}
	}

	//Desconectar la base de datos
	protected function close_connection() {
		$result =$this->conn->close();
		if($result== false){
			die("Lo sentimos ha ocurrido un error cerrando la conexion");
		}
	}

	//Ejecuta un Query con sus parametros
	public function query($query,$parameters=NULL){
		$this->open_connection();
		$statement = $this->conn->prepare($query);
		if($statement){
			if (!is_null($parameters)&& count($parameters)>0) {
				foreach ($parameters as $parameter) {
					if (is_integer($parameter)) {
						$statement->bind_param ("i", $parameter);
					}
					elseif (is_double($parameter)) {
						$statement->bind_param("d", $parameter);
					}
					elseif (is_string($parameter)) {
						$statement->bind_param("s", $parameter);
						echo $parameter;
					}
				}
			}
			$statement->execute();
			$result=$statement->get_result();
			$statement->close();
		}
		else{
			die("Lo sentimos ha ocurrido un error ejecutando el query");
		}
		$this->close_connection();
		return $result;
	}	
}
?>