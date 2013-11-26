<?php
defined('IND') or die('No direct script access.');
$compeg = 3;
if (isset($_POST['submitc'])) {
	
	if ($_POST['textc']==''){
		echo "<br />You have not entered a comment";
	}
	elseif ($_POST['titlec']=='') {
		$titlec = Views::cut($_POST['textc'], 15);
		SQL::addcomment( $titlec, $_POST['textc'], $_GET['news'], $_SESSION['user'], URL::lang());
	}
	else{
	$titlec = $_POST['titlec'];
	SQL::addcomment( $titlec, $_POST['textc'], $_GET['news'], $_SESSION['user'], URL::lang());
	}
}
SQL::allcomment($_GET['news'],URL::lang(), $compeg, $_GET['cp']);
if (isset($_SESSION['role']) and $_SESSION['role'] != '1') {
	

	foreach($datac as $com){
	?>
		<div id="coment">
			<strong><?=$com['title']?></strong>
			<div>
				<?=$com['text']?>
			</div>
			<p><a href='index.php?user=<?=$com['author']?>'><?=$com['author']?></a> 
					<?=$com['time']?></p>
				
		</div>
	<?
	}
}
else{
	foreach($datac as $com){
		?>
			<div id="coment">
				<strong><?=$com['title']?></strong>
				<div>
					<?=$com['text']?>
				</div>
				<p><a href='index.php?user=<?=$com['author']?>'><?=$com['author']?></a> 
						<?=$com['time']?></p>
				<p><a href='?news=<?=$_GET['news']?>&del=<?=$com['id']?>'>Delete</a> </p>
			</div>
		<?
	}
	if (isset($_GET['del'])){
		SQL::delcom($_GET['news'], $_GET['del']);
	}
}
$pc = SQL::pagecom($compeg, $_GET['news'], URL::lang());
$idnews = $_GET['news'];
	foreach ($pc as $v){
		echo "<a href='?news=$idnews&cp=".$v."'>$v</a> ";
	}
?>
<form name="formc" method="post" action="">
Add coment
	<p>
	   <label><?=$comti?>Title <br />
		 <input value="" type="text" name="titlec" id="title" size="60">
		 </label>
	</p>
	<p><?=$comte?> Text <br />
	   <textarea name="textc" cols="70" rows="15"> </textarea>
	</p>   	
		<p>
		  <label>
	   <input type="submit" name="submitc" id="submitc" value="OK">
	   </label>
	 </p>
</form>
<?

?>
	
