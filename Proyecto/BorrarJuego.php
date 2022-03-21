<?php
require_once "_Varios.php";
require_once "_Sesion.php";

salirSiSesionFalla("GestionUsuario/SesionUsuario/SesionFormulario.php");

$id = "";

if (isset($_REQUEST["id"])){

    $id = $_REQUEST["id"];

    if (isset($_REQUEST["no"])){
        redireccionar("MisJuegos.php");
    }
} else {
    redireccionar("GestionUsuario/SesionUsuario/SesionFormulario.php");
}

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Run & Jump</title>
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="CSS/FichasJuegos2.css">
</head>
<body>
    <header>
        <nav class="navegacion">
            <ul class="menu">
                <li><a href="../Menu.php">Inicio</a></li>
                <li><a href="../MisJuegos.php">Mis Juegos</a></li>
            </ul>
        </nav>
    </header>
    <div class="data">
        <br>
        <h1>Confirmar Eliminación</h1>
        <br>
        <p>(Una vez eliminado no podrás acceder a él y  deberás volver a adquirirlo)</p>
        <p>¿Deseas Eliminar el juego de tu biblioteca?</p>
        <br>
        <form action="BorrarMiJuegoBBDD.php" method="post" class="line">
            <input type="hidden" name="id" id="id" value="<?= $id ?>" >
            <input type="submit" name="yes" id="yes" value="Si">
        </form>
        <form method="post" class="line">
            <input type="submit" name="no" id="no" value="No">
        </form>
    </div>
</body>
</html>