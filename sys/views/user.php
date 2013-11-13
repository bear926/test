<?php
if(!isset($_GET['user']))
	SQL::user_up($_SESSION['user']);
SQL::user_up($_GET['user']);
?>
	<div>
				<p><img src="http://test1.rpgfun.net/img/<?=$datau['img']?>" /></p>
				<table width="600" border="1">
					<tr>
						<td width="25%">
							EMAIL
						</td>
						<td width="75%">
							<?=$datau['email']?>
						</td>
					</tr>
					<tr>
						<td>
							<?=$log?>
						</td>
						<td>
							<?=$datau['login']?>
						</td>
					</tr>
					<tr>
						<td>
							<?=$name?>
						</td>
						<td>
							<?=$datau['name']?>
						</td>
					</tr>
					<tr>
						<td>
							<?=$lname?>
						</td>
						<td>
							<?=$datau['lastname']?>
						</td>
					</tr>
					<tr>
						<td>
							<?=$treg?>
						</td>
						<td>
							<?=$datau['treg']?>
						</td>
					</tr>
					<tr>
						<td>
							<?=$tlog?>
						</td>
						<td>
							<?=$datau['tlog']?>
						</td>
					</tr>
				</table>
				<br />
	
	</div>
	
	
