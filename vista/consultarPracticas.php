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
                        <label for="nombre">Nombre</label>
                        <div class="input">
                            <input type="text" id="nombre" name="nombre" placeholder="Introduce el nombre del alumno"></input>
                            <button id="buscarEmpresa" class="search" name="buscarEmpresa"><span class="material-symbols-sharp">manage_search</span></button>
                            <input type="hidden" value="buscarEmpresa">
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
                    <a href="index.php?pages=consultarEmpresas"><button class="new" id="all"><label>Mostrar todos</label><span class="material-symbols-sharp">list</span></button></a>
                    <h2>Debes de rellenar un campo y darle al botón de buscar, para hacer una consulta con un filtro.</h2>
                </div>
                <!-- TABLA DE CONNSULTAS -->
                <div class="middle">
                    <table class="data" id="tablaEmpresas">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Anexo</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Tutor del centro</th>
                                <th>Tutor de prácticas</th>
                                <th>Fecha de inicio</th>
                                <th>Fecha de fin</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div id="new">
                    <div class="top">
                        <h1>Insertar Práctica</h1>
                        <h2>Añadir una práctica a la base de datos.</h2>
                </div>
                <div class="forms">
                    <h2>Para insertar una nueva práctica, haga click en el siguiente botón. Este abrirá una nueva ventana:</h2>
                    <a href="index.php?pages=crearPractica">
                        <button class="new">
                            <label>Insertar práctica</label>
                            <span class="material-symbols-sharp">domain_add</span>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="./assets/js/busquedas/validez.js"></script>
    <script src="./assets/js/busquedas/cicloFP.js"></script>
    <script src="./assets/js/busquedas/dni.js"></script>
    <script src="./assets/js/busquedas/nombre.js"></script>
    <script src="./assets/js/common/commonScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>