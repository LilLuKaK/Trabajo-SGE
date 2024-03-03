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
        $activeLink = 'consultarNecesidad';
        include 'aside.php';
        ?>

        <div class="right">
            <div class="scroll">
                <div class="top">
                    <h1>Consulta de Necesidades</h1>
                    <h2>Aquí podrás consultar, modificar y eliminar necesidades.</h2>
                </div>
                <div class="forms">
                    <div class="form__control">
                        <label for="nombre">Nombre de la Empresa</label>
                        <div class="input">
                            <select name="ciclos" id="ciclos" class="ciclos" sizeof="3">
                                    <?php
                                    // Incluir la conexión y consulta a la base de datos
                                    include './modelo/conexion.php';

                                    // Realizar la consulta para obtener los nombres de las empresas
                                    $conn = ConexionBD::conectar();
                                    $id_centro_educativo = $_SESSION['id_centro'];
                                    if ($conn) {
                                        $stmt = $conn->prepare("SELECT control_empresas.* FROM control_empresas, control_convenios WHERE control_convenios.ID_Centro_Formativo = ? GROUP BY control_empresas.ID_Control_Empresa");
                                        $stmt->execute([$id_centro_educativo]);
                                        // Verificar si se encontraron resultados
                                        if ($stmt->rowCount() > 0) {
                                            // Iterar sobre los resultados y mostrar las opciones del select
                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                echo "<option value='" . $row['Nombre_Empresa'] . "'>" . $row['Nombre_Empresa'] . "</option>";
                                            }
                                        } else {
                                            echo "<option value='' disabled>No se encontraron Empresas.</option>";
                                        }
                                    } else {
                                        // Manejar el caso en el que la conexión no se haya establecido correctamente
                                        echo "Error: No se pudo conectar a la base de datos.";
                                    }
                                    ?>
                            </select>
                            <span class="material-symbols-sharp expand">expand_more</span>
                            <button id="last" class="search" name="buscarEmpresa"><span class="material-symbols-sharp">manage_search</span></button>
                            <input type="hidden" value="buscarEmpresa">
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
                                <th>Vacantes totales</th>
                                <th>Vacantes Cubiertas</th>
                                <th>Vacantes libres</th>
                                <th>Año de la solicitud</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        include_once './modelo/tablaNecesidades.php';
                        ?>
                        </tbody>
                    </table>
                </div>
                <div id="new">
                    <div class="top">
                        <h1>Insertar Nueva Necesidad</h1>
                        <h2>Añadir una nueva necesidad a la base de datos.</h2>
                </div>
                <div class="forms">
                    <h2>Para insertar una nueva necesidad, haga click en el siguiente botón. Este abrirá una nueva ventana:</h2>
                    <a href="index.php?pages=crearNecesidad"><button class="new"><label>Insertar necesidad</label><span class="material-symbols-outlined">switch_access_shortcut_add</span></button></a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="./assets/js/Editar_Borrar/editar.js"></script>
    <script src="./assets/js/busquedas/validez.js"></script>
    <script src="./assets/js/common/commonScript.js"></script>
    <script src="./assets/js/crearNecesidad/crearNecesidadScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>

