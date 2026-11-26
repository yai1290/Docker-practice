<!-- Document HTML,titulo y estilos  -->
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        <?php echo htmlspecialchars($titulo_pagina ?? 'Gestión de Clientes', ENT_QUOTES, 'UTF-8'); ?>
    </title>

    <!-- Bootstrap CSS -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.9/dist/css/bootstrap.min.css"
        rel="stylesheet"
        crossorigin="anonymous"
    >

    <!-- CSS personalizado -->

    <link rel="stylesheet" href="assets/css/estilos.css">

</head>

<body>

