<?php
require_once 'conexion.php';

if(isset($_SESSION['id_centro']))$id_centro_educativo = $_SESSION['id_centro'];

$conn = ConexionBD::conectar();

    // Consulta SQL para obtener los centros formativos
$stmt = $conn->prepare("SELECT CONCAT(u.Nombre, ' ', u.Apellido1) AS NombreCompleto
        FROM usuario u
        INNER JOIN usuario_centro uc ON u.ID_Usuario = uc.ID_Usuario
        WHERE uc.ID_Centro_Formativo = ?");
$stmt->execute([$id_centro_educativo]);


if ($stmt->rowCount() > 0) {
    // Iterar sobre los resultados y mostrar las opciones del select
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value='" . $row['NombreCompleto'] . "'>" . $row['NombreCompleto'] . "</option>";
    }
} else {
    echo "<option value='' disabled>No se encontraron tutores del centro.</option>";
}