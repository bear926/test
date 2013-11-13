<?php
defined('IND') or die('No direct script access.');

$dbh = new PDO('mysql:host=localhost;dbname=test1', DB_LOGIN, DB_PASSWORD);
$dbh->query("CREATE DATABASE IF NOT EXISTS test1 SET utf8 COLLATE utf8_general_ci;");
$dbh->query("CREATE TABLE IF NOT EXISTS users (
	id int(4) NOT NULL auto_increment,
	login varchar(50) NOT NULL default '',
	pass varchar(50) NOT NULL default '',
	email varchar(50) NOT NULL default '',
	treg timestamp NOT NULL,
	tlog timestamp NOT NULL,
	name varchar(15) NOT NULL default '',
	lastname varchar(25) NOT NULL default '',
	role ENUM('1','2','3') NOT NULL default '2',
	PRIMARY KEY (id))");

$dbh->query("CREATE TABLE IF NOT EXISTS posts (
	id int(4) NOT NULL auto_increment,
	author varchar(20) NOT NULL default '',
	time timestamp NOT NULL,
	title_ua varchar(100) NOT NULL default 'Дані відсутні',
	title_ru varchar(100) NOT NULL default 'Нет даних',
	title_en varchar(100) NOT NULL default 'No data',
	PRIMARY KEY (id))");
	
$dbh->query("CREATE TABLE IF NOT EXISTS posts_short (
	id int(4) auto_increment,
	short_ua text  NOT NULL default 'Дані відсутні',
	short_ru text NOT NULL default 'Нет даних',
	short_en text NOT NULL default 'No data',
	INDEX (id),
	FOREIGN KEY (id) REFERENCES posts(id))");
	
$dbh->query("CREATE TABLE IF NOT EXISTS posts_full (
	id int(4) auto_increment,
	full_ua text NOT NULL default 'Дані відсутні',
	full_ru text NOT NULL default 'Нет даних',
	full_en text NOT NULL default 'No data',
	INDEX (id),
	FOREIGN KEY (id) REFERENCES posts(id))");

		
?>