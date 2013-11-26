	<?
if (isset($_SESSION['role']) ) {
	if (isset($_POST['submitr'])){
		SQL::addrating($_GET['news'], URL::lang(), $_SESSION['user'], $_POST['rating']);
	}
	if ($rez = SQL::chekrating($_GET['news'],URL::lang(), $_SESSION['user'])) {
		if(isset($_GET['delmark'])){
			SQL::delmark($_GET['news'], URL::lang(), $_GET['delmark']);
		}
		$idnews = $_GET['news'];
		echo "<p>You mark ".$rez['mark'].". <a href='?news=$idnews&delmark=".$rez['id']."'>Delete mark.</a></p>";
		$avg = SQL::selectmark($_GET['news'], URL::lang());
		
		if ($avg['avg(mark)'] != NULL) {
			echo "<p>Average rating news ".$avg['avg(mark)'].".</p>";
			if ($_SESSION['role'] === '1') {
				if(isset($_GET['delrat'])){
				 SQL::delrating($idnews, URL::lang());
				}
				echo "<a href='?news=$idnews&delrat'>Delete rating.</a>";
			}
		}
		else {
			echo "<p>No rating in thiss news.</p>";
		}
	}
	else {
		$avg = SQL::selectmark($_GET['news'], URL::lang());
		
		if ($avg['avg(mark)'] != NULL) {
			echo "<p>Average rating news ".$avg['avg(mark)'].".</p>";
		}
		else {
			echo "<p>No rating in thiss news.</p>";
		}
		?>
				
			<form name="form1" method="post" action="">
				
				<p>
					Rate this news:&nbsp;
					<input type="hidden" name="idcom" value="<?=$_GET['news']?>">
					<label>
						<input type="radio" name="rating" value="1" id="rating_0">
						1 &nbsp;</label>
					
					<label>
						<input type="radio" name="rating" value="2" id="rating_1">
						2 &nbsp;</label>
					
					<label>
						<input type="radio" name="rating" value="3" id="rating_2">
						3 &nbsp;</label>
					
					<label>
						<input type="radio" name="rating" value="4" id="rating_3">
						4 &nbsp;</label>
					
					<label>
						<input type="radio" name="rating" value="5" id="rating_4">
						5 &nbsp;</label>
						<input type="submit" name="submitr" id="submitr" value="OK">
					<br>
				</p>
			</form>
<?
	}
	
}
?>