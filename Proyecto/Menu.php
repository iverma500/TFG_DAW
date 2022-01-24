<?php
require_once "_Varios.php";
require_once "_Sesion.php";

salirSiSesionFalla();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/style2.css">
    <link rel="stylesheet" href="CSS/cards.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="JS/GestionMenuPrincipal.js" type="text/javascript"></script>
    <title>FGM - Inicio</title>
</head>
<body id="bodyPrincipal">
<header class="cabecera">
    <h1>Fandom Game Library</h1>
    <nav class="navegacion">
        <ul class="menu">
            <li><p>Hola <?= $_SESSION["identificador"]?></p>
                <ul class="submenu">
                    <li><a href="">Mi Cuenta</a></li>
                    <li><a href="SesionCerrar.php">Cerrar Sesión</a></li>
                </ul>
            </li>
            <li><a href="Menu.php">Inicio</a></li>
            <li><a href="#">Mis Juegos</a></li>
            <li><a href="#">Algo mas??¿</a></li>
        </ul>
    </nav>
</header>
<br>
<div class="row">
    <div class="left" style="background:paleturquoise;">
        <h2>Menú</h2>
        <br>
        <input type="text" id="buscar" onkeyup="filtro()" placeholder="Buscar.." title="Buscar por Categoría">
        <ul id="menu">
            <li><a href="#">HTML</a></li>
            <li><a href="#">CSS</a></li>
            <li><a href="#">JavaScript</a></li>
            <li><a href="#">PHP</a></li>
            <li><a href="#">Python</a></li>
            <li><a href="#">jQuery</a></li>
            <li><a href="#">SQL</a></li>
        </ul>
    </div>

    <div class="right" style="background-color:paleturquoise;">
        <div id="titulo">
            <h2>Juegos</h2>
        </div>
        <div id="games-container"></div>
    </div>
</div>
</body>
</html>