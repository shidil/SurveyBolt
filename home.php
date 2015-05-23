<?php
if ($uSys -> isLoggedIn()) {
		redirect(DOMAIN . 'dashboard/');
}
includeFile('header');
includeFile('index');

if (isset($_GET['msg'])) {
    $jsAlert = jsAlert(getMessage($_GET['msg']));
}

includeFile('footer');
?>