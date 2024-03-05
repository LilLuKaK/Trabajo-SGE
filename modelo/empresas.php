<?php
require_once 'conexion.php';

if(isset($_SESSION['id_centro']))$id_centro_educativo = $_SESSION['id_centro'];

$conn = ConexionBD::conectar();

    // Consulta SQL para obtener los centros formativos
$stmt = $conn->prepare("SELECT ce.Nombre_Empresa FROM control_empresas ce
        INNER JOIN control_convenios cc ON ce.ID_Control_Empresa = cc.ID_Control_Empresa
        WHERE cc.ID_Centro_Formativo = ?");
$stmt->execute([$id_centro_educativo]);


if ($stmt->rowCount() > 0) {
    // Iterar sobre los resultados y mostrar las opciones del select
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value='" . $row['Nombre_Empresa'] . "'>" . $row['Nombre_Empresa'] . "</option>";
    }
} else {
    echo "<option value='' disabled>No se encontraron empresas.</option>";
}