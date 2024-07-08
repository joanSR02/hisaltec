let nextButton = document.getElementById('next');/*let Es una palabra clave en JavaScript que se utiliza para declarar una variable local dentro del ámbito en el que se está ejecutando el código. */
/*getElementById es un método del objeto document y devuelve un único elemento del documento que coincida con el ID especificado*/
let prevButton = document.getElementById('prev');
let carousel = document.querySelector('.carousel');/*querySelector es un  método del objeto document que permite seleccionar y devolver el primer elemento dentro del documento que coincida con el selector CSS (clase) especificado*/
let listHTML = document.querySelector('.carousel .list');
let seeMoreButtons = document.querySelectorAll('.seeMore');/*querySelectorAll Es un método del objeto document que permite seleccionar y devolver todos los elementos dentro del documento que coincidan con el selector CSS especificado, en este caso, '.seeMore'. Esto significa que buscará todos los elementos que tengan la clase .seeMore en el documento.*/
let backButton = document.getElementById('back');
const palanca = document.querySelector(".switch");
const circulo = document.querySelector(".circulo");
const menu = document.querySelector(".menu");
const aside = document.querySelector("aside");
const menu_sidebar = document.querySelector(".menu_sidebar");

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
palanca.addEventListener("click",()=>{
    let body = document.body;
    body.classList.toggle("dark-mode");
    circulo.classList.toggle("prendido");
});
menu.addEventListener("click",()=>{
    aside.classList.add("mostrar-sidebar");
});
menu_sidebar.addEventListener("click",()=>{
    aside.classList.remove("mostrar-sidebar");
});