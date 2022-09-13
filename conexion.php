<?php

$contraseña ="";
$usuario ="root";
$nombrebd = "login_def";

try {
    $conn = new PDO(
        'mysql:host=localhost;
        dbname='.$nombrebd,
        $usuario,
        $contraseña,
        array(PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8")
    );
} catch (\Throwable $th) {
    echo "error de conxion".$th->getMessage();
}

?>