<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>Testing framewill</title>
    </head>
    <body>
        <h1>Testing framewill</h1>
        <?php
        $c = new model\conexion;
        $eo = new model\example_object(1);
        var_dump($eo);
        ?>
    </body>
</html>
