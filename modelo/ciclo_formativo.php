<?php
require_once 'conexion.php';
// Realizar la consulta para obtener los nombres de los ciclos formativos
$conn = ConexionBD::conectar();

if ($conn) {
    $stmt = $conn->query("SELECT * FROM ciclos_formativos");

    // Verificar si se encontraron resultados
    if ($stmt->rowCount() > 0) {
        // Iterar sobre los resultados y mostrar las opciones del select
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='" . $row['ID_Ciclo_Formativo'] . "'>" . $row['Nombre_Ciclo'] . "</option>";
        }
    } else {
        echo "<option value='' disabled>No se encontraron ciclos formativos.</option>";
    }
}