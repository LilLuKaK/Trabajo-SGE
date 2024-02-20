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

    }else if(isset($_POST["registrarCentro"])){
        // Nos llaman desde el formulario de registrar para que procesemos sus datos
        $nombre = limpiaString($_POST["nombre"]);
        $cif = limpiaString($_POST["cif"]);
        $duenyo = limpiaString($_POST["duenyo"]);
        $direccion = limpiaString($_POST["direccion"]);
        $telefono = limpiaString($_POST["telefono"]);
        $email = limpiaString($_POST["email"]);

        $registroLimpio = array(
            'nombre' => $nombre, 
            'cif' => $cif,
            'duenyo' => $duenyo, 
            'direccion' => $direccion, 
            'telefono' => $telefono, 
            'email' => $email
        );

        // Llama a la función para registrar el centro y obtén la respuesta
        $respuesta = registrarCentro($nombre, $cif, $duenyo, $direccion, $telefono, $email);

        echo $respuesta;

    }else if(isset($_POST["cerrarSesion"])){

        cerrarSesion();
    } 

}