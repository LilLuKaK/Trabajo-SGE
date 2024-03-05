<?php
    // Incluir la conexión y consulta a la base de datos
    include './../conexion.php'; 

 
    session_start();

    // Verificar si se recibió el ID_Control_Empresa
    if(isset($_POST['ID_Control_Empresa'])) {
        $ID_Control_Empresa = $_POST['ID_Control_Empresa'];

        // Conectar a la base de datos ya incluida en 'conexion.php'
        $conn = ConexionBD::conectar();

        // Verificar la conexión
        if ($conn) {
            // Preparar y ejecutar la consulta SQL
            $stmt = $conn->prepare("
                SELECT anyo_necesidad.*, control_empresas.*, control_convenios.*
                FROM anyo_necesidad, control_empresas, control_convenios
                WHERE control_empresas.ID_Control_Empresa = control_convenios.ID_Control_Empresa
                AND control_empresas.ID_Control_Empresa = ?
                AND anyo_necesidad.ID_Convenio = control_convenios.ID_Convenio
                AND control_convenios.ID_Centro_Formativo = ?
            ");
            $stmt->execute([$ID_Control_Empresa, $_SESSION['id_centro']]);

            // Verificar si se encontraron resultados
            if ($stmt->rowCount() > 0) {
                // Almacenar las opciones en un array
                $options = array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $options[] = array('value' => $row['ID_Anyo_Necesidad'], 'label' => $row['Anyo']);
                }
                // Devolver las opciones como JSON
                echo json_encode(['options' => $options]);
                exit(); // Detener la ejecución del script después de enviar las opciones
            } else {
                echo json_encode(['error' => 'No se encontraron necesidades para esta empresa.']);
                exit(); // Detener la ejecución del script después de enviar el mensaje de error
            }
        } else {
            // Manejar el caso en el que la conexión no se haya establecido correctamente
            echo json_encode(['error' => 'No se pudo conectar a la base de datos.']);
            exit(); // Detener la ejecución del script después de enviar el mensaje de error
        }
    }

   // Verificar si se recibió el año de solicitud
   if(isset($_POST['anyo_solicitud'])) {
    $anyo_solicitud = intval($_POST['anyo_solicitud']); // Convertir la cadena a entero

    
    // Conectar a la base de datos ya incluida en 'conexion.php'
    $conn = ConexionBD::conectar();

    // Verificar la conexión
    if ($conn) {
        // Preparar y ejecutar la consulta SQL para obtener los datos de la tabla
        $stmt = $conn->prepare("
            SELECT 
                a.ID_Control_Empresa,
                a.Nombre_Empresa AS 'Nombre de la Empresa', 
                vn.Cantidad AS 'Todas las vacantes disponibles en un mismo año',
                COUNT(vc.ID_Vacantes) AS 'Numero de vacantes cubiertas',
                vn.Cantidad - COUNT(vc.ID_Vacantes) AS 'Vacantes que quedan',
                an.Anyo AS 'Año de solicitud'
            FROM 
                vacantes vn
            JOIN 
                anyo_necesidad an ON vn.ID_Anyo_Necesidad = an.ID_Anyo_Necesidad
            JOIN 
                control_convenios cc ON an.ID_Convenio = cc.ID_Convenio
            JOIN 
                control_empresas ce ON cc.ID_Control_Empresa = ce.ID_Control_Empresa
            JOIN 
                (SELECT ID_Vacantes, ID_Ciclo_Formativo FROM vacantes_ciclo) vc ON vn.ID_Vacantes = vc.ID_Vacantes
            JOIN 
                (SELECT ID_Control_Empresa, Nombre_Empresa FROM control_empresas) a ON ce.ID_Control_Empresa = a.ID_Control_Empresa
            WHERE 
                an.Anyo = ?
            GROUP BY 
                a.Nombre_Empresa, an.Anyo;
        ");
        $stmt->execute([$anyo_solicitud]);

        // Verificar si se encontraron resultados
        if ($stmt->rowCount() > 0) {
            // Almacenar los resultados en un array
            $results = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $results[] = $row;
            }
            // Devolver los resultados como JSON
            echo json_encode(['results' => $results]);
            exit(); // Detener la ejecución del script después de enviar los resultados
        } else {
            echo json_encode(['error' => 'No se encontraron necesidades para el año seleccionado.']);
            exit(); // Detener la ejecución del script después de enviar el mensaje de error
        }
    } else {
        // Manejar el caso en el que la conexión no se haya establecido correctamente
        echo json_encode(['error' => 'No se pudo conectar a la base de datos.']);
        exit(); // Detener la ejecución del script después de enviar el mensaje de error
    }
}

// Si ninguna variable fue recibida, devolver un mensaje de error
echo json_encode(['error' => 'No se recibió ninguna variable.']);

?>
