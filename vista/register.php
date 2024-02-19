<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/login-register/loginStyle.css">
    <link rel="stylesheet" href="assets/css/common/commonStyle.css" />
</head>
<body>
    <div class="container">
        
        <?php include 'aside.php'; ?>

        <div class="contenedorRegistro">
            <section class="sign-in">
                <article class="sign-in__details">
                    <h1>Crear Cuenta</h1>
                    <p>Complete el siguiente formulario para crear una cuenta</p>
                    <form class="sign-in__form">
                        <div class="form__control">
                            <label for="fullname">Nombre</label>
                            <input type="text" id="fullname" placeholder="Introduce el nombre completo">
                        </div>
                        <div class="form__control">
                            <label for="fullname">Apellido/s</label>
                            <input type="text" id="apellidos" placeholder="Introduce el apellido o apellidos">
                        </div>
                        <div class="form__control">
                            <label for="fullname">Centro</label>
                            <select name="centro" id="centro">
                                <option value='' selected disabled>-- Selecciona el centro --</option>
                                <?php
                                // Incluir la consulta de los centros
                                include './../modelo/centro_formativo.phps';
                                ?>
                            </select>
                        </div>
                        <div class="form__control">
                            <label for="email">Email</label>
                            <input type="email" id="email" placeholder="Introduce el correo">
                        </div>
                        <div class="form__control">
                            <label for="password">Contraseña</label>
                            <input type="password" id="clave" placeholder="Introduce la contraseña">
                        </div>
                        <div class="form__control">
                            <label for="cpassword">Confirmar Contraseña</label>
                            <input type="password" id="claveRepetida" placeholder="Introduce la contraseña otra vez">
                        </div>
                        <button class="btn primary" type="submit">Registrar</button>
                    </form>
                </article>
                <article class="sign-in__logo">
                </article>
            </section>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./assets/js/register/registerScript.js"></script>
</body>
</html>