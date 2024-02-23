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
        
        <?php
        $activeLink = 'register';
        include 'aside.php';
        ?>

        <div class="contenedorRegistro">
            <section class="sign-in">
                <article class="sign-in__details">
                    <h1>Crear Cuenta</h1>
                    <p>Complete el siguiente formulario para crear una cuenta</p>
                    <form class="sign-in__form" id="registroForm">
                        <div class="form__control">
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre" name="nombre" placeholder="Introduce el nombre completo">
                            <div id="nombre-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="apellidos">Apellido/s</label>
                            <input type="text" id="apellidos" name="apellidos" placeholder="Introduce el apellido o apellidos">
                            <div id="apellidos-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="fullname">Centro</label>
                            <select name="centro" id="centro">
                                <option value='' selected disabled>-- Selecciona el centro --</option>
                                <?php
                                // Incluir la consulta de los centros
                                include './../modelo/centro_formativo.php';
                                ?>
                            </select>
                            <div id="centro-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Introduce el correo">
                            <div id="email-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="password">Contraseña</label>
                            <input type="password" id="clave" name="clave" placeholder="Introduce la contraseña">
                            <div id="clave-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="cpassword">Confirmar Contraseña</label>
                            <input type="password" id="claveRepetida" name="claveRepetida" placeholder="Introduce la contraseña otra vez">
                            <div id="claveRepetida-error"></div>
                        </div>
                        <input type="hidden" name="registrarTutor" value="registrarTutor">
                        <input type="submit" class="btn primary" value="Registrar" name="registrarTutor" id="buttonEnviar">
                    </form>
                </article>
                <article class="sign-in__logo">
                    <div><img src="./assets/images/login-register/undraw_teacher_re_sico.svg" alt=""></div>
                </article>
            </section>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./assets/js/register/registerScript.js"></script>
    <script src="./assets/js/common/commonScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>