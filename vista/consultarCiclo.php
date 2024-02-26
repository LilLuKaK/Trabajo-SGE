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
            
            
        </div>


    </div>

</body>
</html>