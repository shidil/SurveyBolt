<?php
if ($uSys -> isLoggedIn()) {
		redirect(DOMAIN . 'dashboard/');
}
if ($_POST) {

	if ($uSys -> register()) {
		includeFile('register-success');
	} else {
		includeFile('register-fail');
	}

} else {
	includeFile('register');
}
?>