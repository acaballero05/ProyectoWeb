<?php  
require_once('lib/nusoap.php');
$ns="http://localhost:8080/CalculadoraImpuestos/";
$server= new nusoap_server();
$server->configureWSDL('CalculadoraImpuestos',$ns);
$server->register('calcularIva', array('amount'=>'xsd:int'), 
	array('return'=>'xsd:float'),
	$ns);

$server->register('calcularSalario', array('amount'=>'xsd:int', 'category'=>'xsd:int'), 
	array('return'=>'xsd:float'),
	$ns);

function calcularIva($amount){
	$tax=$amount*0.16;
	return new soapval('return', 'xsd:float',$tax);
}

function calcularSalario($amount, $salary){
	$salary=$amount*$salary;
	return new soapval('return', 'xsd:float',$salary);
}

if ( !isset( $HTTP_RAW_POST_DATA ) )
    $HTTP_RAW_POST_DATA = file_get_contents( 'php://input' );

$server->service($HTTP_RAW_POST_DATA);
?>