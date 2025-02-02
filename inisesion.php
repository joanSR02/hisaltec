<?php
    include('no_auth.php');
?>
<!DOCTYPE html>
<html lang="es" class="inisesion">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/estilo_inisesion.css">
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
        <section class="contenedor__main">
            <div class="caja__trasera">
                <div class="caja__trasera-login">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia sesión para entrar en la página</p>
                    <button class="btn__iniciar-sesion">Iniciar Sesión</button>
                </div>
                <div class="caja__trasera-register">
                    <h3>¿Aún no tienes una cuenta?</h3>
                    <p>Regístrate para que puedas iniciar sesión</p>
                    <button class="btn__registrarse">Regístrarse</button>
                </div>
            </div>
            <!--Formulario de Login y registro-->
            <div class="contenedor__login-register">
                <!--Login-->
                <form method="POST" class="formulario__login">
                    <h2>Iniciar Sesión</h2>
                    <div class="social-icons">
                        <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                        <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                        <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                    </div>
                    <input type="email" placeholder="Correo Electronico" name="correo" required>
                    <input type="password" placeholder="Contraseña" name="clave" required>
                    <button type="submit">Entrar</button>
                </form>

                <!--Register-->
                <form method="POST" class="formulario__register">
                    <h2>Regístrarse</h2>
                    <input type="text" placeholder="Nombre(s)" name="nombre" required>
                    <input type="text" placeholder="Apellido(s)" name="apellido" required>
                    <input type="tel" placeholder="Celular" name="celular" required>
                    <input type="email" placeholder="Correo Electronico" name="correo" required>
                    <input type="password" placeholder="Contraseña" name="clave" required>
                    <input type="password" placeholder="Confirmar contraseña" name="clave_confirmar" required>
                    <div class="terms-container">
                        <input type="checkbox" name="accept_terms" class="checkbox" required>
                        <label for="accept_terms">
                            Yo acepto los <a href="/terms-and-conditions" target="_blank">terminos y condiciones</a>.
                        </label>
                    </div>
                    <button type="submit">Regístrarse</button>
                </form>
            </div>
        </section>
        <div class="contenedor-toast" id="contenedor-toast">
            <!--<div class="toast exito" id="1">
                <div class="contenido">
                    <div class="icono">
                        <span class="material-icons-sharp">
                            check_box
                        </span>
                    </div>
                    <div class="texto">
                        <p class="titulo">Exito!</p>
                        <p class="descripcion">La operación fue exitosa</p>
                    </div>
                </div>
                <button class="btn-cerrar">
                    <span class="material-icons-sharp">
                        close
                    </span>
                </button>
            </div>
            <div class="toast error" id="2">
                <div class="contenido">
                    <div class="icono">
                        <span class="material-icons-sharp">
                            error
                        </span>
                    </div>
                    <div class="texto">
                        <p class="titulo">Error!</p>
                        <p class="descripcion">Hubo un error al intentar procesar la operación</p>
                    </div>
                </div>
                <button class="btn-cerrar">
                    <span class="material-icons-sharp">
                        close
                    </span>
                </button>
            </div>
            <div class="toast warning" id="3">
                <div class="contenido">
                    <div class="icono">
                        <span class="material-icons-sharp">
                            warning
                        </span>
                    </div>
                    <div class="texto">
                        <p class="titulo">Advertencia!</p>
                        <p class="descripcion">estoy advirtiendo de algo, haz caso</p>
                    </div>
                </div>
                <button class="btn-cerrar">
                    <span class="material-icons-sharp">
                        close
                    </span>
                </button>
            </div>
            <div class="toast info" id="4">
                <div class="contenido">
                    <div class="icono">
                        <span class="material-icons-sharp">
                            info
                        </span>
                    </div>
                    <div class="texto">
                        <p class="titulo">Información!</p>
                        <p class="descripcion">escribe algo que el usuario debe hacer</p>
                    </div>
                </div>
                <button class="btn-cerrar">
                    <span class="material-icons-sharp">
                        close
                    </span>
                </button>
            </div>-->
        </div>
    </main>
    <footer>
        <div class="contenido-footer">
            <img src="assets/images/logo.png" alt="Brand Logo" style="height: 50px;">
            <div class="bloques-footer">
                <div class="contacto-footer bloque-footer">
                    <h4>Contacto</h4>
                    <p><span class="material-icons-sharp" style="color: #97C21E">place</span> Mi casita Lima-Perú</p>
                    <p><span class="material-icons-sharp" style="color: #97C21E">smartphone</span> Personal: 940075724</p>
                    <p><span class="material-icons-sharp" style="color: #97C21E">calendar_today</span> Horario de atención:<br>    L-V: 9:30am - pm<br>    Dom: 11:00am - 4:00pm</p>
                    <p><span class="material-icons-sharp" style="color: #97C21E">email</span> E-mail: joansalcedorodrigues@gmail.com</p>
                </div>
                <div class="tipos_envio-footer bloque-footer">
                    <h4>Tipos de envíos</h4>
                    <p><span class="material-icons-sharp" style="color: #97C21E">airport_shuttle</span> Envios nacionales desde 10 dólares</p>
                    <p><span class="material-icons-sharp" style="color: #97C21E">flight_takeoff</span> Envios internacionales desde 45 dólares</p>
                </div>
                <div class="bloque-footer">
                    <div class="subbloque-footer">
                        <span class="material-icons-sharp" style="color: #97C21E">
                            payments
                        </span>
                        <div class="texto-icono-footer">
                            <h4>Pagos</h4>
                            <p>seguros</p>
                        </div>
                    </div>
                    <div class="subbloque-footer">
                        <span class="material-icons-sharp" style="color: #97C21E">
                            support_agent
                        </span>
                        <div class="texto-icono-footer">
                            <h4>24/7</h4>
                            <p>soporte</p>
                        </div>
                    </div>
                </div>
                <div class="bloque-footer">
                    <div class="subbloque-footer">
                        <span class="material-icons-sharp" style="color: #97C21E">
                            delivery_dining
                        </span>
                        <div class="texto-icono-footer">
                            <h4>Entregas</h4>
                            <p>a domicilio</p>
                        </div>
                    </div>
                    <div class="subbloque-footer">
                        <span class="material-icons-sharp" style="color: #97C21E">
                            assignment_return
                        </span>
                        <div class="texto-icono-footer">
                            <h4>Devolución</h4>
                            <p>10 días</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="espaciado-footer">
        </div>
    </footer>
    <div class="overlay">
        <div class="loader">
            <div class="inner one"></div>
            <div class="inner two"></div>
            <div class="inner three"></div>
        </div>
    </div>
    <script src="assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>