<?php

// Datos de conexión

$servidor = "db";
$usuario = "root";
$contrasena = "ROOT";
$base_datos = "docker_practice";

// Conectar con MySQL

$conn = mysqli_connect(
    $servidor,
    $usuario,
    $contrasena,
    $base_datos
);

// Comprobar conexión

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Configurar codificación

mysqli_set_charset($conn, "utf8mb4");

?>