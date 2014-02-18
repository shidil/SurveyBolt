<?php
/*
 Index for the application
 this acts as a container for the procedural functions
 @author Shidil Boss
 16-2-2014 10:23 PM
 *
 */
 
class SurveyBolt{

public static $db;
public static $config;
public static function connect(){
	SurveyBolt::$config=getConfig();
	
	SurveyBolt::$db=new DataBase();
}

public static function includeFile($file) {
	include FROOT.'templates/' . $file . '.php';
}

public static function redirect($path){
	header("Location: ".$path."");
}

}

?>