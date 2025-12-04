<?php

$servername = "localhost";
$username = "root";       
$password = "contraseña_segura";           

$dbname = "mini_market_bd"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Fallo la conexión a la base de datos: " . $conn->connect_error);
}

$conn->set_charset("utf8");

if (!function_exists('close_db_connection')) {
    function close_db_connection($connection) {
        if ($connection && $connection instanceof mysqli) {
            $connection->close();
        }
    }
}
?>
