<?php
include_once 'config.php';
include_once 'functions.php';

// Comprueba si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtén los datos del formulario
    $id_cliente = isset($_POST['id_cliente']) ? intval($_POST['id_cliente']) : 0;
    $id_monto = isset($_POST['id_monto']) ? intval($_POST['id_monto']) : 0;
    $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';

    // Comprueba si los datos son válidos
    if ($id_cliente > 0 && $id_monto > 0 && !empty($fecha)) {
        // Crea el préstamo
        createPrestamo($db, $id_cliente, $id_monto, $fecha);
    }

    // Redirige al usuario a la página de préstamos
    header('Location: prestamos.php');
    exit;
}

// Si no se envió el formulario, redirige al usuario a la página de préstamos
header('Location: prestamos.php');
exit;
