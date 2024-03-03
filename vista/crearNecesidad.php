<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/login-register/loginStyle.css">
    <link rel="stylesheet" href="assets/css/common/commonStyle.css" />
    <link rel="stylesheet" href="assets/css/login-register/extendedLogin.css" />
</head>
<body>
    <div class="container">
        
        <?php
        $activeLink = 'consultarNecesidad';
        include 'aside.php';
        ?>

        <div class="contenedorRegistro">
            <section class="sign-in">
                <article class="sign-in__details">
                    <div id="label">
                        <h1>Crear Necesidad Nueva</h1>
                        <p>Complete el siguiente formulario para crear una Nueva Necesidad</p>
                    </div>
                    <form class="sign-in__form" id="registroForm">
                        <!-- Aquí iría un combobox con las diferentes empresas-->
                        <div class="form__control">
                            <label for="nombre">Nombre de la Empresa</label>
                            <select name="empresa" id="empresa">
                                <option value='' selected disabled>-- Selecciona la Empresa --</option>
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
                            <div id="empresa-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="anyo">Año de la Necesidad</label>
                            <input type="text" id="anyo" name="anyo" placeholder="Introduce el Año">
                            <div id="anyo-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="cuadrante">Cuadrante</label>
                            <input type="text" id="cuadrante" name="cuadrante" placeholder="Introduce el mes del cuadrante">
                            <div id="cuadrante-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="cantidad">Nº de vacantes totales</label>
                            <input type="text" id="cantidad" name="cantidad" placeholder="introduce la cantidad total de posibles puestos">
                            <div id="cantidad-error"></div>
                        </div>
                        <div class="form__control">     
                            <button type="button" id="agregarCursoBtn">Agregar Curso</button>
                        </div>

                        <input type="hidden" name="registrarNecesidad" value="registrarNecesidad">
                        <input type="submit" class="btn primary" value="Registrar" name="registrarNecesidad" id="buttonEnviar">
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
    <script src="./assets/js/crearNecesidad/crearNecesidadScript.js"></script>
    <script src="./assets/js/common/commonScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>