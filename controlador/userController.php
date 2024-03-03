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

    }else if(isset($_POST['buscarAlumno']) && $_POST['buscarAlumno'] == true){
        session_start();
        $parametro1 = limpiaString($_POST['nombre']);
        $parametro2 = $_SESSION['id_centro'];
    
        // Consulta para obtener los datos del alumno y el ciclo formativo asociado
        $consultaAlumno = "SELECT alumnos.*, ciclos_formativos.ID_Ciclo_Formativo, ciclos_formativos.Nombre_Ciclo 
                            FROM alumnos 
                            INNER JOIN ciclo_alumno ON alumnos.ID_Alumno = ciclo_alumno.ID_Alumno 
                            INNER JOIN ciclos_formativos ON ciclo_alumno.ID_Ciclo_Formativo = ciclos_formativos.ID_Ciclo_Formativo 
                            INNER JOIN centro_alumno ON alumnos.ID_Alumno = centro_alumno.ID_Alumno
                            WHERE alumnos.Nombre LIKE :parametro1 AND centro_alumno.ID_Centro_Formativo = :parametro2";
    
        // Llamamos a la función del modelo para obtener los datos del alumno y los ciclos formativos asociados
        $datosAlumno = busquedaGeneral($consultaAlumno, '%'.$parametro1.'%', $parametro2);
    
        if ($datosAlumno === null) {
            // No se encontraron resultados
            echo json_encode(['mensaje' => 'No se encontraron resultados']);
            exit();
        }
    
        // Consulta para obtener todos los ciclos formativos disponibles
        $consultaCiclos = "SELECT * FROM ciclos_formativos";
    
        // Llamamos a la función del modelo para obtener todos los ciclos formativos
        $ciclosFormativos = obtenerCiclosFormativos($consultaCiclos);
    
        // Devolvemos los datos del alumno y los ciclos formativos en un array
        $respuesta = array('datosAlumno' => $datosAlumno, 'ciclosFormativos' => $ciclosFormativos);
    
        // Enviar la respuesta JSON al cliente
        echo json_encode($respuesta);
    
        // Finalizar la ejecución del script PHP para evitar salida adicional
        exit();
    }
    else if(isset($_POST['buscarAlumnoPorDNI']) && $_POST['buscarAlumnoPorDNI'] == true){
        session_start();
        $parametro1 = limpiaString($_POST['dni']);
        $parametro2 = $_SESSION['id_centro'];
    
        // Consulta para obtener los datos del alumno y el ciclo formativo asociado por DNI
        $consultaAlumno = "SELECT alumnos.*, ciclos_formativos.ID_Ciclo_Formativo, ciclos_formativos.Nombre_Ciclo 
                            FROM alumnos 
                            INNER JOIN ciclo_alumno ON alumnos.ID_Alumno = ciclo_alumno.ID_Alumno 
                            INNER JOIN ciclos_formativos ON ciclo_alumno.ID_Ciclo_Formativo = ciclos_formativos.ID_Ciclo_Formativo 
                            INNER JOIN centro_alumno ON alumnos.ID_Alumno = centro_alumno.ID_Alumno
                            WHERE alumnos.DNI = :parametro1 AND centro_alumno.ID_Centro_Formativo = :parametro2";
    
        // Llamamos a la función del modelo para obtener los datos del alumno y los ciclos formativos asociados
        $datosAlumno = busquedaGeneral($consultaAlumno, $parametro1, $parametro2);
    
        if ($datosAlumno === null) {
            // No se encontraron resultados
            echo json_encode(['mensaje' => 'No se encontraron resultados']);
            exit();
        }
    
        // Consulta para obtener todos los ciclos formativos disponibles
        $consultaCiclos = "SELECT * FROM ciclos_formativos";
    
        // Llamamos a la función del modelo para obtener todos los ciclos formativos
        $ciclosFormativos = obtenerCiclosFormativos($consultaCiclos);
    
        // Devolvemos los datos del alumno y los ciclos formativos en un array
        $respuesta = array('datosAlumno' => $datosAlumno, 'ciclosFormativos' => $ciclosFormativos);
    
        // Enviar la respuesta JSON al cliente
        echo json_encode($respuesta);
    
        // Finalizar la ejecución del script PHP para evitar salida adicional
        exit();

    }else if(isset($_POST['searchBoton'])){
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

    }else if ($_POST['idAlumno']) {
        // Obtener el ID del alumno de la solicitud POST
        //  = intval($_POST['editAlumno']);
        
        $alumnoID = $_POST['idAlumno'];
        
        // Llamar a la función para obtener los datos del alumno por ID
        $alumno = obtenerDatosAlumno($alumnoID);
    
        // Verificar si se encontraron los datos del alumno
        if ($alumno) {
            // Devolver los datos del alumno como respuesta JSON
            echo json_encode($alumno);
        } else {
            // Si no se encontraron los datos del alumno, devolver un mensaje de error
            echo json_encode(array('error' => 'No se encontraron datos del alumno con el ID proporcionado.'));
        }
    }elseif (isset($_POST['EditarAlumno'])) {
        // Obtener los datos del formulario
        $id_alumno = $_POST['id_alumno'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $dni = $_POST['dni'];
        $N_Seg_social = $_POST['N_Seg_social'];
        $Curriculum_Vitae = $_POST['Curriculum_Vitae'];
        $activo = $_POST['activo'];
        $validez = $_POST['validez'];
        $TELF_Alumno = $_POST['TELF_Alumno'];
        $EMAIL_Alumno = $_POST['EMAIL_Alumno'];
        $Direccion = $_POST['Direccion'];
        $Codigo_Postal = $_POST['Codigo_Postal'];
        $centro = $_POST['centro'];
        $ciclo = $_POST['ciclo'];
        
        // Llamar a la función en el modelo para actualizar el alumno
        $resultado = actualizarAlumno($id_alumno, $nombre, $apellidos, $dni, $N_Seg_social, $Curriculum_Vitae, $activo, $validez, $TELF_Alumno, $EMAIL_Alumno, $Direccion, $Codigo_Postal, $centro, $ciclo);
    
        // Enviar respuesta JSON al frontend
        echo json_encode($resultado);
    }
       
    
    else if(isset($_POST['parametro'])) {
        $parametro = $_POST['parametro'];
        $valor = isset($_POST['valor']) ? $_POST['valor'] : ''; // Verificar si se proporciona un valor
        $resultados = busquedaEmpresa($parametro, $valor);
        echo $resultados;
        
    }else if(isset($_POST["cerrarSesion"])){

        cerrarSesion();
    } 
    

}