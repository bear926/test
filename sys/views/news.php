<?php
defined('IND') or die('No direct script access.');
if (SQL::show_news(URL::explod(),URL::lang()) === false) {
	$news = new SQL('mysql:host=localhost;dbname=test1', DB_LOGIN, DB_PASSWORD);
	$news->show_all(URL::lang(), $_GET['p']);
	
	if ($_SESSION['role'] === "1") {
		
		foreach ($datam as $v1) {
		?><div id="news">
			 <h3><a href="<?=$v1['0']?>"><?=$v1['3']?></a></h3>
			 <p><?if(Views::cut($v1['5'])){
					$str1 = Views::cut($v1['5']);
					echo $str1 ."...<a href=".$v1['0'].">".$more."</a>";
				}
				else {
					echo $v1['5'];
				}?></p>
			 <p><?=$v1['1']." ". $v1['2']?></p>
			 <p><a href="<?="newz?id=".$v1['0']?>"><?=$redact?></a></p>
			 <p><a href="<?="newz?id=".$v1['0']."&del"?>">Delete!</a></p>
		</div><?php
		}
		$ra = SQL::page('2', URL::lang());
		foreach ($ra as $v){
			echo "<a href='?p=".$v."'>$v</a> ";
		}
	}
	else {
		foreach ($datam as $v1) {
			?><div id="news">
				 <h3><a href="<?=$v1['0']?>"><?=$v1['3']?></a></h3>
					<p><?if(Views::cut($v1['5'])){
						$str1 = Views::cut($v1['5']);
						echo $str1 ."...<a href=".$v1['0'].">".$more."</a>";
					}
					else {
						echo $v1['5'];
					}?></p>
				 <p><?=$v1['1']." ". $v1['2']?></p>
			</div><?php
			}
		$ra = SQL::page('2', URL::lang());
		foreach ($ra as $v){
			echo "<a href='?p=".$v."'>$v</a> ";
		}
	}
}
else {
	echo SQL::show_news(URL::explod(),URL::lang()) ;
	}
		
?>