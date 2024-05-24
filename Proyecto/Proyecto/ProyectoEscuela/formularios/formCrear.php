<?php
require_once '../CRUD/conexion.php';

// Verificar si se recibe un ID de alumno en el formulario
// if (isset($_POST['id_alumno'])) {
//     $id_alumno = $_POST['id_alumno'];
// }

// Verificar si se reciben los datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los campos introducidos por el usuario
    $id_alumno = $_POST['id_alumno'];
    $nombre_alumno = $_POST['nombre_alumno'];
    $apellido_alumno = $_POST['apellido_alumno'];
    $telf_alumno = $_POST['telf_alumno'];
    $nacimiento_alumno = $_POST['nacimiento_alumno'];

    try {
        // Preparar la consulta para insertar datos
        $stmt = $con->prepare("INSERT INTO tbl_alumnos (id_alumno, nombre_alumno, apellido_alumno, telf_alumno, nacimiento_alumno) VALUES (?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $id_alumno, PDO::PARAM_INT);
        $stmt->bindParam(2, $nombre_alumno, PDO::PARAM_STR);
        $stmt->bindParam(3, $apellido_alumno, PDO::PARAM_STR);
        $stmt->bindParam(4, $telf_alumno, PDO::PARAM_STR);
        $stmt->bindParam(5, $nacimiento_alumno, PDO::PARAM_STR);
        $stmt->execute();

           // Redirigir a la página adecuada después de la inserción
        header('Location: ../CRUD/crudalumn.php');
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
    <link rel="stylesheet" href="../styles/form.css">
    <script src="../js/validacionesCrearAlumno.js"></script>
    <title>Crear Alumno</title>
</head>
<body>
<a href="../CRUD/crudalumn.php">VOLVER</a>
    <h2>Crear Alumno</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <!-- Campo para el ID del alumno (puede ser un campo oculto si no quieres que el usuario lo vea o lo modifique) -->
        <!-- <input id="id_alumno" name="id_alumno" type="text" class="form-control" value="<?php echo $id_alumno; ?>" readonly> -->

        <!-- Campo para el nombre del alumno -->
        <label for="nombre_alumno">Nombre:</label>
        <input id="nombre_alumno" name="nombre_alumno" type="text" oninput="validaNombreAlum()">
        <p id="error_nombre_alumno"></p>


        <!-- Campo para el apellido del alumno -->
        <label for="apellido_alumno">Apellido:</label>
        <input id="apellido_alumno" name="apellido_alumno" type="text" oninput="validaApellidoAlum()">
        <p id="error_apellido_alumno"></p>

        <!-- Campo para el teléfono del alumno -->
        <label for="telf_alumno">Teléfono:</label>
        <input id="telf_alumno" name="telf_alumno" type="text" oninput="validaTelfAlum()">
        <p id="error_telf_alumno"></p>

        <!-- Campo para la fecha de contratación del alumno -->
        <label for="nacimiento_alumno">Fecha de Nacimiento:</label>
        <input id="nacimiento_alumno" name="nacimiento_alumno" type="date" oninput="validaFechaAlum()">
        <p id="error_nacimiento_alumno"></p>

        <!-- Botón de enviar -->
        <button type="submit">Guardar</button>
    </form>
</body>
</html>


