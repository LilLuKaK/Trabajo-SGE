'use strict'

document.addEventListener('DOMContentLoaded', function(){
    const buscar = document.querySelector('#buscarDni');
    const url = './controlador/userController.php';
    const tabla = document.querySelector('#tablaAlumnos');

    buscar.addEventListener('click', function(){
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

            //limpiamos la tabla
            tabla.innerHTML= "";

            //agregamos la estructura del encabezado de la tabla

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

            //verificar si hay resultado
            if(data.length === 0){
                const mensaje = document.createElement('tr');
                mensaje.innerHTML = `<td colspan="14">No se encontraron resultados para la busqueda.</td>`;
                tabla.appendChild(mensaje);
            }else{
                //iteramos sobre los datos devueltos y agregarlos a la tabla
                data.forEach(alumno => {
                    const fila = document.createElement('tr');
                    const {ID_Alumno, Nombre, Apellido1, Apellido2, DNI, N_Seg_social, Curriculum_Vitae,
                        Fecha_Ultima_Activo, Activo, Validez, TELF_Alumno, EMAIL_Alumno, Direccion,
                        Codigo_Postal, Nombre_Ciclo} = alumno;
                    fila.innerHTML = `
                        
                        <tbody>
                            <td>
                            <button class='delete'><span class='material-symbols-sharp'>delete</span></button>
                            <button class='edit'><span class='material-symbols-sharp'>edit</span></button>
                            </td>
                            <td>${ID_Alumno}</td>
                            <td>${Nombre}</td>
                            <td>${Apellido1}</td>
                            <td>${DNI}</td>
                            <td>${Nombre_Ciclo}</td>
                            <td>${N_Seg_social}</td>
                            <td><span class='material-symbols-sharp'>download</span></td>
                            <td>${Validez == 1 ? 'Sí' : 'No'}</td>
                            <td>${Activo == 1 ? 'Sí' : 'No'}</td>
                            <td>${TELF_Alumno}</td>
                            <td>${EMAIL_Alumno}</td>
                            <td>${Direccion}</td>
                            <td>${Codigo_Postal}</td>
                        </tbody>
                    `;
                    tabla.appendChild(fila);
                });
            }
        
        })
        .catch(error => console.error('Error:', error));
    });

});
