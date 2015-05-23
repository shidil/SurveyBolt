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

define('FROOT', __DIR__.'/');	// File root of the project

define("DOMAIN", "http://survey-rasterproject.rhcloud.com/"); /// Domain root

////////////////////   Database   ////////////////////////////

$config['db_host'] = getenv("OPENSHIFT_MYSQL_DB_HOST");
$config['db_name'] = 'surveymg';
$config['db_user'] = 'adminl5I58R9 ';
$config['db_pass'] = 'fz691tf3gcZV';

?>