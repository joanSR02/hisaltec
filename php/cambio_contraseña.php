<?php
session_start();
include 'conexion_bd.php';
header('Content-Type: application/json');

// Verifica si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['contraseña']) && isset($_SESSION['usuario_id'])) {
        $contraseña = $_POST['contraseña'];
        $id = $_SESSION['usuario_id'];

        // Preparar la consulta
        $stmt = $conexion->prepare("UPDATE clientes SET clave = ? WHERE id = ?");
        if ($stmt === false) {
            echo json_encode(['success' => false, 'message' => 'Error en la preparación de la consulta']);
            exit();
        }

        $stmt->bind_param("si", $contraseña, $id); // 's' para string y 'i' para entero

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo json_encode(['success' => true, 'message' => 'Clave actualizada exitosamente']);
            } else {
                echo json_encode(['success' => false, 'message' => 'No se realizaron cambios en la clave']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al ejecutar la consulta']);
        }

        $stmt->close(); // Cierra el stmt
    } else {
        echo json_encode(['success' => false, 'message' => 'Datos de entrada inválidos']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método de solicitud no válido']);
}

$conexion->close(); // Cierra la conexión
exit();
?>
