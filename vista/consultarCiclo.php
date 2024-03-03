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
                <h1>Consulta de Ciclos Formativos</h1>
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
                <table class="data" id="tablaCiclos">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre Ciclo</th>
                            <th>Numero total de alumnos</th>
                            <th>Alumnos con prácticas</th>
                            <th>Alumnos sin practicas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once './modelo/tablaCiclos.php';
                        ?>
                    </tbody>
                </table>
            </div>         
            <div id="new">
                <div class="top">
                <h1>Insertar ciclo formativo</h1>
                <h2>Añadir un nuevo Ciclo Formativo a la base de datos.</h2>
                </div>
                <div class="forms">
                    <h2>Para insertar un nuevo ciclo formativo, haga click en el siguiente botón. Este abrirá una nueva ventana:</h2>
                    <a href="index.php?pages=crearCiclo">
                        <button class="new">
                            <label>Insertar ciclo</label>
                            <span class="material-symbols-rounded">assignment_add</span>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="./assets/js/common/commonScript.js"></script>
    <script src="./assets/js/busquedas/tablaCiclo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>