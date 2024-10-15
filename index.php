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
    $resultado = [];
    include 'php/conexion_bd.php';
    $stmt = $conexion->prepare("SELECT * FROM Productos LIMIT 10");
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $resultado[] = $row; // Agrega cada fila al array $resultado
        }
    }
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
    <?php include './php/modulo/aside.php'; ?>
    <?php include BASE_PATH . '/php/modulo/encabezado.php'; ?>
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
        <section class="Productos-destacados">
            <h2 class="titulo">PRODUCTOS DESTACADOS</h2>
            <div class="flecha-grid_productos_destacados">
                <div class="grid_productos_destacados">
                </div>
                <div class="flechas">
                    <button class='prev_flecha prev_flecha-productos_destacados'><</button>
                    <button class="next_flecha next_flecha-productos_destacados">></button>
                </div>
                <div class="overlay">
                <div class="loader">
                    <div class="inner one"></div>
                    <div class="inner two"></div>
                    <div class="inner three"></div>
                </div>
            </div>
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
    <?php include './php/modulo/footer.php'; ?>
    <script src="assets/js/script.js"></script>
</body>
</html>