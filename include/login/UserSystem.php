<?php
include 'User.php';
class UserSystem {

	private $table = "mg_users";

	public function isLoggedIn() {
		if (!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username'])) {
			return false;
		}
	}

	public function login() {
		$username = mysql_real_escape_string($_POST['username']);
		$password = md5(mysql_real_escape_string($_POST['password']));

		$checklogin = mysql_query("SELECT * FROM users WHERE Username = '" . $username . "' AND Password = '" . $password . "'");

		if (mysql_num_rows($checklogin) == 1) {
			$row = mysql_fetch_array($checklogin);
			$email = $row['EmailAddress'];

			$_SESSION['Username'] = $username;
			$_SESSION['EmailAddress'] = $email;
			$_SESSION['LoggedIn'] = 1;
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

}
?>