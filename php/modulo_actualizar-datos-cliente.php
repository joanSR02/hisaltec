<?php
session_start();
include 'conexion_bd.php';
header('Content-Type: application/json');
// Verifica si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_SESSION['usuario_id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $ciudad = $_POST['ciudad'];
    $pais = $_POST['pais'];
    $genero = $_POST['genero'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $celular = $_POST['celular'];
    $biografia = $_POST['biografia'];
    // Extraendo la contraseña anterior
    // Preparar la consulta
    //$stmt = $conexion->prepare("UPDATE clientes SET nombres=?, apellidos=?, celular=?, pais=?, ciudad=?, genero=?, nacimiento=? WHERE id = ?");
    $stmt = $conexion->prepare("UPDATE clientes SET nombres=?, apellidos=?, ciudad=?, pais=?, genero=?, nacimiento=?, celular=?, biografia=? WHERE id=?");
    if ($stmt === false) {
        echo json_encode(['success' => 0, 'message' => 'Error en la preparación de la consulta']);
        exit();
    }
    // Vincular el parámetro ID a la consulta
    $stmt->bind_param("ssssssssi", $nombre, $apellido, $ciudad, $pais, $genero, $fecha_nacimiento, $celular, $biografia, $id);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => 1, 'message' => 'Datos actualizados exitosamente']);
        } else {
            echo json_encode(['success' => 2, 'message' => 'No se realizo ningun cambio']);
        }
    }else {
        echo json_encode(['success' => 0, 'message' => 'Error al ejecutar la consulta']);
    }
    $stmt->close(); // Cierra el stmt
}else {
    echo json_encode(['success' => 0, 'message' => 'Método de solicitud no válido']);
}
$conexion->close(); // Cierra la conexión
exit();
?>
