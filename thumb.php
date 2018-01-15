<?php

$cambasAncho = 150;
$cambasAlto = 75;
$max_an = 320;
$max_al = 270;

if (file_exists($_GET['foto'])) {
    if (!is_dir($_GET['foto'])) {
        $posicion = strrpos($_GET['foto'], '.') + 1;
        $extension = substr($_GET['foto'], $posicion);
        $fuente = '';
        switch (strtolower($extension)) {
            case 'jpeg':
            case 'jpg':
                $fuente = @imagecreatefromjpeg($_GET['foto']);
                 break;
            case 'gif':
                $fuente = @imagecreatefromgif($_GET['foto']);
                break;
            case 'png':
                $fuente = @imagecreatefrompng($_GET['foto']);
                break;
            default:
                break;
        }
    } else {
        $fuente = @imagecreatefromgif('images/nofoto.gif');
    }
} else {
    $fuente = @imagecreatefromgif('images/nofoto.gif');
}

$imgAncho = imagesx($fuente);
$imgAlto = imagesy($fuente);
$x = $imgAncho;
$y = $imgAlto;

if($imgAncho>$max_an || $imgAlto > $max_al) {
    if ($imgAlto >= $imgAncho) {
        $y = $max_al;
        $ratio= $y / $imgAlto;
        $x = $imgAncho * $ratio;
        if ($x > $max_an) {
            $x1 = $max_an;
            $ratio = $x1 / $x;
            $y1 = $y * $ratio;
            $x = $x1;
            $y = $y1;
        }
    } else {
        $x = $max_an;
        $ratio= $x / $imgAncho;
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

$cambas = imagecreatetruecolor($cambasAncho, $cambasAlto);
$fondo = imagecolorallocate($cambas, 255, 255, 255);
imagefill($cambas, 0, 0, $fondo);
$xCambasI = (int) (($cambasAncho - $x) / 2);
$yCambasI=(int) (($cambasAlto - $y) / 2);
$borde = imagecolorallocate($cambas, 255, 255, 255);
imageline($cambas, 0, 0, $cambasAncho - 1, 0, $borde);
imageline($cambas, $cambasAncho - 1, 0, $cambasAncho - 1, $cambasAlto - 1, $borde);
imageline($cambas, 0, $cambasAncho - 1, $cambasAncho - 1, $cambasAlto - 1, $borde);
imageline($cambas, 0, $cambasAncho - 1, 0, 0, $borde);
imagecopyresampled($cambas, $fuente, $xCambasI, $yCambasI, 0, 0, $x, $y, $imgAncho, $imgAlto);
header('Content-type: image/jpeg');
imagejpeg($cambas, '', 100);
