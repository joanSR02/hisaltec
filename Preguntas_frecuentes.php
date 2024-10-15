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
<html lang="es" class="Preguntas_frecuentes">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/estilo_Preguntas_frecuentes.css">
    <title>Document</title>
</head>
<body>
    <?php include './php/modulo/aside.php'; ?>
    <?php include './php/modulo/encabezado_lite.php'; ?>
    <main>
        <section class="accordion__wrapper">
            <h1 class="accordion__title">Frequently Asked Questions</h1>
            <div class="accordion">
                <div class="accordion__header">
                    <h2 class="accordion__question">What's an accordion?</h2>
                    <span id="accordion-icon" class="material-icons-sharp accordion__icon">add</span>
                </div>
                <div class="accordion__content">
                    <p class="accordion__answer">Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta, similique? Consectetur ex quos iste amet quia eligendi, culpa omnis. Excepturi nesciunt culpa dolorum eveniet aut quos voluptatem quae nobis est?</p>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion__header">
                    <h2 class="accordion__question">When and how it should used?</h2>
                    <span id="accordion-icon" class="material-icons-sharp accordion__icon">add</span>
                </div>
                <div class="accordion__content">
                    <p class="accordion__answer">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, magni et, adipisci corporis exercitationem incidunt commodi iusto, ratione veritatis laudantium debitis accusamus explicabo reiciendis aut quisquam dolorum vel natus officiis.</p>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion__header">
                    <h2 class="accordion__question">What happens id the user clicks on collapsed card while another card is open?</h2>
                    <span id="accordion-icon" class="material-icons-sharp accordion__icon">add</span>
                </div>
                <div class="accordion__content">
                    <p class="accordion__answer">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde ex animi natus voluptatum, architecto vitae atque magni soluta, aperiam doloribus, molestias aliquam provident commodi veniam sint error doloremque. Distinctio, numquam.</p>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion__header">
                    <h2 class="accordion__question">What if the user clicks on a collapsed card while another card is open?</h2>
                    <span id="accordion-icon" class="material-icons-sharp accordion__icon">add</span>
                </div>
                <div class="accordion__content">
                    <p class="accordion__answer">Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis labore tempora eius eveniet quia fugit veritatis perspiciatis voluptatum totam, eligendi rerum? Repudiandae ut maxime fuga laborum fugiat corrupti ad iure.</p>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion__header">
                    <h2 class="accordion__question">How choose an icon to indicate expansion?</h2>
                    <span id="accordion-icon" class="material-icons-sharp accordion__icon">add</span>
                </div>
                <div class="accordion__content">
                    <p class="accordion__answer">Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa id iure veniam, voluptas rerum odit quod ullam repudiandae quidem beatae expedita quaerat eaque repellat provident mollitia similique dolorum asperiores. Debitis!</p>
                </div>
            </div>
        </section>
    </main>
    <?php include './php/modulo/footer.php'; ?>
    <script src="assets/js/script.js"></script>
</body>
</html>