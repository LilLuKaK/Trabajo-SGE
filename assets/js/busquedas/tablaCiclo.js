document.addEventListener('DOMContentLoaded', function(){
    const url = './controlador/userController.php';
    const tabla = document.querySelector('#tablaCiclos');
    const buscarCiclo = document.querySelector('#buscarCiclo');

    buscarCiclo.addEventListener('click', function(){
        const ciclo = document.querySelector('#ciclo').value;
        buscarYActualizar(url, { buscarCiclo: true, ciclo: ciclo });
    });

    function buscarYActualizar(url, parametros) {
        fetch(url, {
            method: 'POST',
            body: new URLSearchParams(parametros)
        })
        .then(response => response.json())
        .then(data => {
            // Actualizar la tabla con los resultados de la búsqueda
            actualizarTabla(data);
        })
        .catch(error => console.error('Error:', error));
    }

    // Función para actualizar la tabla con los resultados de la búsqueda
    function actualizarTabla(data) {
        // Limpiamos la tabla
        tabla.innerHTML = "";

        // Agregamos la estructura del encabezado de la tabla
        const encabezado = `
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Ciclo</th>
                    <th>Numero total de alumnos</th>
                    <th>Alumnos con prácticas</th>
                    <th>Alumnos sin practicas</th>
                </tr>
            </thead>
        `;
        tabla.insertAdjacentHTML('beforeend', encabezado);

        // Verificar si hay resultados
        if(data.length === 0){
            const mensaje = document.createElement('tr');
            mensaje.innerHTML = `<td colspan="14">No se encontraron resultados para la búsqueda.</td>`;
            tabla.appendChild(mensaje);
        } else {
            // Iterar sobre los datos devueltos y agregarlos a la tabla
            data.forEach(alumno => {
                const {ID_Ciclo_Formativo, Nombre_Ciclo, Total_Alumnos_Matriculados, Alumnos_Activos, Alumnos_Inactivos} = alumno;
                const fila = `
                    <tr class="fila-ciclo">
                        <td><input type='hidden' name='ID_Ciclo_Formativo' value='${ID_Ciclo_Formativo}'><span>${ID_Ciclo_Formativo}</span></td>
                        <td><input type='text' name='Nombre_Ciclo' value='${Nombre_Ciclo}' readonly class='compact-input'></td>
                        <td><input type='text' name='Total_Alumnos_Matriculados' value='${Total_Alumnos_Matriculados}' readonly class='compact-input'></td>
                        <td><input type='text' name='Alumnos_Activos' value='${Alumnos_Activos}' readonly class='compact-input'></td>
                        <td><input type='text' name='Alumnos_Inactivos' value='${Alumnos_Inactivos}' readonly class='compact-input'></td>
                    </tr>
                `;
                tabla.insertAdjacentHTML('beforeend', fila);
            });
        }
    }
});
