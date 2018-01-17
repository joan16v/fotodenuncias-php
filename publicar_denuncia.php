<?php

include('include/application_top.php');

mysql_query("update denuncias set descripcion='" . strip_tags(addslashes($_POST['descripcion'])) . "', activa=1 where id='" . $_POST['id'] . "'");
$amigable = formatearNombre($_POST['descripcion']);
header("Location: foto.php?denuncia=" . $_POST['id'] . "&desc=" . $amigable);
