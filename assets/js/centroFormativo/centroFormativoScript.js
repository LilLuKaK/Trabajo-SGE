document.addEventListener('DOMContentLoaded', function () {

    const nombreInput = document.getElementById('nombre');
    const cifInput = document.getElementById('cif');
    const duenyoInput = document.getElementById('duenyo');
    const direccionInput = document.getElementById('direccion');
    const telefonoInput = document.getElementById('telefono');
    const emailInput = document.getElementById('email');

    const nombreError = document.getElementById('nombre-error');
    const cifError = document.getElementById('cif-error');
    const duenyoError = document.getElementById('duenyo-error');
    const direccionError = document.getElementById('direccion-error');
    const telefonoError = document.getElementById('telefono-error');
    const emailError = document.getElementById('email-error');

    const enviarButton = document.getElementById('buttonEnviar');
    


    function validarNombre() {
        const nombrePattern = /^(.){5,100}?$/;
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

    function validarCif() {
        const cifPattern = /^([A-Z]){1}([0-9]){8}?$/;
        if (cifInput.value.trim() === "") {
            cifError.textContent = '';
            return false;
        } else if (!cifPattern.test(cifInput.value)) {
            cifError.textContent = 'Formato incorrecto. Debe seguir el patrón de CIF A12345678.';
            cifError.style.color ='red';
            cifError.style.fontSize ='13px';
            return false;
        } else {
            cifError.textContent = '';
            return true;
        }
    }

    function validarDuenyo() {
        const duenyoPattern = /(^[A-ZÁÉÍÓÚ]{1}[a-záéíóú]+)(\s[A-ZÁÉÍÓÚ]{1}[a-záéíóú]+)?$/;
        if (duenyoInput.value.trim() === "") {
            duenyoError.textContent = '';
            return false;
        } else if (!duenyoPattern.test(duenyoInput.value)) {
            duenyoError.textContent = 'Formato incorrecto. Debe seguir el patrón Ej. John / John Doe';
            duenyoError.style.color ='red';
            duenyoError.style.fontSize ='13px';
            return false;
        } else {
            duenyoError.textContent = '';
            return true;
        }
    }

    function validarDireccion() {
        const direccionPattern = /^(.){5,100}?$/;
        if (direccionInput.value.trim() === "") {
            direccionError.textContent = '';
            return false;
        } else if (!direccionPattern.test(direccionInput.value)) {
            direccionError.textContent = 'Debe rellenar este campo. Incluye mínimo 5 caracteres y 100 caracteres como máximo.';
            direccionError.style.color ='red';
            direccionError.style.fontSize ='13px';
            return false;
        } else {
            direccionError.textContent = '';
            return true;
        }
    }

    function validarTelefono() {
        const telefonoPattern = /^([0-9]{9})?$/;
        if (telefonoInput.value.trim() === "") {
            telefonoError.textContent = '';
            return false;
        } else if (!telefonoPattern.test(telefonoInput.value)) {
            telefonoError.textContent = 'Formato incorrecto. Debe ser un numero de teléfono válido.';
            telefonoError.style.color ='red';
            telefonoError.style.fontSize ='13px';
            return false;
        } else {
            telefonoError.textContent = '';
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

    function validarInput(inputFunc, errorDiv) {
        inputFunc();
        habilitarBoton();
    }

    function habilitarBoton() {
        enviarButton.disabled = !(validarNombre() && validarCif() && validarDuenyo() && validarDireccion() && validarTelefono() && validarEmail());
    }

    nombreInput.addEventListener('input', function () {
        validarInput(validarNombre, nombreError);
    });

    cifInput.addEventListener('input', function () {
        validarInput(validarCif, cifError);
    });

    duenyoInput.addEventListener('input', function () {
        validarInput(validarDuenyo, duenyoError);
    });

    direccionInput.addEventListener('input', function () {
        validarInput(validarDireccion, direccionError);
    });

    telefonoInput.addEventListener('input', function () {
        validarInput(validarTelefono, telefonoError);
    });

    emailInput.addEventListener('input', function () {
        validarInput(validarEmail, emailError);
    });

    enviarButton.addEventListener('click', function (event) {
        event.preventDefault();

        if (validarNombre() && validarCif() && validarDuenyo() && validarDireccion() && validarTelefono() && validarEmail()) {
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
                        window.location.href = 'index.php?pages=crearCentro';
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