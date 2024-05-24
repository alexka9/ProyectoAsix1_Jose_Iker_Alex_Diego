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
$filtro_orden = isset($_GET['filtro_orden']) ? $_GET['filtro_orden'] : 'id_prof';
$filtro_direccion = isset($_GET['filtro_direccion']) ? $_GET['filtro_direccion'] : 'ASC';

// Validar los valores de filtro_orden y filtro_direccion para evitar inyecciones SQL
$columnas_validas = ['id_prof', 'nombre_prof', 'apellido_prof', 'telf_prof', 'contratacion_prof', 'grado_prof', 'salario_prof'];
if (!in_array($filtro_orden, $columnas_validas)) {
    $filtro_orden = 'nombre_prof';
}
if (!in_array($filtro_direccion, ['ASC', 'DESC'])) {
    $filtro_direccion = 'ASC';
}

// Construir la consulta SQL con los filtros, la búsqueda y el orden
$query = "SELECT * FROM tbl_profesor WHERE 
    id_prof LIKE :search_term OR 
    nombre_prof LIKE :search_term OR 
    apellido_prof LIKE :search_term OR 
    telf_prof LIKE :search_term OR 
    contratacion_prof LIKE :search_term OR 
    grado_prof LIKE :search_term OR 
    salario_prof LIKE :search_term 
    ORDER BY $filtro_orden $filtro_direccion";
$statement = $con->prepare($query);
$search_param = '%' . $search_term . '%';
$statement->bindParam(':search_term', $search_param, PDO::PARAM_STR);
$statement->execute();
$profesores = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CRUD</title>
<link rel="stylesheet" href="../styles/crud1.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <a href="../formularios/formcrearprof.php">Añadir profesor</a>
    </div>
    <a href="../CRUD/crudalumn.php">Tabla Alumnos</a>
    <a href="../CRUD/crudclase.php">Tabla Clase</a>
</div>
<div class="recuadro">
<h2>Tabla de Profesores</h2>

<!-- Formulario de Búsqueda -->
<form method="GET" action="">
    <div class="filtro-container">
        <label for="search_term">Buscar:</label>
        <input type="text" id="search_term" name="search_term" value="<?php echo htmlspecialchars($search_term); ?>">
    </div>
    <br>

    <!-- Formulario de Filtro y Orden -->
    <div class="filtro-container">
        <label for="filtro_orden">Seleccionar tipo de orden:</label>
        <select id="filtro_orden" name="filtro_orden">
            <option value="id_prof" <?php if ($filtro_orden == 'id_prof') echo 'selected'; ?>>ID</option>
            <option value="nombre_prof" <?php if ($filtro_orden == 'nombre_prof') echo 'selected'; ?>>Nombre</option>
            <option value="apellido_prof" <?php if ($filtro_orden == 'apellido_prof') echo 'selected'; ?>>Apellido</option>
            <option value="telf_prof" <?php if ($filtro_orden == 'telf_prof') echo 'selected'; ?>>Teléfono</option>
            <option value="contratacion_prof" <?php if ($filtro_orden == 'contratacion_prof') echo 'selected'; ?>>Contratación</option>
            <option value="grado_prof" <?php if ($filtro_orden == 'grado_prof') echo 'selected'; ?>>Grado</option>
            <option value="salario_prof" <?php if ($filtro_orden == 'salario_prof') echo 'selected'; ?>>Salario</option>
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
<br><br>
<table border="1">
    <thead>
        <tr>
            <th class = "columna-oculta">ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th class = "columna-oculta">Teléfono</th>
            <th class = "columna-oculta">Contratación</th>
            <th>Grado</th>
            <th class = "columna-oculta">Salario</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <!-- // Para mostrar los valores de la BBDD -->
        <?php foreach ($profesores as $profesor): ?>
        <tr>
            <!-- htmlspecialchars para evitar inyecciones de los usuarios -->
            <td class = "columna-oculta"><?php echo htmlspecialchars($profesor['id_prof']); ?></td>
            <td><?php echo htmlspecialchars($profesor['nombre_prof']); ?></td>
            <td><?php echo htmlspecialchars($profesor['apellido_prof']); ?></td>
            <td class = "columna-oculta"><?php echo htmlspecialchars($profesor['telf_prof']); ?></td>
            <td class = "columna-oculta"><?php echo htmlspecialchars($profesor['contratacion_prof']); ?></td>
            <td><?php echo htmlspecialchars($profesor['grado_prof']); ?></td>
            <td class = "columna-oculta"><?php echo htmlspecialchars($profesor['salario_prof']); ?></td>
            <td class="actions">

                <!-- Link para editar el registro -->
                <form action="../CRUD/editarprof.php" method="get">
                    <input type="hidden" name="id_prof" value="<?php echo htmlspecialchars($profesor['id_prof']); ?>">
                    <button type="submit" >Editar</button>
                </form>
                <!-- Botón para eliminar el registro -->
                <form action="../CRUD/deleteprof.php" method="get">
                    <input type="hidden" name="ID" value="<?php echo htmlspecialchars($profesor['id_prof']); ?>">
                    <button type="submit1" onclick="return confirm('¿Estás seguro de eliminar este registro?')">Eliminar</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>

