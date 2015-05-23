<?php
	session_destroy();
	setcookie("loggedOut", 'true', time()+30);
	redirect(DOMAIN.'?msg=logout');
?>