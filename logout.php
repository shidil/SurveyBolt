<?php
	session_destroy();
	setcookie("loggedOut", 'true', time()+60);
	redirect(DOMAIN);
?>