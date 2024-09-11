let nextButton = document.getElementById('next');/*let Es una palabra clave en JavaScript que se utiliza para declarar una variable local dentro del ámbito en el que se está ejecutando el código. */
/*getElementById es un método del objeto document y devuelve un único elemento del documento que coincida con el ID especificado*/
let prevButton = document.getElementById('prev');
let carousel = document.querySelector('.carousel');/*querySelector es un  método del objeto document que permite seleccionar y devolver el primer elemento dentro del documento que coincida con el selector CSS (clase) especificado*/
let listHTML = document.querySelector('.carousel .list');
let seeMoreButtons = document.querySelectorAll('.seeMore');/*querySelectorAll Es un método del objeto document que permite seleccionar y devolver todos los elementos dentro del documento que coincidan con el selector CSS especificado, en este caso, '.seeMore'. Esto significa que buscará todos los elementos que tengan la clase .seeMore en el documento.*/
let backButton = document.getElementById('back');
const palancas = document.querySelectorAll(".switch");
const circulos = document.querySelectorAll(".circulo");
const menu = document.querySelector(".icono-menu");
const aside = document.querySelector("aside");
const menu_sidebar = document.querySelector(".menu_sidebar");
function Index(){
    const listcarousel2 = document.querySelector('.carousel2');
    let elementos = Array.from(document.querySelectorAll('.elemento'));
    const anchoElemento = elementos[0].offsetWidth + 20; // Incluye margen
    /* .onclick es un evento en JavaScript que se utiliza para asignar una función que se ejecutará cuando se haga clic en el elemento al que se ha vinculado.*/
    nextButton.onclick = function(){/*En este caso, esta función llama a otra función llamada showSlider y pasa 'next' como argumento a showSlider.*/
        showSlider('next');
    }
    prevButton.onclick = function(){
        showSlider('prev');
    }
    let unAcceppClick;/*Declaramos la variable  unAcceppClick*/
    const showSlider = (type) => {/*(type) => { ... }: Es una función flecha que toma un parámetro type. Esta sintaxis es una forma compacta de definir funciones en JavaScript. type es un parametro de la funcion showSlider e la dirección o tipo de acción que se realizará en el carrusel*/
        /*Desactiva los eventos tipo puntero*/
        nextButton.style.pointerEvents = 'none';
        prevButton.style.pointerEvents = 'none';
        /*elimina las clases CSS next y prev del elemento carousel, lo cual puede ser parte de un mecanismo de animación o transición.*/
        carousel.classList.remove('next', 'prev');/*Eliminamos las clases next y prev de carousel */
        let items = document.querySelectorAll('.carousel .list .item');/*seleccionamos todos los items de nuestro elemento carousel*/
        if(type === 'next'){/*Identifica el boton que presionaste, si presionaste next se ejecuta esto*/
            listHTML.appendChild(items[0]);/*Es la lista donde estan los items,  selecciona al primer hijo y lo agrega al final de la lista*/
            carousel.classList.add('next');/*A carousel se le agrega la clase next */
        }else{
            listHTML.prepend(items[items.length - 1]);/*De lo contrario, osea si es prev coje el ultimo hijo de lista y lo agrega al inicio de la lista */
            carousel.classList.add('prev');/*A carousel se le agrega la clase prev */
        }
        clearTimeout(unAcceppClick);/*Detine el temporizador que se configuro en previamente setTimeout */
        unAcceppClick = setTimeout(()=>{/*configura un temporizador de 2 segundos que reactivará los eventos de puntero en los botones de navegación del carrusel. Esto asegura que después de realizar una acción en el carrusel (como avanzar o retroceder), el usuario no pueda hacer clic en los botones de nuevo hasta que pase el tiempo especificado, lo cual ayuda a evitar problemas causados por clics rápidos o múltiples */
            nextButton.style.pointerEvents = 'auto';
            prevButton.style.pointerEvents = 'auto';
        }, 2000)
    }
    seeMoreButtons.forEach((button) => {/*Por cada boton de ver mas presionado */
        button.onclick = function(){/*cuando se detecte el evento de click en el boton */
            carousel.classList.remove('next', 'prev');/*Eliminamos las clases next y prev de carousel*/
            carousel.classList.add('showDetail');/*agregamos la clase showDetail a carousel*/
        }
    });
    backButton.onclick = function(){
        carousel.classList.remove('showDetail');/*Cuando presionemos volver a la introduccion principal removemos la clase showDetail*/
    }
    menu.addEventListener("click",()=>{
        aside.classList.add("mostrar-sidebar");
    });
    menu_sidebar.addEventListener("click",()=>{
        aside.classList.remove("mostrar-sidebar");
    });
    /*progress bar */
    function move() {
        const bar = document.querySelector(".progress-bar");
        let width = 0;
        const interval = setInterval(frame, 10); // Ajusta el intervalo según sea necesario

        function frame() {
            if (width >= 100) {
                width = 0; // Reinicia el ancho
                let items = document.querySelectorAll('.carousel .list .item');/*seleccionamos todos los items de nuestro elemento carousel*/
                listHTML.appendChild(items[0]);
                carousel.classList.add('next');
                /*carousel2*/
                listcarousel2.scrollBy({
                    left: 300,
                    behavior: 'smooth'
                });
        
                setTimeout(() => {
                    listcarousel2.appendChild(elementos[0]);
                    elementos = Array.from(document.querySelectorAll('.elemento'));
                }, 300); // Tiempo igual al de la animación de desplazamiento
            }

            width=width+0.1;
            bar.style.width = width + '%';
            
            if (Math.abs(width - 50) < 0.6) {
                carousel.classList.remove('next', 'prev');/*Eliminamos las clases next y prev de carousel */        
            }
        }
    }

    document.getElementById('izquierda').addEventListener('click', function() {
        listcarousel2.scrollBy({
            left: -300,
            behavior: 'smooth'
        });

        setTimeout(() => {/*retraza la ejecucion del codigo dentro de la funcion proporcionada, osea se retrasa 3 seg*/
            listcarousel2.insertBefore(elementos[elementos.length - 1], elementos[0]);/*mueve el ultimo elemento del contenedor al inicio, antes de elementos[0]*/
            elementos = Array.from(document.querySelectorAll('.elemento'));/*actualizamos la lista de elementos*/
        }, 300); // Tiempo igual al de la animación de desplazamiento
    });

    document.getElementById('derecha').addEventListener('click', function() {
        listcarousel2.scrollBy({
            left: 300,
            behavior: 'smooth'
        });

        setTimeout(() => {
            listcarousel2.appendChild(elementos[0]);
            elementos = Array.from(document.querySelectorAll('.elemento'));
        }, 300); // Tiempo igual al de la animación de desplazamiento
    });
    // Función para cargar más productos al hacer clic en "Ver más"
    let paginaActual = 1;
    document.querySelector('.next_flecha-productos_destacados').addEventListener('click', () => {
        paginaActual++;  // Incrementa la página para la próxima carga
        cargarProductos(paginaActual);  // Llama a la función asíncrona
        console.log(paginaActual);
        document.querySelector('.prev_flecha-productos_destacados').style.pointerEvents = 'auto';
        document.querySelector('.prev_flecha-productos_destacados').style.cursor = 'pointer'; // O 'auto' para el cursor predeterminado
    });
    document.querySelector('.prev_flecha-productos_destacados').addEventListener('click', () => {
        paginaActual--;  // Disminuye la página para cargar la anterior
        console.log(paginaActual);
        cargarProductos(paginaActual);  // Llama a la función asíncrona para cargar productos
        document.querySelector('.next_flecha-productos_destacados').style.pointerEvents = 'auto';
        document.querySelector('.next_flecha-productos_destacados').style.cursor = 'pointer'; // O 'auto' para el cursor predeterminado
        if (paginaActual == 1) {
            document.querySelector('.prev_flecha-productos_destacados').style.pointerEvents = 'none';
            document.querySelector('.prev_flecha-productos_destacados').style.cursor = 'default';
        }    
    });
    // Inicia el progreso cuando se carga la página
    window.onload = function() {
        move();
        cargarProductos(paginaActual);
    };    
}
async function cargarProductos(pagina) {
    const cargando = document.querySelector('.overlay');
    cargando.style.display = 'flex';
    const data  = new URLSearchParams();
    data .append('pagina', pagina);
    try{
        const response = await fetch('./php/cargar_productos.php', {
            method: 'POST',
            body: data
        });
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const result= await response.json();
        const result_productos = result.productos;
        const result_bloquearNextFlecha = result.bloquear_next_flecha;
        const grid_productos_destacados = document.querySelector('.grid_productos_destacados');
        // Si no hay productos, oculta el botón
        if (result_bloquearNextFlecha) {
            document.querySelector('.next_flecha-productos_destacados').style.pointerEvents = 'none';
            document.querySelector('.next_flecha-productos_destacados').style.cursor  = 'default';
        }
        // Elimina los productos anteriores
        grid_productos_destacados.innerHTML = '';
        result_productos.forEach(result_producto => {
            // Crear el contenedor del producto
            const productoDiv = document.createElement('div');
            productoDiv.className = 'producto';
            // Crear el contenedor de la imagen
            const imagenProductoDiv = document.createElement('div');
            imagenProductoDiv.className = 'imagen_producto';
            // Crear el enlace para la imagen
            const enlaceImagen = document.createElement('a');
            enlaceImagen.href = 'detalle_producto.html';
            // Crear la imagen
            const imagen = document.createElement('img');
            imagen.src = result_producto.imagen_producto;
            imagen.alt = 'Imagen de producto';
            // Añadir la imagen al enlace y el enlace al contenedor de la imagen
            enlaceImagen.appendChild(imagen);
            imagenProductoDiv.appendChild(enlaceImagen);
            // Crear el contenedor de la información del producto
            const informacionProductoDiv = document.createElement('div');
            informacionProductoDiv.className = 'informacion_producto';
            // Crear el título del producto
            const titulo = document.createElement('h3');
            const enlaceTitulo = document.createElement('a');
            enlaceTitulo.href = 'detalle_producto.html';
            enlaceTitulo.textContent = result_producto.nombre_producto;
            titulo.appendChild(enlaceTitulo);
            // Crear el precio del producto
            const precio = document.createElement('span');
            precio.className = 'precio_producto';
            precio.innerHTML = `<bdi><span class="moneda_producto">S/</span> ${result_producto.precio}</bdi>`;
            // Crear las opciones del producto
            const opcionesProductoDiv = document.createElement('div');
            opcionesProductoDiv.className = 'opciones_producto';
            // Crear los iconos de opciones
            const opciones = [
                { icono: 'favorite_border', titulo: 'Añadir a favoritos' },
                { icono: 'add_shopping_cart', titulo: 'Añadir al carrito' },
                { icono: 'compare_arrows', titulo: 'Comparar productos' }
            ];
            opciones.forEach(opcion => {
                const spanIcono = document.createElement('span');
                spanIcono.className = 'material-icons-sharp icono_opcion_producto';
                spanIcono.title = opcion.titulo;
                spanIcono.textContent = opcion.icono;
                opcionesProductoDiv.appendChild(spanIcono);
            });
            // Añadir los elementos creados al contenedor de información
            informacionProductoDiv.appendChild(titulo);
            informacionProductoDiv.appendChild(precio);
            informacionProductoDiv.appendChild(opcionesProductoDiv);
            // Añadir los contenedores de imagen e información al contenedor del producto
            productoDiv.appendChild(imagenProductoDiv);
            productoDiv.appendChild(informacionProductoDiv);
            // Añadir el producto al contenedor principal
            grid_productos_destacados.appendChild(productoDiv);
            cargando.style.display = 'none';
        });
    }catch (error) {
        console.error('Error al cargar productos:', error);
        cargando.style.display = 'none';
    }
    /*try {
        // Realiza la solicitud para obtener los productos de la página especificada
        const response = await fetch(`cargar_productos.php?pagina=${pagina}`);
        
        // Espera la respuesta en formato JSON
        const productos = await response.json();

        // Selecciona el contenedor de productos
        const contenedor = document.querySelector('.grid_productos_destacados');

        // Si no hay productos, oculta el botón
        if (productos.length === 0) {
            document.getElementById('ver-mas').style.display = 'none';
            return;
        }

        // Elimina los productos anteriores
        contenedor.innerHTML = '';

        // Añade los productos obtenidos al contenedor
        productos.forEach(producto => {
            const productoDiv = document.createElement('div');
            productoDiv.className = 'producto';
            productoDiv.innerHTML = `
                <img src="${producto.imagen_producto}" alt="Producto">
                <h3>${producto.nombre_producto}</h3>
                <p>${producto.descripcion_producto}</p>
            `;
            contenedor.appendChild(productoDiv);
        });
    } catch (error) {
        console.error('Error al cargar productos:', error);
    }*/
}
function toggleMenu() {/*para que solo se ejecute al dar click a la imagen, no lo declaro antes porque al no existir causara error */
    const dropdownContent = document.querySelector('.dropdown-content');
    dropdownContent.classList.toggle('show');
};
function toggleMenu_aside() {/*para que solo se ejecute al dar click a la imagen, no lo declaro antes porque al no existir causara error */
    const dropdownContent = document.querySelector('.dropdown-content_aside');
    dropdownContent.classList.toggle('show');
};
async function Inisesion(){
    const login_register = document.querySelector(".contenedor__login-register");
    const btn__registrarse = document.querySelector(".btn__registrarse");
    const iniciar_sesion = document.querySelector(".btn__iniciar-sesion");
    const formulario__login = document.querySelector(".formulario__login");
    const formulario__register = document.querySelector(".formulario__register");
    const caja__trasera_login = document.querySelector(".caja__trasera-login");
    const caja__trasera_register = document.querySelector(".caja__trasera-register");
    const contenedorToast=document.getElementById('contenedor-toast');
    const cargando = document.querySelector('.overlay');
    btn__registrarse.onclick = function(){
        login_register.classList.add('active');
        formulario__register.classList.add('active')
        formulario__login.classList.add('active')
        caja__trasera_login.classList.add('active')
        caja__trasera_register.classList.add('active')
        contenedorToast.classList.add('registrarse')
    }
    iniciar_sesion.onclick = function(){
        login_register.classList.remove('active');
        formulario__register.classList.remove('active')
        formulario__login.classList.remove('active')
        caja__trasera_login.classList.remove('active')
        caja__trasera_register.classList.remove('active')
        contenedorToast.classList.remove('registrarse')
    }
    const { agregarToast, manejarClickToast } = await import('./modulo_notificacion.js');
    document.querySelector('.formulario__login').addEventListener('submit', async function (event) {
        event.preventDefault();
        const button_registro_cliente = this.querySelector('button[type="submit"]');
        button_registro_cliente.disabled = true; // Deshabilita el botón
        const formData = new FormData(this);
        try {
            cargando.style.display = 'flex';
            const response = await fetch('./php/login_cliente.php', {
                method: 'POST',
                body: formData
            });
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const result = await response.json();
            if (result.success=='warning') {
                agregarToast({tipo:'warning',titulo:'Advertencia!',descripcion:result.message,autoCierre:true},contenedorToast)
            } else if (result.success=='error'){
                agregarToast({tipo:'error',titulo:'Error!',descripcion:result.message,autoCierre:true},contenedorToast)
            } else if (result.success=='exito'){
                agregarToast({tipo:'exito',titulo:'Exito!',descripcion:result.message,autoCierre:true},contenedorToast)
                cargando.style.display = 'none';
                setTimeout(() => {
                    location = './'; // Redirige a la URL proporcionada
                }, 500); // 2000 milisegundos = 2 segundos
            }
            cargando.style.display = 'none';
        } catch (error) {
            cargando.style.display = 'none';
            /*Swal.fire({
                title: 'Error',
                text: 'No se pudo conectar con el servidor.',
                icon: 'error',
                confirmButtonText: 'Cool'
            });*/
            agregarToast({tipo:'error',titulo:'Error!',descripcion:'No se pudo conectar con el servidor',autoCierre:true},contenedorToast)
        }finally {
            button_registro_cliente.disabled = false; // Habilita el botón nuevamente
        }
    })
    document.querySelector('.formulario__register').addEventListener('submit', async function (event) {
        /*Validar email */
        const emailInput = this.querySelector('input[name="correo"]');
        const email = emailInput.value;
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            event.preventDefault(); // Evita el envío del formulario
            /*Swal.fire({
                title: 'Error',
                text: 'Por favor, ingrese un correo electrónico válido.',
                icon: 'error',
                confirmButtonText: 'OK'
            });*/
            agregarToast({tipo:'warning',titulo:'Advertencia!',descripcion:'Por favor, ingrese un correo electrónico válido',autoCierre:true},contenedorToast)
            return
        }

        event.preventDefault(); // Evita el envío normal del formulario
        const button_registro_cliente = this.querySelector('button[type="submit"]');
        button_registro_cliente.disabled = true; // Deshabilita el botón
        const formData = new FormData(this);
        try {
            cargando.style.display = 'flex';
            const response = await fetch('./php/registro_cliente_bd.php', {//es una funcion asincrona en javascript, esto nos permite ejecutar el php sin que nos redirijamos a esa pagina
                //const response es una constante que almacenara el resultado de la solucitud fetch
                //await  indica que se esperara que la solicitud fetch se complete y halla recibido una respuesta, osea no se ejecutaran las demas lineas hasta que registro_cliente_bd haya terminado de ejecutar
                //fetch() es una funcion que se utiliza para realizar solicitudes HTTP y retorna una promesa que representa a la respuesta de dicha solicitud
                method: 'POST',//Los datos no se envian en la URL, osea no son visibles en la barra de direcciones del navegador y los datos no se almacenan en cache y queremos enviar una gran cantidad de datos
                body: formData//es un objeto en JavaScript que se utiliza para construir un conjunto de pares clave/valor, que pueden ser enviados a través de una solicitud HTTP, sirve para enciar datos al php que estamos ejecutando asincronamente
            });
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const result = await response.json();
            if (result.success) {
                /*Swal.fire({
                    title: 'Registro Exitoso',
                    text: result.message,
                    icon: 'success',
                    confirmButtonText: 'Cool'
                });*/
                formData.append('codigo', result.codigo);
                formData.append('correo', result.correo);
                formData.append('nombre', result.nombre);
                const response2 = await fetch('./enviarcorreo.php', {//es una funcion asincrona en javascript, esto nos permite ejecutar el php sin que nos redirijamos a esa pagina
                    //const response es una constante que almacenara el resultado de la solucitud fetch
                    //await  indica que se esperara que la solicitud fetch se complete y halla recibido una respuesta, osea no se ejecutaran las demas lineas hasta que registro_cliente_bd haya terminado de ejecutar
                    //fetch() es una funcion que se utiliza para realizar solicitudes HTTP y retorna una promesa que representa a la respuesta de dicha solicitud
                    method: 'POST',//Los datos no se envian en la URL, osea no son visibles en la barra de direcciones del navegador y los datos no se almacenan en cache y queremos enviar una gran cantidad de datos
                    body: formData//es un objeto en JavaScript que se utiliza para construir un conjunto de pares clave/valor, que pueden ser enviados a través de una solicitud HTTP, sirve para enciar datos al php que estamos ejecutando asincronamente
                });
                if (!response2.ok) {
                    throw new Error('Network response was not ok');
                }
                const result2 = await response2.json();
                cargando.style.display = 'none';
                if (result2.success) {
                    agregarToast({tipo:'exito',titulo:'Registro Exitoso!',descripcion:result.message,autoCierre:true},contenedorToast)
                    agregarToast({tipo:'info',titulo:'No olvidar!',descripcion:result.message,autoCierre:true},contenedorToast)
                }else{
                    agregarToast({tipo:'error',titulo:'Error!',descripcion:result.message,autoCierre:true},contenedorToast)
                }
            } else {
                /*Swal.fire({
                    title: 'Error',
                    text: result.message,
                    icon: 'error',
                    confirmButtonText: 'Cool'
                });*/
                agregarToast({tipo:'warning',titulo:'Advertencia!',descripcion:result.message,autoCierre:true},contenedorToast)
                cargando.style.display = 'none';
            }
        } catch (error) {
            cargando.style.display = 'none';
            /*Swal.fire({
                title: 'Error',
                text: 'No se pudo conectar con el servidor.',
                icon: 'error',
                confirmButtonText: 'Cool'
            });*/
            agregarToast({tipo:'error',titulo:'Error!',descripcion:'No se pudo conectar con el servidor',autoCierre:true},contenedorToast)
        }finally {
            button_registro_cliente.disabled = false; // Habilita el botón nuevamente
        }
    });
    manejarClickToast(contenedorToast);
}
function Sobre_nosotros(){
    const cards= document.querySelectorAll(".card");
    menu.addEventListener("click",()=>{
        aside.classList.add("mostrar-sidebar");
    });
    menu_sidebar.addEventListener("click",()=>{
        aside.classList.remove("mostrar-sidebar");
    });
    cards.forEach(card => {
        card.addEventListener('click', function() {
            const comun_cards = this.querySelectorAll('.comun-card');
            comun_cards.forEach((comun_card) => {
                comun_card.classList.toggle('active');
            });
        });
    });
}
function Preguntas_frecuentes(){
    const accordion=document.querySelectorAll(".accordion"),
    accordionToggle=document.querySelectorAll(".accordion__header"),
    accordionContent=document.querySelectorAll(".accordion__content"),
    accordionIcon=document.querySelectorAll("#accordion-icon")/*Seleccionamos todos los elementos que tengan este ID*/;/*Declaramos las variables*/
    let body = document.body;
    menu.addEventListener("click",()=>{
        aside.classList.add("mostrar-sidebar");
    });
    menu_sidebar.addEventListener("click",()=>{
        aside.classList.remove("mostrar-sidebar");
    });
    /*funcionalidad de expandir y colapsar */
    for (let i=0; i<accordionToggle.length;i++){/*accordionToggle.length devuelve el numero de elementos en la coleccion accordionToggle, por ende se esta iterando sobre todos loe elementos de titulo w icono, es practicamente lo que hace "forEach"*/
        accordionToggle[i].addEventListener("click",()=>{/*a cada encabezado se le agrega un evento listener de eventos que se ejecuta al dar click*/
            if(parseInt(accordionContent[i].style.height)!=accordionContent[i].scrollHeight){/*Si la altura del scroll no es igual a la altura del contenido significa que no se ah exoandifo totalmente, scrollHeight devuelve la altura real del elemento, style.height nos devuelve el estilo o la altura de ese elemento*/
                accordionContent[i].style.height=accordionContent[i].scrollHeight+"px";/*si la altura descrita por los estilos es distinta a la altura real del elemento, el estilo cambiara a la altura real del elemento, siempre en cuando este este haya sido dado click, osea sea el elemento del evento */
                accordionIcon[i].textContent ="remove";/*cambiamos el icono a remove*/
            }else{/*si la altura de estilos es igual a la altura del bloque significa que queremos minimizar porque presionamos el evento estando maximizado*/
                accordionContent[i].style.height="0px";/*cambiamos la altura a 0, osea minimizamos el bloque*/
                accordionIcon[i].textContent ="add";/*cambiamos el icono a add*/
            }
            for (let j=0; j<accordionContent.length; j++){/*iteramos todos los elementos de contenido, el anterior era de encabezado (es el elemento donde va la pregunta y el icono)*/
                if(j !== i){/*significa que todos los otros elementos que no sean parte del evento seran minimizados y el icono cambiara a add*/
                accordionContent[j].style.height="0px";
                accordionIcon[j].textContent ="add";
                }
            }
        });
    }
    function setResponsiveVariables() {
        if (window.innerWidth < 900) {
            body.classList.add("redimension-mode");
        }else{
            body.classList.remove("redimension-mode")
        }
      }
    window.addEventListener('resize', setResponsiveVariables);
    window.addEventListener('load', setResponsiveVariables);
}
function Contacto(){
    let body = document.body;
    menu.addEventListener("click",()=>{
        aside.classList.add("mostrar-sidebar");
    });
    menu_sidebar.addEventListener("click",()=>{
        aside.classList.remove("mostrar-sidebar");
    });
    function setResponsiveVariables() {
        if (window.innerWidth < 900) {
            body.classList.add("redimension-mode");
        }else{
            body.classList.remove("redimension-mode")
        }
      }
    window.addEventListener('resize', setResponsiveVariables);
    window.addEventListener('load', setResponsiveVariables);
}
function Blog(){
    menu.addEventListener("click",()=>{
        aside.classList.add("mostrar-sidebar");
    });
    menu_sidebar.addEventListener("click",()=>{
        aside.classList.remove("mostrar-sidebar");
    });
}
async function Perfil_editar() {
    const contenedorToast = document.getElementById('contenedor-toast');
    const cargando = document.querySelector('.overlay');
    cargando.style.display = 'flex';
    //Declaramos los elementos select de pais y ciudad
    const paisSelect = document.getElementById('pais');
    const ciudadSelect = document.getElementById('ciudad');
    const generoSelect = document.getElementById('genero');
    const fecha_nacimientoSelect = document.getElementById('fecha_nacimiento');
    const biografiaSelect = document.getElementById('biografia');

    const { agregarToast, manejarClickToast } = await import('./modulo_notificacion.js');
    document.querySelector('.upload-input').addEventListener('change', async function () {
        const form = document.querySelector('.user-photo-container');
        const userPhoto = document.querySelector('.user-photo');
        const formData = new FormData(form);
        try {
            const response = await fetch('./php/upload_photo.php', {
                method: 'POST',
                body: formData
            });
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const result = await response.json();
            if (result.success) {
                setTimeout(function() {
                    userPhoto.src = result.photo_url;
                }, 2000); // 2000 milisegundos = 2 segundos
                agregarToast({tipo:'exito',titulo:'Registro Exitoso!',descripcion:result.message,autoCierre:true},contenedorToast)
            } else {
                agregarToast({tipo:'warning',titulo:'Advertencia!',descripcion:result.message,autoCierre:true},contenedorToast)
            }
        } catch (error) {
            agregarToast({tipo:'error',titulo:'Error!',descripcion:'No se pudo conectar con el servidor',autoCierre:true},contenedorToast)
        }
    });
    // Obtener el nombre de todos los países e insertarlos
    const {llenarSelectPaises} = await import('./modulo_obtener-paises.js');
    //Esto ingresara los datos de los paises en el select con id pais
    llenarSelectPaises(paisSelect)//El await es cuando estamos esperando una promesa o resultado

    // Función para obtener las ciudades del país seleccionado
    const {llenarSelectCiudades} = await import('./modulo_obtener-ciudades.js');
    // Envolver la llamada en una función async y ejecutarla
    paisSelect.addEventListener('change', () => {
        llenarSelectCiudades(ciudadSelect, paisSelect,cargando,datos_usuario);
    });



    const {obtener_datos_usuario} = await import('./modulo_actualizar-formulario-cliente.js');
    const [datos_usuario, lanzar_evento_pais] = await obtener_datos_usuario(agregarToast,manejarClickToast,contenedorToast); // Asegúrate de que esta función devuelve una Promesa si es asíncrona
    if (lanzar_evento_pais){
        paisSelect.value = datos_usuario.pais;
        generoSelect.value = datos_usuario.genero;
        biografiaSelect.value = datos_usuario.biografia;
        fecha_nacimientoSelect.value = datos_usuario.nacimiento;
        // Crear y disparar el evento 'change'
        await llenarSelectCiudades(ciudadSelect, paisSelect,datos_usuario);
        ciudadSelect.value = datos_usuario.ciudad;
        cargando.style.display = 'none';
    }
    document.querySelector('.user-info-container').addEventListener('submit', async function (event) {
        event.preventDefault(); // Evita el envío normal del formulario
        const button_registro_cliente = this.querySelector('button[type="submit"]');
        button_registro_cliente.disabled = true; // Deshabilita el botón
        const formData = new FormData(this);
        try {
            const response = await fetch('./php/modulo_actualizar-datos-cliente.php', {
                method: 'POST',
                body: formData
            });
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const result = await response.json();
            if (result.success===0) {
                agregarToast({tipo:'error',titulo:'Error!',descripcion:'No se pudo conectar con el servidor',autoCierre:true},contenedorToast)
            }else if (result.success===1) {
                agregarToast({tipo:'exito',titulo:'Registro Exitoso!',descripcion:result.message,autoCierre:true},contenedorToast)
            } else {
                agregarToast({tipo:'info',titulo:'Ojito!',descripcion:result.message,autoCierre:true},contenedorToast)
            }
        } catch (error) {
            agregarToast({tipo:'error',titulo:'Error!',descripcion:'No se pudo conectar con el servidor',autoCierre:true},contenedorToast)
        }finally {
            button_registro_cliente.disabled = false; // Habilita el botón nuevamente
        }
    });
    //Para cerrar las notificaciones
    manejarClickToast(contenedorToast);
}
function Perfil_ajustes(){
    const contenedorToast=document.getElementById('contenedor-toast');
    container_info_contraseña=document.querySelector('.container-info-contraseña');
    /*import('./modulo_seguridad-contraseña.js').then(({ingresarClave }) => {
        document.getElementById('contraseña').addEventListener('input',ingresarClave);//Este evento se activa cuando ingreso algun valor al input de contraseña

    });*/
    import('./modulo_seguridad-contraseña.js').then(({seguridadContraseña}) => {
        seguridadContraseña(contenedorToast);
    });
    import('./modulo_notificacion.js').then(({agregarToast, manejarClickToast }) => {
        import('./modulo_validar-contraseña.js').then(({validatePassword}) => {
            document.querySelector('.user-info-container').addEventListener('submit', async function (event) {
                event.preventDefault(); // Previene el envío por defecto del formulario
                const formData = new FormData(this);
                if (validatePassword()){
                    try {
                        const response = await fetch('./php/cambio_contraseña.php', {
                            method: 'POST',
                            body: formData
                        });
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        const result = await response.json();
                        if (result.success) {
                            agregarToast({tipo:'exito',titulo:'Cambio Exitoso!',descripcion:result.message,autoCierre:true},contenedorToast)
                        } else {
                            agregarToast({tipo:'warning',titulo:'Advertencia!',descripcion:result.message,autoCierre:true},contenedorToast)
                        }
                    } catch (error) {
                        agregarToast({tipo:'error',titulo:'Error!',descripcion:'No se pudo conectar con el servidor',autoCierre:true},contenedorToast)
                    }
                }else{
                    agregarToast({tipo:'warning',titulo:'Advertencia!',descripcion:'La "Contraseña nueva" y la validación de la contraseña nueva deben ser iguales',autoCierre:true},contenedorToast)
                }
            });
        });
        manejarClickToast(contenedorToast);
    });
    document.querySelectorAll('.togglePassword').forEach(icon => {
        icon.addEventListener('click', function () {//Se le añade el evento de click a cada funcion
            const passwordField = this.previousElementSibling;// selecciona el elemento hermano anterior al ícono, que se supone que es el campo de entrada de la contraseña (input).
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';//Obtiene el atributo type del input, si es tipo password se cambia a text y viceversa, ? funciona como else, si el atributo type es igual a password 
            passwordField.setAttribute('type', type);//Establece el nuevo valor del atributo type del campo de entrada
            this.textContent = type === 'password' ? 'visibility' : 'visibility_off'; //Cambia el texto del ícono según el estado actual
        });
    });
};
function container_info_contraseña_Active(){
    document.querySelector('.container-info-contraseña').classList.toggle('active');
}
function Perfil_borrar(){
    const contenedorToast=document.getElementById('contenedor-toast');
    import('./modulo_notificacion.js').then(({agregarToast, manejarClickToast }) => {
        document.querySelector('.user-info-container').addEventListener('submit', async function (event) {
            event.preventDefault(); // Previene el envío por defecto del formulario
            const formData = new FormData(this);
            try {
                const response = await fetch('./php/eliminar_cuenta.php', {
                    method: 'POST',
                    body: formData
                });
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const result = await response.json();
                if (result.success) {
                    agregarToast({tipo:'exito',titulo:'Eliminación exitosa!',descripcion:result.message,autoCierre:true},contenedorToast)
                } else {
                    agregarToast({tipo:'error',titulo:'Ocurrio un problema!',descripcion:result.message,autoCierre:true},contenedorToast)
                }
            } catch (error) {
                agregarToast({tipo:'error',titulo:'Error!',descripcion:'No se pudo conectar con el servidor',autoCierre:true},contenedorToast)
            }
        });
        manejarClickToast(contenedorToast);
    });
};
function initCommon(){
    let body = document.body;
    /*Esto aplica el modo oscuro si ya estaba aplicado, osea si el modo oscuro ya estaba guardado en el navegador al recargar o volver a abrir la pagina se volvera a aplicar*/
    if (localStorage.getItem('dark-mode') === 'enabled') {
        body.classList.add('dark-mode');
        circulos.forEach(circulo => {
            circulo.classList.add('prendido');
        });
    }
    palancas.forEach((palanca) => {
        palanca.addEventListener("click",()=>{
            body.classList.toggle("dark-mode");
            circulos.forEach(circulo => {
                circulo.classList.toggle('prendido');
            });
            // Guardar la preferencia en localStorage
            if (body.classList.contains('dark-mode')) {/*verifica si body tiene una clase darkmode*/
                localStorage.setItem('dark-mode', 'enabled');/*si el elemento body tiene la clase dark-mode, esto fuarda la preferencia del usuario en el almacenamiento loca, configurando la clave dark-mode con el valor de enabled*/
            } else {
                localStorage.removeItem('dark-mode');/*si el elemento body no tiene la clase dark-mode, este elimina la clave, dando a entender que no esta habilitado*/
            }/*localStorage guarda los datos en el navegador del usuario que hace que el cambio siga aplicado incluso si el navegador se cierra o se regargue, esto es util para guardar las preferencias del usuario, estado de aplicacion y otros datos que deben ser preservados entre visitas, es mejor que las cookies porque no interfiere con el rendimiento de la página web y tienen una capacidad de almacenamiento mayor que de las cookies, tiene 5MB como max en la mayoria de navegadores y estos no estan cifrados por los que no se deben de guardar informacion confidencial*/
        });
    });
}
// Ejecutar código dependiendo de la página actual
document.addEventListener('DOMContentLoaded', function() {
    // Ejecutar código común a todas las páginas
    initCommon();
    if (document.documentElement.classList.contains('index')) {
        Index();
    } else if (document.documentElement.classList.contains('inisesion')) {
        Inisesion();
    } else if (document.documentElement.classList.contains('Sobre_nosotros')) {
        Sobre_nosotros();
    } else if (document.documentElement.classList.contains('Preguntas_frecuentes')) {
        Preguntas_frecuentes();
    } else if (document.documentElement.classList.contains('Contacto')) {
        Contacto();
    } else if (document.documentElement.classList.contains('Blog')) {
        Blog();
    } else if (document.documentElement.classList.contains('Perfil_editar')) {
        Perfil_editar();
    } else if (document.documentElement.classList.contains('Perfil_ajustes')) {
        Perfil_ajustes();
    } else if (document.documentElement.classList.contains('Perfil_borrar')) {
        Perfil_borrar();
    }
});