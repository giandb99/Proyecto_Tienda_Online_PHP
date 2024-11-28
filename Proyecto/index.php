<?php

session_start();

// Cargar preferencias de idioma y estilo desde las cookies
$idioma = isset($_COOKIE['idioma']) ? $_COOKIE['idioma'] : 'es';  // Español por defecto
$estilo = isset($_COOKIE['estilo']) ? $_COOKIE['estilo'] : 'claro'; // Claro por defecto

// Productos de ejemplo
$productos = [
    ["nombre" => $idioma === 'es' ? "Iphone" : "Iphone", "precio" => 10, "imagen" => "Imagenes/iphone.jpg"],
    ["nombre" => $idioma === 'es' ? "Realme GT NEO 3T" : "Realme GT NEO 3T", "precio" => 20, "imagen" => "Imagenes/realme.png"],
    ["nombre" => $idioma === 'es' ? "ROG Phone 3" : "ROG Phone 3", "precio" => 30, "imagen" => "Imagenes/samsung.png"],
    ["nombre" => $idioma === 'es' ? "Xiaomi" : "Xiaomi", "precio" => 40, "imagen" => "Imagenes/xiaomi.png"],
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Obtener el producto seleccionado
    $producto = $productos[$_POST['producto']];

    // Inicializar el carrito si no existe
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Verificar si el producto ya está en el carrito
    $encontrado = false;

    foreach ($_SESSION['carrito'] as &$item) {
        if ($item['nombre'] === $producto['nombre']) {
            $item['cantidad'] += 1; // Incrementar la cantidad si ya existe
            $encontrado = true;
            break;
        }
    }

    // Si no se encontró el producto en el carrito, agregarlo con cantidad inicial 1
    if (!$encontrado) {
        $producto['cantidad'] = 1;
        $_SESSION['carrito'][] = $producto;
    }
}

?>

<!DOCTYPE html>
<html lang="<?php echo $idioma; ?>">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Estilo/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title><?php echo $idioma === 'es' ? 'Tienda Online' : 'Online Store'; ?></title>
</head>

<body class="body-<?php echo $estilo; ?>">
    <header class="header">
        <nav class="nav">
            <img src="Imagenes/store-4156934_640.png" alt="Logo" class="nav-logo">
            <a href="Interfaces/carrito.php" class="nav-link"><?php echo $idioma === 'es' ? 'Ver Carrito' : 'View Cart'; ?></a>
            <a href="Interfaces/preferencias.php" class="nav-link"><?php echo $idioma === 'es' ? 'Preferencias' : 'Preferences'; ?></a>

            <?php if (isset($_SESSION['usuario'])): ?>
                <a href="Interfaces/logout.php" class="nav-link"><?php echo $idioma === 'es' ? 'Cerrar Sesión' : 'Log Out'; ?></a>
            <?php else: ?>
                <a href="Interfaces/login.php" class="nav-link"><?php echo $idioma === 'es' ? 'Iniciar Sesión' : 'Log In'; ?></a>
            <?php endif; ?>
        </nav>
    </header>

    <main class="content">
        <h1 class="titulo-<?php echo $estilo; ?>"><?php echo $idioma === 'es' ? 'Bienvenido a la Tienda Online' : 'Welcome to the Online Store'; ?></h1>

        <?php if (isset($_SESSION['usuario'])): ?>
            <p class="usuario-<?php echo $estilo; ?>"><?php echo $idioma === 'es' ? 'Hola' : 'Hello'; ?>, <?php echo $_SESSION['usuario']; ?>.</p>
        <?php endif; ?>

        <div class="productos-container">
            <?php foreach ($productos as $index => $producto): ?>
                <div class="producto-card-<?php echo $estilo; ?>">
                    <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>" class="producto-imagen">
                    <h3 class="producto-nombre-<?php echo $estilo; ?>"><?php echo $producto['nombre']; ?></h3>
                    <p class="producto-precio-<?php echo $estilo; ?>">Precio: $<?php echo $producto['precio']; ?></p>
                    <form method="POST" class="form-agregar">
                        <input type="hidden" name="producto" value="<?php echo $index; ?>">
                        <button type="submit" class="boton-agregar"><?php echo $idioma === 'es' ? 'Agregar al carrito' : 'Add to cart'; ?></button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
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