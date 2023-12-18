<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Préstamos</title>
    <!-- Incluye Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php
include_once 'config.php';
include_once 'functions.php';

// Aquí puedes agregar el código para procesar los formularios de agregar, editar y eliminar préstamos
// También puedes agregar el código para procesar el formulario de generar la tabla de amortización

?>
<body>
    <div class="container">
        <h1 class="mt-5">Registro de Préstamos</h1>
        <hr>
        <form action="crear_prestamo.php" method="post">
    <div class="form-group">
        <label for="cliente">Cliente</label>
        <select name="id_cliente" id="cliente" class="form-control" required>
            <option value="">Selecciona un cliente</option>
            <?php
            $clientes = getAllClientes($db);
            foreach ($clientes as $cliente) {
                echo '<option value="' . $cliente['id'] . '">' . $cliente['nombre'] . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="monto">Monto y plazo</label>
        <select name="id_monto" id="monto" class="form-control" required>
            <option value="">Selecciona un monto y plazo</option>
            <option value="1">5000 - 10 quincenas</option>
            <option value="2">10000 - 15 quincenas</option>
            <option value="3">15000 - 20 quincenas</option>
            <option value="4">20000 - 25 quincenas</option>
            <option value="5">25000 - 30 quincenas</option>
            <?php
            $montos = getAllMontos($db);
            foreach ($montos as $monto) {
                echo '<option value="' . $monto['id'] . '">' . $monto['monto'] . ' - ' . $monto['plazo'] . ' quincenas</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="fecha">Fecha del préstamo</label>
        <input type="date" name="fecha" id="fecha" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Agregar préstamo</button>
</form>


        <!-- Muestra la lista de préstamos -->
        <h3>Listado de Préstamos</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Monto</th>
                    <th>Plazo</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $prestamos = getAllPrestamos($db);
                foreach ($prestamos as $prestamo) {
                    // Obtén los datos del cliente y del monto
                    $cliente = getClienteById($db, $prestamo['id_cliente']);
                    $monto = getMontoById($db, $prestamo['id_monto']);
                ?>
                <tr>
                    <td><?php echo $prestamo['id']; ?></td>
                    <td><?php echo $cliente['nombre']; ?></td>
                    <td><?php echo $monto['monto']; ?></td>
                    <td><?php echo $monto['plazo']; ?></td>
                    <td><?php echo $prestamo['fecha']; ?></td>
                    <td>
                        <!-- Botón para editar el préstamo -->
            <a href="editar_prestamo.php?id=<?php echo $prestamo['id']; ?>" class="btn btn-warning">Editar</a>
            
            <!-- Botón para eliminar el préstamo -->
            <a href="eliminar_prestamo.php?id=<?php echo $prestamo['id']; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este préstamo?');">Eliminar</a>
            
            <!-- Botón para generar la tabla de amortización -->
            <a href="tabla_amortizacion.php?id=<?php echo $prestamo['id']; ?>" class="btn btn-info">Tabla de Amortización</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- Incluye Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
