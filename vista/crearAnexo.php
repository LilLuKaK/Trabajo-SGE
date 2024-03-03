<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/login-register/loginStyle.css">
    <link rel="stylesheet" href="assets/css/common/commonStyle.css" />
    <link rel="stylesheet" href="./assets/css/login-register/extendedLogin.css" />
</head>
<body>
    <div class="container">
        
        <?php
        $activeLink = 'consultarPracticas';
        include 'aside.php';
        ?>

        <div class="contenedorRegistro">
            <section class="sign-in">
                <article class="sign-in__details">
                    <div id="label">
                        <h1>Crear anexo</h1>
                        <p>Complete el siguiente formulario para crear un centro educativo</p>
                    </div>
                    <form class="sign-in__form" id="registroForm">
                        <div class="form__control" id="contenedorNombre">
                            <label for="version">Versión</label>
                            <input type="text" id="version" name="version" placeholder="Introduce la versión del anexo">
                            <div id="version-error"></div>
                        </div>
                        <div class="form__control" id="contenedorNombre">
                            <label for="cuadrante">Cuadrante</label>
                            <input type="text" id="cuadrante" name="cuadrante" placeholder="Introduce el cuadrante del anexo">
                            <div id="cuadrante-error"></div>
                        </div>
                        <div class="form__control" id="contenedorNombre">
                            <label for="tutorEmpresa">Tutor de empresa</label>
                            <input type="text" id="tutorEmpresa" name="tutorEmpresa" placeholder="Introduce el tutor de empresa">
                            <div id="tutorEmpresa-error"></div>
                        </div>
                        <div class="form__control" id="contenedorNombre">
                            <label for="fechaInicio">Fecha de inicio</label>
                            <input type="text" id="fechaInicio" name="fechaInicio" placeholder="Introduce la fecha de inicio del anexo">
                            <div id="fechaInicio-error"></div>
                        </div>
                        <div class="form__control" id="contenedorNombre">
                            <label for="fechaFin">Fecha de fin</label>
                            <input type="text" id="fechaFin" name="fechaFin" placeholder="Introduce la fecha de fin del anexo">
                            <div id="fechaFin-error"></div>
                        </div>
                        <input type="hidden" name="registrarPractica" value="registrarPractica">
                        <input type="submit" class="btn primary" value="Registrar" name="registrarPractica" id="buttonEnviar">
                        <a href="index.php?pages=consultarPracticas" class="btn primary">Cancelar</a>
                    </form>
                </article>
                <article class="sign-in__logo">
                    <div><img src="./assets/images/login-register/undraw_educator_re_ju47.svg" alt=""></div>
                </article>
            </section>
        </div>
    </div>
    <script src="./assets/js/common/commonScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>