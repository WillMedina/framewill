<?php
spl_autoload_register(function($clase) {
    include 'model/' . $clase . '.php';
});
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>Testing framewill</title>
    </head>
    <body>
        <h1>Testing framewill</h1>
        <?php
        $c = new conexion();
        $eo = new example_object(1);
        var_dump($eo);
        ?>
    </body>
</html>
