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
        $activeLink = 'consultarNecesidadBolsa';
        include 'aside.php';
        ?>

        <div class="contenedorRegistro">
            <section class="sign-in">
                <article class="sign-in__details">
                    <div id="label">
                        <h1>Crear Necesidad Nueva en labolsa de trabajo</h1>
                        <p>Complete el siguiente formulario para crear una Nueva Necesidad</p>
                    </div>
                    <form class="sign-in__form" id="registroForm">
                        <!-- Aquí iría un combobox con las diferentes empresas-->
                        <div class="form__control">
                            <label for="Nombre_Empresa">Nombre de la Empresa</label>
                            <select name="Nombre_Empresa" id="Nombre_Empresa" class="Nombre_Empresa" sizeof="3">
                            <option value='' selected disabled>-- Selecciona la Empresa --</option>
                                    <?php
                                    require_once'modelo\contoles_PHP\control_empresas_Bolsa.php';
                                    ?>
                            </select>
                            <input type="hidden" value="buscarEmpresa">
                            <div id="empresa-error"></div>
                        </div>
                        
                        <div class="form__control">
                            <label for="cuadrante">Cuadrante</label>
                            <select id="cuadrante" name="cuadrante">
                                <option value="Abril">Abril</option>
                                <option value="Septiembre">Septiembre</option>
                            </select>
                            <div id="cuadrante-error"></div>
                        </div>
                          
                           <!--
                            Si alguno consigue que funcione, le como los morros
                             <div class="form__control">  
                            <container id="Contenedor_Botones">
                            <button type="button" class="btn primary" id="agregarCursoBtn">Agregar Curso</button>
                            <br/>
                            </container>
                            </div>
                        --> 
                        <!--En caso de conseguir lo de los arrays: Comentar desde aquí-->

                        <div class="form__control">
                            <label for="ID_Ciclo_Formativo">Nombre de la Empresa</label>
                            <select name="ID_Ciclo_Formativo" id="ID_Ciclo_Formativo" class="ID_Ciclo_Formativo" sizeof="3">
                            <option value='' selected disabled>-- Selecciona la Empresa --</option>
                                    <?php
                                    require_once'modelo\ciclo_formativo.php';
                                    ?>
                            </select>
                            <input type="hidden" value="buscarEmpresa">
                            <div id="ciclo-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="cantidad1">Cantidad de alumnos del ciclo</label>
                            <input type="text" id="cantidad1" name="cantidad1" placeholder="Introduce el Año">
                            <div id="cantidad1-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="Comentarios">Comentarios</label>
                            <input type="text" id="Comentarios" name="Comentarios" placeholder="Introduzca Comentarios">
                            <div id="Comentarios-error"></div>
                        </div>
                       <!-- HAsta aquí-->
                        <input type="hidden" name="contador" id="contador" value="">
                        <input type="hidden" name="registrarNecesidadBolsa" value="registrarNecesidadBolsa">
                        <input type="submit" class="btn primary" value="Registrar" name="registrarNecesidadBolsa" id="buttonEnviar">
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