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
		
	function cut($str, $nc = 152){
		if (strlen($str) > $nc){
			$rest = substr($str, 0, $nc);
			$rest1 = substr($rest, 0, strrpos($rest, " "));
			if ($rest1) {
				return  $rest1;
			}
			else {
			 return  $rest;
			}
		}
		else {
			return false;
		}
	}
	
}

?>