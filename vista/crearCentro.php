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
        $activeLink = 'crearCentro';
        include 'aside.php';
        ?>

        <div class="contenedorRegistro">
            <section class="sign-in">
                <article class="sign-in__details">
                    <h1>Crear Centro</h1>
                    <p>Complete el siguiente formulario para crear un centro educativo</p>
                    <form class="sign-in__form" id="registroForm">
                        <div class="form__control" id="contenedorNombre">
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre" name="nombre" placeholder="Introduce el nombre">
                            <div id="nombre-error"></div>
                        </div>
                        <div class="form__control" id="contenedorDif">
                            <label for="cif">CIF</label>
                            <input type="text" id="cif" name="cif" placeholder="Introduce el CIF del Centro Educativo">
                            <div id="cif-error"></div>
                        </div>
                        <div class="form__control" id="contenedorDuenyo">
                            <label for="duenyo">Dueño</label>
                            <input type="text" id="duenyo" name="duenyo" placeholder="Introduce el Dueño del Centro">
                            <div id="duenyo-error"></div>
                        </div>
                        <div class="form__control" id="contenedorDireccion">
                            <label for="direccion">Direccion</label>
                            <input type="text" id="direccion" name="direccion" placeholder="Introduce la Dirección del Centro">
                            <div id="direccion-error"></div>
                        </div>
                        <div class="form__control" id="contenedorTelefono">
                            <label for="telefono">Telefono</label>
                            <input type="text" id="telefono" name="telefono" placeholder="Introduce el Teléfono del Centro">
                            <div id="telefono-error"></div>
                        </div>
                        <div class="form__control" id="contenedorEmail">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Introduce el Correo Electrónico del Centro">
                            <div id="email-error"></div>
                        </div>
                        <input type="hidden" name="registrarCentro" value="registrarCentro">
                        <input type="submit" class="btn primary" value="Crear Centro" name="registrarCentro" id="buttonEnviar">
                    </form>
                </article>
                <article class="sign-in__logo">
                    <div><img src="./assets/images/login-register/undraw_educator_re_ju47.svg" alt=""></div>
                </article>
            </section>
        </div>
    </div>
    <script src="./assets/js/centroFormativo/centroFormativoScript.js"></script>
    <script src="./assets/js/common/commonScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>