document.addEventListener('DOMContentLoaded', function(){
    const url = './controlador/userController.php';
    const tabla = document.getElementById('tablaEmpresas');

    // Verifica si la tabla existe antes de agregar el event listener
    if (tabla) {
        tabla.addEventListener('click', function(event) {
            const boton = event.target.closest('.edit');
            console.log(boton);
            
            if (boton) {
                event.preventDefault();
                const idEmpresa = boton.getAttribute('name');
                console.log(idEmpresa);
                window.location.href = `./index.php?pages=editarEmpresa&id=${idEmpresa}`;
            }
        });
    }

    // Función para realizar la búsqueda y actualizar la tabla
    function buscarYActualizar(parametros) {
        fetch(url, {
            method: 'POST',
            body: new URLSearchParams(parametros)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al buscar y actualizar la tabla');
            }
            return response.json();
        })
        .then(data => {
            // Actualizar la tabla con los resultados de la búsqueda   
            actualizarTabla(data);
        })
        .catch(error => console.error('Error:', error));
    }

    // Evento de clic para buscar por nombre de la empresa
    const buscarEmpresa = document.querySelector('#buscarEmpresa');
    if (buscarEmpresa) {
        buscarEmpresa.addEventListener('click', function(){
            const nombreEmpresa = document.querySelector('#nombreEmpresa').value;
            buscarYActualizar({ buscarEmpresa: true, nombreEmpresa: nombreEmpresa });
        });
    }

    // Evento de clic para buscar por CIF
    const buscarCIF = document.querySelector('#buscarCIF');
    if (buscarCIF) {
        buscarCIF.addEventListener('click', function(){
            const CIF = document.querySelector('#CIF').value;
            buscarYActualizar({ buscarCIF: true, CIF: CIF });
        });
    }

    // Evento de clic para buscar por dueño
    const buscarDuenyo = document.querySelector('#buscarDuenyo');
    if (buscarDuenyo) {
        buscarDuenyo.addEventListener('click', function(){
            const duenyo = document.querySelector('#duenyo').value;
            buscarYActualizar({ buscarDuenyo: true, duenyo: duenyo });
        });
    }

    // Evento de clic para buscar por firmante
    const buscarFirmante = document.querySelector('#buscarFirmante');
    if (buscarFirmante) {
        buscarFirmante.addEventListener('click', function(){
            const firmante = document.querySelector('#firmante').value;
            buscarYActualizar({ buscarFirmante: true, firmante: firmante });
        });
    }

    // Función para actualizar la tabla con los resultados de la búsqueda
    function actualizarTabla(data) {
        // Limpiamos la tabla
        tabla.innerHTML = "";

        // Agregamos la estructura del encabezado de la tabla
        const encabezado = `
            <thead>
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>CIF</th>
                    <th>Dueño</th>
                    <th>Firmante del convenio</th>
                    <th>Direccion</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Nombre de contacto</th>
                    <th>Email de contacto</th>
                    <th>Telefono de contacto</th>
                </tr>
            </thead>
        `;
        tabla.insertAdjacentHTML('beforeend', encabezado);

        // Verificar si hay resultados
        if (data.length === 0) {
            const mensaje = document.createElement('tr');
            mensaje.innerHTML = `<td colspan="11">No se encontraron resultados para la búsqueda.</td>`;
            tabla.appendChild(mensaje);
        } else {
            // Iterar sobre los datos devueltos y agregarlos a la tabla
            data.forEach(empresa => {
                const { ID_Control_Empresa, Nombre_Empresa, CIF, Duenyo, Firmante_Convenio, Direccion, EMAIL_Empresa,
                    TELF_Empresa, Nombre_Contacto, EMAIL_Contacto_Empresa, TELF_Contacto_Empresa } = empresa;
                const fila = `
                    <tr class="fila-empresa">
                        <td class='button-container'>
                            <button class='delete'><span class='material-symbols-sharp'>delete</span></button>
                            <a href='index.php?pages=editarEmpresa'><button class='edit' name='${ID_Control_Empresa}' data-id='${ID_Control_Empresa}'><span class='material-symbols-sharp'>edit</span></button></a>
                            <button class='save' style='display: none'><span class='material-symbols-sharp'>save</span></button>
                        </td>
                        <td><input type='hidden' name='id' value='${ID_Control_Empresa}'><span>${ID_Control_Empresa}</span></td>
                        <td><input type='text' name='Nombre_Empresa' value='${Nombre_Empresa}' readonly class='compact-input'></td>
                        <td><input type='text' name='CIF' value='${CIF}' readonly class='compact-input'></td>
                        <td><input type='text' value='${Duenyo}' readonly class='compact-input'></td>
                        <td><input type='text' value='${Firmante_Convenio}' readonly class='compact-input'></td>
                        <td><input type='text' value='${Direccion}' readonly class='compact-input'></td>
                        <td><input type='text' value='${EMAIL_Empresa}' readonly class='compact-input'></td>
                        <td><input type='text' value='${TELF_Empresa}' readonly class='compact-input'></td>
                        <td><input type='text' value='${Nombre_Contacto}' readonly class='compact-input'></td>
                        <td><input type='text' value='${EMAIL_Contacto_Empresa}' readonly class='compact-input'></td>
                        <td><input type='text' value='${TELF_Contacto_Empresa}' readonly class='compact-input'></td>
                    </tr>
                `;
                tabla.insertAdjacentHTML('beforeend', fila);
            });
        }
    }
});
