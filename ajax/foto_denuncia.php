<?php

chdir("..");

include('include/application_top.php');

//si no tiene extension CSV, nada
$ext=strtolower(substr(($t=strrchr($_FILES['fileUpload']['name'],'.'))!==false?$t:'',1));
if( $ext!="jpg" && $ext!="JPG" && $ext!="png" && $ext!="PNG" && $ext!="gif" && $ext!="GIF" ) { exit(0); }

//procedemos
if( isset( $_FILES['fileUpload']['name'] ) ) {
    
    //comprobación del nombre del fichero subido
    /*
	$img_name = $_FILES['fileUpload']['tmp_name'];
    $nombreOriginal=$_FILES['fileUpload']['name'];
	$new_name = preg_replace("#[^A-z0-9\s\.]#", "X", $_FILES['fileUpload']['name']);
	$new_name=str_replace(" ","",$new_name);
	if (file_exists('fotos/'.$new_name)) {
		$tmp_new_name = $new_name;
		$ext = strtolower(substr(($t=strrchr($new_name,'.'))!==false?$t:'',1));
		$i=1;
	   	while(file_exists('fotos/'.$tmp_new_name)) {
			$tmp_new_name = substr($new_name, 0,strrpos($new_name,"."))."(".$i.").".$ext;
			$i++;
		}
		$new_name = $tmp_new_name;
	} */
    
    /*
    if( move_uploaded_file($_FILES['fileUpload']['tmp_name'],"fotos/".$_SESSION['insert_id']."/{$_FILES['fileUpload']['name']}") ) {
        $equis="si";
    } else {
        $equis="no";
    }
    */
    
	if( $_FILES['fileUpload']['name']!="" ) { 
    //Codigo que cambia el tamaño de las imágenes, las guarda en el servidor (carpeta fotos), y establece permisos 777	
    
            $nombreImagen=$_FILES['fileUpload']['name'];
    
            $exif="";            
            $datos = exif_read_data($_FILES['fileUpload']['tmp_name']);
            foreach($datos as $parametro_exif=>$valor_exif) {
                if(is_array($valor_exif)) {
                    foreach($valor_exif as $k=>$v) {
                        $exif.=$parametro_exif."[".$k."]: ".$v."<br />\n";
                    }
                } else
                    $exif.=$parametro_exif.": ".substr($valor_exif,0,40)."<br />\n";
            }            
    
            //insertar fila en la bbdd
            mysql_query("insert into denuncias (foto,fecha,id_usuario,ip,session_id,exif) values ('".$nombreImagen."',now(),'".$_SESSION['id_usuario']."','".$_SERVER['REMOTE_ADDR']."','".session_id()."','".addslashes($exif)."')");             
            
            $_SESSION['insert_id']=mysql_insert_id();
            
            mkdir("fotos/".$_SESSION['insert_id'],0777);
            chmod("fotos/".$_SESSION['insert_id'],0777);    
			
			$imagen_path="fotos/".$_SESSION['insert_id']."/".$nombreImagen;	
            
            /*		
			$espacio=' ';
			if ( (substr_count($nombreImagen,$espacio))>0 ) {
			  $sin_espacio  = '';
              $nombreImagen = str_replace($espacio, $sin_espacio, $nombreImagen);
			}			
			$enye='ñ';
			if ( (substr_count($nombreImagen,$enye))>0 ) {
			  $sin_enye = 'X';
              $nombreImagen = str_replace($enye, $sin_enye, $nombreImagen);
			}
			if (file_exists($imagen_path)) {
			  $tmp_new_name = $nombreImagen;
			  $ext = strtolower(substr(($t=strrchr($nombreImagen,'.'))!==false?$t:'',1));
			  $i=1;
		   	  while (file_exists("fotos/".$_SESSION['insert_id']."/".$tmp_new_name)) {
				$tmp_new_name = substr($nombreImagen, 0,strrpos($nombreImagen,"."))."(".$i.").".$ext;
				$i++;
			  }
			$nombreImagen = $tmp_new_name;
			}
			$imagen_path="fotos/".$_SESSION['insert_id']."/".$nombreImagen;
            */
            
			$max_width=600;
			$max_height=450;
			$size=GetImageSize($_FILES['fileUpload']['tmp_name']);
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
    
        $src_img = ImageCreateFromJPEG($_FILES['fileUpload']['tmp_name']);
    	$thumb = ImageCreateTrueColor($new_width,$new_height);
    	ImageCopyResampled($thumb, $src_img, 0,0,0,0,($new_width),($new_height),$size[0],$size[1]);
    	ImageJPEG($thumb,$imagen_path);
    	ImageDestroy($src_img);
    	ImageDestroy($thumb);
    	$file="fotos/".$_SESSION['insert_id']."/".$nombreImagen;
        $_SESSION['foto']=$nombreImagen;
        chmod($file,  0777);        
    //fin de codigo de imagen			    
	}	    
    
    //chmod("fotos/".$_SESSION['insert_id']."/{$_FILES['fileUpload']['name']}",0777);
    
    ?><script type="text/javascript">
        //alert('<?php echo $equis; ?>');
        parent.mostrar_foto('<?php echo "fotos/".$_SESSION['insert_id']."/".$nombreImagen; ?>');
    </script><?php    
}

?> 