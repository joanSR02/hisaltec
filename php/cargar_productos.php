<?php
    // Conexión a la base de datos
    include 'conexion_bd.php';
    include '../config.php';
    // Verifica si hay errores de conexión
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        /*Validar la cantidad de productos */
        $query = "SELECT COUNT(*) as total FROM Productos";
        $resultado = $conexion->query($query);
        if ($resultado && $resultado->num_rows > 0) {
            // Obtener el conteo de productos
            $fila = $resultado->fetch_assoc();
        }
        // Parámetros de paginación
        $limite = 10; // Número de productos por página
        $pagina = isset($_POST['pagina']) ? (int)$_POST['pagina'] : 1;// Página actual recibida desde JavaScript
        //Validar si debo bloquear el boton de next
        $bloquear_next_flecha = ($pagina * $limite >= $fila['total']);
        $inicio = ($pagina - 1) * $limite; // Calcula el inicio para la consulta SQL

        // Consulta para obtener los productos paginados
        /*$stmt = $conexion->prepare("SELECT p.*, GROUP_CONCAT(i.ruta_imagen SEPARATOR ';') AS imagenes FROM Productos p LEFT JOIN Productos_imagenes i ON p.id_producto = i.id_producto GROUP BY p.id_producto LIMIT ?, ?");*/
        $stmt = $conexion->prepare("SELECT p.*, GROUP_CONCAT(i.ruta_imagen ORDER BY i.id_productos_imagenes ASC SEPARATOR ';') AS imagen FROM Productos p LEFT JOIN Productos_imagenes i ON p.id_producto = i.id_producto GROUP BY p.id_producto LIMIT ?, ?");
        $stmt->bind_param("ii", $inicio, $limite);
        // Ejecuta la consulta
        $stmt->execute();
        // Obtén los resultados
        $result = $stmt->get_result();
        $productos=[];
        if ($result->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            while ($row = $result->fetch_assoc()) {
                $imagenes_array = explode(';', $row['imagen']);
                $ruta_predefinida = '/assets/images/Productos/no_existe_producto.png';
                $stmt = $conexion->prepare("SELECT precio FROM Productos_precio_cantidad WHERE id_producto = ? LIMIT 1");
                $stmt->bind_param("i", $row['id_producto']);
                // Ejecuta la consulta
                $stmt->execute();
                // Obtén el resultado
                $result2 = $stmt->get_result();
                if ($row2 = $result2->fetch_assoc()) {
                    $row['precio'] =  $row2['precio'];
                } else {
                    $row['precio'] =  "None";
                }
                if ($row['imagen']==NULL){
                    $row['imagen'] = BASE_URL . $ruta_predefinida;
                }else{
                    $image_path = BASE_PATH . '/' . ltrim(trim(reset($imagenes_array)), './');
                    if (!file_exists($image_path)) {
                        // Si no existe, agrega la ruta predefinida
                        $row['imagen'] =BASE_URL . $ruta_predefinida;
                    } else {
                        $row['imagen'] = BASE_URL . '/' . ltrim(trim(reset($imagenes_array)), './');
                    }
                } 
                $productos[] = $row;
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
