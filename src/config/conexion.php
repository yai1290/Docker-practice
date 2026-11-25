<?php

// 1. Datos de conexión

$servidor = "db";
$usuario = "root";
$contrasena = "ROOT";
$base_datos = "docker_practice";

// 2. Conectar con MySQL

$conn = mysqli_connect(
    $servidor,
    $usuario,
    $contrasena,
    $base_datos
);

// 3. Comprobar conexión

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// 4. Configurar codificación

mysqli_set_charset($conn, "utf8mb4");

?>