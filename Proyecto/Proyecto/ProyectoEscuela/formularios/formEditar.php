<?php
require_once '../CRUD/conexion.php';

// Verificar si se proporciona el ID del alumno en la URL
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

// Comprobar si se recibieron los datos por POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener los datos del formulario utilizando $_POST
    $nombre_alumno = $_POST['nombre_alumno'] ?? $alumno['nombre_alumno'];
    $apellido_alumno = $_POST['apellido_alumno'] ?? $alumno['apellido_alumno'];
    $telf_alumno = $_POST['telf_alumno'] ?? $alumno['telf_alumno'];
    $nacimiento_alumno = $_POST['nacimiento_alumno'] ?? $alumno['nacimiento_alumno'];

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
            echo "Los datos del alumno han sido actualizados correctamente.";
        } else {
            echo "No se realizó ninguna actualización.";
        }
    } catch (PDOException $e) {
        echo "Error en la transacción: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/validacionesEditarAlumno.js"></script>
    <link rel="stylesheet" href="../styles/form.css">

    <title>Editar Alumno</title>
</head>
<body>
    <a href="../CRUD/crudalumn.php">VOLVER</a>
    <h1>Editar Alumno</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <input type="hidden" name="id_alumno" value="<?php echo htmlspecialchars($id_alumno); ?>">
        
        <label for="nombre_alumno">Nombre</label>
        <input id="nombre_alumno" name="nombre_alumno" type="text" oninput="validaNombreAlum()" value="<?php echo htmlspecialchars($alumno['nombre_alumno']); ?>">
        
        <label for="apellido_alumno">Apellido</label>
        <input id="apellido_alumno" name="apellido_alumno" type="text" oninput="validaApellidoAlum()" value="<?php echo htmlspecialchars($alumno['apellido_alumno']); ?>">
        
        <label for="telf_alumno">Teléfono</label>
        <input id="telf_alumno" name="telf_alumno" type="text" oninput="validaTelfAlum()" value="<?php echo htmlspecialchars($alumno['telf_alumno']); ?>">
        
        <label for="nacimiento_alumno">Fecha de nacimiento</label>
        <input id="nacimiento_alumno" name="nacimiento_alumno" type="text" oninput="validaNacimientoAlum()" value="<?php echo htmlspecialchars($alumno['nacimiento_alumno']); ?>">
        
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
    