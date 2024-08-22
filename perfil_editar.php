<?php
    session_start();
    include 'php/conexion_bd.php';
?>
<!DOCTYPE html>
<html lang="es" class="Perfil_editar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/estilo_perfil_editar.css">
    <title>Document</title>
</head>
<body>
    <header>
        <div class="hero_1">
            <div class="contenedor">
                <a href="./index.html"><span class="material-icons-sharp">keyboard_return</span><span class="texto-sidebar">Volver</span></a>
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
                <a href="#"><span class="material-icons-sharp">edit</span>Editar perfil<span class="indicador"></span></span></a>
                <a href="./perfil_ajustes.php"><span class="material-icons-sharp">settings</span>Ajustes de cuenta<span class="indicador"></span></a>
                <a href="#"><span class="material-icons-sharp">delete</span>Borrar cuenta<span class="indicador"></span></a>
            </nav>
            <h2>Editar perfil</h2>
        </section>
        <section class="contenido">
            <?php
                // Obtener el valor de la sesión
                $foto = isset($_SESSION['usuario_foto']) ? $_SESSION['usuario_foto'] : '';

                // Verifica si el valor no está vacío y no es NULL
                if (!empty($foto) && substr($foto, 0, 2) === './') {
                    // Quitar los primeros dos caracteres (./)
                    $foto = substr($foto, 2);
                    $image_path = "php/{$foto}";

                    // Verificar si el archivo existe y es una imagen válida
                    if (file_exists($image_path) && exif_imagetype($image_path) !== false) {
                        $image_src = $image_path;
                    } else {
                        $image_src = 'php/fotos_usuarios/user.png'; // Imagen por defecto
                    }
                } else {
                    // Si el valor es vacío o NULL, asignar una imagen por defecto
                    $image_src = 'php/fotos_usuarios/user.png'; // Imagen por defecto
                }
                //Datos del usuario
                // Preparar la consulta
                $stmt = $conexion->prepare("SELECT * FROM clientes WHERE id = ?");
                if ($stmt === false) {
                    echo 'Error en la preparación de la consulta';
                    exit();
                }
                $stmt->bind_param("i", $_SESSION['usuario_id']);
                $stmt->execute();
                $datos_usuario = $stmt->get_result();
                $usuario  = $datos_usuario->fetch_assoc();
                echo '
                <form class="user-photo-container" method="post" enctype="multipart/form-data">
                    <div class="update-photo">
                        <input type="file" class="upload-input" name="userPhoto" accept="image/*">
                        <span class="material-icons-sharp">
                            add_a_photo
                        </span>
                    </div>
                    <img src=' . htmlspecialchars($image_src) . ' alt="Foto de usuario" class="user-photo">
                </form>';
            ?>
            <form class="user-info-container" action="/ruta-del-servidor" method="post" enctype="multipart/form-data">
                <div class="Datos">
                    <div class="form-group">
                        <label for="nombre">Nombre(s)</label>
                        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario['nombres'], ENT_QUOTES, 'UTF-8'); ?>">
                    </div>
                
                    <div class="form-group">
                        <label for="apellido">Apellido(s)</label>
                        <input type="text" id="apellido" name="apellido" value="<?php echo htmlspecialchars($usuario['apellidos'], ENT_QUOTES, 'UTF-8'); ?>">
                    </div>
                
                    <div class="form-group">
                        <label for="ciudad">Ciudad</label>
                        <input type="text" id="ciudad" name="ciudad" value="Lima">
                    </div>
                
                    <div class="form-group">
                        <label for="pais">¿Cuál es tu país?</label>
                        <input type="text" id="pais" name="pais" value="Perú">
                    </div>
                
                    <div class="form-group">
                        <label for="genero">Género</label>
                        <select id="genero" name="genero">
                            <option value="">-Seleccionar-</option>
                            <option value="masculino">Masculino</option>
                            <option value="femenino">Femenino</option>
                            <option value="otro">Optimus Prime</option>
                        </select>
                    </div>
                
                    <div class="form-group">
                        <label for="fecha-nacimiento">Fecha de nacimiento</label>
                        <input type="date" id="fecha-nacimiento" name="fecha-nacimiento" value="2024-01-01">
                    </div>
                
                    <div class="form-group">
                        <label for="celular">Celular</label>
                        <input type="tel" id="celular" name="celular" value="<?php echo htmlspecialchars($usuario['celular'], ENT_QUOTES, 'UTF-8'); ?>">
                    </div>
                </div>
                <div class="form-group biografia">
                    <label for="biografia">Biografía</label>
                    <textarea id="biografia" name="biografia"></textarea>
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