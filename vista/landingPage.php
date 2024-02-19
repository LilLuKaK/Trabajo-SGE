<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inicio</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/landingPage/landingStyle.css" />
    <link rel="stylesheet" href="assets/css/common/commonStyle.css" />
</head>
<body>
    <div class="container">
        
        <?php include 'aside.php'; ?>
        
        <div class="right">
            <div class="top">
                <div class="profile">
                    <div class="info">
                        <p>Bienvenido, <b><?php $_SESSION['nombre'] ?></b></p>
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
                    <h2>Ultimos cámbios</h2>
                    <a href="#"><div class="item online">
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
                    </div></a>
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
                                <button class="arrow"><i class="material-icons">chevron_left</i></button>
                                <span class="month-name">December 2020</span>
                                <button class="arrow"><i class="material-icons">chevron_right</i></button>
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
                <div class="recent-updates">
                    <h2>Tutores de prácticas</h2>
                    <div class="updates">
                        <div class="update">
                            <div class="profile-photo">
                                <img src="./assets/images/common/profile-1.jpg" />
                            </div>
                            <div class="message">
                                <p>
                                    <b>Nombre Ejemplo</b>
                                </p>
                                <small class="text-muted">Tutor de prácticas</small>
                            </div>
                        </div>
                        <div class="update">
                            <div class="profile-photo">
                                <img src="./assets/images/common/profile-1.jpg" />
                            </div>
                            <div class="message">
                                <p>
                                    <b>Nombre Ejemplo</b>
                                </p>
                                <small class="text-muted">Tutor de prácticas</small>
                            </div>
                        </div>
                        <div class="update">
                            <div class="profile-photo">
                                <img src="./assets/images/common/profile-1.jpg" />
                            </div>
                            <div class="message">
                                <p>
                                    <b>Nombre Ejemplo</b>
                                </p>
                                <small class="text-muted">Tutor de prácticas</small>
                            </div>
                        </div>
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
                <p style="float: right;">Diseñado por <a href="https://www.linkedin.com/in/lucas-bravo-parra/" target="_blank">Lucas Bravo</a></p>
            </footer>
        </div>
    </div>
    <script src="./assets/js/landingPage/landingScript.js"></script>
    <script src="./assets/js/common/commonScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
