<?php

// CRUD Clientes

// Crear cliente
function createCliente($db, $nombre, $apellido, $email, $telefono) {
    $sql = "INSERT INTO clientes (nombre, apellido, email, telefono) VALUES (:nombre, :apellido, :email, :telefono)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefono', $telefono);

    return $stmt->execute();
}



// Obtener todos los clientes
function getAllClientes($db) {
    $sql = "SELECT * FROM clientes";
    $stmt = $db->query($sql);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Obtener cliente por ID ----
function getClienteById($db, $id) {
    $sql = "SELECT * FROM clientes WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        return false;
    }
}

// Actualizar cliente
function updateCliente($db, $id, $nombre, $apellido, $email, $telefono) {
    $sql = "UPDATE clientes SET nombre = :nombre, apellido = :apellido, email = :email, telefono = :telefono WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefono', $telefono);

    return $stmt->execute();
}


// Eliminar cliente
function deleteCliente($db, $id) {
    $sql = "DELETE FROM clientes WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id);

    return $stmt->execute();
}

// CRUD Montos

// Crear monto
function createMonto($db, $monto, $plazo) {
    $sql = "INSERT INTO montos (monto, plazo) VALUES (:monto, :plazo)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':monto', $monto);
    $stmt->bindParam(':plazo', $plazo);

    return $stmt->execute();
}

// Obtener todos los montos
function getAllMontos($db) {
    $sql = "SELECT * FROM montos";
    $stmt = $db->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Obtener monto por ID
function getMontoById($db, $id) {
    $sql = "SELECT * FROM montos WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        return false;
    }
}

// Actualizar monto
function updateMonto($db, $id, $monto, $plazo) {
    $sql = "UPDATE montos SET monto = :monto, plazo = :plazo WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':monto', $monto);
    $stmt->bindParam(':plazo', $plazo);

    return $stmt->execute();
}

// Eliminar monto
function deleteMonto($db, $id) {
    $sql = "DELETE FROM montos WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id);

    return $stmt->execute();
}

// CRUD Préstamos

// Crear préstamo
function createPrestamo($db, $id_cliente, $id_monto, $fecha) {
    $sql = "INSERT INTO prestamos (id_cliente, id_monto, fecha) VALUES (:id_cliente, :id_monto, :fecha)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id_cliente', $id_cliente);
    $stmt->bindParam(':id_monto', $id_monto);
    $stmt->bindParam(':fecha', $fecha);

    return $stmt->execute();
}

// Obtener todos los préstamos
function getAllPrestamos($db) {
    $sql = "SELECT * FROM prestamos";
    $stmt = $db->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// Obtener préstamo por ID
function getPrestamoById($db, $id) {
    $sql = "SELECT * FROM prestamos WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Actualizar préstamo
function updatePrestamo($db, $id, $id_cliente, $id_monto, $fecha) {
    $sql = "UPDATE prestamos SET id_cliente = :id_cliente, id_monto = :id_monto, fecha = :fecha WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':id_cliente', $id_cliente);
    $stmt->bindParam(':id_monto', $id_monto);
    $stmt->bindParam(':fecha', $fecha);

    return $stmt->execute();
}

// Eliminar préstamo
function deletePrestamo($db, $id) {
    $sql = "DELETE FROM prestamos WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id);

    return $stmt->execute();
}

// Calcular tabla de amortización
function calcularAmortizacion($db, $id_prestamo, $tasa_interes, $plazo) {
    $prestamo = getPrestamoById($db, $id_prestamo);
    $monto = getMontoById($db, $prestamo['id_monto'])['monto'];
    
    $tasa_interes_decimal = $tasa_interes / 100;
    $tasa_quincenal = $tasa_interes_decimal / 24; // Suponiendo que el interés es anual
    $plazo_quincenas = $plazo * 2; // Plazo en quincenas

    $cuota = $monto * (($tasa_quincenal * pow((1 + $tasa_quincenal), $plazo_quincenas)) / (pow((1 + $tasa_quincenal), $plazo_quincenas) - 1));

    $tabla_amortizacion = [];
    $saldo = $monto;

    for ($i = 1; $i <= $plazo_quincenas; $i++) {
        $interes = $saldo * $tasa_quincenal;
        $abono = $cuota - $interes;
        $saldo -= $abono;

        $tabla_amortizacion[] = [
            'no_pago' => $i,
            'fecha' => date('d/m/Y', strtotime("+$i fortnight", strtotime($prestamo['fecha']))),
            'prestamo' => round($abono, 2),
            'interes' => round($interes, 2),
            'abono' => round($cuota, 2),
        ];
    }

    return $tabla_amortizacion;
}

?>
