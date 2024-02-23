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
    const dniInput = document.getElementById('dni');
    const ssInput = document.getElementById('N_Seg_social');
    const cvInput = document.getElementById('Curriculum_Vitae');
    const telefonoInput = document.getElementById('TELF_Alumno');
    const emailInput = document.getElementById('EMAIL_Alumno');
    const direccionInput = document.getElementById('Direccion');
    const cpInput = document.getElementById('Codigo_Postal');
    const centroSelect = document.getElementById('centro');
    const cicloSelect = document.getElementById('ciclo');

    const nombreError = document.getElementById('nombre-error');
    const apellidosError = document.getElementById('apellidos-error');
    const dniError = document.getElementById('dni-error');
    const ssError = document.getElementById('N_Seg_social-error');
    const cvError = document.getElementById('Curriculum_Vitae-error');
    const telefonoError = document.getElementById('TELF_Alumno-error');
    const emailError = document.getElementById('EMAIL_Alumno-error');
    const direccionError = document.getElementById('Direccion-error');
    const cpError = document.getElementById('Codigo_Postal-error');
    const centroSelectError = document.getElementById('centro-error');
    const cicloSelectError = document.getElementById('ciclo-error');

    const enviarButton = document.getElementById('buttonEnviar');
    


    function validarNombre() {
        const nombrePattern = /(^[A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+)(\s[A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+)?$/;
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
        const apellidosPattern = /(^[A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+)(\s[A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+)?$/;
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

    function validarDni() {
        const dniPattern = /^([0-9]){8}([A-Z]){1}?$/;
        if (dniInput.value.trim() === "") {
            dniError.textContent = '';
            return false;
        } else if (!dniPattern.test(dniInput.value)) {
            dniError.textContent = 'Formato incorrecto. Debe seguir el patrón de dni correcto.';
            dniError.style.color ='red';
            dniError.style.fontSize ='13px';
            return false;
        } else {
            dniError.textContent = '';
            return true;
        }
    }

    function validarSS() {
        const ssPattern = /^([0-9]){9}?$/;
        if (ssInput.value.trim() === "") {
            ssError.textContent = '';
            return false;
        } else if (!ssPattern.test(ssInput.value)) {
            ssError.textContent = 'Formato incorrecto. Debe seguir el patrón de numero de seguridad social correcto.';
            ssError.style.color ='red';
            ssError.style.fontSize ='13px';
            return false;
        } else {
            ssError.textContent = '';
            return true;
        }
    }

    function validarCV() {
        if (cvInput.value.trim() === "") {
            cvError.textContent = '';
            return false;
        } else {
            cvError.textContent = '';
            return true;
        }
    }

    function validarTelefono() {
        const telefonoPattern = /^([0-9]){9}?$/;
        if (telefonoInput.value.trim() === "") {
            telefonoError.textContent = '';
            return false;
        } else if (!telefonoPattern.test(telefonoInput.value)) {
            telefonoError.textContent = 'Formato incorrecto. Debe seguir el patrón de numero de telefono.';
            telefonoError.style.color ='red';
            telefonoError.style.fontSize ='13px';
            return false;
        } else {
            telefonoError.textContent = '';
            return true;
        }
    }

    function validarDireccion() {
        const direccionPattern = /(.){5,100}/;
        if (direccionInput.value.trim() === "") {
            direccionError.textContent = '';
            return false;
        } else if (!direccionPattern.test(direccionInput.value)) {
            direccionError.textContent = 'Formato incorrecto. Debe seguir el patrón de direccion.';
            direccionError.style.color ='red';
            direccionError.style.fontSize ='13px';
            return false;
        } else {
            direccionError.textContent = '';
            return true;
        }
    }

    function validarCP() {
        const cpPattern = /^(28[0-9]{3})?$/;
        if (cpInput.value.trim() === "") {
            cpError.textContent = '';
            return false;
        } else if (!cpPattern.test(cpInput.value)) {
            cpError.textContent = 'Formato incorrecto. Debe seguir el patrón de código postal 28000.';
            cpError.style.color ='red';
            cpError.style.fontSize ='13px';
            return false;
        } else {
            cpError.textContent = '';
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

    function validarCiclo() {
        if (cicloSelect.value == '') {
            cicloSelectError.textContent = 'Debes seleccionar un ciclo de la lista.';
            cicloSelectError.style.fontSize ='13px';
            return false;
        }else {
            cicloSelectError.textContent = '';
            return true;
        }
    }

    function validarInput(inputFunc, errorDiv) {
        inputFunc();
        habilitarBoton();
    }

    function habilitarBoton() {
        enviarButton.disabled = !(validarNombre() && validarApellidos() && validarCP() && validarCV() && validarDni() && validarSS() && validarDireccion() && validarTelefono() && validarEmail() && validarCentro() && validarCiclo());
    }

    nombreInput.addEventListener('input', function () {
        validarInput(validarNombre, nombreError);
    });

    apellidosInput.addEventListener('input', function () {
        validarInput(validarApellidos, apellidosError);
    });

    dniInput.addEventListener('input', function () {
        validarInput(validarDni, dniError);
    });

    ssInput.addEventListener('input', function () {
        validarInput(validarSS, ssError);
    });

    cpInput.addEventListener('input', function () {
        validarInput(validarCP, cpError);
    });

    cvInput.addEventListener('input', function () {
        validarInput(validarCV, cvError);
    });

    telefonoInput.addEventListener('input', function () {
        validarInput(validarTelefono, telefonoError);
    });

    direccionInput.addEventListener('input', function () {
        validarInput(validarDireccion, direccionError);
    });

    emailInput.addEventListener('input', function () {
        validarInput(validarEmail, emailError);
    });

    centroSelect.addEventListener('input', function () {
        validarInput(validarCentro, centroSelectError);
    });

    cicloSelect.addEventListener('input', function () {
        validarInput(validarCiclo, cicloSelectError);
    });

    enviarButton.addEventListener('click', function (event) {
        event.preventDefault();

        if (validarNombre() && validarApellidos() && validarCP() && validarDni() && validarCV() && validarSS() && validarDireccion() && validarTelefono() && validarEmail() && validarCentro() && validarCiclo()) {
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
                        window.location.href = 'index.php?pages=crearAlumno';
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

