<?php
require "config/LoggerConfig.php";

abstract class DB {

	private static $db_host = "localhost";
	private static $db_user = "root";
	private static $db_pass = "";
	private static $db_name = "phonebook";
	protected $conn;
	protected $log;
	
	
	# Conectar a la base de datos
	function __construct() {
		//self::  es la manera de acceder a propiedades estáticos
		$this->log=Logger::getLogger("main");
		
	}
	#Abrir conexion
	public function open_connection() {
		
		$this->conn = new mysqli(self::$db_host, self::$db_user,
				self::$db_pass, self::$db_name);
		# Los codigos de errores son >0
		if ($this->conn->connect_error) {
			//Se inicializa el logger
			$error_text= 'Date:'. time() .' Connection error text: ' . $this->conn->connect_error;
			#$this->log->fatal($error_text);  
			die("Lo sentimos ha ocurrido un error");
		}
		
	}
	
	# Desconectar la base de datos
	protected function close_connection() {
		$result =$this->conn->close();
		if($result== false){
			//FIXME: LLame el logger para indicar que hubo errores
		}
	}
	
	
	/**
	 *
	 * Ejecuta un Query con sus parametros
	 *
	 */
	
	
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
					}
				}
			}
			$statement->execute();
			
			/* asociar  variables de resultado */
			$result=$statement->get_result();
			//$arrayResult=$result->fetch_all(MYSQLI_ASSOC);
		
			#Cerrar sentencia
			$statement->close();
		}else{
			$log->error("Error preparing statement of query ".$query );
		}

		$this->close_connection();
		
		return $result;
	}
	
	
	public function getByNumber($sql,$parameters){
		if (!is_null($parameters)&& count($parameters)>0) {
			foreach ($parameters as $key => $value) {
				if (!is_integer($value)) {
						$this->log->warn('Date:'. time()." getByNumber  ". $numberParam. "is not a number or is null ". "sql: ".$sql);
					return null;
				}
			}
			//Si todo esta bien se continua
			$result=$this->query($sql,$parameters);
			$dataResult=$result->fetch_assoc();
			return $dataResult;
		}
		else{
			$this->log->warn('Date:'. time()." getByNumber  ". "sql: ".$sql. ". The numeric parameter was not received ");
			return null;
		}
	}
	/**
	 *
	 *	Borrar por id
	 *
	 */
	
	public function deleteById($id,$tablename){
	
		//TODO Completar operacion

	}

}
?>