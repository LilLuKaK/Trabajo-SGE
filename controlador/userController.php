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

    }else if(isset($_POST["registrarTutor"])){
        // Nos llaman desde el formulario de registrar para que procesemos sus datos
        $nombre = limpiaString($_POST["nombre"]);
        $apellidos = limpiaString($_POST["apellidos"]);
        $email = limpiaString($_POST["email"]);
        $clave = limpiaString($_POST["clave"]);
        $id_centro_educativo = limpiaString($_POST["centro"]);

        $registroLimpio = array(
            'nombre' => $nombre, 
            'apellidos' => $apellidos,
            'email' => $email,
            'clave' => $clave
        );

        // Llama a la función para registrar el centro y obtén la respuesta
        $respuesta = registrarTutor($nombre, $apellidos, $email, $clave, $id_centro_educativo);

        echo $respuesta;

    }else if(isset($_POST["registrarAlumno"])){
        // Obtener los datos del formulario
        $nombre = limpiaString($_POST["nombre"]);
        $apellidos = limpiaString($_POST["apellidos"]);
        $dni = limpiaString($_POST["dni"]);
        $N_Seg_social = limpiaString($_POST["N_Seg_social"]);
        $Curriculum_Vitae = limpiaString($_POST["Curriculum_Vitae"]);
        $TELF_Alumno = limpiaString($_POST["TELF_Alumno"]);
        $EMAIL_Alumno = limpiaString($_POST["EMAIL_Alumno"]);
        $Direccion = limpiaString($_POST["Direccion"]);
        $Codigo_Postal = limpiaString($_POST["Codigo_Postal"]);
        $id_ciclo_formativo = limpiaString($_POST["ciclo"]);
        $activo = $_POST["activo"]; // Obtener el valor del radio button de activo
        $validez = $_POST["validez"]; // Obtener el valor del radio button de validez
    
        // Llama a la función para registrar el alumno
        $respuesta = registrarAlumno($nombre, $apellidos, $dni, $N_Seg_social, $Curriculum_Vitae, $TELF_Alumno, $EMAIL_Alumno, $Direccion, $Codigo_Postal, $id_ciclo_formativo, $activo, $validez);
    
        echo $respuesta;

    }else if(isset($_POST["cerrarSesion"])){

        cerrarSesion();
    } 

}