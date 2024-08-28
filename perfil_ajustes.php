<?php
    include('auth.php');
    include 'php/conexion_bd.php';
    $stmt = $conexion->prepare("SELECT correo FROM clientes WHERE id = ?");
    if ($stmt === false) {
        echo 'Error en la preparación de la consulta';
        exit();
    }
    $stmt->bind_param("i", $_SESSION['usuario_id']);
    $stmt->execute();
    $datos_usuario = $stmt->get_result();
    $usuario  = $datos_usuario->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es" class="Perfil_ajustes">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/estilo_perfil_ajustes.css">
    <title>Document</title>
</head>
<body>
    <header>
        <div class="hero_1">
            <div class="contenedor">
                <a href="./index.php"><span class="material-icons-sharp">keyboard_return</span><span class="texto-sidebar">Volver</span></a>
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
        <section class="contenido_opciones">
            <nav>
                <a href="./perfil_editar.php"><span class="material-icons-sharp">edit</span>Editar perfil<span class="indicador"></span></span></a>
                <a href="#"><span class="material-icons-sharp">settings</span>Ajustes de cuenta<span class="indicador"></span></a>
                <a href="./perfil_borrar.php"><span class="material-icons-sharp">delete</span>Borrar cuenta<span class="indicador"></span></a>
            </nav>
            <h2>Ajustes de cuenta</h2>
        </section>
        <section class="contenido">
            <form class="user-info-container" method="post" enctype="multipart/form-data">
                <div class="Datos">
                    <div class="form-group">
                        <h3>Correo electrónico</h3>
                        <p><?php echo htmlspecialchars($usuario['correo'], ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                    <div class="form-group">
                        <label for="contraseñaAnterior">Contraseña anterior</label>
                        <input type="password" id="contraseñaAnterior" name="contraseñaAnterior" required>
                    </div>
                    <div class="form-group">
                        <label for="contraseñaNueva">Contraseña nueva</label>
                        <input type="password" id="contraseñaNueva" name="contraseñaNueva" required>
                        <div id="feedback"></div>
                        <div id="barra-seguridad" class="barra-seguridad"></div>
                    </div>
                    <div class="form-group">
                        <label for="validarContraseñaNueva">Repetir contraseña nueva</label><!--for se refiere a la contraseña-->
                        <input type="password" id="validarContraseñaNueva" name="validarContraseña" required>
                    </div>
                </div>
                <button type="submit">Guardar</button>
            </form>
        </section>
        <div class="contenedor-toast" id="contenedor-toast">
        </div>
    </main>
    <script src="assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
<?php
    $stmt->close();
    mysqli_close($conexion);
?>