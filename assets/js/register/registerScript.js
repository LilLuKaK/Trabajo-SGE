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

    const nombreInput = document.getElementById('nombre');
    const apellidosInput = document.getElementById('apellidos');
    const emailInput = document.getElementById('email');
    const claveInput = document.getElementById('clave');
    const claveRepetidaInput = document.getElementById('claveRepetida');
    const centroSelect = document.getElementById('centro');

    const nombreError = document.getElementById('nombre-error');
    const apellidosError = document.getElementById('apellidos-error');
    const emailError = document.getElementById('email-error');
    const claveError = document.getElementById('clave-error');
    const claveRepetidaError = document.getElementById('claveRepetida-error');
    const centroSelectError = document.getElementById('centro-error');

    const enviarButton = document.getElementById('buttonEnviar');
    


    function validarNombre() {
        const nombrePattern = /(^[A-ZÁÉÍÓÚ]{1}[a-záéíóú]+)(\s[A-ZÁÉÍÓÚ]{1}[a-záéíóú]+)?$/;
        if (nombreInput.value.trim() === "") {
            nombreError.textContent = '';
            return false;
        } else if (!nombrePattern.test(nombreInput.value)) {
            nombreError.textContent = 'Formato incorrecto. Debe seguir el patrón Ej. CFP Juan XXIII';
            nombreError.style.color ='red';
            nombreError.style.fontSize ='13px';
            return false;
        } else {
            nombreError.textContent = '';
            return true;
        }
    }

    function validarApellidos() {
        const contenedorApellidos = document.getElementById('contenedorApellidos');
        const apellidosPattern = /(^[A-ZÁÉÍÓÚ]{1}[a-záéíóú]+)(\s[A-ZÁÉÍÓÚ]{1}[a-záéíóú]+)?$/;
        if (apellidosInput.value.trim() === "") {
            apellidosError.textContent = '';
            return false;
        } else if (!apellidosPattern.test(apellidosInput.value)) {
            apellidosError.textContent = 'Formato incorrecto. Debe seguir el patrón Ej. Doe';
            apellidosError.style.color ='red';
            apellidosError.style.fontSize ='13px';
            return false;
        } else {
            apellidosError.textContent = '';
            return true;
        }
    }

    function validarEmail() {
        const emailPattern = /(^\w+.?\w*)\@([a-z]+.?[a-z]*)\.([a-z]+)?$/;
        if (emailInput.value.trim() === "") {
            emailError.textContent = '';
            return false;
        } else if (!emailPattern.test(emailInput.value)) {
            emailError.textContent = 'Formato incorrecto. Debe seguir el patrón especificado: ejemplo@ejemplo.com';
            emailError.style.color ='red';
            emailError.style.fontSize ='13px';
            return false;
        } else {
            emailError.textContent = '';
            return true;
        }
    }

    function validarClave() {
        const clavePattern = /^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){1,16}$/;
        if (claveInput.value.trim() === "") {
            claveError.textContent = '';
            return false;
        } else if (!clavePattern.test(claveInput.value)) {
            claveError.textContent = 'Debe tener mayúsculas, minúsculas, números y caracteres especiales';
            claveError.style.color ='red';
            claveError.style.fontSize ='13px';
            return false;
        } else {
            claveError.textContent = '';
            return true;
        }
    }

    function validarClaveRepetida() {
        const claveRepetidaPattern = /^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){1,16}$/;
        if (claveRepetidaInput.value.trim() === "") {
            claveRepetidaError.textContent = '';
            return false;
        } else if (claveRepetidaInput.value != claveInput.value){
            claveRepetidaError.textContent = 'Las contraseñas no coinciden, deben ser iguales.';
            claveRepetidaError.style.color ='red';
            claveRepetidaError.style.fontSize ='13px';
            return false;
        } else if (!claveRepetidaPattern.test(claveRepetidaInput.value)) {
            claveRepetidaError.textContent = 'Debe tener mayúsculas, minúsculas, números y caracteres especiales.';
            claveRepetidaError.style.color ='red';
            claveRepetidaError.style.fontSize ='13px';
            return false;
        }else {
            claveRepetidaError.textContent = '';
            return true;
        }
    }

    function validarCentro() {
        if (centroSelect.value == '') {
            centroSelectError.textContent = 'Debes seleccionar un centro de la lista.';
            centroSelectError.style.fontSize ='13px';
            return false;
        }else {
            centroSelectError.textContent = '';
            return true;
        }
    }

    function validarInput(inputFunc, errorDiv) {
        inputFunc();
        habilitarBoton();
    }

    function habilitarBoton() {
        enviarButton.disabled = !(validarNombre() && validarApellidos() && validarEmail() && validarClave() && validarClaveRepetida() && validarCentro());
    }

    nombreInput.addEventListener('input', function () {
        validarInput(validarNombre, nombreError);
    });

    apellidosInput.addEventListener('input', function () {
        validarInput(validarApellidos, apellidosError);
    });

    emailInput.addEventListener('input', function () {
        validarInput(validarEmail, emailError);
    });

    claveInput.addEventListener('input', function () {
        validarInput(validarClave, claveError);
    });

    claveRepetidaInput.addEventListener('input', function () {
        validarInput(validarClaveRepetida, claveRepetidaError);
    });

    centroSelect.addEventListener('input', function () {
        validarInput(validarCentro, centroSelectError);
    });

    enviarButton.addEventListener('click', function (event) {
        event.preventDefault();

        if (validarNombre() && validarApellidos() && validarEmail() && validarClave() && validarClaveRepetida() && validarCentro()) {
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
                        title: "Todo a funcionado!",
                        text: data.success
                    }).then(() => {
                        window.location.href = 'index.php?pages=landing';
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

//------------------------------------------------------------------------------------------

document.addEventListener('DOMContentLoaded', function () {
    const claveInput = document.getElementById('clave');
    const togglePasswordIcon = document.getElementById('togglePassword');

    togglePasswordIcon.addEventListener('click', function () {
        if (claveInput.type === 'password') {
            claveInput.type = 'text';
            togglePasswordIcon.classList.remove('fa-eye-slash');
            togglePasswordIcon.classList.add('fa-eye');
        } else {
            claveInput.type = 'password';
            togglePasswordIcon.classList.remove('fa-eye');
            togglePasswordIcon.classList.add('fa-eye-slash');
        }
    });
});