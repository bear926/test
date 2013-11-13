<?php
defined('IND') or die('No direct script access.');
if(($_SESSION['role']=== "1" or $_SESSION['role']==="3") and isset($_GET['id'])){
	if(isset($_GET['del'])){
		SQL::del($_GET['id']);
	}
	
	SQL::showup(URL::lang(),$_GET['id']);
	$n = $datamup['0'];
	if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_POST['submit'])){
		if(SQL::upnews($n['0'], $_POST['title'],$_POST['shorttext'],$_POST['fulltext'],URL::lang()))
			echo "Update ok";
		}
	
	?><form name="form1" method="post" action="">
	<p>
	   <label><?=$namar?> <br />
		 <input value="<?=$n['3']?>" type="text" name="title" id="title" size="60">
		 </label>
	</p>

	
	<p><?=$fulln?> <br />
	   <textarea name="fulltext" cols="70" rows="15"> <?=$n['5']?></textarea>
	   
	</p>   	
		<p>
	   <label>
	   <input type="submit" name="submit" id="submit" value="Зберегти">
	   </label>
	 </p>
	</form><?php
	
}

if($_SESSION['role'] === "1" and !isset($_GET['id'])){
	if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_POST['submit'])){
		
		echo SQL::addnews($_POST['title'],$_POST['shorttext'],$_POST['fulltext'],URL::lang());
	}
?>

<form name="form1" method="post" action="">
        <p>
           <label><?=$namar?> <br />
             <input value="" type="text" name="title" id="title" size="60">
             </label>
        </p>
		
		
        <p><?=$fulln?> <br />
           <textarea name="fulltext" cols="70" rows="15"> </textarea>
		   
		</p>   	
			<p>
           <label>
           <input type="submit" name="submit" id="submit" value="Зберегти">
           </label>
         </p>
       </form>
	   <?php
   }
if($_SESSION['role'] != "1"){
		echo '<meta http-equiv="refresh" content="0;index.php">';
}

	   
?>