export function validatePassword() {
    var password = document.getElementById("contraseñaNueva").value;
    var confirmPassword = document.getElementById("validarContraseñaNueva").value;
    if (password !== confirmPassword) {
        return false; // Evita el envío del formulario
    }
    return true; // Permite el envío del formulario
}