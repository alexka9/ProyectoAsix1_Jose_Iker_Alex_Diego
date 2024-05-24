<?php
require_once 'conexion.php';

session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['admin'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: ../formularios/login.php');
    exit;
}

// Verificar si se recibió el ID del alumno por GET
if (!isset($_GET['id_alumno'])) {
    // Redirigir al usuario a otra página o mostrar un mensaje de error
    echo "ID de alumno no proporcionado.";
    exit();
}

// Obtener el ID del alumno de la URL
$id_alumno = $_GET['id_alumno'];

try {
    // Preparar la consulta para obtener los datos del alumno
    $stmt = $con->prepare("SELECT * FROM tbl_alumnos WHERE id_alumno = ?");
    $stmt->bindParam(1, $id_alumno, PDO::PARAM_INT);
    $stmt->execute();
    $alumno = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si se encontró algún registro
    if (!$alumno) {
        echo "No se encontró ningún registro para el ID de alumno proporcionado.";
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Procesar el formulario si se envió por POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validar los datos del formulario
    $errors = [];
    if (empty($_POST['nombre_alumno'])) {
        $errors[] = "El nombre es requerido.";
    }
    if (empty($_POST['apellido_alumno'])) {
        $errors[] = "El apellido es requerido.";
    }
    
    // Si no hay errores, procesa los datos
    if (empty($errors)) {
        // Obtener los datos del formulario
        $nombre_alumno = $_POST['nombre_alumno'];
        $apellido_alumno = $_POST['apellido_alumno'];
        $telf_alumno = $_POST['telf_alumno'];
        $nacimiento_alumno = $_POST['nacimiento_alumno'];

        try {
            // Preparar la consulta para actualizar los datos del alumno
            $stmt = $con->prepare("UPDATE tbl_alumnos SET nombre_alumno = ?, apellido_alumno = ?, telf_alumno = ?, nacimiento_alumno = ? WHERE id_alumno = ?");
            $stmt->bindParam(1, $nombre_alumno, PDO::PARAM_STR);
            $stmt->bindParam(2, $apellido_alumno, PDO::PARAM_STR);
            $stmt->bindParam(3, $telf_alumno, PDO::PARAM_STR);
            $stmt->bindParam(4, $nacimiento_alumno, PDO::PARAM_STR);
            $stmt->bindParam(5, $id_alumno, PDO::PARAM_INT);
            $stmt->execute();

            // Verificar si se realizó la actualización correctamente
            if ($stmt->rowCount() > 0) {
                // Redirigir a la página crudalumn.php después de completar la actualización
                header('Location: crudalumn.php');
                exit();
            } else {
                echo "No se encontró ningún registro para actualizar.";
            }
        } catch (PDOException $e) {
            echo "Error en la transacción: " . $e->getMessage();
        }
    } else {
        // Mostrar mensajes de error
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/form.css">
    <script src="../js/validacionesEditarAlumno.js"></script>
    <title>Editar Registro</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id_alumno=" . $id_alumno; ?>" method="post">
        <a href="../CRUD/crudalumn.php">VOLVER</a>
        <h2>Editar Registro</h2>

        <!-- Campo para editar el nombre -->
        <label for="nombre_alumno">Nombre:</label>
        <input id="nombre_alumno" name="nombre_alumno" type="text" oninput="validaNombreAlum()" value="<?php echo htmlspecialchars($alumno['nombre_alumno']); ?>">
        <p id="error_nombre_alumno"></p>

        <!-- Campo para editar el apellido -->
        <label for="apellido_alumno">Apellido:</label>
        <input id="apellido_alumno" name="apellido_alumno" type="text" oninput="validaApellidoAlum()" value="<?php echo htmlspecialchars($alumno['apellido_alumno']); ?>">
        <p id="error_apellido_alumno"></p>

        <!-- Campo para editar el teléfono -->
        <label for="telf_alumno">Teléfono:</label>
        <input id="telf_alumno" name="telf_alumno" type="text" oninput="validaTelfAlum()" value="<?php echo htmlspecialchars($alumno['telf_alumno']); ?>">
        <p id="error_telf_alumno"></p>

        <!-- Campo para editar la fecha de nacimiento -->
        <label for="nacimiento_alumno">Fecha de Nacimiento:</label>
        <input id="nacimiento_alumno" name="nacimiento_alumno" type="date" oninput="validaNacimientoAlum()" value="<?php echo htmlspecialchars($alumno['nacimiento_alumno']); ?>">
        <p id="error_nacimiento_alumno"></p>

        <!-- Otros campos del formulario -->
        <input type="submit" value="Guardar Cambios">
    </form>
</body>
</html>
