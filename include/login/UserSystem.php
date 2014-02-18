<?php
include 'User.php';

class UserSystem {

	private $table = "mg_users";

	public function isLoggedIn() {
		if (!empty($_SESSION['loggedIn']) && !empty($_SESSION['userName'])) {
			return true;
		}
		return false;
	}
	function isUser($name){
		// sends query to db num_rows function
		$name=SurveyBolt::$db->connection->real_escape_string(name);
		$count=SurveyBolt::$db->rows("SELECT userID FROM users WHERE userName ='$name';");
		// if number of rows = 0 the user doesn't exist.
		if($count>0) return true;
		else return false;
	}
	public function login() {
		$username = $_POST['username'];
		$password = encryptMe($_POST['password']);
		
		$usernameF = SurveyBolt::$db->connection->real_escape_string($username);
		$passwordF = SurveyBolt::$db->connection->real_escape_string($password);
		$query="SELECT userID FROM users WHERE userName = '" . $usernameF . "' AND password = '" . $passwordF . "'";
		$checklogin = SurveyBolt::$db->rows($query);

		if ($checklogin ==1) {
			$details = SurveyBolt::$db->fetchAll($this->table,"userName = '" . $usernameF . "' AND password = '" . $passwordF . "'");
			$email = $row['EmailAddress'];
			$_SESSION['userName'] = $username;
			$_SESSION['email'] = $email;
			$_SESSION['loggedIn'] = 1;
			return true;
		} else {
			return false;
		}
	}

	public function loginForm() {
		echo '
		   <h1>Member Login</h1>  
      
   <p>Thanks for visiting! Please either login below, or <a href="register.php">click here to register</a>.</p>  
      
    <form method="post" action="index.php" name="loginform" id="loginform">  
    <fieldset>  
        <label for="username">Username:</label><input type="text" name="username" id="username" /><br />  
        <label for="password">Password:</label><input type="password" name="password" id="password" /><br />  
        <input type="submit" name="login" id="login" value="Login" />  
    </fieldset>  
    </form> ';
	}

	public function register() {
		if (!empty($_POST['username']) && !empty($_POST['password'])) {
			$username = mysql_real_escape_string($_POST['username']);
			$fname = mysql_real_escape_string($_POST['fname']);
			$lname = mysql_real_escape_string($_POST['lname']);
			$password = encryptMe($_POST['password']);
			$email = mysql_real_escape_string($_POST['email']);

			$checkusername = mysql_query("SELECT * FROM users WHERE Username = '" . $username . "'");

			if (mysql_num_rows($checkusername) == 1) {
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
	}

}
?>