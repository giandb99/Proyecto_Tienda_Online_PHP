<?php

// Inicia la sesión
session_start();

// Se cargan las preferencias de idioma y estilo desde las cookies con valores predeterminados si no existen
$idioma = isset($_COOKIE['idioma']) ? $_COOKIE['idioma'] : 'es';  // Español por defecto
$estilo = isset($_COOKIE['estilo']) ? $_COOKIE['estilo'] : 'claro'; // Claro por defecto

// Definición de productos con traducción dinámica y rutas de imágenes
$productos = [
    ["nombre" => $idioma === 'es' ? "Iphone" : "Iphone", "precio" => 10, "imagen" => "Imagenes/iphone.jpg"],
    ["nombre" => $idioma === 'es' ? "Realme GT NEO 3T" : "Realme GT NEO 3T", "precio" => 20, "imagen" => "Imagenes/realme.png"],
    ["nombre" => $idioma === 'es' ? "ROG Phone 3" : "ROG Phone 3", "precio" => 30, "imagen" => "Imagenes/samsung.png"],
    ["nombre" => $idioma === 'es' ? "Xiaomi" : "Xiaomi", "precio" => 40, "imagen" => "Imagenes/xiaomi.png"],
];

// Procesa las solicitudes POST (agregar productos al carrito)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Se obtiene el producto seleccionado según el índice recibido en el formulario
    $producto = $productos[$_POST['producto']];

    // Se inicializa el carrito si no existe
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Verifica si el producto ya está en el carrito
    $encontrado = false;

    foreach ($_SESSION['carrito'] as &$item) {
        if ($item['nombre'] === $producto['nombre']) {
            $item['cantidad'] += 1; // Incrementa la cantidad del producto si ya existe en el carrito
            $encontrado = true;
            break;
        }
    }

    // Si no se encontró el producto en el carrito, se agrega con la cantidad inicial 1
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

    <!-- Encabezado con barra de navegación -->
    <header class="header">
        <nav class="nav">
            <!-- Logo de la tienda -->
            <img src="Imagenes/store-4156934_640.png" alt="Logo" class="nav-logo">
            
            <!-- Enlaces de navegación -->
            <a href="Interfaces/carrito.php" class="nav-link"><?php echo $idioma === 'es' ? 'Ver Carrito' : 'View Cart'; ?></a>
            <a href="Interfaces/preferencias.php" class="nav-link"><?php echo $idioma === 'es' ? 'Preferencias' : 'Preferences'; ?></a>

            <!-- Muestra "Cerrar Sesión" si el usuario está logueado, sino "Iniciar Sesión" -->
            <?php if (isset($_SESSION['usuario'])): ?>
                <a href="Interfaces/logout.php" class="nav-link"><?php echo $idioma === 'es' ? 'Cerrar Sesión' : 'Log Out'; ?></a>
            <?php else: ?>
                <a href="Interfaces/login.php" class="nav-link"><?php echo $idioma === 'es' ? 'Iniciar Sesión' : 'Log In'; ?></a>
            <?php endif; ?>
        </nav>
    </header>

    <!-- Contenido principal -->
    <main class="content">
        <!-- Título principal -->
        <h1 class="titulo-<?php echo $estilo; ?>"><?php echo $idioma === 'es' ? 'Bienvenido a la Tienda Online' : 'Welcome to the Online Store'; ?></h1>

        <!-- Mensaje de bienvenida al usuario si está logueado -->
        <?php if (isset($_SESSION['usuario'])): ?>
            <p class="usuario-<?php echo $estilo; ?>"><?php echo $idioma === 'es' ? 'Hola' : 'Hello'; ?>, <?php echo $_SESSION['usuario']; ?>.</p>
        <?php endif; ?>

        <!-- Lista de productos -->
        <div class="productos-container">
            <?php foreach ($productos as $index => $producto): ?>
                <div class="producto-card-<?php echo $estilo; ?>">
                    <!-- Imagen del producto -->
                    <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>" class="producto-imagen">
                    <!-- Nombre del producto -->
                    <h3 class="producto-nombre-<?php echo $estilo; ?>"><?php echo $producto['nombre']; ?></h3>
                    <!-- Precio del producto -->
                    <p class="producto-precio-<?php echo $estilo; ?>">Precio: $<?php echo $producto['precio']; ?></p>
                    
                    <!-- Botón para agregar al carrito -->
                    <form method="POST" class="form-agregar">
                        <input type="hidden" name="producto" value="<?php echo $index; ?>">
                        <button type="submit" class="boton-agregar"><?php echo $idioma === 'es' ? 'Agregar al carrito' : 'Add to cart'; ?></button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- Pie de página -->
    <footer class="footer">
        <p class="footer-text">&copy; <?php echo date('Y'); ?> Tu Tienda Online. <?php echo $idioma === 'es' ? 'Todos los derechos reservados.' : 'All rights reserved.'; ?></p>
        
        <!-- Enlaces a redes sociales -->
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