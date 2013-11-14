<?php
defined('IND') or die('No direct script access.');
if (isset($_POST['submitc'])) {
	if ($_POST['titlec'] =='' or $_POST['textc']==''){
		echo "Fill in all fields";
	}
	else{
	SQL::addcomment( $_POST['titlec'], $_POST['textc'], URL::explod(), $_SESSION['user'], URL::lang());
	}
}
SQL::allcomment(URL::explod(),URL::lang());

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
?>
<form name="formc" method="post" action="">
	<p>
	   <label><?=$comti?> <br />
		 <input value="" type="text" name="titlec" id="title" size="60">
		 </label>
	</p>
	<p><?=$comte?> <br />
	   <textarea name="textc" cols="70" rows="15"> </textarea>
	</p>   	
		<p>
		  <label>
	   <input type="submit" name="submitc" id="submitc" value="OK">
	   </label>
	 </p>
</form>

	
	
