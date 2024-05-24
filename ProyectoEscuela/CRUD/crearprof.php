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
    $nombre_prof = $_POST['nombre_prof'];
    $apellido_prof = $_POST['apellido_prof'];
    $telf_prof = $_POST['telf_prof'];
    $contratacion_prof = $_POST['contratacion_prof'];
    $grado_prof = $_POST['grado_prof'];
    $salario_prof = $_POST['salario_prof'];

    // Insertar datos en la base de datos
    $stmt = $conexion->prepare("INSERT INTO tbl_profesor (nombre_prof, apellido_prof, telf_prof, contratacion_prof, grado_prof, salario_prof) VALUES (?, ?, ?, NOW(), ?, ?)");
    $stmt->execute([$nombre_prof, $apellido_prof, $telf_prof, $contratacion_prof,  $grado_prof, $salario_prof ]);

    // Redirigir a index.php después de la inserción exitosa
    header('Location: crudprof.php');
    exit(); // Termina el script
}
?>
