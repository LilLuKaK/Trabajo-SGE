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
        $activeLink = 'consultarEmpresas';
        include 'aside.php';
        ?>

        <div class="right">
            <div class="scroll">
                <div class="top">
                    <h1>Consulta de empresas</h1>
                    <h2>Aquí podrás consultar, modificar y eliminar empresas.</h2>
                </div>
                <div class="forms">
                    <div class="form__control">
                        <label for="nombre">Nombre</label>
                        <div class="input">
                            <input type="text" id="nombre" name="nombre" placeholder="Introduce el nombre de la empresa"></input>
                            <button id="buscarEmpresa" class="search" name="buscarEmpresa"><span class="material-symbols-sharp">manage_search</span></button>
                            <input type="hidden" value="buscarEmpresa">
                        </div>
                    </div>
                    <div class="form__control">
                        <label for="CIF">CIF</label>
                        <div class="input">
                            <input type="text" id="CIF" name="CIF" placeholder="Introduce el CIF de la empresa"></input>
                            <button id="buscarCIF" class="search" name="buscarCIF"><span class="material-symbols-sharp">manage_search</span></button>
                            <input type="hidden" value="buscarCIF">
                        </div>
                    </div>
                    <div class="form__control">
                        <label for="duenyo">Dueño</label>
                        <div class="input">
                            <input type="text" id="duenyo" name="duenyo" placeholder="Introduce el dueño de la empresa"></input>
                            <button id="buscarDuenyo" class="search" name="buscarDuenyo"><span class="material-symbols-sharp">manage_search</span></button>
                            <input type="hidden" value="buscarDuenyo">
                        </div>
                    </div>
                    <div class="form__control">
                        <label for="firmante">Firmante del convenio</label>
                        <div class="input">
                            <input type="text" id="firmante" name="firmante" placeholder="Introduce el firmante del convenio de la empresa"></input>
                            <button id="buscarFirmante" class="search" name="buscarFirmante"><span class="material-symbols-sharp">manage_search</span></button>
                            <input type="hidden" value="buscarFirmante">
                        </div>
                    </div>
                    <input type="hidden" name="buscaEmpresa" id="BuscaEmpresa">
                    <button class="search new" id="all" name="buscarEmpresa"><label>Mostrar todos</label><span class="material-symbols-sharp">list</span></button>
                    <input type="hidden" value="buscarEmpresa">
                    <h2>Debes de rellenar un campo y darle al botón de buscar, para hacer una consulta con un filtro.</h2>
                </div>
                <!-- TABLA DE CONNSULTAS -->
                <div class="middle">
                    <table class="data" id="tablaEmpresas">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>CIF</th>
                                <th>Dueño</th>
                                <th>Firmante del convenio</th>
                                <th>Dirección</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Nombre de contacto</th>
                                <th>Email de contacto</th>
                                <th>Teléfono de contacto</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        include_once './modelo/tablaEmpresas.php';
                        ?>
                        </tbody>
                    </table>
                </div>
                <div id="new">
                    <div class="top">
                        <h1>Insertar empresa</h1>
                        <h2>Añadir una empresa a la base de datos.</h2>
                </div>
                <div class="forms">
                    <h2>Para insertar una nueva empresa, haga click en el siguiente botón. Este abrirá una nueva ventana:</h2>
                    <a href="index.php?pages=crearEmpresa">
                        <button class="new">
                            <label>Insertar empresa</label>
                            <span class="material-symbols-sharp">domain_add</span>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="./assets/js/busquedasEmpresa/buscarTotal.js"></script>
    <script src="./assets/js/common/commonScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>