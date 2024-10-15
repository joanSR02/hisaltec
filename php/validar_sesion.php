<?php
    // Iniciar la sesión solo si ya existe una
    session_start();
    header('Content-Type: application/json');

    // Validar si la variable de sesión 'user_id' está definida
    if (isset($_SESSION['usuario_id'])) {
        // Devolver una respuesta positiva si la sesión está activa
        echo json_encode(['sesion_activa' => true]);
    } else {
        // Devolver una respuesta indicando que no hay sesión activa
        echo json_encode(['sesion_activa' => false]);
    }
?>