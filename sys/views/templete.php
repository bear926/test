<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="/css/style.css">
<title><?=$_SERVER['HTTP_HOST']?></title>
</head>

<body>

<div id="main"> <!-- main -->
	<div id="top"><!-- top -->
    	
        <a href="index.php">
        	<div id="logo">myBlog</div></a>
        
       
        <ul class="lang">
            <li><a href="http://test1.rpgfun.net/ua/">UA</a></li>
            <li><a href="http://test1.rpgfun.net/ru/">RU</a></li>
            <li><a href="http://test1.rpgfun.net/en/">EN</a></li>
       	</ul>
        
    	<ul class="top-ul">
            <li><a href="index.php"><?=$gol?></a></li>
            <li><a href="#"><?=$new?></a></li>
            <li><a href="#"><?=$in?></a></li>
            <li> <a href="#"><?=$av?></a></li>
            <li><a href="#"><?=$kon?></a></li>
        </ul>
    </div><!-- end top -->
    
	  <div id="content"> <!-- content -->
		
	<?php 
	foreach($content->asc as $val){
		require_once $val;
	}
	?>   
	  </div><!-- end content -->
  <div style="height: 52px;"></div>
</div><!-- end main -->
<div id="footer">
	<div style="color:#CCC; margin-top:10px; margin-left: 420px;">&copy; <?=$_SERVER['HTTP_HOST']?></div>
</div>

</body>
</html>
