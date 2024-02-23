<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/login-register/loginStyle.css">
    <link rel="stylesheet" href="assets/css/common/commonStyle.css" />
</head>
<body>
    <div class="container">
        
        <?php
        $activeLink = 'crearAlumno';
        include 'aside.php';
        ?>

        <div class="contenedorRegistro">
            <section class="sign-in">
                <article class="sign-in__details">
                    <h1>Crear Alumno</h1>
                    <p>Complete el siguiente formulario para crear un alumno</p>
                    <form class="sign-in__form" id="registroForm">
                        <div class="form__control">
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre" name="nombre" placeholder="Introduce el nombre completo">
                            <div id="nombre-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="apellidos">Apellido/s</label>
                            <input type="text" id="apellidos" name="apellidos" placeholder="Introduce el apellido o apellidos">
                            <div id="apellidos-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="dni">DNI</label>
                            <input type="text" id="dni" name="dni" placeholder="Introduce el dni">
                            <div id="dni-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="N_Seg_social">Numero de la Seguridad Social</label>
                            <input type="text" id="N_Seg_social" name="N_Seg_social" placeholder="Introduce el Numero de la Seguridad Social">
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
                                <input type="radio" id="siActivo" name="activo" value="1">
                                <label for="siActivo">Sí</label>
                                <input type="radio" id="noActivo" name="activo" value="0">
                                <label for="noActivo">No</label>
                            </div>
                            <div id="activo-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="validez">Validez</label>
                            <div id="validez">
                                <input type="radio" id="siValidez" name="validez" value="1">
                                <label for="siValidez">Sí</label>
                                <input type="radio" id="noValidez" name="validez" value="0">
                                <label for="noValidez">No</label>
                            </div>
                            <div id="validez-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="TELF_Alumno">Telefono</label>
                            <input type="text" id="TELF_Alumno" name="TELF_Alumno" placeholder="Introduce el telefono">
                            <div id="TELF_Alumno-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="EMAIL_Alumno">Email</label>
                            <input type="text" id="EMAIL_Alumno" name="EMAIL_Alumno" placeholder="Introduce el email">
                            <div id="EMAIL_Alumno-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="Direccion">Direccion</label>
                            <input type="text" id="Direccion" name="Direccion" placeholder="Introduce el Direccion">
                            <div id="Direccion-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="Codigo_Postal">Codigo Postal</label>
                            <input type="text" id="Codigo_Postal" name="Codigo_Postal" placeholder="Introduce el Codigo Postal">
                            <div id="Codigo_Postal-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="ciclo">Ciclo</label>
                            <select name="ciclo" id="ciclo">
                                <option value='' selected disabled>-- Selecciona el ciclo --</option>
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
                                            echo "<option value='" . $row['ID_Ciclo_Formativo'] . "'>" . $row['Nombre_Ciclo'] . "</option>";
                                        }
                                    } else {
                                        echo "<option value='' disabled>No se encontraron ciclos formativos.</option>";
                                    }
                                }
                                ?>
                            </select>
                            <div id="ciclo-error"></div>
                        </div>
                        <input type="hidden" name="registrarAlumno" value="registrarAlumno">
                        <input type="submit" class="btn primary" value="Registrar" name="registrarAlumno" id="buttonEnviar">
                    </form>
                </article>
                <article class="sign-in__logo">
                </article>
            </section>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./assets/js/crearAlumno/crearAlumnoScript.js"></script>
    <script src="./assets/js/common/commonScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>