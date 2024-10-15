<?php
    session_start();
    header('Content-Type: application/json');
    include 'conexion_bd.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {/*Valida si el dato enviado es tipo post*/
        $comentario=$_POST['caja_comentar'];
        $usuario_id = $_SESSION['usuario_id'];
        $id_producto = $_POST['id_producto'];
        $estrellas = $_POST['rating'];
    }
    if ($conexion->connect_error) {/*validamos la conexion a la base de datos*/
        echo json_encode(['success' => 'error', 'message' => 'Error en la conexión a la base de datos.']);
        exit();
    }
    // Preparar la consulta
    $stmt = $conexion->prepare("INSERT INTO Comentarios(id_cliente, comentario, estrellas, id_producto) VALUES (?,?,?,?)");
    if ($stmt === false) {
        echo json_encode(['success' => 'error', 'message' => 'Error en la preparación de la consulta']);
        exit();
    }
    $stmt->bind_param("isii", $usuario_id,$comentario,$estrellas,$id_producto);
    if ($stmt->execute()) {
        echo json_encode(['success' => 'exito', 'message' => 'Comentario cargado exitosamente']);
    }else{
        echo json_encode(['success' => 'warning', 'message' => 'Hubo un error al subir su comentario']);
    }
    $stmt->close();
    mysqli_close($conexion);
?>