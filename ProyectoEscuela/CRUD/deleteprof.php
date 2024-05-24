<?php
// Incluir el archivo de conexión a la base de datos
require_once 'conexion.php';

session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['admin'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: ../formularios/login.php');
    exit;
}

// Verificar si se ha enviado el ID del registro a borrar
if(isset($_GET['ID']) && !empty($_GET['ID'])){
    // Sanitizar el ID del registro para evitar inyección SQL
    $id = filter_var($_GET['ID'], FILTER_SANITIZE_NUMBER_INT);

    // Preparar la consulta SQL para borrar el registro con el ID especificado
    $sql = "DELETE FROM tbl_profesor WHERE id_prof = :id";

    try {
        // Preparar y ejecutar la consulta
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Redirigir a la página principal después de borrar el registro
        header('Location: ../CRUD/crudprof.php');
        exit();
    } catch (PDOException $e) {
        // Manejar cualquier error de la base de datos
        echo "Error al intentar borrar el registro: " . $e->getMessage();
    }
}