<?php

require 'conexion.php';

function logearUsuario($email, $clave) {
    $conn = ConexionBD::conectar();

    if ($conn) {
        // Consulta a la base de datos para obtener el usuario por su email
        $stmt = $conn->prepare("SELECT usuario.*, notas.Media_Aritmetica AS clave, centro_formativo.ID_Centro_Formativo AS id_centro, centro_formativo.Nombre AS nombre_centro FROM usuario INNER JOIN notas ON usuario.ID_Usuario = notas.ID_Usuario INNER JOIN usuario_centro ON usuario.ID_Usuario = usuario_centro.ID_Usuario INNER JOIN centro_formativo ON usuario_centro.ID_Centro_Formativo = centro_formativo.ID_Centro_Formativo WHERE usuario.EMAIL_Usuario = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch();

        if ($usuario) {
            // Verifica si la contraseña pertenece a ese usuario
            if (password_verify($clave, $usuario['clave'])) {
                session_start();
                $_SESSION['nombre'] = $usuario['Nombre'];
                $_SESSION['email'] = $usuario['EMAIL_Usuario'];
                $_SESSION['nombre_centro'] = $usuario['nombre_centro']; // Guardar el nombre del centro en la sesión
                $_SESSION['id_centro'] = $usuario['id_centro']; // Guardar el ID del centro en la sesión

                // Devolver todos los datos del usuario
                return json_encode(array(
                    'success' => 'Inicio de sesión exitoso.',
                    'nombre' => $usuario['Nombre'],
                    'apellido1' => $usuario['Apellido1'],
                    'email' => $usuario['EMAIL_Usuario'],
                    'nombre_centro' => $usuario['nombre_centro'] // Incluir el nombre del centro en la respuesta
                ));
            // Si la contraseña está incorrecta
            } else {
                return json_encode(array('error' => 'Contraseña incorrecta.'));
            }
        // Si no se reconoce que el email esté registrado en la base de datos
        } else {
            return json_encode(array('error' => 'Correo desconocido.'));
        }
    }

    return json_encode(array('error' => 'Error de conexión a la base de datos.'));
}

function registrarTutor($nombre, $apellidos, $email, $clave, $id_centro_formativo) {
    $conn = ConexionBD::conectar();

    // Si la conexión a la base de datos es correcta
    if ($conn) {
        $stmt = $conn->prepare("SELECT EMAIL_Usuario FROM usuario WHERE EMAIL_Usuario = ?");
        $stmt->execute([$email]);
        $existeCorreo = $stmt->fetch();
        
        // Si el correo está registrado en la base de datos
        if ($existeCorreo) {
            return json_encode(array('error' => 'El correo ya está registrado.'));
        } else {
            // Insertar el usuario en la tabla usuario
            $stmt = $conn->prepare("INSERT INTO usuario (Nombre, Apellido1, Rol, EMAIL_Usuario) VALUES (?, ?, 'TUTOR', ?)");
            $stmt->execute([$nombre, $apellidos, $email]);
            $id_usuario = $conn->lastInsertId(); // Obtener el ID del usuario recién insertado

            // Insertar la nota del usuario en la tabla notas
            $hashed_clave = password_hash($clave, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO notas (ID_Usuario, Media_Aritmetica) VALUES (?, ?)");
            $stmt->execute([$id_usuario, $hashed_clave]);

            // Insertar la relación entre el usuario y el centro formativo en la tabla usuario_centro
            $stmt = $conn->prepare("INSERT INTO usuario_centro (ID_Usuario, ID_Centro_Formativo) VALUES (?, ?)");
            $stmt->execute([$id_usuario, $id_centro_formativo]);
    
            return json_encode(array('success' => 'Usuario registrado con éxito.'));
        }
    }

    return json_encode(array('error' => 'Error de conexión a la base de datos.'));
}

function registrarCentro($nombre, $cif, $duenyo, $direccion, $telefono, $email) {
    $conn = ConexionBD::conectar();

    // Si a conexion a la base de datos es correcta
    if ($conn) {
        $stmt = $conn->prepare("SELECT Nombre FROM centro_formativo WHERE Nombre = ?");
        $stmt->execute([$nombre]);
        $existeCentro = $stmt->fetch();
        
        // Si el Centro esta registrado en la base de datos
        if ($existeCentro) {
            return json_encode(array('error' => 'El centro ya está registrado.'));

        // Si el centro no existe en la base de datos
        }else{
            $stmt = $conn->prepare("INSERT INTO centro_formativo (Nombre, CIF, DUENYO, Direccion, Telefono, EMAIL) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$nombre, $cif, $duenyo, $direccion, $telefono, $email]);
    
            return json_encode(array('success' => 'Centro registrado con éxito.'));
        }
    }

    return json_encode(array('error' => 'Error de conexión a la base de datos.'));
}

function registrarAlumno($nombre, $apellidos, $dni, $N_Seg_social, $Curriculum_Vitae, $TELF_Alumno, $EMAIL_Alumno, $Direccion, $Codigo_Postal, $id_centro_educativo, $id_ciclo_formativo, $activo, $validez) {
    $conn = ConexionBD::conectar();

    if ($conn) {
        // Obtener la fecha actual en formato YYYY-MM-DD
        $fecha_actual = date('Y-m-d');

        // Insertar el alumno en la tabla alumnos
        $stmt = $conn->prepare("INSERT INTO alumnos (Nombre, Apellido1, DNI, N_Seg_social, Curriculum_Vitae, TELF_Alumno, EMAIL_Alumno, Direccion, Codigo_Postal, Activo, Validez, Fecha_Ultima_Activo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nombre, $apellidos, $dni, $N_Seg_social, $Curriculum_Vitae, $TELF_Alumno, $EMAIL_Alumno, $Direccion, $Codigo_Postal, $activo, $validez, $fecha_actual]);
        $id_alumno = $conn->lastInsertId(); // Obtener el ID del alumno recién insertado

        // Insertar la asociación entre el alumno y el ciclo formativo en la tabla ciclo_alumno
        $stmt = $conn->prepare("INSERT INTO ciclo_alumno (ID_Ciclo_Formativo, ID_Alumno) VALUES (?, ?)");
        $stmt->execute([$id_ciclo_formativo, $id_alumno]);

        // Insertar la asociación entre el alumno y el centro educativo en la tabla centro_alumno
        $stmt = $conn->prepare("INSERT INTO centro_alumno (ID_Centro_Formativo, ID_Alumno) VALUES (?, ?)");
        $stmt->execute([$id_centro_educativo, $id_alumno]);

        return json_encode(array('success' => 'Alumno registrado con éxito.'));
    }

    return json_encode(array('error' => 'Error de conexión a la base de datos.'));
}

function registrarCiclo($nombreCiclo) {
    $conn = ConexionBD::conectar();

    if ($conn) {
        // Insertar el alumno en la tabla alumnos
        $stmt = $conn->prepare("INSERT INTO ciclos_formativos (Nombre_Ciclo) VALUES (?)");
        $stmt->execute([$nombreCiclo]);

        return json_encode(array('success' => 'Ciclo registrado con éxito.'));
    }

    return json_encode(array('error' => 'Error de conexión a la base de datos.'));
}

/********************* Filtros de Busqueda ************************* */

function busquedaGeneral($consulta, $parametro1, $parametro2){
    $conn = ConexionBD::conectar();
    if($conn){
        $stmt = $conn->prepare($consulta);
        $stmt->execute(array(
            ':parametro1' => $parametro1,
            ':parametro2' => $parametro2
        ));

        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return json_encode($resultado);
    }else{
        return json_encode(array('success' => 'No se encontraron resultados'));
    }
}


/********************* Editar Borrar ************************* */

function actualizarAlumno($id_alumno, $nombre, $apellidos, $dni, $N_Seg_social, $Curriculum_Vitae, $TELF_Alumno, $EMAIL_Alumno, $Direccion, $Codigo_Postal, $id_centro_educativo, $id_ciclo_formativo, $activo, $validez) {
    $conn = ConexionBD::conectar();

    if ($conn) {
        // Actualizar el alumno en la tabla alumnos
        $stmt = $conn->prepare("UPDATE alumnos SET Nombre=?, Apellido1=?, DNI=?, N_Seg_social=?, Curriculum_Vitae=?, TELF_Alumno=?, EMAIL_Alumno=?, Direccion=?, Codigo_Postal=?, Activo=?, Validez=? WHERE ID_Alumno=?");
        $stmt->execute([$nombre, $apellidos, $dni, $N_Seg_social, $Curriculum_Vitae, $TELF_Alumno, $EMAIL_Alumno, $Direccion, $Codigo_Postal, $activo, $validez, $id_alumno]);

        // Actualizar la asociación entre el alumno y el ciclo formativo en la tabla ciclo_alumno
        $stmt = $conn->prepare("UPDATE ciclo_alumno SET ID_Ciclo_Formativo=? WHERE ID_Alumno=?");
        $stmt->execute([$id_ciclo_formativo, $id_alumno]);

        // Actualizar la asociación entre el alumno y el centro educativo en la tabla centro_alumno
        $stmt = $conn->prepare("UPDATE centro_alumno SET ID_Centro_Formativo=? WHERE ID_Alumno=?");
        $stmt->execute([$id_centro_educativo, $id_alumno]);

        return json_encode(array('success' => 'Alumno actualizado con éxito.'));
    }

    return json_encode(array('error' => 'Error de conexión a la base de datos.'));
}




function cerrarSesion() {
    session_start();
    session_unset();
    session_destroy();
    echo json_encode(array('success' => true));
    exit();
}

function limpiaString($cadena){
    $string = preg_replace(['/\s+/','/^\s|\s$/'], [' ', ''], $cadena);
    $string = trim($string);
    $string = stripslashes($string);
    $string = str_ireplace("<script>", "", $string);
    $string = str_ireplace("</script>", "", $string);
    $string = str_ireplace("<script src>", "", $string);
    $string = str_ireplace("<script type =>", "", $string);
    $string = str_ireplace("SELECT * FROM", "", $string);
    $string = str_ireplace("DELETE FROM", "", $string);
    $string = str_ireplace("INSERT INTO", "", $string);
    $string = str_ireplace("SELECT COUNT(*) FROM", "", $string);
    $string = str_ireplace("DROP TABLE", "", $string);
    $string = str_ireplace("OR '1'='1", "", $string);
    $string = str_ireplace('OR "1"="1"', "", $string);
    $string = str_ireplace('OR ´1´=´1´', "", $string);
    $string = str_ireplace('is NULL; --', "", $string);
    $string = str_ireplace('LIKE "', "", $string);
    $string = str_ireplace("LIKE '", "", $string);
    $string = str_ireplace("LIKE ´", "", $string);
    $string = str_ireplace("OR 'a'='a", "", $string);
    $string = str_ireplace('OR "a"="a"', "", $string);
    $string = str_ireplace("OR ´a´=´a", "", $string);
    $string = str_ireplace("OR ´a´=´a´", "", $string);
    $string = str_ireplace("--", "", $string);
    $string = str_ireplace("^", "", $string);
    $string = str_ireplace("[", "", $string);
    $string = str_ireplace("]", "", $string);
    $string = str_ireplace("==", "", $string);
    return $string;
}