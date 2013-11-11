<?php
defined('IND') or die('No direct script access.');
if($_SERVER["REQUEST_METHOD"]=="POST")
	$reg = new Registration($_POST['email'],$_POST['login'],$_POST['pass']);
if(!$_SESSION['msg']){
?>
<h1><?=$regi?></h1>
<form action="" method="post">
	
	<div>
		<p><label><?=$log?></label>
        <input name="login" type="text" value="<?=$_POST['login']?>"></p><br />
        <p><label><?=$pas?>&nbsp </label>
        <input name="pass" type="password" value="<?=$_POST['pass']?>"></p><br />
        <p><label>EMAIL</label>
        <input name="email" type="text" value="<?=$_POST['email']?>"></p><br />
		<div>
			<p><img src="http://test1.rpgfun.net/sys/class/noise-picture.php"></p><br />
		</div>
		<label><?=$pic?></label>
		<input type="text" name="str" size="6"><br />
	</div>
	
	<input type="submit" value="OK">
</form>
<?php
}
else{
?>
<meta http-equiv="refresh" content="0;index.php">	
<?php
}
?>