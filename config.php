<?php
 
 /*
 * 
 	Master config file.
 	this file contains config informations for app and database.
 	@author Shidil Boss
 	25-12-2013 11:36 PM
 *
 */

$config = array();

///////////////////// Application  ///////////////////////////

define('FROOT', 'c:/server/www/survey/');	// File root of the project

define("DOMAIN", "http://localhost/survey/"); /// Domain root

////////////////////   Database   ////////////////////////////

$config['db_host'] = 'localhost';
$config['db_name'] = 'surveymg';
$config['db_user'] = 'root';
$config['db_pass'] = '';

?>