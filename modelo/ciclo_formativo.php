<?php
// Realiza la conexión a la base de datos si no está ya establecida
$conn = ConexionBD::conectar();

if ($conn) {
    // Realiza la consulta para obtener los nombres de los ciclos formativos
    $stmt = $conn->query("SELECT * FROM ciclos_formativos");
    
    // Verifica si se encontraron resultados
    if ($stmt->rowCount() > 0) {
        // Itera sobre los resultados y muestra las opciones del select
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='" . $row['ID_Ciclo_Formativo'] . "'>" . $row['Nombre_Ciclo'] . "</option>";
        }
    } else {
        echo "<option value='' disabled>No se encontraron ciclos formativos.</option>";
    }
}