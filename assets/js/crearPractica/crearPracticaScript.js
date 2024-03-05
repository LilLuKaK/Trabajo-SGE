document.addEventListener('DOMContentLoaded', function () {

    const enviarButton = document.getElementById('buttonEnviar');

    enviarButton.addEventListener('click', function (event) {
        event.preventDefault();
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
                        window.location.href = 'index.php?pages=consultarPractica';
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
});

//------------------------------------------------------------------------------------------------------------------------------------

