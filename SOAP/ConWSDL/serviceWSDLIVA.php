<?php  
 include './clientWSDLIVA.php';
 $params=  array('amount'=>1000);
 print_r($client->calcularIVA($params));
?>