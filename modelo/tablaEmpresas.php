<?php
// Incluir el archivo de conexión a la base de datos
include_once 'conexion.php';

$id_centro_educativo = $_SESSION['id_centro'];
// Suponiendo que ya tienes el ID del centro educativo en una variable $id_centro_educativo
// Realiza la consulta para obtener las empresas del centro educativo que tienen convenio
$conn = ConexionBD::conectar();
$stmt = $conn->prepare( "SELECT  DISTINCT(ce.Nombre_Empresa), ce.*, cea.*
                FROM control_empresas ce
                JOIN contacto_empresa cea ON cea.ID_Control_Empresa = ce.ID_Control_Empresa
                JOIN control_convenios ccon ON ce.ID_Control_Empresa = ccon.ID_Control_Empresa
                WHERE ccon.ID_Centro_Formativo = ?");
$stmt->execute([$id_centro_educativo]);

// Comprueba si se encontraron resultados
if ($stmt->rowCount() > 0) {
    // Itera sobre los resultados y muestra los datos en la tabla
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>";
        echo "<button class='delete'><span class='material-symbols-sharp'>delete</span></button>";
        echo "<button class='edit' name='" . $row['ID_Control_Empresa'] . "' id='editEmpresaButton_" . $row['ID_Control_Empresa'] . "'><span class='material-symbols-sharp'>edit</span></button>";
        echo "<input id='editEmpresaInput_" . $row['ID_Control_Empresa'] . "' name='editaEmpresa' type='hidden' value='" . $row['ID_Control_Empresa'] . "'>";
        echo "</td>";
        echo "<td>" . $row['ID_Control_Empresa'] . "</td>";
        echo "<td>" . $row['Nombre_Empresa'] . "</td>";
        echo "<td>" . $row['CIF'] . "</td>";
        echo "<td>" . $row['Duenyo'] . "</td>";
        echo "<td>" . $row['Firmante_Convenio'] . "</td>"; // Nombre del ciclo formativo
        echo "<td>" . $row['Direccion'] . "</td>";
        echo "<td>" . $row['EMAIL_Empresa'] . "</td>";
        echo "<td>" . $row['TELF_Empresa'] . "</td>";
        echo "<td>" . $row['Nombre_Contacto'] . "</td>";
        echo "<td>" . $row['EMAIL_Contacto_Empresa'] . "</td>";
        echo "<td>" . $row['TELF_Contacto_Empresa'] . "</td>";
        echo "</tr>";
    }
    
} else {
    // Si no se encontraron centros asociados al centro educativo, muestra un mensaje indicando que no hay resultados
    echo "<tr><td colspan='14'>No se encontraron alumnos asociados a este centro educativo.</td></tr>";
}