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
            }

            width=width+0.1;
            bar.style.width = width + '%';
            
            if (Math.abs(width - 50) < 0.6) {
                carousel.classList.remove('next', 'prev');/*Eliminamos las clases next y prev de carousel */        
            }
        }
    }

    // Inicia el progreso cuando se carga la página
    window.onload = move; 
}
function Inisesion(){
    const login_register = document.querySelector(".contenedor__login-register");
    const btn__registrarse = document.querySelector(".btn__registrarse");
    const iniciar_sesion = document.querySelector(".btn__iniciar-sesion");
    const formulario__login = document.querySelector(".formulario__login");
    const formulario__register = document.querySelector(".formulario__register");
    const caja__trasera_login = document.querySelector(".caja__trasera-login");
    const caja__trasera_register = document.querySelector(".caja__trasera-register");
    btn__registrarse.onclick = function(){
        login_register.classList.add('active');
        formulario__register.classList.add('active')
        formulario__login.classList.add('active')
        caja__trasera_login.classList.add('active')
        caja__trasera_register.classList.add('active')
    }
    iniciar_sesion.onclick = function(){
        login_register.classList.remove('active');
        formulario__register.classList.remove('active')
        formulario__login.classList.remove('active')
        caja__trasera_login.classList.remove('active')
        caja__trasera_register.classList.remove('active')
    }
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
    }

    // Ejecutar código común a todas las páginas
    initCommon();
});