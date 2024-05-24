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
    $nombre_alumno = $_POST['nombre_alumno'];
    $apellido_alumno = $_POST['apellido_alumno'];
    $telf_alumno = $_POST['telf_alumno'];
    $nacimiento_alumno = $_POST['nacimiento_alumno'];

    // Insertar datos en la base de datos
    $stmt = $conexion->prepare("INSERT INTO tbl_alumnos (nombre_alumno, apellido_alumno, telf_alumno, nacimiento_alumno) VALUES (?, ?, ?, NOW(), ?, ?)");
    $stmt->execute([$nombre_alumno, $apellido_alumno, $telf_alumno, $nacimiento_alumno ]);

    // Redirigir a index.php después de la inserción exitosa
    header('Location: crudalumn.php');
    exit(); // Termina el script
}
?>