<?php 
    include 'modelo/conexion.php';
       
    
    // Verificar si se recibió un ID de alumno válido en la URL
    if (isset($_GET['id'])) {
        $alumnoID = $_GET['id'];
        $conn = ConexionBD::conectar();

        // Verificar si la conexión a la base de datos se estableció correctamente
        if ($conn) {
            // Consultar los datos del alumno por su ID
            $stmt = $conn->prepare("SELECT alumnos.*, ciclos_formativos.ID_Ciclo_Formativo, ciclos_formativos.Nombre_Ciclo 
                                    FROM alumnos 
                                    INNER JOIN ciclo_alumno ON alumnos.ID_Alumno = ciclo_alumno.ID_Alumno 
                                    INNER JOIN ciclos_formativos ON ciclo_alumno.ID_Ciclo_Formativo = ciclos_formativos.ID_Ciclo_Formativo 
                                    WHERE alumnos.ID_Alumno = ?");
            if ($stmt) {
                // Ejecutar la consulta
                $stmt->execute([$alumnoID]);

                // Verificar si se encontraron resultados
                if ($stmt->rowCount() > 0) {
                    // Obtener los datos del alumno
                    $alumno = $stmt->fetch(PDO::FETCH_ASSOC);
                } else {
                    // Mostrar un mensaje de error si no se encontraron resultados
                    echo "No se encontraron datos para el alumno con ID $alumnoID";
                }
            } else {
                // Mostrar un mensaje de error si hubo un problema con la consulta SQL
                echo "Error en la consulta SQL: " . $conn->errorInfo()[2];
            }
            
           
        } else {
            // Mostrar un mensaje de error si no se pudo conectar a la base de datos
            echo "Error de conexión a la base de datos.";
        }
    } else {
        // Mostrar un mensaje de error si no se proporcionó un ID de alumno válido en la URL
        echo "No se proporcionó un ID de alumno válido en la URL.";
    }

    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Alumno</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/login-register/loginStyle.css">
    <link rel="stylesheet" href="assets/css/common/commonStyle.css" />
    <link rel="stylesheet" href="assets/css/login-register/extendedLogin.css" />
</head>
<body>
    <div class="container">
        <?php
        $activeLink = 'consultarAlumnos';
        include 'aside.php';
        ?>
        <div class="contenedorRegistro">
            <section class="sign-in">
                <article class="sign-in__details">
                    <div id="label">
                        <h1>Editar Alumno</h1>
                        <p>Complete el siguiente formulario para Editar un alumno</p>
                    </div>
                    <form class="sign-in__form" id="formEditarAlumno" action="./controlador/userController.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $alumno['ID_Alumno']; ?>">
                        <div class="form__control">
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre" name="nombre" value="<?php echo $alumno['Nombre']; ?>">
                            <div id="nombre-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="apellidos">Apellido/s</label>
                            <input type="text" id="apellidos" name="apellidos" value="<?php echo $alumno['Apellido1']; ?>">
                            <div id="apellidos-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="dni">DNI</label>
                            <input type="text" id="dni" name="dni" value="<?php echo $alumno['DNI']; ?>">
                            <div id="dni-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="N_Seg_social">Numero de la Seguridad Social</label>
                            <input type="text" id="N_Seg_social" name="N_Seg_social" value="<?php echo $alumno['N_Seg_social']; ?>">
                            <div id="N_Seg_social-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="Curriculum_Vitae">Curriculum Vitae</label>
                            <input type="text" id="Curriculum_Vitae" name="Curriculum_Vitae" placeholder="Introduce el Curriculum Vitae">
                            <div id="Curriculum_Vitae-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="activo">Activo</label>
                            <div id="activo">
                                <input type="radio" id="siActivo" name="activo" value="1" <?php if ($alumno['Activo'] == 1) echo "checked"; ?>>
                                <label for="siActivo">Sí</label>
                                <input type="radio" id="noActivo" name="activo" value="0" <?php if ($alumno['Activo'] == 0) echo "checked"; ?>>
                                <label for="noActivo">No</label>
                            </div>
                            <div id="activo-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="validez">Validez</label>
                            <div id="validez">
                                <input type="radio" id="siValidez" name="validez" value="1" <?php if ($alumno['Validez'] == 1) echo "checked"; ?>>
                                <label for="siValidez">Sí</label>
                                <input type="radio" id="noValidez" name="validez" value="0" <?php if ($alumno['Validez'] == 0) echo "checked"; ?>>
                                <label for="noValidez">No</label>
                            </div>
                            <div id="validez-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="TELF_Alumno">Telefono</label>
                            <input type="text" id="TELF_Alumno" name="TELF_Alumno" value="<?php echo $alumno['TELF_Alumno']; ?>">
                            <div id="TELF_Alumno-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="EMAIL_Alumno">Email</label>
                            <input type="text" id="EMAIL_Alumno" name="EMAIL_Alumno" value="<?php echo $alumno['EMAIL_Alumno']; ?>">
                            <div id="EMAIL_Alumno-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="Direccion">Direccion</label>
                            <input type="text" id="Direccion" name="Direccion" value="<?php echo $alumno['Direccion']; ?>">
                            <div id="Direccion-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="Codigo_Postal">Codigo Postal</label>
                            <input type="text" id="Codigo_Postal" name="Codigo_Postal" value="<?php echo $alumno['Codigo_Postal']; ?>">
                            <div id="Codigo_Postal-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="ciclo">Ciclo</label>
                            <select name="ciclo" id="ciclo">
                                <option value='' selected disabled>-- Selecciona el ciclo --</option>
                                <?php
                                include './modelo/ciclo_formativo.php';
                                ?>
                            </select>
                            <div id="ciclo-error"></div>
                        </div>

                        <input type="submit" class="btn primary" value="Editar" name="editarAlumno" id="buttonEditar">
                        <a href="index.php?pages=consultarAlumnos" class="btn primary">Cancelar</a>
                        <input type="hidden" id="alertabtn" value="editarAlumno">
                    </form>
                </article>
                <article class="sign-in__logo">
                    <div><img src="./assets/images/login-register/undraw_exams_re_4ios.svg" alt=""></div>
                </article>
            </section>
        </div>
    </div>
    <script>
        /*document.getElementById('ciclo').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex].value;
            document.getElementById('cicloSeleccionado').value = selectedOption;
        });*/
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./assets/js/common/commonScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./assets/js/Editar_Borrar/editar.js"></script>

    
</body>
</html>