<?php
include_once 'config.php';
include_once 'functions.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$cliente = getClienteById($db, $id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : ''; // Añade esta línea
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : ''; // Añade esta línea

    updateCliente($db, $id, $nombre, $apellido, $email, $telefono); // Incluye $email y $telefono aquí

    header('Location: clientes.php');
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Editar Cliente</h1>
        <hr>
        <form action="editar_cliente.php?id=<?php echo $id; ?>" method="post">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($cliente['nombre']); ?>">
            </div>
            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo htmlspecialchars($cliente['apellido']); ?>">
            </div>
            <div class="form-group">
    <label for="email">Correo electrónico:</label>
    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($cliente['email']); ?>">
</div>
<div class="form-group">
    <label for="telefono">Teléfono:</label>
    <input type="tel" class="form-control" id="telefono" name="telefono" required>
    <span id="telefonoError" class="text-danger" style="display:none;">El teléfono no debe tener más de 10 dígitos.</span>
</div>


            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    document.getElementById('telefono').addEventListener('input', function () {
        const telefonoError = document.getElementById('telefonoError');
        if (this.value.length > 10) {
            telefonoError.style.display = 'block';
        } else {
            telefonoError.style.display = 'none';
        }
    });
</script>

</body>
</html>
