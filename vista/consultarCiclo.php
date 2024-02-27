<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/login-register/loginStyle.css">
    <link rel="stylesheet" href="assets/css/common/commonStyle.css" />
</head>
<body>
    <div class="container">
        <?php
        $activeLink = 'crearCentro';
        include 'aside.php';
        ?>

    <div class="right">
        <div class="top">
            <p>Consulta de Ciclos Formativos</p>
            <h2>Aquí puedes ver los cursos que oferta el Centro Formativo</h2>
        </div>
        <div class="forms">
            <div class="form__control">
                <label for="ciclo">Ciclo</label>
                <div class="input">
                <input type="text" id="ciclo" name="ciclo" placeholder="Introduce el nombre del Ciclo"></input>
                <button id="buscarCiclo" class="search" name="buscarCiclo"><span class="material-symbols-sharp">manage_search</span></button>
                <input type="hidden" value="buscarCiclo">
            </div> 

/**
El switch de mostrar los alumnos actualmente en prácticas debe empezar con estado desactivado
La consulta SQL ha de ser: 
Consulta que se ha de repetir por cada uno de los Ciclos Formativos
SELECT COUNT(*)
FROM ciclo_alumno
WHERE ID_Ciclo_Formativo=(SELECT ID_Ciclo_Formativo 
                          FROM ciclos_formativos
                          WHERE Nombre_Ciclo='DAM');


                          SELECT COUNT(*)
FROM ciclo_alumno
WHERE ID_Ciclo_Formativo=(SELECT ID_Ciclo_Formativo 
                          FROM ciclos_formativos
                          WHERE Nombre_Ciclo='DAM')
AND ID_Alumno = (SELECT ID_Alumno
                 FROM alumnos
                 WHERE alumnos.Validez =1);
*/
            <div class="form__control">
                    <label for="conPracticas">Mostrar los Alumnos actualmente en prácticas (<span class="si">verde</span> para "si" y <span class="no">rojo</span> para "no") </label>
                    <div class="input">
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label>
                        <button class="search"><span class="material-symbols-sharp">manage_search</span></button>
                    </div>
                </div>
                <div class="form__control">
                    <label for="validez">Validez (<span class="si">verde</span> para "si" y <span class="no">rojo</span> para "no") </label>
                    <div class="input">
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label>
                        <button class="search"><span class="material-symbols-sharp">manage_search</span></button>
                    </div>
                </div>
                
            
            
        </div>


    </div>

</body>
</html>