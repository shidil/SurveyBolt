<?php
/**
 *	Database Survey.
 *  this class is used for holding a survey.
 *
 *	@author Shidil Boss
 *	9-3-2014 12:13 PM
 *
 */

class Survey {

	private $table = 'surveys';
	public $name;
	public $id;
	public $author = null;

	// methods

	function Survey($ID, $name, $user) {
		$this -> id = $ID;
		$this -> author = $user;
		$this -> name = $name;
	}

	public function getID() {
		return $this -> id;
	}

	public function getAuthor() {
		return $this -> author;
	}

}
?>
