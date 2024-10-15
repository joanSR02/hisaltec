<?php
    include '../config.php';
    session_start();
    if (isset($_SESSION['usuario_id'])) {
        $usuario_id = $_SESSION['usuario_id'];
        $direccion_foto = $_SESSION['usuario_foto'];
        $correo = $_SESSION['usuario_correo'];
        $nombre = $_SESSION['usuario_nombre'];
        $image_path = BASE_PATH . '/php/' . ltrim($direccion_foto, './');
        $image_url = BASE_URL . '/php/' . ltrim($direccion_foto, './');
        // Verifica si el archivo de imagen existe
        if (file_exists($image_path)) {
            $image_src = htmlspecialchars($image_url);
        } else {
            $image_src = BASE_PATH  .'/php/fotos_usuarios/user.png'; // Imagen por defecto
        }
    }
    $id_producto = $_GET['id'];
    include BASE_PATH .'/php/conexion_bd.php';
    $stmt = $conexion->prepare("SELECT p.*, GROUP_CONCAT(i.ruta_imagen SEPARATOR ';') AS imagenes FROM Productos p LEFT JOIN Productos_imagenes i ON p.id_producto = i.id_producto WHERE p.id_producto = ?");
    $stmt->bind_param("i", $id_producto);
    if ($stmt->execute()) {
        $result_producto = $stmt->get_result();
        if ($result_producto->num_rows > 0) {
            $producto = $result_producto->fetch_assoc();
        }else {
            echo "No se encontró el producto.";
        }
    }else {
        echo "Error al ejecutar la consulta.";
    }
    $imagenes_cadena = $producto['imagenes'];
    $imagenes_array = explode(';', $imagenes_cadena);
    $ruta_predefinida = '/assets/images/Productos/no_existe_producto.png';
    // Recorrer cada imagen en el array
    foreach ($imagenes_array as $key => $imagen) {
        // Verifica si la ruta de la imagen existe
        $image_path = BASE_PATH . '/' . ltrim(trim($imagen), './');
        // Comprobar si la imagen existe
        if ($imagen==NULL){
            $imagenes_array[$key] = BASE_URL . $ruta_predefinida;
        } else if (!file_exists($image_path)) {
            // Si no existe, agrega la ruta predefinida
            $imagenes_array[$key] = BASE_URL . $ruta_predefinida;
        } else {
             $imagenes_array[$key] = BASE_URL . '/' . ltrim(trim($imagen), './');
        }
    }
?>
<!DOCTYPE html>
<html lang="es" class="Producto">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL . '/assets/css/estilo_Producto.css'; ?>">
    <title>Document</title>
</head>
<body>
    <?php include BASE_PATH .'/php/modulo/aside.php'; ?>
    <?php include BASE_PATH .'/php/modulo/encabezado.php'; ?>
    <main>
        <section class="producto">
            <div class="galeria">
                <div class="miniaturas">
                    <?php foreach ($imagenes_array as $imagen){ ?>
                        <div class="imagen_miniatura-fondo">
                            <div class="imagen_miniatura">
                                <img src="<?= $imagen ?>" alt="Miniatura" onclick="cambiarImagen(this)">
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <figure class="imagen-principal">
                    <img id="imagenPrincipal" src="<?= reset($imagenes_array); ?>" alt="">
                </figure>
            </div>
            <div class="informacion">
                <div class="informacion_producto">
                    <?php
                        $stmt = $conexion->prepare("SELECT * FROM Productos_precio_cantidad WHERE id_producto = ?");
                        $stmt->bind_param("i", $id_producto);
                        $cantidad_precios = [];
                        if ($stmt->execute()) {
                            $result = $stmt->get_result();
                            $cantidad_precios = [];
                            while ($row = $result->fetch_assoc()) {
                                $cantidad = $row['cantidad'];
                                $precio = $row['precio'];
                                $cantidad_precios[$cantidad] = $precio;
                            }
                            // Verificar si se encontraron resultados
                            if (empty($cantidad_precios)) {
                                echo "No se encontraron precios.";
                            }
                        }else {
                            // Manejar el error si la ejecución de la consulta falla
                            echo "Error al ejecutar la consulta: " . $stmt->error;
                        }
                    ?>
                    <h1><?php echo $producto['nombre_producto'];?></h1>
                    <span><bdi><span class="moneda_producto">S/</span><span id="precio"><?php echo reset($cantidad_precios); ?></span></bdi></span>
                    <?php
                        $stmt = $conexion->prepare("SELECT AVG(estrellas) AS promedio_estrellas FROM Comentarios WHERE id_producto = ?");
                        $stmt->bind_param("i", $id_producto);
                        if ($stmt->execute()) {
                            $result_comentarios = $stmt->get_result();
                            if ($row = $result_comentarios->fetch_assoc()) {
                                $promedio_estrellas = $row['promedio_estrellas'];
                            }else{
                                $promedio_estrellas = 0;
                            }
                        }
                    ?>
                    <div class="rating">
                        <?php if ($promedio_estrellas == 0){?>
                            <p>Sin calificación</p>
                        <?php } else { ?>
                            <p>(<?php echo round($promedio_estrellas, 1);?> estrellas)</p>
                            <?php
                            $estrellas_on = round($promedio_estrellas); // Número de estrellas completas
                            $estrellas_off = 5 - $estrellas_on;
                            // Mostrar estrellas completas
                            for ($i = 1; $i <= $estrellas_off; $i++) {?>
                                <span class="empty">★</span>
                            <?php }
                            for ($i = 1; $i <= $estrellas_on; $i++) {?>
                                <span class="filled">★</span>
                            <?php } 
                        } ?>
                    </div>
                    <div class="stock">
                        <span class="material-icons-sharp">inventory</span>
                        <p>En Stock</p>
                    </div>
                    <form id="form_carrito" method="POST" data-producto-id="<?= $id_producto; ?>">
                        <div class="cantidad_producto">
                            <input type="button" value="-" id="menos_cantidad_producto">
                            <input type="number" id="cantidad" min="1" max=<?php echo $producto['stock'];?> value="1" placeholder inputmode="numeric" size="4">
                            <input type="button" value="+" id="mas_cantidad_producto">
                        </div>
                        <button type="submit">Agregar al carrito</button>
                    </form>
                    <div class="precio_por_cantidad">
                        <table>
                            <thead>
                                <tr>
                                    <th>Cantidad</th>
                                    <th>Precio/unidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($cantidad_precios as $cantidad => $precio) { ?>
                                        <tr>
                                            <td>≥ <?= $cantidad; ?></td>
                                            <td>S/ <?= $precio; ?></td>
                                        </tr>
                                    <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <div class="iconos_informacion_producto">
                            <?php
                                if (isset($_SESSION['usuario_id'])) {
                                    $stmt = $conexion->prepare("SELECT * FROM Productos_favoritos WHERE id_usuario = ? AND id_producto = ?");
                                    $stmt->bind_param("ii", $usuario_id,$id_producto);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    if ($result->num_rows > 0) { ?>
                                        <div class="agregar_favorito_producto activar" data-producto-id="<?= $id_producto; ?>">
                                            <span class="material-icons-sharp">favorite</span>Agregar a favoritos<span></span>
                                        </div>
                                    <?php }else{ ?>
                                        <div class="agregar_favorito_producto" data-producto-id="<?= $id_producto; ?>">
                                            <span class="material-icons-sharp">favorite_border</span>Agregar a favoritos<span></span>
                                        </div>
                                    <?php }
                                }else{ ?>
                                    <div class="agregar_favorito_producto" data-producto-id="<?= $id_producto; ?>">
                                        <span class="material-icons-sharp">favorite_border</span>Agregar a favoritos<span></span>
                                    </div>
                                <?php }
                            ?>
                            <div class="comparar_producto">
                                <span class="material-icons-sharp">compare_arrows</span>Comparar similares<span></span>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="compartir_producto-SKU">
                    <div class="SKU">
                        <p>SKU:</p>
                    </div>
                    <div class="compartir_producto">
                        <p>Compartir: </p>
                        <div class="social-icons">
                            <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#" class="icon"><i class="fa-brands fa-x-twitter"></i></a>
                            <a href="#" class="icon"><i class="fa-brands fa-square-pinterest"></i></a>
                            <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                            <a href="#" class="icon"><i class="fa-brands fa-telegram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script>
            // Generar el JSON directamente en la página
            let precios = <?php echo json_encode($cantidad_precios); ?>;
            const cantidadInput = document.getElementById('cantidad');
            const precioSpan = document.getElementById('precio');
            let minValue = parseInt(cantidadInput.min);
            let maxValue = parseInt(cantidadInput.max);
            function obtenerPrecioAdecuado(cantidad) {
                let precioAdecuado = 0;
                
                // Recorremos las cantidades disponibles en 'precios'
                for (let key in precios) {
                    // Convertimos la clave a número para comparaciones
                    let keyAsNumber = parseInt(key);

                    // Si la clave (cantidad) es menor o igual a la cantidad seleccionada por el usuario
                    if (keyAsNumber <= cantidad) {
                        // Actualizamos el precio adecuado a esta clave
                        precioAdecuado = precios[keyAsNumber];
                    }
                }

                // Retornamos el precio adecuado
                return precioAdecuado;
            }
            function actualizarPrecio() {
                const cantidad = parseInt(cantidadInput.value);
                const precioAdecuado = obtenerPrecioAdecuado(cantidad);
                console.log(precioAdecuado)
                precioSpan.textContent = precioAdecuado;
            }
            document.getElementById('mas_cantidad_producto').addEventListener("click",()=>{
                let currentValue = parseInt(cantidadInput.value);
                if (currentValue < maxValue) {
                    cantidadInput.value = currentValue + 1;
                    actualizarPrecio();
                }
            });
            document.getElementById('menos_cantidad_producto').addEventListener("click",()=>{
                let currentValue = parseInt(cantidadInput.value);
                if (currentValue > minValue) {
                    cantidadInput.value = currentValue - 1;
                    actualizarPrecio();
                }
            });
            cantidadInput.addEventListener('input', function() {
                console.log(cantidadInput.value)
                if (cantidadInput.value >= minValue && cantidadInput.value <= maxValue) {
                    actualizarPrecio();
                } else if (cantidadInput.value ==""){
                    cantidadInput.value = minValue;
                }
            });
        </script>
        <section class="descripcion-especificacion-documentacion">
            <nav>
                <a href="#">Descripción<span class="indicador"></span></a>
                <a href="#">Especificaciones Técnicas<span class="indicador"></span></a>
                <a href="#">Documentación<span class="indicador"></span></a>
            </nav>
            <div class="descripcion contenido">
                <p>La tarjeta de desarrollo Uno R3 está basada en un microcontrolador Atmega328. Tiene 14 pines de entrada/salidas digitales (de los cuales 6 pueden ser utilizados para salidas PWM), 6 entradas análogas, un cristal de 16 MHz, un conector para USB tipo hembra, un Jack para fuente de Poder, un conector ICSP y un botón de reset.</p>
                <h3>Características</h3>
                <ul>
                    <li>
                        <p>Protocolo USB completo manejado en el chip: no se requiere programación de firmware específica de USB.</p>
                    </li>
                    <li>
                        <p>Protocolo USB completo manejado en el chip: no se requiere programación de firmware específica de USB.</p>
                    </li>
                    <li>
                        <p>Protocolo USB completo manejado en el chip: no se requiere programación de firmware específica de USB.</p>
                    </li>
                </ul>
                <h3>Aplicaciones Frecuentes:</h3>
                <ul>
                    <li>
                        <p>Protocolo USB completo manejado en el chip: no se requiere programación de firmware específica de USB.</p>
                    </li>
                    <li>
                        <p>Protocolo USB completo manejado en el chip: no se requiere programación de firmware específica de USB.</p>
                    </li>
                    <li>
                        <p>Protocolo USB completo manejado en el chip: no se requiere programación de firmware específica de USB.</p>
                    </li>
                </ul>
            </div>
            <div class="especificaciones contenido">
                <table>
                    <thead>
                        <tr>
                            <th>Caracteristica</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>peso</td>
                            <td>4gr</td>
                        </tr>
                        <tr>
                            <td>Dimensiones</td>
                            <td>43 x 17 mm</td>
                        </tr>
                        <tr>
                            <td>velocidad</td>
                            <td>960db</td>
                        </tr>
                    </tbody>
                    <thead>
                        <tr>
                            <th>Caracteristica</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>peso</td>
                            <td>4gr</td>
                        </tr>
                        <tr>
                            <td>Dimensiones</td>
                            <td>43 x 17 mm</td>
                        </tr>
                        <tr>
                            <td>velocidad</td>
                            <td>960db</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="documentacion contenido">
                <table>
                    <thead>
                        <tr>
                            <th>Tipo de documento</th>
                            <th>Enlace</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Datasheet</td>
                            <td>
                                <a href="path/to/yourfile.pdf" download="yourfile.pdf" class="btn-download">Descargar PDF</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <section class="comentar-comentarios">
            <h2 class="titulo">Comentarios</h2>
            <div class="contenido">
                <div class="comentar">
                    <?php if (isset($usuario_id)){ ?>
                        <h2>Deja un comentario</h2>
                        <form method="POST" id="form_comentar">
                            <div class="rating">
                                <p>Valoranos 😊</p>
                                <input type="radio" id="star5" name="rating" value="5"><!--type="radio" es cuando los usuarios seleccionan una opcion de un conjunto de opciones mutuamente excluyentes, El atributo id proporciona un identificador único para este input en el documento. Es útil para asociar este input con una etiqueta label correspondiente,  El atributo name agrupa todos los botones de radio que tienen el mismo nombre, permitiendo que solo uno de ellos esté seleccionado en un momento dado. value="5": Define el valor que será enviado al servidor cuando este botón de radio esté seleccionado y el formulario sea enviado. Aquí, el valor es "5", lo que representa una calificación de 5 estrellas.-->
                                <label for="star5" title="5 estrellas">★</label>
                                <input type="radio" id="star4" name="rating" value="4">
                                <label for="star4" title="4 estrellas">★</label>
                                <input type="radio" id="star3" name="rating" value="3">
                                <label for="star3" title="3 estrellas">★</label>
                                <input type="radio" id="star2" name="rating" value="2">
                                <label for="star2" title="2 estrellas">★</label>
                                <input type="radio" id="star1" name="rating" value="1">
                                <label for="star1" title="1 estrellas">★</label>
                            </div>
                            <div class="comentar_button">
                                <textarea name="caja_comentar" rows="5" placeholder="Escribe tu comentario aquí..." required></textarea>
                                <input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>">
                                <div class="contenedor_button_comentar">
                                    <button type="submit">Enviar</button>
                                </div>
                            </div>
                        </form>
                    <?php } else{ ?>
                        <p>Para calificar este producto debes <a href="login.php" class="highlight">iniciar sesión</a>.</p>
                    <?php } ?>
                </div>
                <hr>
                <div class="comentarios">
                    <h2>Comentarios</h2>
                    <?php
                        $stmt = $conexion->prepare("SELECT * FROM Comentarios WHERE id_producto=? ORDER BY id_comentario DESC");
                        $stmt->bind_param("i", $id_producto);
                        if ($stmt->execute()) {
                            $result_comentarios = $stmt->get_result();
                            if ($result_comentarios->num_rows > 0) {
                                $comentarios = $result_comentarios->fetch_all(MYSQLI_ASSOC);
                                foreach ($comentarios as $comentario) {?>
                                    <div class="comentario">
                                        <?php
                                            $stmt = $conexion->prepare("SELECT foto FROM clientes WHERE id = ?");
                                            $stmt->bind_param("i", $comentario["id_cliente"]);
                                            if ($stmt->execute()) {
                                                $result = $stmt->get_result();
                                                if ($row = $result->fetch_assoc()) {
                                                    $direccion_foto = $row['foto'];  // Aquí tienes el valor de la columna 'foto'
                                                    $image_path = BASE_PATH . '/php/' . ltrim($direccion_foto, './');
                                                    $image_url = BASE_URL . '/php/' . ltrim($direccion_foto, './');
                                                    // Verifica si el archivo de imagen existe
                                                    if (file_exists($image_path)) {
                                                        $image_src = htmlspecialchars($image_url);
                                                    } else {
                                                        $image_src = BASE_PATH  .'/php/fotos_usuarios/user.png'; // Imagen por defecto
                                                    }
                                                } else {
                                                    echo "No se encontró la foto del cliente.";
                                                }
                                            }else {
                                                echo "Error al ejecutar la consulta.";
                                            }
                                        ?>
                                        <div class="foto_comentario">
                                            <img src="<?php echo $image_src; ?>" alt="">
                                        </div>
                                        <div class="stars_texto">
                                            <div class="rating">
                                                <?php for ($i = 5; $i >= 1; $i--): ?><!--Bucle for de 5 a 1-->
                                                    <span class="<?php echo $i <= $comentario["estrellas"] ? 'filled' : 'empty'; ?>">★</span><!--Si el valor de la iteración actual ($i) es menor o igual a la cantidad de estrellas que tiene el comentario, se aplica la clase filled, y si el valor de $i es mayor que la cantidad de estrellas, se aplica la clase empty.-->
                                                <?php endfor; ?>
                                            </div>
                                            <div class="texto">
                                                <p><?php echo $comentario["comentario"]; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                <?php }
                            }else { ?>
                                <p>Sin comentarios, podrías ser el primero en comentar 🤓</p>
                            <?php }
                        }else {
                            echo "Error al ejecutar la consulta.";
                        }
                    ?>
                </div>
            </div>
        </section>
        <div class="contenedor-toast" id="contenedor-toast"></div>
    </main>
    <?php include BASE_PATH .'/php/modulo/footer.php'; ?>
    <script src="<?= BASE_URL . '/assets/js/script.js'; ?>"></script>
</body>
</html>