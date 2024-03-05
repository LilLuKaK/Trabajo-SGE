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
        $activeLink = 'consultarPracticas';
        include 'aside.php';
        ?>

        <div class="contenedorRegistro">
            <section class="sign-in">
                <article class="sign-in__details">
                    <div id="label">
                        <h1>Crear práctica</h1>
                        <p>Complete el siguiente formulario para crear un centro educativo</p>
                    </div>
                    <form class="sign-in__form" id="registroForm">
                        <div class="form__control">
                            <label for="nombreAlumno">Alumno</label>
                            <input type="hidden" name="nombreAlumno" id="<?php echo ($_SESSION['id_centro']); ?>" value="<?php echo ($_SESSION['id_centro']); ?>">
                            <select name="alumnos" id="alumnos">
                                <option value='' selected disabled>-- Selecciona el alumno --</option>
                                <?php
                                require_once './modelo/alumnos.php';
                                ?>
                            </select>
                            <div id="nombreAlumno-error"></div>
                        </div>
                        <div class="form__control" id="contenedorNombre">
                            <label for="tutorCentro">Tutor del centro</label>
                            <select name="tutoresCentro" id="tutoresCentro">
                                <option value='' selected disabled>-- Selecciona el tutor de prácticas --</option>
                                <?php
                                require_once './modelo/tutoresCentro.php';
                                ?>
                            </select>
                            <div id="tutorCentro-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="empresao">Empresa</label>
                            <input type="hidden" name="empresa" id="<?php echo ($_SESSION['id_centro']); ?>" value="<?php echo ($_SESSION['id_centro']); ?>">
                            <select name="empresa" id="empresa">
                                <option value='' selected disabled>-- Selecciona la empresa --</option>
                                <?php
                                require_once './modelo/empresas.php';
                                ?>
                            </select>
                            <div id="empresa-error"></div>
                        </div>
                        <div class="form__control" >
                            <label for="fechaInicio">Fecha de inicio</label>
                            <input type="date" id="fechaInicio" name="fechaInicio" placeholder="Introduce la fecha de inicio de las prácticas" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="form__control">
                            <label for="direccion">Direccion</label>
                            <input type="text" id="direccion" name="direccion" placeholder="Introduce el Direccion">
                            <div id="direccion-error"></div>
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
    <script src="./assets/js/crearPractica/crearPracticaScript.js"></script>
    <script src="./assets/js/common/commonScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>