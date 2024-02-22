<aside>
    <div class="top">
        <div class="logo">
            <img src="./assets/images/common/logo.png" />
            <?php session_start(); ?>
            <h2><?php echo strtoupper($_SESSION['nombre_centro']); ?></h2>
        </div>
        <div class="close" id="close-btn">
            <span class="material-icons-sharp">close</span>
        </div>
    </div>
    
    <div class="sidebar">
        <a href="index.php?pages=landing" <?php if ($activeLink === 'landing') echo 'class="active"'; ?>>
            <span class="material-icons-sharp">dashboard</span>
            <h3>Inicio</h3>
        </a>
        <a href="index.php?pages=login">
            <span class="material-icons-sharp">person_outline</span>
            <h3>Login(provisional)</h3>
        </a>
        <a href="index.php?pages=register" <?php if ($activeLink === 'register') echo 'class="active"'; ?>>
            <span class="material-icons-sharp">receipt_long</span>
            <h3>Registro(provisional)</h3>
        </a>
        <a href="index.php?pages=crearCentro" <?php if ($activeLink === 'crearCentro') echo 'class="active"'; ?>>
            <span class="material-icons-sharp">insights</span>
            <h3>Crear Centro(provisional)</h3>
        </a>
        <a href="index.php?pages=crearAlumno" <?php if ($activeLink === 'crearAlumno') echo 'class="active"'; ?>>
            <span class="material-icons-sharp">mail_outline</span>
            <h3>Crear Alumno(provisional)</h3>
        </a>
        <a href="index.php?pages=alumnos" <?php if ($activeLink === 'alumnos') echo 'class="active"'; ?>>
            <span class="material-icons-sharp">inventory</span>
            <h3>Alumnos</h3>
        </a>
        <a href="#">
            <span class="material-icons-sharp">report_gmailerrorred</span>
            <h3>Ejemplo 6</h3>
        </a>
        <a href="#">
            <span class="material-icons-sharp">settings</span>
            <h3>Ejemplo 7</h3>
        </a>
        <a href="#">
            <span class="material-icons-sharp">add</span>
            <h3>Ejemplo 8</h3>
            <span class="message-count">26</span>
        </a>
        <a id="cerrarSesion" style="cursor: pointer;">
            <span class="material-icons-sharp">logout</span>
            <h3>Cerrar Sesión</h3>
        </a>
    </div>
</aside>
<!------------------ FIN DE ASIDE ------------------>