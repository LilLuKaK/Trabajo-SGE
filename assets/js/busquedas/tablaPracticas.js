document.addEventListener('DOMContentLoaded', function(){
    const url = './controlador/userController.php';
    const tabla = document.querySelector('#tablaEmpresas');
    const buscarAlumnoPracticas = document.querySelector('#buscarAlumnoPracticas');
    const buscarTutorCentro = document.querySelector('#buscarTutorCentro');
    const buscarTutorEmpresa = document.querySelector('#buscarTutorEmpresa');
    const buscarAnexo = document.querySelector('#buscarAnexo');

    buscarAlumnoPracticas.addEventListener('click', function(){
        const nombre = document.querySelector('#nombre').value;
        buscarYActualizar({ buscarAlumnoPracticas: true, nombre: nombre });
    });

    buscarTutorCentro.addEventListener('click', function(){
        const tutor_centro = document.querySelector('#tutor_centro').value;
        buscarYActualizar({ buscarTutorCentro: true, tutor_centro: tutor_centro });
    });

    buscarTutorEmpresa.addEventListener('click', function(){
        const tutor_empresa = document.querySelector('#tutor_empresa').value;
        buscarYActualizar({ buscarTutorEmpresa: true, tutor_empresa: tutor_empresa });
    });

    buscarAnexo.addEventListener('click', function(){
        const anexo = document.querySelector('#anexo').value;
        buscarYActualizar({ buscarAnexo: true, anexo: anexo });
    });

    function buscarYActualizar(parametros) {
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
                    <th>Nombre del alumno</th>
                    <th>Apellidos del alumno</th>
                    <th>CV</th>
                    <th>Tutor del centro</th>
                    <th>Empresa</th>
                    <th>Tutor de prácticas</th>
                    <th>Fecha de inicio</th>
                    <th>Fecha de fin</th>
                    <th>Cuadrante</th>
                    <th>Anexo</th>
                    <th>Versionado</th>
                    <th>Horario</th>
                    <th>Horas Totales</th>
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
                const {Nombre_Alumno, Apellidos_Alumno, CV, Tutor_Centro, Nombre_Empresa, Tutor_Practicas, Fecha_Inicio, Fecha_Final, Cuadrante, Anexo, Versionado, Horario, Horas_Totales} = alumno;
                const fila = `
                    <tr class="fila-ciclo">
                        <td><input type='hidden' name='Nombre_Alumno' value='${Nombre_Alumno}'><span>${Nombre_Alumno}</span></td>
                        <td><input type='text' name='Apellidos_Alumno' value='${Apellidos_Alumno}' readonly class='compact-input'></td>
                        <td><input type='text' name='CV' value='${CV}' readonly class='compact-input'></td>
                        <td><input type='text' name='Tutor_Centro' value='${Tutor_Centro}' readonly class='compact-input'></td>
                        <td><input type='text' name='Tutor_Centro' value='${Nombre_Empresa}' readonly class='compact-input'></td>
                        <td><input type='text' name='Tutor_Practicas' value='${Tutor_Practicas}' readonly class='compact-input'></td>
                        <td><input type='text' name='Fecha_Inicio' value='${Fecha_Inicio}' readonly class='compact-input'></td>
                        <td><input type='text' name='Fecha_Final' value='${Fecha_Final}' readonly class='compact-input'></td>
                        <td><input type='text' name='Cuadrante' value='${Cuadrante}' readonly class='compact-input'></td>
                        <td><input type='text' name='Anexo' value='${Anexo}' readonly class='compact-input'></td>
                        <td><input type='text' name='Versionado' value='${Versionado}' readonly class='compact-input'></td>
                        <td><input type='text' name='Horario' value='${Horario}' readonly class='compact-input'></td>
                        <td><input type='text' name='Horas_Totales' value='${Horas_Totales}' readonly class='compact-input'></td>
                    </tr>
                `;
                tabla.insertAdjacentHTML('beforeend', fila);
            });
        }
    }
});
