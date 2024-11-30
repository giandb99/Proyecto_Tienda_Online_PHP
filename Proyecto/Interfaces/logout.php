<?php

// Inicia la sesión
session_start();

// Destruye todas las variables de sesión y cerrar la sesión
session_destroy();

// Redirige al usuario a la página principal después de cerrar sesión
header("Location: ../index.php");

// Detiene la ejecución del script para asegurarse de que no se ejecuta ningún código adicional
exit;