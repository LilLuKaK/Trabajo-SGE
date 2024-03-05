<?php
    // Incluir la conexión y consulta a la base de datos
    include './conexion.php';

    // Realizar la consulta para obtener los nombres de las empresas
   

    //Necesita:
        //ID_Empresa de origen
        //ID_Centro Formativo
        //en caso de conseguir la empresa origen, agregar esta línea al espacio en blanco:
            //  AND control_empresas.ID_Control_Empresa=?

    session_start();
    $id_centro_educativo = $_SESSION['id_centro'];
    var_dump($id_centro_educativo);
    if ($conn) {
        $stmt = $conn->prepare("
        SELECT anyo_necesidad.*,control_empresas.*,control_convenios.*
        FROM anyo_necesidad, control_empresas,control_convenios
        WHERE control_empresas.ID_Control_Empresa=control_convenios.ID_Control_Empresa
      


        AND anyo_necesidad.ID_Convenio=control_convenios.ID_Convenio
        AND control_convenios.ID_Centro_Formativo =?
        ORDER BY anyo_necesidad.Anyo
        DESC
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