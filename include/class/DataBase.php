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

	protected $connection;

	function Database() {
		$this -> connection = new mysqli($config['db_host'], $config['db_user'], $config['db_pasword'], $config['db_name']);
		if ($this -> connection -> connect_errno) {
			die("Failed to connect to MySQL: " . $this -> connection -> connect_error);
		}
	}

	// methods

	private function exec($query) {

	}

	public function addUser() {

	}

	public function removeUser() {

	}

	public function addSurvey() {

	}

	public function removeSurvey() {
	}

}
?>