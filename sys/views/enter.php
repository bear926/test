<?php
defined('IND') or die('No direct script access.');
if ($_SERVER["REQUEST_METHOD"]=="POST" and isset($_POST['button'])) {
	$user = new Users($_POST['login'],$_POST['pass']);	
}
if($_SESSION['role']=="5"){
		session_destroy();
		session_start();
		 $_SESSION['msgb'] = "$block <br />";
		}
if (isset($_SESSION['msgn'])) {
		echo $_SESSION['msgn'];
		unset($_SESSION['msgn']);
}
if (isset($_SESSION['msgb'])) {
		echo $_SESSION['msgb'];
		unset($_SESSION['msgb']);
}
if (!$_SESSION['user']) {
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
elseif ($_SESSION['role']!="4") {
	echo "<p>$welcom <a href='index.php?user=".$_SESSION['user']."'>".$_SESSION['user']."</a> <a href='userup'>$userup</a>,  <a href='out'>$out</a>.</p>";
	if ($_SESSION['role']=="1"){
		echo "<br /><a href='userlist'>$userlist</a>,";
	
	}
	if ($_SESSION['role']=="1" or $_SESSION['role']=="3"){
		echo "<p><a href='newz'>$na</a></p> ";
		
	}
}
elseif ($_SESSION['role']=="4"){
	echo "<p>$welcom ".$_SESSION['user'].",  <a href='out'>$out</a>.</p>";
}
else {
	echo $welcom.$_SESSION['user'];
}

?>
