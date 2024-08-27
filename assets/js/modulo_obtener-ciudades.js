async function obtenerCiudades(pais) {
    try {
        const response = await fetch('https://countriesnow.space/api/v0.1/countries/cities', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ country: pais })
        });
        const data = await response.json();
        return data.data;
    } catch (error) {
        console.error('Error al obtener las ciudades:', error);
    }
}
// Función para llenar el select de ciudades
export async function llenarSelectCiudades(ciudadSelect,paisSelect,datos_usuario) {
    const paisSeleccionado = paisSelect.value;
    if (!paisSeleccionado) {
        ciudadSelect.innerHTML = '<option value="">-Seleccionar Ciudad-</option>';
        return
    }
    const ciudades = await obtenerCiudades(paisSeleccionado);
    ciudadSelect.innerHTML = '<option value="">-Seleccionar Ciudad-</option>';
    ciudades.forEach(ciudad => {
        const option = document.createElement('option');
        option.value = ciudad;
        option.textContent = ciudad;
        ciudadSelect.appendChild(option);
    });
}