<?php
include_once 'config.php';

// Lista de tablas que deseas reiniciar
$tablas = ['clientes', 'montos', 'prestamos'];

// Elimina todos los registros de las tablas
foreach ($tablas as $tabla) {
    $sql = "DELETE FROM $tabla";
    $db->exec($sql);
}

// Reinicia los valores de AUTO_INCREMENT
foreach ($tablas as $tabla) {
    $sql = "ALTER TABLE $tabla AUTO_INCREMENT = 1";
    $db->exec($sql);
}

// Redirecciona a la página principal
header('Location: index.php');
?>
