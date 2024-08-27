<?php
    session_start();
    include 'php/conexion_bd.php';
?>
<!DOCTYPE html>
<html lang="es" class="Perfil_borrar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/estilo_perfil_borrar.css">
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
                <a href="./perfil_editar.php"><span class="material-icons-sharp">edit</span>Editar perfil<span class="indicador"></span></span></a>
                <a href="./perfil_ajustes.php"><span class="material-icons-sharp">settings</span>Ajustes de cuenta<span class="indicador"></span></a>
                <a href="#"><span class="material-icons-sharp">delete</span>Borrar cuenta<span class="indicador"></span></a>
            </nav>
            <h2>Borrar cuenta</h2>
        </section>
        <section class="contenido">
            <form class="user-info-container" method="post" enctype="multipart/form-data">
                <div class="Datos">
                    <h2>Elimina tu cuenta</h2>
                    <p>Esto eliminará tus datos de perfil, historial, fotos, etc</p>
                </div>
                <button type="submit">Borrar</button>
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
    mysqli_close($conexion);
?>