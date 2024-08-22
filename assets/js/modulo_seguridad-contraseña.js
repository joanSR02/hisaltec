function validarContraseña(contraseña) {/*Validación de seguridad de contraseña*/
    const requisitos = {
        longitud: /^(?=.{8,})/,                 // Al menos 8 caracteres
        mayúsculas: /[A-Z]/,                    // Al menos una letra mayúscula
        minúsculas: /[a-z]/,                    // Al menos una letra minúscula
        números: /[0-9]/,                       // Al menos un dígito numérico
        especiales: /[!@#$%^&*(),.?":{}|<>]/   // Al menos un carácter especial
    };

    const longitud = requisitos.longitud.test(contraseña);/*test es un método de javascript que se utiliza para comprobar si la cadena de texto coincide con el patron especifico definido por la expresion regular validar contraseña*/
    const mayúsculas = requisitos.mayúsculas.test(contraseña);
    const minúsculas = requisitos.minúsculas.test(contraseña);
    const números = requisitos.números.test(contraseña);
    const especiales = requisitos.especiales.test(contraseña);

    const cantidadRequisitos = [longitud, mayúsculas, minúsculas, números, especiales].filter(Boolean).length;/*coloca a todos los resultados de las pruebas en un array y usa filter(Boolean para que se cree un array con solo los resultados true y finalmente cuenta cuantos elementos hay en el array true)*/

    return cantidadRequisitos;
}
export function seguridadContraseña() {
    document.getElementById('contraseña').addEventListener('input', (e) => {
    //document.getElementById('contraseña').addEventListener('input', function () {
        /*const contraseña = this.value;Obtiene el valor actual del campo (input) de contraseña por el que se activo el evento*/
        const contraseña = e.target.value;
        const feedback = document.getElementById('feedback');/*Selecciona el elemento con ID feedback, que se usará para mostrar el mensaje de retroalimentación*/
        const barraSeguridad = document.getElementById('barra-seguridad');/*Selecciona el elemento con ID barra-seguridad, que se usará para mostrar la barra de seguridad.*/

        const nivelSeguridad = validarContraseña(contraseña);/*Llama a la función validarContraseña con la contraseña actual y guarda el número de requisitos cumplidos.*/
        
        switch (nivelSeguridad) {
            case 0:
                barraSeguridad.className = 'barra-seguridad';
                feedback.textContent = '';
                break;
            case 1:
                barraSeguridad.className = 'barra-seguridad baja';
                feedback.textContent = 'La contraseña es muy débil.';
                break;
            case 2:
                barraSeguridad.className = 'barra-seguridad baja';
                feedback.textContent = 'La contraseña es muy débil.';
                break;
            case 3:
                barraSeguridad.className = 'barra-seguridad media';
                feedback.textContent = 'La contraseña es moderada.';
                break;
            case 4:
                barraSeguridad.className = 'barra-seguridad media';
                feedback.textContent = 'La contraseña es moderada.';
                break;
            case 5:
                barraSeguridad.className = 'barra-seguridad alta';
                feedback.textContent = 'La contraseña es fuerte.';
                break;
            default:
                barraSeguridad.className = 'barra-seguridad baja';
                feedback.textContent = 'La contraseña es muy débil.';
        }
    });
};