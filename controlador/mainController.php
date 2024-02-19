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
