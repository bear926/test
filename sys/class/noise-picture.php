<?php

session_start();
$img = imageCreateFromGIF ("noise.gif");
function znaku($nChars=5){
	$alf = "12345678901234567890QWERTYUIOPASDFGHJKLZXCVBNM";
	for($i = 0; $i < $nChars;$i++){
		$num = rand(0,strlen($alf)-1);
		$znak .= $alf{$num};
	}
	return $znak;
}
	$rez = znaku();


function krapku($img,$nk,$color){

	
	 	for($i=0; $i < $nk; $i++){
			$x = rand(0,200);
			$y = rand(0,50);
			imagesetpixel ($img, $x, $y, $color);
		}
	
}
function color($colors){
	$xz = rand(0,count($colors));
	$color = $colors[$xz];
	return $color;
}


//imageAntiAlias($img, true);
$silver = imageColorAllocate($img, 180, 180, 180);
$black = imageColorAllocate($img, 0, 0, 0);
$red = imageColorAllocate($img, 255, 0, 0);
$green = imageColorAllocate($img, 14, 161, 7);
$blue = imageColorAllocate($img, 0, 0, 255);
$colors = array($black,$red,$green,$blue);

imageFilledRectangle($img, 0, 0, 200, 50, $silver);


krapku($img,500, color($colors));
krapku($img,500, color($colors));
krapku($img,500, color($colors));

$arZ = str_split($rez);
$x = 12;
$y = 40;
foreach($arZ as $s){
	$x += 30;
	$r = -30+rand(0,60);
	imageTtfText($img, 30, $r, $x, $y, color($colors),
	"georgia.ttf", $s);
}
for($i=1; $i<100; $i++){	
	$rx = rand(0,200);
	$ry = rand (0, 50);
	$g = rand (0, 90);
	
	imageArc($img, $rx, $ry, $rx, $ry, 0, $g, color($colors));
	imageLine($img, $rx, $ry, $rx, $ry, color($colors));
}
header( "Content-Type: image/gif" );

imageGif($img,"",90);
$_SESSION['str'] = $rez;

	
?>
