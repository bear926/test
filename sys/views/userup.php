<?php
defined('IND') or die('No direct script access.');
if ($_SESSION['role'] === "1" and isset($_GET['userup']) and $_GET['del'] == 'ok') {
	SQL::del_user($_GET['userup']);
}
else {
	if ($_SESSION['role'] === "1" and isset($_GET['userup']) and !isset($_GET['del'])) {
	SQL::user_up($_GET['userup']);
	}
	else{
		SQL::user_up($_SESSION['user']);
	}
	if(isset($_POST['button']) and $_POST['pass'] == $_POST['passr'] and !isset($_GET['userup'])){
	SQL::user_up($_SESSION['user'], $_POST['email'], $_POST['pass'], $_POST['name'], $_POST['lname'], $_POST['radiog']);
	}
	
	if(isset($_POST['button']) and $_POST['pass'] == $_POST['passr'] and isset($_GET['userup'])){
		SQL::user_up($_GET['userup'], $_POST['email'], $_POST['pass'], $_POST['name'], $_POST['lname'], $_POST['radiog']);
	}
	
	
	if ($_SERVER["REQUEST_METHOD"]=="POST" and isset($_POST['filename'])) {
	IMG::load_img($_FILES['filename']['name'], $_FILES['filename']['tmp_name'],$_FILES['filename']['type']);
}

?>
	<div>
			<h4><?=$datau['login']?></h4>
			<img src="http://test1.rpgfun.net/img/<?=$datau['img']?>" />
			<?=$dimg?>
			<form enctype="multipart/form-data" action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
			
				<input type="file" name="filename"   />
				<input type="submit" value="OK" />
			</form>

			
			<form action="<?=$_SERVER['REQUEST_URI']?>" method="post">			
				<table width="600" border="0">
					<tr>
						<td width="25%">
							EMAIL
						</td>
						<td width="75%">
							<input name="email" type="text" value="<?=$datau['email']?>">
						</td>
					</tr>
					<tr>
						<td>
							<label><?=$pas?>&nbsp </label>
						</td>
						<td>
							<input name="pass" type="password" value="">
						</td>
					</tr>
					<tr>
						<td>
							<label><?=$pasr?>&nbsp </label>
						</td>
						<td>
							<input name="passr" type="password" value="">
						</td>
					</tr>
					<tr>
						<td>
							<?=$name?>
						</td>
						<td>
							<input name="name" type="text" value="<?=$datau['name']?>">
						</td>
					</tr>
					<tr>
						<td>
							<?=$lname?>
						</td>
						<td>
							<input name="lname" type="text" value="<?=$datau['lastname']?>">
						</td>
					</tr>
					<?if ($_SESSION['role'] == '1'){?>
					<tr>
						<td>
							Role
						</td>
						<td>
								<p>
								<label>
									<input type="radio" name="radiog" value="1" id="radiog1" <?=($datau['role']=='1') ? 'checked' : '';?>>
									admin</label>
								<br />
								<label>
									<input type="radio" name="radiog" value="2" id="radiog2" <?=($datau['role']=='2') ? 'checked' : '';?>>
									user</label>
								<br />
								<label>
									<input type="radio" name="radiog" value="3" id="radiog3" <?=($datau['role']=='3') ? 'checked' : '';?>>
									editor</label>
								<br />
								<label>
									<input type="radio" name="radiog" value="4" id="radiog4" <?=($datau['role']=='4') ? 'checked' : '';?>>
									anonim</label>
								<br>
								<label>
									<input type="radio" name="radiog" value="5" id="radiog5" <?=($datau['role']=='5') ? 'checked' : '';?>>
									blocked</label>
								<br />
							</p>
							
						</td>
					</tr>
					<?
					}
					?>
				</table>
				<input type="submit" name="button" value="OK">
			</form>
	
	</div>
	
<?
}
?>




	
	
