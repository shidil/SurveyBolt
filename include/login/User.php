<?php
	
class User {
	
	protected $ID;
	protected $userName;
	protected $name;
	protected $email;
	protected $logged;
	
	// methods
	
	function User($ID,$userName,$name,$email,$logged){
		$this->ID=$ID;
		$this->userName=$userName;
		$this->email=$email;
		$this->name=$name;
		$this->logged=$logged;
	}
	
	public function getID(){
		return $this->ID;
	}
}

?>