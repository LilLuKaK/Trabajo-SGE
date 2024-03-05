document.addEventListener('DOMContentLoaded', function(){
    const selectEmpresa = document.querySelector('#empresas');
    const selectAnyos = document.querySelector('#anyos');
    const tablaNecesidades = document.querySelector('#tablaALumnos');
    const url = './modelo/contoles_PHP/control_anyos.php';
    
    selectEmpresa.addEventListener('change', (e) => {
        e.preventDefault();
        const idEmpresa = selectEmpresa.value;

        const formData = new FormData();
        formData.append('ID_Control_Empresa', idEmpresa);

        fetch(url, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la solicitud: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                // Muestra el mensaje de error en el select de años
                selectAnyos.innerHTML = `<option value="" disabled>${data.error}</option>`;
            } else {
                // Agrega las opciones al elemento select
                const optionsHTML = data.options.map(option => `<option value="${option.value}">${option.label}</option>`).join('');
                selectAnyos.innerHTML = optionsHTML;
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    // Event listener para capturar el año seleccionado y hacer la solicitud al backend
    selectAnyos.addEventListener('change', (e) => {
        const selectedYear = parseInt(selectAnyos.options[selectAnyos.selectedIndex].textContent); // Convertir el texto del <option> seleccionado a un número entero
        console.log('Año seleccionado:', selectedYear);
        
        // Crear un nuevo objeto FormData
        const formData = new FormData();
        formData.append('anyo_solicitud', selectedYear); // Agregar el año seleccionado al FormData

        // Realizar la solicitud fetch al backend con el año seleccionado
        fetch(url, {
            method: 'POST',
            body: formData, // Enviar el FormData que contiene el año seleccionado
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la solicitud: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            // Manejar los datos recibidos del backend
            console.log(data);
            if (data.results) {
                agregarResultadosALaTabla(data.results); // Llamar a la función para agregar los resultados a la tabla
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});

// Función para agregar los resultados a la tabla
function agregarResultadosALaTabla(results) {
    const tabla = document.querySelector('#tablaALumnos tbody');
    tabla.innerHTML = ''; // Limpiar el contenido existente de la tabla

    // Iterar sobre los resultados y agregar cada fila a la tabla
    results.forEach(result => {
        const fila = document.createElement('tr');

        // Agregar las celdas de la fila con los datos correspondientes
        fila.innerHTML = `
            <td><a href="index.php?pages=consultaAnyoNecesidad"><button class="read" name="${result.ID_Control_Empresa}" id="readNecesidad"><span class="material-symbols-sharp">edit</span></button></a><input id="readNecesidad" type="hidden" value="${result.ID_Control_Empresa}"></td>
            <td>${result['Nombre de la Empresa']}</td>
            <td>${result['Todas las vacantes disponibles en un mismo año']}</td>
            <td>${result['Numero de vacantes cubiertas']}</td>
            <td>${result['Vacantes que quedan']}</td>
            <td>${result['Año de solicitud']}</td>
        `;

        // Agregar la fila a la tabla
        tabla.appendChild(fila);
    });
}
