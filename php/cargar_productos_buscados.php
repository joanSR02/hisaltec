<?php
    // Conexión a la base de datos
    include 'conexion_bd.php';
    include '../config.php';
    // Verifica si hay errores de conexión
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['pagina']) && isset($_POST['q']) && isset($_POST['categoria'])) {
            $limite = 10;
            $pagina = (int)$_POST['pagina'];// Página actual recibida desde JavaScript
            $busqueda = $_POST['q'];
            $categoria = $_POST['categoria'];
            $total = (int)$_POST['total'];
            $inicio = ($pagina - 1) * $limite; // Calcula el inicio para la consulta SQL
            $bloquear_next_flecha = ($pagina * $limite >= $total);
            if ($categoria != "all"){
                list($categoriaPadre, $categoriaHija) = explode('|', $categoria);
                if ($categoriaPadre != ''){
                    $stmt = $conexion->prepare("SELECT p.*,MIN(pi.ruta_imagen) AS imagen,MIN(ppc.precio) AS precio FROM Productos p LEFT JOIN Productos_imagenes pi ON pi.id_producto=p.id_producto LEFT JOIN Productos_precio_cantidad ppc ON pi.id_producto=p.id_producto LEFT JOIN Producto_Categoria pc ON p.id_producto = pc.id_producto LEFT JOIN Categorias c ON pc.id_categoria = c.id_categoria LEFT JOIN  Categoria_CategoriaPadre ccp ON c.id_categoria = ccp.id_categoria LEFT JOIN CategoriasPadre cp ON ccp.id_CategoriaPadre = cp.id_categoriapadre WHERE REPLACE(p.nombre_producto, ' ', '') LIKE CONCAT('%', REPLACE(?, ' ', ''), '%') AND REPLACE(c.nombre_categoria, ' ', '') LIKE CONCAT('%', REPLACE(?, ' ', ''), '%') AND REPLACE(cp.nombre_categoriapadre, ' ', '') LIKE CONCAT('%', REPLACE(?, ' ', ''), '%') GROUP BY p.id_producto LIMIT ?, ?");
                    $stmt->bind_param('sssii', $busqueda, $categoriaHija, $categoriaPadre, $inicio, $limite);
                }else{
                    $stmt = $conexion->prepare("SELECT p.*,MIN(pi.ruta_imagen) AS imagen,MIN(ppc.precio) AS precio FROM Productos p LEFT JOIN Productos_imagenes pi ON pi.id_producto=p.id_producto LEFT JOIN Productos_precio_cantidad ppc ON pi.id_producto=p.id_producto LEFT JOIN Producto_Categoria pc ON p.id_producto = pc.id_producto LEFT JOIN Categorias c ON pc.id_categoria = c.id_categoria LEFT JOIN  Categoria_CategoriaPadre ccp ON c.id_categoria = ccp.id_categoria LEFT JOIN CategoriasPadre cp ON ccp.id_CategoriaPadre = cp.id_categoriapadre WHERE REPLACE(p.nombre_producto, ' ', '') LIKE CONCAT('%', REPLACE(?, ' ', ''), '%') AND REPLACE(c.nombre_categoria, ' ', '') LIKE CONCAT('%', REPLACE(?, ' ', ''), '%') GROUP BY p.id_producto LIMIT ?, ?");
                    $stmt->bind_param('ssii', $busqueda, $categoriaHija, $inicio, $limite);
                }
            }else{
                $stmt = $conexion->prepare("SELECT p.*,MIN(pi.ruta_imagen) AS imagen,MIN(ppc.precio) AS precio FROM Productos p LEFT JOIN Productos_imagenes pi ON pi.id_producto=p.id_producto LEFT JOIN Productos_precio_cantidad ppc ON pi.id_producto=p.id_producto LEFT JOIN Producto_Categoria pc ON p.id_producto = pc.id_producto LEFT JOIN Categorias c ON pc.id_categoria = c.id_categoria LEFT JOIN  Categoria_CategoriaPadre ccp ON c.id_categoria = ccp.id_categoria LEFT JOIN CategoriasPadre cp ON ccp.id_CategoriaPadre = cp.id_categoriapadre WHERE REPLACE(p.nombre_producto, ' ', '') LIKE CONCAT('%', REPLACE(?, ' ', ''), '%') OR REPLACE(c.nombre_categoria, ' ', '') LIKE CONCAT('%', REPLACE(?, ' ', ''), '%') OR REPLACE(cp.nombre_categoriapadre, ' ', '') LIKE CONCAT('%', REPLACE(?, ' ', ''), '%') GROUP BY p.id_producto LIMIT ?, ?");
                $stmt->bind_param('sssii', $busqueda, $busqueda, $busqueda, $inicio, $limite);
            }
            if ($stmt === false) {
                exit();
            }
            if ($stmt->execute()) {
                // Obtén los resultados
                $result = $stmt->get_result();
                $productos=[];
                if ($result->num_rows > 0) {
                    $ruta_predefinida = '/assets/images/Productos/no_existe_producto.png';
                    while ($row = $result->fetch_assoc()) {
                        if ($row['imagen']==NULL){
                            $row['imagen'] = BASE_URL . $ruta_predefinida;
                        }else{
                            $image_path = BASE_PATH . '/' . $row['imagen'];
                            if (!file_exists($image_path)) {
                                // Si no existe, agrega la ruta predefinida
                                $row['imagen'] =BASE_URL . $ruta_predefinida;
                            } else {
                                $row['imagen'] = BASE_URL . '/' . $row['imagen'];
                            }
                        } 
                        $productos[] = $row;
                    }
                }
            }
        }
        $respuesta = [
            'productos' => $productos,
            'bloquear_next_flecha' => $bloquear_next_flecha
        ];
        echo json_encode($respuesta);
        $conexion->close();
    }
?>
