

document.addEventListener('DOMContentLoaded', function () {

    const nombreInput = document.getElementById('nombre');
    const cifInput = document.getElementById('cif');
    const duenyoInput = document.getElementById('duenyo');
    const firmanteInput = document.getElementById('firmante');
    const direccionInput = document.getElementById('direccion');
    const telefonoInput = document.getElementById('telefono');
    const emailInput = document.getElementById('email');

    const nombreError = document.getElementById('nombre-error');
    const cifError = document.getElementById('cif-error');
    const duenyoError = document.getElementById('duenyo-error');
    const firmanteError = document.getElementById('firmante-error');
    const direccionError = document.getElementById('direccion-error');
    const telefonoError = document.getElementById('telefono-error');
    const emailError = document.getElementById('email-error');

    const enviarButton = document.getElementById('buttonEnviar');
    


    function validarNombre() {
        const nombrePattern = /^[a-zA-Z0-9\sáéíóúüñÁÉÍÓÚÜÑ.,-]{0,50}$/;
        if (nombreInput.value.trim() === "") {
            nombreError.textContent = '';
            return false;
        } else if (!nombrePattern.test(nombreInput.value)) {
            nombreError.textContent = 'Formato incorrecto. No puede superar los 50 carácteres.';
            nombreError.style.color ='red';
            nombreError.style.fontSize ='13px';
            return false;
        } else {
            nombreError.textContent = '';
            return true;
        }
    }

    function validarDuenyo() {
        const nombrePattern = /(^[A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+)(\s[A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+)?$/;
        if (duenyoInput.value.trim() === "") {
            duenyoError.textContent = '';
            return false;
        } else if (!nombrePattern.test(duenyoInput.value)) {
            duenyoError.textContent = 'Formato incorrecto. Debe seguir el patrón Ej. John.';
            duenyoError.style.color ='red';
            duenyoError.style.fontSize ='13px';
            return false;
        } else {
            duenyoError.textContent = '';
            return true;
        }
    }

    function validarFirmante() {
        const nombrePattern = /(^[A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+)(\s[A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+)?$/;
        if (firmanteInput.value.trim() === "") {
            firmanteError.textContent = '';
            return false;
        } else if (!nombrePattern.test(firmanteInput.value)) {
            firmanteError.textContent = 'Formato incorrecto. Debe seguir el patrón Ej. John.';
            firmanteError.style.color ='red';
            firmanteError.style.fontSize ='13px';
            return false;
        } else {
            firmanteError.textContent = '';
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

    function validarCif() {
        const cifPattern = /^[A-HJNPQRSUVW]{1}[0-9]{7}[0-9A-J]{1}$/;
        if (cifInput.value.trim() === "") {
            cifError.textContent = '';
            return false;
        } else if (!cifPattern.test(cifInput.value)) {
            cifError.textContent = 'Formato incorrecto. Debe seguir el patrón de CIF correcto.';
            cifError.style.color ='red';
            cifError.style.fontSize ='13px';
            return false;
        } else {
            cifError.textContent = '';
            return true;
        }
    }

    function validarInput(inputFunc, errorDiv) {
        inputFunc();
        habilitarBoton();
    }

    function habilitarBoton() {
        enviarButton.disabled = !(validarNombre() && validarDireccion() && validarTelefono() 
        && validarEmail() && validarCif() && validarFirmante() && validarDuenyo());
    }

    nombreInput.addEventListener('input', function () {
        validarInput(validarNombre, nombreError);
    });

    duenyoInput.addEventListener('input', function () {
        validarInput(validarDuenyo, duenyoError);
    });

    firmanteInput.addEventListener('input', function () {
        validarInput(validarFirmante, firmanteError);
    });

    cifInput.addEventListener('input', function () {
        validarInput(validarCif, cifError);
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

    enviarButton.addEventListener('click', function (event) {
        event.preventDefault();
        if (validarNombre() && validarDireccion() && validarTelefono() 
        && validarEmail() && validarCif() && validarFirmante() && validarDuenyo()) {
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
                        window.location.href = 'index.php?pages=crearEmpresa';
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

