<?php
defined('IND') or die('No direct script access.');
if(($_SESSION['role']=== "1" or $_SESSION['role']==="3") and isset($_GET['id'])){
	if(isset($_GET['del'])){
		SQL::del($_GET['id'],URL::lang());
	}
	
	SQL::showup(URL::lang(),$_GET['id']);
  if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_POST['submitup'])){
		if(SQL::upnews($_GET['id'], $_POST['title'], $_POST['fulltext'],URL::lang())) {
			echo "Update ok";
		}
	}
	?>
	
<form name="form1" method="post" action="">
	<p>
	   <label><?=$namar?> <br />
		 <input value="<?=$datamup['0']['title']?>" type="text" name="title" id="title" size="60">
		 </label>
	</p>
	<p><?=$fulln?> <br />
	   <textarea name="fulltext" cols="70" rows="15"> <?=$datamup['0']['text']?></textarea>
	</p>   	
		<p>
		  <label>
	   <input type="submit" name="submitup" id="submit" value="Зберегти">
	   </label>
	 </p>
</form>

	

	<?php
	
}

if(($_SESSION['role']=== "1" or $_SESSION['role']==="3") and !isset($_GET['id'])){
	if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_POST['submit'])){
		$title = array('en'=> $_POST['title_en'],
									'ru' => $_POST['title_ru'],
									'ua' => $_POST['title_ua']);
		$text = array('en'=> $_POST['text_en'],
									'ru' => $_POST['text_ru'],
									'ua' => $_POST['text_ua']);
		$lang = array('en','ru','ua');
		
		SQL::addnews($title, $text, $lang);
	}
?>

	<h3>ENGLISH</h3>
<form name="form1" method="post" action="">
	<p>
	   <label><?=$namar?> <br />
		 <input value="" type="text" name="title_en"  size="60">
		 </label>
	</p>
	<p><?=$fulln?> <br />
	   <textarea name="text_en" cols="70" rows="15"></textarea>
	</p>   	
	
	
	<h3>RUSSIAN</h3>

	<p>
	   <label><?=$namar?> <br />
		 <input value="" type="text" name="title_ru"  size="60">
		 </label>
	</p>
	<p><?=$fulln?> <br />
	   <textarea name="text_ru" cols="70" rows="15"></textarea>
	</p>   	

	
	<h3>UKRANIAN</h3>

	<p>
	   <label><?=$namar?> <br />
		 <input value="" type="text" name="title_ua"  size="60">
		 </label>
	</p>
	<p><?=$fulln?> <br />
	   <textarea name="text_ua" cols="70" rows="15"> </textarea>
	</p>   	
		<p>
		 
	   <label>
	   <input type="submit" name="submit" id="submit" value="Зберегти">
	   </label>
	 </p>
</form>
	   <?php
   }
if($_SESSION['role'] == "2" or $_SESSION['role'] == "4" or $_SESSION['role'] == "5" or $_SESSION['role'] == ""){
		echo '<meta http-equiv="refresh" content="0;index.php">';
}

	   
?>