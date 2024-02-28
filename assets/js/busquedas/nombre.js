document.addEventListener('DOMContentLoaded', function(){
    const url = './controlador/userController.php';
    const buscar = document.querySelector('#buscarAlumno');
    const tabla = document.querySelector('#tablaAlumnos');
    let filtroActual = ''; // Estado para almacenar el filtro actual

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
                const idAlumno = fila.querySelector('input[type="hidden"]').value;
                const nombre = fila.querySelector('input[name="nombre"]').value;
                const apellidos = fila.querySelector('input[name="apellidos"]').value;
                const dni = fila.querySelector('td:nth-child(5) input').value;
                const cicloSelect = fila.querySelector('#ciclo');
                const ciclo = cicloSelect ? cicloSelect.value : null;
                const seguridaSocialInput = fila.querySelector('#N_Seg_social');
                const seguridaSocial = seguridaSocialInput ? seguridaSocialInput.value : null;

                const validez = fila.querySelector('input[name="validez"]:checked').value; // Obtener el valor del radio "Validez" seleccionado
                const activo = fila.querySelector('input[name="activo"]:checked').value; // Obtener el valor del radio "Activo" seleccionado
                const telefono = fila.querySelector('input[name="TELF_Alumno"]').value;
                const correo = fila.querySelector('input[name="EMAIL_Alumno"]').value;
                const direccion = fila.querySelector('input[name="Direccion"]').value;
                const codigoPostal = fila.querySelector('input[name="Codigo_Postal"]').value;
                        


                // Enviar una solicitud AJAX para guardar los datos actualizados
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({
                        editarAlumno: true,
                        id: idAlumno,
                        nombre: nombre,
                        apellidos: apellidos,
                        dni: dni,
                        ciclo: ciclo,
                        seguridaSocial: seguridaSocial,
                        validez: validez,
                        activo: activo,
                        telefono: telefono,
                        correo: correo,
                        direccion: direccion,
                        codigoPostal: codigoPostal
                        // Agregar otros datos editados según sea necesario
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Manejar la respuesta del servidor (éxito o error)
                    console.log(data); // Puedes mostrar mensajes de éxito o error según la respuesta del servidor
                    // Actualizar la tabla después de guardar los datos
                    if (data.success) {
                        // Deshabilitar la edición y actualizar la interfaz
                        fila.querySelectorAll('input').forEach(input => {
                            input.setAttribute('readonly', 'readonly');
                            input.classList.remove('editable');
                        });
                        const checkboxValidez = fila.querySelector('.validez-checkbox');
                        const checkboxActivo = fila.querySelector('.activo-checkbox');
                        if (checkboxValidez) {
                            checkboxValidez.setAttribute('disabled', 'disabled');
                        }
                        if (checkboxActivo) {
                            checkboxActivo.setAttribute('disabled', 'disabled');
                        }
                        btnSave.style.display = 'none';
                        fila.classList.remove('editando');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });
    }

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
                        <td><input type='text' value='${Nombre_Ciclo}' id='ciclo' readonly class='compact-input'></td>
                        <td><input type='text' value='${N_Seg_social}' id='N_Seg_social' readonly class='compact-input'></td>
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
});
