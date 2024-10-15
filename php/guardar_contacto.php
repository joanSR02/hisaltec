<?php
    session_start();
    include 'conexion_bd.php';
    header('Content-Type: application/json');
    if ($conexion->connect_error) {/*validamos la conexion a la base de datos*/
        echo "No logró conectarse a la base de datos";
        exit();
    }
    // Verifica si se ha enviado el formulario
    if (isset($_SESSION['usuario_id'])) {
        $usuario_id = $_SESSION['usuario_id'];
    }else {
        $usuario_id = 0;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {/*Valida si el dato enviado es tipo post*/
        if (isset($_POST['nombres']) && isset($_POST['apellidos']) && isset($_POST['correo']) && isset($_POST['celular']) && isset($_POST['mensaje'])) {
            $nombres=$_POST['nombres'];
            $apellidos=$_POST['apellidos'];
            $correo=$_POST['correo'];
            $celular=$_POST['celular'];
            $mensaje=$_POST['mensaje'];
            $stmt_guardar = $conexion->prepare("INSERT INTO Comtacto(id_usuario,nombres,apellidos, correo, celular, mensaje) VALUES (?,?,?,?,?,?)");
            if ($stmt_guardar === false) {
                echo json_encode(['success' => false]);
                exit();
            }
            $stmt_guardar->bind_param("isssss", $usuario_id,$nombres,$apellidos,$correo,$celular,$mensaje);
            if ($stmt_guardar->execute()) {
                echo json_encode(['success' => 'exito','titulo' => 'Exito!!', 'message' => 'Mensaje enviado exitosamente']);
            }else{
                echo json_encode(['success' => 'error','titulo' => 'Error!!', 'message' => 'Hubo un error en la base de datos, intentelo nuevamente...']);
            }
        } else {
            echo json_encode(['success' => 'warning','titulo' => 'Advertencia!!', 'message' => 'Hubo un error, intentelo nuevamente...']);
        }
    }else{
        echo json_encode(['success' => 'warning','titulo' => 'Advertencia!!', 'message' => 'Hubo un error, intentelo nuevamente...']);
    }
    mysqli_close($conexion);
?>
