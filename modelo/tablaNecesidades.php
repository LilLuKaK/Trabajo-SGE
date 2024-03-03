<?php
                        // Incluir el archivo de conexión a la base de datos
                        include_once './modelo/conexion.php';

                        $id_centro_educativo = $_SESSION['id_centro'];
                        // Suponiendo que ya tienes el ID del centro educativo en una variable $id_centro_educativo
                        // Realiza la consulta para obtener los alumnos del centro educativo y el nombre del ciclo formativo de cada uno
                        $conn = ConexionBD::conectar();
                        $stmt = $conn->prepare("SELECT 
                                                    a.ID_Control_Empresa,
                                                    a.Nombre_Empresa AS 'Nombre de la Empresa', 
                                                    vn.Cantidad AS 'Todas las vacantes disponibles en un mismo año',
                                                    COUNT(vc.ID_Vacantes) AS 'Numero de vacantes cubiertas',
                                                    vn.Cantidad - COUNT(vc.ID_Vacantes) AS 'Vacantes que quedan',
                                                    an.Anyo AS 'Año de solicitud'
                                                FROM vacantes vn
                                                JOIN anyo_necesidad an ON vn.ID_Anyo_Necesidad = an.ID_Anyo_Necesidad
                                                JOIN convenios_anyo ca ON ca.ID_Anyo_Necesidad = an.ID_Anyo_Necesidad
                                                JOIN control_convenios cc ON ca.ID_Convenio = cc.ID_Convenio
                                                JOIN control_empresas ce ON cc.ID_Control_Empresa = ce.ID_Control_Empresa
                                                JOIN (SELECT ID_Vacantes, ID_Ciclo_Formativo
                                                    FROM vacantes_ciclo) vc ON vn.ID_Vacantes = vc.ID_Vacantes
                                                JOIN (SELECT ID_Control_Empresa, Nombre_Empresa 
                                                    FROM control_empresas) a ON ce.ID_Control_Empresa = a.ID_Control_Empresa
                                                WHERE cc.ID_Centro_Formativo =?
                                                GROUP BY a.Nombre_Empresa, an.Anyo;");
                        $stmt->execute([$id_centro_educativo]);
                        

                        // Comprueba si se encontraron resultados
                        if ($stmt->rowCount() > 0) {
                            // Itera sobre los resultados y muestra los datos en la tabla
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td>";
                                echo "<a href='index.php?pages=consultaAnyoNecesidad'><button class='read' name='" . $row['ID_Control_Empresa'] . "' id='readNecesidad'><span class='material-symbols-sharp'>edit</span></button></a>";
                                echo "<input id='readNecesidad' type='hidden' value='" . $row['ID_Control_Empresa'] . "'>";
                                echo "</td>";
                                echo "<td>" . $row['Nombre de la Empresa'] . "</td>";
                                echo "<td>" . $row['Todas las vacantes disponibles en un mismo año'] . "</td>";
                                echo "<td>". $row['Numero de vacantes cubiertas'] . "</td>";
                                echo "<td>". $row['Vacantes que quedan'] . "</td>";
                                echo "<td>" . $row['Año de solicitud'] . "</td>";                                
                                echo "</tr>";
                            }
                        } else {
                            // Si no se encontraron alumnos asociados al centro educativo, muestra un mensaje indicando que no hay resultados
                            echo "<tr><td colspan='14'>No se encontraron necesidades asociadas a este centro educativo.</td></tr>";
                        }