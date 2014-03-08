<?php
if ($uSys -> isLoggedIn()) {
		redirect(DOMAIN . 'dashboard/');
}
includeFile('header');
includeFile('index');
if (isset($_COOKIE['loggedOut']))
	if ($_COOKIE['loggedOut'] == 'true') {
		echo "	<script>
	$(document).ready(function() {
		w2alert('You have been successfully logged out.');
	}); 
</script>";
	}

includeFile('footer');
?>