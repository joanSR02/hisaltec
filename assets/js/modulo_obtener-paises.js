async function obtenerPaises() {
    try {
        const response = await fetch('https://countriesnow.space/api/v0.1/countries/iso');
        const data = await response.json();
        return data.data; // La lista de países se encuentra en data.data
    } catch (error) {
        console.error('Error al obtener la lista de países:', error);
    }
}

// Llamar a la función y llenar el select
export async function llenarSelectPaises(paisSelect) {
    const listaDePaises = await obtenerPaises();
    paisSelect.innerHTML = '<option value="">-Seleccionar País-</option>';//limpia el select de las opciones previas y alade la iocuin predeterminada -Seleccionar País-
    listaDePaises.forEach(pais => {
        const option = document.createElement('option');
        option.value = pais.name; // O usa otro identificador si lo prefieres
        option.textContent = pais.name;
        paisSelect.appendChild(option); // Usa paisSelect en lugar de selectPaises
    });
}