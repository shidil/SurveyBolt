<?php
	
class User {
	
	protected $ID;
	protected $userName;
	protected $name;
	protected $email;
	protected $logged;
	protected $password;
	// methods
	
	function User($ID,$userName,$name,$email,$pass,$logged){
		$this->ID=$ID;
		$this->userName=$userName;
		$this->email=$email;
		$this->name=$name;
		$this->logged=$logged;
		$this->password=$pass;
	}
	
	public function getID(){
		return $this->ID;
	}
	public function getName(){
		return $this->name;
	}
	public function getUsername(){
		return $this->userName;
	}
	public function getEmail(){
		return $this->email;
	}
	public function getPassword(){
		return $this->password;
	}
	public function updateProfile($name){
		///to do
	}
}

?>