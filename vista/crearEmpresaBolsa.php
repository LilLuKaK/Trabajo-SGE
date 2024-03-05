<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/login-register/loginStyle.css">
    <link rel="stylesheet" href="assets/css/common/commonStyle.css" />
    <link rel="stylesheet" href="assets/css/login-register/extendedLogin.css" />
</head>
<body>
    <div class="container">
        
        <?php
        $activeLink = 'consultarEmpresasBolsa';
        include 'aside.php';
        ?>

        <div class="contenedorRegistro">
            <section class="sign-in">
                <article class="sign-in__details">
                    <div id="label">
                        <h1>Crear Empresa Bolsa de Trabajo</h1>
                        <p>Complete el siguiente formulario para crear una empresa</p>
                    </div>
                    <form class="sign-in__form" id="registroForm">
                        <div class="form__control">
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre" name="nombre" placeholder="Introduce el Nombre de la Empresa">
                            <div id="nombre-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" placeholder="Introduce el Email de la Empresa">
                            <div id="email-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="telefono">Telefono</label>
                            <input type="text" id="telefono" name="telefono" placeholder="Introduce el Teléfono de la Empresa">
                            <div id="telefono-error"></div>
                        </div>
                        <input type="hidden" name="registrarEmpresa" value="registrarEmpresa">
                        <input type="submit" class="btn primary" value="Registrar" name="registrarEmpresa" id="buttonEnviar">
                        <a href="index.php?pages=consultarEmpresas" class="btn primary">Cancelar</a>
                    </form>
                </article>
                <article class="sign-in__logo">
                    <div><img src="./assets/images/login-register/undraw_businessman_e7v0.svg" alt=""></div>
                </article>
            </section>
        </div>
    </div>
    <script>
        /*document.getElementById('ciclo').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex].value;
            document.getElementById('cicloSeleccionado').value = selectedOption;
        });*/
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./assets/js/crearEmpresa/crearEmpresaScript.js"></script>
    <script src="./assets/js/common/commonScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</body>
</html>