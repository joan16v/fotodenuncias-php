<?php

chdir("..");

include('include/application_top.php');

//si no viene el nombre del fichero, nada
if( !isset($_GET['nombre_fichero']) ) { exit(0); }

//si el fichero no existe, nada
if( !file_exists($_GET['nombre_fichero']) ) { exit(0); }

?>
<div style="text-align: center;"><img style="border: 5px solid #ccc;" title="denuncia publicada" src="<? echo $_GET['nombre_fichero']; ?>" /></div>
<form action="publicar_denuncia.php" method="post">
    <input type="hidden" name="id" value="<? echo $_SESSION['insert_id']; ?>" />
    <div style="color: #666; font-family:Georgia; margin-top:10px; font-size:14px;">Ya est&aacute; tu foto cargada! Ahora escribe un comentario que la describa y pulsa en Publicar!</div>
    <div><textarea name="descripcion" style="width: 595px; color:#999;" onclick="this.value=''">Escribe tu comentario...</textarea></div>
    <div><input style="width: 600px;" type="submit" value="Publicar" /></div>
</form>