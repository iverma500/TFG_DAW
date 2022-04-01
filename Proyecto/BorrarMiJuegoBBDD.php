<?php

require_once "ModeloDatos/Videojuego.php";
require_once  "ModeloDatos/DAO.php";

//salirSiSesionFalla();

if (isset($_REQUEST["id"])){
    $idJuego = $_REQUEST["id"];
    $resultado = DAO::misJuegosBorrar(DAO::usuarioObtenerId(),$idJuego);

    $mensaje = "";
    if ($resultado){
        $mensaje = "JUEGO ELIMINADO CORRECTAMENTE";
    } else {
        $mensaje = "ERROR,El juego no ha sido posible de elimar";
    }

} else {
    redireccionar("MisJuegos.php");
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
    <link rel="stylesheet" href="CSS/carusel.css">
</head>
<body>
<header>
    <nav class="navegacion">
        <ul class="menu">
            <li><a href="Menu.php">Inicio</a></li>
            <li><a href="MisJuegos.php">Mis Juegos</a></li>
        </ul>
    </nav>
</header>
<div class="row">
    <div class="left">
        <br><br>
        <h1 style="color: orange"><?= $mensaje ?></h1>
        <br><br>
        <h1 style="font-size: x-large">Puedes volver a adquirir este o cualquier otro videojuego en la sección de <b>"Inicio"</b></h1>
        <br>
    </div>
</div>
<img src="Imagenes/z_Otras/gatoGammer.jpg" style="margin-left: 40%; width: 20%; height: 20%">
</body>
</html>
