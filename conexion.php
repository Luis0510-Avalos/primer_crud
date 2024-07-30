<?php

$servidor = "localhost";
$nameDB = "crud";
$usuario = "root";
$contrasena = "";

try {
    $conexion = new PDO("mysql:host=$servidor; dbname=$nameDB", $usuario, $contrasena);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error) {
    echo "Conexión errónea".$error;
}

?>