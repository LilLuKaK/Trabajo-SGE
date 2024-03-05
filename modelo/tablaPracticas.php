<?php
include_once 'conexion.php';

$id_centro_educativo = $_SESSION['id_centro'];

$conn = ConexionBD::conectar();
$stmt = $conn->prepare("SELECT 
                        a.Nombre AS Nombre_Alumno,
                        CONCAT(a.Apellido1, ' ', a.Apellido2) AS Apellidos_Alumno,
                        a.Curriculum_Vitae AS CV,
                        cp.Tutor_CFP AS Tutor_Centro,
                        ce.Nombre_Empresa AS Nombre_Empresa,
                        an.Tutor_Empresa AS Tutor_Practicas,
                        an.Fecha_Inicio,
                        an.Fecha_Final,
                        an.Cuadrante,
                        an.ID_Anexo AS Anexo,
                        an.Version AS Versionado,
                        TIME_FORMAT(TIMEDIFF(cp.Hora_Salida, cp.Hora_Entrada), '%H:%i') AS Horario,
                        ((DATEDIFF(an.Fecha_Final, an.Fecha_Inicio) / 7) * 5 * HOUR(TIMEDIFF(cp.Hora_Salida, cp.Hora_Entrada))) AS Horas_Totales
                        FROM 
                        alumnos a
                        JOIN 
                        practicas_alumnos pa ON a.ID_Alumno = pa.ID_Alumno
                        JOIN 
                        control_practicas cp ON pa.ID_Practica = cp.ID_Practica
                        JOIN 
                        anexos an ON cp.ID_Anexo = an.ID_Anexo
                        JOIN 
                        centro_alumno ca ON a.ID_Alumno = ca.ID_Alumno
                        JOIN 
                        control_convenios cc ON an.ID_Convenio = cc.ID_Convenio
                        JOIN 
                        control_empresas ce ON cc.ID_Control_Empresa = ce.ID_Control_Empresa
                        WHERE 
                        ca.ID_Centro_Formativo = ?");
$stmt->execute([$id_centro_educativo]);

if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
            echo "<td><input type='text' value='" . $row['Nombre_Alumno'] . "' readonly class='compact-input'></td>"; // Hacer editable
            echo "<td><input type='text' value='" . $row['Apellidos_Alumno'] . "' readonly class='compact-input'></td>"; // Hacer editable
            echo "<td><input type='text' value='" . $row['CV'] . "' readonly class='compact-input'></td>"; // Hacer editable
            echo "<td><input type='text' value='" . $row['Tutor_Centro'] . "' readonly class='compact-input'></td>"; // Hacer editable
            echo "<td><input type='text' value='" . $row['Nombre_Empresa'] . "' readonly class='compact-input'></td>"; // Hacer editable
            echo "<td><input type='text' value='" . $row['Tutor_Practicas'] . "' readonly class='compact-input'></td>"; // Hacer editable
            echo "<td><input type='text' value='" . $row['Fecha_Inicio'] . "' readonly class='compact-input'></td>"; // Hacer editable
            echo "<td><input type='text' value='" . $row['Fecha_Final'] . "' readonly class='compact-input'></td>"; // Hacer editable
            echo "<td><input type='text' value='" . $row['Cuadrante'] . "' readonly class='compact-input'></td>"; // Hacer editable
            echo "<td><input type='text' value='" . $row['Anexo'] . "' readonly class='compact-input'></td>"; // Hacer editable
            echo "<td><input type='text' value='" . $row['Versionado'] . "' readonly class='compact-input'></td>"; // Hacer editable
            echo "<td><input type='text' value='" . $row['Horario'] . "' readonly class='compact-input'></td>"; // Hacer editable
            echo "<td><input type='text' value='" . $row['Horas_Totales'] . "' readonly class='compact-input'></td>"; // Hacer editable
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='14'>No se encontraron alumnos asociados a este centro educativo.</td></tr>";
}