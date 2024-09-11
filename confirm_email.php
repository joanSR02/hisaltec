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
                        $mensaje = "Error en la preparación de la consulta de actualización";
                        $caso= 1;
                    }
                    $stmt_update->bind_param("s", $correo);
                    if ($stmt_update->execute() === TRUE) {
                        $mensaje = "Correo validado con exito";
                        $caso= 2;
                    } else {
                        $mensaje = "Error al confirmar el correo";
                        $caso= 3;
                    }
                }else{
                    $stmt = $conexion->prepare("DELETE FROM clientes WHERE correo = ?");
                    if ($stmt === false) {/*Valida si la preparación de la consulta fallo*/
                        $mensaje = "Error en la preparación de la consulta de eliminacion de correo";
                        $caso= 4;
                    }
                    $stmt->bind_param("s", $correo);
                    if ($stmt->execute()) {
                        $mensaje = "Te equivocaste de enlace, registrate nuevamente";
                        $caso= 5;
                    }else{
                        $mensaje = "Error al eliminar su correo de la base de datos";
                        $caso= 6;
                    }
                }
            }else{
                $mensaje = "Este correo ya ha sido validado";
                $caso= 7;
            }
        }elseif ($verificar_correo->num_rows > 1){
            $mensaje = "Error, hay mas de un correo, contactese con nosotros para arreglarlo";
            $caso= 8;
        }else{
            $mensaje = "Error, no existe ese correo";
            $caso= 9;
        }
    } else {
        $mensaje = "Error al confirmar el correo";
        $caso= 10;
    }
    $stmt->close();
    mysqli_close($conexion);
?>
<!DOCTYPE html>
<html lang="es" class="Perfil_borrar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/estilo_confirm_email.css">
    <title>Document</title>
</head>
<body>
    <header>
        <div class="hero_1">
            <div class="contenedor">
                <a href="./"><span class="material-icons-sharp">keyboard_return</span><span class="texto-sidebar">Volver</span></a>
                <div class="logo">
                    <img src="./assets/images/logo.png" alt="Logo" >
                </div>
                <div class="modo-oscuro">
                    <div class="switch">
                        <div class="base">
                            <div class="circulo"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>
        <section>
            <?php
                switch ($caso) {
                    case 1:
                        echo '<h1>'. $mensaje .'</h1>
                        <img src="./assets/images/error_sesion/gato-llorando.png" alt="">';
                        break;
                    case 2:
                        echo '<h1>'. $mensaje .'</h1>
                        <img src="./assets/images/error_sesion/gato-exito.png" alt="">
                        <a href="./inisesion.html" class="mi-boton">Iniciar sesión</a>';
                        break;
                    case 3:
                        echo '<h1>'. $mensaje .'</h1>
                        <img src="./assets/images/error_sesion/perro-sospecha.jpg" alt="">';
                        break;
                    case 4:
                        echo '<h1>'. $mensaje .'</h1>
                        <img src="./assets/images/error_sesion/gato-llorando.png" alt="">';
                        break;
                    case 5:
                        echo '<h1>'. $mensaje .'</h1>
                        <img src="./assets/images/error_sesion/gato-sospecha.png" alt="">';
                        break;
                    case 6:
                        echo '<h1>'. $mensaje .'</h1>
                        <img src="./assets/images/error_sesion/gato-llorando.png" alt="">';
                        break;
                    case 7:
                        echo '<h1>'. $mensaje .'</h1>
                        <img src="./assets/images/error_sesion/gato-exito.png" alt="">
                        <a href="./inisesion.html" class="mi-boton">Iniciar sesión</a>';
                        break;
                    case 8:
                        echo '<h1>'. $mensaje .'</h1>
                        <img src="./assets/images/error_sesion/gato-sorpresa.png" alt="">';
                        break;
                    case 9:
                        echo '<h1>'. $mensaje .'</h1>
                        <img src="./assets/images/error_sesion/gato-sospecha.png" alt="">';
                        break;
                    case 10:
                        echo '<h1>'. $mensaje .'</h1>
                        <img src="./assets/images/error_sesion/gato-llorando.png" alt="">';
                        break;
                    default:
                    echo '<h1>'. $mensaje .'</h1>
                        <img src="./assets/images/error_sesion/gato.png" alt="">';
                        echo "El color no es reconocido.";
                        break;
                }
            ?>
        </section>
    </main>
    <script src="assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>