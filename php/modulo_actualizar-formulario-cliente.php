<?php
session_start();
include 'conexion_bd.php';
header('Content-Type: application/json');
// Verifica si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_SESSION['usuario_id'];
    // Extraendo la contraseña anterior
    // Preparar la consulta
    $stmt = $conexion->prepare("SELECT * FROM clientes WHERE id=?");
    if ($stmt === false) {
        echo json_encode(['success' => 0, 'message' => 'Error en la preparación de la consulta']);
        exit();
    }
    // Vincular el parámetro ID a la consulta
    $stmt->bind_param("i",$id);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $usuario  = $result->fetch_assoc();
            echo json_encode(['success' => true, 'message' => 'Datos actualizados exitosamente', 'nombres' => $usuario ['nombres'], 'apellidos' => $usuario ['apellidos'], 'celular' => $usuario ['celular'], 'pais' => $usuario ['pais'], 'ciudad' => $usuario ['ciudad'], 'genero' => $usuario ['genero'], 'nacimiento' => $usuario ['nacimiento'], 'biografia' => $usuario ['biografia']]);
        }else{
            echo json_encode(['success' => false, 'message' => 'No se que paso',]);
        }   
    }else {
        echo json_encode(['success' => false, 'message' => 'Error al ejecutar la consulta']);
    }
    $stmt->close(); // Cierra el stmt
}else {
    echo json_encode(['success' => false, 'message' => 'Método de solicitud no válido']);
}
$conexion->close(); // Cierra la conexión
exit();
?>
