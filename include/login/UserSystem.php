<?php
include 'User.php';

class UserSystem {

	private $table = "users";
	private $user;
	public function __construct() {
		$username = $_SESSION['userName'];
		$email = $_SESSION['email'];
		$usernameF = Bolt::$db -> connection -> real_escape_string($username);
		$emailF = Bolt::$db -> connection -> real_escape_string($email);
		//echo "SELECT * FROM users where userName = '" . $usernameF . "' AND email = '" . $emailF . "'";
		$details = Bolt::$db -> fetchObject("SELECT * FROM users where userName = '" . $usernameF . "' AND email = '" . $emailF . "'");
		//var_dump($details);
		$this -> user = new User($details -> userID, $details -> userName, $details -> fullName, $details -> email,$details->password, $details->prevl, true);
	}

	public function isLoggedIn() {
		if (!empty($_SESSION['loggedIn']) && !empty($_SESSION['userName'])) {
			return true;
		}
		return false;
	}

	function isUser($name) {
		// sends query to db num_rows function
		$name = Bolt::$db -> connection -> real_escape_string($name);
		$count = Bolt::$db -> rows("SELECT userID FROM users WHERE userName ='$name';");
		// if number of rows = 0 the user doesn't exist.
		if ($count > 0)
			return true;
		else
			return false;
	}

	public function getUser() {
		return $this -> user;
	}

	public function login() {
		$username = $_POST['username'];
		$password = encryptMe($_POST['password']);

		$usernameF = Bolt::$db -> connection -> real_escape_string($username);
		$passwordF = Bolt::$db -> connection -> real_escape_string($password);
		$query = "SELECT userID FROM users WHERE userName = '" . $usernameF . "' AND password = '" . $passwordF . "'";
		
		$checklogin = Bolt::$db -> rows($query);

		if ($checklogin == 1) {
			$details = Bolt::$db -> fetchObject("SELECT * FROM users where userName = '" . $usernameF . "' AND password = '" . $passwordF . "'");
			$_SESSION['userName'] = $details -> userName;
			$_SESSION['email'] = $details -> email;
			$_SESSION['loggedIn'] = 1;
			$this -> user = new User($details -> userID, $details -> userName, $details -> fullName, $details -> email,$details->password, true);	
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
	public function getUserList(){
		$details = Bolt::$db -> fetchAll("SELECT * FROM users");
		return $details;
	}

	public function register() {
		if (!empty($_POST['username']) && !empty($_POST['pass']) && !empty($_POST['name']) && !empty($_POST['email'])) {

			// store all values
			$username = $_POST['username'];
			$name = $_POST['name'];
			$password = encryptMe($_POST['pass']);
			$email = $_POST['email'];

			$usernameF = Bolt::$db -> connection -> real_escape_string($username);
			$passwordF = Bolt::$db -> connection -> real_escape_string($password);
			$nameF = Bolt::$db -> connection -> real_escape_string($name);
			$emailF = Bolt::$db -> connection -> real_escape_string($name);

			$query = "SELECT userID FROM users WHERE userName = '" . $usernameF . "'";
			$checklogin = Bolt::$db -> rows($query);
			$date = date('Y-m-d H:i:s');

			if ($checklogin == 1) {
				return false;

			} else {

				if (Bolt::$db -> insert(array('userName', 'fullName', 'email','dateCreate', 'password'), array($username, $name, $email,$date, $password), 'users')) {

					return true;
				} else {
					return false;
				}
			}

		}
	}
        public function deleteUser($qID){
            
            return Bolt::$db->query('DELETE FROM users WHERE userID='.$qID);
        }

}
?>