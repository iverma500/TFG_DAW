<?php
require_once "../../_Sesion.php";
require_once "../../ModeloDatos/DAO.php";

salirSiSesionFalla("../SesionFormulario.php");

$seSubeFotoOk = false;
$fotoExtensionNoValida = false;
$fotoErrorSubir = false;
$errorEliminarFoto = false;
if (isset($_REQUEST["archivo"])) {
    $seSubeFotoOk = true;
}
if (isset($_REQUEST["errorExtArchivo"])) {
    $fotoExtensionNoValida = true;
}
if (isset($_REQUEST["errorSubirArchivo"])) {
    $fotoErrorSubir = true;
}
if (isset($_REQUEST["errorEliminarFoto"])) {
    $errorEliminarFoto = true;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="../../CSS/estilosPerfil.css">
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/css/tether.min.css'>
    <link rel="stylesheet" href="../../CSS/darkMode.css">
    <link rel="stylesheet" href="../../CSS/menu.css">
    <link rel="stylesheet" href="../../CSS/style2.css">

    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
            integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
    />
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
                        <img src="../../Imagenes/Usuarios/imagenPerfil.jpg" class="imgPerfil">
                    <?php }?>

                    <a href="#"><?= $_SESSION["identificador"]?></a>
                </div>
            </div>

            <li><a href="../../Menu.php#home" class="inicio">Inicio</a></li>
            <li><a href="../../GestionUsuario/PerfilUsuario/Perfil.php#user">Mi Cuenta</a></li>
            <li><a href="../../MisJuegos.php#games">Mis Juegos</a></li>
            <li><a href="../../AcercaDe.php#about">Acerca de</a></li>
            <li><a href="../../GestionUsuario/SesionUsuario/SesionCerrar.php#out">Cerrar Sesión</a></li>
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
                <div id="titulo" style="height: 20px">
                    <h1>Mi Cuenta</h1>
                </div>
                <br>
                <section class="sectionPerfil">

                    <?php if (!DAO::usuarioYaTieneFotoPerfil($_SESSION["id"])) {?>

                        <div class="divImgRedonda">
                            <form action="SubirFotoUsuario.php" method="POST" enctype="multipart/form-data">
                                <br><br><br>
                                <input name="archivo" id="archivo" type="file"/>
                                <input type="submit" name="subir" value="Subir imagen"/>
                            </form>
                        </div>

                    <?php } else {?>
                        <img class="imgRedonda" src=<?="../../Imagenes/Usuarios/".$_SESSION["id"].".png"?>>
                        <br>
                        <button><a href="BorrarFotoUsuario.php">Eliminar la foto de perfil</a></button>
                    <?php }?>

                    <?php if ($seSubeFotoOk) {?>
                        <p style="color:#57c6ac;">Imagen actualizada con éxito</p>
                    <?php } else if($fotoExtensionNoValida) {?>
                        <p style="color: red">No se ha podido subir la imagen (Solo se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo)</p>
                    <?php } else if($fotoErrorSubir) {?>
                        <p style="color: red">No se ha podido subir la imagen (error al subirla)</p>
                    <?php } else if($errorEliminarFoto) {?>
                        <p style="color: red">No se ha podido eliminar la imagen</p>
                    <?php }?>
                    <br><br><br>
                    <label for="identificador" class="labels">Nickname</label>
                    <input type="text" name="identificador" id="identificador" class="inputs" value=<?=$_SESSION["identificador"]?>>
                    <br><br>
                    <label for="nombre" class="labels">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="inputs" value=<?=$_SESSION["nombre"]?>>
                    <br><br>
                    <label for="apellidos" class="labels">Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos" class="inputs" value=<?=$_SESSION["apellidos"]?>>
                    <br><br>
                    <label for="email" class="labels">Email</label>
                    <input type="email" name="email" id="email" class="inputs" value=<?=$_SESSION["email"]?>>
                    <br>
                    <p id="emailYaExiste"></p>
                    <br><br><br>
                    <button id="botonGuardar">Guardar cambios</button>
                    <br><br>
                    <p id="textoInfo"></p>
                    <br><br>
                </section>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->
<!-- partial -->
<footer style="padding: 50px"></footer>
</body>
<script src="../../JS/Perfil.js"></script>
<script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/js/tether.min.js'></script>
<script src="../../JS/panel.js"></script>
<script src="../../JS/darkMode.js"></script>
</html>