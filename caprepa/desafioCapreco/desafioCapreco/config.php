<?php
// Configuración de la base de datos
$db_host     = 'localhost';
$db_name     = 'prestamos';
$db_user     = 'root';
$db_password = '';

try {
    // Crear una conexión PDO
    $db = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);

    // Establecer el modo de error PDO en excepción
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Mostrar mensaje de error si no se puede conectar
    echo "Error de conexión: " . $e->getMessage();
}
?>
