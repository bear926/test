<?php
defined('IND') or die('No direct script access.');
class Registration{
	public $mail;
	public $login;
	public $pass;
	public $w;
	
	function clear($str){	
		return addslashes(htmlspecialchars(trim($str)));
	}
			
	function __construct($mail="",$login="", $pass="", $passr=""){
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			
			if(!isset($_SESSION['str'])){
				echo "Pless ON image for you browse";
			}
			elseif($_SESSION['str'] == strtoupper($_POST['str'])){
	
				Registration::clear($mail);
				Registration::clear($login);
				Registration::clear($pass);
				Registration::clear($passr);
				
				if( preg_match("|([a-z0-9_\.\-]{1,20})@([a-z0-9\.\-]{1,20})\.([a-z]{2,4})|is",$mail) and ($pass === $passr) and (!empty($login) or !empty($pass) or !empty($mail))) {
					if(!SQL::check_reg($mail, $login)){
						if(SQL::reg($mail,$login,$pass)){
							session_start();
							$_SESSION['msg'] =  $GLOBALS['erok'];
							
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
				echo   $GLOBALS['ercap'];
			}
		}
		else{
			echo "ERROR";
		}
	}
}

?>