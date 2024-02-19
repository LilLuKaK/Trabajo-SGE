<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="./assets/css/login-register/loginStyle.css">
</head>
<body>
    <section class="sign-in">
        <article class="sign-in__details">
            <h1>Iniciar Sesión</h1>
            <p>Inicie sesión en su cuenta utilizando sus credenciales</p>
            <form class="sign-in__form">
                <div class="form__control" id="contenedorEmail">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Introduce tu correo electrónico">
                    <div id="email-error"></div>
                </div>
                <div class="form__control" id="contenedorClave">
                    <label for="password">Contraseña</label>
                    <input type="password" id="clave" name="clave" placeholder="Introduce tu contraseña">
                    <div id="clave-error"></div>
                </div>
                <input type="hidden" name="login" value="login">
                <input type="submit" class="btn primary" value="Acceder" name="login" id="buttonEnviar">
            </form>
        </article>
        <article class="sign-in__logo">
        </article>
    </section>
    <script src="./assets/js/login/loginScript.js"></script>
    <script src="./assets/js/common/commonScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>