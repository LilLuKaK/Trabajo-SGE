<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <link rel="stylesheet" href="assets/css/common/commonStyle.css" />
    <link rel="stylesheet" href="./assets/css/consult/consultStyle.css">
</head>
<body>
    <div class="container">
        
        <?php
        $activeLink = 'consultarAlumnos';
        include 'aside.php';
        ?>

        <div class="right">
            <div class="scroll">
                <div class="top">
                    <h1>Consulta de alumnos</h1>
                    <h2>Aquí podrás consultar, modificar y eliminar alumnos.</h2>
                </div>
                <div class="forms">
                    <div class="form__control">
                        <label for="nombre">Nombre</label>
                        <div class="input">
                            <input type="text" id="nombre" name="nombre" placeholder="Introduce el Nombre del Alumno"></input>
                            <button id="buscarAlumno" class="search" name="buscarAlumno"><span class="material-symbols-sharp">manage_search</span></button>
                            <input type="hidden" value="buscarAlumno">
                        </div>
                    </div>
                    <div class="form__control">
                        <label for="dni">DNI</label>
                        <div class="input">
                            <input type="text" id="dni" name="dni" placeholder="Introduce el DNI del Alumno"></input>
                            <button id="buscarDni" class="search" name="buscarDni"><span class="material-symbols-sharp">manage_search</span></button>
                            <input type="hidden" value="buscarDni">
                        </div>
                    </div>
                    <div class="form__control">
                        <label for="validez">Validez (<span class="si">verde</span> para "si" y <span class="no">rojo</span> para "no") </label>
                        <div class="input">
                            <label class="switch">
                                <input type="checkbox" id="slider">
                                <span class="slider round"></span>
                            </label>
                            <button class="search" id="searchBtn" name="searchBoton"><span class="material-symbols-sharp">manage_search</span></button>
                            <input type="hidden" value="searchBoton">
                        </div>
                    </div>
                    <div class="form__control">
                        <label for="dni">Ciclo Formativo</label>
                        <div class="input">
                            <select name="ciclos" id="ciclos" class="ciclos" sizeof="3">
                                <?php
                                   include_once './modelo/ciclo_formativo.php';
                                ?>
                            </select>
                            <span class="material-symbols-sharp expand">expand_more</span>
                            <button id="last" class="search" name="buscarFP"><span class="material-symbols-sharp">manage_search</span></button>
                            <input type="hidden" value="buscarFP">
                        </div>
                    </div>
                    <a href="index.php?pages=consultarAlumnos"><button class="new" id="all"><label>Mostrar todos</label><span class="material-symbols-sharp">list</span></button></a>
                    <h2>Debes de rellenar un campo y darle al botón de buscar, para hacer una consulta con un filtro.</h2>
                </div>
                <!-- TABLA DE CONNSULTAS -->
                <div class="middle">
                    <table class="data" id="tablaALumnos">
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
                        <?php
                            // Incluir el archivo de conexión a la base de datos
                                include_once './modelo/tablaAlumnos.php';
                        ?>
                        </tbody>
                    </table>
                </div>
                <div id="new">
                    <div class="top">
                        <h1>Insertar alumno</h1>
                        <h2>Añadir un alumno a la base de datos.</h2>
                </div>
                <div class="forms">
                    <h2>Para insertar un nuevo alumno, haga click en el siguiente botón. Este abrirá una nueva ventana:</h2>
                    <a href="index.php?pages=crearAlumno"><button class="new"><label>Insertar alumno</label><span class="material-symbols-sharp">person_add</span></button></a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- <script src="./assets/js/busquedas/tablaAlumnos.js"></script> -->
    <script src="./assets/js/busquedas/dni.js"></script>
    <script src="./assets/js/busquedas/nombre.js"></script>
    <script src="./assets/js/common/commonScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./assets/js/Editar_Borrar/editar.js"></script>
</body>
</html>