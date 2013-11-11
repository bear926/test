<?php
//defined('IND') or die('No direct script access.');
class SQL extends PDO {

	const DB_HOST = 'localhost';
	const DB_LOGIN = "root1";
	const DB_PASSWORD = "password";
	
	public $sql;
	public $v;
	public $role;
	public $datam = array();
	public $msg;
	public $lang = 'en';
	public $PDO;
	
	function reg($email,$login, $pass) {
		$mail = Registration::clear($mail);
		$login = Registration::clear($login);
		$pass = Registration::clear($pass);
		$pass = md5($pass);
		$PDO = new PDO('mysql:host=localhost;dbname=test1', self::DB_LOGIN, self::DB_PASSWORD);
		$sql = "INSERT INTO users (email, login, pass) VALUES ('$email', '$login','$pass')";
		if ($PDO->query($sql)) {
			return true;
		}
		else {
			return false;
		}  
	}
		
	function log($login, $pass){
		$pass = md5($pass);
		$PDO = new PDO('mysql:host=localhost;dbname=test1', self::DB_LOGIN, self::DB_PASSWORD);
		$sql = "SELECT role FROM users WHERE login = '$login' and pass = '$pass'";
		$stmt = $PDO->query($sql);
		$rez = $stmt->fetch(PDO::FETCH_OBJ);
		if($rez){
			return $rez->role;
		}
		else{
			return false;
		}
	}
		
	function addnews($titles, $shorttext, $fulltext, $lang){
		$PDO = new PDO('mysql:host=localhost;dbname=test1', self::DB_LOGIN, self::DB_PASSWORD);
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
		$PDO = new PDO('mysql:host=localhost;dbname=test1', self::DB_LOGIN, self::DB_PASSWORD);
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
		$PDO = new PDO('mysql:host=localhost;dbname=test1', self::DB_LOGIN, self::DB_PASSWORD);
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
		//var_dump($curp);
		$curp -= 1;
		$curp *= $page;
		$PDO = new PDO('mysql:host=localhost;dbname=test1', self::DB_LOGIN, self::DB_PASSWORD);
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
		//var_dump($sql);
		$stmt = $PDO->query($sql);
		//var_dump($stmt);
		global $datam;
		$datam = $stmt->fetchAll(PDO::FETCH_NUM); 
		//var_dump($datam);
		return $datam;
		}
			
	function showup($lang='en', $id){
		$PDO = new PDO('mysql:host=localhost;dbname=test1', self::DB_LOGIN, self::DB_PASSWORD);
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
				LIMIT 0, 5
				";
		$stmt = $PDO->query($sql);
		global $datamup;
		$datamup = $stmt->fetchAll(PDO::FETCH_NUM); 
		return $datamup;
	}
	
	/**
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
		$PDO = new PDO('mysql:host=localhost;dbname=test1', self::DB_LOGIN, self::DB_PASSWORD);
		$col = $PDO->query($sql);
		$m = $col->fetchAll();
		if ($m > $n) {
			$r = $m % $n;
			return $ra = range(1, $n);
		}
	}
	
	function show_news($id, $lang='en'){
		$PDO = new PDO('mysql:host=localhost;dbname=test1', self::DB_LOGIN, self::DB_PASSWORD);
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