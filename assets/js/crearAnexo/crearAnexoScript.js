

document.addEventListener('DOMContentLoaded', function () {

    const versionInput = document.getElementById('version');
    const cuadranteSelect = document.getElementById('cuadrante');
    const fechaInicioInput = document.getElementById('fechaInicio');
    const fechaFinInput = document.getElementById('fechaFin');
    const tutorEmpresaInput = document.getElementById('tutorEmpresa');
    const correoEmpresaInput = document.getElementById('correoEmpresa');
    const telefonoEmpresaInput = document.getElementById('telefonoEmpresa');
    const activoRadio = document.getElementById('activo');
    const empresaInput = document.getElementById('empresa');

    const enviarButton = document.getElementById('buttonEnviar');
    


    function validarVersion() {
        if (versionInput.value.trim() === "") {
            return false;
        } else {
            return true;
        }
    }

    function validarCuadrante() {
        if (cuadranteSelect.value.trim() === "") {
            return false;
        } else {
            return true;
        }
    }

    function validarfechaInicio() {
        if (fechaInicioInput.value.trim() === "") {
            return false;
        } else {
            return true;
        }
    }

    function validarfechaFin() {
        if (fechaFinInput.value.trim() === "") {
            return false;
        } else {
            return true;
        }
    }

    function validartutorEmpresa() {
        if (tutorEmpresaInput.value.trim() === "") {
            return false;
        } else {
            return true;
        }
    }

    function validarcorreoEmpresa() {
        if (correoEmpresaInput.value.trim() === "") {
            return false;
        } else {
            return true;
        }
    }

    function validartelefonoEmpresa() {
        if (telefonoEmpresaInput.value.trim() === "") {
            return false;
        } else {
            return true;
        }
    }

    function validarEmpresa() {
        if (empresaInput.value.trim() === "") {
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
        enviarButton.disabled = !(validarVersion() && validarCuadrante() && validarfechaInicio() && validarfechaFin() 
        && validartutorEmpresa() && validarcorreoEmpresa() && validartelefonoEmpresa() && validarEmpresa());
    }

    versionInput.addEventListener('input', function () {
        validarInput(validarVersion);
    });

    cuadranteSelect.addEventListener('input', function () {
        validarInput(validarCuadrante);
    });

    fechaInicioInput.addEventListener('input', function () {
        validarInput(validarfechaInicio);
    });

    fechaFinInput.addEventListener('input', function () {
        validarInput(validarfechaFin);
    });

    tutorEmpresaInput.addEventListener('input', function () {
        validarInput(validartutorEmpresa);
    });

    correoEmpresaInput.addEventListener('input', function () {
        validarInput(validarcorreoEmpresa);
    });

    telefonoEmpresaInput.addEventListener('input', function () {
        validarInput(validartelefonoEmpresa);
    });

    empresaInput.addEventListener('input', function () {
        validarInput(validarEmpresa);
    });

    enviarButton.addEventListener('click', function (event) {
        event.preventDefault();
        if (validarVersion() && validarCuadrante() && validarfechaInicio() && validarfechaFin() 
        && validartutorEmpresa() && validarcorreoEmpresa() && validartelefonoEmpresa() && validarEmpresa()) {
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
                        window.location.href = 'index.php?pages=consultarPracticas';
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

document.addEventListener("DOMContentLoaded", function() {
    var fechaInicioInput = document.getElementById('fechaInicio');
    var fechaFinInput = document.getElementById('fechaFin');
    
    fechaInicioInput.addEventListener('change', function() {
        fechaFinInput.removeAttribute('disabled');
        var fechaInicio = new Date(fechaInicioInput.value);
        fechaInicio.setMonth(fechaInicio.getMonth() + 3); // Suma 3 meses a la fecha de inicio
        fechaFinInput.value = fechaInicio.toISOString().split('T')[0]; // Establece la fecha de fin
    });
});