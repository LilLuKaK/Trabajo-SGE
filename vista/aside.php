<?php
session_start();

// Verificar si no hay una sesión de usuario activa
if (!isset($_SESSION['nombre']) || !isset($_SESSION['email'])) {
    // Redireccionar al usuario al formulario de inicio de sesión
    header("Location: index.php?pages=login");
    exit; // Asegurar que el script se detenga después de la redirección
}
?>
<div id="loader-overlay">
    <div id="loader" class="superballs">
        <div class="superballs__dot"></div>
        <div class="superballs__dot"></div>
    </div>
</div>
<aside>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <div class="top">
        <div class="logo">
            <img src="./assets/images/common/logo.png" />
            <h2><?php echo strtoupper($_SESSION['nombre_centro']); ?></h2>
        </div>
        <div class="close" id="close-btn">
            <span class="material-icons-sharp">close</span>
        </div>
    </div>
    
    <div class="sidebar">
        <a href="index.php?pages=landing" <?php if ($activeLink === 'landing') echo 'class="active"'; ?>>
            <span class="material-symbols-sharp">home</span>
            <h3>Inicio</h3>
        </a>
        <?php
        // Verificar si el usuario ha iniciado sesión y si es un administrador
        if (isset($_SESSION['nombre']) && isset($_SESSION['email'])) {
            // Aquí puedes verificar el rol del usuario, supongamos que el rol de administrador es 'admin'
            if ($_SESSION['Rol'] === 'ADMIN') {
        ?>
                <a href="index.php?pages=register" <?php if ($activeLink === 'register') echo 'class="active"'; ?>>
                    <span class="material-symbols-sharp">history_edu</span>
                    <h3>Registrar Tutor</h3>
                </a>
                <a href="index.php?pages=crearCentro" <?php if ($activeLink === 'crearCentro') echo 'class="active"'; ?>>
                    <span class="material-symbols-outlined">domain_add</span>
                    <h3>Crear Centro</h3>
                </a>
        <?php
            }
        }
        ?>
        <a href="index.php?pages=consultarAlumnos" <?php if ($activeLink === 'consultarAlumnos') echo 'class="active"'; ?>>
            <span class="material-symbols-sharp">school</span>
            <h3>Alumnos</h3>
            <!--<span class="message-count">26</span>-->
        </a>
        <a href="index.php?pages=consultarEmpresas" <?php if ($activeLink === 'consultarEmpresas') echo 'class="active"'; ?>>
            <span class="material-symbols-sharp">work</span>
            <h3>Empresas</h3>
        </a>
        <a href="index.php?pages=consultarCiclo" <?php if ($activeLink === 'consultarCiclo') echo 'class="active"'; ?>>
            <span class="material-symbols-outlined">auto_stories</span>
            <h3>Ciclos Formativos</h3>
        </a>
        <a href="index.php?pages=consultarNecesidades" <?php if ($activeLink === 'consultarNecesidad') echo 'class="active"'; ?>>
            <span class="material-symbols-sharp">linked_services</span>
            <h3>Necesidades</h3>
        </a>
        <a href="index.php?pages=consultarPracticas" <?php if ($activeLink === 'consultarPracticas') echo 'class="active"'; ?>>
            <span class="material-symbols-sharp">settings_accessibility</span>
            <h3>Prácticas</h3>
        </a>
       <a href="index.php?pages=consultarEmpresasBolsa" <?php if ($activeLink === 'consultarEmpresasBolsa') echo 'class="active"'; ?>>
            <span class="material-symbols-sharp">cases</span>
            <h3>Empresas (Bolsa de trabajo)</h3>
        </a>
        <a href="index.php?pages=consultarNecesidadBolsa" <?php if ($activeLink === 'consultarNecesidadBolsa') echo 'class="active"'; ?>>
            <span class="material-symbols-sharp">person_alert</span>
            <h3>Necesidades (Bolsa de Trabajo)</h3>
        </a>
        <a id="cerrarSesion" style="cursor: pointer;">
            <span class="material-icons-sharp">logout</span>
            <h3>Cerrar Sesión</h3>
        </a>
    </div>
</aside>
<!------------------ FIN DE ASIDE ------------------>