<?php
require_once 'conexion.php';

try {
    // Obtener conexión
    $conn = ConexionBD::conectar();

    // Consulta SQL para obtener los centros formativos
    $sql = "SELECT ID_Centro_Formativo, Nombre FROM centro_formativo";
    $stmt = $conn->query($sql);

    // Obtener los resultados como un array asociativo
    $centros = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Devolver los datos en formato JSON
    echo json_encode($centros);
} catch (PDOException $e) {
    echo "Error al ejecutar la consulta: " . $e->getMessage();
}