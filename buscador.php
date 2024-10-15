<?php
    include 'php/conexion_bd.php';
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
    // Recoger parámetros de la URL
    $busqueda = isset($_GET['q']) ? $_GET['q'] : '';
    $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : 'all';
    if ($categoria != "all"){
        list($categoriaPadre, $categoriaHija) = explode('|', $categoria);
        if ($categoriaPadre != ''){
            $stmt = $conexion->prepare("SELECT COUNT(DISTINCT  p.id_producto) AS total FROM Productos p LEFT JOIN Producto_Categoria pc ON p.id_producto = pc.id_producto LEFT JOIN Categorias c ON pc.id_categoria = c.id_categoria LEFT JOIN  Categoria_CategoriaPadre ccp ON c.id_categoria = ccp.id_categoria LEFT JOIN CategoriasPadre cp ON ccp.id_CategoriaPadre = cp.id_categoriapadre WHERE REPLACE(p.nombre_producto, ' ', '') LIKE CONCAT('%', REPLACE(?, ' ', ''), '%') AND REPLACE(c.nombre_categoria, ' ', '') LIKE CONCAT('%', REPLACE(?, ' ', ''), '%') AND REPLACE(cp.nombre_categoriapadre, ' ', '') LIKE CONCAT('%', REPLACE(?, ' ', ''), '%')");
            $stmt->bind_param('sss', $busqueda, $categoriaHija, $categoriaPadre);
        }else{
            $stmt = $conexion->prepare("SELECT COUNT(DISTINCT  p.id_producto) AS total FROM Productos p  LEFT JOIN Producto_Categoria pc ON p.id_producto = pc.id_producto LEFT JOIN Categorias c ON pc.id_categoria = c.id_categoria LEFT JOIN  Categoria_CategoriaPadre ccp ON c.id_categoria = ccp.id_categoria LEFT JOIN CategoriasPadre cp ON ccp.id_CategoriaPadre = cp.id_categoriapadre WHERE REPLACE(p.nombre_producto, ' ', '') LIKE CONCAT('%', REPLACE(?, ' ', ''), '%') AND REPLACE(c.nombre_categoria, ' ', '') LIKE CONCAT('%', REPLACE(?, ' ', ''), '%')");
            $stmt->bind_param('ss', $busqueda, $categoriaHija);
        }
    }else{
        $stmt = $conexion->prepare("SELECT COUNT(DISTINCT  p.id_producto) AS total FROM Productos p LEFT JOIN Producto_Categoria pc ON p.id_producto = pc.id_producto LEFT JOIN Categorias c ON pc.id_categoria = c.id_categoria LEFT JOIN  Categoria_CategoriaPadre ccp ON c.id_categoria = ccp.id_categoria LEFT JOIN CategoriasPadre cp ON ccp.id_CategoriaPadre = cp.id_categoriapadre WHERE REPLACE(p.nombre_producto, ' ', '') LIKE CONCAT('%', REPLACE(?, ' ', ''), '%') OR REPLACE(c.nombre_categoria, ' ', '') LIKE CONCAT('%', REPLACE(?, ' ', ''), '%') OR REPLACE(cp.nombre_categoriapadre, ' ', '') LIKE CONCAT('%', REPLACE(?, ' ', ''), '%')");
        $stmt->bind_param('sss', $busqueda, $busqueda, $busqueda);
    }
    if ($stmt === false) {
        exit();
    }
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $total = $result->fetch_assoc()['total'];
    }

?>
<!DOCTYPE html>
<html lang="es" class="buscador">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/estilo_cargar_productos_buscados.css">
    <title>Document</title>
</head>
<body>
    <div id="total" data-total="<?php echo $total; ?>"></div>
    <?php include BASE_PATH . '/php/modulo/aside.php'?>
    <?php include BASE_PATH . '/php/modulo/encabezado.php'?>
    <main>
        <section class="Productos">
            <h2 class="titulo">PRODUCTOS</h2>
            <div class="flecha-grid_productos">
                <div class="grid_productos">
                </div>
                <div class="flechas">
                    <button class='prev_flecha prev_flecha-productos'><</button>
                    <button class="next_flecha next_flecha-productos">></button>
                </div>
                <div class="overlay">
                <div class="loader">
                    <div class="inner one"></div>
                    <div class="inner two"></div>
                    <div class="inner three"></div>
                </div>
            </div>
        </section>
    </main>
    <?php include './php/modulo/footer.php'?>
    <script src="assets/js/script.js"></script>
</body>
</html>