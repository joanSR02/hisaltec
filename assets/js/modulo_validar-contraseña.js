export function validatePassword() {
    var password = document.getElementById("contraseña").value;
    var confirmPassword = document.getElementById("validarContraseña").value;
    if (password !== confirmPassword) {
        return false; // Evita el envío del formulario
    }
    return true; // Permite el envío del formulario
}