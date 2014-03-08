<?php
/*
 Index for the application
 this acts as a container for the procedural functions
 @author Shidil Boss
 16-2-2014 10:23 PM
 *
 */
 
class Bolt{

public static $db;
public static $config;
public static $_get;

public static function connect(){
	Bolt::$config=getConfig();
	
	Bolt::$db=new DataBase();
}

public static function includeFile($file) {
	include FROOT.'templates/' . $file . '.php';
}

public static function redirect($path){
	header("Location: ".$path."");
}

public static function isParams()
{
	// returns true if count in $_get is >0
	if(count(Bolt::$_get)>0) return true;
	return false;
}
}

?>