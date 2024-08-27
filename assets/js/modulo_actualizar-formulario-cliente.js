//Actualizar los valores del furmulario
export async function obtener_datos_usuario(agregarToast,manejarClickToast,contenedorToast){
    const formData = new FormData();
    try {
        const response = await fetch('./php/modulo_actualizar-formulario-cliente.php', {
            method: 'POST',
            body: formData
        });
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const result = await response.json();
        if (result.success){
            //agregarToast({tipo:'exito',titulo:'Registro Exitoso!',descripcion:result.message,autoCierre:true},contenedorToast)
            return [result, true];
        }else{
            agregarToast({tipo:'error',titulo:'Error!',descripcion:'No se pudo conectar con el servidor',autoCierre:true},contenedorToast)
        }
    } catch (error) {
        agregarToast({tipo:'error',titulo:'Error!',descripcion:'No se pudo conectar con el servidor',autoCierre:true},contenedorToast)
    }
    manejarClickToast(contenedorToast);
}