<?php

$servidor = "db";
$usuario = "root";
$contrasena = "ROOT";
$base_datos = "docker_practice";

$conn = mysqli_connect($servidor, $usuario, $contrasena, $base_datos);

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['Nombre'];
    $apellido = $_POST['Apellido'];
    $correo = $_POST['Correo'];
    $telefono = $_POST['Telefono'];
    $direccion = $_POST['Direccion'];
    $ciudad = $_POST['Ciudad'];

     $sql = "INSERT INTO clientes
        (Nombre, Apellido, Correo, Telefono, Direccion, Ciudad) 
        VALUES (?, ?, ?, ?, ?, ?)";

        
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Error al preparar la consulta: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt,"ssssss",
        $nombre,
        $apellido,
        $correo,
        $telefono,
        $direccion,
        $ciudad
    
    );

      if (mysqli_stmt_execute($stmt)) {

        echo "Cliente registrado exitosamente.";

    } else {

        echo "Error al registrar cliente: " . mysqli_stmt_error($stmt);

    }

    mysqli_stmt_close($stmt);


}

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

    <label>Telefono:</label>
    <input type="text" name="Telefono">

    <br><br>

    <label>Direccion:</label>
    <input type="text" name="Direccion">

    <br><br>

    <label>Ciudad:</label>
    <input type="text" name="Ciudad">

    <br><br>

    <button type="submit">Registrar</button>

    </form>
    
</body>

</html>
