<?php

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Guardar las preferencias de idioma y estilo en las cookies
    setcookie('idioma', $_POST['idioma'], time() + 3600, '/'); // Cookie de idioma
    setcookie('estilo', $_POST['estilo'], time() + 3600, '/'); // Cookie de estilo
    // Redirigir para aplicar las nuevas preferencias
    header("Location: preferencias.php");
    exit;
}

// Cargar las preferencias desde las cookies o usar valores predeterminados
$idioma = isset($_COOKIE['idioma']) ? $_COOKIE['idioma'] : 'es';  // Español por defecto
$estilo = isset($_COOKIE['estilo']) ? $_COOKIE['estilo'] : 'claro'; // Claro por defecto

?>

<!DOCTYPE html>
<html lang="<?php echo $idioma; ?>">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../Estilo/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title><?php echo $idioma === 'es' ? 'Preferencias' : 'Preferences'; ?></title>
</head>

<body class="body-<?php echo $estilo; ?>">
    <header class="header">
        <nav class="nav">
            <img src="../Imagenes/store-4156934_640.png" alt="Logo" class="nav-logo">
            <a href="../index.php" class="enlace-volver"><?php echo $idioma === 'es' ? 'Volver a la tienda' : 'Return to store'; ?></a>
            <a href="carrito.php" class="nav-link"><?php echo $idioma === 'es' ? 'Ver Carrito' : 'View Cart'; ?></a>
            <?php if (isset($_SESSION['usuario'])): ?>
                <a href="logout.php" class="nav-link"><?php echo $idioma === 'es' ? 'Cerrar Sesión' : 'Log Out'; ?></a>
            <?php else: ?>
                <a href="login.php" class="nav-link"><?php echo $idioma === 'es' ? 'Iniciar Sesión' : 'Log In'; ?></a>
            <?php endif; ?>
        </nav>
    </header>
    <main class="content">
        <h1 class="titulo-<?php echo $estilo; ?>"><?php echo $idioma === 'es' ? 'Preferencias' : 'Preferences'; ?></h1>

        <form method="POST" class="form-preferencias">
            <label for="idioma" class="label-<?php echo $estilo; ?>"><?php echo $idioma === 'es' ? 'Idioma' : 'Language'; ?>:</label>
            <select name="idioma" id="idioma" class="select-<?php echo $estilo; ?>">
                <option value="es" <?php echo $idioma == 'es' ? 'selected' : ''; ?>>Español</option>
                <option value="en" <?php echo $idioma == 'en' ? 'selected' : ''; ?>>English</option>
            </select>
            <br>
            <label for="estilo" class="label-<?php echo $estilo; ?>"><?php echo $idioma === 'es' ? 'Estilo' : 'Style'; ?>:</label>
            <select name="estilo" id="estilo" class="select-<?php echo $estilo; ?>">
                <option value="claro" <?php echo $estilo == 'claro' ? 'selected' : ''; ?>><?php echo $idioma === 'es' ? 'Claro' : 'Light'; ?></option>
                <option value="oscuro" <?php echo $estilo == 'oscuro' ? 'selected' : ''; ?>><?php echo $idioma === 'es' ? 'Oscuro' : 'Dark'; ?></option>
            </select>
            <br>
            <button type="submit" class="boton-<?php echo $estilo; ?>"><?php echo $idioma === 'es' ? 'Guardar' : 'Save'; ?></button>
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