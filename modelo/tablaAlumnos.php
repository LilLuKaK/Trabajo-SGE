<?php
include_once 'conexion.php';

$id_centro_educativo = $_SESSION['id_centro'];

$conn = ConexionBD::conectar();
$stmt = $conn->prepare("SELECT alumnos.*, ciclos_formativos.Nombre_Ciclo FROM alumnos 
    INNER JOIN ciclo_alumno ON alumnos.ID_Alumno = ciclo_alumno.ID_Alumno 
    INNER JOIN ciclos_formativos ON ciclo_alumno.ID_Ciclo_Formativo = ciclos_formativos.ID_Ciclo_Formativo 
    INNER JOIN centro_alumno ON alumnos.ID_Alumno = centro_alumno.ID_Alumno 
    WHERE centro_alumno.ID_Centro_Formativo = ?");
$stmt->execute([$id_centro_educativo]);

if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td class='button-container'>";
        echo "<button class='delete' name='deleteAlumno' data-id='" . $row['ID_Alumno'] . "'><span class='material-symbols-sharp'>delete</span></button>";
        echo "<button class='edit' name='" . $row['ID_Alumno'] . "' id='editaAlumno_" . $row['ID_Alumno'] . "'><span class='material-symbols-sharp'>edit</span></button>";
        echo "<button class='save' style='display: none'><span class='material-symbols-sharp'>save</span></button>";
        echo "<input id='editAlumno_" . $row['ID_Alumno'] . "' type='hidden' value='" . $row['ID_Alumno'] . "'>";
        echo "</td>";
        echo "<td style='font-family: 800; font-size:15px;' >" . $row['ID_Alumno'] . "</td>"; // Hacer editable
        echo "<td><input type='text' value='" . $row['Nombre'] . "' readonly class='compact-input'></td>"; // Hacer editable
        echo "<td><input type='text' value='" . $row['Apellido1'] . "' readonly class='compact-input'></td>"; // Hacer editable
        echo "<td><input type='text' value='" . $row['DNI'] . "' readonly class='compact-input'></td>"; // Hacer editable
        echo "<td><input type='text' value='" . $row['Nombre_Ciclo'] . "' readonly class='compact-input'></td>"; // Hacer editable
        echo "<td><input type='text' value='" . $row['N_Seg_social'] . "' readonly class='compact-input'></td>"; // Hacer editable
        echo "<td><span class='material-symbols-sharp'>download</span></td>";
        echo "<td><input type='text' value='" . ($row['Validez'] == 1 ? 'Sí' : 'No') . "' readonly class='compact-input'></td>"; // Hacer editable
        echo "<td><input type='text' value='" . ($row['Activo'] == 1 ? 'Sí' : 'No') . "' readonly class='compact-input'></td>"; // Hacer editable
        echo "<td><input type='text' value='" . $row['TELF_Alumno'] . "' readonly class='compact-input'></td>"; // Hacer editable
        echo "<td><input type='text' value='" . $row['EMAIL_Alumno'] . "' readonly class='compact-input'></td>"; // Hacer editable
        echo "<td><input type='text' value='" . $row['Direccion'] . "' readonly class='compact-input'></td>"; // Hacer editable
        echo "<td><input type='text' value='" . $row['Codigo_Postal'] . "' readonly class='compact-input'></td>"; // Hacer editable
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='14'>No se encontraron alumnos asociados a este centro educativo.</td></tr>";
}