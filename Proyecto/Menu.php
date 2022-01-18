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
<h1>Fandom Game Library</h1>

<p>Sesión iniciada por <?= $_SESSION["nombre"] ?> [<?= $_SESSION["identificador"] ?>]</p>
<p><a href='SesionCerrar.php'>Cerrar sesión</a></p>

<br><br>

<div class="row">
    <div class="left" style="background-color:#bbb;">
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

    <div class="right" style="background-color:#ddd;">
        <div id="titulo">
            <h2>Juegos</h2>
        </div>
        <div id="games-container"></div>
    </div>
</div>
</body>
</html>