<?php 
    include 'modelo/conexion.php';
    
    // Verificar si se recibió un ID de empresa válido en la URL
    if (isset($_GET['id'])) {
        $empresaID = $_GET['id'];
        $conn = ConexionBD::conectar();

        // Verificar si la conexión a la base de datos se estableció correctamente
        if ($conn) {
            // Consultar los datos de la empresa por su ID
            $stmt = $conn->prepare("SELECT * FROM control_empresas WHERE ID_Control_Empresa = ?");
            if ($stmt) {
                // Ejecutar la consulta
                $stmt->execute([$empresaID]);

                // Verificar si se encontraron resultados
                if ($stmt->rowCount() > 0) {
                    // Obtener los datos de la empresa
                    $empresa = $stmt->fetch(PDO::FETCH_ASSOC);
                } else {
                    // Mostrar un mensaje de error si no se encontraron resultados
                    echo "No se encontraron datos para la empresa con ID $empresaID";
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
        // Mostrar un mensaje de error si no se proporcionó un ID de empresa válido en la URL
        echo "No se proporcionó un ID de empresa válido en la URL.";
    }
?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/login-register/loginStyle.css">
    <link rel="stylesheet" href="assets/css/common/commonStyle.css" />
    <link rel="stylesheet" href="assets/css/login-register/extendedLogin.css" />
</head>
<body>
    <div class="container">
        
        <?php
        $activeLink = 'consultarEmpresas';
        include 'aside.php';
        ?>

        <div class="contenedorRegistro">
            <section class="sign-in">
                <article class="sign-in__details">
                    <div id="label">
                        <h1>Editar Empresa</h1>
                        <p>Complete el siguiente formulario para Editar una empresa</p>
                    </div>
                    <form class="sign-in__form" id="editarEmpresa" action="./controlador/userController.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $empresa['ID_Control_Empresa']; ?>">
                        <div class="form__control">
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre" name="nombre" value="<?php echo $empresa['Nombre_Empresa'];?>">
                            <div id="nombre-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="cif">CIF</label>
                            <input type="text" id="cif" name="cif" value="<?php echo $empresa['CIF'];?>">
                            <div id="cif-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="duenyo">Dueño</label>
                            <input type="text" id="duenyo" name="duenyo" value="<?php echo $empresa['Duenyo'];?>">
                            <div id="duenyo-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="firmante">Firmante del Convenio</label>
                            <input type="text" id="firmante" name="firmante" value="<?php echo $empresa['Firmante_Convenio'];?>">
                            <div id="firmante-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="direccion">Dirección</label>
                            <input type="text" id="direccion" name="direccion" value="<?php echo $empresa['Direccion'];?>">
                            <div id="direccion-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" value="<?php echo $empresa['EMAIL_Empresa'];?>">
                            <div id="email-error"></div>
                        </div>
                        <div class="form__control">
                            <label for="telefono">Telefono</label>
                            <input type="text" id="telefono" name="telefono" value="<?php echo $empresa['TELF_Empresa'];?>">
                            <div id="telefono-error"></div>
                        </div>
                        <input type="hidden" name="editarEmpresa" value="editarEmpresa">
                        <input type="submit" class="btn primary" value="Editar" name="editarEmpresa" id="buttonEnviar">
                        <a href="index.php?pages=consultarEmpresas" class="btn primary">Cancelar</a>
                    </form>
                </article>
                <article class="sign-in__logo">
                    <div><img src="./assets/images/login-register/undraw_businessman_e7v0.svg" alt=""></div>
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
    <script src="./assets/js/busquedas/tablaEmpresa.js"></script>
    
</body>
</html>