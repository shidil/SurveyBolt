<?php
 /* 
 	Index for the application
 	this acts as a loader for the loaders
 	@author Shidil Boss
 	25-12-2013 11:36 PM
 *
 */
 session_start();
 include 'config.php';
 require_once 'include/loader.php';
 
 include 'templates/index.php';
 
?>
