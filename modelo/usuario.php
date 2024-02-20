<?php

require 'conexion.php';

function logearUsuario($email, $clave) {
    $conn = ConexionBD::conectar();

    if ($conn) {
        // Consulta a la base de datos
        $stmt = $conn->prepare("SELECT * FROM usuario WHERE EMAIL_Usuario = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch();

        if ($usuario) {
            // Verifica si la contraseña pertenece a ese mail
            if (password_verify($clave, $usuario['clave'])) {
                session_start();
                $_SESSION['nombre'] = $usuario['Nombre'];
                $_SESSION['email'] = $usuario['EMAIL_Usuario'];

                // Devolver todos los datos del usuario
                return json_encode(array(
                    'success' => 'Inicio de sesion exitoso.',
                    'nombre' => $usuario['Nombre'],
                    'apellido1' => $usuario['Apellido1'],
                    'apellido2' => $usuario['Apellido2'],
                    'email' => $usuario['EMAIL_Usuario']
                ));
            // Si la contraseña esta incorrecta
            } else {
                return json_encode(array('error' => 'Contraseña incorrecta.'));
            }
        // Si no se reconoce que el email este registrado en la base de datos
        } else {
            return json_encode(array('error' => 'Correo desconocido.'));
        }
    }

    return json_encode(array('error' => 'Error de conexión a la base de datos.'));
}

function registrarUsuario($nombre, $apellidos, $direccion, $email, $telefono, $cpostal, $clave) {
    $conn = ConexionBD::conectar();

    // Si a conexion a la base de datos es correcta
    if ($conn) {
        $stmt = $conn->prepare("SELECT email_cuenta FROM cuentas WHERE email_cuenta = ?");
        $stmt->execute([$email]);
        $existeCorreo = $stmt->fetch();
        
        // Si el correo esta registrado en la base de datos
        if ($existeCorreo) {
            return json_encode(array('error' => 'El correo ya está registrado.'));

        // Si el correo no existe en la base de datos
        }else{
            $stmt = $conn->prepare("INSERT INTO cuentas (nombre_cuenta, apellidos_cuenta, direccion_cuenta, email_cuenta, telefono_cuenta, cpostal_cuenta, clave_cuenta, rol_cuenta) VALUES (?, ?, ?, ?, ?, ?, ?, 'user')");
            $stmt->execute([$nombre, $apellidos, $direccion, $email, $telefono, $cpostal, password_hash($clave, PASSWORD_DEFAULT)]);
    
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