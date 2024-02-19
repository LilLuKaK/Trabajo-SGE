<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include('./../modelo/usuario.php');

    if(isset($_POST["login"])){
        // Nos llaman desde el formulario de login para que procesemos sus datos
        $email = limpiaString($_POST["email"]);
        $clave = limpiaString($_POST["clave"]);

        // Llama a la función para logear al usuario y obtén la respuesta
        $respuesta = logearUsuario($email, $clave);

        // Devuelve la respuesta directamente
        echo $respuesta;

    }else if(isset($_POST["cerrarSesion"])){

        cerrarSesion();
    } 

}