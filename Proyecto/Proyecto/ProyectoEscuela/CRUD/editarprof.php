<?php
require_once 'conexion.php';

session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['admin'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: ../formularios/login.php');
    exit;
}

// Verificar si se recibió el ID del profesor por GET
if (!isset($_GET['id_prof'])) {
    // Redirigir al usuario a otra página o mostrar un mensaje de error
    echo "ID de profesor no proporcionado.";
    exit();
}

// SI SE HA RECOGIDO POR GET Obtener el ID del profesor de la URL
$id_prof = $_GET['id_prof'];

try {
    // Preparar la consulta para obtener los datos del profesor
    // La consulta preparada selecciona todos los campos de la tabla tbl_profesor donde el id_prof coincida con el valor de la variable $id_prof.

    $stmt = $con->prepare("SELECT * FROM tbl_profesor WHERE id_prof = ?");
    $stmt->bindParam(1, $id_prof, PDO::PARAM_INT);
    $stmt->execute();
    $profesor = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si se encontró algún registro
    if (!$profesor) {
        echo "No se encontró ningún registro para el ID de profesor proporcionado.";
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}






// Para el error cuando no rellenas campos
// Se verifica si el formulario fue enviado por POST. Si es así, se validan los datos del formulario y se procesan.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validar los datos del formulario
    $errors = [];
    if (empty($_POST['nombre_prof'])) {
        $errors[] = "El nombre es requerido.";
    }
        if (empty($_POST['apellido_prof'])) {
        $errors[] = "El apellido es requerido.";
    }
    if (empty($_POST['telf_prof'])) {
        $errors[] = "El apellido es requerido.";
    }
    if (empty($_POST['contratacion_prof'])) {
        $errors[] = "El grado es requerido.";
    }
    if (empty($_POST['grado_prof'])) {
        $errors[] = "El grado es requerido.";
    }
    if (empty($_POST['salario_prof'])) {
        $errors[] = "El salario es requerido.";
    }


    // Si no hay errores, procesa los datos
    if (empty($errors)) {



        // Obtener los datos del formulario
        $nombre_prof = $_POST['nombre_prof'];
        $apellido_prof = $_POST['apellido_prof'];
        $telf_prof = $_POST['telf_prof'];
        $contratacion_prof = $_POST['contratacion_prof'];
        $grado_prof = $_POST['grado_prof'];
        $salario_prof = $_POST['salario_prof'];

        try {
            // Preparar la consulta para actualizar los datos del profesor
            $stmt = $con->prepare("UPDATE tbl_profesor SET nombre_prof = ?, apellido_prof = ?, telf_prof = ?, contratacion_prof = ?, grado_prof = ?, salario_prof = ? WHERE id_prof = ?");
            $stmt->bindParam(1, $nombre_prof, PDO::PARAM_STR);
            $stmt->bindParam(2, $apellido_prof, PDO::PARAM_STR);
            $stmt->bindParam(3, $telf_prof, PDO::PARAM_STR);
            $stmt->bindParam(4, $contratacion_prof, PDO::PARAM_STR);
            $stmt->bindParam(5, $grado_prof, PDO::PARAM_STR);
            $stmt->bindParam(6, $salario_prof, PDO::PARAM_STR);
            $stmt->bindParam(7, $id_prof, PDO::PARAM_INT);
            $stmt->execute();

            // Verificar si se realizó la actualización correctamente. Si el número de filas afectadas es mayor que cero, significa que se actualizó correctamente un registro en la base de datos.
            if ($stmt->rowCount() > 0) {
                // Redirigir a la página crduprof.php después de completar la actualización
                header('Location: crudprof.php');
                exit();
            } else {
                echo "No se encontró ningún registro para actualizar.";
            }
        } catch (PDOException $e) {
            echo "Error en la transacción: " . $e->getMessage();
        }
    } else {
        // Mostrar mensajes de error. Si la variable $errors no está vacía, significa que se encontraron errores en la validación de los datos del formulario. En este caso, se recorre la matriz $errors utilizando un bucle foreach y se muestran los mensajes de error utilizando la etiqueta HTML <p>.
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

    <script src="../js/validacionesEditarProfe.js"></script>
    <title>Editar Registro</title>
</head>

<body>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id_prof=" . $id_prof; ?>" method="post"> 
<a href="../CRUD/crudprof.php">VOLVER</a>
<h2>Editar Registro</h2>

        <!-- Campo para editar el nombre -->
        <input id="id_prof" name="id_prof" type="text" class="form-control" value="<?php echo $id_prof; ?>" readonly>

<!-- htmlspecialchars Este valor se establece como el valor predeterminado del campo de entrada de texto -->
        <label for="nombre_prof">Nombre:</label>
        <input id="nombre_prof" name="nombre_prof" type="text" oninput="validaNombreProf()" 
        value="<?php echo htmlspecialchars($profesor['nombre_prof']); ?>">
        <p id="error_nombre_prof"></p>


        <!-- Campo para editar el apellido -->
        <label for="apellido_prof">Apellido:</label>
        <input id="apellido_prof" name="apellido_prof" type="text" oninput="validaApellidoProf()" value="<?php echo htmlspecialchars($profesor['apellido_prof']); ?>">
        <p id="error_apellido_prof"></p>

        <!-- Campo para editar el teléfono -->
        <label for="telf_prof">Teléfono:</label>
        <input id="telf_prof" name="telf_prof" type="tel" oninput="validaTelfProf()" value="<?php echo htmlspecialchars($profesor['telf_prof']); ?>">
        <p id="error_telf_prof"></p>

        <!-- Campo para editar la fecha de contratación -->
        <label for="contratacion_prof">Fecha de Contratación:</label>
        <input id="contratacion_prof" name="contratacion_prof" type="date" oninput="validaContratacionProf()" value="<?php echo htmlspecialchars($profesor['contratacion_prof']); ?>">
        <p id="error_contratacion_prof"></p>

        <!-- Campo para editar el grado -->
        <label for="grado_prof">Grado:</label>
        <input id="grado_prof" name="grado_prof" type="text" oninput="validaGradoProf()"value="<?php echo htmlspecialchars($profesor['grado_prof']); ?>">
        <p id="error_grado_prof"></p>

        <!-- Campo para editar el salario -->
        <label for="salario_prof">Salario:</label>
        <input id="salario_prof" name="salario_prof" type="text" oninput="validaSalarioProf()" value="<?php echo htmlspecialchars($profesor['salario_prof']); ?>">
        <p id="error_salario_prof"></p>

        <!-- Otros campos del formulario -->
        <input type="submit" value="Guardar Cambios">
    </form>
</body>

</html>
