<?php
$servidor = "db";
$usuario = "root";
$contrasena = "ROOT";
$base_datos = "docker_practice";

$conn = mysqli_connect($servidor, $usuario, $contrasena, $base_datos);

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

echo "Conexión exitosa a MySQL";

$sql = "SELECT * FROM clientes";

$resultado = mysqli_query($conn, $sql);



// while ($cliente) {
//     echo $cliente['nombre'] . " - ";
//     echo $cliente['correo'] . "<br>";
// }


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de clientes</title>
</head>

<body>



    <h1>Listado de clientes</h1>

    <p>Total de clientes:
        <?php echo mysqli_num_rows($resultado); ?>
    </p>


    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>Ciudad</th>
        </tr>

        <?php
        while ($cliente = mysqli_fetch_assoc($resultado)) {
            ?>

            <tr>


                <td><?php echo htmlspecialchars($cliente['Id'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($cliente['Nombre'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($cliente['Apellido'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($cliente['Correo'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($cliente['Telefono'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($cliente['Direccion'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($cliente['Ciudad'] ?? ''); ?></td>


            </tr>


        <?php } ?>
    </table>

</body>

</html>

<?php
mysqli_close($conn);
?>