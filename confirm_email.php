<?php
    include 'php/conexion_bd.php';
    $correo = $_GET['correo'];
    $codigo_verificar = $_GET['codigo'];
    if ($conexion->connect_error) {/*validamos la conexion a la base de datos*/
        echo "Error en la conexión a la base de datos";
        exit();
    }
    $stmt = $conexion->prepare("SELECT * FROM clientes WHERE correo = ?");
    if ($stmt === false) {/*Valida si la preparación de la consulta fallo*/
        echo "Error en la preparación de la consulta";
        exit();
    }
    $stmt->bind_param("s", $correo);
    if ($stmt->execute() === TRUE) {
        $verificar_correo = $stmt->get_result();
        if ($verificar_correo->num_rows === 1) {//== es igualdad y === es identidad
            $fila = $verificar_correo->fetch_assoc();
            $codigo = $fila['codigo'];
            $validacion = $fila['validacion'];
            if ($validacion==0){
                if ($codigo_verificar == $codigo){
                    $stmt_update = $conexion->prepare("UPDATE clientes SET validacion = 1 WHERE correo = ?");
                    if ($stmt_update === false) { // Valida si la preparación de la consulta falló
                        echo "Error en la preparación de la consulta de actualización";
                    }
                    $stmt_update->bind_param("s", $correo);
                    if ($stmt_update->execute() === TRUE) {
                        echo "Correo validado con exito";
                    } else {
                        echo "Error al confirmar el correo";
                    }
                }else{
                    $stmt = $conexion->prepare("DELETE FROM clientes WHERE correo = ?");
                    if ($stmt === false) {/*Valida si la preparación de la consulta fallo*/
                        echo "Error en la preparación de la consulta";
                        exit();
                    }
                    $stmt->bind_param("s", $correo);
                    if ($stmt->execute()) {
                        echo "Intenta decifrarme con mas habilidad mamawebo 😎";
                    }else{
                        echo "Error al eliminar su correo de la base de datos";
                        exit();
                    }
                }
            }else{
                echo "El correo ya habia sido confirmado";
            }
        }elseif ($verificar_correo->num_rows > 1){
            echo "Error, hay mas de un correo";
        }else{
            echo "Error no existe ese correo pendiente a confirmación";
        }
    } else {
        echo "Error al confirmar el correo";
        exit();
    }
    $stmt->close();
    mysqli_close($conexion);
?>