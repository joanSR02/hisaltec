<?php
    session_start(); // Iniciar sesión para acceder a la información de sesión
    header('Content-Type: application/json');
    // Destruir la sesión
    session_destroy();
    // Redirigir al usuario a la página de inicio o inicio de sesión
    echo json_encode(['success' => true]);
?>
