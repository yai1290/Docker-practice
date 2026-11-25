
<?php

session_start();

// 1. Conexión a la base de datos

require_once __DIR__ . '/config/conexion.php';

// 2. Validar el ID recibido por GET

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if ($id === false || $id === null || $id <= 0) {
    die("ID de cliente no válido.");
}

// 3. Preparar consulta DELETE

$sql = "DELETE FROM clientes WHERE Id = ?";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Error al preparar la consulta: " . mysqli_error($conn));
}

// 4. Asociar el ID

mysqli_stmt_bind_param($stmt, "i", $id);

// 5. Ejecutar eliminación

if (mysqli_stmt_execute($stmt)) {

    if (mysqli_stmt_affected_rows($stmt) > 0) {

        $mensaje = "Cliente eliminado correctamente.";

    } else {

        $mensaje = "No se encontró ningún cliente con ese ID.";

    }

} else {

    $mensaje = "Error al eliminar: " . mysqli_stmt_error($stmt);

}

// 6. Cerrar recursos

mysqli_stmt_close($stmt);
mysqli_close($conn);

// 7. Guardar notificación

$_SESSION["mensaje"] = $mensaje;

// 8. Regresar al listado

header("Location: index.php");
exit;

?>