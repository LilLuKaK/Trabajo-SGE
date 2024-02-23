<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <link rel="stylesheet" href="assets/css/common/commonStyle.css" />
    <link rel="stylesheet" href="./assets/css/consultarAlumnos/consultarAlumnosStyle.css">
</head>
<body>
    <div class="container">
        
        <?php
        $activeLink = 'consultarAlumnos';
        include 'aside.php';
        ?>

        <div class="right">
            <div class="top">
                <p>Consulta de alumnos</p>
                <h2>Aquí podrás consultar, modificar y eliminar alumnos.</h2>
            </div>
            <div class="forms">
                <div class="form__control">
                    <label for="nombre">Nombre</label>
                    <div class="input">
                        <input type="text" id="nombre" name="nombre" placeholder="Introduce el nombre del alumno"></input>
                        <button class="search"><span class="material-symbols-sharp">manage_search</span></button>
                    </div>
                </div>
                <div class="form__control">
                    <label for="dni">DNI</label>
                    <div class="input">
                        <input type="text" id="dni" name="dni" placeholder="Introduce el DNI del alumno"></input>
                        <button class="search"><span class="material-symbols-sharp">manage_search</span></button>
                    </div>
                </div>
                <div class="form__control">
                    <label for="validez">Validez (<span class="si">verde</span> para "si" y <span class="no">rojo</span> para "no") </label>
                    <div class="input">
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label>
                        <button class="search"><span class="material-symbols-sharp">manage_search</span></button>
                    </div>
                </div>
                <div class="form__control">
                    <label for="dni">Ciclo formativo</label>
                    <div class="input">
                        <select name="ciclos" id="ciclos" class="ciclos" sizeof="3">
                            <option value="DAM">DAM</option>
                            <option value="DAW">DAW</option>
                        </select>
                        <span class="material-symbols-sharp expand">expand_more</span>
                        <button id="last" class="search"><span class="material-symbols-sharp">manage_search</span></button>
                    </div>
                </div>
                <h2>Debes de rellenar un campo y darle al botón de buscar, para hacer una consulta con un filtro.</h2>
            </div>
            <!-- TABLA DE CONNSULTAS -->
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
                        <tr>
                            <td>
                                <button class="delete"><span class="material-symbols-sharp">delete</span></button>
                                <button class="edit"><span class="material-symbols-sharp">edit</span></button>
                            </td>
                            <td>1</td>
                            <td>Juan</td>
                            <td>Gómez</td>
                            <td>12345678A</td>
                            <td>DAM</td>
                            <td>123-45-6789</td>
                            <td><span class="material-symbols-sharp">download</span></td>
                            <td>No</td>
                            <td>Sí</td>
                            <td>123456789</td>
                            <td>juan@example.com</td>
                            <td>Calle Principal 123</td>
                            <td>28001</td>
                        </tr>
                        <tr>
                            <td>
                                <button class="delete"><span class="material-symbols-sharp">delete</span></button>
                                <button class="edit"><span class="material-symbols-sharp">edit</span></button>
                            </td>
                            <td>1</td>
                            <td>Juan</td>
                            <td>Gómez</td>
                            <td>12345678A</td>
                            <td>DAM</td>
                            <td>123-45-6789</td>
                            <td><span class="material-symbols-sharp">download</span></td>
                            <td>No</td>
                            <td>Sí</td>
                            <td>123456789</td>
                            <td>juan@example.com</td>
                            <td>Calle Principal 123</td>
                            <td>28001</td>
                        </tr>
                        <tr>
                            <td>
                                <button class="delete"><span class="material-symbols-sharp">delete</span></button>
                                <button class="edit"><span class="material-symbols-sharp">edit</span></button>
                            </td>
                            <td>1</td>
                            <td>Juan</td>
                            <td>Gómez</td>
                            <td>12345678A</td>
                            <td>DAM</td>
                            <td>123-45-6789</td>
                            <td><span class="material-symbols-sharp">download</span></td>
                            <td>No</td>
                            <td>Sí</td>
                            <td>123456789</td>
                            <td>juan@example.com</td>
                            <td>Calle Principal 123</td>
                            <td>28001</td>
                        </tr>
                        <tr>
                            <td>
                                <button class="delete"><span class="material-symbols-sharp">delete</span></button>
                                <button class="edit"><span class="material-symbols-sharp">edit</span></button>
                            </td>
                            <td>1</td>
                            <td>Juan</td>
                            <td>Gómez</td>
                            <td>12345678A</td>
                            <td>DAM</td>
                            <td>123-45-6789</td>
                            <td><span class="material-symbols-sharp">download</span></td>
                            <td>No</td>
                            <td>Sí</td>
                            <td>123456789</td>
                            <td>juan@example.com</td>
                            <td>Calle Principal 123</td>
                            <td>28001</td>
                        </tr>
                        <tr>
                            <td>
                                <button class="delete"><span class="material-symbols-sharp">delete</span></button>
                                <button class="edit"><span class="material-symbols-sharp">edit</span></button>
                            </td>
                            <td>1</td>
                            <td>Juan</td>
                            <td>Gómez</td>
                            <td>12345678A</td>
                            <td>DAM</td>
                            <td>123-45-6789</td>
                            <td><span class="material-symbols-sharp">download</span></td>
                            <td>No</td>
                            <td>Sí</td>
                            <td>123456789</td>
                            <td>juan@example.com</td>
                            <td>Calle Principal 123</td>
                            <td>28001</td>
                        </tr>
                        <tr>
                            <td>
                                <button class="delete"><span class="material-symbols-sharp">delete</span></button>
                                <button class="edit"><span class="material-symbols-sharp">edit</span></button>
                            </td>
                            <td>1</td>
                            <td>Juan</td>
                            <td>Gómez</td>
                            <td>12345678A</td>
                            <td>DAM</td>
                            <td>123-45-6789</td>
                            <td><span class="material-symbols-sharp">download</span></td>
                            <td>No</td>
                            <td>Sí</td>
                            <td>123456789</td>
                            <td>juan@example.com</td>
                            <td>Calle Principal 123</td>
                            <td>28001</td>
                        </tr>
                        <tr>
                            <td>
                                <button class="delete"><span class="material-symbols-sharp">delete</span></button>
                                <button class="edit"><span class="material-symbols-sharp">edit</span></button>
                            </td>
                            <td>1</td>
                            <td>Juan</td>
                            <td>Gómez</td>
                            <td>12345678A</td>
                            <td>DAM</td>
                            <td>123-45-6789</td>
                            <td><span class="material-symbols-sharp">download</span></td>
                            <td>No</td>
                            <td>Sí</td>
                            <td>123456789</td>
                            <td>juan@example.com</td>
                            <td>Calle Principal 123</td>
                            <td>28001</td>
                        </tr>
                        <tr>
                            <td>
                                <button class="delete"><span class="material-symbols-sharp">delete</span></button>
                                <button class="edit"><span class="material-symbols-sharp">edit</span></button>
                            </td>
                            <td>1</td>
                            <td>Juan</td>
                            <td>Gómez</td>
                            <td>12345678A</td>
                            <td>DAM</td>
                            <td>123-45-6789</td>
                            <td><span class="material-symbols-sharp">download</span></td>
                            <td>No</td>
                            <td>Sí</td>
                            <td>123456789</td>
                            <td>juan@example.com</td>
                            <td>Calle Principal 123</td>
                            <td>28001</td>
                        </tr>
                        <tr>
                            <td>
                                <button class="delete"><span class="material-symbols-sharp">delete</span></button>
                                <button class="edit"><span class="material-symbols-sharp">edit</span></button>
                            </td>
                            <td>1</td>
                            <td>Juan</td>
                            <td>Gómez</td>
                            <td>12345678A</td>
                            <td>DAM</td>
                            <td>123-45-6789</td>
                            <td><span class="material-symbols-sharp">download</span></td>
                            <td>No</td>
                            <td>Sí</td>
                            <td>123456789</td>
                            <td>juan@example.com</td>
                            <td>Calle Principal 123</td>
                            <td>28001</td>
                        </tr>
                     </tbody>
                </table>
            </div>
            <div id="new">
                <div class="top">
                    <p>Insertar alumno</p>
                    <h2>Añadir un alumno a la base de datos.</h2>
            </div>
            <div class="forms">
                <h2>Para insertar un nuevo alumno, haga click en el siguiente botón. Este abrirá una nueva ventana:</h2>
                <button class="new"><label>Insertar alumno</label><span class="material-symbols-sharp">person_add</span></button>
            </div>
        </div>
    </div>
    </div>
    <script src="./assets/js/common/commonScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>