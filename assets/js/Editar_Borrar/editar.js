document.addEventListener('DOMContentLoaded', function(){
    const botonesEdit = document.querySelectorAll('.edit'); // Seleccionar todos los botones de edición
    
    botonesEdit.forEach(boton => { // Iterar sobre cada botón de edición
        boton.addEventListener('click', (e)=>{
            e.preventDefault();
            const idAlumno = boton.getAttribute('name'); // Obtener el valor del atributo name del botón
            
            // Crear un objeto FormData para enviar los datos al backend
            const formData = new FormData();
            formData.append('idAlumno', idAlumno);
            
            // Realizar la solicitud fetch al backend
            fetch('./controlador/userController.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                // Acceder al formulario editarAlumno
                const editarAlumnoForm = document.querySelector('#formEditarAlumno');

                // Verificar si el formulario se ha seleccionado correctamente
                if (editarAlumnoForm) {
                    // Establecer los valores de los campos del formulario con los datos del alumno
                    editarAlumnoForm.elements['nombre'].value = data.Nombre;
                    editarAlumnoForm.elements['apellidos'].value = data.Apellido1 + ' ' + data.Apellido2;
                    editarAlumnoForm.elements['dni'].value = data.DNI;
                    editarAlumnoForm.elements['N_Seg_social'].value = data.N_Seg_social;
                    editarAlumnoForm.elements['Curriculum_Vitae'].value = data.Curriculum_Vitae;
                    editarAlumnoForm.elements['activo'].value = data.Activo;
                    editarAlumnoForm.elements['validez'].value = data.Validez;
                    editarAlumnoForm.elements['TELF_Alumno'].value = data.TELF_Alumno;
                    editarAlumnoForm.elements['EMAIL_Alumno'].value = data.EMAIL_Aumno;
                    editarAlumnoForm.elements['Direccion'].value = data.Direccion;
                    editarAlumnoForm.elements['Codigo_Postal'].value = data.Codigo_Postal;
                    editarAlumnoForm.elements['centro'].value = data.ID_Centro;
                    editarAlumnoForm.elements['ciclo'].value = data.ID_Ciclo_Formativo;

                    // Aquí puedes manejar la respuesta del backend, por ejemplo, llenando un formulario con los datos del alumno
                    console.log(data);
                } else {
                    console.error('El formulario editarAlumno no se ha encontrado en el DOM.');
                }
            })
            .catch(error => {
                console.error('Error al enviar la solicitud:', error);
            });
        });
    });
});
