<? 

/*
session_start();

// ------------- Gestion de logs ----------------

$contenido = "";

foreach($_GET as $k => $v) {
        $contenido .= "$k: $v \n";
}

foreach($_POST as $k => $v) {
        $contenido .= "$k: $v \n";
}

// Open file for read and string modification
$fp = fopen("./".date("m-d-y")."-".session_id().".log", "a+");
fwrite($fp, date("g:i:s A")."\n".$contenido);
*/
// ------------- EOS Gestion de logs ----------------

/*
$destino =  "./".basename($_FILES['uploadedfile']['name']);
if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'],$destino)) {
    chmod($destino,0777);
    echo "ok";
} else {
    echo "ko";
}*/

?>
<?php
$target_path  = "./";
$target_path = $target_path . basename( $_FILES['uploadedfile']['name']);
if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
 echo "The file ".  basename( $_FILES['uploadedfile']['name']).
 " has been uploaded";
} else{
 echo "There was an error uploading the file, please try again!";
}
?>