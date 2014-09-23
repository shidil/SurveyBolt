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
Bolt::connect();
$uSys = new UserSystem;
$sSys = new SurveySystem;

// these are the rules that rewrites the url.

$rules = array( 
    'login'   => "/login",    // '/picture/some-text/51'
    'logout'   => "/logout",    // '/picture/some-text/51'
    'about'   => "/about",    // '/picture/some-text/51'
    'register'     => "/register",              // '/album/album-slug'
    'dashboard'  => "/dashboard([/]*)([^/]*)",
    'demo'      => "/demo",          // '/page/about', '/page/contact'
    'home'      => "/"                                      // '/'
);
$uri = rtrim( dirname($_SERVER["SCRIPT_NAME"]), '/' );
$uri = '/' . trim( str_replace( $uri, '', $_SERVER['REQUEST_URI'] ), '/' );
$uri = urldecode( $uri );

// code for parsing get arguments
foreach ( $rules as $action => $rule ) {
    if ( preg_match( '~^'.$rule.'$~i', $uri, $params ) ) {
        /* now you know the action and parameters so you can 
         * include appropriate template file ( or proceed in some other way )
         */
         $params=$params[2];
		 $params=ltrim($params,'?');
		 $params=string2KeyedArray($params);
         Bolt::$_get=$params;
        include( FROOT . $action . '.php' );

        // exit to avoid the 404 message 
        exit();
    }
}
// nothing is found so handle the 404 error
includeFile('404');
?>
