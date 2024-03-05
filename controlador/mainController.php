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
        case 'crearEmpresa':
            require_once 'vista/crearEmpresa.php';
            break;
        case 'consultarAlumnos':
            require_once 'vista/consultarAlumnos.php';
            break;
        case 'consultarEmpresas':
            require_once 'vista/consultarEmpresas.php';
            break;
        case 'consultarPracticas':
            require_once 'vista/consultarPracticas.php';
            break;
        case 'crearPractica':
            require_once 'vista/crearPractica.php';
            break;
        case 'crearAnexo':
            require_once 'vista/crearAnexo.php';
            break;
        case 'landing':
            require_once 'vista/landingPage.php';
            break;
        case 'editarAlumno':
            require_once 'vista/editarAlumno.php';
            break;
        case 'editarEmpresa':
            require_once 'vista/editarEmpresa.php';
            break;
        case 'consultarCiclo':
            require_once 'vista/consultarCiclo.php';
            break;
        case 'crearCiclo':
            require_once 'vista/crearCiclo.php';
            break;
        case 'crearNecesidad':
            require_once 'vista/crearNecesidad.php';
            break;
        case 'consultarNecesidades':
            require_once 'vista/consultarNecesidad.php';
                break;
        case 'crearNecesidadBolsa':
            require_once 'vista/crearNecesidadBolsa.php';
            break;
        case 'consultarNecesidadBolsa':
            require_once 'vista/consultarNecesidadBolsa.php';
                break;
        case 'crearEmpresaBolsa':
            require_once 'vista/crearEmpresaBolsa.php';
            break;
        case 'consultarEmpresasBolsa':
            require_once 'vista/consultarEmpresaBolsa.php';
            break;

                
        default:
            require_once 'vista/login.php';
            break;
    }
} else {
    require_once 'vista/landingPage.php';
}
