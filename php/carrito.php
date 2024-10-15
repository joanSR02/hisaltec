<?php
    function contar_productos_carrito($conexion,$usuario_id) {
        $stmt_contar = $conexion->prepare("SELECT COUNT(*) as total_carrito FROM Productos_carrito WHERE id_usuario = ?");
        $stmt_contar->bind_param("i", $usuario_id);
        if ($stmt_contar->execute()) {
            $result_contar = $stmt_contar->get_result();
            $row = $result_contar->fetch_assoc();
            $total_carrito = $row['total_carrito'];
            $stmt_contar->close();
            return ['success' => true, 'total_carrito' => $total_carrito];
        }else{
            $stmt_contar->close();
            return ['success' => false, 'total_carrito' => 0];
        }
    }

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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {/*Valida si el dato enviado es tipo post*/
            if (isset($_POST['producto_id']) && isset($_POST['cantidad'])) {
                $producto_id=$_POST['producto_id'];
                $cantidad=$_POST['cantidad'];
                $stmt_verificar = $conexion->prepare("SELECT cantidad FROM Productos_carrito WHERE id_usuario = ? AND id_producto = ?");
                if ($stmt_verificar === false) {
                    echo json_encode(['success' => false]);
                    exit();
                }
                $stmt_verificar->bind_param("ii", $usuario_id,$producto_id);
                if ($stmt_verificar->execute()) {
                    $resultado = $stmt_verificar->get_result();
                    if ($resultado->num_rows > 0) {
                        $fila = $resultado->fetch_assoc();
                        $nueva_cantidad = $fila['cantidad'] + $cantidad;
                        $stmt_actualizar = $conexion->prepare("UPDATE Productos_carrito SET cantidad = ? WHERE id_usuario = ? AND id_producto = ?");
                        if ($stmt_actualizar === false) {
                            echo json_encode(['success' => false]);
                            exit();
                        }
                        $stmt_actualizar->bind_param("iii", $nueva_cantidad,$usuario_id,$producto_id);
                        if ($stmt_actualizar->execute()) {
                            $resultado_final=contar_productos_carrito($conexion,$usuario_id);
                            $_SESSION['cantidad_carrito']=$resultado_final['total_carrito'];
                            echo json_encode($resultado_final);
                        }else{
                            echo json_encode(['success' => false]);
                        }
                        $stmt_actualizar->close();

                    }else{
                        $stmt_agregar = $conexion->prepare("INSERT INTO Productos_carrito(id_usuario,id_producto,cantidad) VALUES (?,?,?)");
                        if ($stmt_agregar === false) {
                            echo json_encode(['success' => false]);
                            exit();
                        }
                        $stmt_agregar->bind_param("iii", $usuario_id,$producto_id,$cantidad);
                        if ($stmt_agregar->execute()) {
                            $resultado_final=contar_productos_carrito($conexion,$usuario_id);
                            $_SESSION['cantidad_carrito']=$resultado_final['total_carrito'];
                            echo json_encode($resultado_final);
                        } else{
                            echo json_encode(['success' => false]);
                        }
                        $stmt_agregar->close();
                    }
                } else{
                    echo json_encode(['success' => false]);
                }
                $stmt_verificar->close();
            }else {
                echo json_encode(['success' => false]);
            }
        } else{
            echo json_encode(['success' => false]);
        }
    } else {
        echo json_encode(['success' => false]);
    }
    mysqli_close($conexion);
?>
