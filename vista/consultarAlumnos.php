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
<<<<<<< HEAD
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
                                    // Convertir los datos del alumno a JSON
                                    $alumno = array(
                                        'ID_Alumno' => $row['ID_Alumno'],
                                        'Nombre' => $row['Nombre'],
                                        'Apellido1' => $row['Apellido1'],
                                        'DNI' => $row['DNI'],
                                        'Nombre_Ciclo' => $row['Nombre_Ciclo'],
                                        'N_Seg_social' => $row['N_Seg_social'],
                                        'Validez' => $row['Validez'] == 1 ? 'Sí' : 'No',
                                        'Activo' => $row['Activo'] == 1 ? 'Sí' : 'No',
                                        'TELF_Alumno' => $row['TELF_Alumno'],
                                        'EMAIL_Alumno' => $row['EMAIL_Alumno'],
                                        'Direccion' => $row['Direccion'],
                                        'Codigo_Postal' => $row['Codigo_Postal']
                                    );
                                    // Convertir el array a JSON
                                    $alumno_json = json_encode($alumno);
                                    
                                    // Agregar el atributo data-datos-alumno a la fila
                                    echo "<tr class='fila-alumno' data-datos-alumno='" . htmlspecialchars($alumno_json, ENT_QUOTES, 'UTF-8') . "' data-id-alumno='" . $row['ID_Alumno'] . "'>";
                                    echo "<td class='button-container'>";
                                    echo "<button class='delete' name='deleteAlumno' data-id='" . $row['ID_Alumno'] . "'><span class='material-symbols-sharp'>delete</span></button>";
                                    echo "<a href='index.php?pages=editarAlumno'><button class='edit' name='" . $row['ID_Alumno'] . "' id='editaAlumno_" . $row['ID_Alumno'] . "'><span class='material-symbols-sharp'>edit</span></button></a>";
                                    echo "<button class='save' style='display: none'><span class='material-symbols-sharp'>save</span></button>";
                                    echo "<input id='editAlumno_" . $row['ID_Alumno'] . "' name='editaAlumno' type='hidden' value='" . $row['ID_Alumno'] . "'>";
                                    echo "</td>";
                                    echo "<td style='font-family: 800; font-size:15px;' >" . $row['ID_Alumno'] . "</td>"; // Hacer editable
                                    echo "<td><input type='text' value='" . $row['Nombre'] . "' readonly class='compact-input'></td>"; // Hacer editable
                                    echo "<td><input type='text' value='" . $row['Apellido1'] . "' readonly class='compact-input'></td>"; // Hacer editable
                                    echo "<td><input type='text' value='" . $row['DNI'] . "' readonly class='compact-input'></td>"; // Hacer editable
                                    echo "<td><input type='text' value='" . $row['Nombre_Ciclo'] . "' readonly class='compact-input'></td>"; // Hacer editable
                                    echo "<td><input type='text' value='" . $row['N_Seg_social'] . "' readonly class='compact-input'></td>"; // Hacer editable
                                    echo "<td><span class='material-symbols-sharp'>download</span></td>";
                                    echo "<td><input type='text' value='" . ($row['Validez'] == 1 ? 'Sí' : 'No') . "' readonly class='compact-input'></td>"; // Hacer editable
                                    echo "<td><input type='text' value='" . ($row['Activo'] == 1 ? 'Sí' : 'No') . "' readonly class='compact-input'></td>"; // Hacer editable
                                    echo "<td><input type='text' value='" . $row['TELF_Alumno'] . "' readonly class='compact-input'></td>"; // Hacer editable
                                    echo "<td><input type='text' value='" . $row['EMAIL_Alumno'] . "' readonly class='compact-input'></td>"; // Hacer editable
                                    echo "<td><input type='text' value='" . $row['Direccion'] . "' readonly class='compact-input'></td>"; // Hacer editable
                                    echo "<td><input type='text' value='" . $row['Codigo_Postal'] . "' readonly class='compact-input'></td>"; // Hacer editable
                                    echo "</tr>";
                                }
                            } else {
                                // Si no se encontraron alumnos asociados al centro educativo, muestra un mensaje indicando que no hay resultados
                                echo "<tr><td colspan='14'>No se encontraron alumnos asociados a este centro educativo.</td></tr>";
                            }

=======
                                include_once './modelo/tablaAlumnos.php';
>>>>>>> d454d7400d7cd9da418ce79d1a8d7eaf92f92db0
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
    <script src="./assets/js/busquedas/tablaAlumnos.js"></script>
<<<<<<< HEAD
    <!-- <script src="./assets/js/busquedas/dni.js"></script> -->
    <script>
        // Aquí colocas el bloque de código que te proporcioné previamente
        document.addEventListener('DOMContentLoaded', function(){
            const botonesEdit = document.querySelectorAll('.edit'); // Seleccionar todos los botones de edición
            
            botonesEdit.forEach(boton => {
                boton.addEventListener('click', (e) => {
                    e.preventDefault();
                    const idAlumno = boton.getAttribute('name');
                    window.location.href = `http://127.0.0.1/Trabajo-SGE/index.php?pages=editarAlumno&id=${idAlumno}`;
                });
            });
        });
    </script>
    <!-- <script src="./assets/js/busquedas/nombre.js"></script> -->
    <script src="./assets/js/common/commonScript.js"></script>
=======
>>>>>>> d454d7400d7cd9da418ce79d1a8d7eaf92f92db0
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>
</html>