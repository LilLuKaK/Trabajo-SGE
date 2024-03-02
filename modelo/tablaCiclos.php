<?php
// Incluir el archivo de conexión a la base de datos
include_once 'conexion.php';

$id_centro_educativo = $_SESSION['id_centro'];
// Suponiendo que ya tienes el ID del centro educativo en una variable $id_centro_educativo
// Realiza la consulta para obtener los alumnos del centro educativo y el nombre del ciclo formativo de cada uno
$conn = ConexionBD::conectar();
$stmt = $conn->prepare("SELECT 
                        cf.ID_Ciclo_Formativo,
                        cf.Nombre_Ciclo,
                        (SELECT COUNT(*) 
                        FROM ciclo_alumno ca 
                        JOIN centro_alumno cea ON ca.ID_Alumno = cea.ID_Alumno 
                        WHERE ca.ID_Ciclo_Formativo = cf.ID_Ciclo_Formativo 
                        AND cea.ID_Centro_Formativo = :id_centro) AS Total_Alumnos_Matriculados,
                        (SELECT COUNT(*) 
                        FROM ciclo_alumno ca 
                        JOIN alumnos a ON ca.ID_Alumno = a.ID_Alumno 
                        JOIN centro_alumno cea ON ca.ID_Alumno = cea.ID_Alumno 
                        WHERE a.Activo = 1 
                        AND ca.ID_Ciclo_Formativo = cf.ID_Ciclo_Formativo 
                        AND cea.ID_Centro_Formativo = :id_centro) AS Alumnos_Activos,
                        (SELECT COUNT(*) 
                        FROM ciclo_alumno ca 
                        JOIN alumnos a ON ca.ID_Alumno = a.ID_Alumno 
                        JOIN centro_alumno cea ON ca.ID_Alumno = cea.ID_Alumno 
                        WHERE (a.Activo = 0 OR a.Validez = 0) 
                        AND ca.ID_Ciclo_Formativo = cf.ID_Ciclo_Formativo 
                        AND cea.ID_Centro_Formativo = :id_centro) AS Alumnos_Inactivos
                        FROM 
                            ciclos_formativos cf
                        WHERE
                        EXISTS (SELECT 1 FROM centro_formativo WHERE ID_Centro_Formativo = :id_centro);
                        AND EXISTS (SELECT * FROM alumnos a WHERE a.Fecha_Ultima_Activo >= DATE_SUB(CURDATE(), INTERVAL 2 YEAR))");
$stmt->execute(array(
    ':id_centro' => $id_centro_educativo
));

// Comprueba si se encontraron resultados
if ($stmt->rowCount() > 0) {
    // Itera sobre los resultados y muestra los datos en la tabla
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
            echo "<td style='font-family: 800; font-size:15px;' >" . $row['ID_Ciclo_Formativo'] . "</td>"; // Hacer editable
            echo "<td><input type='text' value='" . $row['Nombre_Ciclo'] . "' readonly class='compact-input'></td>"; // Hacer editable
            echo "<td><input type='text' value='" . $row['Total_Alumnos_Matriculados'] . "' readonly class='compact-input'></td>"; // Hacer editable
            echo "<td><input type='text' value='" . $row['Alumnos_Activos'] . "' readonly class='compact-input'></td>"; // Hacer editable
            echo "<td><input type='text' value='" . $row['Alumnos_Inactivos'] . "' readonly class='compact-input'></td>"; // Hacer editable
        echo "</tr>";
    }
    
    
    
} else {
    // Si no se encontraron alumnos asociados al centro educativo, muestra un mensaje indicando que no hay resultados
    echo "<tr><td colspan='14'>No se encontraron alumnos asociados a este centro educativo.</td></tr>";
}