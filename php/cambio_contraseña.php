<?php
session_start();
include 'conexion_bd.php';
header('Content-Type: application/json');

// Verifica si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['contraseñaNueva']) && isset($_SESSION['usuario_id'])) {
        $contraseñaNueva = $_POST['contraseñaNueva'];
        $contraseñaAnterior = $_POST['contraseñaAnterior'];
        $id = $_SESSION['usuario_id'];
        // Extraendo la contraseña anterior
        // Preparar la consulta
        $stmt = $conexion->prepare("SELECT clave FROM clientes WHERE id = ?");
        // Vincular el parámetro ID a la consulta
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                $contraseña_registrada = $row['clave'];
            } else {
                echo json_encode(['success' => false, 'message' => 'No se encontró una fila con el ID especificado']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al ejecutar la consulta']);
        }
        if (!password_verify($contraseñaAnterior,$contraseña_registrada)){
            echo json_encode(['success' => false, 'message' => 'La "Contraseña anterior" no es correcta']);
            exit();
        }
        /*Validar que la contraseña nueva no sea igual que la anterior*/
        if (password_verify($contraseñaNueva,$contraseña_registrada)){
            echo json_encode(['success' => false, 'message' => 'La "Contraseña nueva" no debe ser igual a la "Contraseña anterior"']);
            exit();
        }
        //hachear contraseña
        $contraseñaNueva = password_hash($contraseñaNueva, PASSWORD_DEFAULT);

        // Preparar la consulta
        $stmt = $conexion->prepare("UPDATE clientes SET clave = ? WHERE id = ?");
        if ($stmt === false) {
            echo json_encode(['success' => false, 'message' => 'Error en la preparación de la consulta']);
            exit();
        }

        $stmt->bind_param("si", $contraseñaNueva, $id); // 's' para string y 'i' para entero

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo json_encode(['success' => true, 'message' => 'Clave actualizada exitosamente']);
                session_destroy();
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
