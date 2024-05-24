<?php
require_once 'conexion.php';

session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['admin'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: ../formularios/login.php');
    exit;
}

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los campos introducidos por el usuario
    $codi_clase = $_POST['codi_clase'];
    $nombre_clase = $_POST['nombre_clase'];

    // Insertar datos en la base de datos
    $stmt = $conexion->prepare("INSERT INTO tbl_clase (codi_clase, nombre_clase) VALUES (?, ?");
    $stmt->execute([$codi_clase, $nombre_clase]);

    // Redirigir a index.php después de la inserción exitosa
    header('Location: crudclase.php');
    exit(); // Termina el script
}
?>