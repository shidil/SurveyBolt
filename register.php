<?php
if ($uSys -> isLoggedIn()) {
		redirect(DOMAIN . 'dashboard/');
}
if ($_POST) {
   	if($_POST['pass'] != $_POST['pass_confirmation']){
					includeFile('register');
					echo "Password not matching";}
       
	else if ($uSys -> register()) {
		includeFile('register-success');
	} else {
		includeFile('register-fail');
	}

} else {
	includeFile('register');
}
?>