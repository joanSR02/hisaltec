<?php
    session_start();
    include 'conexion_bd.php';
    header('Content-Type: application/json');
    // Verifica si se ha enviado el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verifica si se ha subido un archivo sin errores
        if (isset($_FILES['userPhoto']) && $_FILES['userPhoto']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['userPhoto']['tmp_name'];
            $fileName = $_FILES['userPhoto']['name'];
            $fileSize = $_FILES['userPhoto']['size'];
            $fileType = $_FILES['userPhoto']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            $usuario_id = $_SESSION['usuario_id'];
            // Permitir solo ciertas extensiones
            $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
            if (in_array($fileExtension, $allowedfileExtensions)) {
                // Directorio donde se almacenará la imagen
                $uploadFileDir = './fotos_usuarios/';
                $dest_path = $uploadFileDir . $usuario_id . '.' .$fileExtension;
                $foto = isset($_SESSION['usuario_foto']) ? $_SESSION['usuario_foto'] : '';
                // Verifica si el valor no está vacío y no es NULL
                if (!empty($foto) && substr($foto, 0, 2) === './') {
                    if (file_exists($foto)) {
                        if (!unlink($foto)) {
                            echo json_encode(['success' => false, 'message' => 'Fallo al eliminar la imagen anterio de la base de datos']);
                            exit();
                        }
                    }
                }

                // Mueve el archivo a la carpeta destino
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    //Subir la direccion de la foto a la base de datos
                    $stmt = $conexion->prepare("UPDATE clientes SET foto = ? WHERE id = ?");/*Esto nos ayuda a evitar ataques por inyeccion*/
                    if ($stmt === false) {/*Valida si la preparación de la consulta fallo*/
                        echo json_encode(['success' => false, 'message' => 'Error en la preparación de la consulta']);
                        exit();
                    }
                    $stmt->bind_param("si", $dest_path, $usuario_id);
                    if ($stmt->execute() === TRUE) {
                        //Actualizar la foto
                        $_SESSION['usuario_foto'] = $dest_path;
                        $foto = substr($dest_path, 2);
                        $image_path = "./php/{$foto}";
                        echo json_encode(['success' => true, 'message' => 'El archivo se subió con éxito','photo_url'=>$image_path]);
                        exit();
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Error al subir la foto']);
                        exit();
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => 'Hubo un error al mover el archivo al directorio de carga']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Subida fallida. Solo se permiten archivos con las siguientes extensiones: ' . implode(',', $allowedfileExtensions)]);
            }
        }else {
            echo json_encode(['success' => false, 'message' => 'Hubo un error en la subida del archivo']);
        }
    }
    if (isset($stmt)) {
        $stmt->close();
    }
    mysqli_close($conexion);
    exit;
?>