document.addEventListener('DOMContentLoaded', function(){
    const userControllerURL = './controlador/userController.php';
    const buscar = document.querySelector('#buscarAlumno');
    const tabla = document.querySelector('#tablaALumnos');
    let filtroActual = '';

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
                fila.querySelectorAll('input, select').forEach(input => {
                    input.removeAttribute('readonly');
                    input.classList.add('editable');
                });

                // Habilitar el campo de selección de ciclo
                const cicloSelect = fila.querySelector('select[name="ciclo"]');
                if (cicloSelect) {
                    cicloSelect.removeAttribute('disabled');
                }

                // Actualizar el campo de selección de ciclo
                actualizarCampoCiclo(fila);
            });
        });

        tabla.querySelectorAll('.save').forEach(btnSave => {
            btnSave.addEventListener('click', function() {
                const fila = btnSave.closest('tr');
                const idAlumno = fila.querySelector('input[type="hidden"]').value;
                const nombre = fila.querySelector('input[name="nombre"]').value;
                const apellidos = fila.querySelector('input[name="apellidos"]').value;
                const dni = fila.querySelector('input[name="dni"]').value;

                const cicloSelect = fila.querySelector('select[name="ciclo"]');
                const idCiclo = cicloSelect ? cicloSelect.value : '';

                const N_Seg_social = fila.querySelector('input[name="N_Seg_social"]').value;

                const validezCheckbox = fila.querySelector('input[name="Validez"]:checked');
                const validez = validezCheckbox ? (validezCheckbox.value === 'Sí' ? 1 : 0) : 0;

                const activoCheckbox = fila.querySelector('input[name="Activo"]:checked');
                const activo = activoCheckbox ? (activoCheckbox.value === 'Sí' ? 1 : 0) : 0;

                // Corrección: Obtener el valor del campo TELF_Alumno
                const TELF_Alumno = fila.querySelector('input[name="TELF_Alumno"]').value;
                const EMAIL_Alumno = fila.querySelector('input[name="EMAIL_Alumno"]').value;
                const Direccion = fila.querySelector('input[name="Direccion"]').value;
                const Codigo_Postal = fila.querySelector('input[name="Codigo_Postal"]').value;


                
               
                // Enviar una solicitud AJAX para guardar los datos actualizados
                fetch(userControllerURL, {
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
                        ciclo: idCiclo,
                        validez: validez,
                        activo: activo,
                        TELF_Alumno: TELF_Alumno, // Corrección aquí
                        EMAIL_Alumno: EMAIL_Alumno,
                        Direccion: Direccion,
                        Codigo_Postal: Codigo_Postal,
                        N_Seg_social: N_Seg_social
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Verifica la estructura de la respuesta JSON
                    
                    if (data && data.success) {
                        // Deshabilitar la edición y actualizar la interfaz
                        fila.querySelectorAll('input, select').forEach(input => {
                            input.setAttribute('readonly', 'readonly');
                            input.classList.remove('editable');
                        });
                        btnSave.style.display = 'none';
                        fila.classList.remove('editando');
                
                        // Actualizar las opciones del select de ciclos formativos
                        if (data.ciclos) {
                            const cicloSelect = fila.querySelector('select[name="ciclo"]');
                            cicloSelect.innerHTML = '';
                            data.ciclos.forEach(ciclo => {
                                const option = document.createElement('option');
                                option.value = ciclo.ID_Ciclo_Formativo;
                                option.text = ciclo.Nombre_Ciclo;
                                cicloSelect.appendChild(option);
                            });
                
                            actualizarCampoCiclo(fila);
                        }

                        // Mostrar SweetAlert de guardado exitoso
                        Swal.fire({
                            icon: 'success',
                            title: 'Guardado exitoso',
                            text: 'Los cambios han sido guardados correctamente.',
                            confirmButtonText: 'Aceptar'
                        });

                    } else {
                        console.error('Error al actualizar el alumno:', data.error);
                    }
                })
                .catch(error => {
                    console.error('Error al procesar la solicitud:', error);
                });
            });
        });
    }

    // Función para actualizar el campo de selección de ciclo
    function actualizarCampoCiclo(fila) {
        const datosAlumnoJSON = fila.dataset.datosAlumno ? JSON.parse(fila.dataset.datosAlumno) : null;
        if (datosAlumnoJSON) {
            const cicloSelect = fila.querySelector('select[name="ciclo"]');
            if (cicloSelect) {
                cicloSelect.innerHTML = '';
    
                // Agregar el ciclo asociado al alumno
                const cicloAsociado = datosAlumnoJSON.Ciclo;
                if (cicloAsociado) {
                    const optionAsociado = document.createElement('option');
                    optionAsociado.value = cicloAsociado.ID_Ciclo_Formativo;
                    optionAsociado.text = cicloAsociado.Nombre_Ciclo;
                    cicloSelect.appendChild(optionAsociado);
                }
    
                // Agregar los demás ciclos disponibles
                const ciclosArray = Object.values(datosAlumnoJSON.Ciclo);
                ciclosArray.forEach(ciclo => {
                    if (ciclo.ID_Ciclo_Formativo !== cicloAsociado.ID_Ciclo_Formativo) {
                        const option = document.createElement('option');
                        option.value = ciclo.ID_Ciclo_Formativo;
                        option.text = ciclo.Nombre_Ciclo;
                        cicloSelect.appendChild(option);
                    }
                });
    
                // Establecer el valor seleccionado como el ciclo asociado al alumno
                cicloSelect.value = cicloAsociado.ID_Ciclo_Formativo;
            }
        } else {
            console.error('No se encontraron datos válidos del alumno.');
        }
    }

    function actualizarTabla(data) {
        
        tabla.innerHTML = "";

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

        if (data.datosAlumno && Array.isArray(data.datosAlumno)) {
            data.datosAlumno.forEach(alumno => {
                const { ID_Alumno, Nombre, Apellido1, DNI, ID_Ciclo_Formativo, N_Seg_social, Validez, Activo, TELF_Alumno, EMAIL_Alumno, Direccion, Codigo_Postal } = alumno;
                const ciclo = getCicloNombre(ID_Ciclo_Formativo, data.ciclosFormativos);
                const fila = `
                    <tr class="fila-alumno" data-datos-alumno='${JSON.stringify(alumno)}'>
                        <td class='button-container'>
                            <button class='delete'><span class='material-symbols-sharp'>delete</span></button>
                            <button class='edit'><span class='material-symbols-sharp'>edit</span></button>
                            <button class='save' style='display: none'><span class='material-symbols-sharp'>save</span></button>
                        </td>
                        <td><input type='hidden' name='id' value='${ID_Alumno}'><span>${ID_Alumno}</span></td>
                        <td><input type='text' name='nombre' value='${Nombre}' readonly></td>
                        <td><input type='text' name='apellidos' value='${Apellido1}' readonly></td>
                        <td><input type='text' name='dni' value='${DNI}' readonly></td>
                        <td><select name='ciclo' disabled><option value='${ID_Ciclo_Formativo}'>${ciclo}</option></select></td>
                        <td><input type='text' name='N_Seg_social' value='${N_Seg_social}' readonly></td>
                        <td><span class='material-symbols-sharp'>download</span></td>
                        <td><input type='text' name='Validez' value='${Validez == 1 ? 'Sí' : 'No'}' readonly></td>
                        <td><input type='text' name='Activo' value='${Activo == 1 ? 'Sí' : 'No'}' readonly></td>
                        <td><input type='text' name='TELF_Alumno' value='${TELF_Alumno}' readonly></td>
                        <td><input type='text' name='EMAIL_Alumno' value='${EMAIL_Alumno}' readonly></td>
                        <td><input type='text' name='Direccion' value='${Direccion}' readonly></td>
                        <td><input type='text' name='Codigo_Postal' value='${Codigo_Postal}' readonly></td>
                        <td><input type='hidden' name='editarAlumno' value='true'></td> <!-- Campo oculto para identificar la acción -->
                    </tr>
                `;
                tabla.insertAdjacentHTML('beforeend', fila);
            });
        }

        asignarEventosEditarGuardar();
    }

    function getCicloNombre(idCiclo, ciclos) {
        const ciclo = ciclos.find(ciclo => ciclo.ID_Ciclo_Formativo === idCiclo);
        return ciclo ? ciclo.Nombre_Ciclo : '';
    }

    
    // Asignar evento al botón de buscar
    buscar.addEventListener('click', function(){
        const input = document.querySelector('#nombre').value;
        const nombre = input;

        fetch(userControllerURL,{
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
