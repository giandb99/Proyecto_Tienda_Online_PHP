<?php

session_start();

// Cargar preferencias
$idioma = isset($_COOKIE['idioma']) ? $_COOKIE['idioma'] : 'es';  // Español por defecto
$estilo = isset($_COOKIE['estilo']) ? $_COOKIE['estilo'] : 'claro'; // Claro por defecto

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['username'] == 'admin' && $_POST['password'] == '1234') {
        $_SESSION['usuario'] = 'admin';
        header("Location: ../index.php");
        exit;
    } elseif (!empty($_POST['username']) && !empty($_POST['password'])) {
        $_SESSION['usuario'] = 'usuario';
        header("Location: ../index.php");
        exit;
    } else {
        $error = 'Credenciales inválidas.';
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

    <main class="content">
        <h1 class="titulo-<?php echo $estilo; ?>"><?php echo $idioma === 'es' ? 'Iniciar Sesión' : 'Log In'; ?></h1>

        <?php if ($error): ?>
            <p class="error-<?php echo $estilo; ?>"><?php echo $error; ?></p>
        <?php endif; ?>

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