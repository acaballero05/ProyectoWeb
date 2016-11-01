<?php 
class client
{
	
	public function __construct(){
		$this->instance= new SoapClient('http://localhost:8080/webService/CalculadoraImpuestos.php?wsdl');
	}

	public function calcularIVA($paramsArray){

		return $this->instance->__call('calcularIva',$paramsArray);
	}


}


$client= new client();
?>