<?php
defined('IND') or die('No direct script access.');
class Views {
	static $template = "sys/views/";
	public $asc = array();  
	static $a;
function __get($name){
		self::$a++;
		 $this->asc[self::$a]  = self::$template.$name.".php";
	}
	
function cut($str){
	if (strlen($str) > 152){
		$rest = substr($str, 0, 152);
		$rest = substr($rest, 0, strrpos($rest, " "));
		return  $rest;
	}
	else {
		return false;
	}
}	
}

?>