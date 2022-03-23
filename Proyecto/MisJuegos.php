<?php
require_once "_Varios.php";
require_once "_Sesion.php";

salirSiSesionFalla("GestionUsuario/SesionUsuario/SesionFormulario.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/style2.css">
    <link rel="stylesheet" href="CSS/myGames.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="JS/MisJuegos.js" type="text/javascript"></script>
    <title>FGM - Inicio</title>
</head>
<body id="bodyPrincipal">
<header class="cabecera">
    <h1>Fandom Game Library</h1>
    <nav class="navegacion">
        <ul class="menu">
            <li><p>Hola <?= $_SESSION["identificador"]?></p>
                <ul class="submenu">
                    <li><a href="GestionUsuario/PerfilUsuario/Perfil.php">Mi Cuenta</a></li>
                    <li><a href="GestionUsuario/SesionUsuario/SesionCerrar.php">Cerrar Sesión</a></li>
                </ul>
            </li>
            <li><a href="Menu.php">Inicio</a></li>
            <li><a href="MisJuegos.php">Mis Juegos</a></li>
            <li><a href="#">Algo mas??¿</a></li>
        </ul>
    </nav>
</header>
<br>
<div class="row">
    <div class="left" style="background:paleturquoise;">
        <h4>Búsqueda por nombre</h4>
        <br>
        <input type="text" id="buscar" placeholder="Buscar.." title="Buscar por Categoría">
        <br>
        <p id="numJuegosEncontrados"></p>
    </div>
    <div class="right" style="background-color:paleturquoise;">
        <div id="titulo">
            <h2>Mi Biblioteca</h2>
            <br>
            <p id="juegosTotales"></p>
        </div>
        <div id="games-container"></div>
    </div>
</div>
</body>
</html>