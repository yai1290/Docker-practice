<?php

session_start();

// 1. Conexión a la base de datos

$servidor = "db";
$usuario = "root";
$contrasena = "ROOT";
$base_datos = "docker_practice";

$conn = mysqli_connect($servidor, $usuario, $contrasena, $base_datos);

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");

// 2. Comprobar el método de envío

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // 3. Recuperar los datos

    $nombre = trim($_POST['Nombre'] ?? '');
    $apellido = trim($_POST['Apellido'] ?? '');
    $correo = trim($_POST['Correo'] ?? '');
    $telefono = trim($_POST['Telefono'] ?? '');
    $direccion = trim($_POST['Direccion'] ?? '');
    $ciudad = trim($_POST['Ciudad'] ?? '');

    // 4. Validar campos obligatorios

    if ($nombre === '' || $apellido === '' || $correo === '') {

        die("Error: Nombre, apellido y correo son obligatorios.");

    }

    // 5. Validar correo

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {

        die("Error: El correo electrónico no tiene un formato válido.");

    }

    // 6. Preparar consulta SQL

    $sql = "INSERT INTO clientes
        (Nombre, Apellido, Correo, Telefono, Direccion, Ciudad)
        VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Error al preparar la consulta: " . mysqli_error($conn));
    }

    // 7. Asociar parámetros

    mysqli_stmt_bind_param(
        $stmt,
        "ssssss",
        $nombre,
        $apellido,
        $correo,
        $telefono,
        $direccion,
        $ciudad
    );

    // 8. Ejecutar consulta

    if (mysqli_stmt_execute($stmt)) {

        $_SESSION['mensaje'] = "Cliente registrado correctamente.";

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        header("Location: index.php");
        exit;

    } else {

        $error = mysqli_stmt_error($stmt);

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        die("Error al registrar cliente: " . $error);

    }

}

// 9. Cerrar conexión

mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registrar clientes</title>
</head>

<body>

    <h1>Registrar Clientes</h1>

    <form action="crear.php" method="POST">

        <label>Nombre:</label>
        <input type="text" name="Nombre" required>

        <br><br>

        <label>Apellido:</label>
        <input type="text" name="Apellido" required>

        <br><br>

        <label>Correo:</label>
        <input type="email" name="Correo" required>

        <br><br>

        <label>Teléfono:</label>
        <input type="text" name="Telefono">

        <br><br>

        <label>Dirección:</label>
        <input type="text" name="Direccion">

        <br><br>

        <label>Ciudad:</label>
        <input type="text" name="Ciudad">

        <br><br>

        <button type="submit">Registrar</button>

    </form>

</body>

</html>
