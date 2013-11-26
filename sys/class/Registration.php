<?php
defined('IND') or die('No direct script access.');
class Registration{
	public $mail;
	public $login;
	public $pass;
	public $w;
	
	function clear($str){
		return htmlspecialchars(addslashes(trim($str)));
		
	}
		
	function clear_reg($str){
		if(strpos($str, '/')) {
			$_SESSION['msgr'] = "$erchar <strong>$str</strong>.";
			header('Location: registration');
			exit;
		}
		else {
			return strip_tags(addslashes(trim($str)));
		}
	}
	
	function __construct($mail="", $login="", $pass="", $passr=""){
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			
			if(!isset($_SESSION['str'])){
				echo "Pless ON image for you browse";
			}
			elseif($_SESSION['str'] == strtoupper($_POST['captha'])){
	
				Registration::clear_reg($mail);
				Registration::clear_reg($login);
				Registration::clear_reg($pass);
				Registration::clear_reg($passr);
					echo $_SESSION['msgn'];	
				if( preg_match("|([a-z0-9_\.\-]{1,20})@([a-z0-9\.\-]{1,20})\.([a-z]{2,4})|is",$mail) and ($pass === $passr) and (!empty($login) or !empty($pass) or !empty($mail))) {
					if(!SQL::check_reg($mail, $login)){
						if(SQL::reg($mail,$login,$pass)){
							
							if ($User = new Users($login, $pass)){
								header('Location: index.php');
							}
							else {
								
							}
					
						}
						else{
							echo "ERROR db";
						}
					}
					else{
						echo $GLOBALS['chekus'];
					}
				}
				else {
					echo  $GLOBALS['nodata'];
				}
			}
			else {
				echo  $GLOBALS['ercap'];
			}
		}
		else{
			echo "ERROR";
		}
	}
}

?>