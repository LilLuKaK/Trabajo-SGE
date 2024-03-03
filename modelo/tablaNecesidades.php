<?php
// Incluir el archivo de conexión a la base de datos
include_once 'conexion.php';

$id_centro_educativo = $_SESSION['id_centro'];
// Suponiendo que ya tienes el ID del centro educativo en una variable $id_centro_educativo
// Realiza la consulta para obtener las empresas del centro educativo que tienen convenio
$conn = ConexionBD::conectar();
$stmt = $conn->prepare( "SELECT  ce.*,  SUM(vac.Cantidad)
                                    FROM control_empresas ce
                                    JOIN control_convenios ccon ON ccon.ID_Control_Empresa=ce.ID_Control_Empresa
                                    JOIN anyo_necesidad anyo ON anyo.ID_Convenio = ccon.ID_Convenio
                                    JOIN vacantes vac ON vac.ID_Anyo_Necesidad = anyo.ID_Anyo_Necesidad
                                    WHERE ccon.ID_Centro_Formativo =?
                                    GROUP BY ce.ID_Control_Empresa");
$stmt->execute([$id_centro_educativo]);

// Comprueba si se encontraron resultados
if ($stmt->rowCount() > 0) {
    // Itera sobre los resultados y muestra los datos en la tabla
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>";
        echo "<button class='delete'><span class='material-symbols-sharp'>delete</span></button>";
        echo "<button class='edit'><span class='material-symbols-sharp'>edit</span></button>";
        echo "</td>";
        echo "</td>";
        echo "<td>" . $row['Nombre de la Empresa'] . "</td>";
        echo "<td>" . $row['Número de Vacantes totales'] . "</td>";
        echo "<td>". $row['Número de Vacantes Libres'] . "</td>";
        echo "<td>". $row['Número de Vacantes Cubiertas'] . "</td>";
        echo "<td>" . $row['Año de la solicitud'] . "</td>";
        echo "</tr>";
    }
} else {
    // Si no se encontraron centros asociados al centro educativo, muestra un mensaje indicando que no hay resultados
    echo "<tr><td colspan='14'>No se encontraron alumnos asociados a este centro educativo.</td></tr>";
}