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
        <h2>Menú</h2>
        <br>
        <section id='secFiltroTipo'>
            <h4>Filtrar por tipo</h4>
           <br>
            <select id='selectTipos' name="selectTipos">
                <option value="Todos">Todos</option>
            </select>

    </div>

    <div class="right" style="background-color:paleturquoise;">
        <div id="titulo">
            <h2>Catálogo</h2>
        </div>
        <div id="games-container"></div>
    </div>
</div>
</body>
</html>