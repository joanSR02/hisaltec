<?php
    // Conexión a la base de datos
    include 'conexion_bd.php';
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
        $query = "SELECT * FROM Productos LIMIT $inicio, $limite";
        $resultado = $conexion->query($query);

        $productos = [];
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                // Verifica si el archivo de imagen existe
                $imagen='.' .$row['imagen_producto'];
                if(!file_exists($imagen)){
                    $imagen= "./assets/images/Productos/no_existe_producto.png";
                    $row['imagen_producto']=$imagen;
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
