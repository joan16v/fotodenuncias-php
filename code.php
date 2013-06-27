<?php

//session starting
//session_start();  
//$_SESSION['code'] = rand(10000,99999);	
$code = $_GET['code'];

$array_codes=array(); $array_codes[]="-"; $array_codes[]="*"; $array_codes[]="+";
$text=str_replace($array_codes,"",base64_decode($code));

//$font1 = "max.ttf";
$font1 = "MALFUNCT.TTF";
$font2 = "stranger.ttf";
$font_size = 40;
// angle of the font in degrees
$font_angle = 0;

// the position of the font
$startx = -10;
$starty = 32;

$im = imagecreate(45,40);

// define the colours that we will be using
$white = imagecolorallocate($im, 255, 255, 255);
$blue1 = imagecolorallocate($im, 89, 81, 89);
$blue2 = imagecolorallocate($im, 228, 232, 236);

//imagefilltoborder($im, 0, 0, $blue1, $blue1);

imagettftext($im, $font_size+2, $font_angle, $startx, $starty, $blue2, $font2, $text);
imagettftext($im, $font_size, $font_angle, $startx+15, $starty+5, $blue1, $font1, $text);

 imagecolortransparent($im,$white);
// set the correct HTTP header for a PNG image
header("Content-type: image/png");

imagepng($im);

// remember to free up the memory used on the server to create the image!
imagedestroy($im);

?>