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
        $activeLink = 'consultarPracticas';
        include 'aside.php';
        ?>

        <div class="right">
            <div class="scroll">
                <div class="top">
                    <h1>Consulta de prácticas</h1>
                    <h2>Aquí podrás consultar, modificar y eliminar prácticas.</h2>
                </div>
                <div class="forms">
                    <div class="form__control">
                        <label for="nombre">Nombre del alumno</label>
                        <div class="input">
                            <input type="text" id="nombre" name="nombre" placeholder="Introduce el Nombre del Alumno"></input>
                            <button id="buscarAlumnoPracticas" class="search" name="buscarAlumnoPracticas"><span class="material-symbols-sharp">manage_search</span></button>
                            <input type="hidden" value="buscarAlumnoPracticas">
                        </div>
                    </div>
                    <div class="form__control">
                        <label for="tutor_centro">Tutor del centro</label>
                        <div class="input">
                            <input type="text" id="tutor_centro" name="tutor_centro" placeholder="Introduce el tutor del centro"></input>
                            <button id="buscarTutorCentro" class="search" name="buscarTutorCentro"><span class="material-symbols-sharp">manage_search</span></button>
                            <input type="hidden" value="buscarTutorCentro">
                        </div>
                    </div>
                    <div class="form__control">
                        <label for="tutor_empresa">Tutor de empresa</label>
                        <div class="input">
                            <input type="text" id="tutor_empresa" name="tutor_empresa" placeholder="Introduce el tutor de la empresa"></input>
                            <button id="buscarTutorEmpresa" class="search" name="buscarTutorEmpresa"><span class="material-symbols-sharp">manage_search</span></button>
                            <input type="hidden" value="buscarTutorEmpresa">
                        </div>
                    </div>
                    <div class="form__control">
                        <label for="anexo">Anexo</label>
                        <div class="input">
                            <input type="text" id="anexo" name="anexo" placeholder="Introduce el anexo"></input>
                            <button id="buscarAnexo" class="search" name="buscarAnexo"><span class="material-symbols-sharp">manage_search</span></button>
                            <input type="hidden" value="buscarAnexo">
                        </div>
                    </div>
                    <a href="index.php?pages=consultarPracticas"><button class="new" id="all"><label>Mostrar todos</label><span class="material-symbols-sharp">list</span></button></a>
                    <h2>Debes de rellenar un campo y darle al botón de buscar, para hacer una consulta con un filtro.</h2>
                </div>
                <!-- TABLA DE CONNSULTAS -->
                <div class="middle">
                    <table class="data" id="tablaEmpresas">
                        <thead>
                            <tr>
                                <th>Nombre del alumno</th>
                                <th>Apellidos del alumno</th>
                                <th>CV</th>
                                <th>Tutor del centro</th>
                                <th>Empresa</th>
                                <th>Tutor de prácticas</th>
                                <th>Fecha de inicio</th>
                                <th>Fecha de fin</th>
                                <th>Cuadrante</th>
                                <th>Anexo</th>
                                <th>Versionado</th>
                                <th>Horario</th>
                                <th>Horas Totales</th> <!--Recoge la hora de entrada y la de salida, y las resta, 
                                                            y luego multiplica por la diferencia de días de fecha
                                                            de inicio con fecha final o, si no hay, por la Fecha Actual
                                                            *OJO* son Varchar-->
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            include_once './modelo/tablaPracticas.php';
                        ?>
                        </tbody>
                    </table>
                </div>
                <div id="new">
                    <div class="top">
                        <h1>Insertar práctica / anexo</h1>
                        <h2>Añadir una práctica o anexo a la base de datos.</h2>
                </div>
                <div class="forms">
                    <h2>Para insertar una nueva práctica, haga click en el siguiente botón. Este abrirá una nueva ventana:</h2>
                    <a href="index.php?pages=crearPractica">
                        <button class="new">
                            <label>Insertar práctica</label>
                            <span class="material-symbols-sharp">new_window</span>
                        </button>
                    </a>
                    <h2>Si quieres insertar un anexo, haga click en el siguiente botón. Este abrirá una nueva ventana:</h2>
                    <a href="index.php?pages=crearAnexo">
                        <button class="new">
                            <label>Insertar anexo</label>
                            <span class="material-symbols-sharp">text_increase</span>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="./assets/js/busquedas/tablaPracticas.js"></script>
    <script src="./assets/js/common/commonScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>