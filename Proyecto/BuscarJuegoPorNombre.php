<?php

require_once "ModeloDatos/Videojuego.php";
require_once  "ModeloDatos/DAO.php";

//salirSiSesionFalla();

$nombreFiltro = $_REQUEST["nombreActual"];
$todosMisJuegos = DAO::misVideojuegoObtenerTodos(DAO::usuarioObtenerId(), false);

//obtengo todos mis juegos y luego devuelvo solo los que cumplen con el filtrado
$misJuegosFiltrados = [];
foreach ($todosMisJuegos as $juegoActual) {
    //Si el nombre del juego empieza por lo que se haya puesto en el filtro entonces lo añado al array de juegos que coinciden
    if(strpos( $juegoActual->getNombre(), $nombreFiltro) === 0) {
        array_push($misJuegosFiltrados, $juegoActual);
    }
}
echo json_encode($misJuegosFiltrados);
