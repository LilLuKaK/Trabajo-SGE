

document.addEventListener('DOMContentLoaded', function () {

    const anexoInput = document.getElementById('anexo');
    const tutorCentroInput = document.getElementById('tutorCentro');
    const tutorEmpresaInput = document.getElementById('tutorEmpresa');
    const fechaInicioInput = document.getElementById('fechaInicio');
    const fechaFinInput = document.getElementById('fechaFin');

    const anexoError = document.getElementById('anexo-error');
    const tutorCentroError = document.getElementById('tutorCentro-error');
    const tutorEmpresaError = document.getElementById('tutorEmpresa-error');
    const fechaInicioError = document.getElementById('fechaInicio-error');
    const fechaFinError = document.getElementById('fechaFin-error');

    const enviarButton = document.getElementById('buttonEnviar');
    


    function validarTutorCentro() {
        const nombrePattern = /(^[A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+)(\s[A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+)?$/;
        if (tutorCentroInput.value.trim() === "") {
            tutorCentroError.textContent = '';
            return false;
        } else if (!nombrePattern.test(tutorCentroInput.value)) {
            tutorCentroError.textContent = 'Formato incorrecto. Debe seguir el patrón Ej. John.';
            tutorCentroError.style.color ='red';
            tutorCentroError.style.fontSize ='13px';
            return false;
        } else {
            tutorCentroError.textContent = '';
            return true;
        }
    }

    function validarTutorEmpresa() {
        const nombrePattern = /(^[A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+)(\s[A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+)?$/;
        if (tutorEmpresaInput.value.trim() === "") {
            tutorEmpresaError.textContent = '';
            return false;
        } else if (!nombrePattern.test(tutorEmpresaInput.value)) {
            tutorEmpresaError.textContent = 'Formato incorrecto. Debe seguir el patrón Ej. John.';
            tutorEmpresaError.style.color ='red';
            tutorEmpresaError.style.fontSize ='13px';
            return false;
        } else {
            tutorEmpresaError.textContent = '';
            return true;
        }
    }


    function validarAnexo() {
        const anexoPattern = /^[A-HJNPQRSUVW]{1}[0-9]{7}[0-9A-J]{1}$/;
        if (cifInput.value.trim() === "") {
            cifError.textContent = '';
            return false;
        } else if (!anexoPattern.test(cifInput.value)) {
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

