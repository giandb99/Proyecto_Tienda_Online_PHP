<?php

session_start();

// Cargar preferencias de idioma y estilo desde las cookies
$idioma = isset($_COOKIE['idioma']) ? $_COOKIE['idioma'] : 'es';  // Español por defecto
$estilo = isset($_COOKIE['estilo']) ? $_COOKIE['estilo'] : 'claro'; // Claro por defecto

$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
$total = 0;

// Lógica para vaciar el carrito
if (isset($_POST['vaciar_carrito'])) {
    unset($_SESSION['carrito']);
    header("Location: carrito.php"); // Redirigir para aplicar los cambios
    exit;
}

?>

<!DOCTYPE html>
<html lang="<?php echo $idioma; ?>">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../Estilo/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title><?php echo $idioma === 'es' ? 'Carrito' : 'Cart'; ?></title>
</head>

<body class="body-<?php echo $estilo; ?>">
    <header class="header">
        <nav class="nav">
            <img src="../Imagenes/store-4156934_640.png" alt="Logo" class="nav-logo">
            <a href="../index.php" class="enlace-volver"><?php echo $idioma === 'es' ? 'Volver a la tienda' : 'Return to store'; ?></a>
            <a href="preferencias.php" class="nav-link"><?php echo $idioma === 'es' ? 'Preferencias' : 'Preferences'; ?></a>
            <?php if (isset($_SESSION['usuario'])): ?>
                <a href="logout.php" class="nav-link"><?php echo $idioma === 'es' ? 'Cerrar Sesión' : 'Log Out'; ?></a>
            <?php else: ?>
                <a href="login.php" class="nav-link"><?php echo $idioma === 'es' ? 'Iniciar Sesión' : 'Log In'; ?></a>
            <?php endif; ?>
        </nav>
    </header>

    <main class="content">
        <h1 class="titulo-<?php echo $estilo; ?>"><?php echo $idioma === 'es' ? 'Carrito de Compras' : 'Shopping Cart'; ?></h1>

        <?php if (empty($_SESSION['carrito'])): ?>
            <p class="carrito-vacio"><?php echo $idioma === 'es' ? 'El carrito está vacío.' : 'The cart is empty.'; ?></p>
        <?php else: ?>
            <table class="carrito-tabla">
                <thead>
                    <tr>
                        <th><?php echo $idioma === 'es' ? 'Producto' : 'Product'; ?></th>
                        <th><?php echo $idioma === 'es' ? 'Cantidad' : 'Quantity'; ?></th>
                        <th><?php echo $idioma === 'es' ? 'Precio Unitario' : 'Unit Price'; ?></th>
                        <th><?php echo $idioma === 'es' ? 'Subtotal' : 'Subtotal'; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['carrito'] as $producto): ?>
                        <tr>
                            <td><?php echo $producto['nombre']; ?></td>
                            <td><?php echo $producto['cantidad']; ?></td>
                            <td>$<?php echo $producto['precio']; ?></td>
                            <td>$<?php echo $producto['precio'] * $producto['cantidad']; ?></td>
                        </tr>
                        <?php $total += $producto['precio'] * $producto['cantidad']; ?>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="carrito-total-label"><?php echo $idioma === 'es' ? 'Total' : 'Total'; ?>:</td>
                        <td class="carrito-total">$<?php echo $total; ?></td>
                    </tr>
                </tfoot>
            </table>

            <!-- Botón para vaciar el carrito -->
            <form method="POST">
                <button type="submit" name="vaciar_carrito" class="boton-vaciar"><?php echo $idioma === 'es' ? 'Vaciar Carrito' : 'Clear Cart'; ?></button>
            </form>
        <?php endif; ?>
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