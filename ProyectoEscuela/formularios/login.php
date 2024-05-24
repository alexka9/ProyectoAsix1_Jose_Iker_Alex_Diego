<?php
session_start();
require_once '../CRUD/conexion.php';



// Definir las credenciales de inicio de sesión para el administrador
$credenciales_admin = [
    'email' => 'admin01execute@gmail.com',
    'password_admin' => '0execute0'
];

// Definir las credenciales de inicio de sesión para la secretaria
$credenciales_secretaria = [
    'email' => 'sara01execute@gmail.com',
    'password' => '00execute',
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    // Verificar si las credenciales coinciden con las del administrador
    if ($email === $credenciales_admin['email'] && $contrasena === $credenciales_admin['password_admin']) {
        // Credenciales de administrador correctas, iniciar sesión como administrador
        $_SESSION['admin'] = true;
        $_SESSION['id_admin'] = 1; // Ejemplo de ID de administrador
        // Redirigir a la página CRUD del administrador
        header('Location: ../CRUD/crudprof.php');
        exit;
    } 
    // Verificar si las credenciales coinciden con las de la secretaria
    elseif ($email === $credenciales_secretaria['email'] && $contrasena === $credenciales_secretaria['password']) {
        // Credenciales de secretaria correctas, iniciar sesión como secretaria
        $_SESSION['secretaria'] = true;
        // Redirigir a la página lista de la secretaria
        header('Location: ../CRUD/lista.php');
        exit;
    } else {
        // Credenciales incorrectas
        //NO REDIRIGIMOS SINO QUE MOSTRAMOS UN ALERT CON EL ERROR

        echo "<script type='text/javascript'>
        
        alert('Credenciales incorrectas');
       
        </script>";         //header('Location: ../index.php?error=credenciales_incorrectas');
        //exit;
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script  type="module" src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="../styles/login.css" rel="stylesheet" type="text/css">
    <title>LOGIN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="fondo">
<h2>
    <i class="fa-brands fa-gg-circle fa-2xl"></i> C.E EXECUTE
</h2>


<nav class="navbar">
        <ul>

        </ul>
</nav>
<br>
<br>
<br>
<br>

<h2>Login</h2>
<form action="" method="POST">
    <fieldset>
        <legend>Inicio de sesión</legend>
        <!-- <p>
            <label for="apodo">Apodo:</label><br>
            <input type="text" id="apodo" name="apodo" required autocomplete="username" aria-label="Apodo">
        </p> -->
        <p>
            <label for="email">Correo electrónico:</label><br>
            <input type="email" id="email" name="email" required autocomplete="email" aria-label="Correo electrónico">
        </p>
        <p>
            <label for="contrasena">Contraseña:</label><br>
            <input type="password" id="contrasena" name="contrasena" required autocomplete="current-password" aria-label="Contraseña">
        </p>
    </fieldset>
    <p>
        <input type="submit" value="Entrar">
    </p>
</form>


</body>
</html>