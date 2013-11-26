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
define('DB_HOST', 'localhost');
define('DB_LOGIN', 'root1');
define('DB_PASSWORD', 'password');
define('IND', 'IND');
$dbh = new SQL('mysql:host=localhost;dbname=test1', DB_LOGIN, DB_PASSWORD);

/**
 * Magic function load nodefend class.
 *
 * @param strig $cl
 *   Name class.
 */
function __autoload($cl) {
	require_once CLAS.$cl.'.php';
}

//conect db
require_once DB.'.php';

//conect lang
require_once LANG.URL::lang('en').'.txt'; 

// class Views for output
$content = new Views(); 

//checks the address bar
if (URL::explod() == 'out') {
	Users::out();
}
	
if (URL::explod() == 'reg') {
	$content->registration;
}
else {
	//Build connection template. Template files must be located in the Templates folder and have the php extension
	$content->enter;
	if (URL::adm('userup') == 'userup') {
		$content->userup;
	}
	else{
		if (URL::adm('userlist') == 'userlist') {
			$content->userlist;
		}
		else {
			if (URL::adm('user') == 'user') {
				$content->user;
			}
			else{
				if (URL::adm('newz') == 'newz') {
					$content->newz;
				}
				else {
					$content->news;
				}
			}
		}
	}
}


//conect main templates
require_once VIEWS.'templete.php'; 


?>
