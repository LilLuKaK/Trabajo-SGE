document.addEventListener('DOMContentLoaded', function(){
    const url = './controlador/userController.php';
    const tabla = document.querySelector('#tablaAlumnos');

    const buscar = document.querySelector('#buscarAlumno');

    const buscarDni = document.querySelector('#buscarDni');

    const botonBuscarValidez = document.querySelector('#searchBtn');

    const botonBuscar = document.querySelector('#last');
    const selectCiclos = document.querySelector('#ciclos');

    // Función para asignar eventos de clic a los botones de editar y guardar
    function asignarEventosEditarGuardar() {
        tabla.querySelectorAll('.edit').forEach(btnEdit => {
            btnEdit.addEventListener('click', function() {
                const fila = btnEdit.closest('tr');
                fila.classList.add('editando');
                const btnSave = fila.querySelector('.save');
                if (btnSave) {
                    btnSave.style.display = 'inline';
                }
                
                // Habilitar la edición de los campos de la fila
                fila.querySelectorAll('input').forEach(input => {
                    input.removeAttribute('readonly');
                    input.classList.add('editable');
                });

                // Habilitar la edición de los campos "Validez" y "Activo"
                const checkboxValidez = fila.querySelector('.validez-checkbox');
                const checkboxActivo = fila.querySelector('.activo-checkbox');
                if (checkboxValidez) {
                    checkboxValidez.removeAttribute('disabled');
                }
                if (checkboxActivo) {
                    checkboxActivo.removeAttribute('disabled');
                }
            });
        });

        tabla.querySelectorAll('.save').forEach(btnSave => {
            btnSave.addEventListener('click', function() {
                const fila = btnSave.closest('tr');
                fila.classList.remove('editando');
                btnSave.style.display = 'none';
                
                // Deshabilitar la edición de los campos de la fila
                fila.querySelectorAll('input').forEach(input => {
                    input.setAttribute('readonly', 'readonly');
                    input.classList.remove('editable');
                });

                // Deshabilitar la edición de los campos "Validez" y "Activo"
                const checkboxValidez = fila.querySelector('.validez-checkbox');
                const checkboxActivo = fila.querySelector('.activo-checkbox');
                if (checkboxValidez) {
                    checkboxValidez.setAttribute('disabled', 'disabled');
                }
                if (checkboxActivo) {
                    checkboxActivo.setAttribute('disabled', 'disabled');
                }
            });
        });
    }

    buscar.addEventListener('click', function(){
        const input = document.querySelector('#nombre').value;
        const nombre = input;

        fetch(url,{
            method: 'POST',
            body: new URLSearchParams({
                buscarAlumno: true,
                nombre: nombre
            })
        })
        .then(response => response.json())
        .then(data =>{
            // Actualizar la tabla con los resultados de la búsqueda
            actualizarTabla(data);
        })
        .catch(error => console.error('Error:', error));
    });

    buscarDni.addEventListener('click', function(){
        const input = document.querySelector('#dni').value;
        const dni = input;

        fetch(url,{
            method: 'POST',
            body: new URLSearchParams({
                buscarDni: true,
                dni: dni
            })
        })
        .then(response => response.json())
        .then(data =>{
            // Actualizar la tabla con los resultados de la búsqueda
            actualizarTabla(data);
        })
        .catch(error => console.error('Error:', error));
    });

    botonBuscarValidez.addEventListener('click', function(){
        const slider = document.querySelector('#slider');
        const valorSlider = slider.checked ? 0 : 1;
        
        fetch(url,{
            method: 'POST',
            body: new URLSearchParams({
                searchBoton: valorSlider
            })
        })
        .then(response => response.json())
        .then(data =>{
            // Actualizar la tabla con los resultados de la búsqueda
            actualizarTabla(data);
        })
        .catch(error => console.error('Error:', error));
    });

    botonBuscar.addEventListener('click', function(){
        const cicloSeleccionado = selectCiclos.value;
        
        fetch(url,{
            method: 'POST',
            body: new URLSearchParams({
                buscarFP: true,
                ciclo: cicloSeleccionado
            })
        })
        .then(response => response.json())
        .then(data =>{
            // Actualizar la tabla con los resultados de la búsqueda
            actualizarTabla(data);
        })
        .catch(error => console.error('Error:', error));
    });

    // Función para actualizar la tabla con los resultados de la búsqueda
    function actualizarTabla(data) {
        // Limpiamos la tabla
        tabla.innerHTML= "";

        // Agregamos la estructura del encabezado de la tabla
        const encabezado = `
            <thead>
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>DNI</th>
                    <th>Ciclo</th>
                    <th>SS</th>
                    <th>CV</th>
                    <th>Validez</th>
                    <th>Activo</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Dirección</th>
                    <th>CP</th>
                </tr>
            </thead>
        `;
        tabla.insertAdjacentHTML('beforeend', encabezado);

        // Verificar si hay resultado
        if(data.length === 0){
            const mensaje = document.createElement('tr');
            mensaje.innerHTML = `<td colspan="14">No se encontraron resultados para la búsqueda.</td>`;
            tabla.appendChild(mensaje);
        } else {
            // Iterar sobre los datos devueltos y agregarlos a la tabla
            data.forEach(alumno => {
                const {ID_Alumno, Nombre, Apellido1, Apellido2, DNI, N_Seg_social, Curriculum_Vitae,
                    Fecha_Ultima_Activo, Activo, Validez, TELF_Alumno, EMAIL_Alumno, Direccion,
                    Codigo_Postal, Nombre_Ciclo} = alumno;
                const fila = `
                    <tr class="fila-alumno">
                        <td class='button-container'>
                            <button class='delete'><span class='material-symbols-sharp'>delete</span></button>
                            <button class='edit'><span class='material-symbols-sharp'>edit</span></button>
                            <button class='save' style='display: none'><span class='material-symbols-sharp'>save</span></button>
                        </td>
                        <td><input type='hidden' name='id' value='${ID_Alumno}'><span>${ID_Alumno}</span></td>
                        <td><input type='text' name='nombre' value='${Nombre}' readonly class='compact-input'></td>
                        <td><input type='text' name='apellidos' value='${Apellido1}' readonly class='compact-input'></td>
                        <td><input type='text' value='${DNI}' readonly class='compact-input'></td>
                        <td><input type='text' value='${Nombre_Ciclo}' readonly class='compact-input'></td>
                        <td><input type='text' value='${N_Seg_social}' readonly class='compact-input'></td>
                        <td><span class='material-symbols-sharp'>download</span></td>
                        <td><input type='text' value='${Validez == 1 ? 'Sí' : 'No'}' readonly class='compact-input'></td>
                        <td><input type='text' value='${Activo == 1 ? 'Sí' : 'No'}' readonly class='compact-input'></td>
                        <td><input type='text' value='${TELF_Alumno}' readonly class='compact-input'></td>
                        <td><input type='text' value='${EMAIL_Alumno}' readonly class='compact-input'></td>
                        <td><input type='text' value='${Direccion}' readonly class='compact-input'></td>
                        <td><input type='text' value='${Codigo_Postal}' readonly class='compact-input'></td>
                    </tr>
                `;
                tabla.insertAdjacentHTML('beforeend', fila);
            });

            // Asignar eventos de clic a los botones de editar y guardar
            asignarEventosEditarGuardar();
        }
    }
});
