<?php
/*
 Index for the application
 this acts as a loader for the loaders
 @author Shidil Boss
 25-12-2013 11:36 PM
 *
 */
include 'config.php';

function getConfig(){
	global $config;
	return($config);
}
session_start();

require_once 'include/loader.php';
$uSys = new UserSystem;
SurveyBolt::connect();

$rules = array( 
    'login'   => "/login",    // '/picture/some-text/51'
    'logout'   => "/logout",    // '/picture/some-text/51'
    'register'     => "/register",              // '/album/album-slug'
    'about'  => "/about",        // '/category/category-slug'
    'demo'      => "/demo",          // '/page/about', '/page/contact'
    'post'      => "/(?'post'[\w\-]+)",                     // '/post-slug'
    'home'      => "/"                                      // '/'
);
$uri = rtrim( dirname($_SERVER["SCRIPT_NAME"]), '/' );
$uri = '/' . trim( str_replace( $uri, '', $_SERVER['REQUEST_URI'] ), '/' );
$uri = urldecode( $uri );

foreach ( $rules as $action => $rule ) {
    if ( preg_match( '~^'.$rule.'$~i', $uri, $params ) ) {
        /* now you know the action and parameters so you can 
         * include appropriate template file ( or proceed in some other way )
         */
        include( FROOT . $action . '.php' );

        // exit to avoid the 404 message 
        exit();
    }
}
// nothing is found so handle the 404 error
includeFile('404');
/*

if ($_GET) {
	switch ($_GET['action']) {
		case 'login' :
			
			if ($_POST) {
				if (!$uSys -> isLoggedIn()) {
					echo $uSys -> login();
				} else {
					redirect(DOMAIN . 'dashboard/');
				}
			} else {
				includeFile('login');
			}
			break;

		default :
			//includeFile('header');
			includeFile('404');
			//includeFile('footer');
			break;
	}

} else {
	includeFile('header');
	includeFile('index');
	includeFile('footer');
}*/
?>
