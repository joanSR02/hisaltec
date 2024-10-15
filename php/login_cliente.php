<?php
    header('Content-Type: application/json');
    session_start();
    include 'conexion_bd.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {/*Valida si el dato enviado es tipo post*/
        $correo=$_POST['correo'];
        $clave_confirmar=$_POST['clave'];
    }
    if ($conexion->connect_error) {/*validamos la conexion a la base de datos*/
        echo json_encode(['success' => 'error', 'message' => 'Error en la conexión a la base de datos.']);
        exit();
    }
    // Preparar la consulta
    $stmt = $conexion->prepare("SELECT * FROM clientes WHERE correo = ?");
    if ($stmt === false) {
        echo json_encode(['success' => 'error', 'message' => 'Error en la preparación de la consulta']);
        exit();
    }
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $verificar_correo = $stmt->get_result();
    if ($verificar_correo->num_rows > 0) {
        $usuario  = $verificar_correo->fetch_assoc();
            $validacion = $usuario ['validacion'];
            if ($validacion==1){
                $clave = $usuario ['clave'];
                if (password_verify($clave_confirmar, $clave)){
                    // Consulta para contar los favoritos
                    $stmt = $conexion->prepare("SELECT COUNT(*) as total_favoritos FROM Productos_favoritos WHERE id_usuario = ?");
                    $stmt->bind_param("i", $usuario['id']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    // Inicializa la cantidad de favoritos en la sesión
                    $_SESSION['cantidad_favoritos'] = $row['total_favoritos'];
                    // Consulta para contar los productos que estan en carrito
                    $stmt = $conexion->prepare("SELECT COUNT(*) as total_carrito FROM Productos_carrito WHERE id_usuario = ?");
                    $stmt->bind_param("i", $usuario['id']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    // Inicializa la cantidad de favoritos en la sesión
                    $_SESSION['cantidad_carrito'] = $row['total_carrito'];
                    // Iniciar la sesión y almacenar información del usuario
                    $_SESSION['usuario_id'] = $usuario['id'];
                    $_SESSION['usuario_nombre'] = $usuario['nombres'];
                    $_SESSION['usuario_foto'] = $usuario['foto'];
                    $_SESSION['usuario_correo'] = $usuario['correo'];
                    // Redirigir a la página principal
                    //header("Location: ../");
                    echo json_encode(['success' => 'exito', 'message' => 'Bienvenido...']);
                    exit();
                }else{
                    echo json_encode(['success' => 'warning', 'message' => 'Contraseña incorrecta.']);
                    exit();
                }
            }else{
                echo json_encode(['success' => 'warning', 'message' => 'El correo no esta validado']);
                exit();
            }
    }else{
        echo json_encode(['success' => 'warning', 'message' => 'El correo no existe']);
        exit();
    }
    $stmt->close();
    mysqli_close($conexion);
?>