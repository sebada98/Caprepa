<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Préstamos</title>
    <!-- Incluye Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php
include_once 'config.php';
include_once 'functions.php';
?>
<body>
    <div class="container">
        <h1 class="mt-5">Sistema de Préstamos</h1>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <h3>Catálogo de Clientes</h3>
                <p>Administra el catálogo de clientes en el sistema.</p>
                <a href="clientes.php" class="btn btn-primary">Ir a Clientes</a>
            </div>
            <div class="col-md-4">
                <h3>Catálogo de Montos</h3>
                <p>Administra el catálogo de montos y plazos disponibles para préstamos.</p>
                <a href="montos.php" class="btn btn-primary">Ir a Montos</a>
            </div>
            <div class="col-md-4">
                <h3>Registro de Préstamos</h3>
                <p>Administra y consulta los préstamos realizados a los clientes.</p>
                <a href="prestamos.php" class="btn btn-primary">Ir a Préstamos</a>
            </div>
        </div>
    </div>
    <!-- Incluye Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
