<?php
require_once '../CRUD/conexion.php';

// Inicializar $id_prof en 0 si no se proporciona en el formulario
$id_prof = 0;

// Verificar si se recibe un ID de profesor en el formulario
if (isset($_POST['id_prof'])) {
    $id_prof = $_POST['id_prof'];
}

// Verificar si se reciben los datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los campos introducidos por el usuario
    $nombre_prof = $_POST['nombre_prof'];
    $apellido_prof = $_POST['apellido_prof'];
    $telf_prof = $_POST['telf_prof'];
    $grado_prof = $_POST['grado_prof'];
    $salario_prof = $_POST['salario_prof'];

    try {
        // Preparar la consulta para insertar datos
        $stmt = $con->prepare("INSERT INTO tbl_profesor (id_prof, nombre_prof, apellido_prof, telf_prof, contratacion_prof, grado_prof, salario_prof) VALUES (?, ?, ?, ?, NOW(), ?, ?)");
        $stmt->bindParam(1, $id_prof, PDO::PARAM_INT);
        $stmt->bindParam(2, $nombre_prof, PDO::PARAM_STR);
        $stmt->bindParam(3, $apellido_prof, PDO::PARAM_STR);
        $stmt->bindParam(4, $telf_prof, PDO::PARAM_STR);
        $stmt->bindParam(5, $grado_prof, PDO::PARAM_STR);
        $stmt->bindParam(6, $salario_prof, PDO::PARAM_STR);
        $stmt->execute();

        // Redirigir a la página adecuada después de la inserción
        header('Location: ../CRUD/crudprof.php');
        exit();
    } catch (PDOException $e) {
        echo "Error en la transacción: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/validacionesCrearProf.js"></script>
    <link rel="stylesheet" href="../styles/form.css">

    <title>Crear Profesor</title>
</head>
<body>
<a href="../CRUD/crudprof.php">VOLVER</a>
    <h2>Crear Profesor</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <!-- Campo oculto para el ID del profesor -->
        <input id="id_prof" name="id_prof" type="text" class="form-control" value="<?php echo $id_prof; ?>" readonly>

        <!-- Campo para el nombre del profesor -->
        <label for="nombre_prof">Nombre:</label>
        <input id="nombre_prof" name="nombre_prof" type="text" oninput="validaNombreProfCrear()">
        <p id="error_nombre_prof"></p>

        <!-- Campo para el apellido del profesor -->
        <label for="apellido_prof">Apellido:</label>
        <input id="apellido_prof" name="apellido_prof" type="text" oninput="validaApellidoProfCrear()">
        <p id="error_apellido_prof"></p>

        <!-- Campo para el teléfono del profesor -->
        <label for="telf_prof">Teléfono:</label>
        <input id="telf_prof" name="telf_prof" type="text" oninput="validaTelfProfCrear()">
        <p id="error_telf_prof"></p>

        <!-- Campo para el grado del profesor -->
        <label for="grado_prof">Grado:</label>
        <input id="grado_prof" name="grado_prof" type="text" oninput="validaGradoProfCrear()">
        <p id="error_grado_prof"></p>

        <!-- Campo para el salario del profesor -->
        <label for="salario_prof">Salario:</label>
        <input id="salario_prof" name="salario_prof" type="text" oninput="validaSalarioProfCrear()">
        <p id="error_salario_prof"></p>

        <!-- Campo para la fecha de contratación del profesor -->
        <label for="fecha_contratacion">Fecha de Contratación:</label>
        <input id="fecha_contratacion" name="fecha_contratacion" type="date" oninput="validaContratacionProfCrear()">
        <p id="error_contratacion_prof"></p>

        <!-- Botón de enviar -->
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
