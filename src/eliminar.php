<?php

session_start();

$servidor = "db";
$usuario = "root";
$contrasena = "ROOT";
$base_datos = "docker_practice";

$conn = mysqli_connect($servidor, $usuario, $contrasena, $base_datos);

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if ($id === false || $id === null || $id <= 0) {
    die("ID de cliente no válido.");
}

$sql = "DELETE FROM clientes
WHERE Id = ?";

$stmt = mysqli_prepare($conn, $sql);
if (!$stmt) {
    die("Error al preparar la consulta: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i", $id);    
if (mysqli_stmt_execute($stmt)) {

    if (mysqli_stmt_affected_rows($stmt) > 0) {

    $mensaje = "Cliente eliminado correctamente. ";
    $eliminado = true;

    } else {

        $mensaje = "No se encontró ningún cliente con ese ID.";
        $eliminado = false;
    }

} else {

    $mensaje =  "Error al eliminar: " . mysqli_stmt_error($stmt);

}

mysqli_stmt_close($stmt);
mysqli_close($conn);

$_SESSION["mensaje"] = $mensaje;

header("Location: index.php");
exit;



?>

