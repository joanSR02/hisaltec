<?php
// auth.php

    session_start();

    // Verificar si el usuario está logeado
    if (isset($_SESSION['usuario_id'])) {
        // Si no está logeado, redirigir a la página de inicio de sesión
        header('Location: error_sesion_active.html');
        exit();
    }

// Si el usuario está logeado, el script continúa normalmente
?>