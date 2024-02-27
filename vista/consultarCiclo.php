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

        <div class="right">
            <div class="top">
                <p>Consulta de Ciclos Formativos</p>
                <h2>Aquí puedes ver los cursos que oferta el Centro Formativo</h2>
            </div>
            <div class="forms">
                <div class="form__control">
                    <label for="ciclo">Ciclo</label>
                    <div class="input">
                    <input type="text" id="ciclo" name="ciclo" placeholder="Introduce el nombre del Ciclo"></input>
                    <button id="buscarCiclo" class="search" name="buscarCiclo"><span class="material-symbols-sharp">manage_search</span></button>
                    <input type="hidden" value="buscarCiclo">
                </div> 

<!-- 
La consulta SQL ha de ser: 
Consulta que se ha de repetir por cada uno de los Ciclos Formativos
SELECT COUNT(*)
FROM ciclo_alumno
WHERE ID_Ciclo_Formativo=(SELECT ID_Ciclo_Formativo 
                        FROM ciclos_formativos
                         WHERE Nombre_Ciclo='DAM');
                          SELECT COUNT(*)
FROM ciclo_alumno



WHERE ID_Ciclo_Formativo=(SELECT ID_Ciclo_Formativo 
                          FROM ciclos_formativos
                          WHERE Nombre_Ciclo='DAM')
AND ID_Alumno = (SELECT ID_Alumno
                FROM alumnos
                WHERE alumnos.Validez =1);
-->               
                <div class="middle">
                    <table class="data">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>DNI</th>
                                <th>Ciclo</th>
                                <th>SS</th>
                                <th>CV</th>
                                <th>Validez</th>
                                <th>Activo</th>
                                <th>Teléfono</th>
                                <th>Correo</th>
                                <th>Dirección</th>
                                <th>CP</th>
                            </tr>
                        </thead>
                        <tbody>
    <!-- añadir el <?php

    ?> -->
                        </tbody>
                    </table> 
                </div>         
            </div>
            <div id="new">
                <div class="top">
                <p>Insertar Ciclo formativo</p>
                <h2>Añadir un nuevo Ciclo Formativo a la base de datos.</h2>
                </div>
                <div class="forms">
                    <h2>Para insertar un nuevo Ciclo Formativo, haga click en el siguiente botón. Este abrirá una nueva ventana:</h2>
                    <a href="index.php?pages=crearCiclo"><button class="new"><label>Insertar Nuevo Ciclo</label><span class="material-symbols-sharp">school_add</span></button></a>
                </div>
            </div>
        </div>
    </div>
<script src="./assets/js/common/commonScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>