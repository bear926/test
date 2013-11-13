<?php
defined('IND') or die('No direct script access.');
class IMG {
	const DB_HOST = 'localhost';
	const DB_LOGIN = "root1";
	const DB_PASSWORD = "password";
	const DB_NAME = 'test1';
	function load_img($name, $tmp_name, $type){
		if($type{0}=='i'){
			$uploaddir = 'img/';
			$uploadfile = $uploaddir . basename($name);
			$user = $_SESSION['user'];
			if (is_uploaded_file($tmp_name)){
				if (move_uploaded_file($tmp_name, $uploadfile)) {
					$size = getimagesize($uploadfile);
					if ($size['0'] > 150 or $size['1'] > 150 or $size['mime']{0} !='i'){
						echo "Image must be maximum 150x150";
					}
					else{
						$PDO = new PDO("mysql:host=localhost;dbname=".self::DB_NAME."", self::DB_LOGIN, self::DB_PASSWORD);
						$sql = "UPDATE users SET 
						img  = '$name'
						WHERE login = '$user'";
						$PDO->query($sql);
						header("Location: ".$_SERVER['REQUEST_URI']);
					}
				} else {
						echo "Error download";
				}
			}
	  }
		else {
			echo "File must be image!";
		}
	}
}
	
?>