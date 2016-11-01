
<?php
require_once 'db/db.php';
class Phonebook extends DB {
	const ALL_CONTACTS = "select * from contacts where usuario=?;";
	const CONTACTS_ID = "select * from contacts where id=?;";
	const INSERT_CONTACTS = "insert into contacts (name, phone, cellphone, email,usuario) values (?,?,?,?,?);";
	const DEL_CONTACTS = "delete from contacts where id=?;";
	const EDIT_CONTACT = "update contacts set name=?,phone=?,cellphone=?,email=? where id=? " ;
	
	
	public function addNewContact($contact,$id) {
		$this->open_connection ();
		$statement = $this->conn->prepare ( self::INSERT_CONTACTS );
		if ($statement) {
			$statement -> bind_param("ssssi", $contact['name'], $contact['phone'], $contact['cellphone'], $contact['email'],$id);
			$statement->execute();
		}		
		else{
			echo "Algo malio sal INSERT";
		}
		$statement->close();
		$this->close_connection();
	}
	
	/**
	 *
	 * @param string $data        	
	 */
	public function insertContact($contactList) {
	}
	
	// FIXME
	public function insertContactList($contactList) {
	}
	
	// TODO Adicionar parametro de tipo de dato de retorno para devolver
	// un json o un array
	public function getAllContacts($id) {
		$result = $this->query ( self::ALL_CONTACTS,[$id]);
		if ($result != false) {
			return $result;
		} else {
			die ( "Algo malio sal en getAllContacts" );
		}
	}
	public function getContactById($id) {
		$result = $this->query ( self::CONTACTS_ID, [ 
				$id 
		] );
		if ($result != false) {
			return $result;
		} else {
			die ( "Algo malio sal en getContactById" );
		}
	}
	public function deleteContactById($id) {
		// TODO implement
		$result = $this->query ( self::DEL_CONTACTS, [ 
				$id 
		] );
		
	}

	public function editcontact($contact){
		$this->open_connection ();
		$statement = $this->conn->prepare ( self::EDIT_CONTACT);
		if ($statement) {
			$statement -> bind_param("sssss", $contact['name'], $contact['phone'], $contact['cellphone'], $contact['email'],$contact['id']);
			$statement->execute();
		}		
		else{
			echo "Algo malio sal UPDATE";
		}
		$statement->close();
		$this->close_connection();
	}
}

?>