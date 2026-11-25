<?php

session_start();

// 1. Conexión a la base de datos

require_once __DIR__ . '/config/conexion.php';

// 2. Comprobar método de envío

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

// 10. Configurar título y cargar encabezado

$titulo_pagina = "Registrar cliente";

require_once __DIR__ . '/includes/header.php';

?>

<div class="container py-5 contenedor-principal">

    <!-- Encabezado -->

    <div class="encabezado mb-4">

        <h1>Registrar cliente</h1>

        <p>Completa los siguientes datos para agregar un nuevo cliente.</p>

    </div>

    <!-- Formulario -->

    <div class="card border-0 shadow-sm formulario-cliente">

        <div class="card-body p-4">

            <form action="crear.php" method="POST">

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
                            placeholder="Ej. Juan"
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
                            placeholder="Ej. Pérez"
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
                            placeholder="ejemplo@correo.com"
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
                            placeholder="Ej. 809-000-0000"
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
                            placeholder="Calle y número"
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
                            placeholder="Ej. Bonao"
                        >

                    </div>

                </div>

                <!-- Botones -->

                <div class="d-flex gap-2 justify-content-end mt-4">

                    <a href="index.php" class="btn btn-outline-secondary">
                        Cancelar
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Registrar cliente
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<?php

require_once __DIR__ . '/includes/footer.php';

?>