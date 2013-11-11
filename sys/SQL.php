<?php

mysql_connect(DB_HOST, DB_LOGIN, DB_PASSWORD) or die(mysql_error());

$sql = 'CREATE DATABASE IF NOT EXISTS test1 SET utf8 COLLATE utf8_general_ci;';
mysql_query($sql);
mysql_select_db('test1') or die(mysql_error());

$sql = "
CREATE TABLE IF NOT EXISTS users (
	id int(4) NOT NULL auto_increment,
	login varchar(50) NOT NULL default '',
	pass varchar(50) NOT NULL default '',
	email varchar(50) NOT NULL default '',
	role ENUM('1','2','3') NOT NULL default '2',
	PRIMARY KEY (id)
)";
mysql_query($sql) or die(mysql_error());

$sql = "
CREATE TABLE IF NOT EXISTS posts (
	id int(4) NOT NULL auto_increment,
	title_ua varchar(100) NOT NULL default '',
	title_ru varchar(100) NOT NULL default '',
	title_en varchar(100) NOT NULL default '',
	PRIMARY KEY (id)
)";
mysql_query($sql) or die(mysql_error());

$sql = "
CREATE TABLE IF NOT EXISTS posts_short (
	id int(4) NOT NULL auto_increment,
	short_ua text NOT NULL default '',
	short_ru text NOT NULL default '',
	short_en text NOT NULL default '',
	PRIMARY KEY (id)
)";
mysql_query($sql) or die(mysql_error());

$sql = "
CREATE TABLE IF NOT EXISTS posts_full (
	id int(4) NOT NULL auto_increment,
	full_ua text NOT NULL default '',
	full_ru text NOT NULL default '',
	full_en text NOT NULL default '',
	PRIMARY KEY (id)
)";
mysql_query($sql) or die(mysql_error());

class SQL{
	public $sql;
	public $v;
	public $role;
	public $datam = array();
	public $msg;
function reg($email,$login, $pass){
		$pass = md5($pass);
		$this->sql = "INSERT INTO users (email, login, pass) VALUES ('$email', '$login','$pass')";
		if(mysql_query($this->sql)){
				return true;
			}
			else{
				return false;
			}
	}
function log($login, $pass){
		$pass = md5($pass);
		$this->sql = "SELECT role FROM users WHERE login = '$login' and pass = '$pass'";
		$this->v = mysql_fetch_object(mysql_query($this->sql)); 
		if($this->v->role){
				return $this->v->role;
			}
			else{
				return false;
			}
			
	}
function addnews($titles, $shorttext, $fulltext, $lang){
		 $titles = addslashes($titles);
		 $shorttext = addslashes($shorttext);
		 $fulltext = addslashes($fulltext);
		 
		$sqla = array(	"INSERT INTO posts (title_$lang) VALUES ('$titles')",
						"INSERT INTO posts_short (short_$lang) VALUES ('$shorttext')",
						"INSERT INTO posts_full (full_$lang) VALUES ('$fulltext')"
						);
		
		
		foreach($sqla as $f){
			mysql_query($f);
				
		}
		echo $GLOBALS['ins'];
	}
	
function upnews($id, $titles, $shorttext, $fulltext, $lang){
		 $titles = addslashes($titles);
		 $shorttext = addslashes($shorttext);
		 $fulltext = addslashes($fulltext);
		$sqla = array(	"UPDATE posts SET title_$lang = '$titles' WHERE id = $id",
						"UPDATE posts_short SET short_$lang = '$shorttext' WHERE id = $id",
						"UPDATE posts_full SET full_$lang = '$fulltext' WHERE id = $id"
						);

		foreach($sqla as $f){
			mysql_query($f);
				
		}
		echo $GLOBALS['up'];
	}
	
function del($id){
		$sqla = array(	"DELETE FROM posts WHERE id = $id",
						"DELETE FROM posts_short WHERE id = $id",
						"DELETE FROM posts_full WHERE id = $id"
						);

		foreach($sqla as $f){
			mysql_query($f);
				
		}
		echo $GLOBALS['del'].$id;
	}
	
function show($lang){
		$sql = "SELECT 
					posts.id,
					posts.title_$lang,
					posts_short.short_$lang,
					posts_full.full_$lang
				FROM posts
				INNER JOIN posts_short ON posts.id = posts_short.id
				INNER JOIN posts_full ON posts.id = posts_full.id
				LIMIT 0, 15
				";
			$rez = mysql_query($sql) or die(mysql_error());
			while($data = mysql_fetch_row($rez)) {
				$i++;
				$this->datam[$i] = $data;
            }
			return $this->datam;	
		}
function show_news($id,$lang){
		$sql = "SELECT	posts_full.full_$lang 
				FROM posts_full
				WHERE id = $id
				";
		if($rez = mysql_query($sql)){
			$dat = mysql_fetch_assoc($rez);
			return $dat["full_$lang"];
		}
		else{
			return false;
		}
}
}

	



	
		
?>