<?php
if ($uSys -> isLoggedIn()) {
		redirect(DOMAIN . 'dashboard/');
}
if ($_POST) {

	if ($uSys -> login()) {
		redirect(DOMAIN . 'dashboard/');
	} else {
		includeFile('login-fail');
	}

} else {
	includeFile('login');
}
?>