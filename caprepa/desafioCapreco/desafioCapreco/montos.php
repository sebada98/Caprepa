<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Montos - Sistema de Préstamos</title>
    <!-- Incluye Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php
include_once 'config.php';
include_once 'functions.php';

if (isset($_POST['agregar_monto'])) {
    // Obtener los datos del formulario
    $monto = $_POST['monto'];
    $plazo = $_POST['plazo'];

    // Insertar el nuevo monto y plazo en la base de datos
    createMonto($db, $monto, $plazo);

    // Redirigir a la página de montos
    header('Location: montos.php');
    exit;
}

if (isset($_POST['eliminar_monto'])) {
    // Obtener el ID del monto y plazo
    $id = $_POST['id'];

    // Eliminar el monto y plazo de la base de datos
    deleteMonto($db, $id);

    // Redirigir a la página de montos
    header('Location: montos.php');
    exit;
}


?>
<body>
    <div class="container">
        <h1 class="mt-5">Catálogo de Montos y Plazos</h1>
        <hr>
        <h3>Agregar Monto y Plazo</h3>
<form action="montos.php" method="post">
    <div class="form-group">
        <label for="monto">Monto:</label>
        <input type="number" class="form-control" id="monto" name="monto" step="0.01" required>
    </div>
    <div class="form-group">
        <label for="plazo">Plazo (en quincenas):</label>
        <input type="number" class="form-control" id="plazo" name="plazo" required>
    </div>
    <input type="submit" name="agregar_monto" class="btn btn-primary" value="Agregar Monto y Plazo">
</form>

        
        <h3>Montos y Plazos Registrados</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Monto</th>
                    <th>Plazo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $montos = getAllMontos($db);
                foreach ($montos as $monto) {
                ?>
                <tr>
                    <td><?php echo $monto['id']; ?></td>
                    <td><?php echo $monto['monto']; ?></td>
                    <td><?php echo $monto['plazo']; ?></td>
                    <td>
                    <td>
    <a href="editar_monto.php?id=<?php echo $monto['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
    <form action="montos.php" method="post" class="d-inline">
        <input type="hidden" name="id" value="<?php echo $monto['id']; ?>">
        <input type="submit" name="eliminar_monto" class="btn btn-sm btn-danger" value="Eliminar" onclick="return confirm('¿Está seguro de que desea eliminar este monto y plazo?');">
    </form>
</td>

                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- Incluye Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
