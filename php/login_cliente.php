<?php
    session_start();
    include 'conexion_bd.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {/*Valida si el dato enviado es tipo post*/
        $correo=$_POST['correo'];
        $clave_confirmar=$_POST['clave'];
    }
    if ($conexion->connect_error) {/*validamos la conexion a la base de datos*/
        echo 'Error en la conexión a la base de datos.';
        exit();
    }
    // Preparar la consulta
    $stmt = $conexion->prepare("SELECT * FROM clientes WHERE correo = ?");
    if ($stmt === false) {
        echo 'Error en la preparación de la consulta';
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
                    // Iniciar la sesión y almacenar información del usuario
                    $_SESSION['usuario_id'] = $usuario['id'];
                    $_SESSION['usuario_nombre'] = $usuario['nombres'];
                    $_SESSION['usuario_foto'] = $usuario['foto'];
                    // Redirigir a la página principal
                    header("Location: ../");
                    exit();
                }else{
                    echo "Contraseña incorrecta.";
                    exit();
                }
            }else{
                echo 'El correo no esta validado';
                exit();
            }
    }else{
        echo 'El correo no existe';
        exit();
    }
    $stmt->close();
    mysqli_close($conexion);
?>