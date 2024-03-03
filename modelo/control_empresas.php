<?php
    // Incluir la conexión y consulta a la base de datos
    include './modelo/conexion.php';

    // Realizar la consulta para obtener los nombres de las empresas
    $conn = ConexionBD::conectar();
    $id_centro_educativo = $_SESSION['id_centro'];
    if ($conn) {
        $stmt = $conn->prepare("SELECT control_empresas.* FROM control_empresas, control_convenios WHERE control_convenios.ID_Centro_Formativo = ? GROUP BY control_empresas.ID_Control_Empresa");
        $stmt->execute([$id_centro_educativo]);
        // Verificar si se encontraron resultados
        if ($stmt->rowCount() > 0) {
            // Iterar sobre los resultados y mostrar las opciones del select
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $row['Nombre_Empresa'] . "'>" . $row['Nombre_Empresa'] . "</option>";
            }
        } else {
            echo "<option value='' disabled>No se encontraron Empresas.</option>";
        }
    } else {
        // Manejar el caso en el que la conexión no se haya establecido correctamente
        echo "Error: No se pudo conectar a la base de datos.";
    }                                 