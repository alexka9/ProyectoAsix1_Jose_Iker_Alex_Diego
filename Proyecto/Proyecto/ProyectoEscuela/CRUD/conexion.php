<?php
try {
    // Establecer la conexión con la base de datos
    $con = new PDO('mysql:host=localhost', 'root', 'bywalter11');

    // Seleccionar la base de datos escuela
    $con->exec('USE escuela');


    // Ahora puedes ejecutar tus consultas dentro de esta conexión
} catch (PDOException $e) {
    // Manejar errores de conexión
    echo "Error de conexión: " . $e->getMessage();
}

?>
