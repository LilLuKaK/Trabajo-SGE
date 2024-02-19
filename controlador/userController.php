<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include('./../modelo/user.php');

    if(isset($_POST["registrar"])){
        // Nos llaman desde el formulario de registrar para que procesemos sus datos
        $nombre = limpiaString($_POST["nombre"]);
        $apellidos = limpiaString($_POST["apellidos"]);
        $direccion = limpiaString($_POST["direccion"]);
        $email = limpiaString($_POST["email"]);
        $telefono = limpiaString($_POST["telefono"]);
        $cpostal = limpiaString($_POST["cpostal"]);
        $clave = limpiaString($_POST["clave"]);

        $registroLimpio = array(
            'nombre' => $nombre, 
            'apellido' => $apellidos,
            'direccion' => $direccion, 
            'email' => $email, 
            'telefono' => $telefono, 
            'cpostal' => $cpostal, 
            'clave' => $clave
        );

        // Llama a la función para registrar el usuario y obtén la respuesta
        $respuesta = registrarUsuario($nombre, $apellidos, $direccion, $email, $telefono, $cpostal, $clave);

        echo $respuesta;

    }else if(isset($_POST["login"])){
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