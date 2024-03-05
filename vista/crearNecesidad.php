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
        $activeLink = 'consultarNecesidad';
        include 'aside.php';
        ?>

        <div class="contenedorRegistro">
            <section class="sign-in">
                <article class="sign-in__details">
                    <div id="label">
                        <h1>Crear Necesidad Nueva</h1>
                        <p>Complete el siguiente formulario para crear una Nueva Necesidad</p>
                    </div>
                    <form class="sign-in__form" id="registroForm">
                        <!-- Aquí iría un combobox con las diferentes empresas-->
                        <div class="form__control">
                            <label for="Nombre_Empresa">Nombre de la Empresa</label>
                            <select name="Nombre_Empresa" id="Nombre_Empresa" class="Nombre_Empresa" sizeof="3">
                            <option value='' selected disabled>-- Selecciona la Empresa --</option>
                                    <?php
                                    require_once'modelo\contoles_PHP\control_empresas.php';
                                    ?>
                            </select>
                            <input type="hidden" value="buscarEmpresa">
                            <div id="empresa-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="anyo">Año de la Necesidad</label>
                            <input type="text" id="anyo" name="anyo" placeholder="Introduce el Año">
                            <div id="anyo-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="cuadrante">Cuadrante</label>
                            <select id="cuadrante" name="cuadrante">
                                <option value="Abril">Abril</option>
                                <option value="Septiembre">Septiembre</option>
                            </select>
                            <div id="cuadrante-error"></div>
                        </div>
                        <div class="form__control">     
                            <container id="Contenedor_Botones">
                            <button type="button" class="btn primary" id="agregarCursoBtn">Agregar Curso</button>
                            <br/>
                            </container>
                        </div>
                        <input type="hidden" name="contador" id="contador" value="">
                        <input type="hidden" name="registrarNecesidad" value="registrarNecesidad">
                        <input type="submit" class="btn primary" value="Registrar" name="registrarNecesidad" id="buttonEnviar">
                    </form>
                </article>
                <article class="sign-in__logo">
                    <div><img src="./assets/images/login-register/undraw_exams_re_4ios.svg" alt=""></div>
                </article>
            </section>
        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src ="./assets/js/crearNecesidad/crearNecesidadScript.js"></script>
    <script src="./assets/js/common/commonScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>