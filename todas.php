<?php

// -----------------------------------------
// ----- fotodenuncias.net by joan16v ------
// -----------------------------------------

include('include/application_top.php');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN" "http://www.w3.org/TR/REC-html40/strict.dtd">
<html>
<head>

<title>foto denuncias, denuncialo con foto, denuncias, fotografias, fotodenuncia social.</title> 

<?php

//inclusion de metatags
include('metas.php');

?>

<meta name="google-site-verification" content="B019cogsoitxoEqGsEp3Fjl-b9MBwlea6EhiMjW6I9Y" />

<link rel="stylesheet" href="estilos.css" type="text/css">
<link rel="shortcut icon" href="favicon.gif" >
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://www.fotodenuncias.net/rss"> 

<script type="text/javascript" src="scripts/swfobject.js"></script>
<script type="text/javascript" src="scripts/prototype.js"></script>

<script type="text/javascript" src="scripts/si.files.js"></script>

</head>

<body>    

<div id="container">
           
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
            
		<div id="menu">        
            <? include("menuPrin.php"); ?>
		</div>
		
		<div id="contenido">
                
                <div style="margin-top: 20px; text-align:center;">
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
                               
                <div style="margin-top: 40px;">
                    <h2>Todas las foto-denuncias:</h2>
                    <?                    
                    $sql21="select * from denuncias where descripcion<>'' and activa=1 order by id desc";
                    $ex21=mysql_query($sql21);
                    while( $row21=mysql_fetch_object($ex21) ) {
                        ?><div style="position: relative; float:left; margin-bottom:10px; width:500px;"><div style="text-align: left;"><a href="foto.php?denuncia=<? echo ($row21->id); ?>&desc=<? echo formatearNombre($row21->descripcion); ?>"><? echo stripslashes($row21->descripcion); ?></a></div><div style="font-size: 11px; font-style:italic; color:#aaa; text-align:left;"><? echo _date($row21->fecha); ?></div></div><?
                    }                    
                    ?>                    
                    <div style="clear: both;"><!-- sep --></div>
                </div>                                           
		
		</div>		
		
		<div style="clear:both"><!-- separador --></div>
		
		<div id="pie">
             <? include("include/pie.php"); ?>
        </div>

</div>

</body>
</html>