document.addEventListener('DOMContentLoaded', function () {

    const emailInput = document.getElementById('email');
    const claveInput = document.getElementById('clave');

    const emailError = document.getElementById('email-error');
    const claveError = document.getElementById('clave-error');

    const enviarButton = document.getElementById('buttonEnviar');

    function validarEmail() {
        const contenedorEmail = document.getElementById('contenedorEmail');
        const emailPattern = /(^\w+.?\w*)\@([a-z]+.?[a-z]*)\.([a-z]+)?$/;
        if (emailInput.value.trim() === "") {
            emailError.textContent = '';
            contenedorEmail.style.borderBottom = '';
            return false;
        } else if (!emailPattern.test(emailInput.value)) {
            emailError.textContent = 'Formato incorrecto. Debe seguir el patrón especificado: ejemplo@ejemplo.com';
            emailError.style.color ='red';
            emailError.style.fontSize ='13px';
            return false;
        } else {
            emailError.textContent = '';
            contenedorEmail.style.borderBottom = '2px solid white';
            return true;
        }
    }

    function validarClave() {
        const contenedorClave = document.getElementById('contenedorClave');
        if (claveInput.value.trim() === "") {
            return false;
        } else {
            return true;
        }
    }

    function validarInput(inputFunc, errorDiv) {
        inputFunc();
        habilitarBoton();
    }

    function habilitarBoton() {
        enviarButton.disabled = !(validarEmail() && validarClave());
    }

    emailInput.addEventListener('input', function () {
        validarInput(validarEmail, emailError);
    });

    claveInput.addEventListener('input', function () {
        validarInput(validarClave, claveError);
    });

    enviarButton.addEventListener('click', function () {
        event.preventDefault();
        
        if (validarEmail() && validarClave()) {

            const formData = new FormData();
            formData.append('login', '1');
            formData.append('email', emailInput.value);
            formData.append('clave', claveInput.value);

            fetch('./controlador/userController.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Inicio de sesión exitoso",
                        text: `¡Bienvenido, ${data.nombre}!`
                    }).then(() => {
                        window.location.href = 'index.php?pages=landing';
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error de inicio de sesión",
                        text: data.error
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
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
