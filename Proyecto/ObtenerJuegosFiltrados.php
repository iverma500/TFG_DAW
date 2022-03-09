<?php
require_once "ModeloDatos/Videojuego.php";
require_once  "ModeloDatos/DAO.php";

$resultado = DAO::videojuegoObtenerFiltrados($_REQUEST["filtro"]);

echo json_encode($resultado);
?>