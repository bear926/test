<?php
defined('IND') or die('No direct script access.');
class Users{
	public $login;
	public $pass;
	public $q = false;
function clear($str){	
		return addcslashes(htmlspecialchars(trim($str)));
	}

function __construct($login="", $pass=""){
		$this->clear($login);
		$this->clear($pass);
			if(!empty($login) or !empty($pass)) {
				if(SQL::log($login,$pass)){
					session_start();
					$_SESSION['user'] = $login;
					$_SESSION['role'] = SQL::log($login,$pass);
		        }
				else{
					echo $GLOBALS['erdata'];
				}
			}
			else{
				echo $GLOBALS['nodata'];
			}
		}
		
function out() {
			session_destroy();
			header('Location: index.php');
	}
	
function role() {
	if(SQL::log($login,$pass)=='1'){
		return true;
		}
		else{
			return false;
		}
	}
}

?>