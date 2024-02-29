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
        $activeLink = 'consultarCiclo';
        include 'aside.php';
        ?>

        <div class="contenedorRegistro">
            <section class="sign-in">
                <article class="sign-in__details">
                    <div id="label">
                        <h1>Crear Ciclo</h1>
                        <p>Complete el siguiente formulario para crear un Ciclo</p>
                    </div>
                    <form class="sign-in__form" id="registroForm">
                        <div class="form__control">
                            <label for="nombreCiclo">Nombre del Ciclo</label>
                            <input type="text" id="nombreCiclo" name="nombreCiclo" placeholder="Introduce el nombre completo">
                            <div id="nombreCiclo-error"></div>
                        </div>
                        
                        <input type="hidden" name="registrarCiclo" value="registrarCiclo">
                        <input type="submit" class="btn primary" value="Registrar" name="registrarCiclo" id="buttonEnviar">
                        <a href="index.php?pages=consultarCiclo" class="btn primary">Cancelar</a>
                    </form>
                </article>
                <article class="sign-in__logo">
                    <div><img src="./assets/images/login-register/undraw_exams_re_4ios.svg" alt=""></div>
                </article>
            </section>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./assets/js/crearCiclo/crearCicloScript.js"></script>
    <script src="./assets/js/common/commonScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>