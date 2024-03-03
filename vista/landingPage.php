<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inicio</title>
    <link rel="stylesheet" href="assets/css/landingPage/landingStyle.css" />
    <link rel="stylesheet" href="assets/css/common/commonStyle.css" />
</head>
<body>
    <div class="container">
        
        <?php
        $activeLink = 'landing';
        include 'aside.php';
        ?>
        
        <div class="right">
            <div class="top">
                <div class="profile">
                    <div class="info">
                        <p>Bienvenido, <b><?php echo $_SESSION['nombre'] ?></b></p>
                        <small class="text-muted">Tutor de prácticas</small>
                    </div>
                    <div class="profile-photo">
                        <img src="./assets/images/common/profile-1.jpg" />
                    </div>
                </div>
            </div>
            <!-- FIN DE TOP -->
            <div class="mid">
                
                <div class="sales-analytics">
                    <h2>Ultimos cambios</h2>
                    <div class="item online">
                        <div class="icon">
                            <span class="material-icons-sharp">person_add</span>
                        </div>
                        <div class="right">
                            <div class="info">
                                <h3>ALUMNO AGREGADO</h3>
                                <small class="text-muted">Ultimas 24 horas</small>
                            </div>
                            <h5 class="success">-----</h5>
                            <h3>-----</h3>
                        </div>
                    </div>
                    <div class="item offline">
                        <div class="icon">
                            <span class="material-icons-sharp">manage_accounts</span>
                        </div>
                        <div class="right">
                            <div class="info">
                                <h3>ALUMNO EDITADO</h3>
                                <small class="text-muted">Ultimas 24 horas</small>
                            </div>
                            <h5 class="danger">-----</h5>
                            <h3>-----</h3>
                        </div>
                    </div>
                    <div class="item customers">
                        <div class="icon">
                            <span class="material-icons-sharp">person_remove</span>
                        </div>
                        <div class="right">
                            <div class="info">
                                <h3>ALUMNO ELIMINADO</h3>
                                <small class="text-muted">Ultimas 24 horas</small>
                            </div>
                            <h5 class="success">-----</h5>
                            <h3>-----</h3>
                        </div>
                    </div>
                    <div class="item add-product">
                        <div>
                            <span class="material-icons-sharp">add</span>
                            <h3>Alumnos</h3>
                        </div>
                    </div><
                </div>
                <!----------------- FIN DE ULTIMOS CAMBIOS -------------------->
                
                <div class="calendar-container">
                    <h2>Calendario</h2>
                    <div class="datepicker">
                        <div class="datepicker-top">
                            <div class="btn-group">
                                <button class="tag">Today</button>
                                <button class="tag">Tomorrow</button>
                                <button class="tag">In 2 days</button>
                            </div>
                            <div class="month-selector">
                                <button class="arrow"><span class="material-symbols-sharp">arrow_back_ios</span></button>
                                <span class="month-name">December 2020</span>
                                <button class="arrow"><span class="material-symbols-sharp">arrow_forward_ios</span></button>
                            </div>
                        </div>
                        <div class="datepicker-calendar">
                            <span class="day">Lu</span>
                            <span class="day">Ma</span>
                            <span class="day">Mi</span>
                            <span class="day">Ju</span>
                            <span class="day">Vi</span>
                            <span class="day">Sa</span>
                            <span class="day">Do</span>
                            <button class="date faded">30</button>
                            <button class="date">1</button>
                            <button class="date">2</button>
                            <button class="date">3</button>
                            <button class="date">4</button>
                            <button class="date">5</button>
                            <button class="date">6</button>
                            <button class="date">7</button>
                            <button class="date">8</button>
                            <button class="date current-day">9</button>
                            <button class="date">10</button>
                            <button class="date">11</button>
                            <button class="date">12</button>
                            <button class="date">13</button>
                            <button class="date">14</button>
                            <button class="date">15</button>
                            <button class="date">16</button>
                            <button class="date">17</button>
                            <button class="date">18</button>
                            <button class="date">19</button>
                            <button class="date">20</button>
                            <button class="date">21</button>
                            <button class="date">22</button>
                            <button class="date">23</button>
                            <button class="date">24</button>
                            <button class="date">25</button>
                            <button class="date">26</button>
                            <button class="date">27</button>
                            <button class="date">28</button>
                            <button class="date">29</button>
                            <button class="date">30</button>
                            <button class="date">31</button>
                            <button class="date faded">1</button>
                            <button class="date faded">2</button>
                            <button class="date faded">3</button>
                        </div>
                    </div>
                </div>
                <!----------------- FIN DE CALENDARIO -------------------->
                <?php
                require './modelo/conexion.php';
                // Obtener el nombre del centro educativo del usuario actual
                $nombre_centro = ($_SESSION['nombre_centro']);

                // Consultar la base de datos para obtener los nombres de los usuarios del mismo centro educativo
                $conn = ConexionBD::conectar();

                if ($conn) {
                    $stmt = $conn->prepare("SELECT usuario.Nombre FROM usuario INNER JOIN usuario_centro ON usuario.ID_Usuario = usuario_centro.ID_Usuario INNER JOIN centro_formativo ON usuario_centro.ID_Centro_Formativo = centro_formativo.ID_Centro_Formativo WHERE UPPER(centro_formativo.Nombre) = ?");
                    $stmt->execute([$nombre_centro]);
                    $usuarios = $stmt->fetchAll(PDO::FETCH_COLUMN);
                }
                ?>
                <div class="recent-updates">
                    <h2>Tutores de prácticas</h2>
                    <div class="updates">
                        <?php if (!empty($usuarios)): ?>
                            <?php foreach ($usuarios as $nombre_usuario): ?>
                                <div class="update">
                                    <div class="profile-photo">
                                        <img src="./assets/images/common/profile-1.jpg" />
                                    </div>
                                    <div class="message">
                                        <p>
                                            <b><?php echo $nombre_usuario; ?></b>
                                        </p>
                                        <small class="text-muted">Tutor de prácticas</small>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No hay tutores de prácticas en este centro educativo.</p>
                        <?php endif; ?>
                    </div>
                </div>
                <!----------------- FIN DE TUTORES -------------------->
            </div>
            <!-- FIN DE MID -->
            <div class="low">
                <div class="slider-valores">
                    <div class="slide-track">
                        <div class="slide">
                            <img src="./assets/images/common/1.png" alt="">
                        </div>
                        <div class="slide">
                            <img src="./assets/images/common/2.png" alt="">
                        </div>
                        <div class="slide">
                            <img src="./assets/images/common/3.png" alt="">
                        </div>
                        <div class="slide">
                            <img src="./assets/images/common/4.png" alt="">
                        </div>
                        <div class="slide">
                            <img src="./assets/images/common/5.png" alt="">
                        </div>
                        <div class="slide">
                            <img src="./assets/images/common/6.png" alt="">
                        </div>
                        <div class="slide">
                            <img src="./assets/images/common/7.png" alt="">
                        </div>
            
                        <div class="slide">
                            <img src="./assets/images/common/1.png" alt="">
                        </div>
                        <div class="slide">
                            <img src="./assets/images/common/2.png" alt="">
                        </div>
                        <div class="slide">
                            <img src="./assets/images/common/3.png" alt="">
                        </div>
                        <div class="slide">
                            <img src="./assets/images/common/4.png" alt="">
                        </div>
                        <div class="slide">
                            <img src="./assets/images/common/5.png" alt="">
                        </div>
                        <div class="slide">
                            <img src="./assets/images/common/6.png" alt="">
                        </div>
                        <div class="slide">
                            <img src="./assets/images/common/7.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <!-- FIN DE LOW -->
            <footer>
                <p style="float: left;">Diseñado por <a href="https://www.linkedin.com/in/lucas-bravo-parra/" target="_blank">Lucas Bravo</a>, <a href="https://www.linkedin.com/in/malena-munoz/" target="_blank">Malena Muñoz</a></p>
            </footer>
        </div>
    </div>
    <script src="./assets/js/landingPage/landingScript.js"></script>
    <script src="./assets/js/common/commonScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
