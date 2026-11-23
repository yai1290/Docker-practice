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

if (isset($_GET["id"]) || !is_numeric($_get["id"])){
    die("ID de cliente no valido");
}

$id= (int) $_GET["id"]; 

$sql = "DELETE FROM clientes
WHERE Id = 5";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id); 
    
if (mysqli_stmt_execute($stmt)) {

    if (mysqli_stmt_affected_rows($stmt) > 0) {

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

    header("Location: index.php");
    exit;

    } else {

        echo "No se encontró ningún cliente con ese ID.";

    }

} else {

    echo "Error al eliminar: " . mysqli_stmt_error($stmt);

}




?>

