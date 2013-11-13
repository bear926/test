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
		
		var_dump($sql);
		if ($PDO->query($sql)) {
			$_SESSION['msgn'] = "Users <strong>$user</strong> deleted. <br />";
			header("Location: userlist");
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
	
	
	
	
	function addnews($titles, $shorttext, $fulltext, $lang){
		$PDO = new PDO("mysql:host=localhost;dbname=".self::DB_NAME."", self::DB_LOGIN, self::DB_PASSWORD);
		$titles = Registration::clear($titles);
		$shorttext = Registration::clear($shorttext);
		$fulltext = Registration::clear($fulltext);
		$user = $_SESSION['user'];
		$time = date("Y-m-d H:i:s", time());
		$sqla = array(	
						"INSERT INTO posts (title_$lang, author, time) VALUES ('$titles', '$user', '$time')",
						"INSERT INTO posts_short (short_$lang) VALUES ('$shorttext')",
						"INSERT INTO posts_full (full_$lang) VALUES ('$fulltext')"
						);
		foreach($sqla as $f){
			$PDO->query($f);
		}
		$_SESSION['msgn'] = $GLOBALS['is']." ";
		header("Location: http://test1.rpgfun.net/".$id);
	}
		
	function upnews($id, $titles, $shorttext, $fulltext, $lang = 'en'){
		$PDO = new PDO("mysql:host=localhost;dbname=".self::DB_NAME."", self::DB_LOGIN, self::DB_PASSWORD);
		$titles = Registration::clear($titles);
		$shorttext = Registration::clear($shorttext);
		$fulltext = Registration::clear($fulltext);
		$user = $_SESSION['user'];
		$time = date("Y-m-d H:i:s", time());
		$sqla = array(	"UPDATE posts SET title_$lang = '$titles' WHERE id = $id",
						"UPDATE posts SET author = '$user' WHERE id = $id",
						"UPDATE posts SET time = '$time' WHERE id = $id",
						"UPDATE posts_short SET short_$lang = '$shorttext' WHERE id = $id",
						"UPDATE posts_full SET full_$lang = '$fulltext' WHERE id = $id"
						);

		foreach($sqla as $f){
			$PDO->query($f);
		}
		$_SESSION['msgn'] = $GLOBALS['up']." ";
		header("Location: http://test1.rpgfun.net/".$id);
	}
		
	function del($id){
		$PDO = new PDO("mysql:host=localhost;dbname=".self::DB_NAME."", self::DB_LOGIN, self::DB_PASSWORD);
		$sqla = array(	"DELETE FROM posts WHERE id = $id",
						"DELETE FROM posts_short WHERE id = $id",
						"DELETE FROM posts_full WHERE id = $id"
						);

		foreach($sqla as $f){
			$PDO->query($f);
		}
		$_SESSION['msgn'] = $GLOBALS['del'].$id." ";
		header("Location: http://test1.rpgfun.net/".$id);
			
	}
		
	function show_all($lang='en', $curp='1') {
		//Who numb page in one page
		if ($curp == NULL)
			$curp = '1';
		$page = 2;
		$curp -= 1;
		$curp *= $page;
		$PDO = new PDO("mysql:host=localhost;dbname=".self::DB_NAME."", self::DB_LOGIN, self::DB_PASSWORD);
		$sql = "SELECT 
				posts.id,
				posts.author,
				posts.time,
				posts.title_$lang,
				posts_short.short_$lang,
				posts_full.full_$lang
			FROM posts
			INNER JOIN posts_short ON posts.id = posts_short.id
			INNER JOIN posts_full ON posts.id = posts_full.id
			ORDER BY posts.id DESC
			LIMIT $curp, $page
		";
		$stmt = $PDO->query($sql);
		global $datam;
		$datam = $stmt->fetchAll(PDO::FETCH_NUM); 
		return $datam;
		}
			
	function showup($lang='en', $id){
		$PDO = new PDO("mysql:host=localhost;dbname=".self::DB_NAME."", self::DB_LOGIN, self::DB_PASSWORD);
		$sql = "SELECT 
					posts.id,
					posts.author,
					posts.time,
					posts.title_$lang,
					posts_short.short_$lang,
					posts_full.full_$lang
				FROM posts
				INNER JOIN posts_short ON posts.id = $id AND posts.id = posts_short.id
				INNER JOIN posts_full ON posts.id = posts_full.id
				";
		$stmt = $PDO->query($sql);
		global $datamup;
		$datamup = $stmt->fetchAll(PDO::FETCH_NUM); 
		return $datamup;
	}
	
	/**
	 * function page();
	 * Explode pages as qeury.
	 *
	 * @param string $n
	 *   Who show number page in index page.
	 *
	 * @param string $lang
	 *   Lang site.
	 *
	 * @return array $ra
	 *   Value array is a number page.
	 */
	function page($n, $lang) {
		$sql = "SELECT 
						posts.id,
						posts.author,
						posts.time,
						posts.title_$lang,
						posts_short.short_$lang,
						posts_full.full_$lang
					FROM posts
					INNER JOIN posts_short ON posts.id = posts_short.id
					INNER JOIN posts_full ON posts.id = posts_full.id
					ORDER BY posts.id DESC
					";
		$PDO = new PDO("mysql:host=localhost;dbname=".self::DB_NAME."", self::DB_LOGIN, self::DB_PASSWORD);
		$col = $PDO->query($sql);
		$m = $col->fetchAll();
		if ($m > $n) {
			$r = $m % $n;
			return $ra = range(1, $n);
		}
	}
	
	function show_news($id, $lang='en'){
		$PDO = new PDO("mysql:host=localhost;dbname=".self::DB_NAME."", self::DB_LOGIN, self::DB_PASSWORD);
		$sql = "SELECT	posts_full.full_$lang 
				FROM posts_full
				WHERE id = $id
				";
		if($rez = $PDO->query($sql)){
			$dat = $rez->fetch(PDO::FETCH_ASSOC);
			return $dat["full_$lang"];
		}
		else{
			return false;
		}
	}
}
	
?>