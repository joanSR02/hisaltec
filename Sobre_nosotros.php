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
<html lang="es" class="Sobre_nosotros">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/estilo_Sobre_nosotros.css">
    <title>Document</title>
</head>
<body>
    <?php include './php/modulo/aside.php'; ?>
    <?php include './php/modulo/encabezado_lite.php'; ?>
    <main>
        <section class="contenido">
            <div class="contexto">
                <h1>SOMOS HISALTEC</h1>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illo, molestiae! Impedit earum consequuntur architecto, deleniti nisi natus reprehenderit soluta voluptas dignissimos ratione corporis aliquid vel suscipit repudiandae! Dignissimos, laudantium inventore!</p>
            </div>
        </section>
        <section class="contenedor">
            <div class="cards">
                <div class="card">
                    <div class="telescope comun-card">
                        <span>Vision</span>
                        <img src="./assets/images/telescopio.png" alt="">
                        <div class="contenido-card">
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Libero earum perspiciatis in voluptatibus provident, debitis vel, corrupti quod pariatur odio dolorum officia obcaecati tempora nihil illum esse! Delectus, et minus!</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="rocket comun-card">
                        <span>Mision</span>
                        <img src="./assets/images/cohete.png" alt="">
                        <div class="contenido-card">
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Libero earum perspiciatis in voluptatibus provident, debitis vel, corrupti quod pariatur odio dolorum officia obcaecati tempora nihil illum esse! Delectus, et minus!</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="cosmonaut comun-card">
                        <span>Valores</span>
                        <img src="./assets/images/cosmonauta.png" alt="">
                        <div class="contenido-card">
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Libero earum perspiciatis in voluptatibus provident, debitis vel, corrupti quod pariatur odio dolorum officia obcaecati tempora nihil illum esse! Delectus, et minus!</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include './php/modulo/footer.php'; ?>
    <script src="assets/js/script.js"></script>
</body>
</html>