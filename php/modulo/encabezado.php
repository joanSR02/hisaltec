<header>
    <div class="hero_1">
        <div class="contenedor">
            <nav>
                <ul>
                    <li>
                        <a href="<?= BASE_URL . '/'?>">Inicio</a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL . '/Sobre_nosotros.php'?>">Sobre nosotros</a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL . '/Preguntas_frecuentes.php'?>">Preguntas frecuentes</a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL . '/Contacto.php'?>">Contacto</a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL . '/Blog.php'?>">Blog</a>
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
                <img src="<?= BASE_URL . '/assets/images/logo.png'; ?>" alt="Logo" style="height: 50px;">
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
            <img src="<?= BASE_URL . '/assets/images/logo.png'; ?>" alt="Logo" style="height: 50px;">

            <!--Buscador (temporal)-->
            <form class="search-container" action="buscador.php" method="GET">
                <input type="search" name="q" placeholder="Search here" class="search-input">
                <select class="category-select" name="categoria">
                    <option value="all">TODAS</option>
                    <?php
                        $stmt = $conexion->prepare("SELECT GROUP_CONCAT(c.nombre_categoria SEPARATOR ',') AS nombre_categoria, cp.nombre_categoriapadre FROM Categorias c LEFT JOIN Categoria_CategoriaPadre ccp ON ccp.id_categoria = c.id_categoria LEFT JOIN CategoriasPadre cp ON cp.id_categoriapadre = ccp.id_categoriapadre WHERE cp.nombre_categoriapadre IS NOT NULL GROUP BY cp.nombre_categoriapadre UNION ALL SELECT c.nombre_categoria, cp.nombre_categoriapadre FROM Categorias c LEFT JOIN Categoria_CategoriaPadre ccp ON ccp.id_categoria = c.id_categoria LEFT JOIN CategoriasPadre cp ON cp.id_categoriapadre = ccp.id_categoriapadre WHERE cp.nombre_categoriapadre IS NULL ORDER BY IF(nombre_categoriapadre IS NULL, 1, 2) ASC");
                        if ($stmt->execute()) {
                            $resultado = $stmt->get_result();
                            while ($fila = $resultado->fetch_assoc()) {
                                if (is_null($fila['nombre_categoriapadre'])) {?>
                                    <option value="|<?= htmlspecialchars($fila['nombre_categoria']) ?>"><?= htmlspecialchars($fila['nombre_categoria']) ?></option>
                                <?php } else {
                                    $array_nombre_categoria = explode(",", $fila['nombre_categoria']);?>
                                    <optgroup label=<?= htmlspecialchars($fila['nombre_categoriapadre']) ?>>
                                    <option value="<?= htmlspecialchars($fila['nombre_categoriapadre']) ?>|">TODO <?= htmlspecialchars($fila['nombre_categoriapadre']) ?></option>
                                    <?php foreach ($array_nombre_categoria as $categoria) { ?>
                                        <option value="<?= htmlspecialchars($fila['nombre_categoriapadre']) ?>|<?= htmlspecialchars($categoria) ?>"><?= htmlspecialchars($categoria) ?></option>
                                    <?php } ?>
                                <?php }
                            }
                        }
                    ?>
                </select>
                <button class="search-button">
                    <span class="material-icons-sharp search-icon">
                        search
                    </span>
                </button>
            </form>
            <!----------------------->
            <div class="login_register">
                <?php
                    if (isset($usuario_id)) {
                        echo '
                        <div class="user-menu">
                            <img src=' . $image_src . ' alt="Foto de usuario" class="user-photo" onclick="toggleMenu()">
                            <div id="user-dropdown" class="dropdown-content">
                                <ul>
                                    <li><a href="perfil_editar.php">Mi Cuenta</a></li>
                                    <li onclick="cerrar_sesion()"><p>Salir</p></li>
                                </ul>
                            </div>
                        </div>';
                    }else{
                        echo '<span class="material-icons-sharp">
                            person
                        </span>
                        <a href="' . BASE_URL . '/inisesion.php">INGRESA/REGISTRATE</a>';
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
                <div class="favoritos">
                    <span class="material-icons-sharp">
                        favorite
                    </span>
                    <?php
                        if (isset($_SESSION['usuario_id'])) { ?>
                            <span class="icon-favoritos-counter"><?= $_SESSION['cantidad_favoritos'] ?></span>
                        <?php } else{ ?>
                            <span class="icon-favoritos-counter">0</span>
                        <?php }
                    ?>
                </div>
                <div class="compras">
                    <span class="material-icons-sharp">
                        shopping_cart
                    </span>
                    <?php
                        if (isset($_SESSION['usuario_id'])) { ?>
                            <span class="icon-compras-counter"><?= $_SESSION['cantidad_carrito'] ?></span>
                        <?php } else{ ?>
                            <span class="icon-compras-counter">0</span>
                        <?php }
                    ?>
                </div>
            </div>
        </div>
    </div>
</header>