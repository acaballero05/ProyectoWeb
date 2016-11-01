<?php 
$Cedula = $_POST['Cedula'];
$Nombre = $_POST['Nombre'];
$Correo = $_POST['Correo'];
$Telefono = $_POST['Telefono'];
$Usuario = $_POST['Usuario'];
$Contrasena = $_POST['Contrasena'];
if (!isset($_SESSION)) {
  session_start();
}
require_once 'Cucha.php';
$Modelo = new Cucha();
$Verificacion = $Modelo->agregar_usuario($Cedula, $Nombre, $Correo, $Telefono, $Usuario, $Contrasena);
require_once '../controllers/LayoutController.php';
$layoutController=new LayoutController();
if ($Verificacion) {
  	$layoutController->view('inicio');
}
else {
	//$layoutController->view('login');
}