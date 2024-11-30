<?php

// Inicia la sesión
session_start();

// Carga las preferencias de idioma y estilo desde las cookies, con valores predeterminados
$idioma = isset($_COOKIE['idioma']) ? $_COOKIE['idioma'] : 'es';  // Español por defecto
$estilo = isset($_COOKIE['estilo']) ? $_COOKIE['estilo'] : 'claro'; // Claro por defecto

// Se inicializa la variable de error
$error = '';

// Se procesa el formulario de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Se validan las credenciales del administrador
    if ($_POST['username'] == 'admin' && $_POST['password'] == '1234') {
        $_SESSION['usuario'] = 'admin'; // Guardar el usuario como administrador
        header("Location: ../index.php"); // Redirigir al índice
        exit;

    // Se validan las credenciales del usuario genérico
    } elseif (!empty($_POST['username']) && !empty($_POST['password'])) {
        $_SESSION['usuario'] = $_POST['username']; // Guardar el usuario como genérico
        header("Location: ../index.php"); // Redirigir al índice
        exit;
    } else {
        // Se guarda el mensaje de error si las credenciales son inválidas
        $error = $idioma === 'es' ? 'Credenciales inválidas.' : 'Invalid credentials.';
    }
}

?>

<!DOCTYPE html>
<html lang="<?php echo $idioma; ?>">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../Estilo/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title><?php echo $idioma === 'es' ? 'Iniciar Sesión' : 'Login'; ?></title>
</head>

<body class="body-<?php echo $estilo; ?>">
    <header class="header">
        <nav class="nav">
            <img src="../Imagenes/store-4156934_640.png" alt="Logo" class="nav-logo">
            <a href="carrito.php" class="nav-link"><?php echo $idioma === 'es' ? 'Ver Carrito' : 'View Cart'; ?></a>
            <a href="preferencias.php" class="nav-link"><?php echo $idioma === 'es' ? 'Preferencias' : 'Preferences'; ?></a>
        </nav>
    </header>

    <!-- Contenido principal -->
    <main class="content">
        <!-- Título del formulario de inicio de sesión -->
        <h1 class="titulo-<?php echo $estilo; ?>"><?php echo $idioma === 'es' ? 'Iniciar Sesión' : 'Log In'; ?></h1>

        <!-- Se muestra el mensaje de error si las credenciales son inválidas -->
        <?php if ($error): ?>
            <p class="error-<?php echo $estilo; ?>"><?php echo $error; ?></p>
        <?php endif; ?>

        <!-- Formulario de inicio de sesión -->
        <form method="POST" class="form-login">
            <div class="div-login">
                <label for="username" class="label-<?php echo $estilo; ?>"><?php echo $idioma === 'es' ? 'Usuario' : 'Username'; ?>:</label>
                <input type="text" name="username" id="username" class="input-<?php echo $estilo; ?>" placeholder="<?php echo $idioma === 'es' ? 'Introduce tu usuario' : 'Enter your username'; ?>" required>
                <br>
                <label for="password" class="label-<?php echo $estilo; ?>"><?php echo $idioma === 'es' ? 'Contraseña' : 'Password'; ?>:</label>
                <input type="password" name="password" id="password" class="input-<?php echo $estilo; ?>" placeholder="<?php echo $idioma === 'es' ? 'Introduce tu contraseña' : 'Enter your password'; ?>" required>
                <br>
                <button type="submit" class="boton-<?php echo $estilo; ?>"><?php echo $idioma === 'es' ? 'Entrar' : 'Log In'; ?></button>
            </div>
        </form>
    </main>

    <footer class="footer">
        <p class="footer-text">&copy; <?php echo date('Y'); ?> Tu Tienda Online. <?php echo $idioma === 'es' ? 'Todos los derechos reservados.' : 'All rights reserved.'; ?></p>
        <div class="footer-socials">
            <a href="https://www.facebook.com" target="_blank" class="footer-link">
                <i class="fab fa-facebook" alt="Facebook"></i>
            </a>
            <a href="https://www.twitter.com" target="_blank" class="footer-link">
                <i class="fab fa-twitter" alt="Twitter"></i>
            </a>
            <a href="https://www.instagram.com" target="_blank" class="footer-link">
                <i class="fab fa-instagram" alt="Instagram"></i>
            </a>
        </div>
    </footer>
</body>

</html>