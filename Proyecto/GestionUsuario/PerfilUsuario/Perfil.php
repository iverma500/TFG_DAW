<?php
require_once "../../_Sesion.php";
require_once "../../_Varios.php";
salirSiSesionFalla("../SesionFormulario.php");

$seSubeFotoOk = false;
$fotoExtensionNoValida = false;
$fotoErrorSubir = false;
if (isset($_REQUEST["archivo"])) {
    $seSubeFotoOk = true;
}
if (isset($_REQUEST["errorExtArchivo"])) {
    $fotoExtensionNoValida = true;
}
if (isset($_REQUEST["errorSubirArchivo"])) {
    $fotoErrorSubir = true;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="../../CSS/estilosPerfil.css">
    <script src="../../JS/Perfil.js"></script>
</head>
<body>
<header>
    <h1>Fandom Game Library</h1>
    <nav class="navegacion">
        <ul class="menu">
            <li><a href="../../Menu.php">Inicio</a></li>
            <li><a href="../../MisJuegos.php">Mis Juegos</a></li>
        </ul>
    </nav>
</header>
<section class="sectionPerfil">

    <div class="divImgRedonda">
    <form action="SubirFotoUsuario.php" method="POST" enctype="multipart/form-data">
            <br><br><br>
    <input name="archivo" id="archivo" type="file"/>
    <input type="submit" name="subir" value="Subir imagen"/>
    </form>
    </div>
    <?php if ($seSubeFotoOk) {?>
        <p style="color:#57c6ac;">Imagen actualizada con éxito</p>
    <?php } else if($fotoExtensionNoValida) {?>
        <p style="color: red">No se ha podido subir la imagen (Solo se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo)</p>
    <?php } else if($fotoErrorSubir) {?>
        <p style="color: red">No se ha podido subir la imagen (error al subirla)</p>
    <?php }?>
    <br><br>
        <label for="identificador">Nickname</label>
        <input type="text" name="identificador" id="identificador" value=<?=$_SESSION["identificador"]?>>
        <br><br>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value=<?=$_SESSION["nombre"]?>>
        <br><br>
        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" id="apellidos" value=<?=$_SESSION["apellidos"]?>>
        <br><br>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value=<?=$_SESSION["email"]?>>
    <br>
    <p id="emailYaExiste"></p>
        <br><br><br><br>
        <button id="botonGuardar">Guardar cambios</button>
    <br><br>
    <p id="textoInfo"></p>
    <br><br>
    <a href="../../Menu.php">Volver al menu principal</a>

</section>

</body>
</html>