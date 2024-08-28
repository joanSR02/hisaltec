<?php
session_start();
include 'conexion_bd.php';
header('Content-Type: application/json');

// Verifica si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_SESSION['usuario_id'];
    // Extraendo la contraseña anterior
    // Preparar la consulta
    $stmt = $conexion->prepare("DELETE FROM clientes WHERE id = ?");
    // Vincular el parámetro ID a la consulta
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => true, 'message' => 'Usuario eliminado con exito']);
            session_destroy();
        } else {
            echo json_encode(['success' => false, 'message' => 'No se encontró una fila con el ID especificado']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al ejecutar la consulta']);
    }
    $stmt->close(); // Cierra el stmt
} else {
    echo json_encode(['success' => false, 'message' => 'Método de solicitud no válido']);
}

$conexion->close(); // Cierra la conexión
exit();
?>
