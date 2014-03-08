<?php

if ($uSys -> isLoggedIn()) {

	if (Bolt::isParams()) {
		switch (Bolt::$_get['action']) {
			case 'new':
				includeFile('dashboard-new');
				break;
			case 'edit':
				includeFile('dashboard-edit');
				break;
			default:
				includeFile('dashboard');
				break;
		}
	} else {
		includeFile('dashboard');
	}
}
else redirect(DOMAIN.'login');
?>