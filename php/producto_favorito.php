<?php
    function contar_favoritos($conexion,$usuario_id) {
        $stmt_contar = $conexion->prepare("SELECT COUNT(*) as total_favoritos FROM Productos_favoritos WHERE id_usuario = ?");
        $stmt_contar->bind_param("i", $usuario_id);
        if ($stmt_contar->execute()) {
            $result_contar = $stmt_contar->get_result();
            $row = $result_contar->fetch_assoc();
            $total_favoritos = $row['total_favoritos'];
            $stmt_contar->close();
            return ['success' => true, 'total_favoritos' => $total_favoritos];
        }else{
            $stmt_contar->close();
            return ['success' => false, 'total_favoritos' => 0];
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
            if (isset($_POST['producto_id']) && isset($_POST['funcion'])) {
                $producto_id=$_POST['producto_id'];
                $funcion=$_POST['funcion'];
                if ($funcion == "agregar"){
                    $stmt_agregar = $conexion->prepare("INSERT INTO Productos_favoritos(id_usuario, id_producto) VALUES (?,?)");
                    if ($stmt_agregar === false) {
                        echo json_encode(['success' => false]);
                        exit();
                    }
                    $stmt_agregar->bind_param("ii", $usuario_id,$producto_id);
                    if ($stmt_agregar->execute()) {
                        $resultado_final=contar_favoritos($conexion,$usuario_id);
                        $_SESSION['cantidad_favoritos']++;
                        echo json_encode($resultado_final);
                    }else{
                        echo json_encode(['success' => false]);
                    }
                    $stmt_agregar->close();
                } elseif ($funcion == "quitar"){
                    $stmt_verificar = $conexion->prepare("SELECT * FROM Productos_favoritos WHERE id_usuario = ? AND id_producto = ?");
                    if ($stmt_verificar === false) {
                        echo json_encode(['success' => false]);
                        exit();
                    }
                    $stmt_verificar->bind_param("ii", $usuario_id,$producto_id);
                    if ($stmt_verificar->execute()) {
                        $result_verificar = $stmt_verificar->get_result();
                        if ($result_verificar->num_rows > 0) {
                            $stmt_quitar = $conexion->prepare("DELETE FROM Productos_favoritos WHERE id_usuario = ? AND id_producto = ?");
                            if ($stmt_quitar === false) {
                                echo json_encode(['success' => false]);
                                exit();
                            }
                            $stmt_quitar->bind_param("ii", $usuario_id,$producto_id);
                            if ($stmt_quitar->execute()) {
                                $resultado_final=contar_favoritos($conexion,$usuario_id);
                                $_SESSION['cantidad_favoritos']--;
                                echo json_encode($resultado_final);
                            } else {
                                echo json_encode(['success' => false]);
                            }
                            $stmt_quitar->close();
                        }else {
                            echo json_encode(['success' => false]);
                        }
                        $stmt_verificar->close();
                    }else{
                        echo json_encode(['success' => false]);
                    }
                }else {
                    echo json_encode(['success' => false]);
                }
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
