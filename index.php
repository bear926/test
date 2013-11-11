<?php

/**
 * @file
 * sdfghjdfghjgh.
 */

session_start();
header('Content-Type: text/html; charset=utf-8');
define('ROOT',$_SERVER['SERVER_NAME'].'/');
define('CLAS','sys/class/');
define('VIEWS','sys/views/');
define('LANG','sys/lang/');
define('DB','sys/class/db');
define("DB_HOST", "localhost");
define("DB_LOGIN", "root1");
define("DB_PASSWORD", "password");
define("IND", "IND");
$dbh = new SQL('mysql:host=localhost;dbname=test1', DB_LOGIN, DB_PASSWORD);

/**
 * Magic function load nodefend class.
 *
 * @param strig $cl
 *   Name class.
 */
function __autoload($cl) {
	require_once CLAS.$cl.".php";
}

//підключаєм db
require_once DB.".php";

//підключаєм мову 
require_once LANG.URL::lang('en').".txt"; 

// клас Views для виводу даних
$content = new Views(); 

// перевіряєм адресну строку
if (URL::explod() == "out") {
	Users::out();
}	
if (URL::explod() == "registration") {
	$content->registration;
}
else {
	$content->enter;
	
	if (URL::adm('newz') == "newz") {
		$content->newz;
	}
	else {
		$content->news;
	}
}

//підключаєм шаблон
require_once VIEWS."templete.php"; 


?>
