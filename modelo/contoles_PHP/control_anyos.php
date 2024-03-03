<?php
    // Incluir la conexión y consulta a la base de datos
    include './conexion.php';

    // Realizar la consulta para obtener los nombres de las empresas
   
    session_start();
    $id_centro_educativo = $_SESSION['id_centro'];
    if ($conn) {
        $stmt = $conn->prepare("
        SELECT anyo_necesidad.*
                FROM anyo_necesidad, convenios_anyo,control_convenios
                WHERE control_convenios.ID_Convenio=convenios_anyo.ID_Convenio 
                AND control_convenios.ID_Centro_Formativo = ?
                GROUP BY anyo_necesidad.Anyo
        ");
        $stmt->execute([$id_centro_educativo]);
        // Verificar si se encontraron resultados
        if ($stmt->rowCount() > 0) {
            // Iterar sobre los resultados y mostrar las opciones del select
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $row['ID_Anyo_Necesidad'] . "'>" . $row['Anyo'] . "</option>";
            }
        } else {
            echo "<option value='' disabled>No se encontraron Empresas.</option>";
        }
    } else {
        // Manejar el caso en el que la conexión no se haya establecido correctamente
        echo "Error: No se pudo conectar a la base de datos.";
    }                                 