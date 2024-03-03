//Solicitud de los nombres de los centros para mostrarlo en la lista del registro
$(document).ready(function() {
    // Hacer una solicitud AJAX para obtener los nombres de los centros
    $.ajax({
        url: './modelo/centro_formativo.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Volcar los nombres de los centros al select
            var select = $('#centro');
            $.each(data, function(key, value) {
                select.append('<option id="' + value.ID_Centro_Formativo + '" value="' + value.ID_Centro_Formativo + '">' + value.Nombre + ' </option>');
            });
        },
        error: function(xhr, status, error) {
            console.error('Error al obtener los centros:', status, error);
        }
    });
});

//------------------------------------------------------------------------------------------------------------------------------------

document.addEventListener('DOMContentLoaded', function () {

    const anyoInput = document.getElementById('anyo');
    const cantidadInput = document.getElementById('cantidad');
    const cuadranteInput = document.getElementById('cuadrante');

    const anyoError = document.getElementById('anyo-error');
    const cantidadError = document.getElementById('cantidad-error');
    const cuadranteError = document.getElementById('cuadrante-error');

    const enviarButton = document.getElementById('buttonEnviar');
    

    function validarAnyo() {
        const anyoPattern = /^(202[4-9]|20[3-9]\d)$/;  
        if (anyoInput.value.trim() === "") {
            anyoError.textContent = '';
            return false;
        } else if (!anyoPattern.test(anyoInput.value)) {
            anyoError.textContent = 'Formato incorrecto o año fuera no compatible (2024-2099).';
            anyoError.style.color ='red';
            anyoError.style.fontSize ='13px';
            return false;
        } else {
                anyoError.textContent = '';
                return true;
        }
    }

    

    function validarCantidad() {
        const cantidadPattern = /^(?=.*[1-9])\d{1,2}$/;
        if (cantidadInput.value.trim() === "") {
            cantidadError.textContent = '';
            return false;
        } else if (!cantidadPattern.test(cantidadInput.value)) {
            cantidadError.textContent = 'Formato incorrecto. Debe seguir el patrón de numero de telefono.';
            cantidadError.style.color ='red';
            cantidadError.style.fontSize ='13px';
            return false;
        } else {
            cantidadError.textContent = '';
            return true;
        }
    }

    function validarCuadrante() {
      
        const cuadrantePattern = /^(abril|Septiembre)$/i; // Expresión regular para aceptar "abril" o "Septiembre" sin importar mayúsculas o minúsculas
    
        if (cuadranteInput.value.trim() === "") {
            cuadranteError.textContent = '';
            return false;
        } else if (!cuadrantePattern.test(cuadranteInput.value)) {
            cuadranteError.textContent = 'Formato incorrecto. Debe ser "abril" o "Septiembre".';
            cuadranteError.style.color ='red';
            cuadranteError.style.fontSize ='13px';
            return false;
        } else {
            cuadranteError.textContent = '';
            return true;
        }
    }

    
    function validarInput(inputFunc, errorDiv) {
        inputFunc();
        habilitarBoton();
    }

    function habilitarBoton() {
        enviarButton.disabled = !(validarAnyo() && validarCuadrante() && validarCantidad());
    }

    anyoInput.addEventListener('input', function () {
        validarInput(validarAnyo, anyoError);
    });

    cantidadInput.addEventListener('input', function () {
        validarInput(validarCantidad, cantidadError);
    });

    cuadranteInput.addEventListener('input', function () {
        validarInput(validarCuadrante, cuadranteError);
    });

    enviarButton.addEventListener('click', function (event) {
        event.preventDefault();

        if (validarAnyo() && validarCuadrante() && validarCantidad()) {
            const formData = new FormData(document.getElementById('registroForm'));

            fetch('./controlador/userController.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log(data.error);
                if (data.error) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: data.error
                    });
                } else if (data.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Todo ha funcionado!",
                        text: data.success
                    }).then(() => {
                        window.location.href = 'index.php?pages=consultarNecesidad';
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        } else {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Alguno de los campos no ha sido llenado correctamente o están vacíos."
            });
        }
    });
});

//------------------------------------------------------------------------------------------------------------------------------------

document.addEventListener("DOMContentLoaded", function () {
    var cursoCounter = 0;
    // Máximo número de cursos permitidos
    var maxCursos = 5;
    
    // Función para agregar un nuevo curso
    function agregarCurso() {
        if (cursoCounter < maxCursos) {
            cursoCounter++;
    
            var nuevoCursoHtml = `
                <div class="curso">
                    <h2>Curso ${cursoCounter}</h2>
                    <div class="form__control">
                        <label for="nombre_curso_${cursoCounter}">Nombre del Curso</label>
                        <input type="text" id="nombre_curso_${cursoCounter}" name="nombre_curso_${cursoCounter}" placeholder="Introduce el nombre del curso">
                    </div>
                    <div class="form__control">
                        <label for="vacantes_curso_${cursoCounter}">Vacantes del Curso</label>
                        <input type="text" id="vacantes_curso_${cursoCounter}" name="vacantes_curso_${cursoCounter}" placeholder="Introduce la cantidad de vacantes">
                    </div>
                </div>`;
    
            // Agregar el nuevo curso al formulario
            $('.sign-in__form').append(nuevoCursoHtml);
        } else {
            alert("Se ha alcanzado el máximo número de cursos permitidos.");
        }
    }
    
    // Llamar a la función agregarCurso cuando el botón "Agregar Curso" sea clicado
    $(document).ready(function() {
        $('#agregarCursoBtn').click(function() {
            agregarCurso();
        });
    });
});