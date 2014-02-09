<?php
/**
 *	Database class.
 *  this class is used for operations with the database.
 *  all database oprerations of the application will  go
 *  through this class.
 @author Shidil Boss
 25-12-2013 11:36 PM
 *
 */

class DataBase {

	public $connection;

	function Database() {
		$this -> connection = new mysqli($config['db_host'], $config['db_user'], $config['db_pasword'], $config['db_name']);
		if ($this -> connection -> connect_errno) {
			die("Failed to connect to MySQL: " . $this -> connection -> connect_error);
		}
	}

	// methods

	private function exec($query) {

	}

	public function rows($query) {
		if ($result = $this->connection -> query($query)) {
			return $result -> num_rows;
		}	
		return 0;
	}
	public function fetch($fields,$table,$data){
		
		
	}
	public function insert($feilds,$data, $table) {
		$cols = implode(',', array_keys($data));
		foreach (array_values($data) as $value) {
			isset($vals) ? $vals .= ',' : $vals = '';
			$vals .= '\'' . $this -> connection -> real_escape_string($value) . '\'';
		}
		$this -> connection -> real_query('INSERT INTO ' . $table . ' (' . $cols . ') VALUES (' . $vals . ')');
	}

	public function addUser($array) {
		$size = count($array);
		for ($i = 0; $i < $size; $i++) {
			$array[$i] = $this -> connection -> escape_string($array[i]);
		}
		$checkusername = $this -> connection -> query("SELECT * FROM users WHERE Username = '" . $username . "'");

		if ($checkusername -> num_rows == 1) {
			return false;
		} else {
			$registerquery = mysql_query("INSERT INTO users (userName, firstName, lastName,email,password) VALUES('$username', '$fname','$lname', '$email','$password')");
			if ($registerquery) {
				return true;
			} else {
				return false;
			}
		}
	}

	public function removeUser() {

	}

	public function addSurvey() {

	}

	public function removeSurvey() {
	}

}
?>