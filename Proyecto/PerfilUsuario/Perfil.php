<?php
require_once "../_Sesion.php";
require_once "../_Varios.php";
salirSiSesionFalla("../SesionFormulario.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="../CSS/estilosPerfil.css">
    <script src="../JS/Perfil.js"></script>
</head>
<body>
<section class="sectionPerfil">
<img class="imgRedonda" src="imagenPerfil.jpg">
    <br><br>
        <label for="identificador">Nickname</label>
        <input type="text" name="identificador" id="identificador" value=<?=$_SESSION["identificador"]?>>
        <br><br>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value=<?=$_SESSION["nombre"]?>>
        <br><br>
        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" id="apellidos" value=<?=$_SESSION["apellidos"]?>>
        <br><br><br><br>
        <button id="botonGuardar">Guardar cambios</button>
    <br><br>
    <p id="textoInfo"></p>
    <br><br>
    <a href="../Menu.php">Volver al menu principal</a>

</section>

</body>
</html>