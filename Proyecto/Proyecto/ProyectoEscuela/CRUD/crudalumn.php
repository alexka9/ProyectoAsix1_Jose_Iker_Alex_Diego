<?php
require_once 'conexion.php';

session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['admin'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: ../formularios/login.php');
    exit;
}

// Verificar si se ha enviado el formulario de búsqueda y Orden
$search_tema = isset($_GET['search_tema']) ? trim($_GET['search_tema']) : '';
$filtro_orden = isset($_GET['filtro_orden']) ? $_GET['filtro_orden'] : 'id_alumno';
$filtro_direccion = isset($_GET['filtro_direccion']) ? $_GET['filtro_direccion'] : 'ASC';

// Validar los valores de filtro_orden y filtro_direccion para evitar inyecciones SQL
/*$columnas_validas = ['id_alumno', 'nombre_alumno', 'apellido_alumno', 'telf_alumno', 'nacimiento_alumno'];
if (!in_array($filtro_orden, $columnas_validas)) {
    $filtro_orden = 'nombre_alumno';
}
if (!in_array($filtro_direccion, ['ASC', 'DESC'])) {
    $filtro_direccion = 'ASC';
}*/

// Construir la consulta SQL con los filtros y el orden
$query = "SELECT * FROM tbl_alumnos WHERE id_alumno LIKE :search OR nombre_alumno LIKE :search OR apellido_alumno LIKE :search OR telf_alumno LIKE :search OR nacimiento_alumno LIKE :search ORDER BY $filtro_orden $filtro_direccion";
$statement = $con->prepare($query);
$search = '%' . $search_tema . '%';
$statement->bindParam(':search', $search, PDO::PARAM_STR);
$statement->execute();
$alumnos = $statement->fetchAll(PDO::FETCH_ASSOC);

// Verificar si hubo un error en la consulta
// if ($statement->errorCode() != 0) {
//     $errors = $statement->errorInfo();
//     die("Error en la consulta: " . $errors[2]);
// }

// Contar el número de alumnos
$total_alumnos = $statement->rowCount();

// Cerrar la conexión
$con = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="../styles/crud1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
<body>
<header>
<h2>
    <i class="fa-brands fa-gg-circle fa-2xl"></i> C.E EXECUTE
</h2>

</header>
<div class="navbar">
    <div class="anadir">
    <a href="../formularios/formCrear.php">Añadir Alumnos</a>
    </div>
    <a href="../CRUD/crudprof.php">Tabla Profesores</a>
    <a href="../CRUD/crudclase.php">Tabla Clase</a>
</div>
<div class="recuadro">
<h2>Tabla de Alumnos</h2>

<div class="container">
    <div class="result">
        <?php echo "Número total de alumnos: " . $total_alumnos; ?>
    </div>
</div>

<br>
<hr>
<br>
<br>
<!-- Formulario de Búsqueda, Filtro y Orden -->
<form method="GET" action="">
    <div class="filtro-container">
        <label for="search_tema">Buscar:</label>
        <input type="text" id="search_tema" name="search_tema" value="<?php echo htmlspecialchars($search_tema); ?>">
    </div>

    <div class="filtro-container">
        <label for="filtro_orden">Seleccionar criterio de orden:</label>
        <select id="filtro_orden" name="filtro_orden">
            <option value="id_alumno" <?php if ($filtro_orden == 'id_alumno') echo 'selected'; ?>>ID</option>
            <option value="nombre_alumno" <?php if ($filtro_orden == 'nombre_alumno') echo 'selected'; ?>>Nombre</option>
            <option value="apellido_alumno" <?php if ($filtro_orden == 'apellido_alumno') echo 'selected'; ?>>Apellido</option>
            <option value="telf_alumno" <?php if ($filtro_orden == 'telf_alumno') echo 'selected'; ?>>Teléfono</option>
            <option value="nacimiento_alumno" <?php if ($filtro_orden == 'nacimiento_alumno') echo 'selected'; ?>>Fecha de Nacimiento</option>
        </select>
    </div>

    <div class="filtro-container">
        <label for="filtro_direccion">Seleccionar dirección del orden:</label>
        <select id="filtro_direccion" name="filtro_direccion">
            <option value="ASC" <?php if ($filtro_direccion == 'ASC') echo 'selected'; ?>>Ascendente</option>
            <option value="DESC" <?php if ($filtro_direccion == 'DESC') echo 'selected'; ?>>Descendente</option>
        </select>
    </div>

    <button type="submit">Filtrar</button>
</form>
</div>
<br>
<br>
<table border="1">
    <thead>
        <tr>
            <th class="columna-oculta">ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Teléfono</th>
            <th class="columna-oculta">Fecha de Nacimiento</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($alumnos as $alumno): ?>
        <tr>
            <td class="columna-oculta"><?php echo htmlspecialchars($alumno['id_alumno']); ?></td>
            <td><?php echo htmlspecialchars($alumno['nombre_alumno']); ?></td>
            <td><?php echo htmlspecialchars($alumno['apellido_alumno']); ?></td>
            <td><?php echo htmlspecialchars($alumno['telf_alumno']); ?></td>
            <td class="columna-oculta"><?php echo htmlspecialchars($alumno['nacimiento_alumno']); ?></td>
            <td>
                <!-- Botón para editar el registro -->
                <form action="../CRUD/editar.php" method="get">
                    <input type="hidden" name="id_alumno" value="<?php echo htmlspecialchars($alumno['id_alumno']); ?>">
                    <button type="submit" >Editar</button>
                </form>
                
                <!-- Botón para eliminar el registro -->
                <form action="../CRUD/delete.php" method="get">
                    <input type="hidden" name="id_alumno" value="<?php echo htmlspecialchars($alumno['id_alumno']); ?>">
                    <button type="submit1" onclick="return confirm('¿Estás seguro de eliminar este registro?')">Eliminar</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>
