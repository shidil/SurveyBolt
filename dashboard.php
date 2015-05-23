<?php

if ($uSys -> isLoggedIn()) {
	$uSys = new UserSystem;
	$user=$uSys->getUser();

	if (Bolt::isParams()) {
		switch (Bolt::$_get['action']) {
			case 'new':
				includeFile('dashboard-new');
				break;
			case 'edit':
				includeFile('dashboard-edit');
				break;
                        case 'analyze':
                            includeFile('dashboard-analyze');
                            break;
			case 'settings':
				includeFile('settings');
					break;
			case 'view':
				if($user->getPrevl() == "admin")
					includeFile('dashbord-view');
				else {
					includeFile('dashboard');
				}
					break;
			case 'viewquest':
				if($user->getPrevl() == "admin")
					includeFile('dashboard-viewquest');
				else {
					includeFile('dashboard');
				}
				break;
			case 'help':
				includeFile('help');
				break;
			case 'design':includeFile('dashboard-edit');
				break;
                        case 'access':includeFile('dashboard-edit');
				break;
			default:
				includeFile('404');exit();
				break;
		}
	} 
	else if($user->getPrevl() == "admin"){
		includeFile('admin-dash');
	}
	else {
		includeFile('dashboard');
	}
}
else redirect(DOMAIN.'login');
?>