<?php
defined('IND') or die('No direct script access.');
$newspeg = 2;
if (SQL::show_news($_GET['news'],URL::lang()) === false) {
	$news = new SQL('mysql:host=localhost;dbname=test1', DB_LOGIN, DB_PASSWORD);
	$news->show_all(URL::lang(), $newspeg, $_GET['p']);
	
	if ($_SESSION['role'] === "1" or $_SESSION['role'] === "3") {
		
		foreach ($datam as $v1) {
		if (empty($v1['3'])) {
			continue;
		}
		?><div id="news">
			 <h3><a href="?news=<?=$v1['0']?>"><?=$v1['1']?></a></h3>
			 <p><?if(Views::cut($v1['4'])){
					$str1 = Views::cut($v1['4']);
					echo $str1 ."...<a href='?news=".$v1['0']."'>".$more."</a>";
				}
				else {
					echo $v1['4'];
				}?></p>
			 <p><?="<a href='index.php?user=".$v1['2']."'>".$v1['2']."</a> ". $v1['3']?></p>
			 <p><a href="<?="newz?id=".$v1['0']?>"><?=$redact?></a></p>
			 <p><a href="<?="newz?id=".$v1['0']."&del"?>">Delete!</a></p>
		</div><?php
		}
		
		
	}
	elseif ($_SESSION['role'] === "2") {
		foreach ($datam as $v1) {
		
			?><div id="news">
				 <h3><a href="?news=<?=$v1['0']?>"><?=$v1['1']?></a></h3>
					<p><?if(Views::cut($v1['4'])){
						$str1 = Views::cut($v1['4']);
						echo $str1 ."...<a href='?news=".$v1['0']."'>".$more."</a>";
					}
					else {
						echo $v1['4'];
					}?></p>
					<p><?="<a href='index.php?user=".$v1['2']."'>".$v1['2']."</a> ". $v1['3']?></p>
			</div><?php
			}
		
	}
	else{
		foreach ($datam as $v1) {
		if (empty($v1['3'])) {
			continue;
		}
			?><div id="news">
				 <h3><a href="?news=<?=$v1['0']?>"><?=$v1['1']?></a></h3>
					<p><?if(Views::cut($v1['4'])){
						$str1 = Views::cut($v1['4']);
						echo $str1 ."...<a href='?news=".$v1['0']."'>".$more."</a>";
					}
					else {
						echo $v1['4'];
					}?></p>
					<p><?=$v1['2']." ". $v1['3']?></p>
			</div><?php
			}
	}
$ra = SQL::page($newspeg, URL::lang());
foreach ($ra as $v){
	echo "<a href='?p=".$v."'>$v</a> ";
}
}
elseif($_SESSION['role'] === "1" or $_SESSION['role'] === "3"){
	?>
		<p><a href="<?="newz?id=".$_GET['news']?>"><?=$redact?></a></p>
		<p><a href="<?="newz?id=".$_GET['news']."&del"?>">Delete!</a></p>
	<?
	echo SQL::show_news($_GET['news'],URL::lang()) ;
	if($_SESSION['role'] === '1' or $_SESSION['role'] === '2' or $_SESSION['role'] === '3'){
		require_once VIEWS.'rating.php';
		require_once VIEWS.'comment.php';
		
	}
}
else{
	  echo SQL::show_news($_GET['news'],URL::lang()) ;
		if($_SESSION['role'] === '1' or $_SESSION['role'] === '2' or $_SESSION['role'] === '3'){
			require_once VIEWS.'rating.php';
			require_once VIEWS.'comment.php'; 
		}
}



?>