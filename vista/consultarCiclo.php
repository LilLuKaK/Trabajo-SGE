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
        $activeLink = 'consultarCiclo';
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
                </div> 
                <h2>Debes de rellenar un campo y darle al botón de buscar, para hacer una consulta con un filtro.</h2>
            </div>
            <div class="middle">
                <table class="tablaCiclos">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Nombre Ciclo</th>
                            <th>Numero total de alumnos</th>
                            <th>Alumnos con prácticas</th>
                            <th>Alumnos sin practicas</th>
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
                        $stmt = $conn->prepare("SELECT 
                                                cf.ID_Ciclo_Formativo,
                                                cf.Nombre_Ciclo,
                                                (SELECT COUNT(*) 
                                                FROM ciclo_alumno ca 
                                                JOIN centro_alumno cea ON ca.ID_Alumno = cea.ID_Alumno 
                                                WHERE ca.ID_Ciclo_Formativo = cf.ID_Ciclo_Formativo 
                                                AND cea.ID_Centro_Formativo = :id_centro) AS Total_Alumnos_Matriculados,
                                                (SELECT COUNT(*) 
                                                FROM ciclo_alumno ca 
                                                JOIN alumnos a ON ca.ID_Alumno = a.ID_Alumno 
                                                JOIN centro_alumno cea ON ca.ID_Alumno = cea.ID_Alumno 
                                                WHERE a.Activo = 1 
                                                AND ca.ID_Ciclo_Formativo = cf.ID_Ciclo_Formativo 
                                                AND cea.ID_Centro_Formativo = :id_centro) AS Alumnos_Activos,
                                                (SELECT COUNT(*) 
                                                FROM ciclo_alumno ca 
                                                JOIN alumnos a ON ca.ID_Alumno = a.ID_Alumno 
                                                JOIN centro_alumno cea ON ca.ID_Alumno = cea.ID_Alumno 
                                                WHERE (a.Activo = 0 OR a.Validez = 0) 
                                                AND ca.ID_Ciclo_Formativo = cf.ID_Ciclo_Formativo 
                                                AND cea.ID_Centro_Formativo = :id_centro) AS Alumnos_Inactivos
                                                FROM 
                                                    ciclos_formativos cf
                                                WHERE
                                                EXISTS (SELECT 1 FROM centro_formativo WHERE ID_Centro_Formativo = :id_centro);");
                        $stmt->execute(array(
                            ':id_centro' => $id_centro_educativo
                        ));

                        // Comprueba si se encontraron resultados
                        if ($stmt->rowCount() > 0) {
                            // Itera sobre los resultados y muestra los datos en la tabla
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                    echo "<td class='button-container'>";
                                        echo "<input id='editAlumno_" . $row['ID_Ciclo_Formativo'] . "' type='hidden' value='" . $row['ID_Ciclo_Formativo'] . "'>";
                                    echo "</td>";
                                    echo "<td style='font-family: 800; font-size:15px;' >" . $row['ID_Ciclo_Formativo'] . "</td>"; // Hacer editable
                                    echo "<td><input type='text' value='" . $row['Nombre_Ciclo'] . "' readonly class='compact-input'></td>"; // Hacer editable
                                    echo "<td><input type='text' value='" . $row['Total_Alumnos_Matriculados'] . "' readonly class='compact-input'></td>"; // Hacer editable
                                    echo "<td><input type='text' value='" . $row['Alumnos_Activos'] . "' readonly class='compact-input'></td>"; // Hacer editable
                                    echo "<td><input type='text' value='" . $row['Alumnos_Inactivos'] . "' readonly class='compact-input'></td>"; // Hacer editable
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
                <p>Insertar Ciclo formativo</p>
                <h2>Añadir un nuevo Ciclo Formativo a la base de datos.</h2>
                </div>
                <div class="forms">
                    <h2>Para insertar un nuevo Ciclo Formativo, haga click en el siguiente botón. Este abrirá una nueva ventana:</h2>
                    <a href="index.php?pages=crearCiclo">
                        <button class="new">
                            <label>Insertar Ciclo</label>
                            <span class="material-symbols-rounded">assignment_add</span>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="./assets/js/common/commonScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>