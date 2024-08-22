<?php
session_start(); // Iniciar sesión para acceder a la información de sesión
// Destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio o inicio de sesión
header("Location: ../");
exit();
?>
