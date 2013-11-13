<?php
defined('IND') or die('No direct script access.');
if($_SESSION['role']=== "1"){
?>
	<div>
				
				<table width="600" border="1">
					 <tr>
						<td>Login</td>
						<td>Role</td>
						<td>Edit</td>
						<td>Delete</td>
					</tr>
					<?php
					$rez = SQL::show_user();
					foreach($rez as $v){
					?>
					 <tr>
						<td><?=$v['login']?></td>
						<td><?=$v['role']?></td>
						<td><a href="index.php?userup=<?=$v['login']?>">edit</a></td>
						<td><a href="index.php?userup=<?=$v['login']?>&del=ok">delete</a></td>
					</tr>
					<?php
					}
					?>
				</table>
				<br />
	
	</div>
<?php
}
if($_SESSION['role'] != "1"){
		echo '<meta http-equiv="refresh" content="0;index.php">';
}
					?>
	
