<?php 
$Usuario = $_POST['UsuarioIni'];
$Contrasena = $_POST['ContrasenaIni'];
if (!isset($_SESSION)) {
  session_start();
}
require_once 'Cucha.php';
$Modelo = new Cucha();
$Verificacion = $Modelo->validar_login($Usuario, $Contrasena);
require_once '../controllers/LayoutController.php';
$layoutController=new LayoutController();
if ($Verificacion->num_rows > 0) {
	$Dato = mysqli_fetch_array($Verificacion);
	$_SESSION['Cedula'] = $Dato['Cedula'];
  	//$layoutController->view('inicio');
}
else {
	//$layoutController->view('login');
}