<? 

session_start();

chdir("..");

include('./include/application_top.php');

// ------------- Gestion de logs ----------------

$contenido = "";

foreach($_GET as $k => $v) {
        $contenido .= "$k: $v \n";
}

foreach($_POST as $k => $v) {
        $contenido .= "$k: $v \n";
}

// Open file for read and string modification
$fp = fopen("./android/".date("m-d-y")."-".session_id().".log", "a+");
fwrite($fp, date("g:i:s A")."\n".$contenido);

// ------------- EOS Gestion de logs ----------------

if( !isset($_POST['descripcion']) ) {
    fwrite($fp,"no existe post descripcion");    
    exit(0);
}
$descripcion=strip_tags(addslashes(utf8_decode($_POST['descripcion'])));

if( !isset($_POST['nombreImagen']) ) {
    fwrite($fp,"no existe post nombreimagen");    
    exit(0);
}
$nombreImagen=basename($_POST['nombreImagen']);

if( isset($_POST['coordenadas']) ) {
    $coordenadas=$_POST['coordenadas'];
} else {
    $coordenadas="";
}

if( file_exists("./android/".$nombreImagen) ) {
    
    fwrite($fp,"existe la imagen");    
    
    mysql_query("insert into denuncias (descripcion,foto,fecha,id_usuario,ip,session_id,activa,coordenadas) values ('".$descripcion."','".$nombreImagen."',now(),0,'".$_SERVER['REMOTE_ADDR']."','".session_id()."',1,'".$coordenadas."')");          
    
    $_SESSION['insert_id']=mysql_insert_id();
    
    mkdir("./fotos/".$_SESSION['insert_id'],0777);
    chmod("./fotos/".$_SESSION['insert_id'],0777);    
	
	$imagen_path="./fotos/".$_SESSION['insert_id']."/".$nombreImagen;	    
    
	$max_width=600;
	$max_height=450;
	$size=GetImageSize("./android/".$nombreImagen);
    if ( ($size[0]<600) && ($size[1]<450) ) {
           $new_width = $size[0];
           $new_height = $size[1];
    } else {
        if ($size[0]) {
			$width_ratio  = ($size[0] / $max_width);
			$height_ratio = ($size[1] / $max_height);
			if($width_ratio >= $height_ratio) { $ratio = $width_ratio; }
			else { $ratio = $height_ratio; }
			$new_width    = ($size[0] / $ratio);
			$new_height   = ($size[1] / $ratio);
          }
    };    
    
    $src_img = ImageCreateFromJPEG("./android/".$nombreImagen);
	$thumb = ImageCreateTrueColor($new_width,$new_height);
	ImageCopyResampled($thumb, $src_img, 0,0,0,0,($new_width),($new_height),$size[0],$size[1]);
	ImageJPEG($thumb,$imagen_path);
	ImageDestroy($src_img);
	ImageDestroy($thumb);
	$file="./fotos/".$_SESSION['insert_id']."/".$nombreImagen;
    $_SESSION['foto']=$nombreImagen;
    chmod($file,  0777);    
    
    //mail("joan16v@gmail.com","foto-denuncia android publicada","foto-denuncia android publicada");    

	echo $_SESSION['insert_id'];	
    
} else {
    fwrite($fp,"no existe la imagen");
	echo "ko";    
}

?>