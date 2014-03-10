<?php
include 'Survey.php';
include 'Question.php';

class SurveySystem {

	private $table = "surveys";

	function isSurvey($survey) {
		// if the parameter is integer we search for surveyID
		if (is_numeric($survey))
			return $this -> isSurveyID($survey);
		// if parameter is string we search for surveyName
		elseif (is_string($survey))
			return $this -> isSurveyName($survey);
	}

	function isSurveyName($name) {
		// sends query to db num_rows function

		$name = Bolt::$db -> connection -> real_escape_string($name);
		$count = Bolt::$db -> rows("SELECT surveyID FROM '$this->table' WHERE surveyName ='$name';");
		// if number of rows = 0 the user doesn't exist.
		if ($count > 0)
			return true;
		else
			return false;
	}

	function isSurveyID($id) {
		// sends query to db num_rows function

		$id = Bolt::$db -> connection -> real_escape_string($id);
		$count = Bolt::$db -> rows("SELECT surveyName FROM $this->table WHERE surveyID =$id;");
		// if number of rows = 0 the user doesn't exist.
		if ($count > 0)
			return true;
		else
			return false;
	}
	public function getSurveyByID($id){
		if($this->isSurvey($id)){
			$surveyID = Bolt::$db -> connection -> real_escape_string($id);
			$details=Bolt::$db->fetchObject("SELECT * FROM surveys WHERE surveyID = " . $surveyID);
			$survey = new Survey($details->surveyID,$details->surveyName,$details->author);
			return $survey;
		}
		else {
			return false;
		}
	}
	public function getSurveys() {

	}

	public function getSurveyList() {
		$uSys = new UserSystem();
		$user = $uSys -> getUser();
		$userID = $user->getID();
		$userID=Bolt::$db -> connection -> real_escape_string($userID);
		$details = Bolt::$db -> fetchAll("SELECT * FROM surveys WHERE author = " . $userID);
		return $details;
	}

	public function getSurveyByName($name) {
		$username = $_POST['username'];
		$password = encryptMe($_POST['password']);

		$usernameF = Bolt::$db -> connection -> real_escape_string($username);
		$passwordF = Bolt::$db -> connection -> real_escape_string($password);
		$query = "SELECT userID FROM users WHERE userName = '" . $usernameF . "' AND password = '" . $passwordF . "'";
		$checklogin = Bolt::$db -> rows($query);

		if ($checklogin == 1) {
			$details = Bolt::$db -> fetchAll($this -> table, "userName = '" . $usernameF . "' AND password = '" . $passwordF . "'");
			$email = $row['EmailAddress'];
			$_SESSION['userName'] = $username;
			$_SESSION['email'] = $email;
			$_SESSION['loggedIn'] = 1;
			return true;
		} else {
			return false;
		}
	}

	public function addSurvey() {

		if (!empty($_POST['name'])) {
			$uSys = new UserSystem();
			$user = $uSys -> getUser();
			// store all values
			$name = $_POST['name'];
			$nameF = Bolt::$db -> connection -> real_escape_string($name);
			$idF = Bolt::$db -> connection -> real_escape_string($user -> getID());
			$slug = strtolower(str_replace(' ', '-', $name));
			$date = date('Y-m-d H:i:s');
			if (Bolt::$db -> insert(array('surveyName', 'slug', 'author', 'date', 'modified'), array($name, $slug, $user -> getID(), $date, $date), $this -> table)) {
				$ID = Bolt::$db -> fetchObject("SELECT surveyID FROM surveys WHERE surveyName='$nameF' AND author='$idF' AND date= '$date'");

				return $ID -> surveyID;
			} else {
				return false;
			}
		}
	}

}
?>