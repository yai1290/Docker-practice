<?php

session_start();

// 1. Conexión a la base de datos

require_once __DIR__ . '/config/conexion.php';

// 2. Identificar el método HTTP

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // 3. Recuperar los datos del formulario

    $id = filter_input(INPUT_POST, 'Id', FILTER_VALIDATE_INT);

    if ($id === false || $id === null || $id <= 0) {
        die("ID de cliente no válido.");
    }

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

    // 6. Preparar consulta UPDATE

    $sql = "UPDATE clientes
            SET Nombre = ?, Apellido = ?, Correo = ?,
                Telefono = ?, Direccion = ?, Ciudad = ?
            WHERE Id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Error al preparar la consulta: " . mysqli_error($conn));
    }

    // 7. Vincular los datos

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

    // 8. Ejecutar actualización

    if (mysqli_stmt_execute($stmt)) {

        $_SESSION['mensaje'] = "Cliente actualizado correctamente.";

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        header("Location: index.php");
        exit;

    } else {

        $error = mysqli_stmt_error($stmt);

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        die("Error al actualizar: " . $error);

    }

} else {

    // 9. Recuperar el ID mediante GET

    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if ($id === false || $id === null || $id <= 0) {
        die("ID de cliente no válido.");
    }

    // 10. Consultar el cliente

    $sql = "SELECT * FROM clientes WHERE Id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Error al preparar la consulta: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "i", $id);

    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);

    // 11. Recuperar el registro

    $cliente = mysqli_fetch_assoc($resultado);

    if (!$cliente) {
        die("No se encontró el cliente solicitado.");
    }

    mysqli_stmt_close($stmt);

}

// 12. Cerrar conexión

mysqli_close($conn);

// 13. Configurar título y cargar encabezado

$titulo_pagina = "Editar cliente";

require_once __DIR__ . '/includes/header.php';

?>

<div class="container py-5 contenedor-principal">

    <!-- Encabezado -->

    <div class="encabezado mb-4">

        <h1>Editar cliente</h1>

        <p>Modifica la información del cliente seleccionado.</p>

    </div>

    <!-- Formulario -->

    <div class="card border-0 shadow-sm formulario-cliente">

        <div class="card-body p-4">

            <form
                action="editar.php?id=<?php echo $id; ?>"
                method="POST"
            >

                <!-- ID oculto -->

                <input
                    type="hidden"
                    name="Id"
                    value="<?php echo $id; ?>"
                >

                <div class="row g-3">

                    <div class="col-md-6">

                        <label for="Nombre" class="form-label">
                            Nombre
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="Nombre"
                            name="Nombre"
                            value="<?php echo htmlspecialchars($cliente['Nombre'], ENT_QUOTES, 'UTF-8'); ?>"
                            required
                        >

                    </div>

                    <div class="col-md-6">

                        <label for="Apellido" class="form-label">
                            Apellido
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="Apellido"
                            name="Apellido"
                            value="<?php echo htmlspecialchars($cliente['Apellido'], ENT_QUOTES, 'UTF-8'); ?>"
                            required
                        >

                    </div>

                    <div class="col-md-6">

                        <label for="Correo" class="form-label">
                            Correo electrónico
                        </label>

                        <input
                            type="email"
                            class="form-control"
                            id="Correo"
                            name="Correo"
                            value="<?php echo htmlspecialchars($cliente['Correo'], ENT_QUOTES, 'UTF-8'); ?>"
                            required
                        >

                    </div>

                    <div class="col-md-6">

                        <label for="Telefono" class="form-label">
                            Teléfono
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="Telefono"
                            name="Telefono"
                            value="<?php echo htmlspecialchars($cliente['Telefono'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                        >

                    </div>

                    <div class="col-md-6">

                        <label for="Direccion" class="form-label">
                            Dirección
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="Direccion"
                            name="Direccion"
                            value="<?php echo htmlspecialchars($cliente['Direccion'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                        >

                    </div>

                    <div class="col-md-6">

                        <label for="Ciudad" class="form-label">
                            Ciudad
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="Ciudad"
                            name="Ciudad"
                            value="<?php echo htmlspecialchars($cliente['Ciudad'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                        >

                    </div>

                </div>

                <!-- Botones -->

                <div class="d-flex gap-2 justify-content-end mt-4">

                    <a href="index.php" class="btn btn-outline-secondary">
                        Cancelar
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Guardar cambios
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<?php

require_once __DIR__ . '/includes/footer.php';

?>