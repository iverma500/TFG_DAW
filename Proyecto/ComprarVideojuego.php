<?php
require_once "ModeloDatos/Videojuego.php";
require_once  "ModeloDatos/DAO.php";
require_once "_Varios.php";
//require_once "_Sesion.php";
//salirSiSesionFalla();

//OBTENGO EL ID DEL VIDEOJUEGO QUE SE VA A COMPRAR
$idVideojuegoaAnnadir = (int) $_REQUEST["idVideojuego"];

//OBTENGO LOS VIDEOJUEGOS QUE EL USUARIO YA HA COMPRADO
$idsVideojuegos = DAO::misVideojuegoObtenerTodos(DAO::usuarioObtenerId(), true);

$stringCodJuegos = "";
foreach ($idsVideojuegos as $idActual) {
    $stringCodJuegos .= $idActual.",";
}
//echo "lo que mando a la BBDD es: ". $stringCodJuegos;

$yaComprado = false;
foreach ($idsVideojuegos as $idJuegoActual) {
    if ($idJuegoActual == $idVideojuegoaAnnadir) {
        //SI YA LO TIENE AÑADIDO ES QUE YA LO HA COMPRADO
        $yaComprado = true;
    }
}
//SI NO LO TENIA YA COMPRADO ENTONCES:
if (!$yaComprado) {
    //AÑADO EL NUEVO JUEGO AL LISTADO DE VIDEOJUEGOS COMPRADO
    $stringCodJuegos .= $idVideojuegoaAnnadir;
echo "lo que mando a la BBDD es: ". $stringCodJuegos;
//ACTUALIZO EL NUEVO LISTADO EN LA BASE DE DATOS
    if (DAO::videojuegoAnnadirIdAUsuario($stringCodJuegos,DAO::usuarioObtenerId())) {
        redireccionar("../Proyecto/z_fichasVideojuegos/JuegoCompradoExito.html");
    } else {
        redireccionar("../Proyecto/z_fichasVideojuegos/JuegoCompraError.html");
    }
//echo json_encode($resultado);
} else {
    redireccionar("../Proyecto/z_fichasVideojuegos/JuegoYaCompradoDeAntes.html");
}
