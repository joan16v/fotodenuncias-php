<?

/*
include ('Thumbnail.class.php');
$thumb=new Thumbnail($_GET['foto']);	        // Contructor and set source image file
$thumb->quality=85;                         // [OPTIONAL] default 75 , only for JPG format
$thumb->output_format='JPG';                // [OPTIONAL] JPG | PNG
// Inicio de la marca de agua
//$thumb->img_watermark='imgTemplate/marcaAguaNueveonce.png';	    // [OPTIONAL] set watermark source file, only PNG format [RECOMENDED ONLY WITH GD 2 ]
//$thumb->img_watermark_Valing='BOTTOM';   	    // [OPTIONAL] set watermark vertical position, TOP | CENTER | BOTTON
//$thumb->img_watermark_Haling='RIGHT';   	    // [OPTIONAL] set watermark horizonatal position, LEFT | CENTER | RIGHT
// Fin de la marca de agua
$thumb->size(150,100);		            // [OPTIONAL] set the biggest width and height for thumbnail
$thumb->process();   				        // generate image
$thumb->show();
*/

	$cambasAncho=450;
    $cambasAlto=225;
    $max_an=960;
    $max_al=810;
	if (file_exists($_GET['foto'])){
		if (!is_dir($_GET['foto'])){
			$posicion = strrpos($_GET['foto'],'.')+1;
			$extension =  substr($_GET['foto'],$posicion);
			$fuente ="";
			switch(strtolower($extension)){
				case "jpeg":
				case "jpg":
					$fuente = @imagecreatefromjpeg($_GET['foto']);
					 break;
				case "gif": 
					$fuente = @imagecreatefromgif($_GET['foto']);
					break;
				case "png": 
					$fuente = @imagecreatefrompng($_GET['foto']);
					break;
				default: break;
			
        	}
        }
        else{
			$fuente = @imagecreatefromgif("images/nofoto.gif");
			}
		}else{
			$fuente = @imagecreatefromgif("images/nofoto.gif");
		}
        $imgAncho = imagesx($fuente); 
        $imgAlto = imagesy($fuente);

        $x=$imgAncho;
        $y = $imgAlto;
        if($imgAncho>$max_an || $imgAlto > $max_al){
			if ($imgAlto>=$imgAncho) { // por si la foto es vertical
				$y = $max_al;
				$ratio= $y/$imgAlto;
				$x = $imgAncho*$ratio;
				if ($x>$max_an){
					$x1=$max_an;
					$ratio= $x1/$x;
					$y1 = $y*$ratio;
					$x=$x1;
					$y=$y1;
				}
			} else {
				$x = $max_an;	
				$ratio= $x/$imgAncho;
				$y = $imgAlto*$ratio;
				if ($y>$max_al){
					$y1=$max_al;
					$ratio= $y1/$y;
					$x1 = $x*$ratio;
					$x=$x1;
					$y=$y1;
				}
			}
		}	
		$cambas=imagecreatetruecolor($cambasAncho,$cambasAlto);
		$fondo=imagecolorallocate($cambas,255,255,255);
		
		imagefill($cambas,0,0,$fondo);
		$xCambasI=(int)(($cambasAncho-$x)/2);
		$yCambasI=(int)(($cambasAlto-$y)/2);
		//bordecillo de 1 px en el borde del thumb
		$borde=imagecolorallocate($cambas,255,255,255);
		Imageline($cambas,0,0,$cambasAncho-1,0,$borde);
		Imageline($cambas,$cambasAncho-1,0,$cambasAncho-1,$cambasAlto-1,$borde);
		Imageline($cambas,0,$cambasAncho-1,$cambasAncho-1,$cambasAlto-1,$borde);
		Imageline($cambas,0,$cambasAncho-1,0,0,$borde);
		
       // $imagen = imagecreatetruecolor($x-1,$y-1);
        ImageCopyResampled($cambas,$fuente,$xCambasI,$yCambasI,0,0,$x,$y,$imgAncho,$imgAlto); 
        header("Content-type: image/jpeg"); 
        imageJpeg($cambas,"",100); 

?>