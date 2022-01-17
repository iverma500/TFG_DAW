<?php

require_once "ModeloDatos/Videojuego.php";
require_once  "ModeloDatos/DAO.php";

//salirSiSesionFalla();

$resultado = DAO::videojuegoObtenerTodos();

echo json_encode($resultado);