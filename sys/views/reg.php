<?php
//defined('IND') or die('No direct script access.');
if($_SERVER["REQUEST_METHOD"]=="POST")
	$reg = new Registration($_POST['email'],$_POST['login'],$_POST['pass'],$_POST['passr']);
if (isset($_SESSION['msgr'])) {
		echo $_SESSION['msgr'];
		unset($_SESSION['msgr']);
}
if(!$_SESSION['msg']){
?>
<h1><?=$regi?></h1>
<form action="<?=$_SERVER['REQUEST_URI']?>" method="post" id='formreg'>
	
	<div>
						
				<table width="600" border="0">
					<tr>
						<td width="25%">
							<label><?=$log?></label>
						</td>
						<td width="75%">
							<input name="login" type="text" id="loginr" value="<?=$_POST['login']?>">
						</td>
					</tr>
					<tr>
						<td>
							<label><?=$pas?>&nbsp </label>
						</td>
						<td>
							<input name="pass" type="password" id="passr" value="<?=$_POST['pass']?>">
						</td>
					</tr>
					<tr>
						<td>
							<label><?=$pasr?>&nbsp </label>
						</td>
						<td>
							<input name="passr" type="password"  id="passrr" value="<?=$_POST['passr']?>">
						</td>
					</tr>
					<tr>
						<td>
							<label>EMAIL</label>
						</td>
						<td>
							<input name="email" type="text" id="email" value="<?=$_POST['email']?>">
						</td>
					</tr>
				</table>
				<br />
		<div>
			<p><img src="http://test1.rpgfun.net/sys/class/noise-picture.php"></p>
		</div>
		<label><?=$pic?></label>
		<input type="text" name="captha" id="capt" size="6"><br />
	</div>
<input type="submit" id="submitr" value="OK">
</form>
<!-- <script src="http://test1.rpgfun.net/sys/js/valid.js"></script> !-->

<?php
}
else{
?>
<meta http-equiv="refresh" content="0;index.php">	
<?php
}
?>