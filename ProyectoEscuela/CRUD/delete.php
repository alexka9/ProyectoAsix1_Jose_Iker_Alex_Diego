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
if (isset($_GET['id_alumno']) && !empty($_GET['id_alumno'])) {
    // Sanitizar el ID del registro para evitar inyección SQL
    $id = filter_var($_GET['id_alumno'], FILTER_SANITIZE_NUMBER_INT);

    if ($id) {
        // Preparar la consulta SQL para borrar el registro con el ID especificado
        $sql = "DELETE FROM tbl_alumnos WHERE id_alumno = :id_alumno";

        try {
            // Preparar y ejecutar la consulta
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id_alumno', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Verificar si se ha borrado alguna fila
            if ($stmt->rowCount() > 0) {
                // Redirigir a la página principal después de borrar el registro
                header('Location: ../CRUD/crudalumn.php');
                exit();
            } else {
                // No se encontró el registro con el ID proporcionado
                echo "Error: No se encontró ningún alumno con el ID especificado.";
            }
        } catch (PDOException $e) {
            // Manejar cualquier error de la base de datos
            echo "Error al intentar borrar el registro: " . $e->getMessage();
        }
    }
}
?>
