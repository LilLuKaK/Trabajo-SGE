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
        $activeLink = 'consultarConvenios';
        include 'aside.php';
        ?>

        <div class="right">
            <div class="scroll">
                <div class="top">
                    <h1>Consulta de Convenios</h1>
                    <h2>Aquí podrás consultar, modificar y eliminar convenios.</h2>
                </div>
                <div class="forms">
                    <div class="form__control">
                        <label for="nombre">Nombre de la Empresa</label>
                        <div class="input">
                        <select name="ciclos" id="ciclos" class="ciclos" sizeof="3">
                                <?php
                                // Incluir la conexión y consulta a la base de datos
                                include './modelo/conexion.php';

                                // Realizar la consulta para obtener los nombres de los ciclos formativos
                                $conn = ConexionBD::conectar();
                                /**Añadir la consulta de control de
                                * "AND ID_Centro_Formativo = (SELECT ID_Centro_Formativo
                                *                       FROM usuario_centro
                                *                        WHERE ID_Usuario = THIS_USER.ID_Usuario)"*/

                                if ($conn) {
                                    $stmt = $conn->query("SELECT * FROM control_empresas");

                                    // Verificar si se encontraron resultados
                                    if ($stmt->rowCount() > 0) {
                                        // Iterar sobre los resultados y mostrar las opciones del select
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<option value='" . $row['Nombre'] . "'>" . $row['Nombre'] . "</option>";
                                        }
                                    } else {
                                        echo "<option value='' disabled>No se encontraron Empresas.</option>";
                                    }
                                }
                                ?>
                            </select>
                            <span class="material-symbols-sharp expand">expand_more</span>
                            <button id="last" class="search" name="buscarFP"><span class="material-symbols-sharp">manage_search</span></button>
                            <input type="hidden" value="buscarFP">
                        </div>
                    </div>

                    <!-- Control de que la entrada sean números-->
                    <div class="form__control">
                        <label for="Fecha_Inicio">Fecha de Incio</label>
                        <div class="input">
                            <input type="text" id="Fecha_Inicio" name="Fecha_Inicio" placeholder="Introduce la fecha de Inicio del Convenio"></input>
                            <button id="buscarFecha_Inicio" class="search" name="buscarFecha_Inicio"><span class="material-symbols-sharp">manage_search</span></button>
                            <input type="hidden" value="buscarFecha_Inicio">
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
                                <th>Nombre Empresa</th>
                                <th>Id del Ministerio</th>
                                <th>Fecha de Inicio</th>
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
                        $stmt = $conn->prepare("SELECT  control_empresas.Nombre,control_empresas.ID_Control_Empresa, control_convenios.ID_Ministerio, control_convenios.Fecha_Inicio
                                                FROM control_empresas, control_convenios
                                                WHERE control_convenios.ID_Control_Empresa = control_empresas.ID_Control_Empresa
                                                AND control_convenios.ID_Centro_Formativo=1 = ?");
                        $stmt->execute([$id_centro_educativo]);

                        // Comprueba si se encontraron resultados
                        if ($stmt->rowCount() > 0) {
                            // Itera sobre los resultados y muestra los datos en la tabla
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td>";
                                echo "<button class='delete' name='deleteAlumno' data-id='" . $row['ID_Alumno'] . "'><span class='material-symbols-sharp'>delete</span></button>";
                                echo "<a href='index.php?pages=editarAlumno'><button class='edit' name='" . $row['ID_Alumno'] . "' id='editarAlumno'><span class='material-symbols-sharp'>edit</span></button></a>";
                                echo "<input id='editAlumno' type='hidden' value='" . $row['ID_Alumno'] . "'>";
                                echo "</td>";
                                echo "<td>" . $row['Nombre de la Empresa'] . "</td>";
                                echo "<td>" . $row['ID del Convenio'] . "</td>";
                                echo "<td>" . $row['ID Ministerial'] . "</td>";                                
                                echo "<td>" . $row['Fecha de Inicio'] . "</td>";
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
    <script src="./assets/js/Editar_Borrar/editar.js"></script>
    <script src="./assets/js/busquedas/validez.js"></script>
    <script src="./assets/js/busquedas/cicloFP.js"></script>
    <script src="./assets/js/busquedas/dni.js"></script>
    <script src="./assets/js/busquedas/nombre.js"></script>
    <script src="./assets/js/common/commonScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>