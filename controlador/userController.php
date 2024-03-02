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
        $id_centro_educativo = limpiaString($_POST["centro"]); // Obtener el ID del centro educativo seleccionado
        $id_ciclo_formativo = limpiaString($_POST["ciclo"]);
        $activo = $_POST["activo"]; // Obtener el valor del radio button de activo
        $validez = $_POST["validez"]; // Obtener el valor del radio button de validez
    
        // Llama a la función para registrar el alumno
        $respuesta = registrarAlumno($nombre, $apellidos, $dni, $N_Seg_social, $Curriculum_Vitae, $TELF_Alumno, $EMAIL_Alumno, $Direccion, $Codigo_Postal, $id_centro_educativo, $id_ciclo_formativo, $activo, $validez);
    
        echo $respuesta;

    }else if(isset($_POST["registrarCiclo"])){
        // Nos llaman desde el formulario de registrar para que procesemos sus datos
        $nombreCiclo = limpiaString($_POST["nombreCiclo"]);

        $registroLimpio = array(
            'nombreCiclo' => $nombreCiclo
        );

        // Llama a la función para registrar el centro y obtén la respuesta
        $respuesta = registrarCiclo($nombreCiclo);

        echo $respuesta;

    }else if(isset($_POST["registrarEmpresa"])){
        // Nos llaman desde el formulario de registrar para que procesemos sus datos
        $nombre = limpiaString($_POST["nombre"]);
        $cif = limpiaString($_POST["cif"]);
        $duenyo = limpiaString($_POST["duenyo"]);
        $firmante = limpiaString($_POST["firmante"]);
        $direccion = limpiaString($_POST["direccion"]);
        $email = limpiaString($_POST["email"]);
        $telefono = limpiaString($_POST["telefono"]);

        $registroLimpio = array(
            'nombre' => $nombre, 
            'cif' => $cif,
            'duenyo' => $duenyo,
            'firmante' => $firmante,
            'direccion' => $direccion,
            'email' => $email,
            'telefono' => $telefono
        );

        // Llama a la función para registrar el centro y obtén la respuesta
        $respuesta = registrarEmpresa($nombre, $cif, $duenyo, $firmante, $direccion, $email, $telefono);

        echo $respuesta;

    }else if(isset($_POST['buscarAlumno']) && $_POST['buscarAlumno'] == true){
        session_start();
        $parametro1 = limpiaString($_POST['nombre']);
        $parametro2 = $_SESSION['id_centro'];
        $consulta = "SELECT a.*, cf.Nombre_Ciclo FROM alumnos a INNER JOIN ciclo_alumno ca ON a.ID_Alumno = ca.ID_Alumno INNER JOIN ciclos_formativos cf ON ca.ID_Ciclo_Formativo = cf.ID_Ciclo_Formativo INNER JOIN centro_alumno cen_al ON a.ID_Alumno = cen_al.ID_Alumno WHERE a.Nombre LIKE :parametro1 AND cen_al.ID_Centro_Formativo = :parametro2";
        $respuesta = busquedaGeneral($consulta, '%'.$parametro1.'%', $parametro2);
        echo $respuesta;

    }elseif(isset($_POST['buscarDni']) && $_POST['buscarDni'] == true){
        session_start();
        $parametro1 = limpiaString($_POST['dni']);
        $parametro2 = $_SESSION['id_centro'];
        $consulta = "SELECT a.*, cf.Nombre_Ciclo FROM alumnos a INNER JOIN ciclo_alumno ca ON a.ID_Alumno = ca.ID_Alumno INNER JOIN ciclos_formativos cf ON ca.ID_Ciclo_Formativo = cf.ID_Ciclo_Formativo INNER JOIN centro_alumno cen_al ON a.ID_Alumno = cen_al.ID_Alumno WHERE a.DNI LIKE :parametro1 AND cen_al.ID_Centro_Formativo = :parametro2";
        $respuesta = busquedaGeneral($consulta, '%'.$parametro1.'%', $parametro2);
        echo $respuesta;

    }elseif(isset($_POST['searchBoton'])){
        session_start();
        $parametro1 = $_POST['searchBoton'];
        $parametro2 = $_SESSION['id_centro'];
        $consulta = "SELECT a.*, cf.Nombre_Ciclo FROM alumnos a INNER JOIN ciclo_alumno ca ON a.ID_Alumno = ca.ID_Alumno INNER JOIN ciclos_formativos cf ON ca.ID_Ciclo_Formativo = cf.ID_Ciclo_Formativo INNER JOIN centro_alumno cen_al ON a.ID_Alumno = cen_al.ID_Alumno WHERE a.Validez = :parametro1 AND cen_al.ID_Centro_Formativo = :parametro2";
        $respuesta = busquedaGeneral($consulta, $parametro1, $parametro2);
        echo $respuesta;

    }elseif(isset($_POST['buscarFP'])){
        session_start();
        $parametro1 = limpiaString($_POST['ciclo']);
        $parametro2 = $_SESSION['id_centro'];
        $consulta = "SELECT a.*, cf.Nombre_Ciclo FROM alumnos a INNER JOIN ciclo_alumno ca ON a.ID_Alumno = ca.ID_Alumno INNER JOIN ciclos_formativos cf ON ca.ID_Ciclo_Formativo = cf.ID_Ciclo_Formativo INNER JOIN centro_alumno cen_al ON a.ID_Alumno = cen_al.ID_Alumno WHERE cf.Nombre_Ciclo = :parametro1 AND cen_al.ID_Centro_Formativo = :parametro2";
        $respuesta = busquedaGeneral($consulta, $parametro1, $parametro2);
        echo $respuesta;

    }elseif(isset($_POST['buscarCiclo'])){
        session_start();
        $parametro1 = limpiaString($_POST['ciclo']);
        $parametro2 = $_SESSION['id_centro'];
        $consulta = "SELECT cf.ID_Ciclo_Formativo, cf.Nombre_Ciclo, (SELECT COUNT(*) FROM ciclo_alumno ca JOIN centro_alumno cea ON ca.ID_Alumno = cea.ID_Alumno WHERE ca.ID_Ciclo_Formativo = cf.ID_Ciclo_Formativo AND cea.ID_Centro_Formativo = :parametro2) AS Total_Alumnos_Matriculados, (SELECT COUNT(*) FROM ciclo_alumno ca JOIN alumnos a ON ca.ID_Alumno = a.ID_Alumno JOIN centro_alumno cea ON ca.ID_Alumno = cea.ID_Alumno WHERE a.Activo = 1 AND ca.ID_Ciclo_Formativo = cf.ID_Ciclo_Formativo AND cea.ID_Centro_Formativo = :parametro2) AS Alumnos_Activos, (SELECT COUNT(*) FROM ciclo_alumno ca JOIN alumnos a ON ca.ID_Alumno = a.ID_Alumno JOIN centro_alumno cea ON ca.ID_Alumno = cea.ID_Alumno WHERE (a.Activo = 0 OR a.Validez = 0) AND ca.ID_Ciclo_Formativo = cf.ID_Ciclo_Formativo AND cea.ID_Centro_Formativo = :parametro2) AS Alumnos_Inactivos FROM ciclos_formativos cf WHERE EXISTS (SELECT 1 FROM centro_formativo WHERE ID_Centro_Formativo = :parametro2) AND cf.Nombre_Ciclo LIKE :parametro1 AND EXISTS (SELECT * FROM alumnos a WHERE a.Fecha_Ultima_Activo >= DATE_SUB(CURDATE(), INTERVAL 2 YEAR))";
        $respuesta = busquedaGeneral($consulta, '%'.$parametro1.'%', $parametro2);
        echo $respuesta;

    }else if(isset($_POST["editarAlumno"])){
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
        $id_centro_educativo = limpiaString($_POST["centro"]); // Obtener el ID del centro educativo seleccionado
        $id_ciclo_formativo = limpiaString($_POST["ciclo"]);
        $activo = $_POST["activo"]; // Obtener el valor del radio button de activo
        $validez = $_POST["validez"]; // Obtener el valor del radio button de validez

        $id_Alumno = $_POST['id'];
    
        // Llama a la función para registrar el alumno
        $respuesta = actualizarAlumno($id_Alumno,$nombre, $apellidos, $dni, $N_Seg_social, $Curriculum_Vitae, $TELF_Alumno, $EMAIL_Alumno, $Direccion, $Codigo_Postal, $id_centro_educativo, $id_ciclo_formativo, $activo, $validez);
    
        echo $respuesta;

    }
    else if(isset($_POST["cerrarSesion"])){

        cerrarSesion();
    } 
    

}