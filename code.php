<?php

$code = $_GET['code'];
$array_codes = array();
$array_codes[] = "-";
$array_codes[] = "*";
$array_codes[] = "+";
$text = str_replace($array_codes, "", base64_decode($code));
$font1 = "MALFUNCT.TTF";
$font2 = "stranger.ttf";
$font_size = 40;
$font_angle = 0;
$startx = -10;
$starty = 32;
$im = imagecreate(45,40);
$white = imagecolorallocate($im, 255, 255, 255);
$blue1 = imagecolorallocate($im, 89, 81, 89);
$blue2 = imagecolorallocate($im, 228, 232, 236);
imagettftext($im, $font_size + 2, $font_angle, $startx, $starty, $blue2, $font2, $text);
imagettftext($im, $font_size, $font_angle, $startx + 15, $starty + 5, $blue1, $font1, $text);
imagecolortransparent($im, $white);
header("Content-type: image/png");
imagepng($im);
imagedestroy($im);
