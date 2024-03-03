document.addEventListener('DOMContentLoaded', function(){
    const url = './controlador/userController.php';
    const tabla = document.querySelector('#tablaEmpresas'); // Asegúrate de cambiar el ID de acuerdo a tu HTML
    const botonesBuscar = document.querySelectorAll('.search');
    const botonBuscarTodas = document.querySelector('#buscarTodas'); // Botón oculto para buscar todas las empresas

    // Asignar eventos de clic a los botones de búsqueda
    botonesBuscar.forEach(function(boton) {
        boton.addEventListener('click', function(event) {
            const parametro = this.nextElementSibling.value;
            const valor = this.previousElementSibling.value;
            buscarEmpresas(parametro, valor);
        });
    });

    // Evento de clic para el botón oculto de buscar todas las empresas
    botonBuscarTodas.addEventListener('click', function() {
        const parametro = this.nextElementSibling.value;
        const valor = this.previousElementSibling.value;
        buscarEmpresas(parametro, valor);
    });

    // Función para buscar empresas y actualizar la tabla
    function buscarEmpresas(parametro, valor) {
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'parametro=' + encodeURIComponent(parametro) + '&valor=' + encodeURIComponent(valor)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la solicitud');
            }
            return response.json();
        })
        .then(data => {
            // Actualizar la tabla con los resultados de la búsqueda
            actualizarTabla(data);
        })
        .catch(error => console.error('Error:', error));
    }

    // Función para actualizar la tabla con los datos recibidos
    function actualizarTabla(data) {
        // Limpiar la tabla
        tabla.innerHTML = '';

        // Crear el encabezado de la tabla
        const encabezado = `
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>CIF</th>
                    <th>Dueño</th>
                    <th>Firmante del Convenio</th>
                    <th>Dirección</th>
                    <th>Email Empresa</th>
                    <th>Teléfono Empresa</th>
                    <th>Nombre de Contacto</th>
                    <th>Email de Contacto</th>
                    <th>Teléfono de Contacto</th>
                </tr>
            </thead>
        `;
        tabla.insertAdjacentHTML('beforeend', encabezado);

        // Verificar si hay resultados
        if (data && data.length > 0) {
            // Iterar sobre los datos recibidos y agregarlos a la tabla
            data.forEach(empresa => {
                const {ID_Control_Empresa, Nombre, CIF, Duenyo, Firmante_Convenio, Direccion, EMAIL_Empresa, TELF_Empresa, Nombre_Contacto, EMAIL_Contacto_Empresa, TELF_Contacto_Empresa} = empresa;
                const fila = `
                    <tr>
                        <td>${ID_Control_Empresa}</td>
                        <td>${Nombre}</td>
                        <td>${CIF}</td>
                        <td>${Duenyo}</td>
                        <td>${Firmante_Convenio}</td>
                        <td>${Direccion}</td>
                        <td>${EMAIL_Empresa}</td>
                        <td>${TELF_Empresa}</td>
                        <td>${Nombre_Contacto}</td>
                        <td>${EMAIL_Contacto_Empresa}</td>
                        <td>${TELF_Contacto_Empresa}</td>
                    </tr>
                `;
                tabla.insertAdjacentHTML('beforeend', fila);
            });
        } else {
            // Mostrar un mensaje si no hay resultados
            const mensaje = `<tr><td colspan="11">No se encontraron resultados</td></tr>`;
            tabla.insertAdjacentHTML('beforeend', mensaje);
        }
    }
});
