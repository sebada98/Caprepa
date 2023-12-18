<?php
include_once 'config.php';
include_once 'functions.php';

// Obtén el ID del préstamo de la URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Elimina el préstamo
    deletePrestamo($db, $id);
}

// Redirige al usuario a la página de préstamos
header('Location: prestamos.php');
exit;
