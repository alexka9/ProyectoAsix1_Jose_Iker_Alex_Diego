<?php
require_once 'conexion.php';

session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['admin'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: ../formularios/login.php');
    exit;
}

// Verificar si se ha enviado el formulario de búsqueda y orden
$search_term = isset($_GET['search_term']) ? trim($_GET['search_term']) : '';
$filtro_orden = isset($_GET['filtro_orden']) ? $_GET['filtro_orden'] : 'id_clase';
$filtro_direccion = isset($_GET['filtro_direccion']) ? $_GET['filtro_direccion'] : 'ASC';

// Validar los valores de filtro_orden y filtro_direccion para evitar inyecciones SQL
$columnas_validas = ['id_clase', 'codi_clase', 'nombre_clase'];
if (!in_array($filtro_orden, $columnas_validas)) {
    $filtro_orden = 'nombre_clase';
}
if (!in_array($filtro_direccion, ['ASC', 'DESC'])) {
    $filtro_direccion = 'ASC';
}

// Construir la consulta SQL con los filtros y el orden
$query = "SELECT * FROM tbl_clase WHERE id_clase LIKE :search OR codi_clase LIKE :search OR nombre_clase LIKE :search ORDER BY $filtro_orden $filtro_direccion";
$statement = $con->prepare($query);
$search_term_with_wildcards = '%' . $search_term . '%';
$statement->bindParam(':search', $search_term_with_wildcards, PDO::PARAM_STR);
$statement->execute();
$clases = $statement->fetchAll(PDO::FETCH_ASSOC);
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
        <a href="../CRUD/crudprof.php">Tabla Profesores</a>
        <a href="../CRUD/crudalumn.php">Tabla Alumnos</a>
    </div>
<div class="recuadro">
    <h2>Tabla de Clase</h2>

    <!-- Formulario de Búsqueda, Filtro y Orden -->
    <form method="GET" action="">
        <div class="filtro-container">
            <label for="search_term">Buscar:</label>
            <input type="text" id="search_term" name="search_term" value="<?php echo htmlspecialchars($search_term); ?>">
        </div>

        <div class="filtro-container">
            <label for="filtro_orden">Seleccionar tipo de orden:</label>
            <select id="filtro_orden" name="filtro_orden">
                <option value="id_clase" <?php if ($filtro_orden == 'id_clase') echo 'selected'; ?>>ID</option>
                <option value="codi_clase" <?php if ($filtro_orden == 'codi_clase') echo 'selected'; ?>>Codigo Clase</option>
                <option value="nombre_clase" <?php if ($filtro_orden == 'nombre_clase') echo 'selected'; ?>>Nombre Clase</option>
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
                <th>Codigo Clase</th>
                <th>Nombre Clase</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clases as $clase): ?>
            <tr>
                <td class="columna-oculta"><?php echo htmlspecialchars($clase['id_clase']); ?></td>
                <td><?php echo htmlspecialchars($clase['codi_clase']); ?></td>
                <td><?php echo htmlspecialchars($clase['nombre_clase']); ?></td>
                <td>
                    <!-- Botón para editar el registro -->
                    <!-- <form action="../CRUD/editarclase.php" method="get">
                    <<button  type="submit" name=id_clase href="editarClase.php?id_clase=">Editar</button> --> 
                    <form action="../CRUD/editarclase.php" method="get">
                    <input type="hidden" name="id_clase" value="<?php echo htmlspecialchars($clase['id_clase']); ?>">
                    <button type="submit" >Editar</button>
                </form>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

