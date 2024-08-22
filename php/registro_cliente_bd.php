<?php
    include 'conexion_bd.php';
    header('Content-Type: application/json');
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {/*Valida si el dato enviado es tipo post*/
        $nombre=$_POST['nombre'];
        $apellido=$_POST['apellido'];
        $celular=$_POST['celular'];
        $correo=$_POST['correo'];
        $clave=$_POST['clave'];
        $clave_confirmar=$_POST['clave_confirmar'];
        date_default_timezone_set('America/Lima');
        $fecha = date('Y-m-d H:i');
        $codigo = rand(1000,9999);
        $validacion=false;
        //Validar si la contraseña es correcta
        if ($clave!=$clave_confirmar){
            echo json_encode(['success' => false, 'message' => 'Las claves no coinciden']);
            exit();
        }
        if ($conexion->connect_error) {/*validamos la conexion a la base de datos*/
            echo json_encode(['success' => false, 'message' => 'Error en la conexión a la base de datos.']);
            exit();
        }
        //Encriptar clave
        $clave = password_hash($clave, PASSWORD_DEFAULT);
        //Verificar que el correo no se repita en la base de datos
        // Preparar la consulta
        $stmt = $conexion->prepare("SELECT * FROM clientes WHERE correo = ?");
        if ($stmt === false) {
            echo json_encode(['success' => false, 'message' => 'Error en la preparación de la consulta']);
            exit();
        }
        // Vincular el parámetro
        $stmt->bind_param("s", $correo);
        // Ejecutar la consulta
        $stmt->execute();
        // Obtener el resultado
        $verificar_correo = $stmt->get_result();
        if ($verificar_correo->num_rows > 0) {
            // Extraer el valor de la columna 'confirmado'
            $fila = $verificar_correo->fetch_assoc();
            $validacion = $fila['validacion'];
            if ($validacion==1){
                echo json_encode(['success' => false, 'message' => 'Este correo ya esta registrado']);
                exit();
            }else{
                $stmt = $conexion->prepare("DELETE FROM clientes WHERE correo = ?");
                if ($stmt === false) {/*Valida si la preparación de la consulta fallo*/
                    echo json_encode(['success' => false, 'message' => 'Error en la preparación de la consulta']);
                    exit();
                }
                $stmt->bind_param("s", $correo);
                if ($stmt->execute()) {
                    $stmt = $conexion->prepare("INSERT INTO clientes (nombres, apellidos, celular, correo, clave, fecha, codigo, validacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");/*Esto nos ayuda a evitar ataques por inyeccion*/
                    if ($stmt === false) {/*Valida si la preparación de la consulta fallo*/
                        echo json_encode(['success' => false, 'message' => 'Error en la preparación de la consulta']);
                        exit();
                    }
                    $stmt->bind_param("ssssssii", $nombre, $apellido, $celular, $correo, $clave,$fecha, $codigo, $validacion);/*"ssss" significa que hay 4 variables, con ello asociamos las variables*/
                    // Ejecutar la consulta y verificar errores
                    if ($stmt->execute() === TRUE) {
                        echo json_encode(['success' => true, 'message' => 'Se le volvió a enviar un correo con el fin de verificar su cuenta','codigo'=>$codigo,'correo'=>$correo,'nombre'=>$nombre]);
                        exit();
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Error al registrar el usuario']);
                        exit();
                    }
                }else{
                    echo json_encode(['success' => false, 'message' => 'Error al eliminar su correo de la base de datos']);
                    exit();
                }
            }
        }else{
            $stmt = $conexion->prepare("INSERT INTO clientes (nombres, apellidos, celular, correo, clave, fecha, codigo, validacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");/*Esto nos ayuda a evitar ataques por inyeccion*/
            if ($stmt === false) {/*Valida si la preparación de la consulta fallo*/
                echo json_encode(['success' => false, 'message' => 'Error en la preparación de la consulta']);
                exit();
            }
            $stmt->bind_param("ssssssii", $nombre, $apellido, $celular, $correo, $clave,$fecha, $codigo, $validacion);
            // Ejecutar la consulta y verificar errores
            if ($stmt->execute() === TRUE) {
                echo json_encode(['success' => true, 'message' => 'Se le envió un correo con el fin de verificar su cuenta','codigo'=>$codigo,'correo'=>$correo,'nombre'=>$nombre]);
                exit();
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al registrar el usuario']);
                exit();
            }
        }
        $stmt->close();
        mysqli_close($conexion);
    }
?>