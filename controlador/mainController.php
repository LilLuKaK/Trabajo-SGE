<?php
if(isset($_GET['pages'])) {
    $pages = $_GET['pages'];
    
    switch($pages) {
        case 'login':
            require_once 'vista/login.php';
            break;
        case 'register':
            require_once 'vista/register.php';
            break;
        case 'crearCentro':
            require_once 'vista/crearCentro.php';
            break;
        case 'crearAlumno':
            require_once 'vista/crearAlumno.php';
            break;
        case 'consultarAlumnos':
            require_once 'vista/consultarAlumnos.php';
            break;
        case 'consultarEmpresa':
            require_once 'vista/consultarEmpresa.php';
            break;
        case 'landing':
            require_once 'vista/landingPage.php';
            break;
        default:
            require_once 'vista/landingPage.php';
            break;
    }
} else {
    require_once 'vista/landingPage.php';
}
