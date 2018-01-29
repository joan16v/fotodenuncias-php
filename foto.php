<?php

// -----------------------------------------
// ----- fotodenuncias.net by joan16v ------
// -----------------------------------------

include('include/application_top.php');

if (isset($_GET['denuncia'])) {
    $_GET['denuncia'] = GetSQLValueString($_GET['denuncia'], "int");
}
if (isset($_POST['denuncia'])) {
    $_POST['denuncia'] = GetSQLValueString($_POST['denuncia'], "int");
}

if (isset($_POST['denuncia'])) {
    if ((trim($_POST['comentario']) != "") && ($_POST['suma'] == $_SESSION['suma'])) {        
        if (substr_count($_POST['comentario'], "[url=") == 0) {         
            $insert="insert into comentarios (nick,email,comentario,fecha,id_denuncia,ip) values ('".addslashes(strip_tags($_POST['nick']))."','".addslashes(strip_tags($_POST['email']))."','".addslashes(strip_tags($_POST['comentario']))."',now(),'".addslashes(strip_tags($_POST['denuncia']))."','".$_SERVER['REMOTE_ADDR']."')";
            mysql_query($insert);
        }
    }

    $row = mysql_fetch_object(mysql_query("select * from denuncias where id='" . $_POST['denuncia'] . "'"));
    header("Location: foto.php?denuncia=" . $_POST['denuncia'] . "&desc=" . formatearNombre($row->descripcion));
    exit(0);
}

if( mysql_num_rows(mysql_query("select * from denuncias where id='".$_GET['denuncia']."'"))==0 ) {
    header("Location: index.php");
    exit(0);
}

$row=mysql_fetch_object(mysql_query("select * from denuncias where id='".$_GET['denuncia']."'"));

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN" "http://www.w3.org/TR/REC-html40/strict.dtd">
<html>
<head>

<title><? echo stripslashes($row->descripcion); ?><? if($row->lugar!="") echo " (".$row->lugar.")"; ?> - fotodenuncias.net</title> 

<link rel="shortcut icon" href="icono.ico" />	

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="TITLE" content="<? echo stripslashes($row->descripcion); ?><? if($row->lugar!="") echo " (".$row->lugar.")"; ?> - foto denuncia" />
<meta name="DESCRIPTION" content="<? echo stripslashes($row->descripcion); ?> - foto denuncia" />
<meta name="KEYWORDS" content="<? 

$arr_keywords=explode(" ",stripslashes($row->descripcion));
$arr2=array();
foreach($arr_keywords as $var){
	if($var!="" && strlen($var)>2) $arr2[]=$var;
}

echo implode(",",$arr2); ?>, foto, denuncia" />
<meta name="OWNER" content="joan16v" />
<meta name="AUTHOR" content="joan16v" />
<meta name="RATING" content="joan16v" />

<?php

//inclusion de metatags
//include('metas.php');

?>
<link rel="stylesheet" href="estilos.css" type="text/css" />
<link rel="shortcut icon" href="favicon.gif" />

<script type="text/javascript" src="scripts/swfobject.js"></script>
<script type="text/javascript" src="scripts/prototype.js"></script>

</head>

<body <? if( $row->coordenadas!="" ) { ?>onload="initialize()"<? } ?>>    

<div id="container" style="margin-top: 10px;">    
           
        <div id="logo">
            <a title="pagina principal de foto denuncias" href="index.php"><img src="images/logo_foto_denuncias.net.jpg" alt="logo de foto denuncias" /></a>
        </div>
        
        <div style="position: absolute; top:0px; right:15px; width:90px; height:90px;">
            <img src="/images/iconoFotoDenuncias.png" alt="fotodenuncias app" />
        </div>
        <div style="position: absolute; top:82px; right:19px; width:90px; height:20px; text-align:center;">
            <a target="_blank" href="https://market.android.com/details?id=com.fotodenuncias&feature=search_result#?t=W251bGwsMSwxLDEsImNvbS5mb3RvZGVudW5jaWFzIl0." title="aplicacion fotodenuncias para android" style="font-size: 10px; color:#1882B2; font-family:verdana;"><img src="/images/google_play.png" /></a>            
        </div>    
        <div style="position: absolute; top:117px; right:19px; width:90px; height:20px; text-align:center;">
            <a href="http://itunes.apple.com/es/app/fotodenuncias/id526654188?mt=8" target="_blank" title="fotodenuncias app en la App Store"><img src="/images/app_store.png" /></a>      
        </div>          
		
		<div id="contenido">
		
            <h1 style="text-align: center; border-bottom: 1px solid #ccc; padding-bottom:3px; text-shadow: 2px 2px 2px #ddd;"><? echo stripslashes($row->descripcion); ?><? if($row->lugar!="") echo " (".$row->lugar.")"; ?><br /><span style="font-size: 13px; font-style:italic; color:#aaa;"><? echo _date($row->fecha); ?></span></h1>          
            
                <table width="100%">
                    <tr>
                        <td align="left"><? 
                        
                        $sql2t="select * from denuncias where descripcion<>'' and activa=1 and id<'".$_GET['denuncia']."' order by id desc limit 1";
                        $ex2t=mysql_query($sql2t);
                        if( mysql_num_rows($ex2t)>0 ) {
                            $row2t=mysql_fetch_object($ex2t);                    
                            ?><a style="text-shadow: 2px 2px 2px #ddd;" href="foto.php?denuncia=<? echo ($row2t->id); ?>&desc=<? echo formatearNombre(stripslashes($row2t->descripcion)); ?>">Anterior</a><?
                        }
                        
                        ?></td>
                        <td align="right"><? 
                        
                        $sql2t="select * from denuncias where descripcion<>'' and activa=1 and id>'".$_GET['denuncia']."' order by id asc limit 1";
                        $ex2t=mysql_query($sql2t);      
                        if( mysql_num_rows($ex2t)>0 ) {
                            $row2t=mysql_fetch_object($ex2t);                    
                            ?><a style="text-shadow: 2px 2px 2px #ddd;" href="foto.php?denuncia=<? echo ($row2t->id); ?>&desc=<? echo formatearNombre(stripslashes($row2t->descripcion)); ?>">Siguiente</a><?
                        }             
                        
                        ?></td>
                    </tr>
                </table>  
            
            <div style="text-align: center;">
                <img style="border: 5px solid #ddd; -moz-box-shadow: 1px 1px 5px #585858; -webkit-box-shadow: 1px 1px 5px #585858; box-shadow: 1px 1px 5px #585858;" title="<? echo $row->descripcion; ?>" src="fotos/<? echo $_GET['denuncia']; ?>/<? echo ($row->foto); ?>" />
            </div>            

			<link rel="image_src" href="http://www.fotodenuncias.net/fotos/<? echo $_GET['denuncia']; ?>/<? echo ($row->foto); ?>" />
            
            <div style="text-align: right; margin-top:20px; position:relative;">
            
                <? /* ?>
                <!-- AddThis Button BEGIN -->
                <a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=250&amp;username=xa-4b83e55a5907f100"><img src="http://s7.addthis.com/static/btn/v2/lg-share-en.gif" width="125" height="16" alt="Bookmark and Share" style="border:0"/></a><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4b83e55a5907f100"></script>
                <!-- AddThis Button END -->
                <? */ ?>
                
                <div style="position: absolute; top:0px; right: 120px; width:120px; height:20px;">
                    <iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Ffotodenuncias.net%2Ffoto.php%3Fdenuncia%3D<? echo $_GET['denuncia']; ?>%26desc%3D<? echo formatearNombre($row->descripcion); ?>&amp;layout=button_count&amp;show_faces=false&amp;width=100&amp;action=like&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:110px; height:21px;" allowTransparency="true"></iframe>                    
                </div>                                
                <div style="position: absolute; top:0px; right: 0px; width:100px; height:20px;">
                    <a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-url="http://fotodenuncias.net/foto.php?denuncia=<? echo $_GET['denuncia']; ?>&desc=<? echo formatearNombre($row->descripcion); ?>"  data-lang="es">Tweet</a>
                    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>    
                </div>                
            </div>  
            
            <? 
            
            //MAPA DE GEOLOCALIZACION
            if( $row->coordenadas!="" ) {
        		$cord=$row->coordenadas;
        		$cord=str_replace(",",";",$cord);
                $arrayCoord=explode(";",$cord);
                $lat=trim($arrayCoord[0],",");
                $lon=trim($arrayCoord[1],",");
                if( $row->lugar=="" ) { 
                    $codificacion_geografica_inversa = file_get_contents("http://maps.google.com/maps/geo?q=".$lat.",".$lon); 
                    if( strpos($codificacion_geografica_inversa,"LocalityName")!=FALSE ) {
                        $pos=strpos($codificacion_geografica_inversa,'"LocalityName" : "');
                        $sub=substr($codificacion_geografica_inversa,$pos+18); //echo $sub;
                        $pos2=strpos($sub,'"');
                        $ciudad=substr($sub,0,$pos2);    
                        $mostrarLugar=$ciudad;                                
                    } else {    
                        $ciudad="";    
                        $mostrarLugar=$ciudad;                                                   
                    }            
                    mysql_query("update denuncias set lugar='".$mostrarLugar."' where id='".$_GET['denuncia']."'");         
                } else {
                    $mostrarLugar=$row->lugar;
                }   
                ?>
                <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
                <script type="text/javascript">
                  function initialize() {
                    var myLatlng = new google.maps.LatLng(<? echo $lat; ?>,<? echo $lon; ?>);
                    var myOptions = {
                      zoom: 14,
                      center: myLatlng,
                      mapTypeId: google.maps.MapTypeId.ROADMAP
                    }
                    var map = new google.maps.Map(document.getElementById("mapaLoca"), myOptions);                    
                    var marker = new google.maps.Marker({
                        position: myLatlng, 
                        map: map,
                        title:"<? echo $row->descripcion; ?>"
                    });   
                  }
                </script>                
                <div style="margin-top:60px; position:relative; width:600px; height:300px; border: 5px solid #ddd; -moz-box-shadow: 1px 1px 5px #585858; -webkit-box-shadow: 1px 1px 5px #585858; box-shadow: 1px 1px 5px #585858;" id="mapaLoca">                
                </div><?
            }
            
            ?> 
            
            <div style="position: relative; width:336px; height:280px; padding-top:10px;">
                <script type="text/javascript">
                google_ad_client = "pub-3515563323670978";
                google_ad_width = 336;
                google_ad_height = 280;
                google_ad_format = "336x280_as";
                google_ad_type = "text_image";
                google_color_border = "FFFFFF";
                google_color_bg = "FFFFFF";
                google_color_link = "FFFFFF";
                google_color_text = "4C4C4C";
                google_color_url = "008000";
                google_ui_features = "rc:0";
                </script><script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>       
            </div>                     
            
            <div style="padding-top: 0px;">
                <? if( mysql_num_rows(mysql_query("select * from comentarios where id_denuncia='".$_GET['denuncia']."'"))>0 ) { ?>
                <h2 style="padding-top: 10px; color:#777; text-shadow: 2px 2px 2px #ddd;">Comentarios</h2>
                <? } ?>
                <div>
                    <? 
                    $sqlcom="select * from comentarios where id_denuncia='".$_GET['denuncia']."' order by fecha asc";
                    $excom=mysql_query($sqlcom); $i=1;
                    while( $rowcom=mysql_fetch_object($excom) ) {
                        $nick="anónimo";
                        if( $rowcom->nick!="" ) $nick=$rowcom->nick;
                        if( $rowcom->email!="" ) $nick="<a style=\"color:#333\" href=\"mailto:".$rowcom->email."\">".$nick."</a>";
                        ?><div style="margin-top: 10px;"><span style="font-size: 18px; color:#bbb;">#<?=$i?></span> <? echo stripslashes($rowcom->comentario); ?>&nbsp;&nbsp;&nbsp;<b>@<? echo $nick; ?></b> <span style="color: #ccc;"><? echo $rowcom->fecha; ?></span></div><?
                        $i++;
                    }
                    ?>
                </div>                
                <div style="color: #999; margin-top:40px;">
                    <h2 style="color: #777; text-shadow: 2px 2px 2px #ddd;">Añade tu comentario</h2>
                    <form action="foto.php" id="enviar_comment" method="post">
                        <input type="hidden" name="denuncia" value="<? echo $_GET['denuncia']; ?>" />
                        <div>Tu nombre/nick:<br /><input type="text" name="nick" /></div>
                        <div style="margin-top: 5px;">Tu e-mail:<br /><input type="text" name="email" /></div>
                        <div style="margin-top: 5px;">Comentario:<br /><textarea name="comentario"></textarea></div>
                        <div style="margin-top: 5px;">Escribe el resultado de: <?                        
                            $rand1=rand(1,9);
                            $rand2=rand(1,9);
                            $_SESSION['suma']=$rand1+$rand2;
                            $rand1_show="****+*-+**-----***----*------*".$rand1."++++++-----*****----***-+-+*-+*"; 
                            $rand2_show="+-+*-+-*+-*+*-+--+++--*-+---------****+-".$rand2."+-+-********-+-+*-+--+-**";                                                        
                            //echo $rand1."+".$rand2;                            
                            ?><table><?
                            ?><tr><td><script>document.write('<img src="code.php?code=<? echo base64_encode($rand1_show); ?>&noCache='+ Math.random() +'">');</script></td><?
                            ?><td><span style="font-size: 18px;">+</span></td><?
                            ?><td><script>document.write('<img src="code.php?code=<? echo base64_encode($rand2_show); ?>&noCache='+ Math.random() +'">');</script></td><?
                            ?></tr></table><?                        
                        ?><input type="text" name="suma" /></div>
                        <div style="margin-top: 5px;"><a href="javascript:document.getElementById('enviar_comment').submit();" title="Enviar"><img src="images/enviar_btn.png" /></a></div>
                    </form>
                </div>
            </div>
		
		</div>    
        
		<div id="menu">
            <? include("menu.php"); ?>
		</div>            
       
        <?      
            /*
            $datos = exif_read_data('./fotos/'.$_GET['denuncia'].'/'.$row->foto);
            foreach($datos as $parametro_exif=>$valor_exif) {
                if(is_array($valor_exif)) {
                    foreach($valor_exif as $k=>$v) {
                        echo $parametro_exif."[".$k."]: ".$v."<br />\n";
                    }
                } else
                    echo $parametro_exif.": ".substr($valor_exif,0,40)."<br />\n";
            }
            */
        ?>
		
		<div style="clear:both"><!-- separador --></div>
		
		<div id="pie">
             <? include("include/pie.php"); ?>
        </div>

</div>

</body>
</html>
