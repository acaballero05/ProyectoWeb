<?php
require_once 'BD/Clase_BD.php';
class Cucha extends BD {
	const login = "select * from Usuarios where Usuario=? and Contrasena=?";
	const registrar = "insert into Usuarios (Cedula, Nombre, Correo, Telefono, Usuario, Contrasena, Tipo) values (?,?,?,?,?,?,'Usuario')";
	const registrar2 = "insert into Usuarios (Cedula, Nombre, Correo, Telefono, Usuario, Contrasena, Tipo) values (?,?,?,?,?,?,?)";
	const crear_espectaculo = "insert into Espectaculos (Nombre, Fecha, Hora, Capacidad, Ocupacion) values (?,?,?,?,0)";
	const crear_mesa = "insert into mesas (Capacidad) values (?)";
	const espectaculos = "select * from Espectaculos";
	const rango = "SELECT * FROM espectaculos WHERE Fecha between ? and ?";
	const mesas = "select * from mesas";
	const reservas = "select reservas.Codigo, espectaculos.Nombre, usuarios.Nombre as Name, mesa, reservas.fecha, reservas.hora from reservas inner join espectaculos on (reservas.espectaculo=espectaculos.Codigo) inner join usuarios on (reservas.usuario=usuarios.Cedula)";
	const usuarios = "select * from Usuarios";
	const disponiblemesas = "select Codigo, Capacidad from Mesas where Codigo not in (select Mesa from Reservas where Fecha=? and Hora=?)";
	const espectaculos_usuario = "select * from Espectaculos where Codigo=?";
	const modificar_espectaculo = "update Espectaculos set Nombre=?, Fecha=?, Hora=?, Capacidad=?, Ocupacion=? where Codigo=?";
	const modificar_mesa = "update mesas set Capacidad=? where Codigo=?";
	const modificar_usuario = "update Usuarios set Nombre=?, Correo=?, Telefono=?, Tipo=? where Cedula=?";
	const reserva_mesa = "insert into reservas (mesa, usuario, fecha, hora) values (?,?,?,?)";
	const eliminar_reserva = "delete from reservas where Codigo=?";
	const eliminar_espectaculo = "delete from Espectaculos where Codigo=?";
	const eliminar_mesa = "delete from mesas where Codigo=?";
	const eliminar_user = "delete from Usuarios where Cedula=?";
	const modificar_ocupacion_espectaculo = "update Espectaculos set Ocupacion=? where Codigo=?";
	const reserva_espectaculo ="insert into reservas (espectaculo,mesa,usuario,fecha,hora) values (?,?,?,?,?)";
	const reserva_espectaculosinmesa ="insert into reservas (espectaculo,usuario,fecha,hora) values (?,?,?,?)";
	const ocupacion="select sum(M.Capacidad) from Mesas M inner join Reservas R on R.Mesa=M.Codigo where R.Fecha=?";
	const cambiar_capacidad = "update Espectaculos set Ocupacion=Ocupacion+?";
	//Consultas para los espectaculos
	//const crear_mesa = "insert into Mesas (Capacidad, Estado) values (?,'Disponible')";
	/*const mesas = "select * from Mesas";
	const espectaculos_usuario = "select * from Espectaculos where Codigo=?";
	const modificar_espectaculo = "update Espectaculos set Nombre=?, Fecha=?, Hora=?, Capacidad=? where Codigo=?";
	const eliminar_espectaculo = "delete from Espectaculos where Codigo=?";
	const modificar_ocupacion_espectaculo = "update Espectaculos set Ocupacion=? where Codigo=?";*/

	//Funciones
	public function validar_login($user) {
		$this->open_connection();
		$statement = $this->conn->prepare(self::login);
		if($statement){
			$statement->bind_param("ss", $user['Usuario'], $user['Contrasena']);
			$statement->execute();
			$resultado=$statement->get_result();
			$statement->close();
		}else{	
			die("Ha ocurrido un error realizando el login");
			return false;
		}		
		$this->close_connection();		
		return $resultado;
	}

	public function agregar_usuario($user) {
		$this->open_connection();
		$statement = $this->conn->prepare(self::registrar);
		if($statement){
			$statement->bind_param("isssss", $user['Cedula'],$user['Nombre'], $user['Correo'], $user['Telefono'], $user['Usuario'], $user['Contrasena']);
			$statement->execute();
			$resultado=$statement->get_result();
			$statement->close();
		}else{	
			die("Ha ocurrido un error");
			return false;
		}		
		$this->close_connection();		
		return true;
	}

	public function agregar_espectaculo($user) {
		$this->open_connection();
		$statement = $this->conn->prepare(self::crear_espectaculo);
		if($statement){
			$statement->bind_param("ssii", $user['Nombre'],$user['Fecha'], $user['Hora'], $user['Capacidad']);
			$statement->execute();
			$resultado=$statement->get_result();
			$statement->close();
		}else{	
			die("Ha ocurrido un error");
			return false;
		}		
		$this->close_connection();		
		return true;
	}

	public function todos_reservas() {
		$result = $this->query(self::reservas);
		if ($result != false) {
			return $result;
		} else {
			die ("Ha ocurrido un error consultando las reservas" );
		}
	}

	public function agregar_mesa($user) {
		$this->open_connection();
		$statement = $this->conn->prepare(self::crear_mesa);
		if($statement){
			$statement->bind_param("i", $user['Capacidad']);
			$statement->execute();
			$resultado=$statement->get_result();
			$statement->close();
		}else{	
			die("Ha ocurrido un error agregando mesa");
			return false;
		}		
		$this->close_connection();		
		return true;
	}

	public function agregar_usuario2($user) {
		$this->open_connection();
		$statement = $this->conn->prepare(self::registrar2);
		if($statement){
			$statement->bind_param("issssss", $user['Cedula'], $user['Nombre'], $user['Correo'], $user['Telefono'], $user['Usuario'], $user['Contrasena'], $user['Tipo']);
			$statement->execute();
			$resultado=$statement->get_result();
			$statement->close();
		}else{	
			die("Ha ocurrido un error");
			return false;
		}		
		$this->close_connection();		
		return true;
	}

	public function todos_espectaculos() {
		$result = $this->query(self::espectaculos);
		if ($result != false) {
			return $result;
		} else {
			die ("Ha ocurrido un error" );
		}
	}

	public function todos_rango($data) {
		$this->open_connection();
		$statement = $this->conn->prepare(self::rango);
		if($statement){
			$statement->bind_param("ss", $data['inicio'],$data['fin']);
			$statement->execute();
			$resultado=$statement->get_result();
			$statement->close();
		}else{	
			die("Ha ocurrido un error");
			return false;
		}		
		$this->close_connection();		
		return $resultado;
	}

	public function todos_mesas() {
		$result = $this->query(self::mesas);
		if ($result != false) {
			return $result;
		} else {
			die ("Ha ocurrido un error consultando todas las mesas" );
		}
	}

	public function todos_usuarios() {
		$result = $this->query(self::usuarios);
		if ($result != false) {
			return $result;
		} else {
			die ("Ha ocurrido un error consultando todas los usuarios" );
		}
	}

	public function dispo_mesas($data) {
		$this->open_connection();
		$statement = $this->conn->prepare(self::disponiblemesas);
		if($statement){
			$statement->bind_param("si", $data['Fecha'], $data['Hora']);
			$statement->execute();
			$resultado=$statement->get_result();
			$statement->close();
		}else{	
			die("Ha ocurrido un error reservando espectaculo");
			return false;
		}		
		$this->close_connection();		
		return $resultado;
		// $result = $this->query(self::disponiblemesas);
		// if ($result != false) {
		// 	return $result;
		// } else {
		// 	die ("Ha ocurrido un error consultando las mesas disponibles" );
		// }
	}

	public function usuario_espectaculos($user) {
		$this->open_connection();
		$statement = $this->conn->prepare(self::espectaculos_usuario);
		if($statement){
			$statement->bind_param("i", $user['Codigo']);
			$statement->execute();
			$resultado=$statement->get_result();
			$statement->close();
		}else{	
			die("Ha ocurrido un error");
			return false;
		}		
		$this->close_connection();		
		return $resultado;
	}

	public function update_espectaculo($user) {
		$this->open_connection();
		$statement = $this->conn->prepare(self::modificar_espectaculo);
		if($statement){
			$statement->bind_param("ssiiii", $user['Nombre'],$user['Fecha'], $user['Hora'], $user['Capacidad'], $user['Ocupacion'], $user['Codigo']);
			$statement->execute();
			$resultado=$statement->get_result();
			$statement->close();
		}else{	
			die("Ha ocurrido un error");
			return false;
		}		
		$this->close_connection();		
		return true;
	}

	public function update_mesa($user) {
		$this->open_connection();
		$statement = $this->conn->prepare(self::modificar_mesa);
		if($statement){
			$statement->bind_param("ii", $user['Capacidad'], $user['Codigo']);
			$statement->execute();
			$resultado=$statement->get_result();
			$statement->close();
		}else{	
			die("Ha ocurrido un error editando mesa");
			return false;
		}		
		$this->close_connection();		
		return true;
	}

	public function update_usuario($user) {
		$this->open_connection();
		$statement = $this->conn->prepare(self::modificar_usuario);
		if($statement){
			$statement->bind_param("ssssi", $user['Nombre'], $user['Correo'], $user['Telefono'], $user['Tipo'], $user['Cedula']);
			$statement->execute();
			$resultado=$statement->get_result();
			$statement->close();
		}else{	
			die("Ha ocurrido un error editando mesa");
			return false;
		}		
		$this->close_connection();		
		return true;
	}

	public function reserve_mesa($mesa,$user) {
		$this->open_connection();
		$statement = $this->conn->prepare(self::reserva_mesa);
		if($statement){
			$statement->bind_param("iisi", $mesa['Mesa'],$user['cc'],$mesa['Fecha'],$mesa['Hora']);
			$statement->execute();
			$resultado=$statement->get_result();
			$statement->close();
		}else{	
			die("Ha ocurrido un error reservando mesa");
			return false;
		}		
		$this->close_connection();		
		return true;
	}

	public function reserve_espectaculo($espec,$user) {
		$this->open_connection();
		$statement = $this->conn->prepare(self::reserva_espectaculo);
		if($statement){
			$statement->bind_param("iiisi", $espec['Espectaculo'], $espec['Mesa'],$user['cc'],$espec['Fecha'],$espec['Hora']);
			$statement->execute();
			$resultado=$statement->get_result();
			$statement->close();
			//$result=$this->query(self:cambiar_capacidad,$espec['Capacidad']);
		}else{	
			die("Ha ocurrido un error reservando espectaculo");
			return false;
		}		
		$this->close_connection();		
		return true;
	}

	public function getocupacion($data) {
		$result = $this->query(self::ocupacion, $data['Fecha']);
		/*$this->open_connection();
		$statement = $this->conn->prepare(self::ocupacion);
		if($statement){
			$statement->bind_param("s", $espec['Fecha']);
			$statement->execute();
			$resultado=$statement->get_result();
			$statement->close();
			//$result=$this->query(self:cambiar_capacidad,$espec['Capacidad']);
		}else{	
			die("Ha ocurrido un error reservando espectaculo");
			return false;
		}		
		$this->close_connection();*/		
		return $result;
	}

	public function reserve_espectaculoSinMesa($espec,$user) {
		$this->open_connection();
		$statement = $this->conn->prepare(self::reserva_espectaculosinmesa);
		if($statement){
			$statement->bind_param("iisi", $espec['Codigo'], $user['cc'],$espec['Fecha'],$espec['Hora']);
			$statement->execute();
			$resultado=$statement->get_result();
			$statement->close();
		}else{	
			die("Ha ocurrido un error reservando espectaculo");
			return false;
		}		
		$this->close_connection();		
		return true;
	}

	public function delete_espectaculo($Codigo) {
		$result = $this->query(self::eliminar_espectaculo, [$Codigo]);
	}

	public function delete_reserva($Codigo) {
		$result = $this->query(self::eliminar_reserva, [$Codigo]);
	}


	public function delete_mesa($Codigo) {
		$result = $this->query(self::eliminar_mesa, [$Codigo]);
	}

	public function delete_user($Cedula) {
		$result = $this->query(self::eliminar_user, [$Cedula]);
	}

	public function ocupacion_espectaculo($user) {
		$this->open_connection();
		$statement = $this->conn->prepare(self::modificar_ocupacion_espectaculo);
		if($statement){
			$statement->bind_param("ii", $user['Ocupacion'], $user['Codigo']);
			$statement->execute();
			$resultado=$statement->get_result();
			$statement->close();
		}else{	
			die("Ha ocurrido un error");
			return false;
		}		
		$this->close_connection();		
		return true;
	}
}
?>