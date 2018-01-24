
<div style="margin-bottom: 20px;">
    <div style="color: #FFAF33;">¿Te gusta fotodenuncias.net? Haz una pequeña donación con <b>Paypal</b> y ayuda a que se mantenga!</div>
    <form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post">
        <input type="hidden" name="cmd" value="_xclick" />
        <input type="hidden" name="business" value="joan16v@gmail.com" />
        <input type="hidden" name="item_name" value="Donacion a fotodenuncias.net" />
        <input type="hidden" name="currency_code" value="EUR" />
        <input type="hidden" name="amount" value="1.00" />
        <input type="image" src="http://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" style="width: 92px; height:26px; border:0px;" border="0" width="92" height="26" name="submit" alt="Make a donation with PayPal" />
    </form>
</div>

<h1 style="text-align: center; color:#5AADD9; font-size:16px; border-bottom:1px solid #ccc; text-shadow: 2px 2px 2px #ADDCF5;">foto denuncias</h1>
<?php

    $sql2 = "select * from denuncias where descripcion<>'' and activa=1 order by rand() limit 8";
    if (isset($_GET['denuncia'])) {
        $desc = mysql_result(mysql_query("select descripcion from denuncias where id='" . $_GET['denuncia'] . "'"), 0, "descripcion");
        $arrayDesc = explode(" ", $desc);
        $sql2 = "select * from denuncias where descripcion<>'' and activa=1 and (descripcion like '%".$arrayDesc[0]."%' or descripcion like '%" . $arrayDesc[1] . "%') order by rand() limit 8";
        if (mysql_numrows(mysql_query($sql2)) < 2) {
            $sql2 = "select * from denuncias where descripcion<>'' and activa=1 order by rand() limit 8";
        }
    }

    $ex2 = mysql_query($sql2);
    $i = 1;
    while ($row2 = mysql_fetch_object($ex2)) {
        ?><div style="position: relative; float:left; width:150px; margin-bottom:10px; <?php if($i != 8) { ?>border-bottom:1px solid #ccc;<?php } ?> padding-bottom:15px;"><div style="text-align: center;"><a style="text-shadow: 2px 2px 2px #ddd;" href="foto.php?denuncia=<?php echo ($row2->id); ?>&desc=<?php echo formatearNombre($row2->descripcion); ?>"><?php

        $name = stripslashes($row2->descripcion);
        if (strlen($name) > 50) {
            echo substr($name, 0, 47) . "...";
        } else {
            echo $name;
        }

        ?></a></div><div style="font-size: 11px; font-style:italic; color:#aaa; text-align:center; margin-bottom:5px;"><?php echo _date($row2->fecha); ?></div><div style="text-align:center"><?php
        ?><a href="foto.php?denuncia=<?php echo $row2->id; ?>&desc=<?php echo formatearNombre($row2->descripcion); ?>"><img style="border: 2px solid #ccc;" src="thumb.php?foto=fotos/<?php echo $row2->id; ?>/<?php echo $row2->foto; ?>" /></a></div></div><?php
        $i++;
    }

?>
<div style="clear: both;"><!-- sep --></div>
