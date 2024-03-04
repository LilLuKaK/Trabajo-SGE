<?php
    // Incluir la conexión y consulta a la base de datos
    include './conexion.php';

    // Realizar la consulta para obtener los nombres de las empresas
   
    session_start();

    //Hay dos opciones para esto una que recoge más valores:
    //Necesito recoger ID_CentroFormativo, ID_Empresa (o en su defecto nombre empresa), ID_Vacantes (Correspondinete a ese anexo seleccionado)
    $id_centro_educativo = $_SESSION['id_centro'];


    if ($conn) {
        $stmt = $conn->prepare("
        SELECT vacantes.cuadrante
        FROM anyo_necesidad, control_empresas,control_convenios,vacantes
        WHERE control_empresas.ID_Control_Empresa=control_convenios.ID_Control_Empresa
        AND control_empresas.ID_Control_Empresa=?
        AND anyo_necesidad.ID_Convenio=control_convenios.ID_Convenio
        AND vacantes.ID_Anyo_Necesidad=anyo_necesidad.ID_Anyo_Necesidad
        AND control_convenios.ID_Centro_Formativo =?
        AND anyo_necesidad.Anyo=?
        GROUP by vacantes.Cuadrante
       
        ");
        $stmt->execute([$id_centro_educativo]);
        // Verificar si se encontraron resultados
        if ($stmt->rowCount() > 0) {
            // Iterar sobre los resultados y mostrar las opciones del select
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $row['Cuadrante'] . "'>" . $row['Cuadrante'] . "</option>";
            }
        } else {
            echo "<option value='' disabled>No se encontraron Empresas.</option>";
        }
    } else {
        // Manejar el caso en el que la conexión no se haya establecido correctamente
        echo "Error: No se pudo conectar a la base de datos.";
    }                                 
    
    
    //Otra que recoge menos valores, pero que necesita que esté cargada y seleccionada la Vacante concreta que se quiera llenar
 /*   
    if ($conn) {
        $stmt = $conn->prepare("
        SELECT vacantes.Cuadrante
        FROM vacantes
       WHERE ID_Vacante=?
       
        ");
        $stmt->execute([$id_centro_educativo]);
        // Verificar si se encontraron resultados
        if ($stmt->rowCount() > 0) {
            // Iterar sobre los resultados y mostrar las opciones del select
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $row['Cuadrante'] . "'>" . $row['Cuadrante'] . "</option>";
            }
        } else {
            echo "<option value='' disabled>No se encontraron Empresas.</option>";
        }
    } else {
        // Manejar el caso en el que la conexión no se haya establecido correctamente
        echo "Error: No se pudo conectar a la base de datos.";
    }   */