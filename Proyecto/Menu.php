<?php
require_once "_Varios.php";
require_once "_Sesion.php";
require_once "ModeloDatos/DAO.php";

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

    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/css/tether.min.css'>
    <link rel="stylesheet" href="CSS/menu.css">
    <link rel="stylesheet" href="CSS/darkMode.css">

    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
            integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
    />
    <title>FGM - Inicio</title>
</head>
<body>
<div id="wrapper">
    <div class="overlay"></div>
    <!-- Sidebar -->
    <nav class="navbar navbar-inverse fixed-top" id="sidebar-wrapper" role="navigation">
        <ul class="nav sidebar-nav">
            <div class="sidebar-header">
                <div class="sidebar-brand">
                    <?php if(DAO::usuarioYaTieneFotoPerfil($_SESSION["id"])) {?>
                        <img class="imgPerfil" src=<?="Imagenes/Usuarios/".$_SESSION["id"].".png"?>>
                    <?php } else {?>
                        <img src="Imagenes/Usuarios/imagenPerfil.jpg" class="imgPerfil">
                    <?php }?>

                    <a href="#"><?= $_SESSION["identificador"]?></a>
                </div>
            </div>

            <li><a href="#home" class="inicio">Inicio</a></li>
            <li><a href="GestionUsuario/PerfilUsuario/Perfil.php#user">Mi Cuenta</a></li>
            <li><a href="MisJuegos.php#games">Mis Juegos</a></li>
            <li><a href="AcercaDe.php#about">Acerca de</a></li>
            <li><a href="GestionUsuario/SesionUsuario/SesionCerrar.php#out">Cerrar Sesión</a></li>
        </ul>
    </nav>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <header id="cabecera">
                <button type="button" class="hamburger animated fadeInLeft is-closed" data-toggle="offcanvas">
                    <span class="hamb-top"></span>
                    <span class="hamb-middle"></span>
                    <span class="hamb-bottom"></span>
                </button>
                <h1 style="text-align: center; font-size: xxx-large">Fandom Game Library</h1>

            	<?php if ($_SESSION["modo"] == "claro") {?>
	            <div id="theme-toggler" class="fas fa-moon"></div>
	            <?php } else if ($_SESSION["modo"] == "oscuro"){?>
        	        <div id="theme-toggler" class="fas fa-moon fa-sun"></div>
	            <?php } else {?>
                	<div id="theme-toggler" class="---"></div>
            	<?php }?>
        </header>

        <div class="container">
            <div class="right">
                <div id="titulo">
                    <h1>Catálogo</h1>
                    <section>
                        <h3>Filtrar por Tipo</h3>
                        <div class="content-select">
                            <select id='selectTipos' name="selectTipos">
                                <option value="Todos">Todos</option>
                            </select>
                        </div>
                    </section>
                </div>
                <div id="games-container"></div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->
<!-- partial -->
<footer style="padding-bottom: 30px; background-color: black; text-align: center">
    <hr style="height:4px;border-width:0;color:gray;background-color:gray">
    <h6 style="color: white">© 2022 theFGL@gmail.es</h6>
    <h6 style="color: white">Todos los derechos reservados a sus respectivos dueños.</h6>
</footer>
</body>
<script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/js/tether.min.js'></script>
<script src="JS/panel.js"></script>
<script src="JS/darkMode.js"></script>
</html>