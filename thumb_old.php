<?php

$fuente = @imagecreatefromjpeg(str_replace(" ", "%20", $_GET['foto']));
if (!$fuente) {
    $fuente = @imagecreatefrompng(str_replace(" ", "%20", $_GET['foto']));
}
if (!$fuente) {
    $fuente = @imagecreatefromjpeg($_GET['foto']);
}
if (!$fuente) {
    $fuente = @imagecreatefromjpeg($_GET['foto']);
}
if (!$fuente) {
    exit(0);
}

$imgAncho = imagesx($fuente);
$imgAlto = imagesy($fuente);
$canvasAncho = 150;
$canvasAlto = 100;
$max_an = 150;
$max_al = 100;
$x = $imgAncho;
$y = $imgAlto;

if ($imgAncho > $max_an || $imgAlto > $max_al) {
    if ($imgAlto >= $imgAncho) {
        $y = $max_al;
        $ratio = $y / $imgAlto;
        $x = $imgAncho * $ratio;
        if ($x > $max_an){
            $x1 = $max_an;
            $ratio = $x1 / $x;
            $y1 = $y * $ratio;
            $x = $x1;
            $y = $y1;
        }
    } else {
        $x = $max_an;
        $ratio = $x / $imgAncho;
        $y = $imgAlto * $ratio;
        if ($y > $max_al) {
            $y1 = $max_al;
            $ratio = $y1 / $y;
            $x1 = $x * $ratio;
            $x = $x1;
            $y = $y1;
        }
    }
}

$canvas = imagecreatetruecolor($canvasAncho, $canvasAlto);
$blanco = imagecolorallocate($canvas, 255, 255, 255);
imagefill($canvas, 0, 0, $blanco);
$xCambasI = (int) (($canvasAncho - $x) / 2);
$yCambasI = (int) (($canvasAlto - $y) / 2);
ImageCopyResampled($canvas, $fuente, $xCambasI, $yCambasI, 0, 0, $x, $y, $imgAncho, $imgAlto);
header("Content-type: image/jpeg");
imageJpeg($canvas, "", 100);
