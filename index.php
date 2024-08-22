<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es" class="index">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/estilo.css">
    <title>Document</title>
</head>
<body>
    <aside>
        <div class="menu_sidebar">
            <img src="./assets/images/logo.png" alt="">
            <span class="material-icons-sharp">
                close
            </span>
        </div>
        <nav class="navegacion">
            <ul>
                <li>
                    <a href="#"><span class="material-icons-sharp">home</span><span class="texto-sidebar">Inicio</span></a>
                </li>
                <li>
                    <a href="./Sobre_nosotros.html"><span class="material-icons-sharp">people</span><span class="texto-sidebar">Sobre nosotros</span></a>
                </li>
                <li>
                    <a href="./Preguntas_frecuentes.html"><span class="material-icons-sharp">question_answer</span><span class="texto-sidebar">Preguntas frecuentes</span></a>
                </li>
                <li>
                    <a href="./Contacto.html"><span class="material-icons-sharp">connect_without_contact</span><span class="texto-sidebar">Contacto</span></a>
                </li>
                <li>
                    <a href="./Blog.html"><span class="material-icons-sharp">feed</span><span class="texto-sidebar">Blog</span></a>
                </li>
            </ul>
        </nav>
        <div>
            <div class="linea"></div>
            <div class="modo-oscuro">
                <div class="info">
                    <span class="material-icons-sharp">dark_mode</span>
                    <span class="texto-sidebar">Dark Mode</span>
                </div>
                <div class="switch">
                    <div class="base">
                        <div class="circulo"></div>
                    </div>
                </div>
            </div>
            <div class="usuario">
                <img src="./Jhampier.jpg" alt="">
                <div class="info-usuario">
                    <div class="nombre-email">
                        <span class="texto-sidebar nombre">Joan</span>
                        <span class="email">joansalcedorodrigues@gmail.com</span>
                    </div>
                    <span class="material-icons-sharp">more_vert</span>
                </div>
            </div>
        </div>
    </aside>
    <header>
        <div class="hero_1">
            <div class="contenedor">
                <nav>
                    <ul>
                        <li>
                            <a href="#">Inicio</a>
                        </li>
                        <li>
                            <a href="./Sobre_nosotros.html">Sobre nosotros</a>
                        </li>
                        <li>
                            <a href="./Preguntas_frecuentes.html">Preguntas frecuentes</a>
                        </li>
                        <li>
                            <a href="./Contacto.html">Contacto</a>
                        </li>
                        <li>
                            <a href="./Blog.html">Blog</a>
                        </li>
                    </ul>
                </nav>
                <div class="modo-oscuro">
                    <div class="switch">
                        <div class="base">
                            <div class="circulo"></div>
                        </div>
                    </div>
                </div>
                <div class="icono-menu">
                    <span class="material-icons-sharp">
                        menu
                    </span>
                </div>
                <div class="logo">
                    <img src="./assets/images/logo.png" alt="Logo" style="height: 50px;">
                </div>
                <div class="favoritos_compras">
                    <span class="material-icons-sharp">
                        favorite
                    </span>
                    <span class="material-icons-sharp">
                        shopping_cart
                    </span>
                </div>
            </div>
        </div>
        <div class="hero_2">
            <div class="contenedor">
                <img src="./assets/images/logo.png" alt="Logo" style="height: 50px;">
                <!--Buscador (temporal)-->
                <div class="search_box">
                    <input type="search" placeholder="Search here">
                    <span class="material-icons-sharp">
                        search
                    </span>
                </div>
                <!----------------------->
                <div class="login_register">
                    <?php
                        if (isset($_SESSION['usuario_id'])) {
                            $usuario_id = $_SESSION['usuario_id'];
                            $image_path = "php/fotos_usuarios/{$usuario_id}.png";
                            // Verifica si el archivo de imagen existe
                            if (file_exists($image_path)) {
                                $image_src = $image_path;
                            } else {
                                $image_src = 'php/fotos_usuarios/user.png'; // Imagen por defecto
                            }
                            echo '
                            <div class="user-menu">
                                <img src=' . htmlspecialchars($image_src) . ' alt="Foto de usuario" class="user-photo" onclick="toggleMenu()">
                                <div id="user-dropdown" class="dropdown-content">
                                    <ul>
                                        <li><a href="perfil_editar.php">Mi Cuenta</a></li>
                                        <li><a href="php/logout.php">Salir</a></li>
                                    </ul>
                                </div>
                            </div>';
                        }else{
                            echo '<span class="material-icons-sharp">
                                person
                            </span>
                            <a href="./inisesion.html">INGRESA/REGISTRATE</a>';
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="hero_3">
            <div class="contenedor">
                <nav>
                    <ul>
                        <li>
                            <a href="#">PRODUCTOS</a>
                        </li>
                        <li>
                            <a href="#">OFERTAS</a>
                        </li>
                        <li>
                            <a href="#">IMPRESIÓN 3D</a>
                        </li>
                        <li>
                            <a href="#">TUTORIALES</a>
                        </li>
                        <li>
                            <a href="#">CURSOS</a>
                        </li>
                    </ul>
                </nav>
                <div class="favoritos_compras">
                    <span class="material-icons-sharp">
                        favorite
                    </span>
                    <span class="material-icons-sharp">
                        shopping_cart
                    </span>
                </div>
            </div>
        </div>
    </header>
    <main>
        <!--Carrusel-->
        <section class="carousel">
            <div class="progress-bar-contenedor">
                <div class="progress-bar"></div>
            </div>
            <div class="list"><!--Esta es el bloque donde estarán todos los items o dispositivos que el usuario podra visualizar-->
                <div class="item"><!--Item1-->
                    <img src="assets/images/img1.png"><!--La imagen del dispositivo o equipo-->
                    <div class="introduce"><!--Aqui va la información que el usuario vera primero, se podria decir que es el gancho-->
                        <div class="title">PLACA DE DESARROLLO</div>
                        <div class="topic">Raspberry Pi 5</div>
                        <div class="des">
                            <!-- 20 lorem -->
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia, laborum cumque dignissimos quidem atque et eligendi aperiam voluptates beatae maxime.
                        </div>
                        <button class="seeMore">VER MAS &#8599</button><!--Es el botón para ver mas sobre el dispositivo &#8599 es un caracter de flecha diagonal hacia la esquina superior derecha-->
                    </div>
                    <div class="detail"><!--Es el bloque de detalles cuando le damos ver mas-->
                        <div class="title">Aerphone GHTK</div><!--Es el titulo-->
                        <div class="des"><!--Es un parrafo donde se habla del equipo-->
                            <!-- lorem 50 -->
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor, reiciendis suscipit nobis nulla animi, modi explicabo quod corrupti impedit illo, accusantium in eaque nam quia adipisci aut distinctio porro eligendi. Reprehenderit nostrum consequuntur ea! Accusamus architecto dolores modi ducimus facilis quas voluptatibus! Tempora ratione accusantium magnam nulla tenetur autem beatae.
                        </div>
                        <div class="specifications"><!--Son las especificaciones, recomendaria hacerlo con tablas pero esta hecho asi-->
                            <div>
                                <p>Used Time</p>
                                <p>6 hours</p>
                            </div>
                            <div>
                                <p>Charging port</p>
                                <p>Type-C</p>
                            </div>
                            <div>
                                <p>Compatible</p>
                                <p>Android</p>
                            </div>
                            <div>
                                <p>Bluetooth</p>
                                <p>5.3</p>
                            </div>
                            <div>
                                <p>Controlled</p>
                                <p>Touch</p>
                            </div>
                        </div>
                        <div class="checkout"><!--En este bloque van los botones para añadir el equipo al carrito y otro para ver mas del equipo-->
                            <button>ADD TO CART</button>
                            <button>CHECKOUT</button>
                        </div>
                    </div>
                </div>
    
                <div class="item"><!--Item2-->
                    <img src="assets/images/img2.png">
                    <div class="introduce">
                        <div class="title">PLACA DE DESARROLLO</div>
                        <div class="topic">Raspberry Pi Zero 2W</div>
                        <div class="des">
                            <!-- 20 lorem -->
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia, laborum cumque dignissimos quidem atque et eligendi aperiam voluptates beatae maxime.
                        </div>
                        <button class="seeMore">VER MAS &#8599</button>
                    </div>
                    <div class="detail">
                        <div class="title">Aerphone GHTK</div>
                        <div class="des">
                            <!-- lorem 50 -->
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor, reiciendis suscipit nobis nulla animi, modi explicabo quod corrupti impedit illo, accusantium in eaque nam quia adipisci aut distinctio porro eligendi. Reprehenderit nostrum consequuntur ea! Accusamus architecto dolores modi ducimus facilis quas voluptatibus! Tempora ratione accusantium magnam nulla tenetur autem beatae.
                        </div>
                        <div class="specifications">
                            <div>
                                <p>Used Time</p>
                                <p>6 hours</p>
                            </div>
                            <div>
                                <p>Charging port</p>
                                <p>Type-C</p>
                            </div>
                            <div>
                                <p>Compatible</p>
                                <p>Android</p>
                            </div>
                            <div>
                                <p>Bluetooth</p>
                                <p>5.3</p>
                            </div>
                            <div>
                                <p>Controlled</p>
                                <p>Touch</p>
                            </div>
                        </div>
                        <div class="checkout">
                            <button>ADD TO CART</button>
                            <button>CHECKOUT</button>
                        </div>
                    </div>
                </div>
    
                <div class="item"><!--Item3-->
                    <img src="assets/images/img3.png">
                    <div class="introduce">
                        <div class="title">PLACA DE DESARROLLO</div>
                        <div class="topic">Arduino Mega</div>
                        <div class="des">
                            <!-- 20 lorem -->
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia, laborum cumque dignissimos quidem atque et eligendi aperiam voluptates beatae maxime.
                        </div>
                        <button class="seeMore">VER MAS &#8599</button>
                    </div>
                    <div class="detail">
                        <div class="title">Aerphone GHTK</div>
                        <div class="des">
                            <!-- lorem 50 -->
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor, reiciendis suscipit nobis nulla animi, modi explicabo quod corrupti impedit illo, accusantium in eaque nam quia adipisci aut distinctio porro eligendi. Reprehenderit nostrum consequuntur ea! Accusamus architecto dolores modi ducimus facilis quas voluptatibus! Tempora ratione accusantium magnam nulla tenetur autem beatae.
                        </div>
                        <div class="specifications">
                            <div>
                                <p>Used Time</p>
                                <p>6 hours</p>
                            </div>
                            <div>
                                <p>Charging port</p>
                                <p>Type-C</p>
                            </div>
                            <div>
                                <p>Compatible</p>
                                <p>Android</p>
                            </div>
                            <div>
                                <p>Bluetooth</p>
                                <p>5.3</p>
                            </div>
                            <div>
                                <p>Controlled</p>
                                <p>Touch</p>
                            </div>
                        </div>
                        <div class="checkout">
                            <button>ADD TO CART</button>
                            <button>CHECKOUT</button>
                        </div>
                    </div>
                </div>
    
                <div class="item"><!--Item4-->
                    <img src="assets/images/img4.png">
                    <div class="introduce">
                        <div class="title">DEPURADOR</div>
                        <div class="topic">Pickit3</div>
                        <div class="des">
                            <!-- 20 lorem -->
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia, laborum cumque dignissimos quidem atque et eligendi aperiam voluptates beatae maxime.
                        </div>
                        <button class="seeMore">VER MAS &#8599</button>
                    </div>
                    <div class="detail">
                        <div class="title">Aerphone GHTK</div>
                        <div class="des">
                            <!-- lorem 50 -->
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor, reiciendis suscipit nobis nulla animi, modi explicabo quod corrupti impedit illo, accusantium in eaque nam quia adipisci aut distinctio porro eligendi. Reprehenderit nostrum consequuntur ea! Accusamus architecto dolores modi ducimus facilis quas voluptatibus! Tempora ratione accusantium magnam nulla tenetur autem beatae.
                        </div>
                        <div class="specifications">
                            <div>
                                <p>Used Time</p>
                                <p>6 hours</p>
                            </div>
                            <div>
                                <p>Charging port</p>
                                <p>Type-C</p>
                            </div>
                            <div>
                                <p>Compatible</p>
                                <p>Android</p>
                            </div>
                            <div>
                                <p>Bluetooth</p>
                                <p>5.3</p>
                            </div>
                            <div>
                                <p>Controlled</p>
                                <p>Touch</p>
                            </div>
                        </div>
                        <div class="checkout">
                            <button>ADD TO CART</button>
                            <button>CHECKOUT</button>
                        </div>
                    </div>
                </div>
    
                <div class="item"><!--Item5-->
                    <img src="assets/images/img5.png">
                    <div class="introduce">
                        <div class="title">PLACA DE DESARROLLO</div>
                        <div class="topic">ESP32 Devkit V1</div>
                        <div class="des">
                            <!-- 20 lorem -->
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia, laborum cumque dignissimos quidem atque et eligendi aperiam voluptates beatae maxime.
                        </div>
                        <button class="seeMore">VER MAS &#8599</button>
                    </div>
                    <div class="detail">
                        <div class="title">Aerphone GHTK</div>
                        <div class="des">
                            <!-- lorem 50 -->
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor, reiciendis suscipit nobis nulla animi, modi explicabo quod corrupti impedit illo, accusantium in eaque nam quia adipisci aut distinctio porro eligendi. Reprehenderit nostrum consequuntur ea! Accusamus architecto dolores modi ducimus facilis quas voluptatibus! Tempora ratione accusantium magnam nulla tenetur autem beatae.
                        </div>
                        <div class="specifications">
                            <div>
                                <p>Used Time</p>
                                <p>6 hours</p>
                            </div>
                            <div>
                                <p>Charging port</p>
                                <p>Type-C</p>
                            </div>
                            <div>
                                <p>Compatible</p>
                                <p>Android</p>
                            </div>
                            <div>
                                <p>Bluetooth</p>
                                <p>5.3</p>
                            </div>
                            <div>
                                <p>Controlled</p>
                                <p>Touch</p>
                            </div>
                        </div>
                        <div class="checkout">
                            <button>ADD TO CART</button>
                            <button>CHECKOUT</button>
                        </div>
                    </div>
                </div>
    
                <div class="item"><!--Item6-->
                    <img src="assets/images/img6.png">
                    <div class="introduce">
                        <div class="title">PLACA DE DESARROLLO</div>
                        <div class="topic">Raspberry Pi 4</div>
                        <div class="des">
                            <!-- 20 lorem -->
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia, laborum cumque dignissimos quidem atque et eligendi aperiam voluptates beatae maxime.
                        </div>
                        <button class="seeMore">VER MAS &#8599</button>
                    </div>
                    <div class="detail">
                        <div class="title">Aerphone GHTK</div>
                        <div class="des">
                            <!-- lorem 50 -->
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor, reiciendis suscipit nobis nulla animi, modi explicabo quod corrupti impedit illo, accusantium in eaque nam quia adipisci aut distinctio porro eligendi. Reprehenderit nostrum consequuntur ea! Accusamus architecto dolores modi ducimus facilis quas voluptatibus! Tempora ratione accusantium magnam nulla tenetur autem beatae.
                        </div>
                        <div class="specifications">
                            <div>
                                <p>Used Time</p>
                                <p>6 hours</p>
                            </div>
                            <div>
                                <p>Charging port</p>
                                <p>Type-C</p>
                            </div>
                            <div>
                                <p>Compatible</p>
                                <p>Android</p>
                            </div>
                            <div>
                                <p>Bluetooth</p>
                                <p>5.3</p>
                            </div>
                            <div>
                                <p>Controlled</p>
                                <p>Touch</p>
                            </div>
                        </div>
                        <div class="checkout">
                            <button>ADD TO CART</button>
                            <button>CHECKOUT</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="arrows"><!--En este bloque van las flechas-->
                <button id="prev"><</button><!--Boton de anterior-->
                <button id="next">></button><!--Boton de siguiente-->
                <button id="back">VER TODO  &#8599</button><!--Boton de retorno-->
            </div>
        </section>
        <!--Productos destacados-->
        <section class="Productos-destacados contenido">
            <h2 class="titulo">PRODUCTOS DESTACADOS</h2>
        </section>
        <section class="Ofertas contenido">
            <h2 class="titulo">OFERTAS!!</h2>
        </section>
        <section class="Tutoriales-destacados contenido">
            <h2 class="titulo">TUTORIALES DESTACADOS</h2>
        </section>
        <section class="Cursos-destacados contenido">
            <h2 class="titulo">CURSOS DESTACADOS</h2>
        </section>
        <section class="clientes contenido">
            <h2 class="titulo">NUESTROS CLIENTES</h2>
            <div class="carousel2" id="carousel2">
                <div class="elemento"><img src="./assets/images/ELECTROKIT.png" alt=""></div>
                <div class="elemento"><img src="./assets/images/PUCP.png" alt=""></div>
                <div class="elemento"><img src="./assets/images/TOU.png" alt=""></div>
                <div class="elemento"><img src="./assets/images/UNI.png" alt=""></div>
                <div class="elemento"><img src="./assets/images/UTEC.png" alt=""></div>
                <div class="elemento"><img src="./assets/images/UTP.jpg" alt=""></div>
            </div>
            <div class="botones">
                <button class="boton" id="izquierda">←</button>
                <button class="boton" id="derecha">→</button>
            </div>
        </section>
        <section class="tutorial-compra contenido">
            <h2>¿CÓMO COMPRAR?</h2>
            <div class="video-container">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/mw--PScFSiQ?si=7GE8JlRJzCleCUj-" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        </section>
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
    <script src="assets/js/script.js"></script>
</body>
</html>