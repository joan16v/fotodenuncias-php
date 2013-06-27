<?php

// -----------------------------------------
// ----- fotodenuncias.net by joan16v ------
// -----------------------------------------

chdir("..");

include('include/application_top.php');

echo '<?xml version="1.0" encoding="utf-8"?>';

echo '<rss version="0.92">
     <channel>
          <docs>http://www.fotodenuncias.net/rss</docs>
          <title>fotodenuncias.net</title>
          <link>http://www.fotodenuncias.net/rss</link>
          <description>fotodenuncias.net - denuncialo con foto, denuncias, fotografias, fotodenuncia social.</description>
          <language>es</language>
          <managingEditor>joan16v@gmail.com (Joan Gimenez Donat)</managingEditor>
          <webMaster>joan16v@gmail.com (Contacto)</webMaster>';

$sql2="select * from denuncias where descripcion<>'' and activa=1 order by id desc";
$ex2=mysql_query($sql2);
while( $row2=mysql_fetch_object($ex2) ) {
	
     echo "<item>";
     echo "<title><![CDATA[ ". utf8_encode( html_entity_decode($row2->descripcion) )." ]]></title>" ;
     echo "<link><![CDATA[ http://www.fotodenuncias.net/foto.php?denuncia=".$row2->id."&desc=".formatearNombre($row2->descripcion)." ]]></link>";
     //echo "<pubDate>".date('D, d M Y H:i:s T',mktime())."</pubDate>";
     echo "<pubDate>".date('D, d M Y H:i:s T',strtotime($row2->fecha))."</pubDate>";
     echo "<description><![CDATA[ <img src=\"http://www.fotodenuncias.net/thumb_big.php?foto=fotos/".$row2->id."/".$row2->foto."\" /> ]]></description>";
     echo "</item>";  	  
  
}          

echo "</channel>";
echo "</rss>";

?>