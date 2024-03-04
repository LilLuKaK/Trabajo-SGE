<?php
require_once './modelo/conexion.php';
$conn = ConexionBD::conectar();

$id_centro_educativo = $_SESSION['id_centro'];

$sql = "SELECT ce.Nombre_Empresa, cf.Nombre_Ciclo, cc.Fecha_Inicio, COUNT(pa.ID_Alumno) AS Numero_Alumnos
        FROM control_empresas ce
        JOIN control_convenios cc ON ce.ID_Control_Empresa = cc.ID_Control_Empresa
        JOIN anexos a ON cc.ID_Convenio = a.ID_Convenio
        JOIN control_practicas cp ON a.ID_Anexo = cp.ID_Anexo
        JOIN practicas_alumnos pa ON cp.ID_Practica = pa.ID_Practica
        JOIN centro_alumno ca ON pa.ID_Alumno = ca.ID_Alumno
        JOIN ciclos_formativos cf ON ca.ID_Centro_Formativo = cf.ID_Ciclo_Formativo
        WHERE ce.ID_Control_Empresa = $id_centro_educativo
        GROUP BY ce.Nombre_Empresa, cf.Nombre_Ciclo
        ORDER BY ce.Nombre_Empresa, cf.Nombre_Ciclo";

$resultado = $conn->query($sql);

if ($resultado->rowCount() > 0) {
    $num_empresas = $resultado->rowCount();
    $empresas_repetir = max(14 - $num_empresas, 0);
    
    echo '<div class="slider-valores">';
    echo '<div class="slide-track">';
    
    // Obtener todas las empresas y sus ciclos
    $empresas_ciclos = array();
    while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
        $nombre_empresa = $row['Nombre_Empresa'];
        $nombre_ciclo = $row['Nombre_Ciclo'];
        $numero_alumnos = $row['Numero_Alumnos'];
        $fecha_inicio = $row['Fecha_Inicio'];
        
        if (!isset($empresas_ciclos[$nombre_empresa])) {
            $empresas_ciclos[$nombre_empresa] = array();
        }
        
        $empresas_ciclos[$nombre_empresa][] = array(
            'ciclo' => $nombre_ciclo,
            'alumnos' => $numero_alumnos
        );
    }
    
    // Imprimir los divs de empresa y ciclos
    foreach ($empresas_ciclos as $empresa => $ciclos) {
        echo '<div class="slide item">';
            echo "<div class='right'>";
                echo "<div class='info'>";
                    echo "<h2>$empresa</h2>";
                    echo "<small class='text-muted'>$fecha_inicio</small>";
                echo "</div>";
                echo "<div class='ciclos'>";
                    foreach ($ciclos as $ciclo) {
                        echo "<h3>{$ciclo['ciclo']}</h3>";
                        echo "<h5>{$ciclo['alumnos']}</h5>";
                    }
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
    
    // Repetir empresas si es necesario
    for ($i = 0; $i < $empresas_repetir; $i++) {
        reset($empresas_ciclos);
        $primer_empresa = key($empresas_ciclos);
        echo '<div class="slide item">';
            echo "<div class='right'>";
                echo "<div class='info'>";
                    echo "<h2>$primer_empresa</h2>";
                    echo "<small class='text-muted'>$fecha_inicio</small>";
                echo "</div>";
                echo "<div class='ciclos'>";
                    foreach ($empresas_ciclos[$primer_empresa] as $ciclo) {
                        echo "<h3>{$ciclo['ciclo']}</h3>";
                        echo "<h5>{$ciclo['alumnos']}</h5>";
                    }
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
    
    echo '</div>';
    echo '</div>';
} else {
    echo "No se encontraron resultados.";
}

$conn = null; // Cerrar conexión PDO
