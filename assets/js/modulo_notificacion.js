const cerrarToast=(id)=>{
    document.getElementById(id)?.classList.add('cerrando');
};
export const agregarToast=({tipo,titulo,descripcion,autoCierre},contenedorToast)=>{
    const nuevoToast=document.createElement('div');
    nuevoToast.classList.add('toast');
    nuevoToast.classList.add(tipo)
    if(autoCierre){
        nuevoToast.classList.add('autoCierre');
        //setTimeout(()=>cerrarToast(toastId),5000);
    }
    //agregar id del toast
    const numeroAlAzar = Math.floor(Math.random()*100);
    const fecha=Date.now();/*es la fecha en milisegundos*/
    const toastId=fecha+numeroAlAzar;
    nuevoToast.id=toastId;/*Agregamos id al elemento toast*/
    //Iconos
    const iconos={
        exito:'<span class="material-icons-sharp">check_box</span>',
        error:'<span class="material-icons-sharp">error</span>',
        info:'<span class="material-icons-sharp">info</span>',
        warning:'<span class="material-icons-sharp">warning</span>',
    }
    //Plantilla del toast
    const toast=`
        <div class="contenido_toast">
            <div class="icono">
                ${iconos[tipo]}
            </div>
            <div class="texto">
                <p class="titulo">${titulo}</p>
                <p class="descripcion">${descripcion}</p>
            </div>
        </div>
        <button class="btn-cerrar">
            <span class="material-icons-sharp">
                close
            </span>
        </button>
    `;
    //Agregar la plantilla al nuevo toast
    nuevoToast.innerHTML=toast;
    //Agreganis el nuevo toast al contenedor
    contenedorToast.appendChild(nuevoToast);
    //Agregamos event listener para detectar cuando la animacion de cerrar la notificacion termine
    const handleAnimacionCierre = (e) => {
        if(e.animationName === 'cierre'){//Es para saner que animacion estamos cerrando
            nuevoToast.removeEventListener('animationend',handleAnimacionCierre);//Es para optimizar mi pagina, eliminamos el evento
            nuevoToast.remove();
        }
        if(e.animationName === 'autoCierre'){//Es para saner que animacion estamos cerrando
            nuevoToast.removeEventListener('animationend',handleAnimacionCierre);//Es para optimizar mi pagina, eliminamos el evento
            nuevoToast.remove();
        }
    }
    nuevoToast.addEventListener('animationend', handleAnimacionCierre);
}
export function manejarClickToast(contenedorToast) {
    contenedorToast.addEventListener('click', (e) => {
        const toastElement = e.target.closest('div.toast');
        if (toastElement) {
            const toastId = toastElement.id;
            if (e.target.closest('button.btn-cerrar')) {
                cerrarToast(toastId);
            }
        } else {
            console.error('vota tu gaaa');
        }
    });
};