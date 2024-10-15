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
<html lang="es" class="Contacto">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/estilo_Contacto.css">
    <title>Document</title>
</head>
<body>
    <?php include './php/modulo/aside.php'; ?>
    <?php include './php/modulo/encabezado_lite.php'; ?>
    <main>
        <section class="contactUs">
            <h1 class="title">Contactenos!!</h1>
            <div class="box">
                <div class="contact form">
                    <h3>Envianos un mensaje 🫡</h3>
                    <form id="form_contacto" method="POST">
                        <div class="formBox">
                            <div class="row50">
                                <div class="inputBox">
                                    <span>Nombre(s)</span>
                                    <input type="text" name="nombres" placeholder="Ingrese su nombre" required>
                                </div>
                                <div class="inputBox">
                                    <span>Apellido(s)</span>
                                    <input type="text" name="apellidos" placeholder="Ingrese su apellido" required>
                                </div>
                            </div>
                            <div class="row50">
                                <div class="inputBox">
                                    <span>Correo</span>
                                    <input type="email" name="correo" placeholder="Ingrese su correo" required>
                                </div>
                                <div class="inputBox">
                                    <span>Celular</span>
                                    <input type="tel" name="celular" placeholder="Ingrese su número" required>
                                </div>
                            </div>
                            <div class="row100">
                                <div class="inputBox">
                                    <span>Mensaje</span>
                                    <textarea placeholder="Escribe tu mensaje aqui..." name="mensaje" required></textarea>
                                </div>
                            </div>
                            <div class="row100">
                                <div class="inputBox">
                                    <button type="submit">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="contact info">
                    <h3>Información de contacto</h3>
                    <div class="infoBox">
                        <div>
                            <span class="material-icons-sharp">place</span>
                            <p>Mi casita<br>Lima-Perú</p>
                        </div>
                        <div>
                            <span class="material-icons-sharp">email</span>
                            <a href="mailto:joansalcedorodrigues@gmail.com">joansalcedorodrigues@gmail.com</a>
                        </div>
                        <div>
                            <span class="material-icons-sharp">contact_phone</span>
                            <a href="tel:+51940075724">+51 940 075 724</a>
                        </div>
                        <ul class="sci">
                            <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="contact map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4639.690036374672!2d-77.08504170244721!3d-12.077972257757402!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c970336b0725%3A0xae2a6f969b48786e!2sPlaza%20San%20Miguel!5e0!3m2!1ses-419!2spe!4v1721775286099!5m2!1ses-419!2spe" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </section>
        <div class="contenedor-toast" id="contenedor-toast"></div>
    </main>
    <?php include './php/modulo/footer.php'; ?>
    <script src="assets/js/script.js"></script>
</body>
</html>