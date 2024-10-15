<?php
    include 'config.php';
    session_start();
    if (isset($_SESSION['usuario_id'])) {
        $usuario_id = $_SESSION['usuario_id'];
        $direccion_foto = $_SESSION['usuario_foto'];
        $correo = $_SESSION['usuario_correo'];
        $nombre = $_SESSION['usuario_nombre'];
        $image_path = 'php/' . ltrim($direccion_foto, './');
        // Verifica si el archivo de imagen existe
        if (file_exists($image_path)) {
            $image_src = $image_path;
        } else {
            $image_src = 'php/fotos_usuarios/user.png'; // Imagen por defecto
        }
    }
?>
<!DOCTYPE html>
<html lang="es" class="Blog">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/estilo_Blog.css">
    <title>Document</title>
</head>
<body>
    <?php include './php/modulo/aside.php'; ?>
    <?php include './php/modulo/encabezado_lite.php'; ?>
    <main>
        
    </main>
    <?php include './php/modulo/footer.php'; ?>
    <script src="assets/js/script.js"></script>
</body>
</html>