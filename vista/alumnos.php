<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/alumnos/alumnosStyle.css">
    <link rel="stylesheet" href="assets/css/common/commonStyle.css" />
</head>
<body>
    <div class="container">
        
        <?php
        $activeLink = 'alumnos';
        include 'aside.php';
        ?>
        
        <div class="contenedorAlumnos">
            <?php
            require './modelo/conexion.php';
            // Obtener el nombre del centro educativo del usuario actual
            $nombre_centro = $_SESSION['nombre_centro'];
            
            // Consultar la base de datos para obtener los alumnos del centro
            $conn = ConexionBD::conectar();
            
            if ($conn) {
                $stmt = $conn->prepare("SELECT usuario.* FROM usuario INNER JOIN usuario_centro ON usuario.ID_Usuario = usuario_centro.ID_Usuario INNER JOIN centro_formativo ON usuario_centro.ID_Centro_Formativo = centro_formativo.ID_Centro_Formativo WHERE centro_formativo.Nombre = ? AND usuario.Rol = 'ALUMNO'");
                $stmt->execute([$nombre_centro]);
                $alumnos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            ?>
            
            <div class="containerTabla">
                <h2>Tabla de alumnos del <b><?php echo strtoupper($nombre_centro); ?></b></h2>
                <ul class="responsive-table">
                    <li class="table-header">
                        <div class="col col-1">ID</div>
                        <div class="col col-2">Nombre</div>
                        <div class="col col-3">Apellido/s</div>
                        <div class="col col-4">Email</div>
                        <div class="col col-5">Modificar</div>
                        <div class="col col-6">Eliminar</div>
                    </li>
                    <?php foreach ($alumnos as $alumno): ?>
                        <li class="table-row">
                            <div class="col col-1" data-label="ID"><?php echo $alumno['ID_Usuario']; ?></div>
                            <div class="col col-2" data-label="Nombre"><?php echo $alumno['Nombre']; ?></div>
                            <div class="col col-3" data-label="Apellidos"><?php echo $alumno['Apellido1']?></div>
                            <div class="col col-4" data-label="Email"><?php echo $alumno['EMAIL_Usuario']; ?></div>
                            <div class="col col-5" data-label="btnMod"><button>MODIFICAR</button></div>
                            <div class="col col-6" data-label="btnDel"><button>ELIMINAR</button></div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./assets/js/common/commonScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>