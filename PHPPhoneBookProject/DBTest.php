<?php
require_once 'db/db.php';
require_once 'models/Phonebook.php';
$var =5;

$var = array("name"=>"Javier","phone"=>"555555","cellphone"=>"31555555","email"=>"javier@correo.com");



$phonebook = new Phonebook ();

insertOneContactTest($phonebook, $var);
echo "Ejemplo con todos los contactos<br>";
getContactListTest($phonebook);
echo "Ejemplo con sentencia condicionada ID = 1<br>";
getContactById(1,$phonebook);
//$phonebook->open_connection();
$result=$phonebook->getAllContacts();
//var_dump($result);
#Insert one contact test
#insertOneContactTest($phonebook);

#Insert contactArray tet
#insertContactListTest($phonebook);



# Get all contacts


// Flujo normal de datos


function getContactById($id,$phonebook){
	$result=$phonebook->getContactByID($id);
	$contactArray=$result->fetch_all(MYSQLI_ASSOC);
	foreach ($contactArray as $contact){
		echo "Name: ".$contact['name'];
		echo "ID: ".$contact['id'];
		echo "<br>";
	}
}

function getContactListTest($phonebook) {
	$result=$phonebook->getAllContacts();
	$contactArray=$result->fetch_all(MYSQLI_ASSOC);
	foreach ($contactArray as $contact){
		echo "Name: ".$contact['name'];
		echo "ID: ".$contact['id'];
		echo "<br>";
	}
}



function insertContactListTest($phonebook) {
	
}

function insertOneContactTest($phonebook, $contact){
	$phonebook->addNewContact($contact);
}

?>