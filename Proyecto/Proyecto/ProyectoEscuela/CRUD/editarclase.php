<?php
require_once 'conexion.php';

session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['admin'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: ../formularios/login.php');
    exit;
}

// Verificar si se recibió el ID de la clase por GET
if (!isset($_GET['id_clase'])) {
    // Redirigir al usuario a otra página o mostrar un mensaje de error
    echo "ID de clase no proporcionado.";
    exit();
}

// Obtener el ID de la clase de la URL
$id_clase = $_GET['id_clase'];

try {
    // Preparar la consulta para obtener los datos de la clase
    $stmt = $con->prepare("SELECT * FROM tbl_clase WHERE id_clase = ?");
    $stmt->bindParam(1, $id_clase, PDO::PARAM_INT);
    $stmt->execute();
    $clase = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si se encontró algún registro
    if (!$clase) {
        echo "No se encontró ningún registro para el ID de clase proporcionado.";
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Procesar el formulario si se envió por POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validar los datos del formulario
    $errors = [];
    if (empty($_POST['codi_clase'])) {
        $errors[] = "El código de clase es necesario.";
    }
    if (empty($_POST['nombre_clase'])) {
        $errors[] = "El nombre de clase es necesario.";
    }

    // Si no hay errores, procesa los datos
    if (empty($errors)) {
        // Obtener los datos del formulario
        $codi_clase = $_POST['codi_clase'];
        $nombre_clase = $_POST['nombre_clase'];

        try {
            // Preparar la consulta para actualizar los datos de la clase
            $stmt = $con->prepare("UPDATE tbl_clase SET nombre_clase = ?, codi_clase = ? WHERE id_clase = ?");
            $stmt->bindParam(1, $nombre_clase, PDO::PARAM_STR);
            $stmt->bindParam(2, $codi_clase, PDO::PARAM_INT);
            $stmt->bindParam(3, $id_clase, PDO::PARAM_INT);
            $stmt->execute();

            // Verificar si se realizó la actualización correctamente
            if ($stmt->rowCount() > 0) {
                // Redirigir a la página crudclase.php después de completar la actualización
                header('Location: crudclase.php');
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
    <script src="../js/validacionEditarClase.js"></script>
    <title>Editar Registro</title>
</head>

<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id_clase=" . $id_clase; ?>" method="post"> 
<a href="../CRUD/crudclase.php">VOLVER</a>
<h2>Editar Registro</h2>

        <!-- Campo para editar el Codigo Clase -->
        <label for="codi_clase">Codigo Clase:</label>
        <input id="codi_clase" name="codi_clase" type="number" oninput="validaCodiClase()" value="<?php echo htmlspecialchars($clase['codi_clase']); ?>">
        <p id="error_codi_clase"></p>


        <!-- Campo para editar el nombre -->
        <label for="nombre_clase">Nombre Clase:</label>
        <input id="nombre_clase" name="nombre_clase" type="text" oninput="validaNombreClase()" value="<?php echo htmlspecialchars($clase['nombre_clase']); ?>">
        <p id="error_nombre_clase"></p>

        <input type="submit" value="Guardar Cambios">
    </form>
</body>

</html>