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


$id = $_GET['id'];

echo "El ID del cliente es: " . $id;

$sql = "select * from clientes where Id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt,"i", $id,  
    );
    mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);


if (!$resultado) {
    die("Error al obtener resultado: " . mysqli_stmt_error($stmt));
}

echo "Registros encontrados: " . mysqli_num_rows($resultado);

$cliente = mysqli_fetch_assoc($resultado);

var_dump($cliente);


?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar cliente</title>
</head>

<body>

    <h1>Editar información del cliente</h1>



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

    <button type="submit">Editar Cliente</button>

    </form>

</body>

</html>