<?php
defined('IND') or die('No direct script access.');
if($_SERVER["REQUEST_METHOD"]=="POST")
	$reg = new Registration($_POST['email'],$_POST['login'],$_POST['pass'],$_POST['passr']);
if(!$_SESSION['msg']){
?>
<h1><?=$regi?></h1>
<form action="<?=$_SERVER['REQUEST_URI']?>" method="post">
	
	<div>
						
				<table width="600" border="0">
					<tr>
						<td width="25%">
							<label><?=$log?></label>
						</td>
						<td width="75%">
							<input name="login" type="text" value="<?=$_POST['login']?>">
						</td>
					</tr>
					<tr>
						<td>
							<label><?=$pas?>&nbsp </label>
						</td>
						<td>
							<input name="pass" type="password" value="<?=$_POST['pass']?>">
						</td>
					</tr>
					<tr>
						<td>
							<label><?=$pasr?>&nbsp </label>
						</td>
						<td>
							<input name="passr" type="password" value="<?=$_POST['passr']?>">
						</td>
					</tr>
					<tr>
						<td>
							<label>EMAIL</label>
						</td>
						<td>
							<input name="email" type="text" value="<?=$_POST['email']?>">
						</td>
					</tr>
				</table>
				<br />
		<div>
			<p><img src="http://test1.rpgfun.net/sys/class/noise-picture.php"></p>
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