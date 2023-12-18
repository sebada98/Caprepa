<?php
include_once 'config.php';
include_once 'functions.php';

// Obtén el ID del cliente de la URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Elimina el cliente
    deleteCliente($db, $id);
}

// Redirige al usuario a la página de clientes
header('Location: clientes.php');
exit;
?>