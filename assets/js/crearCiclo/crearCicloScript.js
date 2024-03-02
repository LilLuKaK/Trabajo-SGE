document.addEventListener('DOMContentLoaded', function () {

    const nombreCicloInput = document.getElementById('nombreCiclo');

    const nombreCicloError = document.getElementById('nombreCiclo-error');

    const enviarButton = document.getElementById('buttonEnviar');
    


    function validarnombreCiclo() {
        if (nombreCicloInput.value.trim() === "") {
            nombreCicloError.textContent = '';
            return false;
        } else {
            nombreCicloError.textContent = '';
            return true;
        }
    }

    function validarInput(inputFunc, errorDiv) {
        inputFunc();
        habilitarBoton();
    }

    function habilitarBoton() {
        enviarButton.disabled = !(validarnombreCiclo());
    }

    nombreCicloInput.addEventListener('input', function () {
        validarInput(validarnombreCiclo, nombreCicloError);
    });

    enviarButton.addEventListener('click', function (event) {
        event.preventDefault();

        if (validarnombreCiclo()) {
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
                        window.location.href = 'index.php?pages=consultarCiclo';
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