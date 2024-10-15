<aside>
    <div class="menu_sidebar">
        <img src="<?= BASE_URL . '/assets/images/logo.png'?>" alt="">
        <span class="material-icons-sharp">
            close
        </span>
    </div>
    <nav class="navegacion">
        <ul>
            <li>
                <a href="<?= BASE_URL . '/'?>"><span class="material-icons-sharp">home</span><span class="texto-sidebar">Inicio</span></a>
            </li>
            <li>
                <a href="<?= BASE_URL . '/Sobre_nosotros.php'?>"><span class="material-icons-sharp">people</span><span class="texto-sidebar">Sobre nosotros</span></a>
            </li>
            <li>
                <a href="<?= BASE_URL . '/Preguntas_frecuentes.php'?>"><span class="material-icons-sharp">question_answer</span><span class="texto-sidebar">Preguntas frecuentes</span></a>
            </li>
            <li>
                <a href="<?= BASE_URL . '/Contacto.php'?>"><span class="material-icons-sharp">connect_without_contact</span><span class="texto-sidebar">Contacto</span></a>
            </li>
            <li>
                <a href="<?= BASE_URL . '/Blog.php'?>"><span class="material-icons-sharp">feed</span><span class="texto-sidebar">Blog</span></a>
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
        <div class="login_register">
            <?php
                if (isset($usuario_id)) {
                    echo '<img src=' . $image_src . ' alt="">
                    <div class="info-usuario">
                        <div class="nombre-email">
                            <span class="texto-sidebar nombre">' . htmlspecialchars($nombre) . '</span>
                            <span class="email">' . htmlspecialchars($correo) . '</span>
                        </div>
                        <div class="user-menu_aside">
                            <span class="material-icons-sharp" onclick="toggleMenu_aside()">more_vert</span>
                                <div id="user-dropdown" class="dropdown-content_aside">
                                <ul>
                                    <li><a href="perfil_editar.php">Mi Cuenta</a></li>
                                    <li onclick="cerrar_sesion()"><p>Salir</p></li>
                                </ul>
                            </div>
                        </div>
                    </div>';
                }else{
                    echo '<span class="material-icons-sharp">person</span>
                    <a href="./inisesion.php">INGRESA/REGISTRATE</a>';
                }
            ?>
        </div>
    </div>
</aside>