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
        <?php include('metas.php'); ?>
        <meta name="google-site-verification" content="B019cogsoitxoEqGsEp3Fjl-b9MBwlea6EhiMjW6I9Y" />
        <link rel="stylesheet" href="estilos.css" type="text/css">
        <link rel="shortcut icon" href="favicon.gif" >
        <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://www.fotodenuncias.net/rss">
        <script type="text/javascript" src="scripts/swfobject.js"></script>
        <script type="text/javascript" src="scripts/prototype.js"></script>
        <script type="text/javascript">
            function subir_foto_denuncia() {
                var extensiones_permitidas = new Array(".jpg", ".JPG", ".gif", ".GIF", ".JPEG", ".jpeg", ".png", ".PNG");
                var extension = ($('fileUpload').value.substring($('fileUpload').value.lastIndexOf("."))).toLowerCase();
                var permitida = false;
                for (var i=0; i<extensiones_permitidas.length; i++) {
                    if (extensiones_permitidas[i] == extension) {
                        permitida = true; break;
                    }
                }
                if (!permitida) {
                    alert("¡La foto debe ser JPEG, GIF o PNG!");
                    $('fileUpload').value = "";
                } else {
                    $('informacion').innerHTML = '<p style="text-align:center">Subiendo foto. Un momento por favor...</p><p style="text-align:center"><img src="images/ajax-loader.gif"></p>';
                    $('foto_denuncia').submit();
                }
            }

            function mostrar_foto(nombre_fichero) {
                $('esta_es').innerHTML = '<table><tr><td><img src="images/picture.png" /></td><td>Esta es tu foto:</td></tr></table>';
                var url = './ajax/mostrar_foto.php';
                var param = 'nombre_fichero=' + nombre_fichero;
                var ajaxRequest = new Ajax.Request( url,{ method: 'get', parameters: param, asynchronous: true, onComplete: showResponse});
            }

            function showResponse(xmlHttpRequest, responseHeader) {
                $('informacion').innerHTML = '';
                $('resultadoUpload').innerHTML = xmlHttpRequest.responseText;
            }
        </script>
        <style>
            .SI-FILES-STYLIZED label.cabinet {
                width: 150px;
                height: 42px;
                background: url(images/examinar.jpg) 0 0 no-repeat;
                display: block;
                overflow: hidden;
                cursor: pointer;
            }
            .SI-FILES-STYLIZED label.cabinet input.file {
                position: relative;
                height: 100%;
                width: auto;
                opacity: 0;
                -moz-opacity: 0;
                filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0);
            }
        </style>
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
                <?php include("menuPrin.php"); ?>
            </div>

            <div id="contenido">
                <!-- sube tu denuncia -->
                <div id="esta_es"></div>
                <div id="resultadoUpload" style="text-align: left;">
                    <form id="foto_denuncia" method="post" enctype="multipart/form-data" action="ajax/foto_denuncia.php" target="iframeUpload">
                    <div style="text-align: right;">
                        <table width="550"><tr><td width="35%"><img src="images/jpeg.jpg"></td><td width="65%" style="padding-bottom: 8px; font-family:georgia; font-size:32px; color:#999; text-align:left;">Selecciona la foto de lo que quieres denunciar...<br />
                        <label class="cabinet" style="margin-top:5px;">
                            <input style="border:1px solid #999;" id="fileUpload" type="file" class="file" name="fileUpload" onchange="subir_foto_denuncia()" />
                        </label>
                        <script type="text/javascript">
                            SI.Files.stylizeAll();
                        </script>
                        <span id="imagenUpload"></span></td></tr></table>
                    </div>
                    <iframe name="iframeUpload" style="display:none;"></iframe>
                    </form>
                </div>
                <!-- fin de sube tu denuncia -->

                <div id="informacion" style="margin-top: 40px;">
                    <img src="images/info.jpg" alt="info sobre foto denuncias" style="float: left; margin-right:10px;" /> <h2>¿Qué es fotodenuncias.net?</h2><p><b>fotodenuncias.net</b> es un portal para denunciar mediante fotografías aquellos hechos que nos preocupan o que nos molestan y que nadie hace nada por remediar.</p><p>Es una forma de protestar, por ejemplo, sobre el mal estado en el que está nuestra calle, o lo poco cuidado que está nuestro parque. </p><p>Para <strong>añadir una foto-denuncia</strong>, simplemente haz click en el botón <strong>"Examinar"</strong> que puedes observar arriba y elije la foto de tu ordenador. A continuación deberás escribir una pequeña descripción del hecho que quieres denunciar, y listo! Haz click en <strong>"Publicar"</strong> y tendrás tu foto añadida.</p>

                    <div style="position: relative; margin-top:50px;">
                        <iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.fotodenuncias.net&amp;layout=standard&amp;show_faces=true&amp;width=450&amp;action=like&amp;colorscheme=light&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:80px;" allowTransparency="true"></iframe>
                    </div>

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

                    <div style="margin-top: 20px;">
                        <h2>Estadísticas</h2>
                    </div>
                    <div style="margin-top: 20px;">
                        <table><tr><td><a title="RSS de fotodenuncias.net" href="http://www.fotodenuncias.net/rss/"><img src="images/rss_icon.jpg" /></a></td><td><a title="RSS de fotodenuncias.net" href="http://www.fotodenuncias.net/rss/">RSS de fotodenuncias.net</a></td></tr></table>
                    </div>
                    <div style="margin-top: 20px;">
                        <table><tr><td><img src="images/webIcon.jpg" /></td><td><b><?php echo mysql_num_rows(mysql_query("select * from gente_online")); ?></b> personas on-line en este momento.</td></tr></table>
                    </div>
                    <div style="margin-top: 20px;">
                        <table><tr><td><img src="images/polaroid.jpg" /></td><td><b><?php echo mysql_num_rows(mysql_query("select * from denuncias where activa=1")); ?></b> fotodenuncias publicadas.</td></tr></table>
                    </div>
                    <div style="margin-top: 20px;">
                        <table><tr><td><img src="images/notepad.jpg" /></td><td><b><?php echo mysql_num_rows(mysql_query("select * from comentarios")); ?></b> comentarios escritos.</td></tr></table>
                    </div>
                    <div style="margin-top: 40px;">
                        <h2>Más foto-denuncias:</h2>
                        <?php
                            $sql21 = "select * from denuncias where descripcion<>'' and activa=1 order by id desc limit 30";
                            $ex21 = mysql_query($sql21);
                            while ($row21 = mysql_fetch_object($ex21)) {
                                ?><div style="position: relative; float:left; margin-bottom:10px; width:500px;"><div style="text-align: left;"><a href="foto.php?denuncia=<?php echo $row21->id; ?>&desc=<?php echo formatearNombre($row21->descripcion); ?>"><?php echo stripslashes($row21->descripcion); ?></a></div><div style="font-size: 11px; font-style:italic; color:#aaa; text-align:left;"><?php echo _date($row21->fecha); ?></div></div><?php
                            }
                        ?>
                        <div style="position: relative; float:left; margin-bottom:10px; width:500px;">...</div>
                        <div style="position: relative; float:left; margin-top:20px; width:500px;"><div style="text-align: left;">[ <a style="color: #666;" href="todas.php">Ver todas las foto-denuncias</a> ]</div></div>
                        <div style="clear: both;"><!-- sep --></div>
                    </div>
                </div>
            </div>

            <div style="clear:both"><!-- separador --></div>

            <div id="pie">
                <?php include("include/pie.php"); ?>
            </div>
        </div>
    </body>
</html>
