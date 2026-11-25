<?php

session_start();

// 1. Conexión a la base de datos

require_once __DIR__ . '/config/conexion.php';

// 2. Recuperar notificación

$mensaje = $_SESSION['mensaje'] ?? '';

unset($_SESSION['mensaje']);

// 3. Consultar clientes

$sql = "SELECT * FROM clientes ORDER BY Id DESC";

$resultado = mysqli_query($conn, $sql);

if (!$resultado) {
    die("Error al consultar clientes: " . mysqli_error($conn));
}

// 4. Calcular total de clientes

$total_clientes = mysqli_num_rows($resultado);

// 5. Configurar título y cargar encabezado

$titulo_pagina = "Gestión de Clientes";

require_once __DIR__ . '/includes/header.php';

?>

<div class="container py-5 contenedor-principal">

    <!-- Encabezado -->

    <div class="encabezado d-flex justify-content-between align-items-center flex-wrap gap-3">

        <div>

            <h1>Gestión de Clientes</h1>

            <p>Administra la información de tus clientes.</p>

        </div>

        <a href="crear.php" class="btn btn-primary">
            Registrar cliente
        </a>

    </div>

    <!-- Notificación -->

    <?php if ($mensaje !== ''): ?>

        <div class="alert alert-success alert-dismissible fade show" role="alert">

            <?php echo htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8'); ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Cerrar">
            </button>

        </div>

    <?php endif; ?>

    <!-- Total de clientes -->

    <div class="tarjeta-estadistica">

        <p class="titulo">Total de clientes</p>

        <p class="cantidad">
            <?php echo $total_clientes; ?>
        </p>

    </div>

    <!-- Tabla de clientes -->

    <div class="contenedor-tabla">

        <h2>Listado de clientes</h2>

        <div class="table-responsive">

            <table class="table table-striped table-hover">

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Ciudad</th>
                        <th>Acciones</th>
                    </tr>

                </thead>

                <tbody>

                    <?php if ($total_clientes > 0): ?>

                        <?php while ($cliente = mysqli_fetch_assoc($resultado)): ?>

                            <tr>

                                <td>
                                    <?php echo $cliente['Id']; ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($cliente['Nombre'], ENT_QUOTES, 'UTF-8'); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($cliente['Apellido'], ENT_QUOTES, 'UTF-8'); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($cliente['Correo'], ENT_QUOTES, 'UTF-8'); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($cliente['Telefono'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($cliente['Direccion'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($cliente['Ciudad'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
                                </td>

                                <td>

                                    <div class="acciones">

                                        <a
                                            href="editar.php?id=<?php echo $cliente['Id']; ?>"
                                            class="btn btn-sm btn-outline-primary">
                                            Editar
                                        </a>

                                        <a
                                            href="eliminar.php?id=<?php echo $cliente['Id']; ?>"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('¿Estás seguro de eliminar este cliente?')">
                                            Eliminar
                                        </a>

                                    </div>

                                </td>

                            </tr>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="8" class="text-center py-4">
                                No hay clientes registrados.
                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php

// 6. Cerrar conexión

mysqli_free_result($resultado);
mysqli_close($conn);

// 7. Cargar pie de página

require_once __DIR__ . '/includes/footer.php';

?>