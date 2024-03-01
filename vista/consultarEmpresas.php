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
                            <input type="text" id="nombre" name="nombre" placeholder="Introduce el Nombre de la Empresa"></input>
                            <button id="buscarEmpresa" class="search" name="buscarEmpresa"><span class="material-symbols-sharp">manage_search</span></button>
                            <input type="hidden" value="buscarEmpresa">
                        </div>
                    </div>
                    <div class="form__control">
                        <label for="CIF">CIF</label>
                        <div class="input">
                            <input type="text" id="CIF" name="CIF" placeholder="Introduce el CIF de la Empresa"></input>
                            <button id="buscarCIF" class="search" name="buscarCIF"><span class="material-symbols-sharp">manage_search</span></button>
                            <input type="hidden" value="buscarCIF">
                        </div>
                    </div>
                    <div class="form__control">
                        <label for="duenyo">Dueño</label>
                        <div class="input">
                            <input type="text" id="duenyo" name="duenyo" placeholder="Introduce el Dueño de la Empresa"></input>
                            <button id="buscarDuenyo" class="search" name="buscarDuenyo"><span class="material-symbols-sharp">manage_search</span></button>
                            <input type="hidden" value="buscarDuenyo">
                        </div>
                    </div>
                    <div class="form__control">
                        <label for="firmante">Firmante del Convenio</label>
                        <div class="input">
                            <input type="text" id="firmante" name="firmante" placeholder="Introduce el Firmante del Convenio de la Empresa"></input>
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
                        // Incluir el archivo de conexión a la base de datos
                        include_once './modelo/conexion.php';

                        $id_centro_educativo = $_SESSION['id_centro'];
                        // Suponiendo que ya tienes el ID del centro educativo en una variable $id_centro_educativo
                        // Realiza la consulta para obtener las empresas del centro educativo que tienen convenio
                        $conn = ConexionBD::conectar();
                        $stmt = $conn->prepare( "SELECT ce.*, cea.*
                                        FROM control_empresas ce
                                        JOIN contacto_control cc ON ce.ID_Control_Empresa = cc.ID_Control_Empresa
                                        JOIN contacto_empresa cea ON cc.ID_Contacto_Empresa = cea.ID_Contacto_Empresa
                                        JOIN control_convenios ccon ON ce.ID_Control_Empresa = ccon.ID_Control_Empresa
                                        WHERE ccon.ID_Centro_Formativo = ?");
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
                                echo "<td>" . $row['ID_Control_Empresa'] . "</td>";
                                echo "<td>" . $row['Nombre_Empresa'] . "</td>";
                                echo "<td>" . $row['CIF'] . "</td>";
                                echo "<td>" . $row['Duenyo'] . "</td>";
                                echo "<td>" . $row['Firmante_Convenio'] . "</td>"; // Nombre del ciclo formativo
                                echo "<td>" . $row['Direccion'] . "</td>";
                                echo "<td>" . $row['EMAIL_Empresa'] . "</td>";
                                echo "<td>" . $row['TELF_Empresa'] . "</td>";
                                echo "<td>" . $row['Nombre_Contacto'] . "</td>";
                                echo "<td>" . $row['EMAIL_Contacto_Empresa'] . "</td>";
                                echo "<td>" . $row['TELF_Contacto_Empresa'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            // Si no se encontraron centros asociados al centro educativo, muestra un mensaje indicando que no hay resultados
                            echo "<tr><td colspan='14'>No se encontraron alumnos asociados a este centro educativo.</td></tr>";
                        }
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