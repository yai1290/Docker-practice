<?php

session_start();

//* ==========================================*
//* 1. CONEXIÓN A LA BASE DE DATOS
//* ==========================================*

$servidor = "db";
$usuario = "root";
$contrasena = "ROOT";
$base_datos = "docker_practice";

$conn = mysqli_connect($servidor, $usuario, $contrasena, $base_datos);

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");


//* ==========================================*
//* 2. IDENTIFICAR EL MÉTODO HTTP
//* ==========================================*

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //* ======================================*
    //* 3. RECUPERAR LOS DATOS DEL FORMULARIO
    //* ======================================*

    $id = $_POST['Id'];

    $nombre = $_POST['Nombre'];
    $apellido = $_POST['Apellido'];
    $correo = $_POST['Correo'];
    $telefono = $_POST['Telefono'];
    $direccion = $_POST['Direccion'];
    $ciudad = $_POST['Ciudad'];


    //* ======================================*
    //* 4. PREPARAR LA CONSULTA UPDATE
    //* ======================================*

    $sql = "UPDATE clientes
            SET Nombre = ?, Apellido = ?, Correo = ?,
                Telefono = ?, Direccion = ?, Ciudad = ?
            WHERE Id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Error al preparar la consulta: " . mysqli_error($conn));
    }


    //* ======================================*
    //* 5. VINCULAR LOS DATOS
    //* ======================================*

    mysqli_stmt_bind_param(
        $stmt,
        "ssssssi",
        $nombre,
        $apellido,
        $correo,
        $telefono,
        $direccion,
        $ciudad,
        $id
    );


    //* ======================================*
    //* 6. EJECUTAR LA ACTUALIZACIÓN
    //* ======================================*

    if (mysqli_stmt_execute($stmt)) {

        $_SESSION['mensaje'] = "Cliente actualizado correctamente.";

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        header("Location: index.php");
        exit;

    } else {

        die("Error al actualizar: " . mysqli_stmt_error($stmt));

    }


} else {

    //* ======================================*
    //* 7. RECUPERAR EL ID MEDIANTE GET
    //* ======================================*

    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        die("ID de cliente no válido.");
    }

    $id = (int) $_GET['id'];


    //* ======================================*
    //* 8. CONSULTAR EL CLIENTE
    //* ======================================*

    $sql = "SELECT * FROM clientes WHERE Id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Error al preparar la consulta: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "i", $id);

    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);


    //* ======================================*
    //* 9. RECUPERAR EL REGISTRO
    //* ======================================*

    $cliente = mysqli_fetch_assoc($resultado);

    if (!$cliente) {
        die("No se encontró el cliente solicitado.");
    }

    mysqli_stmt_close($stmt);

}

mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar cliente</title>
</head>

<body>

    <h1>Editar información del cliente</h1>

    <form action="editar.php?id=<?php echo $id; ?>" method="POST">

        <input type="hidden" name="Id" value="<?php echo $id; ?>">

        <label>Nombre:</label>
        <input type="text" name="Nombre" value="<?php echo htmlspecialchars($cliente['Nombre']); ?>" required>

        <br><br>

        <label>Apellido:</label>
        <input type="text" name="Apellido" value="<?php echo htmlspecialchars($cliente['Apellido']); ?>" required>

        <br><br>

        <label>Correo:</label>
        <input type="email" name="Correo" value="<?php echo htmlspecialchars($cliente['Correo']); ?>" required>

        <br><br>

        <label>Teléfono:</label>
        <input type="text" name="Telefono" value="<?php echo htmlspecialchars($cliente['Telefono']); ?>">

        <br><br>

        <label>Dirección:</label>
        <input type="text" name="Direccion" value="<?php echo htmlspecialchars($cliente['Direccion']); ?>">

        <br><br>

        <label>Ciudad:</label>
        <input type="text" name="Ciudad" value="<?php echo htmlspecialchars($cliente['Ciudad']); ?>">

        <br><br>

        <button type="submit">Actualizar cliente</button>

    </form>

</body>

</html>
