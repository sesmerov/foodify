<?php

// Incluir la clase DatabaseConnection
require_once 'app/config/configDB.php';
require_once 'app/models/DatabaseConnection.php';

try {
    // Obtener la instancia de la base de datos (singleton)
    $db = DatabaseConnection::getModel();

    // Si llegamos aquí, la conexión fue exitosa
    echo "Conexión exitosa a la base de datos.";

    // Cerrar la conexión
    DatabaseConnection::closeModelo();
} catch (Exception $e) {
    // En caso de que ocurra un error en la conexión, lo capturamos y mostramos
    echo "Error de conexión: " . $e->getMessage();
}

?>
