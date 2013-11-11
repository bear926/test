<?php
defined('IND') or die('No direct script access.');
if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_POST['button'])){
	$user = new Users($_POST['login'],$_POST['pass']);	
	}
if(isset($_SESSION['msgn'])){
		echo $_SESSION['msgn'];
		unset($_SESSION['msgn']);
		}
if(!$_SESSION['user'] ){
	if(isset($_SESSION['msg'])){
		echo $_SESSION['msg'];
		session_destroy();
	}

?>
  	<div id="top-content">
    	<form action="<?=$_SERVER['REQUEST_URI']?>" method="post">
			<strong><?=$log?></strong>
			<input name="login" type="text">
			<strong><?=$pas?></strong>
			<input name="pass" type="password">
			<input name="button" type="submit" value="OK">
			<a href="registration"><?=$regi?></a>
        </form>
    </div>

<?php

	}
else{
	echo "$welcom <strong>".$_SESSION['user']."</strong>, <a href='out'>$out</a>.";
	if ($_SESSION['role']=="1"){
		echo "<p><a href='newz'>$na</a></p> ";
		
	}
}

?>
