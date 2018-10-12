<?php 
spl_autoload_register(function($class){
    include 'model/'.$class.'.php';
});

/*Al ser Utils una clase estatica basta con traerla directo desde las funciones*/

//esto hara que se comprima la pagina saliente valiendose de una funcion del utils
ob_start('utils::sanitize_output'); 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Test Utils</title>
    </head>
    <body>
        <?php
            $lorem_ipsum = 'Lorem ipsum dolor sit amet, consectetur '
                    . 'adipiscing elit. Donec tincidunt mattis aliquet. '
                    . 'Quisque vitae congue orci. Nulla rutrum lacus at '
                    . 'porta maximus. Praesent diam orci, gravida nec mi ut, '
                    . 'maximus ultrices velit. In non convallis leo, ut dictum est. '
                    . 'In ornare consectetur arcu non auctor. Etiam placerat blandit '
                    . 'est id facilisis. Curabitur rhoncus dolor nec odio ultrices, '
                    . 'ac eleifend dolor auctor. Pellentesque accumsan magna a felis '
                    . 'ultrices, vel blandit tortor volutpat.';
        ?>
        <h1>Probando utils/h1>
        <?php 
            echo utils::v_dump($lorem_ipsum); //mostrara un var_dump mas amigable y legible
            $mysqltime = date('Y-m-d');
            echo utils::time_MySQLToUnix($mysqltime);
        ?>
    </body>
</html>
