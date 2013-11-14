<?php
defined('IND') or die('No direct script access.');
class SQL extends PDO {

	const DB_HOST = 'localhost';
	const DB_LOGIN = 'root1';
	const DB_PASSWORD = 'password';
	const DB_NAME = 'test1';
	
	public $sql;
	public $v;
	public $role;
	public $datam = array();
	public $msg;
	public $lang = 'en';
	public $PDO;
	
	function reg($email,$login, $pass) {
		$mail  = Registration::clear($mail);
		$login = Registration::clear($login);
		$pass  = Registration::clear($pass);
		$pass = md5($pass);
		$time = date("Y-m-d H:i:s", time());
		$PDO = new PDO("mysql:host=localhost;dbname=".self::DB_NAME."", self::DB_LOGIN, self::DB_PASSWORD);
		$sql = "INSERT INTO users (email, login, pass, treg) VALUES ('$email', '$login','$pass','$time')";
		if ($PDO->query($sql)) {
			return true;
		}
		else {
			return false;
		}  
	}
	
	
	/**
	 * function check_reg();
	 * Checks whether there is a user.
	 *
	 * @param string $email
	 *   Email user
	 *
	 * @param string $login
	 *   Login user.
	 *
	 * @return bollean true or false
	 *   
	 */
	function check_reg($email, $login) {
		$mail = Registration::clear($email);
		$login = Registration::clear($login);
		$PDO = new PDO("mysql:host=localhost;dbname=".self::DB_NAME."", self::DB_LOGIN, self::DB_PASSWORD);
		$sql = "SELECT role FROM users WHERE login = '$login' or email = '$mail'";
		$stmt = $PDO->query($sql);
		$rez = $stmt->fetch(PDO::FETCH_OBJ);
		if ($rez) {
			return true;
		}
		else {
			return false;
		} 
	}
	
	/**
	 * function show_user();
	 * Show all user.
	 *
	 * @param string $email
	 *   Email user
	 *
	 * @param string $login
	 *   Login user.
	 *
	 * @return araay $rez or false
	 *   
	 */
	function show_user() {
		
		$PDO = new PDO("mysql:host=localhost;dbname=".self::DB_NAME."", self::DB_LOGIN, self::DB_PASSWORD);
		$sql = "SELECT login, role FROM users";
		$stmt = $PDO->query($sql);
		$rez = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if ($rez) {
			return $rez;
		}
		else {
			return false;
		} 
	}
	
		/**
	 * function del_user();
	 * Delete user.
	 *
	 * @param string $user
	 *   Login user.
	 *
	 * @return true or false
	 *   
	 */
	function del_user($user) {
		
		$PDO = new PDO("mysql:host=localhost;dbname=".self::DB_NAME."", self::DB_LOGIN, self::DB_PASSWORD);
		$sql = "DELETE FROM users WHERE login = '$user'";

		if ($PDO->query($sql)) {
			$_SESSION['msgn'] = "Users <strong>$user</strong> deleted. <br />";
			header("Location: userlist");
			exit;
		}
		else {
			echo "error";
		} 
	}


	
	/**
	 * function user_up();
	 * Update user info.
	 *
	 * @param string $log or $email,$login,$pass,$name,$lname
	 *
	 * @return array $datau 
	 *   
	 */
	function user_up($log='', $email='',  $pass='', $name='', $lname='',$role='2') {
		$PDO = new PDO("mysql:host=localhost;dbname=".self::DB_NAME."", self::DB_LOGIN, self::DB_PASSWORD);
		if ($email != '') {
			$email = Registration::clear($email);
			$log   = Registration::clear($log);
			$pass  = Registration::clear($pass);
			$name  = Registration::clear($name);
			$lname = Registration::clear($lname);
			if ($pass != ''){
				$pass = md5($pass);
				$sql = "UPDATE users SET 
						email = '$email',
						pass  = '$pass',
						name  = '$name',
						lastname = '$lname',
						role = '$role'
						WHERE login = '$log'";
			}
			$sql = "UPDATE users SET 
					email = '$email',
					name  = '$name',
					lastname = '$lname',
					role = '$role'
			    WHERE login = '$log'";
			if ($PDO->query($sql)){
				header("Location: index.php?user=$log");
				exit;
			}	
		}
		else {
			$sql = "SELECT * FROM users WHERE login = '$log'";
			$stmt = $PDO->query($sql);
			global $datau;
			$datau = $stmt->fetchAll(PDO::FETCH_ASSOC); 
			$datau = $datau['0']; 
			return $datau;
		}
	}
	
	function log($login, $pass){
		$pass = md5($pass);
		$PDO = new PDO("mysql:host=localhost;dbname=".self::DB_NAME."", self::DB_LOGIN, self::DB_PASSWORD);
		$sql = "SELECT role FROM users WHERE login = '$login' and pass = '$pass'";
		$stmt = $PDO->query($sql);
		$rez = $stmt->fetch(PDO::FETCH_OBJ);
		if ($rez) {
			$tlog = date("Y-m-d H:i:s", time());
			$sql = "UPDATE users SET tlog = '$tlog' WHERE login = '$login' and pass = '$pass'";
			$stmt = $PDO->query($sql);
			return $rez->role;
		}
		else {
			return false;
		}
	}
	

	
	function addnews($titles, $fulltext, $lang){
		$PDO = new PDO("mysql:host=localhost;dbname=".self::DB_NAME."", self::DB_LOGIN, self::DB_PASSWORD);
		$user = $_SESSION['user'];
		$time = date("Y-m-d H:i:s", time());
		foreach($lang as $v){
		  $title = $titles["$v"];
			$text = $fulltext["$v"];
			$title = Registration::clear($title);
		  $text = Registration::clear($text);
			if ($title =='' or $text ==''){
				continue;
			}
			$sqla = "INSERT INTO post_$v (title, author, time, text) VALUES ('$title', '$user', '$time','$text')";
			
			$PDO->query($sqla);
		}
		header("Location: http://test1.rpgfun.net/".URL::lang().'/'.$id);
		exit;
	}
		
	function upnews($id, $titles, $fulltext, $lang = 'en'){
		$PDO = new PDO("mysql:host=localhost;dbname=".self::DB_NAME."", self::DB_LOGIN, self::DB_PASSWORD);
		$titles = Registration::clear($titles);
		$shorttext = Registration::clear($shorttext);
		$fulltext = Registration::clear($fulltext);
		$user = $_SESSION['user'];
		$time = date("Y-m-d H:i:s", time());
		$sqla = "UPDATE post_$lang SET title = '$titles', author = '$user', time = '$time',text = '$fulltext' WHERE id = $id";
			if($PDO->query($sqla )){
				$_SESSION['msgn'] = $GLOBALS['up']." ";
				header("Location: http://test1.rpgfun.net/".URL::lang().'/'.$id);
				exit;
		  }
	}
		
	function del($id, $lang){
		$PDO = new PDO("mysql:host=localhost;dbname=".self::DB_NAME."", self::DB_LOGIN, self::DB_PASSWORD);
		$sqla = "DELETE FROM post_$lang WHERE id = $id";
			if ($PDO->query($sqla)){
				$_SESSION['msgn'] = $GLOBALS['del'].$id." ";
				header("Location: http://test1.rpgfun.net/".URL::lang().'/'.$id);
				exit;
			}
	}
		
	function show_all($lang='en', $curp='1') {
		//That numb page in one page
		if ($curp == NULL)
			$curp = '1';
		$page = 2;
		$curp -= 1;
		$curp *= $page;
		$PDO = new PDO("mysql:host=localhost;dbname=".self::DB_NAME."", self::DB_LOGIN, self::DB_PASSWORD);
		$sql = "SELECT 
			*
			FROM post_$lang
			ORDER BY id DESC
			LIMIT $curp, $page
		";
		$stmt = $PDO->query($sql);
		global $datam;
		$datam = $stmt->fetchAll(PDO::FETCH_NUM);
		return $datam;
	}
		
	function showup($lang='en', $id){
		$PDO = new PDO("mysql:host=localhost;dbname=".self::DB_NAME."", self::DB_LOGIN, self::DB_PASSWORD);
		$sql = "SELECT * FROM post_$lang WHERE id = '$id'";
		$stmt = $PDO->query($sql);
		global $datamup;
		$datamup = $stmt->fetchAll(PDO::FETCH_ASSOC); 
		return $datamup;
	}
	
	/**
	 * function page();
	 * Explode pages as qeury.
	 *
	 * @param string $n
	 *   That show number page in index page.
	 *
	 * @param string $lang
	 *   Lang site.
	 *
	 * @return array $ra
	 *   Value array is a number page.
	 */
	function page($n, $lang) {
		$sql = "SELECT 
						*
					FROM post_$lang
					ORDER BY id DESC
					";
		$PDO = new PDO("mysql:host=localhost;dbname=".self::DB_NAME."", self::DB_LOGIN, self::DB_PASSWORD);
		$col = $PDO->query($sql);
		$m = $col->fetchAll();
		$m = count($m);
		if ($m > $n) {
			$r = $m % $n;
			return $ra = range(1, $n);
		}
		else{
			return false;
		}
	}
	
	function show_news($id, $lang='en'){
		$PDO = new PDO("mysql:host=localhost;dbname=".self::DB_NAME."", self::DB_LOGIN, self::DB_PASSWORD);
		$sql = "SELECT text
				FROM post_$lang
				WHERE id = $id
				";
		if($rez = $PDO->query($sql)){
			$dat = $rez->fetch(PDO::FETCH_ASSOC);
			return $dat["text"];
		}
		else{
			return false;
		}
	}
	
	
		/**
	 * function addcoment();
	 * Add coments in database.
	 *
	 * @param string $title, $text, $id, $user, $lang
	 *   That show number page in index page.
	 *
	 * @param string $lang
	 *   Lang site.
	 *
	 * @return array $ra
	 *   Value array is a number page.
	 */
	function addcomment( $title, $text, $id, $user, $lang){
	
		$PDO = new PDO("mysql:host=localhost;dbname=".self::DB_NAME."", self::DB_LOGIN, self::DB_PASSWORD);
		$time = date("Y-m-d H:i:s", time());
		$title = Registration::clear($title);
		$text = Registration::clear($text);
		$sqla = "INSERT INTO comment (id_post, title, lang, author, time, text) VALUES ('$id', '$title', '$lang', '$user', '$time', '$text')";
		if($PDO->query($sqla)){
		
			header("Location: http://test1.rpgfun.net/".URL::lang().'/'.$id);
			exit;
		}
		else{
			echo "ERROR";
		}
	}
	
	
	function allcomment($id, $lang='en', $curp='1') {
		if ($curp == NULL)
			$curp = '1';
		$page = 2;
		$curp -= 1;
		$curp *= $page;
		$PDO = new PDO("mysql:host=localhost;dbname=".self::DB_NAME."", self::DB_LOGIN, self::DB_PASSWORD);
		
		$sql = "SELECT 
			*
			FROM comment
			WHERE id_post = '$id' and lang = '$lang'
			ORDER BY id DESC
			LIMIT $curp, $page
		";
		$stmt = $PDO->query($sql);
		global $datac;
		$datac = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $datac;
	}
}
	
	
	
?>