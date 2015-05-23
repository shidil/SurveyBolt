<?php
	if ($uSys -> isLoggedIn()) 
		includeFile('header-logout');
	else
		includeFile('header');
	includeFile('about');
	includeFile('footer');
?>