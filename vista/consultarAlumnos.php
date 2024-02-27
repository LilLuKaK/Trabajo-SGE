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
                    <p>Consulta de alumnos</p>
                    <h2>Aquí podrás consultar, modificar y eliminar alumnos.</h2>
                </div>
                <div class="forms">
                    <div class="form__control">
                        <label for="nombre">Nombre</label>
                        <div class="input">
                            <input type="text" id="nombre" name="nombre" placeholder="Introduce el nombre del alumno"></input>
                            <button id="buscarAlumno" class="search" name="buscarAlumno"><span class="material-symbols-sharp">manage_search</span></button>
                            <input type="hidden" value="buscarAlumno">
                        </div>
                    </div>
                    <div class="form__control">
                        <label for="dni">DNI</label>
                        <div class="input">
                            <input type="text" id="dni" name="dni" placeholder="Introduce el DNI del alumno"></input>
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
                        <label for="dni">Ciclo formativo</label>
                        <div class="input">
                            <select name="ciclos" id="ciclos" class="ciclos" sizeof="3">
                                <?php
                                // Incluir la conexión y consulta a la base de datos
                                include './modelo/conexion.php';

                                // Realizar la consulta para obtener los nombres de los ciclos formativos
                                $conn = ConexionBD::conectar();

                                if ($conn) {
                                    $stmt = $conn->query("SELECT * FROM ciclos_formativos");

                                    // Verificar si se encontraron resultados
                                    if ($stmt->rowCount() > 0) {
                                        // Iterar sobre los resultados y mostrar las opciones del select
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<option value='" . $row['Nombre_Ciclo'] . "'>" . $row['Nombre_Ciclo'] . "</option>";
                                        }
                                    } else {
                                        echo "<option value='' disabled>No se encontraron ciclos formativos.</option>";
                                    }
                                }
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
                        include_once './modelo/conexion.php';

                        $id_centro_educativo = $_SESSION['id_centro'];
                        // Suponiendo que ya tienes el ID del centro educativo en una variable $id_centro_educativo
                        // Realiza la consulta para obtener los alumnos del centro educativo y el nombre del ciclo formativo de cada uno
                        $conn = ConexionBD::conectar();
                        $stmt = $conn->prepare("SELECT alumnos.*, ciclos_formativos.Nombre_Ciclo FROM alumnos 
                                            INNER JOIN ciclo_alumno ON alumnos.ID_Alumno = ciclo_alumno.ID_Alumno 
                                            INNER JOIN ciclos_formativos ON ciclo_alumno.ID_Ciclo_Formativo = ciclos_formativos.ID_Ciclo_Formativo 
                                            INNER JOIN centro_alumno ON alumnos.ID_Alumno = centro_alumno.ID_Alumno 
                                            WHERE centro_alumno.ID_Centro_Formativo = ?");
                        $stmt->execute([$id_centro_educativo]);

                        // Comprueba si se encontraron resultados
                        if ($stmt->rowCount() > 0) {
                            // Itera sobre los resultados y muestra los datos en la tabla
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td>";
                                echo "<button class='delete'><span class='material-symbols-sharp'>delete</span></button>";
                                echo "<button class='edit'><span class='material-symbols-sharp'>edit</span></button>";
                                echo "</td>";
                                echo "<td>" . $row['ID_Alumno'] . "</td>";
                                echo "<td>" . $row['Nombre'] . "</td>";
                                echo "<td>" . $row['Apellido1'] . "</td>";
                                echo "<td>" . $row['DNI'] . "</td>";
                                echo "<td>" . $row['Nombre_Ciclo'] . "</td>"; // Nombre del ciclo formativo
                                echo "<td>" . $row['N_Seg_social'] . "</td>";
                                echo "<td><span class='material-symbols-sharp'>download</span></td>";
                                echo "<td>" . ($row['Validez'] == 1 ? 'Sí' : 'No') . "</td>";
                                echo "<td>" . ($row['Activo'] == 1 ? 'Sí' : 'No') . "</td>";
                                echo "<td>" . $row['TELF_Alumno'] . "</td>";
                                echo "<td>" . $row['EMAIL_Alumno'] . "</td>";
                                echo "<td>" . $row['Direccion'] . "</td>";
                                echo "<td>" . $row['Codigo_Postal'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            // Si no se encontraron alumnos asociados al centro educativo, muestra un mensaje indicando que no hay resultados
                            echo "<tr><td colspan='14'>No se encontraron alumnos asociados a este centro educativo.</td></tr>";
                        }
                        ?>
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
                    <a href="index.php?pages=crearAlumno"><button class="new"><label>Insertar alumno</label><span class="material-symbols-sharp">person_add</span></button></a>
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