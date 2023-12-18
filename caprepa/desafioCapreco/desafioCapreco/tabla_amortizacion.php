<?php
include_once 'config.php';
include_once 'functions.php';

// Obtén el ID del préstamo de la URL
$id_prestamo = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Obtén la información del préstamo
$prestamo = getPrestamoById($db, $id_prestamo);

// Obtén la información del monto y plazo
$monto = getMontoById($db, $prestamo['id_monto']);

// Calcula la tabla de amortización
$amortizacion = calcularAmortizacion($db, $id_prestamo, $monto['tasa_interes'], $monto['plazo']);

// A continuación, muestra la tabla de amortización en HTML
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Amortización</title>
    <!-- Incluye Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Tabla de Amortización</h1>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No. Pago</th>
                    <th>Fecha</th>
                    <th>Préstamo</th>
                    <th>Interés</th>
                    <th>Abono</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($amortizacion as $fila): ?>
                <tr>
                    <td><?= $fila['no_pago'] ?></td>
                    <td><?= $fila['fecha'] ?></td>
                    <td><?= $fila['prestamo'] ?></td>
                    <td><?= $fila['interes'] ?></td>
                    <td><?= $fila['abono'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="prestamos.php" class="btn btn-primary">Volver a Préstamos</a>
    </div>
    <!-- Incluye Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
